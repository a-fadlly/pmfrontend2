<?php
include 'controller/common.php';

if (isset($_GET['app_uid'])) {
  $app_uid = $_GET['app_uid'];

  $api_response = getOutputDocs($app_uid);

  echo json_encode($api_response);
} else {
  echo "Invalid request";
}
