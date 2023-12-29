<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
  <!--begin::Container-->
  <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
    <!--begin::Copyright-->
    <div class="text-dark order-2 order-md-1">
      <span class="text-muted font-weight-bold mr-2">2023© Mersifarma Tirmaku Mercusana</span>
    </div>
    <!--end::Copyright-->
  </div>
  <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
  <!--begin::Content-->
  <div class="offcanvas-content pr-5 mr-n5">
    <!--begin::Header-->
    <div class="d-flex align-items-center mt-5">
      <div class="symbol symbol-100 mr-5">
        <div class="symbol-label" style="background-image:url('assets/media/users/300_21.jpg')"></div>
      </div>
      <div class="d-flex flex-column">
        <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
          <?= $_SESSION['usr_firstname'] . ' ' . $_SESSION['usr_lastname'] ?>
        </a>
        <div class="text-muted mt-1">
            <?= $_SESSION['usr_position'] ?>
        </div>
        <div class="navi mt-2">
          <a href="#" class="navi-item">
            <span class="navi-link p-0 pb-2">
              <span class="navi-icon mr-1">
                <span class="svg-icon svg-icon-lg svg-icon-primary">
                  <i class="fa-solid fa-envelope"></i>
                </span>
              </span>
              <span class="navi-text text-muted text-hover-primary"><?= $_SESSION['usr_email'] ?></span>
            </span>
          </a>
          <a href="controller/common.php?action=logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">
            Sign Out
          </a>
        </div>
      </div>
    </div>
    <!--end::Header-->
  </div>
  <!--end::Content-->
</div>
<!-- end::User Panel-->
<script>
  var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
</script>
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
</body>

</html>