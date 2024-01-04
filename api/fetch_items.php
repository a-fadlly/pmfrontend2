<?php
$db = new mysqli('192.168.1.244:3307', 'monty', 'monty', 'bitnami_pm');

if ($db->connect_error) {
  die('Connection failed: ' . $db->connect_error);
}

$input = $_GET['input'];
$sql = "SELECT PT_PART, CONCAT(PT_DESC1, ' ',PT_DESC2) as PT_DESC1_2, PT_PVM_UM FROM pmt_pt_mstr WHERE PT_PART LIKE '%$input%' OR PT_DESC1 LIKE '%$input%' LIMIT 5";
$result = $db->query($sql);

$data = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

header('Content-Type: application/json');
echo json_encode($data);

$db->close();
