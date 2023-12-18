<?php
header('Access-Control-Allow-Origin: *');
// echo "<pre>";
include('Mainclass.php');
$obj = new DVclass();




$sql = $_POST['sql'];
//echo $sql; die();
//$sql = "SELECT * FROM PMT_WIC_WISE_INPUT";
//$sql = "SELECT * FROM pmt_at_general_advance_case_data";

echo $obj->FlyQuery($sql);
//echo json_encode($array);
//echo $sql; die();
?>
