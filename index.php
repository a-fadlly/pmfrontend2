<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
    header("Location: login.php");
}
?>

<?php include 'common/header.php' ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex flex-column">
                    <h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
                    <div class="d-flex align-items-center font-weight-bold my-2">
                        <a href="#" class="opacity-75 hover-opacity-100">
                            <i class="fa-solid fa-house"></i>
                        </a>
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="index.php" class="text-white text-hover-white opacity-75 hover-opacity-100">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-9.jpg)">
                        <div class="card-body d-flex flex-column">
                            <a href="cases.php" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h3">eApproval</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-9.jpg)">
                        <div class="card-body d-flex flex-column">
                            <a href="http://192.168.1.16/reports" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h3">PowerBI</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-9.jpg)">
                        <div class="card-body d-flex flex-column">
                            <a href="http://192.168.1.179:8000/public" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h3">Snipe-IT</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card card-custom bgi-no-repeat bgi-no-repeat bgi-size-cover gutter-b" style="height: 80px; background-image: url(assets/media/bg/bg-9.jpg)">
                        <div class="card-body d-flex flex-column">
                            <a href="reminderqc/Calendar.php" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h3">Reminder QC</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'common/footer.php' ?>