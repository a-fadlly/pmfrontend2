<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
	header("Location: ../login");
} else {
	$accessCase   = json_decode(getCaseInfo('cases/start-cases'));
	$inbox        = json_decode(getCaseInfo('cases/paged?limit=100'));
	$draft        = json_decode(getCaseInfo('cases/draft/paged?limit=100'));
	$participated = json_decode(getCaseInfo('cases/participated/paged?limit=100'));

	$users   = json_decode(getCaseInfo('users?filter=' . $_SESSION['username']));
	foreach ($users->cases as $u) {
		if (strtolower($u->usr_username) == strtolower($_SESSION['username'])) {
			$_SESSION['aActiveUsers'] = $u->usr_firstname . ' ' . $u->usr_lastname;
			$_SESSION['usr_uid']      = $u->usr_uid;
		}
	}
}
?>

<?php include 'common/header.php' ?>

<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
	<div class="card">
		<div class="card-header" style="padding-top: 10px;padding-bottom: 0px;">
			<h4 class="mt-0 header-title mb-5"><i class="mdi mdi-email"></i> Inbox Case</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">

				<?php
				$appTitles = array_unique(array_column($participated->cases->data, 'app_pro_title'));
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
							<!-- <th>Current User</th> -->
							<th>Previous User</th>
							<th>Status</th>
							<th>Due Date</th>
							<!-- <th>Last Modification</th> -->
							<!-- <th>Priority</th> -->
							<th>Output Docs</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($inbox)) {
							foreach ($inbox->cases->data as $key => $d) {
						?>
								<tr>
									<td><a href="http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/<?= $d->app_uid ?>"><?= $d->app_number ?></a></td>
									<td><?= $d->app_title ?></td>
									<td><?= $d->app_pro_title ?></td>
									<td><?= $d->app_tas_title ?></td>
									<!-- <td><?= $d->app_current_user ?></td> -->
									<td><?= $d->app_del_previous_user ?></td>
									<td><?= $d->app_status ?></td>
									<td><?= isOverdue($d->del_task_due_date) ?></td>
									<!-- <td><?= $d->del_delegate_date ?></td> -->
									<!-- <td><?= $d->del_priority ?></td> -->
									<td>
										<button type="button" class="btn btn-sm btn-primary view-button" data-toggle="modal" data-target="#exampleModal" data-app-uid="<?= $d->app_uid ?>">
											View
										</button>
									</td>
								</tr>
						<?php }
						}  ?>
					</tbody>
				</table>
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Output Documents</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<i aria-hidden="true" class="ki ki-close"></i>
								</button>
							</div>
							<div class="modal-body" id="modalContent"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'common/footer.php' ?>

<script>
	var viewButtons = document.querySelectorAll('.view-button');

	viewButtons.forEach(function(button) {
		button.addEventListener('click', function() {
			var appUid = this.getAttribute('data-app-uid');

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200) {

					var response = JSON.parse(xhr.responseText);
					var cases = response.cases;
					var modalContent = document.getElementById('modalContent');

					modalContent.innerHTML = "";

					for (var i = 0; i < cases.length; i++) {
						var link = document.createElement('a');
						link.href = "http://192.168.1.244:8000/sysworkflow/en/neoclassic/" + cases[i].app_doc_link;
						link.textContent = cases[i].app_doc_filename;

						var lineBreak = document.createElement('br');

						modalContent.appendChild(link);
						modalContent.appendChild(lineBreak);
					}
				}
			};

			xhr.open('GET', 'api_request.php?app_uid=' + appUid, true);
			xhr.send();
		});
	});

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