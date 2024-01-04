<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);

$calendar_data = $reminderQCController->getCalendarEvent();

header('Content-Type: application/json');
echo json_encode($calendar_data);

$db->close();