<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_POST['id'];

$reminderQCController = new ReminderQCController($db);

$status = $reminderQCController->inputTestResult($_POST, $id);

header('Content-Type: application/json');
echo $status;

$db->close();