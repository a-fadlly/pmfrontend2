<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);

$products = $reminderQCController->getProducts();
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8" />
  <title>Basic AF</title>
  <meta name="description" content="Basic datatables examples" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="https://keenthemes.com/metronic" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <link href="../assets/plugins/custom/datatables/datatables.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/global/plugins.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link href="../assets/plugins/custom/prismjs/prismjs.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
  <link href="../assets/css/style.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
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
  <script src="../assets/plugins/global/plugins.bundlef552.js?v=7.1.8"></script>
  <script src="../assets/plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8"></script>
  <script src="../assets/js/scripts.bundlef552.js?v=7.1.8"></script>
  <script src="../assets/plugins/custom/datatables/datatables.bundlef552.js?v=7.1.8"></script>
  <script src="../assets/js/pages/crud/forms/validation/form-widgetsf552.js?v=7.1.8"></script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style="background-image: url(../assets/media/bg/bg-10.jpg)" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
  <!--begin::Main-->
  <!--begin::Header Mobile-->
  <div id="kt_header_mobile" class="header-mobile">
    <!--begin::Logo-->
    <a href="../index.php">
      <img alt="Logo" src="../assets/media/logos/logo-letter-1.png" class="logo-default max-h-30px" />
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
                  <img alt="Logo" src="../assets/media/logos/logo-letter-9.png" class="logo-default max-h-40px" />
                  <img alt="Logo" src="../assets/media/logos/logo-letter-1.png" class="logo-sticky max-h-40px" />
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
                    <span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">usr_lastname</span>
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
                    <a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Cases</a>
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
              <div class="d-flex flex-row">
                <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
                  <div class="card card-custom">
                    <div class="card-body px-5">
                      <ul class="navi">
                        <li class="navi-section text-primary text-uppercase font-weight-bolder pb-0">
                          Cases
                        </li>
                        <li class="navi-item">
                          <a class="navi-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="navi-icon"><i class="fa-solid fa-circle-plus"></i></span>
                            <span class="navi-text">Create</span>
                          </a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="CreateProduct.php">Create Product</a>
                            <a class="dropdown-item" href="CreateBatch.php">Create Batch</a>
                        </li>
                        <li class="navi-item">
                          <a class="navi-link" href="Products.php">
                            <span class="navi-icon"><i class="fa-solid fa-inbox"></i></span>
                            <span class="navi-text">Products</span>
                          </a>
                        </li>
                        <li class="navi-item">
                          <a class="navi-link" href="Calendar.php">
                            <span class="navi-icon"><i class="fa-solid fa-calendar"></i></span>
                            <span class="navi-text">Calendar</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
                  <!--begin::Card-->
                  <div class="card card-custom">
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                          <div class="card-title">
                            <h3 class="card-label">Products
                              <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
                            </h3>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-head-custom table-vertical-center" id="inbox-table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Item Number</th>
                                  <th>Product Name</th>
                                  <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                foreach ($products as $product) {
                                ?>
                                  <tr>
                                    <td><?= $product["id"] ?></td>
                                    <td><a href="BatchesByProduct.php?id=<?= $product["id"] ?>"><?= $product["number"] ?></a></td>
                                    <td><?= $product["name"] ?></td>
                                    <td>Edit</td>
                                  </tr>
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                            <!--end: Datatable-->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Card-->
                </div>
              </div>
            </div>
            <!--end::Container-->
          </div>
          <!--end::Entry-->
        </div>
        <!--end::Content-->

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
    $(document).ready(function() {
      var inboxTable = $('#inbox-table').DataTable({
        "order": [0, 'desc']
      });
    });
  </script>
</body>

</html>