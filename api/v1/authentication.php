<?php

$app->get('/session', function() {
    $db = new DbHandler();
    $session = $db->getSession();
    $response["iUserID"] = $session['iUserID'];
    $response["vEmail"] = $session['vEmail'];
    $response["vName"] = $session['vName'];
    echoResponse(200, $session);
});

$app->post('/login', function() use ($app) {
    require_once 'passwordHash.php';
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('vEmail', 'vPassword'), $r->customer);
    $response = array();
    $db = new DbHandler();
    $password = $r->customer->vPassword;
    $email = $r->customer->vEmail;
    $user = $db->getOneRecord("SELECT iUserID,vName,vPassword,vEmail,dCreatedDate FROM tbl_user where vEmail='$email'");
    if ($user != NULL) {
        if (passwordHash::check_password($user['vPassword'], $password)) {
            $response['status'] = "success";
            $response['message'] = 'Logged in successfully.';
            $response['vName'] = $user['vName'];
            $response['iUserID'] = $user['iUserID'];
            $response['vEmail'] = $user['vEmail'];
            $response['dCreatedDate'] = $user['dCreatedDate'];
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['iUserID'] = $user['iUserID'];
            $_SESSION['vEmail'] = $email;
            $_SESSION['vName'] = $user['vName'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    } else {
        $response['status'] = "error";
        $response['message'] = 'No such user is registered';
    }
    echoResponse(200, $response);
});
$app->post('/signUp', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('vEmail', 'vName', 'vPassword'), $r->customer);
    require_once 'passwordHash.php';
    $db = new DbHandler();
    $name = $r->customer->vName;
    $email = $r->customer->vEmail;
    $password = $r->customer->vPassword;
    $isUserExists = $db->getOneRecord("SELECT 1 from tbl_user WHERE vEmail='$email'");
    if (!$isUserExists) {
        $r->customer->vPassword = passwordHash::hash($password);
        $tabble_name = "tbl_user";
        $column_names = array('vName', 'vEmail', 'vPassword');
        $result = $db->insertIntoTable($r->customer, $column_names, $tabble_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["iUserID"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['iUserID'] = $response["iUserID"];
            $_SESSION['vName'] = $name;
            $_SESSION['vEmail'] = $email;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create user. Please try again";
            echoResponse(201, $response);
        }
    } else {
        $response["status"] = "error";
        $response["message"] = "An user with the provided email exists!";
        echoResponse(201, $response);
    }
});

$app->get('/logout', function() {
    $db = new DbHandler();
    $session = $db->destroySession();
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});
?>