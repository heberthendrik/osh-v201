<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
error_reporting(0);
session_start();
include("library/function_list/function_general.php");
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/vendor/animate/animate.css">

		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/vendor/font-awesome/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo GetMasterLink();?>/MASTER/css/custom.css">

		<!-- Head Libs -->
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/modernizr/modernizr.js"></script>
		<link rel="icon" type="image/png" href="media_library/fav.png" />

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<div style="margin:0 auto;width:100%;text-align:center;">
				<a href="#" class="logo">
					<img src="<?php echo GetMasterLink();?>/media_library/logo_square.png" style="width:100%;max-width:250px;height:auto;"  />
				</a>
				</div>

				<div class="panel card-sign">
					<div class="card-title-sign mt-3 text-right">
						<h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign In</h2>
					</div>
					<div class="card-body">
					
						<div style="margin-top:20px;">
							<?php include('module/include/system_message.php'); ?>
						</div>
					
						<form action="module/Login/Process.php" method="POST">
							<div class="form-group mb-3">
								<label>Email</label>
								<div class="input-group">
									<input name="emailEmail" type="email" class="form-control form-control-lg" required autocomplete="off" autofocus="on" />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="clearfix">
									<label class="float-left">Password</label>
<!-- 									<span href="#" class="float-right">Lost Password?</span> -->
								</div>
								<div class="input-group">
									<input name="passwordPassword" type="password" class="form-control form-control-lg" required autocomplete="off" />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12 text-right">
									<button type="submit" class="btn btn-primary mt-2">Sign In</button>
								</div>
							</div>

							<input type="hidden" name="module" value="Login" />
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2018. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/jquery/jquery.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/popper/umd/popper.min.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/common/common.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?php echo GetMasterLink();?>/MASTER/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo GetMasterLink();?>/MASTER/js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo GetMasterLink();?>/MASTER/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo GetMasterLink();?>/MASTER/js/theme.init.js"></script>

	</body>
</html>