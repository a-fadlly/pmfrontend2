<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);

$events = $reminderQCController->getCalendarEvents();

header('Content-Type: application/json');
echo json_encode($events);

$db->close();