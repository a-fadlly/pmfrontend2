<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_GET['id'];

$reminderQCController = new ReminderQCController($db);

$batches = $reminderQCController->getBatchesByProduct($id);

header('Content-Type: application/json');
echo json_encode($batches);

$db->close();