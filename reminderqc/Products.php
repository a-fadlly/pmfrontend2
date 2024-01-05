<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);

$products = $reminderQCController->getProducts();
?>
<?php include 'header.php' ?>
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
                  <th>Item Number</th>
                  <th>Product Name</th>
                  <th>Batch Count</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($products as $product) {
                ?>
                  <tr>
                    <td><a href="BatchesByProduct.php?id=<?= $product["id"] ?>"><?= $product["number"] ?></a></td>
                    <td><?= $product["name"] ?></td>
                    <td><?= $product["batch_count"] ?></td>
                    <td>
                      <a class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.8em;" href="EditProduct.php?id=<?= $product["id"] ?>">Edit</a>
                      <a class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" href="DeleteProduct.php?id=<?= $product["id"] ?>">Delete</a>
                    </td>
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