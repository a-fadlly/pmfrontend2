<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_POST['id'];
$jsonData = $_POST['jsonData'];

$reminderQCController = new ReminderQCController($db);

$status = $reminderQCController->inputTestResult2($jsonData, $id);

header('Content-Type: application/json');
echo json_encode($status);

$db->close();