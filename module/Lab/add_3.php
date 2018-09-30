<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
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
						<h2>Lab - Tahap 3: Pengisian Data Laboratorium</h2>
					
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
										<button type="submit" class="btn btn-primary">Lanjutkan</button>
										<a href="add_2.php?id=<?php echo $_GET['id'];?>&pid<?php echo $_GET['pid']; ?>" class="btn btn-warning">Kembali ke Tahap 2</a>
									</header>
								</section>
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<section class="card">
									<div class="card-body">
										<div class="progress light m-2">
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
												Langkah 3/4
											</div>
										</div>
									</div>
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
													<label class="col-lg-4 control-label text-lg-right pt-2">Ruang *</label>
													<div class="col-lg-8">
														<select name="selectRuang" class="form-control " id="input_idruang" required>
															<option value="0">--Pilih Ruang--</option>
															<?php
															$function_GetAllRuang = GetAllRuang();
															
															for( $i=0;$i<$function_GetAllRuang['TOTAL_ROW'];$i++ ){
															
																if( $function_GetAllRuang['ID'][$i] == $function_GetLabMasterByID['ID_ROOM'][0] ){
																	$selected_room = ' selected ';
																} else {
																	$selected_room = '';
																}
																
																if( $function_GetAllRuang['ID'][$i] > 1 && $function_GetAllRuang['ID_RS'][$i] == $function_GetLabMasterByID['ID_RS'][0] && $function_GetAllRuang['STATUS'][$i] == 1 ){
																	?>
																	<option value="<?php echo $function_GetAllRuang['ID'][$i];?>" <?php echo $selected_room;?> ><?php echo $function_GetAllRuang['NAMA'][$i];?></option>
																	<?php	
																}
																
															}
															
															?>
														</select>
													</div>
												</div>
										
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2">Kelas *</label>
													<div class="col-lg-8">
														<select name="selectKelas" class="form-control " id="input_idkelas" required>
															<option value="0">--Pilih Kelas--</option>
															<?php
															$function_GetAllKelas = GetAllKelas();
															
															for( $i=0;$i<$function_GetAllKelas['TOTAL_ROW'];$i++ ){
															
																if( $function_GetAllKelas['ID'][$i] == $function_GetLabMasterByID['ID_KELAS'][0] ){
																	$selected_kelas = ' selected ';
																} else {
																	$selected_kelas = '';
																}
																
																if( $function_GetAllKelas['ID'][$i] > 1 && $function_GetAllKelas['ID_RS'][$i] == $function_GetLabMasterByID['ID_RS'][0] && $function_GetAllKelas['STATUS'][$i] == 1 ){
																	?>
																	<option value="<?php echo $function_GetAllKelas['ID'][$i];?>" <?php echo $selected_kelas;?> ><?php echo $function_GetAllKelas['NAMA'][$i];?></option>
																	<?php	
																}
																
															}
															
															?>
														</select>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2">Status *</label>
													<div class="col-lg-8">
														<select name="selectStatus" class="form-control " id="input_idstatus" required>
															<option value="0">--Pilih Status--</option>
															<?php
															$function_GetAllStatus = GetAllStatus();
															
															for( $i=0;$i<$function_GetAllStatus['TOTAL_ROW'];$i++ ){
																
																if( $function_GetAllStatus['ID'][$i] == $function_GetLabMasterByID['ID_STATUS'][0] ){
																	$selected_status = ' selected ';
																} else {
																	$selected_status = '';
																}
																
																if( $function_GetAllStatus['ID'][$i] > 1 && $function_GetAllStatus['ID_RS'][$i] == $function_GetLabMasterByID['ID_RS'][0] && $function_GetAllStatus['STATUS'][$i] == 1 ){
																	?>
																	<option value="<?php echo $function_GetAllStatus['ID'][$i];?>" <?php echo $selected_status;?> ><?php echo $function_GetAllStatus['NAMA'][$i];?></option>
																	<?php
																}
																
															}
															
															?>
														</select>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2">Dokter Pemeriksa</label>
													<div class="col-lg-8">
														<select name="selectIDDokterPemeriksa" class="form-control " id="input_idstatus">
															<option value="0">--Semua Dokter--</option>
															<?php
															$function_GetAllDokter = GetAllDokter();
															
															for( $i=0;$i<$function_GetAllDokter['TOTAL_ROW'];$i++ ){
																
																if( $function_GetAllDokter['ID'][$i] == $function_GetLabMasterByID['ID_DOCTOR_ASSIGNED'][0] ){
																	$selected_doctor = ' selected ';
																} else {
																	$selected_doctor = '';
																}
																
																if( $function_GetAllDokter['ID'][$i] > 1 && $function_GetAllDokter['ID_RS'][$i] == $function_GetLabMasterByID['ID_RS'][0] ){
																	?>
																	<option value="<?php echo $function_GetAllDokter['ID'][$i];?>" <?php echo $selected_doctor;?> ><?php echo $function_GetAllDokter['NAME'][$i];?></option>
																	<?php
																}
																
															}
															
															?>
														</select>
													</div>
												</div>
												
											</div>
											
											<div class="col-lg-6">
										
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Ket Klinik</label>
													<div class="col-lg-8">
														<input name="textKetKlinik" type="text" class="form-control" id="input_ketklinik" value="<?php echo $function_GetLabMasterByID['KET_KLINIK'][0];?>" >
													</div>
												</div>
										
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Catatan 1</label>
													<div class="col-lg-8">
														<input name="textCatatan1" type="text" class="form-control" id="input_catatan1" value="<?php echo $function_GetLabMasterByID['NOTE_1'][0];?>" >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Catatan 2</label>
													<div class="col-lg-8">
														<input name="textCatatan2" type="text" class="form-control" id="input_catatan2" value="<?php echo $function_GetLabMasterByID['NOTE_2'][0];?>" >
													</div>
												</div>
												
											</div>
											
										</div>
										
									</div>
								</section>
							</div>
						</div>
						
					<!-- end: page -->
					
						<input type="hidden" name="module" value="AddHasilLabMasterPreview" />
						<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
						
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