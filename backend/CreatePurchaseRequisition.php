<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
  header("Location: ../login");
} else {
  $accessCase   = json_decode(getCaseInfo('cases/start-cases'));
  $participated = json_decode(getCaseInfo('cases/participated/paged?limit=1000'));

  $inbox = filterCases($participated->cases->data, 'TO_DO');
  $draft = filterCases($participated->cases->data, 'DRAFT');
}
?>

<?php include 'common/header2.php' ?>
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
            <a href="index" class="text-white text-hover-white opacity-75 hover-opacity-100">Cases</a>
            <!--end::Item-->
            <!--begin::Item-->
            <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
            <a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Create Purchase Requisition</a>
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
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
              <h3 class="card-title">Create Purchase Requisition</h3>
            </div>
            <!--begin::Form-->
            <form class="form">
              <div class="card-body">
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Info:</h3>
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label>Requisition Number:</label>
                    <input type="text" class="form-control" />
                  </div>
                  <div class="col-lg-4">
                    <label>Ship To:</label>
                    <input type="text" class="form-control" value="MTM2" disabled />
                  </div>
                  <div class="col-lg-4">
                    <label>Entity:</label>
                    <input type="text" class="form-control" value="MTM2" disabled />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label>Requisition Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa-solid fa-calendar-days"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="rqm_req_date" />
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <label>Need Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa-solid fa-calendar-days"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="rqm_need_date" />
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <label>Due Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa-solid fa-calendar-days"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="rqm_due_date" />
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label>Reason :</label>
                    <input type="text" class="form-control" />
                  </div>
                  <div class="col-lg-4">
                    <label>Cost Center:</label>
                    <input type="text" class="form-control" />
                  </div>
                  <div class="col-lg-4">
                    <label>Remarks:</label>
                    <input type="text" class="form-control" />
                  </div>
                </div>
                <!-- item -->
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Item:</h3>
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label>Item Number:</label>
                    <input type="text" class="form-control" id="rqd_part_list" />
                  </div>
                  <div class="col-lg-4">
                    <label>Quantity:</label>
                    <input type="text" class="form-control" id="rqd_req_qty_list" />
                  </div>
                  <div class="col-lg-4">
                    <label>Unit of Measure:</label>
                    <input type="text" class="form-control" id="rqd_um_list" />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-4">
                    <label>Requisition Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa-solid fa-calendar-days"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="rqd_due_date_list" />
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <label>Need Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa-solid fa-calendar-days"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control" id="rqd_need_date_list" />
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <label>Purchase Account:</label>
                    <input type="text" class="form-control" id="rqd_acct_list" />
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <label>Comment:</label>
                    <textarea class="form-control" id="comment_line_list"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <button type="button" class="btn btn-primary" onclick="addGridDetail()">Add</button>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <table class="table table-head-custom table-vertical-center" id="grid-details-table">
                        <thead>
                          <tr>
                            <th>Line</th>
                            <th>Item Number</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Due Date</th>
                            <th>Need Date</th>
                            <th>Account</th>
                            <th>Comment</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data will be inserted here dynamically -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-8">
                    <button type="reset" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                  </div>
                </div>
              </div>
            </form>
            <!--end::Form-->
          </div>
        </div>
      </div>
    </div>
    <!--end::Container-->
  </div>
  <!--end::Entry-->
</div>
<!--end::Content-->
<script>
  var KTBootstrapDatepicker = function() {

    var arrows;
    if (KTUtil.isRTL()) {
      arrows = {
        leftArrow: '<i class="fa-solid fa-angle-right"></i>',
        rightArrow: '<i class="fa-solid fa-angle-left"></i>'
      }
    } else {
      arrows = {
        leftArrow: '<i class="fa-solid fa-angle-left"></i>',
        rightArrow: '<i class="fa-solid fa-angle-right"></i>'
      }
    }

    var demos = function() {
      $('#rqm_req_date').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows
      });
      $('#rqm_need_date').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows
      });
      $('#rqm_due_date').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows
      });
      $('#rqd_due_date_list').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows
      });
      $('#rqd_need_date_list').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows
      });
    }

    return {
      init: function() {
        demos();
      }
    };
  }();

  $(document).ready(function() {
    KTBootstrapDatepicker.init();

    var gridDetailsTable = $('#grid-details-table').DataTable({
      "dom": 'rtip',
      "ordering": false
    })
    var line = 1;

    window.addGridDetail = function() {
      var rqd_part_list = $('#rqd_part_list').val();
      var rqd_req_qty_list = $('#rqd_req_qty_list').val();
      var rqd_um_list = $('#rqd_um_list').val();
      var rqd_due_date_list = $('#rqd_due_date_list').val();
      var rqd_need_date_list = $('#rqd_need_date_list').val();
      var rqd_acct_list = $('#rqd_acct_list').val();
      var comment_line_list = $('#comment_line_list').val();

      gridDetailsTable.row.add([
          line++,
          rqd_part_list,
          'description',
          rqd_req_qty_list,
          rqd_um_list,
          rqd_due_date_list,
          rqd_need_date_list,
          rqd_acct_list,
          comment_line_list,
          '<a href="javascript:;" title="Delete" onclick="deleteRow(this);return false;"><span class="svg-icon svg-icon-md"><i class="fa-solid fa-trash"></i></span></a>'
        ])
        .draw();

      $('#rqd_part_list').val('');
      $('#rqd_req_qty_list').val('');
      $('#rqd_um_list').val('');
      $('#rqd_due_date_list').val('');
      $('#rqd_need_date_list').val('');
      $('#rqd_acct_list').val('');
      $('#comment_line_list').val('');
    };

    window.deleteRow = function(button) {
      var row = gridDetailsTable.row($(button).parents('tr'));
      row.remove().draw();

      var data = gridDetailsTable.rows().data();
      data.each(function(value, index) {
        value[0] = index + 1;
      });

      line = data.length + 1;

      gridDetailsTable.clear().rows.add(data).draw();
    };
  });
</script>
<?php include 'common/footer2.php' ?>