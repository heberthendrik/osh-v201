<?php
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../../library/function_list.php");
$repository_url = "../../../MASTER";
$current_id = $_GET['id'];
$petugas_parameter['ID'] = $current_id;
$function_GetPetugasByID = GetPetugasByID($petugas_parameter);
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
			<?php include('../../include/top_header.php'); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('../../include/navigation_sidebar.php'); ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body card-margin">
					<header class="page-header">
						<h2>Petugas</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>Petugas</span></li>
								<li><span>Detail</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open=""><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>
					
					<form class="form-horizontal form-bordered" method="post" action="process.php">
					
						<div style="margin-top:20px;">
						<?php include('../../include/system_message.php'); ?>
						</div>
					
						<div class="row">
							<div class="col">
								<section class="card" style="margin-top:20px;">
									<header class="card-header" style="text-align:right;">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a class="modal-basic btn btn-danger" href="#modalHapus">Hapus</a>	
										<a href="index.php" class="btn btn-warning">Kembali</a>

									

									<div id="modalHapus" class="modal-block modal-header-color modal-block-danger mfp-hide">
										<section class="card">
											<header class="card-header">
												<h2 class="card-title">Yakin untuk menghapus?</h2>
											</header>
											<div class="card-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fas fa-question-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Konfirmasi Penghapusan Data</h4>
														<p>Apakah Anda yakin untuk menghapus data ini?</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<a href="process.php?module=DeletePetugas&id=<?php echo $current_id ?>" class="btn btn-danger ">Hapus</a>
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
							<div class="col-lg-6">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Formulir Pembaharuan Data</h2>
									</header>
									<div class="card-body">
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Nama Petugas *</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="input_namapetugas" name="textNama" value="<?php echo rtrim($function_GetPetugasByID['NAME'][0]);?>" required >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">ID Karyawan *</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="input_namapetugas" name="textNIKEmployee" value="<?php echo rtrim($function_GetPetugasByID['NIK_EMPLOYEE'][0]);?>" required >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Status *</label>
											<div class="col-lg-6">
												<select class="form-control " id="input_status" name="selectStatus" required >
													<option value="0" <?php if( $function_GetPetugasByID['IS_ACTIVE'][0] == 0 ){ echo ' selected '; } ?> >Tidak Aktif</option>
													<option value="1" <?php if( $function_GetPetugasByID['IS_ACTIVE'][0] == 1 ){ echo ' selected '; } ?> >Aktif</option>
												</select>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Temp Password *</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="input_namapetugas" name="" value="<?php echo rtrim($function_GetPetugasByID['TEMP_PASSWORD'][0]);?>" readonly >
											</div>
										</div>
										
										<?php
										if( $_SESSION['OSH']['ID_ROLE'] == 1 ){
											?>
											<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">Rumah Sakit *</label>
												<div class="col-lg-6">
													<select class="form-control " id="input_idrs" name="selectRumahSakit" required >
														<option value="">--Pilih Rumah Sakit--</option>
														<?php
														$function_GetAllRumahSakit = GetAllRumahSakit();
														
														for( $i=0;$i<$function_GetAllRumahSakit['TOTAL_ROW'];$i++ ){
															
															if( $function_GetAllRumahSakit['ID'][$i] == $function_GetPetugasByID['ID_RS'][0] ){
																$selected_idrs = ' selected ';
															} else {
																$selected_idrs = '';
															}
															
															if( $function_GetAllRumahSakit['ID'][$i] > 1 ){
																?>
																<option value="<?php echo $function_GetAllRumahSakit['ID'][$i];?>" <?php echo $selected_idrs;?> ><?php echo $function_GetAllRumahSakit['NAMA'][$i];?></option>
																<?php	
															}
															
															
															
														}
														
														?>
													</select>
												</div>
											</div>	
											<?php
										}
										?>
											
										

									</div>
								</section>
							</div>
							
							
							
							<div class="col-lg-6">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Biodata Petugas</h2>
									</header>
									<div class="card-body">
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">No KTP *</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="input_namapetugas" name="textNIK" value="<?php echo rtrim($function_GetPetugasByID['NIK'][0]);?>" required >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">No Telp *</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="input_namapetugas" name="textNoTelp" value="<?php echo rtrim($function_GetPetugasByID['PHONE_NUMBER'][0]);?>" required >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Email *</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" id="input_namapetugas" name="emailEmail" value="<?php echo rtrim($function_GetPetugasByID['EMAIL'][0]);?>" required >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Jenis Kelamin *</label>
											<div class="col-lg-6">
												<select class="form-control" id="input_status" name="selectSex" required >
													<option value="">--Pilih Jenis Kelamin--</option>
													<option value="L" <?php if( $function_GetPetugasByID['SEX'][0] == "L" ){ echo ' selected '; } ?> >Laki-Laki</option>
													<option value="P" <?php if( $function_GetPetugasByID['SEX'][0] == "P" ){ echo ' selected '; } ?> >Perempuan</option>
												</select>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tanggal Lahir *</label>
											<div class="col-lg-6">
												<input type="date" class="form-control" id="input_namapasien" name="dateTanggalLahir" required  value="<?php echo $function_GetPetugasByID['BIRTH_DATE'][0]; ?>" >
											</div>
										</div>
											
										

									</div>
								</section>
							</div>
							
							
							
							
						</div>
					<!-- end: page -->
					
						<input type="hidden" name="module" value="UpdatePetugas" />
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