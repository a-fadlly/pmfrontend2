<?php
$pmServer = "https://example.com"; //set to address of the ProcessMaker server

/*Function to call a ProcessMaker REST endpoint and return the HTTP status code and
response if any.
Parameters:
$method: HTTP method: "GET", "POST", "PUT" or "DELETE"
$endpoint: The PM endpoint, not including the server's address and port number.
Ex: "/api/1.0/workflow/cases"
$aVars: Optional. Associative array containing the variables to use in the request
if "POST" or "PUT" method.
$accessToken: Optional. The access token, which comes from oauth2/token. If not defined
then uses the access token in $_COOKIE['access_token']
Return Value:
object {
response: Response from REST endpoint, decoded with json_decode().
status: HTTP status code: 200 (OK), 201 (Created), 400 (Bad Request), 404 (Not found), etc.
} */
function pmRestRequest($method, $endpoint, $aVars = null, $accessToken = null)
{
  global $pmServer;

  if (empty($accessToken) and isset($_COOKIE['access_token']))
    $accessToken = $_COOKIE['access_token'];

  if (empty($accessToken)) { //if the access token has expired
    //To check if the PM login session has expired: !isset($_COOKIE['PHPSESSID'])
    header("Location: loginForm.php"); //change to match your login method
    die();
  }

  //add beginning / to endpoint if it doesn't exist:
  if (!empty($endpoint) and $endpoint[0] != "/")
    $endpoint = "/" . $endpoint;

  $ch = curl_init($pmServer . $endpoint);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $accessToken));
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $method = strtoupper($method);

  switch ($method) {
    case "GET":
      break;
    case "DELETE":
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      break;
    case "PUT":
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    case "POST":
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($aVars));
      break;
    default:
      throw new Exception("Error: Invalid HTTP method '$method' $endpoint");
      return null;
  }

  $oRet = new StdClass;
  $oRet->response = json_decode(curl_exec($ch));
  $oRet->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($oRet->status == 401) { //if session has expired or bad login:
    header("Location: loginForm.php"); //change to match your login method
    die();
  } elseif ($oRet->status != 200 and $oRet->status != 201) { //if error
    if ($oRet->response and isset($oRet->response->error)) {
      print "Error in $pmServer:\nCode: {$oRet->response->error->code}\n" .
        "Message: {$oRet->response->error->message}\n";
    } else {
      print "Error: HTTP status code: $oRet->status\n";
    }
  }

  return $oRet;
}
