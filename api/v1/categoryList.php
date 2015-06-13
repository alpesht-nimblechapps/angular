<?php
header('Content-Type: application/json');
require_once 'dbHandler.php';
$db = new DbHandler();
$data = $db->getAllRecords("SELECT * from tbl_category ORDER BY dCreatedDate DESC");
$i = 0;
if (!empty($data)) {
    while ($row = mysqli_fetch_assoc($data)) {
        $json[$i]['iCategoryID'] = $row['iCategoryID'];
        $json[$i]['vCategoryName'] = $row['vCategoryName'];
        $json[$i]['tDesc'] = $row['tDesc'];
        $json[$i]['vImage'] = (isset($row['vImage']) &&  $row['vImage']!='') ? UPD_URL.$row['vImage'] : '';
        $i++;
    }
} 
else {
    $json['status'] = "error";
    $json['message'] = 'No category found';
}
//print_r($json);
echo json_encode($json);
?>