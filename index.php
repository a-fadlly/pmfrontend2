<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
    header("Location: login.php");
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
                        <h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <div class="d-flex align-items-center font-weight-bold my-2">
                            <!--begin::Item-->
                            <a href="#" class="opacity-75 hover-opacity-100">
                                <i class="fa-solid fa-house"></i>
                            </a>
                            <!--end::Item-->

                            <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                            <a href="index.php"
                               class="text-white text-hover-white opacity-75 hover-opacity-100">Dashboard</a>
                        </div>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-2.jpg)">
                            <div class="card-body d-flex flex-column">
                                <a href="cases.php" class="text-light text-hover-primary font-weight-bolder font-size-h3">eApproval</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-2.jpg)">
                            <div class="card-body d-flex flex-column">
                                <a href="http://192.168.1.16/reports" class="text-light text-hover-primary font-weight-bolder font-size-h3">PowerBI</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-2.jpg)">
                            <div class="card-body d-flex flex-column">
                                <a href="http://192.168.1.179:8000/public" class="text-light text-hover-primary font-weight-bolder font-size-h3">Snipe-IT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
<?php include 'common/footer.php' ?>