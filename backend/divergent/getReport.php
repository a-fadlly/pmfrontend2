<?php
header('Access-Control-Allow-Origin: *');
//echo "<pre>";
include('Mainclass.php');
$obj = new DVclass();



echo 1;
$sql = $_POST['sql'];
echo $sql; die();
//$sql = "SELECT * FROM PMT_WIC_WISE_INPUT";
//$sql = "SELECT * FROM PMT_DV_RESEARCH_MANG_CASES_LIST";

echo $obj->FlyQuery($sql);
//echo json_encode($array);
?>
