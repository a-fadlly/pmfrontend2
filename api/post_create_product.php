<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$number = $_POST['number'];
$name = $_POST['name'];
$variables = $_POST['variables'];

$reminderQCController = new ReminderQCController($db);
$product_id = $reminderQCController->createProduct2($number, $name);

foreach ($variables as $variable) {
  if (isset($variable["variable"]) && trim($variable["variable"]) !== '') {
    $reminderQCController->createProductVariable(
      $product_id,
      $variable["variable"],
      $variable["specification"]
    );
  }
}

header('Content-Type: application/json');
echo $product_id;

$db->close();
