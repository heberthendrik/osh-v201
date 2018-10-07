<?php
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../library/function_list.php");
$repository_url = "../../MASTER";
$current_id = $_GET['id'];
$lab_parameter['ID'] = $current_id;
$function_GetLabMasterByID = GetLabMasterByID($lab_parameter);

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
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

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

				<section role="main" class="content-body card-margin">
					<header class="page-header">
						<?php
						if( strlen($function_GetLabMasterByID['NO_LAB'][0]) == 1 ){
							$function_GetLabMasterByID['NO_LAB'][0] = '00'.$function_GetLabMasterByID['NO_LAB'][0];
						} else if( strlen($function_GetLabMasterByID['NO_LAB'][0]) == 2 ){
							$function_GetLabMasterByID['NO_LAB'][0] = '00'.$function_GetLabMasterByID['NO_LAB'][0];
						} else if( strlen($function_GetLabMasterByID['NO_LAB'][0]) == 3 ){
							$function_GetLabMasterByID['NO_LAB'][0] = $function_GetLabMasterByID['NO_LAB'][0];
						}
						
						$display_nolab = $function_GetLabMasterByID['NO_LAB_PREFIX'][0].$function_GetLabMasterByID['NO_LAB'][0];
						?>
						<h2>Hasil Lab - <span style="color:red;"><?php echo $display_nolab;?></span> - <span style="color:red;"><?php echo rtrim($function_GetLabMasterByID['PATIENT_NAME'][0]);?></span> </h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>Lab</span></li>
								<li><span>Detail</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open=""><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>
					
					<form class="form-horizontal form-bordered" method="post" action="process.php">
					
						<div style="margin-top:20px;">
						<?php include('../include/system_message.php'); ?>
						</div>
					
						<div class="row">
							<div class="col">
								<section class="card" style="margin-top:20px;">
									<header class="card-header" style="text-align:right;">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="index.php" class="btn btn-warning">Kembali</a>

									

									<div id="modalACC" class="modal-block modal-header-color modal-block-success mfp-hide">
										<section class="card">
											<header class="card-header">
												<h2 class="card-title">Are you sure?</h2>
											</header>
											<div class="card-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fas fa-question-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Acc Hasil Lab</h4>
														<p>Apakah Anda yakin untuk melakukan acc hasil lab ini?</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<a href="process.php?module=AccHasilLab&id=<?php echo $current_id ?>" class="btn btn-success ">Ya</a>
														<button class="btn btn-default modal-dismiss">Batal</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
									
									<div id="modalTolak" class="modal-block modal-header-color modal-block-danger mfp-hide">
										<section class="card">
											<header class="card-header">
												<h2 class="card-title">Are you sure?</h2>
											</header>
											<div class="card-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fas fa-question-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Tolak Hasil Lab</h4>
														<p>Apakah Anda yakin untuk menolak acc hasil lab ini?</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<a href="process.php?module=TolakHasilLab&id=<?php echo $current_id ?>" class="btn btn-danger ">Ya</a>
														<button class="btn btn-default modal-dismiss">Batal</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
									
									
									
									</header>
								</section>
							</div>
						</div>
					
					<!-- start: page -->
						
						<div class="row">
							<div class="col-lg-12">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Data Analisa Darah</h2>
									</header>
									<div class="card-body">
										
										<table class="table table-no-more table-bordered table-striped mb-0">
											<thead>
												<tr>
													<th class="text-right">Pemeriksaan</th>
													<th class="text-right">Hasil</th>
													<th class="text-right">Nilai Rujukan</th>
													<th class="text-right">Satuan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												
												$query_update = "update lab_detail set ID_LAB_MAIN = '".$_GET['id']."' where BARCODE_NUMBER = '".$display_nolab."'";
												$result_update = $db->query($query_update);
												
												$query_labdetail = "select * from lab_detail where ID_LAB_MAIN = '".$_GET['id']."'";
												$result_labdetail = $db->query($query_labdetail);
												$num_labdetail = $result_labdetail->num_rows;
												
												while( $row_labdetail = $result_labdetail->fetch_assoc() ){
												
													$query_getnmlab = "select NAME from lab_code where id = '".$row_labdetail['ID_LAB_CODE']."'";
													$result_getnmlab = $db->query($query_getnmlab);
													$row_getnmlab = $result_getnmlab->fetch_assoc();
													
													$nilai_rujukan_explode = explode('-', $row_labdetail['NILAI_RUJUKAN']);
													$nilai_rujukan_awal = $nilai_rujukan_explode[0];
													$nilai_rujukan_akhir = $nilai_rujukan_explode[1];
													$nilai_rujukan_selisih = $nilai_rujukan_akhir - $nilai_rujukan_awal;
													
													if( $row_labdetail['HASIL'] >= $nilai_rujukan_awal && $row_labdetail['HASIL'] <= $nilai_rujukan_akhir ){
														$tr_color = ' color:green; ';
													} else if( 
																($row_labdetail['HASIL'] < $nilai_rujukan_awal && $row_labdetail['HASIL'] >= ($nilai_rujukan_awal-$nilai_rujukan_selisih))
																|| 
																($row_labdetail['HASIL'] > $nilai_rujukan_akhir && $row_labdetail['HASIL'] <= ($nilai_rujukan_akhir+$nilai_rujukan_selisih))
															){
														$tr_color = ' color:red; ';
													} else {
														$tr_color = ' color:purple; ';
													} 
													
													?>
													<tr style="font-weight:bold;<?php echo $tr_color;?>">
														<td data-title="Pemeriksaan" class="text-right"><?php echo $row_getnmlab['NAME'];?></td>
														<td data-title="Hasil" class="text-right"><b><input class="form-control" type="text" name="array_hasil[]" value="<?php echo $row_labdetail['HASIL'];?>" style="width:100%;" /></b></td>
														<td data-title="N Rujukan" class="text-right"><?php echo $row_labdetail['NILAI_RUJUKAN'];?></td>
														<td data-title="Satuan" class="text-right"><?php echo $row_labdetail['SATUAN'];?></td>
														<input type="hidden" name="array_labdetail[]" value="<?php echo $row_labdetail['ID']; ?>" />
													</tr>
													<?php
													
												}
												
												?>
											</tbody>
										</table>
										
									</div>
								</section>
							</div>
							
						</div>
					<!-- end: page -->
					
						<input type="hidden" name="module" value="UpdateLabDetail" />
						<input type="hidden" name="currentID" value="<?php echo $current_id;?>" />
					</form>
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
		<script src="<?php echo $repository_url;?>/vendor/autosize/autosize.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $repository_url;?>/js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo $repository_url;?>/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $repository_url;?>/js/theme.init.js"></script>
		<script src="<?php echo $repository_url;?>/js/examples/examples.modals.js"></script>

	</body>
</html>