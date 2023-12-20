<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
    header("Location: ../login");
} else {
    $accessCase   = json_decode(getCaseInfo('cases/start-cases'));
    $inbox        = json_decode(getCaseInfo('cases/paged?limit=100'));
    $draft        = json_decode(getCaseInfo('cases/draft/paged?limit=100'));
    $participated = json_decode(getCaseInfo('cases/participated/paged?limit=100'));
}
?>

<?php include 'common/header.php' ?>

<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
    <div class="card">
        <div class="card-header" style="padding-top: 10px;padding-bottom: 0px;">
            <h4 class="mt-0 header-title mb-5"><i class="mdi mdi-email"></i> Draft Case</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                $appTitles = array_unique(array_column($draft->cases->data, 'app_pro_title'));
                $appTitles = array_filter($appTitles);
                sort($appTitles);
                ?>

                <label>Process:
                    <select class="form-control column-filter" data-column="2">
                        <option value="">-</option>
                        <?php foreach ($appTitles as $appTitle) { ?>
                            <option value="<?php echo htmlspecialchars($appTitle) ?>"><?php echo htmlspecialchars($appTitle) ?></option>
                        <?php } ?>
                    </select>
                </label>
                <table id="myTable" data-page-length="25" class="table table-separate table-head-custom table-checkable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Case</th>
                            <th>Process</th>
                            <th>Task</th>
                            <th>Current User</th>
                            <th>Previous User</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Last Modification</th>
                            <th>Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($draft)) {
                            foreach ($draft->cases->data as $key => $d) {
                        ?>
                                <tr>
                                    <td><a href="<?= $d->app_uid ?>"><?= $d->app_number ?></a></td>
                                    <td><?= $d->app_title ?></td>
                                    <td><?= $d->app_pro_title ?></td>
                                    <td><?= $d->app_tas_title ?></td>
                                    <td><?= $d->app_current_user ?></td>
                                    <td><?= $d->app_del_previous_user ?></td>
                                    <td><?= $d->app_status ?></td>
                                    <td><?= $d->del_task_due_date ?></td>
                                    <td><?= $d->del_delegate_date ?></td>
                                    <td><?= $d->del_priority ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'common/footer.php' ?>

<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "order": [0, 'desc']
        });

        // Add event listener for each column filter
        $('.column-filter').on('keyup change', function() {
            var columnIndex = $(this).data('column');
            var filterValue = $(this).val();

            // Apply the filter to the specific column
            table.column(columnIndex).search(filterValue).draw();
        });
    });
</script>
</body>

</html>