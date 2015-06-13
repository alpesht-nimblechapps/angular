<?php

$app->post('/category', function() use ($app) {
    $response = array();
    $r = json_decode($app->request->getBody());
    verifyRequiredParams(array('vCategoryName', 'tDesc'), $r->category);
    $db = new DbHandler();
    $name = $r->category->vCategoryName;
    $desc = $r->category->tDesc;
    if (isset($r->category->iCategoryID)) {
        $extendQuery = " AND iCategoryID != '" . $r->category->iCategoryID . "'";
    } else {
        $extendQuery = '';
    }
    $isCategoryExists = $db->getOneRecord("SELECT 1 from tbl_category WHERE vCategoryName='$name' $extendQuery ");
    if (!$isCategoryExists) {
        if (isset($r->category->iCategoryID)) {
            $result = $db->updateTable("UPDATE tbl_category SET vCategoryName = '" . $name . "', tDesc = '" . $desc . "' WHERE iCategoryID = '".$r->category->iCategoryID."'");
            $response["status"] = "success";
            $response["message"] = "Category updated successfully";
            $response["iCategoryID"] = $r->category->iCategoryID;
            echoResponse(200, $response);
        } else {
            $tabble_name = "tbl_category";
            $column_names = array('vCategoryName', 'tDesc', 'vImage');
            $result = $db->insertIntoTable($r->category, $column_names, $tabble_name);
            if ($result != NULL) {
                $response["status"] = "success";
                $response["message"] = "Category created successfully";
                $response["iCategoryID"] = $result;
                echoResponse(200, $response);
            } else {
                $response["status"] = "error";
                $response["message"] = "Failed to create category. Please try again";
                echoResponse(201, $response);
            }
        }
    } else {
        $response["status"] = "error";
        $response["message"] = "A category with the provided name exists!";
        echoResponse(201, $response);
    }
});
?>