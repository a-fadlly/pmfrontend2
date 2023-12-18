<?php
//echo 1; exit();
header('Access-Control-Allow-Origin: *');
session_start();
include('../divergent/Mainclass.php');
$obj = new DVclass();

ini_set("soap.wsdl_cache_enabled", "0");
ini_set('error_reporting', E_ALL); //uncomment to debug
ini_set('display_errors', True);  //uncomment to debug




$userid =$_SESSION['username'];//SUPERVISOR USR_UID
$caseId =$_GET['trace'];
$sql = $obj->FlyQuery("SELECT * FROM USERS WHERE USR_USERNAME='$userid'");

$json = json_decode($sql,true);
//echo '<pre>';
//echo $sql;

//print_r($json);
//print_r($_GET);
//die();

$userName =$json[0]['USR_USERNAME'];
$password = $json[0]['USR_PASSWORD'];
//print_r($userName);
//echo 1.'<br>';
//print_r($json);
//die();
//$userName ='admin';
//$password = 'f707fdda7c874ff49ebfb2c88a2860c5ff4ce3d94a21efb76566ad0f92c9ad57';

$client = new SoapClient('http://cicd.server247.info:58080/sysworkflow/en/green/services/wsdl2');


//CHANGE PORT ACCORDING TO YOUR SETUP
$passx = 'md5:' . $password;//hashed PWD
$user =  $userName;
$params = array(array('userid'=>$user, 'password'=>$passx));
$result = $client->__SoapCall('login', $params);//AUTOLOGIN SUPERVISOR

print_r($result);

die();
if ($result->status_code == 0) {
    $sessionId = $result->message;
}
else {
    die("<html><body><pre> Unable to connect to ProcessMaker.\n" .
        "Error Message: $result->message </pre></body></html>");
}

class variableStruct {
    public $name;
    public $value;
}
 
$var = new variableStruct();
$var->name = "APROJEFE";
$var->value = $_GET['approved'];//APPROVED OR NOT
 
$lineManagerStatus        = new variableStruct();
$lineManagerStatus->name  = 'lineManagerStatus';
$lineManagerStatus->value = $_GET['approved'];

$variables = array($var, $lineManagerStatus);
//print_r($variables);
//die();
$params = array(array('sessionId'=>$sessionId, 'caseId'=>$_GET['case'], 'variables'=>$variables));
$result = $client->__SoapCall('sendVariables', $params);
//APPROVE OR REJECT REQUEST

if ($result->status_code != 0){
   die("<html><body><pre> Error: $result->message </pre></body></html>");
}
else{
  $paramsx = array(array('sessionId'=>$sessionId, 'caseId'=>$_GET['case'], 'delIndex'=>$del_index));
//IN MY CASE, delIndex is '2', because APPROVAL is TASK 2
  $resultx = $client->__SoapCall('routeCase', $paramsx);
//ROUTE CASE TO NEXT TASK AND USER
}
//print_r($result);
//die();
  if ($resultx->status_code == 0){
     print "Case derived: $resultx->message \n";
  }
  else{
     print "Error deriving case: $resultx->message \n";
  }
    
?>