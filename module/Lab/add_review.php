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
						<h2>Lab - Tahap 4: Pemeriksaan Final </h2>
					
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
					
					<form class="form-horizontal form-bordered" method="post" action="">
					
						<div style="margin-top:20px;">
						<?php include('../include/system_message.php'); ?>
						</div>
					
						<div class="row">
							<div class="col">
								<section class="card" style="margin-top:20px;">
									<header class="card-header" style="text-align:right;">
<!-- 										<button type="submit" class="btn btn-primary">Simpan</button> -->
										
										<a href="process.php?module=FinalizeLabInput&id=<?php echo $_GET['id'];?>" class="btn btn-danger">Simpan</a>
										<a href="add_3.php?id=<?php echo $_GET['id'];?>" class="btn btn-warning">Kembali</a>

									

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
						
						<div class="row">
							<div class="col">
								<section class="card">
									<div class="card-body">
										<div class="progress light m-2">
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
												Langkah 4/4
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
					
					<!-- start: page -->
						<div class="row">
							<div class="col-lg-12">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Data Lab</h2>
										<!--
										<img alt="<?php echo $_GET['id'];?>" src="../../library/barcode.php?text=<?php echo $_GET['id'];?>" style="float:right;margin-top:-30px;margin-bottom:-10px;" />
										-->
									</header>
									<div class="card-body">
										
										<div class="row">
											<div class="col-lg-6">
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Tanggal</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo date('Y-m-d H:i:s');?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">No. Rekam Medis</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['NO_RM'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Ruang</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['ROOM_NAME'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Kelas</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['KELAS_NAME'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Dokter Pemeriksa</label>
													<div class="col-lg-8">
														<?php
														$input_parameter_iddokterassigned['ID'] = $function_GetLabMasterByID['ID_DOCTOR_ASSIGNED'][0];
														$functionx_GetDokterByID = GetDokterByID($input_parameter_iddokterassigned);
														
														if( $input_parameter_iddokterassigned['ID'] == 0 ){
															$functionx_GetDokterByID['NAME'][0] = "Semua Dokter";
														}
														
														?>
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo $functionx_GetDokterByID['NAME'][0];?>" disabled >
													</div>
												</div>
												
											</div>
											<div class="col-lg-6">
											
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Status</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['STATUS_NAME'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Ket Klinik</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['KET_KLINIK'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Catatan 1</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['NOTE_1'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Catatan 2</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['NOTE_2'][0]);?>" disabled >
													</div>
												</div>
											
											</div>
											
										</div>
										
										
										
										
										
									</div>
								</section>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">
											Data Dokter Pengirim 
											<?php
											if( $function_GetLabMasterByID['IS_INTERNAL_DOCTOR'][0] == 1 ){
												?>
												- <span style="color:red;"><strong>[INTERNAL]</strong></span>
												<?php
											} else {
												?>
												- <span style="color:red;"><strong>[EKSTERNAL]</strong></span>
												<?php
											}
											?>
										</h2>
									</header>
									<div class="card-body">
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Dokter Pengirim</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['DOCTOR_SENDER_NAME'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Alamat Dokter</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['DOCTOR_SENDER_ADDRESS'][0]);?>" disabled >
											</div>
										</div>
										
									</div>
								</section>
							</div>
							<div class="col-lg-6">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Data Pasien</h2>
									</header>
									<div class="card-body">
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Nama</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['PATIENT_NAME'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">No Rekam Medis</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['NO_RM'][0]);?>" disabled >
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
						
						
					<!-- end: page -->
					
<!-- 						<input type="hidden" name="module" value="UpdateLab" /> -->
<!-- 						<input type="hidden" name="currentID" value="<?php echo $current_id;?>" /> -->
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