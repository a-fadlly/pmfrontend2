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