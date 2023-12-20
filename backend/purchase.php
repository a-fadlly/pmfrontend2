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
			<form id="workflowForm2">
				<div class="form-group">
					<label for="rqm_nbr">Request Number:</label>
					<input type="text" class="form-control" id="rqm_nbr" name="rqm_nbr" required>
				</div>

				<div class="form-group">
					<label for="rqm_ship">Ship To:</label>
					<input type="text" class="form-control" id="rqm_ship" name="rqm_ship" required>
				</div>

				<div class="form-group">
					<label for="rqm_entity">Entity:</label>
					<input type="text" class="form-control" id="rqm_entity" name="rqm_entity" required>
				</div>

				<div class="form-group">
					<label for="rqm_req_date">Request Date:</label>
					<input type="datetime-local" class="form-control" id="rqm_req_date" name="rqm_req_date" required>
				</div>

				<div class="form-group">
					<label for="rqm_need_date">Need Date:</label>
					<input type="datetime-local" class="form-control" id="rqm_need_date" name="rqm_need_date" required>
				</div>

				<div class="form-group">
					<label for="rqm_due_date">Due Date:</label>
					<input type="datetime-local" class="form-control" id="rqm_due_date" name="rqm_due_date" required>
				</div>

				<div class="form-group">
					<label for="rqm_domain">Site:</label>
					<input type="text" class="form-control" id="rqm_domain" name="rqm_domain" required>
				</div>

				<div class="form-group">
					<label for="rqm_end_userid">End User:</label>
					<input type="text" class="form-control" id="rqm_end_userid" name="rqm_end_userid" required>
				</div>

				<div class="form-group">
					<label for="rqm_rqby_userid">Requested By:</label>
					<input type="text" class="form-control" id="rqm_rqby_userid" name="rqm_rqby_userid" required>
				</div>

				<div class="form-group">
					<label for="rqm_reason">Reason:</label>
					<input type="text" class="form-control" id="rqm_reason" name="rqm_reason" required>
				</div>

				<div class="form-group">
					<label for="rqm_cc">Cost Center:</label>
					<input type="text" class="form-control" id="rqm_cc" name="rqm_cc" required>
				</div>

				<div class="form-group">
					<label for="rqm_rmks">Remarks:</label>
					<textarea class="form-control" id="rqm_rmks" name="rqm_rmks" rows="4" required></textarea>
				</div>

				<div class="form-group">
					<label for="gridDetails">Grid Details:</label>
					<table class="table" id="gridDetails">
						<thead>
							<tr>
								<th>Line</th>
								<th>Item No</th>
								<th>Description 1</th>
								<th>Description 2</th>
								<th>Request Qty</th>
								<th>Unit of Measure</th>
								<th>Due Date</th>
								<th>Need Date</th>
								<th>Account</th>
								<th>Comment</th>
								<th>Stock</th>
								<th>Pending</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<!-- Grid details will be added dynamically here -->
						</tbody>
					</table>
				</div>

				<button type="button" class="btn btn-primary" onclick="addGridDetail()">Add Grid Detail</button>
				<button type="submit" class="btn btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>

<?php include 'common/footer.php' ?>


<script>
	var pmServer = "http://192.168.1.244:8000";

	function getCookie(name) {
		function escape(s) {
			return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1');
		};
		var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
		return match ? match[1] : null;
	}

	var oResponse = null;
	var httpStatus = null;

	function pmRestRequest(method, endpoint, asynchronous, oVars, func) {
		asynchronous = (typeof asynchronous === 'undefined') ? false : asynchronous;
		oParams = (typeof oParams === 'undefined') ? null : oParams;
		func = (typeof func === 'undefined') ? null : func;

		while (!getCookie("access_token")) {
			pmRestLogin();
		}

		if (typeof XMLHttpRequest != "undefined") {
			var req = new XMLHttpRequest();
		} else {
			try {
				var req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				alert("Error: This browser does not support XMLHttpRequest.");
				return;
			}
		}

		req.open(method, pmServer + endpoint, asynchronous);
		req.setRequestHeader("Authorization", "Bearer " + getCookie("access_token"));
		sVars = null;
		method = method.toUpperCase().trim();

		switch (method) {
			case "GET":
			case "DELETE":
				break;
			case "PUT":
				if (oVars) {
					for (var v in oVars) {
						if (oVars.hasOwnProperty(v))
							oVars[v] = encodeURIComponent(oVars[v]);
					}
				}
			case "POST":
				var sVars = JSON.stringify(oVars);
				req.setRequestHeader('Content-type', 'application/json; charset=utf-8');
				req.setRequestHeader('Content-length', sVars.length);
				break;
			default:
				alert("Error: Invalid HTTP method '" + url + "'.");
				return;
		}

		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				var status = req.status;
				var oResp = null;

				if (req.responseText) {
					oResp = (JSON) ? JSON.parse(req.responseText) : eval(req.responseText);
				}

				if (!asynchronous) {
					httpStatus = status;
					oResponse = oResp;
				}
				if (status == 401) {
					window.location.href = "login.html";
					return;
				} else if (oResp && oResp.error) {
					var msg = "Error code: " + oResp.error.code + "\nMessage: " + oResp.error.message;
					alert(msg);
				} else if (status != 200 && status != 201) {
					alert("HTTP status error: " + req.status);
				}

				if (func) {
					func(oResp, status);
				}
			}
		};

		if (asynchronous) {
			req.timeout = 20000;
			req.ontimeout = function() {
				alert("Timed out calling " + $endpoint);
			};
		}
		req.send(sVars);
	}

	function addGridDetail() {
		const table = document.getElementById('gridDetails').getElementsByTagName('tbody')[0];
		const newRow = table.insertRow(table.rows.length);

		const cells = [
			'rqd_line_list',
			'rqd_part_list',
			'rqd_part_desc1_list',
			'rqd_part_desc2_list',
			'rqd_req_qty_list',
			'rqd_um_list',
			'rqd_due_date_list',
			'rqd_need_date_list',
			'rqd_acct_list',
			'comment_line_list',
			'stock_list',
			'pending_list'
		];

		cells.forEach(cell => {
			const newCell = newRow.insertCell();
			newCell.innerHTML = `<input type="text" class="form-control" name="${cell}[]" required>`;
		});

		const actionCell = newRow.insertCell();
		actionCell.innerHTML = '<button type="button" class="btn btn-danger" onclick="deleteGridDetail(this)">Delete</button>';
	}

	function deleteGridDetail(button) {
		const row = button.parentNode.parentNode;
		row.parentNode.removeChild(row);
	}



	$(document).ready(function() {
		$('#workflowForm2').submit(function(event) {
			event.preventDefault();

			const formData = $(this).serializeArray();
			const gridDetailsData = [];

			$('#gridDetails tbody tr').each(function() {
				const gridDetail = {
					'rqd_line_list': '1',
					'rqd_line_list_label': '1',
					'rqd_part_list': $(this).find('input[name="rqd_part_list[]"]').val(),
					'rqd_part_list_label': $(this).find('input[name="rqd_part_list[]"]').val(),
					'rqd_part_desc1_list': $(this).find('input[name="rqd_part_desc1_list[]"]').val(),
					'rqd_part_desc1_list_label': $(this).find('input[name="rqd_part_desc1_list[]"]').val(),
					'rqd_part_desc2_list': $(this).find('input[name="rqd_part_desc2_list[]"]').val(),
					'rqd_part_desc2_list_label': $(this).find('input[name="rqd_part_desc2_list[]"]').val(),
					'rqd_req_qty_list': $(this).find('input[name="rqd_req_qty_list[]"]').val(),
					'rqd_req_qty_list_label': $(this).find('input[name="rqd_req_qty_list[]"]').val(),
					'rqd_um_list': $(this).find('input[name="rqd_um_list[]"]').val(),
					'rqd_um_list_label': $(this).find('input[name="rqd_um_list[]"]').val(),
					'rqd_due_date_list': $(this).find('input[name="rqd_due_date_list[]"]').val(),
					'rqd_due_date_list_label': $(this).find('input[name="rqd_due_date_list[]"]').val(),
					'rqd_need_date_list': $(this).find('input[name="rqd_need_date_list[]"]').val(),
					'rqd_need_date_list_label': $(this).find('input[name="rqd_need_date_list[]"]').val(),
					'rqd_acct_list': $(this).find('input[name="rqd_acct_list[]"]').val(),
					'rqd_acct_list_label': $(this).find('input[name="rqd_acct_list[]"]').val(),
					'comment_line_list': $(this).find('input[name="comment_line_list[]"]').val(),
					'comment_line_list_label': $(this).find('input[name="comment_line_list[]"]').val(),
					'stock_list': $(this).find('input[name="stock_list[]"]').val(),
					'stock_list_label': $(this).find('input[name="stock_list[]"]').val(),
					'pending_list': $(this).find('input[name="pending_list[]"]').val(),
					'pending_list_label': $(this).find('input[name="pending_list[]"]').val(),
				};
				gridDetailsData.push(gridDetail);
			});

			const oVars = {
				'pro_uid': '62979125965600970c8d5d4018584595',
				'tas_uid': '37094116265600ada09c825080144520',
				'variables': [{
					'emailPengaju': 'user@example.com',
					'rqm_nbr': formData.find(item => item.name === 'rqm_nbr').value,
					'rqm_nbr_label': formData.find(item => item.name === 'rqm_nbr').value,
					'rqm_ship': formData.find(item => item.name === 'rqm_ship').value,
					'rqm_ship_label': formData.find(item => item.name === 'rqm_ship').value,
					'rqm_entity': formData.find(item => item.name === 'rqm_entity').value,
					'rqm_entity_label': formData.find(item => item.name === 'rqm_entity').value,
					'rqm_req_date': formData.find(item => item.name === 'rqm_req_date').value,
					'rqm_req_date_label': formData.find(item => item.name === 'rqm_req_date').value,
					'rqm_rmks': formData.find(item => item.name === 'rqm_rmks').value,
					'rqm_rmks_label': formData.find(item => item.name === 'rqm_rmks').value,
					'rqm_rqby_userid': formData.find(item => item.name === 'rqm_rqby_userid').value,
					'rqm_rqby_userid_label': formData.find(item => item.name === 'rqm_rmks').value,
					'rqm_need_date': formData.find(item => item.name === 'rqm_need_date').value,
					'rqm_need_date_label': formData.find(item => item.name === 'rqm_need_date').value,
					'rqm_due_date': formData.find(item => item.name === 'rqm_due_date').value,
					'rqm_due_date_label': formData.find(item => item.name === 'rqm_due_date').value,
					'rqm_domain': formData.find(item => item.name === 'rqm_domain').value,
					'rqm_domain_label': formData.find(item => item.name === 'rqm_domain').value,
					'rqm_end_userid': formData.find(item => item.name === 'rqm_end_userid').value,
					'rqm_end_userid_label': formData.find(item => item.name === 'rqm_end_userid').value,
					'rqm_reason': formData.find(item => item.name === 'rqm_reason').value,
					'rqm_reason_label': formData.find(item => item.name === 'rqm_reason').value,
					'rqm_cc': formData.find(item => item.name === 'rqm_cc').value,
					'rqm_cc_label': formData.find(item => item.name === 'rqm_cc').value,
					'gridDetails': gridDetailsData.reduce(function(acc, gridDetail, index) {
						acc[index + 1] = gridDetail;
						return acc;
					}, {})
				}]
			};

			pmRestRequest("POST", "/api/1.0/workflow/cases", false, oVars);

			if (httpStatus == 200 && oResponse) {
				alert("Case created.");
			}
		});
	});
</script>
</body>

</html>