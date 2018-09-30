<?php
session_start();
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../library/function_list.php");
$repository_url = "../../MASTER";
?>
<html class="fixed sidebar-light sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php echo GetSiteTitle();?></title>
		
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/animate/animate.css">

		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/font-awesome/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo $repository_url;?>/css/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo $repository_url;?>/css/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo $repository_url;?>/css/custom.css">

		<!-- Head Libs -->
		<script src="<?php echo $repository_url;?>/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include('../include/top_header.php'); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('../include/navigation_sidebar.php'); ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>User Profile</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>User Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open=""><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					
					<div style="margin-top:20px;">
						<?php include('../include/system_message.php'); ?>
					</div>

					<div class="row">
						<div class="col-lg-4 col-xl-3 mb-4 mb-xl-0">

							<section class="card">
								<div class="card-body">
									<div class="thumb-info mb-3">
										<?php
										if( $_SESSION['OSH']['PROFILE_PICTURE'] != '' ){
											?>
											<img src="<?php echo GetMasterLink();?>/media_library/profilepicture/<?php echo $_SESSION['OSH']['COMPOSITE_ID'] ?>/<?php echo $_SESSION['OSH']['PROFILE_PICTURE'] ?>" class="rounded img-fluid" alt="John Doe">
											<?php
										} else {
											?>
											<img src="<?php echo GetMasterLink();?>/MASTER/img/!logged-user.jpg" class="rounded img-fluid" alt="John Doe">
											<?php
										}
										?>
										
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?php echo $_SESSION['OSH']['NAME'];?></span>
											<span class="thumb-info-type">
												<?php 
												$query_roles = "select * from master_roles where ID = '".$_SESSION['OSH']['ID_ROLE']."'";
												$result_roles = $db->query($query_roles);
												$num_roles = $result_roles->num_rows;
												$row_roles = $result_roles->fetch_assoc();
												echo $roles_name = $row_roles['NAME'];
												?>
											</span>
										</div>
									</div>
								</div>
							</section>

							
							<ul class="simple-card-list mb-3">
								<li class="primary">
									<h3><?php echo GetTotalReportGenerated();?></h3>
									<p class="text-light">Report Generated</p>
								</li>
								<li class="primary">
									<h3><?php echo GetPendingReport();?></h3>
									<p class="text-light">Pending Report</p>
								</li>
								<li class="primary">
									<h3><?php echo GetCompletedReport();?></h3>
									<p class="text-light">Report Completed</p>
								</li>
							</ul>

						</div>
						
						<div class="col-lg-8 col-xl-9">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="nav-item active">
										<a class="nav-link" href="#overview" data-toggle="tab">Overview</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#edit" data-toggle="tab">Edit</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">

										<div class="p-3">

											<h4 class="mb-3 pt-4">Notifikasi</h4>

											<div class="timeline timeline-simple mt-3 mb-3">
												<div class="tm-body">
													<div class="tm-title">
														<h5 class="m-0 pt-2 pb-2 text-uppercase">NOW</h5>
													</div>
													<ol class="tm-items">
														<?php
														$function_GetAllNotifikasi = GetAllNotifikasi();
														
														for( $i=0;$i<$function_GetAllNotifikasi['TOTAL_ROW'];$i++ ){
														
															if( $function_GetAllNotifikasi['IS_READ'][$i] == 0 ){
																$background = ' style="background:rgba(255,0,0,0.1);border-color:red;" ';
															} else {
																$background = '';
															}
														
															?>

															<li>
																<div class="tm-box" <?php echo $background;?> >
																	<p class="text-muted mb-0"><?php echo $function_GetAllNotifikasi['CREATED_AT'][$i]; ?></p>
																	<p>
																		<?php echo $function_GetAllNotifikasi['MESSAGE_TEXT'][$i]; ?><br/>
																		<a href="process.php?module=VisitNotif&id=<?php echo $function_GetAllNotifikasi['ID'][$i]; ?>">Lihat Detail</a>
																	</p>
																</div>
															</li>	
															<?php
														}
														
														?>
														
													</ol>
												</div>
											</div>
										</div>

									</div>
									<div id="edit" class="tab-pane">

										<form class="p-3" enctype="multipart/form-data" action="process.php" method="post">
											<h4 class="mb-3">Biodata User</h4>
											<div class="form-group">
												<label for="inputAddress">Nama</label>
												<input type="text" name="textNama" class="form-control" id="inputAddress" required value="<?php echo $_SESSION['OSH']['NAME'];?>">
											</div>
											<div class="form-group">
												<label for="inputAddress2">Email</label>
												<input type="email" name="emailEmail" class="form-control" id="inputAddress2" required value="<?php echo $_SESSION['OSH']['EMAIL'];?>">
											</div>
											<div class="form-group">
												<label for="inputAddress2">Password</label>
												<input type="password" name="passwordPassword" class="form-control" id="inputAddress2" required >
											</div>
											<div class="form-group">
												<label for="inputAddress2">Foto</label>
												<?php
												if($_SESSION['OSH']['PROFILE_PICTURE'] != ''){
													?>
													<div>
														<a class="btn btn-danger" href="process.php?module=DeleteProfilePicture">Ganti Profile Picture</a>
													</div>
													<?php
												} else {
													?>
													<input type="file" name="fileImage" class="form-control" id="inputAddress2" >
													<?php
												}
												?>
											</div>
											
											<div class="form-row">
												<div class="col-md-12 text-right mt-3">
													<button class="btn btn-primary modal-confirm">Save</button>
												</div>
											</div>
											
											<input type="hidden" name="module" value="UpdateMyProfile" />
										</form>

									</div>
								</div>
							</div>
						</div>
						
					</div>
					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close d-md-none">
							Collapse <i class="fas fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark"></div>
			
								<ul>
									<li>
										<time datetime="2017-04-19T00:00+00:00">04/19/2017</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<script src="<?php echo $repository_url;?>/vendor/jquery/jquery.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/popper/umd/popper.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/common/common.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="<?php echo $repository_url;?>/vendor/autosize/autosize.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $repository_url;?>/js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo $repository_url;?>/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $repository_url;?>/js/theme.init.js"></script>

	</body>
</html>