<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

if (!isset($_GET["id"])) {
  header("Location: Calendar.php");
}

$reminderQCController = new ReminderQCController($db);
$test = $reminderQCController->getTest($_GET['id']);


?>
<?php include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          <div class="card-title">
            <h3 class="card-label">Input Test Result
              <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
            </h3>
          </div>
        </div>
        <form class="form" method="POST" action="../api/post_test_result.php">
          <input type="hidden" id="id" name="id" value="<?= $_GET['id'] ?>">
          <div class="card-body">
            <?php $detail = json_decode($test["detail"], true); ?>
            <?php
            foreach (json_decode($test["variables"]) as $key => $item) {
              $input_name = preg_replace('/[^A-Za-z0-9_]/', '_', $item[0]);
            ?>
              <div class="form-group">
                <div class="col-lg-12">
                  <label><?= $item[0] ?></label>
                  <input id="<?= $input_name ?>_<?= $key ?>[]" name="<?= $input_name ?>_<?= $key ?>[]" placeholder="<?= isset($item[1]) ? $item[1] : '' ?>" type="text" class="form-control" />
                  <input type="hidden" id="<?= $input_name ?>_<?= $key ?>[]" name="<?= $input_name ?>_<?= $key ?>[]" value="<?= isset($item[1]) ? $item[1] : '' ?>">

                </div>
              </div>
            <?php } ?>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-lg-12">
                <button type="submit" class="btn btn-primary mr-2">Save</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
              </div>
            </div>
          </div>
        </form>
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

</body>

</html>