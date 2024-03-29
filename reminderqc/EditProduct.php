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
$product = $reminderQCController->getProduct($_GET['id']);

$data = json_decode($product['variables']);


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = $_POST['id'];
//     $number = $_POST['number'];
//     $name = $_POST['name'];
//     $variables = $_POST['variables'];

//     if ($reminderQCController->editProduct($id, $number, $name, $variables)) {
//         header('Location: Products.php');
//         exit();
//     } else {
//         echo "Error adding item.";
//     }
// }
?>
<?php include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Edit Product
                            <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row ">
                        <input type="hidden" id="id" name="id" value="<?= $_GET['id'] ?>" />
                        <div class="col-lg-6">
                            <label>Item Number:</label>
                            <input id="number" name="number" type="text" class="form-control" value="<?= $product["number"] ?>" />
                        </div>
                        <div class="col-lg-6">
                            <label>Product Name:</label>
                            <input id="name" name="name" type="text" class="form-control" value="<?= $product["name"] ?>" />
                        </div>
                    </div>
                    <div id="jsonInput">

                    </div>
                    <button type="button" class="btn btn-sm btn-info" onclick="addRow()">Add Row</button>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary mr-2" onclick="saveChanges()">Save</button>
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
    var jsonData = <?php echo json_encode($data); ?>;

    if (jsonData == null) jsonData = [];

    function addRow() {
        jsonData.push({
            variable: "",
            specification: ""
        });
        displayData();
    }

    function displayData() {
        var html = "";
        for (var i = 0; i < jsonData.length; i++) {
            html += '<div class="form-group row form-loop">';
            html += '<div class="col-lg-5">';
            html += '<label for="variable">Variable:</label>';
            html += '<input type="text" class="form-control input-variable" name="variable[]" value="' + jsonData[i].variable + '">';
            html += '</div>';
            html += '<div class="col-lg-5">';
            html += '<label for="specification">Specification:</label>';
            html += '<textarea type="text" class="form-control input-specification" name="specification[]">' + jsonData[i].specification + '</textarea>';
            html += '</div>';
            html += '<div class="col-lg-2">';
            html += '<br>';
            html += '<button type="button" class="btn btn-sm btn-danger" onclick="removeRow(' + i + ')">Remove</button>';
            html += '</div>';
            html += '</div>';
        }
        document.getElementById('jsonInput').innerHTML = html;
    }

    function removeRow(index) {
        jsonData.splice(index, 1);
        displayData();
    }

    function cleanString(inputString) {
        // Remove new lines
        let stringWithoutNewLines = inputString.replace(/(\r\n|\n|\r)/gm, '');

        // Remove extra spaces
        let stringWithoutExtraSpaces = stringWithoutNewLines.replace(/\s+/g, ' ');

        // Trim leading and trailing spaces
        let trimmedString = stringWithoutExtraSpaces.trim();

        return trimmedString;
    }

    function saveChanges() {
        var variables = [];

        $(".form-loop").each(function() {
            var variable = $(this).find(".input-variable").val();
            var specification = $(this).find(".input-specification").val();

            var variable = {
                variable: cleanString(variable),
                specification: cleanString(specification),
            };

            variables.push(variable);
        });

        $.ajax({
            type: 'POST',
            url: '../api/post_edit_product.php',
            data: {
                id: $('#id').val(),
                number: $('#number').val(),
                name: $('#name').val(),
                variables: JSON.stringify(variables)
            },
            success: function(response) {
                alert('Changes saved successfully!');
            },
            error: function(error) {
                alert('Error saving changes: ' + error.statusText);
            }
        });
    }

    displayData();
</script>
</body>

</html>