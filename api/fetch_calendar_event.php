<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_GET['id'];

$reminderQCController = new ReminderQCController($db);

$eventDetail = $reminderQCController->getCalendarEventDetail($id);

header('Content-Type: application/json');
echo json_encode($eventDetail);

$db->close();