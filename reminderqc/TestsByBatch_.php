<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION["access_token"])) {
  header("Location: ../login.php");
}

require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

if (empty($_GET["id"])) {
  header("Location: Products.php");
}

$reminderQCController = new ReminderQCController($db);

$batch = $reminderQCController->getTestsByBatch($_GET['id']);
?>
<?php include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          <div class="card-title">
            <h3 class="card-label">Tests By Batch
              <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
            </h3>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="col-lg-12">
              <label>Item Number:</label>
              <p><strong><?= $batch["product_number"] ?></strong></p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <label>Product Name:</label>
              <p><strong><?= $batch["product_name"] ?></strong></p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <label>Batch Number:</label>
              <p><strong><?= $batch["batch_number"] ?></strong></p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <label>Mfg. Date:</label>
              <p><strong><?= $batch["mfg_date"] ?></strong></p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <label>Exp. Date:</label>
              <p><strong><?= $batch["exp_date"] ?></strong></p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <?php
              foreach (json_decode($batch["types"]) as $type) {
              ?>
                <button id="btn_<?= $type ?>" class="btn btn-outline-info test-type">
                  <?= $type ?>
                </button>
              <?php
              }                              ?>
            </div>
          </div>
          <?php
          function breaksStringIntoNewLine($words, $maxLength = 40)
          {
            $words = explode(' ', $words ?? '');
            $formattedValue = '';
            $currentLine = '';

            foreach ($words as $word) {
              if (strlen($currentLine) + strlen($word) > $maxLength) {
                $formattedValue .= $currentLine . '<br>';
                $currentLine = $word . ' ';
              } else {
                $currentLine .= $word . ' ';
              }
            }

            $formattedValue .= $currentLine;
            return rtrim($formattedValue);
          }

          foreach (json_decode($batch["types"]) as $key => $type) {
          ?>
            <div class="form-group tab-contentl <?= $key == 0 ? '' : 'd-none' ?>" id="tab_<?= $type ?>">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table>
                    <thead>
                      <?php
                      $tests = [];
                      if ($type == 'realtime') {
                        $tests = array_filter($batch["tests"], function ($test) {
                          return $test['type'] === 'realtime';
                        });
                      } elseif ($type == 'accelerated') {
                        $tests = array_filter($batch["tests"], function ($test) {
                          return $test['type'] === 'accelerated';
                        });
                      } elseif ($type == 'ongoing') {
                        $tests = array_filter($batch["tests"], function ($test) {
                          return $test['type'] === 'ongoing';
                        });
                      }
                      ?>
                      <?php
                      foreach ($tests as $test) {
                      ?>
                        <th class="py-3 px-6 text-left">
                          <?= $test["date"] ?><br>Bulan-<?= $test["month"] ?>
                        </th>
                      <?php
                      }
                      ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach ($tests as $test) { ?>
                          <td class="py-3 px-6 text-left">
                            <?php
                            if ($test["detail"]) {
                              $detailArray = json_decode($test["detail"], true);
                            } else {
                              $detailArray = ['-' => '-'];
                            }
                            ?>
                            <?php foreach ($detailArray as $key => $value) { ?>
                              <div class="form-group">
                                <span class="form-text font-weight-bolder">
                                  <?php echo ucwords(preg_replace(['/_[0-9]+/', '/_/'], ['', ' '], $key)) ?>
                                </span>
                                <span class="form-text">
                                  <?php echo breaksStringIntoNewLine($value[1] ?? '') ?>
                                </span>
                                <span class="form-text">
                                  <?php echo breaksStringIntoNewLine($value[0] ?? '') ?>
                                </span>
                              </div>
                            <?php } ?>
                          </td>
                        <?php } ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
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
    $('.test-type').on('click', function() {
      $('.tab-contentl').addClass('d-none');
      const targetTabId = $(this).attr('id').replace('btn', 'tab');
      $('#' + targetTabId).removeClass('d-none');
    });
  });
</script>
</body>

</html>