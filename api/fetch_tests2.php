<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_GET['id'];

$reminderQCController = new ReminderQCController($db);

$calendar_data = $reminderQCController->getTest2($id);

header('Content-Type: application/json');
echo json_encode($calendar_data);

$db->close();