<?php
echo 1; exit();
ini_set("soap.wsdl_cache_enabled", "0");
//ini_set('error_reporting', E_ALL); //uncomment to debug
//ini_set('display_errors', True);  //uncomment to debug
 
$client = new SoapClient('http://45.114.85.18:3322/sysworkflow/en/neoclassic/services/wsdl2');
$pass = 'md5:' . md5('123456a');
$params = array(array('userid'=>'admin', 'password'=>$pass));
$result = $client->__SoapCall('login', $params);
 
if ($result->status_code == 0)
    $sessionId = $result->message;
else
    die("<html><body><pre> Unable to connect to ProcessMaker.\n" .
        "Error Message: $result->message </pre></body></html>");
 
class variableStruct {
    public $name;
    public $value;
}
 
$var = new variableStruct();
$var->name = "approved";
$var->value = $_GET['approved'];
 
$variables = array($var);
$params = array(array('sessionId'=>$sessionId, 'caseId'=>$_GET['case'], 'variables'=>$variables));
$result = $client->__SoapCall('sendVariables', $params);
if ($result->status_code != 0)
   die("<html><body><pre> Error: $result->message </pre></body></html>";
 
//Use routeCase() to route the case using the case variable @@approved in the evaluation condition
 
?>