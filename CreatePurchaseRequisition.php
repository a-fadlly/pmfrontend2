<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
  header("Location: login.php");
} else {
  $accessCase   = json_decode(getCaseInfo('cases/start-cases'));
}
?>

<?php include 'common/header.php' ?>
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
            <a href="index.php" class="text-white text-hover-white opacity-75 hover-opacity-100">Cases</a>
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
            <form id="form" class="form">
              <div class="card-body p-15">
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Info:</h3>
                <div class="form-group row ">

                  <input type="hidden" id="usr_uid" value="<?= $_SESSION['usr_uid'] ?>">
                  <input type="hidden" id="usr_firstname" value="<?= $_SESSION['usr_firstname'] ?>">
                  <input type="hidden" id="usr_lastname" value="<?= $_SESSION['usr_lastname'] ?>">
                  <input type="hidden" id="usr_position" value="<?= $_SESSION['usr_position'] ?>">

                  <div class="col-lg-4">
                    <label>Requisition Number:</label>
                    <input type="text" class="form-control" id="rqm_nbr" />
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <label>Ship To:</label>
                    <input type="text" class="form-control" value="MTM2" id="rqm_ship" disabled />
                  </div>
                  <div class="col-lg-4">
                    <label>Entity:</label>
                    <input type="text" class="form-control" value="MTM2" id="rqm_entity" disabled />
                  </div>
                </div>
                <div class="form-group row ">
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
                <div class="form-group row ">
                  <div class="col-lg-4">
                    <label>Reason:</label>
                    <input type="text" class="form-control" id="rqm_reason" />
                  </div>
                  <div class="col-lg-4">
                    <label>Cost Center:</label>
                    <input type="text" class="form-control" id="rqm_cc" />
                  </div>
                  <div class="col-lg-4">
                    <label>Remarks:</label>
                    <input type="text" class="form-control" id="rqm_rmks" />
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Comment header:</label>
                    <textarea class="form-control" id="comment_header"></textarea>
                  </div>
                </div>
                <!-- item -->
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Items:</h3>
                <div class="form-group row ">
                  <div class="col-lg-4">
                    <label>Item Number:</label>
                    <input type="text" class="form-control" id="rqd_part_placeholder_list" />
                    <div id="autocomplete-results"></div>
                  </div>
                  <input type="hidden" id="rqd_part_list">
                  <input type="hidden" id="rqd_desc_list">
                  <div class="col-lg-4">
                    <label>Quantity:</label>
                    <input type="text" class="form-control" id="rqd_req_qty_list" />
                  </div>
                  <div class="col-lg-4">
                    <label>Unit of Measure:</label>
                    <input type="text" class="form-control" id="rqd_um_list" disabled />
                  </div>
                </div>
                <div class="form-group row ">
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
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Comment:</label>
                    <textarea class="form-control" id="comment_line_list"></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <button type="button" class="btn btn-primary btn-pill btn-sm" onclick="addGridDetail()">Add</button>
                  </div>
                </div>
                <div class="form-group row ">
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
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Supporting documents:</label>
                    <input type="file" name="attchment[]" id="attchment" multiple="multiple" size="40" class="form-control">
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Purchase Request Analysis:</label>
                    <textarea class="form-control" id="catatan_analisa"></textarea>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
        templates: arrows,
        format: "yyyy-mm-dd"
      });
      $('#rqm_need_date').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
        format: "yyyy-mm-dd"
      });
      $('#rqm_due_date').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
        format: "yyyy-mm-dd"
      });
      $('#rqd_due_date_list').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
        format: "yyyy-mm-dd"
      });
      $('#rqd_need_date_list').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        templates: arrows,
        format: "yyyy-mm-dd"
      });
    }

    return {
      init: function() {
        demos();
      }
    };
  }();
</script>
<script>
  $(document).ready(function() {
    $('#rqd_part_placeholder_list').on('input', function() {
      const resultsContainer = $('#autocomplete-results');
      const input = $('#rqd_part_placeholder_list').val();
      if (input.length === 0) {
        resultsContainer.hide();
      } else {
        resultsContainer.empty();

        $.ajax({
          url: `api/fetch_items.php?input=${input}`,
          method: 'GET',
          dataType: 'json',
          success: function(data) {
            data.forEach(item => {
              const resultDiv = $('<div class="result"></div>');
              resultDiv.text(item.PT_PART + " " + item.PT_DESC1_2);
              resultDiv.on('click', function() {
                $('#rqd_part_placeholder_list').val(item.PT_PART + " " + item.PT_DESC1_2);
                $('#rqd_part_list').val(item.PT_PART);
                $('#rqd_desc_list').val(item.PT_DESC1_2);
                $('#rqd_um_list').val(item.PT_PVM_UM);

                resultsContainer.hide();
              });

              resultsContainer.append(resultDiv);
            });

            resultsContainer.show();
          },
          error: function(error) {
            console.error('Error fetching data:', error);
          }
        });
      }
    });

    KTBootstrapDatepicker.init();

    var gridDetailsTable = $('#grid-details-table').DataTable({
      "dom": 'rtip',
      "ordering": false
    })
    var line = 1;

    window.addGridDetail = function() {
      var rqd_part_list = $('#rqd_part_list').val();
      var rqd_desc_list = $('#rqd_desc_list').val();
      var rqd_req_qty_list = $('#rqd_req_qty_list').val();
      var rqd_um_list = $('#rqd_um_list').val();
      var rqd_due_date_list = $('#rqd_due_date_list').val();
      var rqd_need_date_list = $('#rqd_need_date_list').val();
      var rqd_acct_list = $('#rqd_acct_list').val();
      var comment_line_list = $('#comment_line_list').val();

      if (typeof rqd_part_list === "string" && rqd_part_list.length === 0) {

      } else {
        gridDetailsTable.row.add([
            line++,
            rqd_part_list,
            rqd_desc_list,
            rqd_req_qty_list,
            rqd_um_list,
            rqd_due_date_list,
            rqd_need_date_list,
            rqd_acct_list,
            comment_line_list,
            '<a href="javascript:;" title="Delete" onclick="deleteGridDetail(this);return false;"><span class="svg-icon svg-icon-md"><i class="fa-solid fa-trash"></i></span></a>'
          ])
          .draw();

        $('#rqd_part_list').val('');
        $('#rqd_part_placeholder_list').val('');
        $('#rqd_desc_list').val('');
        $('#rqd_req_qty_list').val('');
        $('#rqd_um_list').val('');
        $('#rqd_due_date_list').val('');
        $('#rqd_need_date_list').val('');
        $('#rqd_acct_list').val('');
        $('#comment_line_list').val('');
      }
    };

    window.deleteGridDetail = function(button) {
      var row = gridDetailsTable.row($(button).parents('tr'));
      row.remove().draw();

      var data = gridDetailsTable.rows().data();
      data.each(function(value, index) {
        value[0] = index + 1;
      });

      line = data.length + 1;

      gridDetailsTable.clear().rows.add(data).draw();
    };

    $('#form').submit(function(event) {
      event.preventDefault();

      var gridDetails = {};
      gridDetailsTable.rows().data().each(function(value) {
        var rowObject = {
          "rqd_line_list": value[0],
          "rqd_line_list_label": value[0],

          'rqd_part_list': value[1],
          'rqd_part_list_label': value[1],

          'rqd_part_desc1_list': value[2],
          'rqd_part_desc1_list_label': value[2],

          'rqd_part_desc2_list': "",
          'rqd_part_desc2_list_label': "",

          'rqd_req_qty_list': value[3],
          'rqd_req_qty_list_label': value[3],

          'rqd_um_list': value[4],
          'rqd_um_list_label': value[4],

          'rqd_due_date_list': value[5],
          'rqd_due_date_list_label': "2023-12-23",

          'rqd_need_date_list': value[6],
          'rqd_need_date_list_label': "2023-12-23",

          'comment_line_list': value[8],
          'comment_line_list_label': value[8],

          "rqd_acct_desc_list": value[7],
          "rqd_acct_desc_list_label": value[7],

          "stock_list": "0",
          "stock_list_label": "0",

          "pending_list": "",
          "pending_list_label": ""
        };
        gridDetails[value[0]] = rowObject;
      });

      var formData = new FormData(this);
      formData.append('inp_doc_uid', '1980285646582494f2b7e82078653904');
      formData.append('tas_uid', '748046875657abcb8542ad2026098740');
      formData.append('app_doc_comment', 'comment');
      formData.append('variable_name', 'attchment');
      formData.append('pro_uid', '541076660657abcb7a26827010180338');
      formData.append('dynaform_uid', '869628906657abcb9443954046901516');
      formData.append('usr_uid', $('#usr_uid').val());
      formData.append('form', $('#attchment').get(0).files);
      formData.append('variables', JSON.stringify([{

        "namaPengaju": $('#usr_firstname').val() + ' ' + $('#usr_lastname').val(),
        "namaPengaju_label": $('#usr_firstname').val() + ' ' + $('#usr_lastname').val(),

        "tglsubmit": getCurrentDateTime(),

        'rqm_nbr': $('#rqm_nbr').val(),
        'rqm_nbr_label': $('#rqm_nbr').val(),

        'rqm_ship': $('#rqm_ship').val(),
        'rqm_ship_label': $('#rqm_ship').val(),

        'rqm_entity': $('#rqm_entity').val(),
        'rqm_entity_label': $('#rqm_entity').val(),

        'rqm_req_date': $('#rqm_req_date').val(),
        'rqm_req_date_label': $('#rqm_req_date').val(),

        'rqm_need_date': $('#rqm_need_date').val(),
        'rqm_need_date_label': $('#rqm_need_date').val(),

        'rqm_due_date': $('#rqm_due_date').val(),
        'rqm_due_date_label': $('#rqm_due_date').val(),

        'rqm_rmks': $('#rqm_rmks').val(),
        'rqm_rmks_label': $('#rqm_rmks').val(),

        'rqm_rqby_userid': $('#usr_position').val() ?? "mfg",
        'rqm_rqby_userid_label': $('#usr_position').val() ?? "mfg",

        'rqm_domain': $('#rqm_ship').val(),
        'rqm_domain_label': $('#rqm_ship').val(),

        'rqm_end_userid': $('#usr_position').val() ?? "mfg",
        'rqm_end_userid_label': $('#usr_position').val() ?? "mfg",

        'rqm_reason': $('#rqm_reason').val(),
        'rqm_reason_label': $('#rqm_reason').val(),

        'rqm_cc': $('#rqm_cc').val(),
        'rqm_cc_label': $('#rqm_cc').val(),

        "comment_header": $('#comment_header').val(),
        "comment_header_label": $('#comment_header').val(),

        "gridDetails": gridDetails,

        "catatan_analisa": $('#catatan_analisa').val(),
        "catatan_analisa_label": $('#catatan_analisa').val(),
      }]));

      $.ajax({
        type: "POST",
        url: "api/api_CreateCase.php",
        data: formData,
        success: function(result) {
          console.log(result);
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
  });
</script>
<script type="text/javascript" src="assets/js/functions.js"></script>
<?php include 'common/footer.php' ?>