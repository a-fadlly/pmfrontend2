</div>
</div>
</div>
</div>
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2021©</span>
            <a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a>
        </div>
        <div class="nav nav-dark order-1 order-md-2">
            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pr-3 pl-0">About</a>
            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link px-3">Team</a>
            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
        </div>
    </div>
</div>

<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">User Profile</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <div class="offcanvas-content pr-5 mr-n5">
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('../theme/html/demo2/dist/assets/media/users/300_21.jpg')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $_SESSION['aActiveUsers'] ?></a>
                <div class="text-muted mt-1">Admin</div>
                <div class="navi mt-2">
                    <a href="controller/common.php?action=logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
        <i class="fa-solid fa-arrow-up"></i>
    </span>
</div>
</div>
</div>
</div>
<script src="assets/theme/html/demo2/dist/assets/plugins/global/plugins.bundlef552.js?v=7.1.8"></script>
<script src="assets/theme/html/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8"></script>
<script src="assets/theme/html/demo2/dist/assets/js/scripts.bundlef552.js?v=7.1.8"></script>
<script src="assets/theme/html/demo2/dist/assets/plugins/custom/datatables/datatables.bundlef552.js?v=7.1.8"></script>
<script src="assets/theme/html/demo2/dist/assets/js/pages/crud/datatables/basic/basicf552.js?v=7.1.8"></script>
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>