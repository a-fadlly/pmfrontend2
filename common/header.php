<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&amp;l=' + l : '';
      j.async = true;
      j.src = 'assets/../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
  </script>
  <!-- End Google Tag Manager -->
  <meta charset="utf-8" />
  <title>Basic AF</title>
  <meta name="description" content="Basic datatables examples" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="https://keenthemes.com/metronic" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <link href="assets/plugins/custom/datatables/datatables.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/global/plugins.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/custom/prismjs/prismjs.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo2/dist/assets/media/logos/favicon.ico" />

  <style>
    .result {
      padding: 8px;
      cursor: pointer;
      border: 1px solid #ccc;
      margin-top: 5px;
    }

    .result:hover {
      background-color: #f0f0f0;
    }
  </style>

  <script src="https://kit.fontawesome.com/5d09fddc6f.js" crossorigin="anonymous"></script>
  <script src="assets/plugins/global/plugins.bundlef552.js?v=7.1.8"></script>
  <script src="assets/plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8"></script>
  <script src="assets/js/scripts.bundlef552.js?v=7.1.8"></script>
  <script src="assets/plugins/custom/datatables/datatables.bundlef552.js?v=7.1.8"></script>
  <script src="assets/js/pages/crud/forms/validation/form-widgetsf552.js?v=7.1.8"></script>

  <script>
    (function(h, o, t, j, a, r) {
      h.hj = h.hj || function() {
        (h.hj.q = h.hj.q || []).push(arguments)
      };
      h._hjSettings = {
        hjid: 1070954,
        hjsv: 6
      };
      a = o.getElementsByTagName('head')[0];
      r = o.createElement('script');
      r.async = 1;
      r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
      a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
  </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style="background-image: url(assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!--begin::Main-->
  <!--begin::Header Mobile-->
  <div id="kt_header_mobile" class="header-mobile">
    <!--begin::Logo-->
    <a href="index.php">
      <img alt="Logo" src="assets/media/logos/logo-letter-1.png" class="logo-default max-h-30px" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
        <span></span>
      </button>
      <button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/User.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <polygon points="0 0 24 0 24 24 0 24" />
              <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
              <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>
      </button>
    </div>
    <!--end::Toolbar-->
  </div>
  <!--end::Header Mobile-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
      <!--begin::Wrapper-->
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header header-fixed">
          <!--begin::Container-->
          <div class="container d-flex align-items-stretch justify-content-between">
            <!--begin::Left-->
            <div class="d-flex align-items-stretch mr-3">
              <!--begin::Header Logo-->
              <div class="header-logo">
                <a href="index.php">
                  <img alt="Logo" src="assets/media/logos/logo-letter-9.png" class="logo-default max-h-40px" />
                  <img alt="Logo" src="assets/media/logos/logo-letter-1.png" class="logo-sticky max-h-40px" />
                </a>
              </div>
              <!--end::Header Logo-->
              <!--begin::Header Menu Wrapper-->
              <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                  <!--begin::Header Nav-->
                  <ul class="menu-nav">
                    <li class="menu-item">
                      <a href="index.php" class="menu-link">
                        <span class="menu-text">Dashboard</span>
                        <i class="menu-arrow"></i>
                      </a>
                    </li>
                    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                      <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="menu-text">Apps</span>
                        <i class="menu-arrow"></i>
                      </a>
                      <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                        <ul class="menu-subnav">

                          <li class="menu-item" aria-haspopup="true">
                            <a href="cases.php" class="menu-link">
                              <span class="menu-text">eApproval</span>
                              <span class="menu-desc"></span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                  <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
              </div>
              <!--end::Header Menu Wrapper-->
            </div>
            <!--end::Left-->
            <!--begin::Topbar-->
            <div class="topbar">
              <!--begin::User-->
              <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item">
                  <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
                    <span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4"><?= $_SESSION['usr_lastname'] ?></span>
                    <span class="symbol symbol-35">
                      <span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">S</span>
                    </span>
                  </div>
                </div>
                <!--end::Toggle-->
              </div>
              <!--end::User-->
            </div>
            <!--end::Topbar-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Header-->