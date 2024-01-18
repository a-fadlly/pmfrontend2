<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$id = $_POST['id'];
$number = $_POST['number'];
$name = $_POST['name'];
$variables = $_POST['variables'];

$variables = stripslashes($variables);

$reminderQCController = new ReminderQCController($db);
if ($reminderQCController->editProduct($id, $number, $name, $variables)) {
}
