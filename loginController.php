<?php
//If saving them as session:
//session_start();
//session_destroy();die();
include 'controller/common.php';

if (isset($_REQUEST['username']) and isset($_REQUEST['password'])) {

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $clientId = 'GUMPYDUPIQJIKWYEPWSXYIJYXHFCKIWS';
    $clientSecret = '927886962657fafcfa27639014705514';
    $pmServer = 'http://192.168.1.244:8000';
    $pmWorkspace = 'workflow';

    //set username using session
    $_SESSION['username'] = $username;

    //die();

    function pmRestLogin($clientId, $clientSecret, $username, $password)
    {
        global $pmServer, $pmWorkspace;

        $postParams = array(
            'grant_type' => 'password',
            'scope' => '*',       //set to 'view_process' if not changing the process
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'username' => $username,
            'password' => $password
        );

        $ch = curl_init("$pmServer/$pmWorkspace/oauth2/token");
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $oToken = json_decode(curl_exec($ch));
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus != 200) {
            print "Error in HTTP status code: $httpStatus\n";
            return null;
        } elseif (isset($oToken->error)) {
            echo "Error logging into $pmServer:\n" .
                "Error:       {$oToken->error}\n" .
                "Description: {$oToken->error_description}\n";
            die();
        } else {
            //At this point $oToken->access_token can be used to call REST endpoints.

            //If planning to use the access_token later, either save the access_token
            //and refresh_token as cookies or save them to a file in a secure location.

            //If saving them as cookies:
            setcookie("access_token", $oToken->access_token, time() + 86400);
            setcookie("refresh_token", $oToken->refresh_token); //refresh token doesn't expire
            setcookie("client_id", $clientId);
            setcookie("client_secret", $clientSecret);

            //If saving them as session:
            $_SESSION["access_token"] = $oToken->access_token; //,  time() + 86400
            $_SESSION["refresh_token"] = $oToken->refresh_token; //refresh token doesn't expire
            $_SESSION["client_id"] = $clientId;
            $_SESSION["client_secret"] = $clientSecret;

            $users = json_decode(getCaseInfo('users'));

            foreach ($users->cases as $u) {
                if ($u->usr_username == $_SESSION['username']) {
                    $_SESSION['usr_uid'] = $u->usr_uid;
                    $_SESSION['usr_firstname'] = $u->usr_firstname;
                    $_SESSION['usr_lastname'] = $u->usr_lastname;
                    $_SESSION['usr_email'] = $u->usr_email;
                    $_SESSION['usr_position'] = $u->usr_position;
                }
            }

            //If saving to a file:
            //file_put_contents("/secure/location/oauthAccess.json", json_encode($tokenData));

            header("Location: index.php");
        }
    }

    pmRestLogin($clientId, $clientSecret, $username, $password);
}
