<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include("../../library/function_list.php");
$repository_url = "../../MASTER";
?>
<!doctype html>
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
						<h2>Lab</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>Lab</span></li>
								<li><span>Tambah</span></li>
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
									</header>
								</section>
							</div>
						</div>
					
					<!-- start: page -->
						<div class="row">
							<div class="col">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Formulir Data Lab Baru</h2>
									</header>
									<div class="card-body">
										
										<div class="row">
											<div class="col-lg-6">
											
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tanggal *</label>
													<div class="col-lg-6">
														<input name="dateTanggal" type="date" class="form-control" id="input_tanggal" value="<?php echo date('Y-m-d');?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">No. Rekam medis *</label>
													<div class="col-lg-6">
														<input name="textNorm" type="textNorm" id="input_norm" class="form-control">
														<span class="input-group-append" style="float:right;margin-top:-38px;">
															<button onclick="AutoCompletePasien();" class="btn btn-default" type="button">Check</button>
														</span>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2">Ruang *</label>
													<div class="col-lg-6">
														<select name="selectRuang" class="form-control " id="input_idruang">
															<option value="">--Pilih Ruang--</option>
															<?php
															$function_GetAllRuang = GetAllRuang();
															
															for( $i=0;$i<$function_GetAllRuang['TOTAL_ROW'];$i++ ){
																
																?>
																<option value="<?php echo $function_GetAllRuang['ID'][$i];?>"><?php echo $function_GetAllRuang['NAMA'][$i];?></option>
																<?php
																
															}
															
															?>
														</select>
													</div>
												</div>
										
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2">Kelas *</label>
													<div class="col-lg-6">
														<select name="selectKelas" class="form-control " id="input_idkelas">
															<option value="">--Pilih Kelas--</option>
															<?php
															$function_GetAllKelas = GetAllKelas();
															
															for( $i=0;$i<$function_GetAllKelas['TOTAL_ROW'];$i++ ){
																
																?>
																<option value="<?php echo $function_GetAllKelas['ID'][$i];?>"><?php echo $function_GetAllKelas['NAMA'][$i];?></option>
																<?php
																
															}
															
															?>
														</select>
													</div>
												</div>
												
											</div>
											
											<div class="col-lg-6">
										
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2">Status *</label>
													<div class="col-lg-6">
														<select name="selectStatus" class="form-control " id="input_idstatus">
															<option value="">--Pilih Status--</option>
															<?php
															$function_GetAllStatus = GetAllStatus();
															
															for( $i=0;$i<$function_GetAllStatus['TOTAL_ROW'];$i++ ){
																
																?>
																<option value="<?php echo $function_GetAllStatus['ID'][$i];?>"><?php echo $function_GetAllStatus['NAMA'][$i];?></option>
																<?php
																
															}
															
															?>
														</select>
													</div>
												</div>
										
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Ket Klinik</label>
													<div class="col-lg-6">
														<input name="textKetKlinik" type="text" class="form-control" id="input_ketklinik" >
													</div>
												</div>
										
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Catatan 1</label>
													<div class="col-lg-6">
														<input name="textCatatan1" type="text" class="form-control" id="input_catatan1" >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Catatan 2</label>
													<div class="col-lg-6">
														<input name="textCatatan2" type="text" class="form-control" id="input_catatan2" >
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
										<h2 class="card-title">Data Dokter</h2>
									</header>
									<div class="card-body">
									
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Dr. Pengirim *</label>
											<div class="col-lg-6">
												<input name="textDrPengirim" type="text" class="form-control" id="input_alamatdokter" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Alamat Dokter</label>
											<div class="col-lg-6">
												<input name="textAlamatDokter" type="text" class="form-control" id="input_alamatdokter" >
											</div>
										</div>
										
										<?php
										if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
											?>
											<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">Rumah Sakit *</label>
												<div class="col-lg-6">
													<select name="selectRumahSakit" class="form-control " id="input_idrs" name="selectRumahSakit" required >
														<option value="">--Pilih Rumah Sakit--</option>
														<?php
														$function_GetAllRumahSakit = GetAllRumahSakit();
														
														for( $i=0;$i<$function_GetAllRumahSakit['TOTAL_ROW'];$i++ ){
															
															?>
															<option value="<?php echo $function_GetAllRumahSakit['ID'][$i];?>"><?php echo $function_GetAllRumahSakit['NAMA'][$i];?></option>
															<?php
															
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
										<h2 class="card-title">Data Pasien</h2>
									</header>
									<div class="card-body">
									
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Nama *</label>
											<div class="col-lg-6">
												<input name="inputNama" type="text" class="form-control" id="autocompleteNama" placeholder="--Silahkan isi No Rekam Medis Pasien--" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tgl lahir *</label>
											<div class="col-lg-6">
												<input name="dateTanggalLahir" type="text" class="form-control" id="autocompleteTglLahir" placeholder="--Silahkan isi No Rekam Medis Pasien--" disabled >
											</div>
										</div>
										
									</div>
								</section>
							</div>
							
						</div>
					<!-- end: page -->
					
						<input type="hidden" name="module" value="AddHasilLabMaster" />
						<input type="hidden" name="hiddenNama" value="" id="input_nama" />
						<input type="hidden" name="hiddenTglLahir" value="" id="input_tgllahir" />
						<input type="hidden" name="hiddenAlamat" value="" id="input_alamat" />
						<input type="hidden" name="hiddenSex" value="" id="input_sex" />
						
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

		<script>
			function AutoCompletePasien(){
			
				no_rm = document.getElementById("input_norm").value;
				
	        	var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						
						var jsonData = JSON.parse(this.responseText);
						var function_result = jsonData.function_result;
						system_message = jsonData.system_message;
						
						if( jsonData.function_result != 1 ){
							alert(jsonData.system_message);	
						}
						
						document.getElementById('autocompleteNama').value = jsonData.nama;
						document.getElementById('autocompleteTglLahir').value = jsonData.tgl_lahir;
						
						document.getElementById('input_nama').value = jsonData.nama;
						document.getElementById('input_tgllahir').value = jsonData.tgl_lahir;
						document.getElementById('input_alamat').value = jsonData.alamat;
						document.getElementById('input_sex').value = jsonData.sex;
						
					}
				};
				xhttp.open("POST", "http://localhost/development_site/osh-v200/module/Lab/apiAutoCompletePasien.php?action=AutoCompletePasien", true);
				xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhttp.send("no_rm="+no_rm);
			
			}
		</script>

	</body>
</html>