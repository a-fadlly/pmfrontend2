<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);
$products = $reminderQCController->getProductsThatHaveBatch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $reminderQCController->inputTestSample($_POST, $_POST['month']);
}
?>
<?php include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">

        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          <div class="card-title">
            <h3 class="card-label">Form Serah Terima Sample
              <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
            </h3>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-lg-6">
              <label>Pemberi:</label>
              <input id="user" name="user" type="text" class="form-control" />
            </div>
            <div class="col-lg-6">
              <label>Penerima:</label>
              <input id="target" name="target" type="text" class="form-control" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-5">
              <label>Product:</label>
              <select id="product_id" name="product_id" class="form-control">
                <option>-</option>
                <?php foreach ($products as $product) { ?>
                  <option value="<?= $product["id"] ?>"><?= $product["number"] ?> <?= $product["name"] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-3">
              <label>Batch:</label>
              <select id="batch_id" name="batch_id" class="form-control">
                <option>-</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label>Bulan:</label>
              <select id="month" name="month" class="form-control">
                <option>-</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12">
              <label>TTD:</label>
              <div class="mx-auto">
                <canvas id="signature" class="border border-gray-400"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-lg-12">
              <button onclick="submit()" class="btn btn-primary mr-2">Save</button>
              <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
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
  var canvas = $('#signature')[0];
  var parentHeight = $(canvas).parent().outerHeight();

  canvas.setAttribute("height", parentHeight);
  var signaturePad = new SignaturePad(canvas);

  function clearSignature() {
    signaturePad.clear();
  }

  function submit() {
    var user = $('#user').val() || '';
    var target = $('#target').val() || '';
    var month = $('#month').val() || '';
    var signatureData = signaturePad.toDataURL();

    $.ajax({
      type: 'POST',
      url: 'FormSample.php',
      data: {
        user: user,
        target: target,
        id: month,
        signature_data: signatureData,

      },
      success: function(response) {
        window.location.href = "Calendar.php";
      },
      error: function(error) {
        console.error(error);
      }
    });
  }

  $(document).ready(function() {
    var inputBatch = $('#batch_id');
    var inputTest = $('#month');

    $('#product_id').change(function() {
      inputBatch.empty();
      inputBatch.append('<option>-</option>');

      inputTest.empty();
      inputTest.append('<option>-</option>');

      var id = $(this).val();
      $.ajax({
        type: 'GET',
        url: '../api/fetch_batches_by_product.php?id=' + id,
        success: function(data) {
          inputBatch.empty();
          inputBatch.append('<option>-</option>');
          $.each(data, function(index, batch) {
            inputBatch.append('<option value="' + batch.id + '">' + batch.batch_number + '</option>');
          });
        },
        error: function(error) {
          console.error(error);
        }
      });
    });

    $('#batch_id').change(function() {
      inputTest.empty();
      inputTest.append('<option>-</option>');

      var id = $(this).val();
      $.ajax({
        type: 'GET',
        url: '../api/fetch_tests_by_batch.php?id=' + id,
        success: function(data) {
          inputTest.empty();
          inputTest.append('<option>-</option>');
          $.each(data.tests, function(index, test) {
            inputTest.append('<option value="' + test.id + '">' + test.month + ' ' + test.type + '</option>');
          });
        },
        error: function(error) {
          console.error(error);
        }
      });
    });
  });
</script>
</body>

</html>