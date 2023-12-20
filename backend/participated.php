<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
	header("Location: ../login");
} else {
	$accessCase   = json_decode(getCaseInfo('cases/start-cases'));
	$inbox        = json_decode(getCaseInfo('cases/paged?limit=100'));
	$draft        = json_decode(getCaseInfo('cases/draft/paged?limit=100'));
	$participated = json_decode(getCaseInfo('cases/participated/paged?limit=100'));

	$users   = json_decode(getCaseInfo('users'));
	foreach ($users->cases as $u) {
		if ($u->usr_username == $_SESSION['username']) {
			$_SESSION['aActiveUsers'] = $u->usr_firstname . ' ' . $u->usr_lastname;
			$_SESSION['usr_uid']      = $u->usr_uid;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Updates and statistics" />

	<title>Laravel</title>

	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="assets/theme/html/demo2/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
	<link href="assets/theme/html/demo2/dist/assets/plugins/global/plugins.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
	<link href="assets/theme/html/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
	<link href="assets/theme/html/demo2/dist/assets/css/style.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo2/dist/assets/media/logos/favicon.ico" />
	<link href="assets/theme/html/demo2/dist/assets/plugins/custom/datatables/datatables.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css" />

	<script src="https://kit.fontawesome.com/5d09fddc6f.js" crossorigin="anonymous"></script>

	<style>
		/* css goes here */
	</style>
</head>

<body id="kt_body" style="background-image: url(assets/theme/html/demo2/dist/assets/media/bg/bg-10.jpg )" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">

	<div id="kt_header_mobile" class="header-mobile">
		<a href="index.html">
			<img alt="Logo" src="assets/theme/html/demo2/dist/assets/media/logos/logo-letter-1.png" class="logo-default max-h-30px" />
		</a>
		<div class="d-flex align-items-center">
			<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
				<span></span>
			</button>
			<button class="btn btn-icon btn-hover-transparent-white p-0 ml-3" id="kt_header_mobile_topbar_toggle">
				<span class="svg-icon svg-icon-xl">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>
				</span>
			</button>
		</div>
	</div>
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-row flex-column-fluid page">
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

				<div id="kt_header" class="header header-fixed">
					<div class="container d-flex align-items-stretch justify-content-between">
						<div class="d-flex align-items-stretch mr-3">
							<div class="header-logo">
								<a href="index.html">
									<img alt="Logo" src="assets/images/ncell-white.jpg" class="logo-default max-h-40px" />
									<img alt="Logo" src="assets/images/ncell-white.jpg" class="logo-sticky max-h-40px" />
								</a>
							</div>
						</div>
						<div class="topbar">
							<div class="dropdown">
								<div class="topbar-item">
									<div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
										<span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1"><?= $_SESSION['aActiveUsers'] ?></span>
										<span class="symbol symbol-35">
											<span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">A</span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
						<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<div class="d-flex align-items-center flex-wrap mr-1">
								<div class="d-flex flex-column">
									<h2 class="text-white font-weight-bold my-2 mr-5">eApproval</h2>
									<div class="d-flex align-items-center font-weight-bold my-2">
										<a href="index" class="opacity-75 hover-opacity-100">
											<i class="fa-solid fa-house"></i>
										</a>
										<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
										<a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">eApproval</a>
									</div>
								</div>
							</div>

							<div class="d-flex align-items-center">
								<div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" data-placement="top">
									<a href="#" class="btn btn-transparent-white font-weight-bold py-3 px-6  mr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create new case</a>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
										<ul class="navi navi-hover py-5">
											<?php if ($accessCase->casesStatusCode == 200) { ?>
												<?php foreach ($accessCase->cases as $oCase) { ?>
													<li class="navi-item">
														<a href="dynaform.php?pro_uid=<?= $oCase->pro_uid ?>&tas_uid=<?= $oCase->tas_uid ?>" class="navi-link">
															<span class="navi-text"><?= $oCase->pro_title ?></span>
														</a>
													</li>
												<?php } ?>
											<?php } ?>
										</ul>
									</div>
								</div>
								<a href="#" class="btn btn-transparent-white font-weight-bold py-3 px-6">Reports</a>
							</div>
						</div>
					</div>
					<div class="d-flex flex-column-fluid">
						<div class="container">
							<div class="d-flex flex-row">
								<div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_inbox_aside">
									<div class="card card-custom">
										<div class="card-body px-5">
											<div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
												<div class="navi-item my-2">
													<a href="inbox" class="navi-link <?php active('inbox') ?>">
														<span class="navi-icon mr-2">
															<span class="svg-icon svg-icon-lg">
																<i class="fa-solid fa-inbox"></i>
															</span>
														</span>
														<span class="navi-text font-weight-bolder font-size-lg">Inbox</span>
														<span class="navi-label">
															<span class="label label-rounded label-light-success font-weight-bolder">
																<?php echo $inbox->cases->total ?>
															</span>
														</span>
													</a>
												</div>
												<div class="navi-item my-2">
													<a href="draft" class="navi-link <?php active('draft') ?>">
														<span class="navi-icon mr-2">
															<span class="svg-icon svg-icon-lg">
																<i class="fa-solid fa-pen-to-square"></i>
															</span>
														</span>
														<span class="navi-text font-weight-bolder font-size-lg">Draft</span>
														<span class="navi-label">
															<span class="label label-rounded label-light-warning font-weight-bolder"><?= $draft->cases->total ?></span>
														</span>
													</a>
												</div>
												<div class="navi-item my-2">
													<a href="participated" class="navi-link <?php active('participated') ?>">
														<span class="navi-icon mr-2">
															<span class="svg-icon svg-icon-lg">
																<i class="fas fa-arrow-alt-circle-right"></i>
															</span>
														</span>
														<span class="navi-text font-weight-bolder font-size-lg">Participated</span>
														<span class="navi-label">
															<span class="label label-rounded label-light-warning font-weight-bolder"><?= $participated->cases->total ?></span>
														</span>
													</a>
												</div>
												<div class="navi-item my-10"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
									<div class="card">
										<div class="card-header" style="padding-top: 10px;padding-bottom: 0px;">
											<h4 class="mt-0 header-title mb-5"><i class="mdi mdi-email"></i> Participated Case</h4>
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

												<label>Status:
													<select class="form-control column-filter" data-column="5">
														<option value="">-</option>
														<option value="TO_DO">TO_DO</option>
														<option value="COMPLETED">COMPLETED</option>
														<option value="DRAFT">DRAFT</option>
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
															<th>Due Date</th>
															<th>Last Modification</th>
															<th>Priority</th>
															<th>Output Docs</th>
														</tr>
													</thead>
													<tbody>
														<?php
														if (!empty($participated)) {
															foreach ($participated->cases->data as $key => $d) {
														?>
																<tr>
																	<td><a href="http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/<?= $d->app_uid ?>"><?= $d->app_number ?></a></td>
																	<td><?= $d->app_title ?></td>
																	<td><?= $d->app_pro_title ?></td>
																	<td><?= $d->app_tas_title ?></td>
																	<td><?= $d->app_current_user ?></td>
																	<td><?= $d->del_task_due_date ?></td>
																	<td><?= $d->del_delegate_date ?></td>
																	<td><?= $d->del_priority ?></td>
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

							</div>
						</div>
					</div>
				</div>
				<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
					<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
						<div class="text-dark order-2 order-md-1">
							<span class="text-muted font-weight-bold mr-2">2021©</span>
							<a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a>
						</div>
						<div class="nav nav-dark order-1 order-md-2">
							<a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pr-3 pl-0">About</a>
							<a href="http://keenthemes.com/metronic" target="_blank" class="nav-link px-3">Team</a>
							<a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
						</div>
					</div>
				</div>

				<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
					<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
						<h3 class="font-weight-bold m-0">User Profile</h3>
						<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
							<i class="ki ki-close icon-xs text-muted"></i>
						</a>
					</div>
					<div class="offcanvas-content pr-5 mr-n5">
						<div class="d-flex align-items-center mt-5">
							<div class="symbol symbol-100 mr-5">
								<div class="symbol-label" style="background-image:url('../theme/html/demo2/dist/assets/media/users/300_21.jpg')"></div>
								<i class="symbol-badge bg-success"></i>
							</div>
							<div class="d-flex flex-column">
								<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= $_SESSION['aActiveUsers'] ?></a>
								<div class="text-muted mt-1">Admin</div>
								<div class="navi mt-2">
									<a href="controller/common.php?action=logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="kt_scrolltop" class="scrolltop">
					<span class="svg-icon">
						<i class="fa-solid fa-arrow-up"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/theme/html/demo2/dist/assets/plugins/global/plugins.bundlef552.js?v=7.1.8"></script>
	<script src="assets/theme/html/demo2/dist/assets/plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8"></script>
	<script src="assets/theme/html/demo2/dist/assets/js/scripts.bundlef552.js?v=7.1.8"></script>
	<script src="assets/theme/html/demo2/dist/assets/plugins/custom/datatables/datatables.bundlef552.js?v=7.1.8"></script>
	<script src="assets/theme/html/demo2/dist/assets/js/pages/crud/datatables/basic/basicf552.js?v=7.1.8"></script>
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1200
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#6993FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#F3F6F9",
						"dark": "#212121"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1E9FF",
						"secondary": "#ECF0F3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#212121",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#ECF0F3",
					"gray-300": "#E5EAEE",
					"gray-400": "#D6D6E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#80808F",
					"gray-700": "#464E5F",
					"gray-800": "#1B283F",
					"gray-900": "#212121"
				}
			},
			"font-family": "Poppins"
		};
	</script>
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