<?php
require_once('../controller/common.php');

$aVars = $_POST;

$bVars = array(
  'pro_uid'         => $aVars['pro_uid'],
  'tas_uid'         => $aVars['tas_uid'],
  'usr_uid'         => $aVars['usr_uid'],
  'variables'       => json_decode($aVars['variables']),
);

$oRet = pmRestRequest('POST', '/api/1.0/workflow/cases', $bVars);
if ($oRet->status == 200) {

  $appUid =  $oRet->response->app_uid;

  print $appUid;

  $pRet = pmRestRequest('PUT', "/api/1.0/workflow/cases/{$appUid}/route-case");
  if ($pRet->status == 200) {
  }

  $uploadDirectory = "uploads/";

  foreach ($aVars['form']["attchment"]["tmp_name"] as $key => $tmp_name) {
    $file_name = $aVars['form']["attchment"]["name"][$key];
    $file_tmp = $aVars['form']["attchment"]["tmp_name"][$key];
    $file_type = $aVars['form']['attchment']['type'][$key];

    $folder_uuid = $appUid;

    $folder_path = $uploadDirectory . $folder_uuid . '/';
    if (!file_exists($folder_path)) {
      mkdir($folder_path, 0777, true);
    }
    $file_destination = $folder_path . $file_name;
    move_uploaded_file($file_tmp, $file_destination);
  }

  $url = "/api/1.0/workflow/cases/{$appUid}/input-document";

  $path2 = $uploadDirectory . $appUid . '/';
  $files_in_folder = scandir($folder_path);
  foreach ($files_in_folder as $file) {
    if ($file != "." && $file != "..") {

      $dVars = array(
        'inp_doc_uid'     => $aVars['inp_doc_uid'],
        'tas_uid'         => $aVars['tas_uid'],
        'app_doc_comment' => 'ok',
        'variable_name'   => 'attchment',
        'dynaform_uid'    => '869628906657abcb9443954046901516',
        'new_file_name'   => 'myerror.png',
        'form'            => (phpversion() >= "5.5") ? new CurlFile($file_tmp, $file_type) : '@' . $file_tmp
      );


      $qRet = pmRestRequest('POST', $url, $dVars);
      if ($qRet->status == 200) {
        print $qRet->response;
      }
    }
  }

  // $nFiles = count($_FILES['attchment']['name']);
  // for ($i = 0; $i < $nFiles; $i++) {
  //   $path = $_FILES['attchment']['tmp_name'][$i];
  //   $type = $_FILES['attchment']['type'][$i];
  //   $filename = $_FILES['attchment']['name'][$i];
  //   rename($path, sys_get_temp_dir() . '/' . $filename);

  //   $cVars = array(
  //     'inp_doc_uid'     => $aVars['inp_doc_uid'],
  //     'tas_uid'         => $aVars['tas_uid'],
  //     'app_doc_comment' => $aVars['app_doc_comment'],
  //     'variable_name'   => $aVars['variable_name'],
  //     'dynaform_uid'    => $aVars['dynaform_uid'],
  //     'form'            => new CurlFile($path)
  //   );

  //   print json_encode($path);


  //   $url = "http://192.168.1.244:8000/api/1.0/workflow/cases/{$appUid}/input-document";

  //   $ch = curl_init();
  //   curl_setopt($ch, CURLOPT_URL, $url);
  //   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_COOKIE['access_token']));
  //   curl_setopt($ch, CURLOPT_POSTFIELDS, $cVars);
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //   $oResponse = json_decode(curl_exec($ch));
  //   $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //   curl_close($ch);
  //   unlink(sys_get_temp_dir() . '/' . $filename);

  //   print $httpStatus;
  // }

}
