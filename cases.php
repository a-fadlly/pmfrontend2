<?php

include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
    header("Location: login");
} else {
    $accessCase   = json_decode(getCaseInfo('cases/start-cases'));
    $cases = json_decode(getCaseInfo('cases/participated/paged?limit=1000'));

    $participated = $cases->cases->data;
    $inbox = filterCases($cases->cases->data, 'TO_DO');
    $draft = filterCases($cases->cases->data, 'DRAFT');
    $paused = json_decode(getCaseInfo('cases/paused'));

//    print_r(json_encode($paused));
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
                                        <span class="navi-text">New Case</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="CreatePurchaseRequisition.php">Create Purchase Requisition</a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link nl" data-toggle="tab" href="#kt_tab_pane_1_4">
                                        <span class="navi-icon"><i class="fa-solid fa-inbox"></i></span>
                                        <span class="navi-text">Inbox</span>
                                        <span class="navi-label">
                                            <span class="label label-danger"><?= count($inbox) ?></span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link nl" data-toggle="tab" href="#kt_tab_pane_2_4">
                                        <span class="navi-icon"><i class="fa-solid fa-file-export"></i></span>
                                        <span class="navi-text">Particpatd</span>
                                        <span class="navi-label">
                                            <span class="label label-danger"><?= count($participated) ?></span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link nl" data-toggle="tab" href="#kt_tab_pane_3_4">
                                        <span class="navi-icon"><i class="fa-solid fa-pen"></i></span>
                                        <span class="navi-text">Draft</span>
                                        <span class="navi-label">
                                            <span class="label label-danger"><?= count($draft) ?></span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a class="navi-link nl" data-toggle="tab" href="#kt_tab_pane_4_4">
                                        <span class="navi-icon"><i class="fa-solid fa-pause"></i></span>
                                        <span class="navi-text">Paused</span>
                                        <span class="navi-label">
                                            <span class="label label-danger"><?= count($paused->cases) ?></span>
                                        </span>
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
                                        <h3 class="card-label">Inbox
                                            <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label>Process:
                                        <select class="form-control inbox-column-filter" data-column="2">
                                            <option value="">-</option>
                                            <option value="Purchase Request">Purchase Request</option>
                                            <option value="Test 3">Test 3</option>
                                            <option value="Test Input Qad">Test Input Qad</option>
                                            <option value="Test Input Qad (2)">Test Input Qad (2)</option>
                                        </select>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-vertical-center" id="inbox-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Case</th>
                                                    <th>Process</th>
                                                    <th>Task</th>
                                                    <th>Current User</th>
                                                    <th>Status</th>
                                                    <th>Due Date</th>
                                                    <th>Last Modification</th>
                                                    <!-- <th>Priority</th> -->
                                                    <th>Output Docs</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($inbox)) {
                                                    // var_dump(json_encode($inbox));
                                                    foreach ($inbox as $key => $d) {
                                                        $url = "";
                                                        if ($d->app_tas_title == "Departement Head Approval") {
                                                            $url = "ApprovalDeptHead.php?app_uid=" . $d->app_uid;
                                                        } else {
                                                            $url = "http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/" . $d->app_uid;
                                                        } ?>
                                                        <tr>
                                                            <td><a href="<?= $url ?>"><?= $d->app_number ?></a></td>
                                                            <td><?= $d->app_title ?></td>
                                                            <td><?= $d->app_pro_title ?></td>
                                                            <td><?= $d->app_tas_title ?></td>
                                                            <td><?= $d->app_current_user ?></td>
                                                            <td><?= $d->app_status_label ?></td>
                                                            <td><?= isOverdue($d->del_task_due_date) ?></td>
                                                            <td><?= $d->del_delegate_date ?></td>
                                                            <!-- <td><?= $d->del_priority ?></td> -->
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.8em;" data-toggle="modal" data-target="#exampleModal" data-app-uid="<?= $d->app_uid ?>">View</button>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }  ?>
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                    <div class="card-title">
                                        <h3 class="card-label">Participated
                                            <span class="d-block text-muted pt-2 font-size-sm">A participated case is a case in which a user has participated, meaning that the user worked on at least one task in the case</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label>Process:
                                        <select class="form-control participated-column-filter" data-column="2">
                                            <option value="">-</option>
                                            <option value="Purchase Request">Purchase Request</option>
                                            <option value="Test 3">Test 3</option>
                                            <option value="Test Input Qad">Test Input Qad</option>
                                            <option value="Test Input Qad (2)">Test Input Qad (2)</option>
                                        </select>
                                    </label>

                                    <label>Status:
                                        <select class="form-control participated-column-filter" data-column="5">
                                            <option value="">-</option>
                                            <option value="To do">To do</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Draft">Draft</option>
                                        </select>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-vertical-center" id="participated-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Case</th>
                                                    <th>Process</th>
                                                    <th>Task</th>
                                                    <th>Current User</th>
                                                    <th>Status</th>
                                                    <th>Due Date</th>
                                                    <th>Last Modification</th>
                                                    <!-- <th>Priority</th> -->
                                                    <th>Output Docs</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($participated)) {
                                                    foreach ($participated as $key => $d) {
                                                ?>
                                                        <tr>
                                                            <td><a href="http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/<?= $d->app_uid ?>"><?= $d->app_number ?></a></td>
                                                            <td><?= $d->app_title ?></td>
                                                            <td><?= $d->app_pro_title ?></td>
                                                            <td><?= $d->app_tas_title ?></td>
                                                            <td><?= $d->app_current_user ?></td>
                                                            <td><?= $d->app_status_label ?></td>
                                                            <td><?= isOverdue($d->del_task_due_date) ?></td>
                                                            <td><?= $d->del_delegate_date ?></td>
                                                            <!-- <td><?= $d->del_priority ?></td> -->
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.8em;" data-toggle="modal" data-target="#exampleModal" data-app-uid="<?= $d->app_uid ?>">
                                                                    View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }  ?>
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                    <div class="card-title">
                                        <h3 class="card-label">Draft
                                            <span class="d-block text-muted pt-2 font-size-sm">A case status changes to "draft" when the assigned user has started to work on the current task, but has not completed it</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label>Process:
                                        <select class="form-control draft-column-filter" data-column="2">
                                            <option value="">-</option>
                                            <option value="Purchase Request">Purchase Request</option>
                                            <option value="Test 3">Test 3</option>
                                            <option value="Test Input Qad">Test Input Qad</option>
                                            <option value="Test Input Qad (2)">Test Input Qad (2)</option>
                                        </select>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-vertical-center" id="draft-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Case</th>
                                                    <th>Process</th>
                                                    <th>Task</th>
                                                    <th>Current User</th>
                                                    <th>Status</th>
                                                    <th>Due Date</th>
                                                    <th>Last Modification</th>
                                                    <!-- <th>Priority</th> -->
                                                    <th>Output Docs</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($draft)) {
                                                    foreach ($draft as $key => $d) {
                                                ?>
                                                        <tr>
                                                            <td><a href="http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/<?= $d->app_uid ?>"><?= $d->app_number ?></a></td>
                                                            <td><?= $d->app_title ?></td>
                                                            <td><?= $d->app_pro_title ?></td>
                                                            <td><?= $d->app_tas_title ?></td>
                                                            <td><?= $d->app_current_user ?></td>
                                                            <td><?= $d->app_status_label ?></td>
                                                            <td><?= isOverdue($d->del_task_due_date) ?></td>
                                                            <td><?= $d->del_delegate_date ?></td>
                                                            <!-- <td><?= $d->del_priority ?></td> -->
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.8em;" data-toggle="modal" data-target="#exampleModal" data-app-uid="<?= $d->app_uid ?>">
                                                                    View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }  ?>
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_4_4" role="tabpanel" aria-labelledby="kt_tab_pane_4_4">
                                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                    <div class="card-title">
                                        <h3 class="card-label">Draft
                                            <span class="d-block text-muted pt-2 font-size-sm">A case status changes to "draft" when the assigned user has started to work on the current task, but has not completed it</span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label>Process:
                                        <select class="form-control draft-column-filter" data-column="2">
                                            <option value="">-</option>
                                            <option value="Purchase Request">Purchase Request</option>
                                            <option value="Test 3">Test 3</option>
                                            <option value="Test Input Qad">Test Input Qad</option>
                                            <option value="Test Input Qad (2)">Test Input Qad (2)</option>
                                        </select>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-vertical-center" id="draft-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Case</th>
                                                <th>Process</th>
                                                <th>Task</th>
                                                <th>Current User</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>Last Modification</th>
                                                <!-- <th>Priority</th> -->
                                                <th>Output Docs</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (!empty($paused)) {
                                                foreach ($paused->cases as $key => $d) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/<?= $d->app_uid ?>"><?= $d->app_number ?></a>
                                                        </td>
                                                        <td><?= $d->app_title ?></td>
                                                        <td><?= $d->app_pro_title ?></td>
                                                        <td><?= $d->app_pro_title ?></td>
                                                        <td><?= $d->app_tas_title ?></td>
                                                        <td><?= $d->app_current_user ?></td>
                                                        <td><?= $d->app_status_label ?></td>
                                                        <td><?= isOverdue($d->del_task_due_date) ?></td>
                                                        <td><?= $d->del_delegate_date ?></td>
                                                        <!-- <td><?= $d->del_priority ?></td> -->
                                                        <td>
                                                            <button type="button"
                                                                    class="btn btn-sm btn-outline-primary py-0"
                                                                    style="font-size: 0.8em;" data-toggle="modal"
                                                                    data-target="#exampleModal"
                                                                    data-app-uid="<?= $d->app_uid ?>">
                                                                View
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Output Documents</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="modal-content"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
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
<script>
    $(document).ready(function() {
        var inboxTable = $('#inbox-table').DataTable({
            "order": [0, 'desc']
        });
        $('.inbox-column-filter').on('keyup change', function() {
            var columnIndex = $(this).data('column');
            var filterValue = $(this).val();

            inboxTable.column(columnIndex).search(filterValue).draw();
        });

        var participatedTable = $('#participated-table').DataTable({
            "order": [0, 'desc']
        });
        $('.participated-column-filter').on('keyup change', function() {
            var columnIndex = $(this).data('column');
            var filterValue = $(this).val();

            participatedTable.column(columnIndex).search(filterValue).draw();
        });

        var draftTable = $('#draft-table').DataTable({
            "order": [0, 'desc']
        });

        $('.draft-column-filter').on('keyup change', function() {
            var columnIndex = $(this).data('column');
            var filterValue = $(this).val();

            draftTable.column(columnIndex).search(filterValue).draw();
        });

        $('.view-button').on('click', function() {
            var appUid = $(this).data('app-uid');
            var modalContent = $('#modal-content');

            modalContent.empty();

            $.ajax({
                url: 'api_request.php',
                type: 'GET',
                data: {
                    app_uid: appUid
                },
                dataType: 'json',
                success: function(response) {
                    var cases = response.cases;

                    for (var i = 0; i < cases.length; i++) {
                        var link = $('<a>', {
                            href: "http://192.168.1.244:8000/sysworkflow/en/neoclassic/" + cases[i].app_doc_link,
                            text: cases[i].app_doc_filename
                        });

                        var lineBreak = $('<br>');

                        modalContent.append(link, lineBreak);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.nl').on('click', function(e) {
            e.preventDefault();

            if (!$(this).hasClass('active')) {
                $('.nl').removeClass('active');
                $(this).addClass('active');

                var targetPaneId = $(this).attr('href');

                $('.tab-pane').removeClass('show active');
                $(targetPaneId).addClass('show active');
            }
        });
    });
</script>

<?php include 'common/footer.php' ?>