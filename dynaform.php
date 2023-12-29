<?php
include 'controller/common.php';

//session_start();
//session_destroy();

if (empty($_SESSION["access_token"])) {
    //redirect dashboard
    header("Location: login.php");
} else {


    $pro_uid = $_REQUEST['pro_uid'];
    $tas_uid = $_REQUEST['tas_uid'];

    // get all case using this url
    $accessCase = json_decode(getCaseInfo('cases/start-cases'));


    //create new case
    //$dynaforms          = json_decode(createNewCase());
    //get single dynaform info
    //$single_dynaform    = json_decode(getCaseInfo('cases/'.$dynaforms->app_uid));


    //echo $pro_uid.'/dynaforms'; die();
    //prj_uid and pro_uid is same
    $dynaforms = json_decode(getDynaformInfo($pro_uid . '/dynaforms'));
    $first_dynaform = end($dynaforms->cases);
    //echo '<pre>'; print_r($dynaforms ); //die();
    //echo $_SESSION["access_token"];

    $pro_uid_id = $pro_uid;
    $token_id = $_SESSION["access_token"];
    $tas_uid_id = $tas_uid;

    //$dyn_uid_id     = $single_dynaform->cases->current_task[0]->tas_uid;
    //$we_title_id    = $single_dynaform->cases->current_task[0]->tas_title.'_'.uniqid();
    //$dyn_uid_id     = $first_dynaform->dyn_uid;
    $dyn_uid_id = $first_dynaform->dyn_uid;
    $we_title_id = uniqid();
    //$we_title_id    = $first_dynaform->dyn_title.'_'.uniqid();

}
?>

<?php include 'common/header.php' ?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Heading-->
                <div class="d-flex flex-column">
                    <!--begin::Title-->
                    <h2 class="text-white font-weight-bold my-2 mr-5">eApproval</h2>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <div class="d-flex align-items-center font-weight-bold my-2">
                        <!--begin::Item-->
                        <a href="#" class="opacity-75 hover-opacity-100">
                            <i class="fa-solid fa-house"></i>
                        </a>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="index" class="text-white text-hover-white opacity-75 hover-opacity-100">Cases</a>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Create Purchase
                            Requisition</a>
                        <!--end::Item-->
                    </div>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="#" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Reports</a>
                <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Create Purchase Requisition</h3>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Info:</h3>

                            <div class="table-responsive">

                                <iframe id="iframex" name="iframex" src="" width="90%" height="550" scrolling="yes" frameborder="0"></iframe>

                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script>
    $(document).ready(function() {
        function getDynaform(pro_uid, token, tas_uid, dyn_uid, we_title, user_id) {

            console.log(pro_uid + '_' + token + '_' + tas_uid + '_' + dyn_uid + '_' + we_title + '_' + user_id);

            var settings = {
                "url": "http://192.168.1.244:8000/api/1.0/workflow/project/" + pro_uid + "/web-entry",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Authorization": "Bearer " + token,
                    "Content-Type": "application/json"
                },
                "data": JSON.stringify({
                    "tas_uid": tas_uid,
                    "dyn_uid": dyn_uid,
                    "usr_uid": user_id,
                    "we_title": we_title,
                    "we_description": "Description.......",
                    "we_method": "WS",
                    "we_input_document_access": 1
                }),
            }

            $.ajax(settings).done(function(response) {
                console.log(response.we_data);
                var url = response.we_data;
                $('#iframex').prop("src", url);

                var we_uid = response.we_uid
                console.log(we_uid);
                //updateDynaform(pro_uid, token, tas_uid, dyn_uid, we_title, we_uid)

            });
        }

        getDynaform('<?= $pro_uid_id ?>', '<?= $token_id ?>', '<?= $tas_uid_id ?>', '<?= $dyn_uid_id ?>', '<?= $we_title_id ?>', '<?= $_SESSION['usr_uid'] ?>');
    });
</script>
<?php include 'common/footer.php' ?>