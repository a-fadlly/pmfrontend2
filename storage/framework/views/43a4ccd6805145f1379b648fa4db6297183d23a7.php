<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Updates and statistics" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">



    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Page Custom Styles(used by this page)-->
    <link href=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/css/pages/login/classic/login-4.css?v=7.1.8')); ?>" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/plugins/global/plugins.bundlef552.css?v=7.1.8')); ?> " rel="stylesheet" type="text/css" />
    <link href=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlef552.css?v=7.1.8')); ?> " rel="stylesheet" type="text/css" />
    <link href=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/css/style.bundlef552.css?v=7.1.8')); ?> " rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo2/dist/assets/media/logos/favicon.ico" />



    <!-- Styles -->
    <style>

    </style>
</head>
<body id="kt_body" style="background-image: url(<?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/media/bg/bg-10.jpg')); ?>)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">


    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url(<?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/media/bg/bg-3.jpg')); ?>);">
                <div class="login-form text-center p-7 position-relative overflow-hidden col-4">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="<?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/media/logos/logo-letter-13.png" class="max-h-75px')); ?>" alt="">
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>Sign In To Admin</h3>
                            <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                        </div>
                        <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_login_signin_form" novalidate="novalidate">
                            <div class="form-group mb-5 fv-plugins-icon-container">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="username" autocomplete="off">
                                <div class="fv-plugins-message-container"></div></div>
                            <div class="form-group mb-5 fv-plugins-icon-container">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password">
                                <div class="fv-plugins-message-container"></div></div>

                            <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Sign In</button>
                            <input type="hidden"><div></div></form>

                    </div>
                    <!--end::Login Sign in form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>




    <!--begin::Page Scripts(used by this page)-->
    <script src=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/js/pages/custom/login/login-general.js?v=7.1.8')); ?>"></script>


    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/plugins/global/plugins.bundlef552.js?v=7.1.8')); ?> "></script>
    <script src=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8')); ?> "></script>
    <script src=" <?php echo e(asset('assets/backend/theme/html/demo2/dist/assets/js/scripts.bundlef552.js?v=7.1.8')); ?> "></script>
    <!--end::Global Theme Bundle-->




</body>
</html>
<?php /**PATH H:\learning\htdocs\processmaker_ncel\resources\views/layout/login-master.blade.php ENDPATH**/ ?>