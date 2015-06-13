<?php
require_once 'dbHandler.php';
include '../config.php';
include('php_image_magician.php');

$file_upload = FALSE;
$db = new DbHandler();
$getImage = $db->getOneRecord("SELECT vImage from tbl_category WHERE iCategoryID ='".$_POST['iCategoryID']."'");

if($getImage['vImage']!=''){
    if(file_exists(DIR_UPD.$getImage['vImage'])){
        unlink(DIR_UPD.$getImage['vImage']);
    }
}
if (!empty($_FILES["vImage"]["name"])) {
    $image_info = pathinfo($_FILES["vImage"]["name"]);
    $renameFile =  time() . '.' . $image_info['extension'];
    $uploadDir = DIR_UPD;
    if (copy($_FILES["vImage"]["tmp_name"], $uploadDir . $renameFile)) {
        $magicianObj = new imageLib($uploadDir . $renameFile);
        $magicianObj->resizeImage(150, 150, 'auto', true);
        $magicianObj->saveImage($uploadDir . $renameFile, 100);
        $file_upload = TRUE;
    } 
} 
if ($file_upload) {
    
    $db->updateTable("UPDATE tbl_category SET vImage = '" . $renameFile . "' WHERE iCategoryID = '" . $_POST['iCategoryID'] . "'");
}
?>