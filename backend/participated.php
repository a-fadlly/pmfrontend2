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

	<?php include 'common/css.php' ?>

</head>

<body id="kt_body" style="background-image: url(assets/theme/html/demo2/dist/assets/media/bg/bg-10.jpg )" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">

	<?php include 'common/mobile-header.php' ?>

	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-row flex-column-fluid page">
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

				<?php include 'common/header.php' ?>

				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
						<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
							<div class="d-flex align-items-center flex-wrap mr-1">
								<div class="d-flex flex-column">
									<h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
									<div class="d-flex align-items-center font-weight-bold my-2">
										<a href="index" class="opacity-75 hover-opacity-100">
											<i class="fa-solid fa-house"></i>
										</a>
										<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
										<a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Dashboard</a>
										<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
										<a href="#" class="text-white text-hover-white opacity-75 hover-opacity-100">Latest Updated</a>
									</div>
								</div>
							</div>

							<div class="d-flex align-items-center">
								<a href="#" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Reports</a>
							</div>
						</div>
					</div>

					<div class="d-flex flex-column-fluid">
						<div class="container">
							<div class="d-flex flex-row">

								<?php include 'common/navigations.php' ?>

								<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">

									<div class="card card-custom card-stretch">

										<div class="card-body table-responsive px-0">

											<div class="card">
												<div class="card-header" style="padding-top: 10px;padding-bottom: 0px;">
													<h4 class="mt-0 header-title mb-5"><i class="mdi mdi-email"></i> Participated Case</h4>
												</div>
												<div class="card-body">

													<div class="table-responsive">
														<table id="myTable" data-page-length="25">
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
																if (!empty($participated)) {

																	foreach ($participated->cases->data as $key => $d) {
																?>
																		<tr>
																			<td><a href="http://192.168.1.244:8000/sysworkflow/en/neoclassic/cases/opencase/<?= $d->app_uid ?>"><?= $d->app_number ?></a></td>
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
																<?php }
																}  ?>
															</tbody>
														</table>
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

				<?php include 'common/footer.php' ?>

			</div>
		</div>
	</div>

	<?php include 'common/user-panel.php' ?>

	<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">
			<i class="fa-solid fa-arrow-up"></i>
		</span>
	</div>

	<?php include 'common/script.php' ?>

</body>

</html>