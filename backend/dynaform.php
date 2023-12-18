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

	<?php include 'common/css.php' ?>

</head>

<body onload="getDynaform( '<?= $pro_uid_id ?>', '<?= $token_id ?>', '<?= $tas_uid_id ?>', '<?= $dyn_uid_id ?>', '<?= $we_title_id ?>','<?= $_SESSION['usr_uid'] ?>') " id="kt_body" style="background-image: url(assets/theme/html/demo2/dist/assets/media/bg/bg-10.jpg )" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">

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

								<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">

									<div class="card card-custom card-stretch">
										<div class="card-body table-responsive px-0">

											<div class="card">
												<div class="card-header" style="padding-top: 10px;padding-bottom: 0px;">
													<h4 class="mt-0 header-title mb-5"><i class="mdi mdi-email"></i> Inbox Case</h4>
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

	<script src="assets/js/jquery.min.js"></script>

	<!-- for datatables -->
	<script>
		//dynamic process using function
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