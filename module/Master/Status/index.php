<?php
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../../library/function_list.php");
$repository_url = "../../../MASTER";
?>
<!doctype html>
<html class="fixed sidebar-light ">
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

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/select2/css/select2.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/datatables/media/css/dataTables.bootstrap4.css" />

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
			<?php include('../../include/top_header.php'); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('../../include/navigation_sidebar.php'); ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Status</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>Status</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open=""><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>
					
					<?php include('../../include/system_message.php'); ?>

					<!-- start: page -->
						<div class="row">
							<div class="col">
								<section class="card">
									<header class="card-header" style="text-align:right;">
										<a href="add.php" class="btn btn-primary">Tambah Data</a>
									</header>
								</section>
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Data Lengkap</h2>
									</header>
									<div class="card-body">
										<table class="table table-bordered table-striped mb-0" id="datatable-default">
											<thead>
												<tr>
													<th>System ID</th>
													<th>Nama</th>
													<th>Status</th>
													<th>Rumah Sakit</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$function_GetAllStatus = GetAllStatus();
												
												for( $i=0;$i<$function_GetAllStatus['TOTAL_ROW'];$i++ ){
												
													if( $function_GetAllStatus['STATUS'][$i] == 1 ){
														$display_status = '<span class="badge badge-success" style="width:100%;padding-top:5px;padding-bottom:5px;">Aktif</span>';
													} else {
														$display_status = '<span class="badge badge-warning" style="width:100%;padding-top:5px;padding-bottom:5px;">Tidak Aktif</span>';
													}
													
													$input_parameter_rs['ID'] = $function_GetAllStatus['ID_RS'][$i];
													$function_GetRumahSakitByID = GetRumahSakitByID($input_parameter_rs);
													
													if( $function_GetAllStatus['ID'][$i] > 1 ){
														?>
														<tr onclick="window.location='detail.php?id=<?php echo $function_GetAllStatus['ID'][$i] ;?>'">
															<td><?php echo ($i+1);?></td>
															<td><?php echo $function_GetAllStatus['NAMA'][$i];?></td>
															<td><?php echo $display_status;?></td>
															<td><?php echo $function_GetRumahSakitByID['NAMA'][0];?></td>
														</tr>
														<?php	
													}
													
												}
												
												?>
											</tbody>
										</table>
									</div>
								</section>
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
											<img src="<?php echo $repository_url;?>/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="<?php echo $repository_url;?>/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="<?php echo $repository_url;?>/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="<?php echo $repository_url;?>/img/!sample-user.jpg" alt="Joseph Doe" class="rounded-circle">
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
		<script src="<?php echo $repository_url;?>/vendor/select2/js/select2.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $repository_url;?>/js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo $repository_url;?>/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $repository_url;?>/js/theme.init.js"></script>

		<!-- Examples -->
		<script src="<?php echo $repository_url;?>/js/examples/examples.datatables.default.js"></script>
		<script src="<?php echo $repository_url;?>/js/examples/examples.datatables.row.with.details.js"></script>
		<script src="<?php echo $repository_url;?>/js/examples/examples.datatables.tabletools.js"></script>
	</body>
</html>