<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$number = $_POST['number'];
$name = $_POST['name'];
$variables = $_POST['variables'];

$variables = stripslashes($variables);

$reminderQCController = new ReminderQCController($db);
if ($reminderQCController->createProduct($number, $name, $variables)) {
} else {
}