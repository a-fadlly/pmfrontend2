<?php
include 'controller/common.php';

if (empty($_SESSION["access_token"])) {
	header("Location: ../login");
} else {
	$pro_uid = $_REQUEST['pro_uid'];
	$tas_uid = $_REQUEST['tas_uid'];

	$accessCase   = json_decode(getCaseInfo('cases/start-cases'));
	//$inbox        = json_decode(getCaseInfo('cases/paged?limit=100'));
	//$draft        = json_decode(getCaseInfo('cases/draft/paged?limit=100'));
	//$participated = json_decode(getCaseInfo('cases/participated/paged?limit=100'));

	$dynaforms      = json_decode(getDynaformInfo($pro_uid . '/dynaforms'));
	$first_dynaform = end($dynaforms->cases);

	$pro_uid_id     = $pro_uid;
	$token_id       = $_SESSION["access_token"];
	$tas_uid_id     = $tas_uid;

	$dyn_uid_id     = $first_dynaform->dyn_uid;
	$we_title_id    = uniqid();
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
		#myModal {
			display: none;
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: 1000;
			width: 80%;
			/* Adjust the width as needed */
			max-width: 600px;
			/* Set a maximum width if desired */
			background-color: #fff;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			padding: 20px;
		}


		#myModal {
			display: none;
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: 1000;
			width: 80%;
			/* Adjust the width as needed */
			max-width: 600px;
			/* Set a maximum width if desired */
			background-color: #fff;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		}

		.modal-content {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 100%;
			max-height: 80vh;
			/* Adjust the max-height as needed */
			overflow-y: auto;
		}

		.close {
			position: absolute;
			top: 10px;
			right: 10px;
			font-size: 20px;
			cursor: pointer;
		}

		.close {
			position: absolute;
			top: 10px;
			right: 10px;
			font-size: 20px;
			cursor: pointer;
		}
	</style>
</head>

<body onload="getDynaform( '<?= $pro_uid_id ?>', '<?= $token_id ?>', '<?= $tas_uid_id ?>', '<?= $dyn_uid_id ?>', '<?= $we_title_id ?>','<?= $_SESSION['usr_uid'] ?>') " id="kt_body" style="background-image: url(assets/theme/html/demo2/dist/assets/media/bg/bg-10.jpg )" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">

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
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
								<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
									<ul class="menu-nav">
										<li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Create a new case</span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<?php if ($accessCase->casesStatusCode == 200) { ?>
														<?php foreach ($accessCase->cases as $oCase) { ?>
															<li class="menu-item" aria-haspopup="true">
																<?php echo '<a href="dynaform.php?pro_uid=' . $oCase->pro_uid . '&tas_uid=' . $oCase->tas_uid . '" class="menu-link">' ?>
																<span class="menu-text"><?= $oCase->pro_title ?></span>
																<span class="menu-desc"></span>
																</a>
															</li>
														<?php } ?>
													<?php } ?>
												</ul>
											</div>
										</li>
									</ul>
								</div>
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
									<h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
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
								<a href="#" class="btn btn-transparent-white font-weight-bold py-3 px-6 mr-2">Reports</a>
							</div>
						</div>
					</div>

					<div class="d-flex flex-column-fluid">
						<div class="container">
							<div class="d-flex flex-row">
								<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
									<div class="card">
										<div class="card-header" style="padding-top: 10px;padding-bottom: 0px;">
											<h4 class="mt-0 header-title mb-5"><i class="mdi mdi-email"></i> Dynaform</h4>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<iframe id="iframex" name="iframex" src="" width="100%" height="900" scrolling="yes" frameborder="0"></iframe>
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
					function getDynaform(pro_uid, token, tas_uid, dyn_uid, we_title, user_id) {

						console.log(pro_uid + '_' + token + '_' + tas_uid + '_' + dyn_uid + '_' + we_title + '_' + user_id);

						var settings = {
							"url": "http://192.168.1.244:8000/api/1.0/workflow/project/" + pro_uid + "/web-entry",
							"method": "POST",
							"timeout": 0,
							"headers": {
								"Authorization": "Bearer " + token,
								"Content-Type": "application/json"
							},
							"data": JSON.stringify({
								"tas_uid": tas_uid,
								"dyn_uid": dyn_uid,
								"usr_uid": user_id,
								"we_title": we_title,
								"we_description": "Description.......",
								"we_method": "WS",
								"we_input_document_access": 1
							}),
						}

						$.ajax(settings).done(function(response) {
							console.log(response.we_data);
							var url = response.we_data;
							$('#iframex').prop("src", url);

							var we_uid = response.we_uid
							console.log(we_uid);
							//updateDynaform(pro_uid, token, tas_uid, dyn_uid, we_title, we_uid)
						});
					}


					//update dynaform 
					// function updateDynaform(pro_uid, token, tas_uid, dyn_uid, we_title, we_uid) {

					// 	var settings = {
					// 		"url": "http://192.168.1.244:8000/api/1.0/workflow/project/" + pro_uid + "/web-entry/" + we_uid + "",
					// 		"method": "PUT",
					// 		"timeout": 0,
					// 		"headers": {
					// 			"Authorization": "Bearer " + token,
					// 			"Content-Type": "application/json"
					// 		},
					// 		"data": JSON.stringify({
					// 			"tas_uid": tas_uid,
					// 			"dyn_uid": dyn_uid,
					// 			"usr_uid": "",
					// 			"we_title": we_title,
					// 			"we_description": "Initiation 3",
					// 			"we_method": "WS",
					// 			"we_input_document_access": 1
					// 		}),
					// 	};

					// 	$.ajax(settings).done(function(response) {
					// 		console.log(response);
					// 	});
					// }



					//manual process
					// var settings = {
					// 	"url": "http://192.168.1.244:8000/api/1.0/workflow/project/9770453305fc4c1eb455543020401473/web-entry",
					// 	"method": "POST",
					// 	"timeout": 0,
					// 	"headers": {
					// 		"Authorization": "Bearer 600bb4e3ce128bb5ae158ee2b684fd4be1f58c13",
					// 		"Content-Type": "application/json"
					// 	},
					// 	"data": JSON.stringify({
					// 		"tas_uid": "3687802475fc4c26f44ff08025269497",
					// 		"dyn_uid": "5647041045fc4cd68b5b043005341772",
					// 		"we_title": "Initiation 92" + Math.random(),
					// 		"we_description": "Initiation 3",
					// 		"we_method": "WS",
					// 		"we_input_document_access": 1
					// 	}),
					// }

					// $.ajax(settings).done(function(response) {
					// 	//console.log(response.we_data);
					// 	var url = response.we_data;
					// 	$('#iframex').prop("src", url);
					// });
				</script>


</body>

</html>