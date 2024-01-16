<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);
$products = $reminderQCController->getProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $batch_number = $_POST['batch_number'];
    $mfg_date = $_POST['mfg_date'];
    $exp_date = $_POST['exp_date'];
    $sample_date = $_POST['sample_date'];

    $types = isset($_POST['types']) ? $_POST['types'] : array();

    $storage_conditions = json_encode(array(
        'realtime' => $_POST['realtimeInput'] ?? "",
        'accelerated' => $_POST['acceleratedInput'] ?? "",
        'ongoing' => $_POST['ongoingInput'] ?? ""
    ));

    $packaging_type = $_POST['packaging_type'];

    $batch_id = $reminderQCController->createBatch($product_id, $batch_number, $mfg_date, $exp_date, $sample_date, json_encode($types), $storage_conditions, $packaging_type);
    if ($batch_id == false) {
        echo "Error adding item.";
    } else {
        if ($reminderQCController->createTestsByBatch($batch_id, new DateTime($sample_date), new DateTime($exp_date), $types)) {
            header('Location: Products.php');
            exit();
        }
    }
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
                        <h3 class="card-label">Create Batch
                            <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>

                        </h3>
                    </div>
                </div>
                <form class="form" method="post" action="CreateBatch.php">
                    <div class="card-body">
                        <div class="form-group row ">
                            <div class="col-lg-6">
                                <label>Product:</label>
                                <select id="product_id" name="product_id" class="form-control">
                                    <option>-</option>
                                    <?php foreach ($products as $product) { ?>
                                        <option value="<?= $product["id"] ?>"><?= $product["number"] ?> <?= $product["name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Batch Number:</label>
                                <input id="batch_number" name="batch_number" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-4">
                                <label>Mfg Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    <input id="mfg_date" name="mfg_date" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>Exp Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    <input id="exp_date" name="exp_date" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>Sample Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    <input id="sample_date" name="sample_date" type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tipe Test:</label>
                                    <div class="checkbox-list">
                                        <label class="checkbox">
                                            <input id="realtime" name="types[]" type="checkbox" class="toggle-input" data-target="realtime" value="realtime" />
                                            <span></span>Realtime
                                        </label>
                                        <label class="checkbox">
                                            <input id="accelerated" name="types[]" type="checkbox" class="toggle-input" data-target="accelerated" value="accelerated" />
                                            <span></span>Accelerated
                                        </label>
                                        <label class="checkbox">
                                            <input id="ongoing" name="types[]" type="checkbox" class="toggle-input" data-target="ongoing" value="ongoing" />
                                            <span></span>On-going
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row realtime-input">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kondisi Penyimpanan (Realtime):</label>
                                    <input type="text" id="realtimeInput" name="realtimeInput" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row accelerated-input">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kondisi Penyimpanan (Accelerated):</label>
                                    <input type="text" id="acceleratedInput" name="acceleratedInput" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ongoing-input">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kondisi Penyimpanan (On-going):</label>
                                    <input type="text" name="ongoingInput" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Jenis Kemasan:</label>
                                    <input id="packaging_type" id="packaging_type" name="packaging_type" type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
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
<script>
    $(document).ready(function() {
        function handleToggle() {
            var target = $(this).data('target');
            $('.' + target + '-input').toggle(this.checked);
        }

        $('.realtime-input, .accelerated-input, .ongoing-input').hide();

        $('.toggle-input').change(handleToggle);

        $('.toggle-input').each(handleToggle);
    });
</script>
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
            $('#mfg_date').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                format: "yyyy-mm-dd"
            });
            $('#exp_date').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                format: "yyyy-mm-dd"
            });
            $('#sample_date').datepicker({
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

    KTBootstrapDatepicker.init();
</script>
</body>

</html>