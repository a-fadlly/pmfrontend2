<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_GET['id'];

$reminderQCController = new ReminderQCController($db);

$tests = $reminderQCController->getTestsByBatch($id);

header('Content-Type: application/json');
echo json_encode($tests);

$db->close();