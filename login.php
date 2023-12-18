<?php
session_start();
if (!empty($_SESSION["access_token"])) {
    header("Location: backend/index");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Mersi Intra</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- App Icons -->
    <link rel="shortcut icon" href="assets/images/favicon.ico"><!-- App css -->
    <link href="backend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="backend/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="backend/assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body style="padding-bottom: unset !important;">
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="accountbg" style="background: #fff !important;">
    </div>
    <div class="wrapper-page">
        <div class="card">
            <div class="card-body">
                <div class="p-3">
                    <div class="float-right text-right">
                        <h4 class="font-18 mt-3 m-b-5">Welcome to MTM</h4>
                        <p class="text-muted">Please enter your credentials below</p>
                    </div>
                    <a href="index.html" class="logo-admin">
                        <img width="25%" src="https://www.mersifarma.com/wp-content/uploads/2016/12/cropped-cropped-logo.png" alt="logo">
                    </a>
                </div>
                <div class="p-3">
                    <form class="form-horizontal m-t-10" action="loginController.php" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        <div class="form-group row m-t-30">
                            <div class="col-sm-12 text-right">
                                <button style="    background-color: #C1272C; border: 1px solid #C1272C;" class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="m-t-40 text-center text-white-50">
            <p style="color: white;">© 2020 NCEL. All rights reserved.</p>
        </div>
    </div>
    <script src="backend/assets/js/jquery.min.js"></script>
    <script src="backend/assets/js/bootstrap.bundle.min.js"></script>
    <script src="backend/assets/js/modernizr.min.js"></script>
    <script src="backend/assets/js/waves.js"></script>
    <script src="backend/assets/js/jquery.slimscroll.js"></script>
    <script src="backend/assets/js/app.js"></script>
</body>

</html>