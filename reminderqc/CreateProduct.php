<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION["access_token"])) {
    header("Location: ../login.php");
}
include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Create Product
                            <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row ">
                        <div class="col-lg-6">
                            <label>Nomor Barang <span class="font-italic">(Item Number)</span>:</label>
                            <input id="number" name="number" type="text" class="form-control" />
                        </div>
                        <div class="col-lg-6">
                            <label>Nama Produk <span class="font-italic">(Product Name)</span>:</label>
                            <input id="name" name="name" type="text" class="form-control" />
                        </div>
                    </div>
                    <div id="variables-container"></div>
                    <button type="button" class="btn btn-primary btn-sm" onclick="addvariable()">Add variable</button>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary mr-2" onclick="submitProduct()">Save</button>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $("#variables-container").sortable({
            handle: ".drag-handle",
        });

        addvariable();

        $("#quiz-builder-form").submit(function(event) {
            event.preventDefault();
            var variableOrder = $("#variables-container .variable").map(function() {
                return $(this).data("variable-id");
            }).get();
        });
    });

    function addvariable() {
        var variableId = new Date().getTime();

        var variableHtml =
            `<div class="variable form-group row" data-variable-id="${variableId}">
                <div class="col-lg-5">
                    <span class="drag-handle">&#x2195;</span>
                    <label for="variable-${variableId}">Pengujian <span class="font-italic">(Testing)</span>:</label>
                    <input type="text" id="variable-${variableId}" name="variables[]" class="form-control">
                </div>
                <div class="col-lg-5">
                    <label for="specification-${variableId}">Spesifikasi <span class="font-italic">(Specification)</span>:</label>
                    <textarea type="text" id="specification-${variableId}" name="specifications[]" class="form-control"></textarea>
                </div>
                <div class="col-lg-2">
                    <label for=""> </label>
                    <button type="button" class="btn btn-danger form-control" onclick="removevariable(${variableId})">Remove</button>
                </div>
            </div>`;

        $("#variables-container").append(variableHtml);

        $("#variables-container").sortable("refresh");
    }

    function removevariable(variableId) {
        $(`#variables-container .variable[data-variable-id="${variableId}"]`).remove();
        $("#variables-container").sortable("refresh");
    }

    function submitProduct() {
        var variableData = $("#variables-container .variable").map(function() {
            // var variableId = $(this).data("variable-id");
            var variableText = $(this).find('input[name="variables[]"]').val();
            var specificationText = $(this).find('textarea[name="specifications[]"]').val();
            return {
                // variable_id: variableId,
                variable: variableText,
                specification: specificationText
            };
        }).get();

        if (variableData.length > 0 && variableData[0].variable && variableData[0].specification) {
            var productnumber = $("#number").val();
            var productname = $("#name").val();
            if (productnumber && productname) {
                $.ajax({
                    url: "../api/post_create_product.php",
                    type: "POST",
                    data: {
                        number: productnumber,
                        name: productname,
                        variables: variableData
                    },
                    success: function(response) {
                        window.location.href = "Products.php";
                    },
                    error: function(error) {
                        console.log("Ajax Error:", error);
                    }
                });
            } else {
                alert('Product Number and Product Name cannot be null');
            }
        } else {
            alert('Testing and Specification cannot be null');
        }
    }
</script>
</body>

</html>