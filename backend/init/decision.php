<?php
echo 1; exit();
ini_set("soap.wsdl_cache_enabled", "0");
//ini_set('error_reporting', E_ALL); //uncomment to debug
//ini_set('display_errors', True);  //uncomment to debug
 
if (!isset($_GET['purchaseDecision'])) {
  die("The GET variable purchaseDecision is not set!");
}
//set to the IP address or domain name of your ProcessMaker server: 
$client = new SoapClient('http://45.114.85.18:3322/sysworkflow/en/neoclassic/services/wsdl2');
$pass = 'md5:' . md5('admin');
$pass = '123456a';
$params = array(array('userid'=>'admin', 'password'=>$pass));
$result = $client->__SoapCall('login', $params);

if ($result->status_code == 0) {
   $sessionId = $result->message;
} 
else {
   die("<html><body><p></p>Unable to connect to ProcessMaker.<br>\n" .
      "Error Message: <pre>$result->message</pre></p></body></html>");
} 
class variableStruct {
    public $name;
    public $value;
}
 
$decision        = new variableStruct();
$decision->name  = 'purchaseDecision';
$decision->value = $_GET['purchaseDecision'];

$comments        = new variableStruct();
$comments->name  = 'decisionComments';
$comments->value = $_GET['decisionComments'];
 
$variables = array($decision, $comments);
$params = array(array('sessionId'=>$sessionId, 'caseId'=>$_GET['caseId'], 'variables'=>$variables));
$result = $client->__SoapCall('sendVariables', $params);
if ($result->status_code != 0) {
   die("<html><body><pre>Error: $result->message </pre></body></html>");
} 
else {
   print "Form submitted.";
}
?>