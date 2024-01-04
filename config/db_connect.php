<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'intra';

$db = new mysqli($host, $user, $password, $database);

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

$db->set_charset("utf8");