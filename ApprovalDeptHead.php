<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
  header("Location: login.php");
} else {
  $app_uid = $_REQUEST['app_uid'];
  $accessCase   = json_decode(getCaseInfo('cases/start-cases'));
  // $variables   = json_decode(getCaseInfo('cases/55990600565864968157623069715941/variables'));
  $variables   = json_decode(getCaseInfo('cases/' . $app_uid . '/variables'));

  //var_dump($variables);
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
            <a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Approval Dept Head</a>
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
              <h3 class="card-title">Departement Head Approval</h3>
            </div>
            <!--begin::Form-->
            <form id="form" class="form">
              <div class="card-body p-15">
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Info:</h3>
                <div class="form-group row ">
                  <div class="col-lg-4">
                    <label>Requisition Number:</label>
                    <p><strong><?= $variables->cases->rqm_nbr_label ?></strong></p>
                  </div>
                  <div class="col-lg-4">
                    <label>Ship To:</label>
                    <p><strong><?= $variables->cases->rqm_ship_label ?></strong></p>
                  </div>
                  <div class="col-lg-4">
                    <label>Entity:</label>
                    <p><strong><?= $variables->cases->rqm_entity_label ?></strong></p>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-4">
                    <label>Requisition Date:</label>
                    <p><strong><?= $variables->cases->rqm_req_date ?></strong></p>
                  </div>
                  <div class="col-lg-4">
                    <label>Need Date:</label>
                    <p><strong><?= $variables->cases->rqm_need_date ?></strong></p>
                  </div>
                  <div class="col-lg-4">
                    <label>Due Date:</label>
                    <p><strong><?= $variables->cases->rqm_due_date ?></strong></p>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-4">
                    <label>Reason:</label>
                    <p><strong><?= $variables->cases->rqm_reason ?></strong></p>
                  </div>
                  <div class="col-lg-4">
                    <label>Cost Center:</label>
                    <p><strong><?= $variables->cases->rqm_cc ?></strong></p>
                  </div>
                  <div class="col-lg-4">
                    <label>Remarks:</label>
                    <p><strong><?= $variables->cases->rqm_rmks ?></strong></p>
                  </div>
                </div>
                <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Items:</h3>
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
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $gridDetailsArray = (array)$variables->cases->gridDetails;
                          if (isset($gridDetailsArray["1"])) {

                            foreach ($variables->cases->gridDetails as $id => $item) : ?>
                              <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $item->rqd_part_list_label ?></td>
                                <td><?php echo $item->rqd_part_desc1_list_label ?></td>
                                <td><?php echo $item->rqd_req_qty_list_label ?></td>
                                <td><?php echo $item->rqd_um_list_label ?></td>
                                <td><?php echo $item->rqd_due_date_list_label ?></td>
                                <td><?php echo $item->rqd_need_date_list_label ?></td>
                                <td><?php echo $item->rqd_acct_desc_list ?></td>
                                <td><?php echo $item->comment_line_list_label ?></td>
                              </tr>
                          <?php endforeach;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Purchase Request Analysis:</label>
                    <p><strong><?= $variables->cases->catatan_analisa ?></strong></p>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Do you approve this?</label>
                    <div class="radio-inline">
                      <label class="radio">
                        <input type="radio" name="approvalDeptHead" value="1" />
                        <span></span>Yes</label>
                      <label class="radio">
                        <input type="radio" name="approvalDeptHead" value="0" />
                        <span></span>No, please revise</label>
                      <label class="radio">
                        <input type="radio" name="approvalDeptHead" value="2" />
                        <span></span>Reject</label>
                    </div>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-lg-12">
                    <label>Your Comment:</label>
                    <textarea class="form-control" id="depthead_notes"></textarea>
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
  $(document).ready(function() {
    $('#form').submit(function(event) {
      event.preventDefault();

      var isApprovedValue = $('input[name="approvalDeptHead"]:checked').val();
      var selectedLabel = $('input[name="approvalDeptHead"]:checked').closest('label').text().trim();

      var oVars = {
        "approvalDeptHead": isApprovedValue,
        "approvalDeptHead_label": selectedLabel,
        'depthead_notes': $('#depthead_notes').val(),
        'depthead_notes_label': $('#depthead_notes').val(),
      };
      pmRestRequest("PUT", "/api/1.0/workflow/cases/<?= $app_uid ?>/variable?del_index=2", false, oVars);
      if (httpStatus === 200 || httpStatus === 201 || httpStatus === 204) {
        pmRestRequest("PUT", "/api/1.0/workflow/cases/<?= $app_uid ?>/route-case", false, null);
        if (httpStatus === 200 || httpStatus === 204) {
          window.location.href = "cases.php";
        }
      }
    });
  });
</script>
<script type="text/javascript" src="assets/js/functions.js"></script>
<?php include 'common/footer.php' ?>