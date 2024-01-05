<?php
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);

$products = $reminderQCController->getProducts();
?>
<?php include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
  <!--begin::Card-->
  <div class="card card-custom">
    <div class="tab-content">
      <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          <div class="card-title">
            <h3 class="card-label">Timeline
              <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>
            </h3>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div id='calendar'></div>
            <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Test Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <input type="hidden" id="id" name="id">
                  <div class="modal-body" id="eventModalBody">
                    <!-- Event details will be displayed here -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="inputButton">Input</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
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
  $(document).ready(function() {
    var calendarEl = $('#calendar');

    var calendar = new FullCalendar.Calendar(calendarEl[0], {
      initialView: 'dayGridMonth',
      events: '../api/fetch_calendar.php',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'listWeek dayGridMonth,timeGridWeek,timeGridDay'
      },
      eventDidMount: function(info) {

      },
      eventClick: function(info) {
        $.ajax({
          url: '../api/fetch_calendar_event.php',
          type: 'GET',
          data: {
            id: info.event.id
          },
          dataType: 'json',
          success: function(response) {
            $('#id').val(info.event.id);

            var modalBody =
              "<div class='form-group'><div class='col-lg-12'>" +
              "<label>Type:</label>" +
              "<p><strong>" + response.type + "</strong></p>" +
              "</div></div>" +

              "<div class='form-group'><div class='col-lg-12'>" +
              "<label>Item Number:</label>" +
              "<p><strong>" + response.item_number + "</strong></p>" +
              "</div></div>" +

              "<div class='form-group'><div class='col-lg-12'>" +
              "<label>Product Name:</label>" +
              "<p><strong>" + response.product_name + "</strong></p>" +
              "</div></div>" +

              "<div class='form-group'><div class='col-lg-12'>" +
              "<label>Due Date:</label>" +
              "<p><strong>" + response.date + "</strong></p>" +
              "</div></div>" +

              "<div class='form-group'><div class='col-lg-12'>" +
              "<label>Sample:</label>" +
              "<p><strong>" + (response.sample_received ? 'Ya' : 'Belum diterima') + "</strong></p>" +
              "</div></div>";

            if (!response.sample_received) {
              if (!$('#inputButton').hasClass('disabled')) {
                $('#inputButton').addClass('disabled');
              }
            } else {
              if ($('#inputButton').hasClass('disabled'))
                $('#inputButton').removeClass('disabled');
            }

            $("#eventId").val(info.event.id);
            $('#eventModalBody').html(modalBody);
            $('#eventModal').modal('show');
          },
          error: function(xhr, status, error) {
            console.error('Error:', status, error);
          }
        });
      },
    });

    calendar.render();

    $('#inputButton').on('click', function() {
      if ($(this).hasClass('disabled')) {
        return;
      }

      $('#eventModal').modal('hide');
      var id = $('#id').val();
      var url = 'InputResult.php?id=' + encodeURIComponent(id)
      window.location.href = url;
    });
  });
</script>
</body>

</html>