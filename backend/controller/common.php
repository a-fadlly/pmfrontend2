<?php
session_start();

$pmServer    = 'http://192.168.1.244:8000';
$pmWorkspace = 'workflow';

if (!empty($_SESSION["access_token"])) {

    //for get case info
    function getCaseInfo($url)
    {
        global $pmServer, $pmWorkspace;

        // get all case using this url
        $getCase = curl_init($pmServer . "/api/1.0/" . $pmWorkspace . "/" . $url);
        curl_setopt($getCase, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["access_token"]));
        curl_setopt($getCase, CURLOPT_RETURNTRANSFER, true);
        $data['cases'] = json_decode(curl_exec($getCase));
        $data['casesStatusCode'] = curl_getinfo($getCase, CURLINFO_HTTP_CODE);
        curl_close($getCase);

        //echo json data
        return json_encode($data);
    }


    //for get dynaform info
    function getDynaformInfo($url)
    {
        global $pmServer, $pmWorkspace;

        // get all case using this url
        $getCase = curl_init($pmServer . "/api/1.0/" . $pmWorkspace . "/project/" . $url);
        curl_setopt($getCase, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["access_token"]));
        curl_setopt($getCase, CURLOPT_RETURNTRANSFER, true);
        $data['cases'] = json_decode(curl_exec($getCase));
        $data['casesStatusCode'] = curl_getinfo($getCase, CURLINFO_HTTP_CODE);
        curl_close($getCase);

        //echo json data
        return json_encode($data);
    }

    //for get dynaform info
    function getOutputDocs($url)
    {
        global $pmServer, $pmWorkspace;

        // get all case using this url
        $getCase = curl_init($pmServer . "/api/1.0/" . $pmWorkspace . "/cases/" . $url . "/output-documents");
        curl_setopt($getCase, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["access_token"]));
        curl_setopt($getCase, CURLOPT_RETURNTRANSFER, true);
        $data['cases'] = json_decode(curl_exec($getCase));
        $data['casesStatusCode'] = curl_getinfo($getCase, CURLINFO_HTTP_CODE);
        curl_close($getCase);

        //echo json data
        return formatOutputDocs($data);
    }

    function formatOutputDocs($data)
    {
        $str = "";
        foreach ($data["cases"] as $doc) {
            $str .= $doc->app_doc_filename . "<br>";
        }
        return $str;
    }

    //for logout
    if (isset($_REQUEST['action'])) {
        //echo $_REQUEST['action'];

        //session_start();
        session_destroy();
        unset($_COOKIE['access_token']);
        unset($_COOKIE['refresh_token']);
        unset($_COOKIE['client_id']);
        unset($_COOKIE['client_secret']);

        //redirect
        header("Location: ../../login");
    }

    //for create case using api
    if (isset($_REQUEST['pro_uid']) && isset($_REQUEST['tas_uid'])) {

        function createNewCase()
        {
            global $pmServer, $pmWorkspace;

            // for create a new case using API
            $aVars = array(
                'pro_uid'   => $_REQUEST['pro_uid'],
                'tas_uid'   => $_REQUEST['tas_uid'],
                //'variables' => $aCaseVars
            );

            //echo "<pre>";
            /*print_r($aVars);
                die();*/

            $ch = curl_init($pmServer . "api/1.0/" . $pmWorkspace . "/cases");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["access_token"]));
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $aVars);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $create_case = json_decode(curl_exec($ch));
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return json_encode($create_case);


            /*print_r($create_case);
                echo '<br>';*/

            /*if ($httpStatus == 200) {
                    // get dynaform details using this url
                    // http://192.168.1.244:8000/api/1.0/{workspace}/project/{prj_uid}/dynaform/{dyn_uid}
                    //here prj_uid = process id and dyn_uid = dynaform id
                    $getDynaform = curl_init("http://192.168.1.244:8000/api/1.0/workflow/project/".$_REQUEST['pro_uid']."/dynaform/5647041045fc4cd68b5b043005341772");

                    curl_setopt($getDynaform, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $_SESSION["access_token"]));
                    curl_setopt($getDynaform, CURLOPT_RETURNTRANSFER, true);
                    $accessDynaform = json_decode(curl_exec($getDynaform));
                    $accessStatusDynaform = curl_getinfo($getDynaform, CURLINFO_HTTP_CODE);
                    curl_close($getDynaform);

                    //echo $oToken->app_uid.'<br>';
                    //echo '<pre>'.'common-'; print_r($accessDynaform);

                    return json_encode($oToken);

                }*/
        }
    }
}
