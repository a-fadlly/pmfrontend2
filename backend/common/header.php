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
								<?php
								function active($currect_page)
								{
									$url_array =  explode('/', $_SERVER['REQUEST_URI']);
									$url = end($url_array);
									if ($currect_page == $url) {
										echo 'active';
									}
								}
								?>
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