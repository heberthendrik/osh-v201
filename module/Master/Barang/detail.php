<?php
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../../library/function_list.php");
$repository_url = "../../../MASTER";
$current_id = $_GET['id'];
$barang_parameter['ID'] = $current_id;
$function_GetBarangByID = GetBarangByID($barang_parameter);
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
			<?php include('../../include/top_header.php'); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('../../include/navigation_sidebar.php'); ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body card-margin">
					<header class="page-header">
						<h2>Barang</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>Barang</span></li>
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
												<h2 class="card-title">Are you sure?</h2>
											</header>
											<div class="card-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fas fa-question-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Primary</h4>
														<p>Are you sure that you want to delete this image?</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<a href="process.php?module=DeleteBarang&id=<?php echo $current_id ?>" class="btn btn-danger ">Confirm</a>
														<button class="btn btn-default modal-dismiss">Cancel</button>
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
							<div class="col">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Formulir Pembaharuan Data</h2>
									</header>
									<div class="card-body">
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Nama Barang *</label>
											<div class="col-lg-6">
												<input name="textNama" type="text" class="form-control" id="input_namabarang" value="<?php echo rtrim($function_GetBarangByID['NAME'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Satuan *</label>
											<div class="col-lg-6">
												<select name="selectSatuan" class="form-control mb-3" id="input_satuan">
													<option value="">--Pilih Satuan--</option>
													<?php
													$function_GetAllSatuan = GetAllSatuan();
													
													for( $i=0;$i<$function_GetAllSatuan['TOTAL_ROW'];$i++ ){
														
														if( rtrim($function_GetAllSatuan['ID'][$i]) == rtrim($function_GetBarangByID['ID_SATUAN'][0]) ){
															$selected_satuan = ' selected ';														
														} else {
															$selected_satuan = '';
														}
														
														?>
														<option value="<?php echo rtrim($function_GetAllSatuan['ID'][$i]);?>" <?php echo $selected_satuan;?> ><?php echo $function_GetAllSatuan['NAMA'][$i];?></option>
														<?php
														
													}
													
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Katalog *</label>
											<div class="col-lg-6">
												<input name="textKatalog" type="text" class="form-control" id="input_katalog" value="<?php echo rtrim($function_GetBarangByID['KATALOG'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Kategori *</label>
											<div class="col-lg-6">
												<select name="selectKategori" class="form-control mb-3" id="input_idkategori">
													<option value="">--Pilih Kategori--</option>
													<?php
													$function_GetAllKategori = GetAllKategori();
													
													for( $i=0;$i<$function_GetAllKategori['TOTAL_ROW'];$i++ ){
														
														if( rtrim($function_GetAllKategori['ID'][$i]) == rtrim($function_GetBarangByID['ID_KATEGORI'][0]) ){
															$selected_kategori = ' selected ';														
														} else {
															$selected_kategori = '';
														}
														
														?>
														<option value="<?php echo $function_GetAllKategori['ID'][$i];?>" <?php echo $selected_kategori;?> ><?php echo $function_GetAllKategori['NAMA'][$i];?></option>
														<?php
														
													}
													
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">ID Supplier *</label>
											<div class="col-lg-6">
												<input name="textIDSupplier" type="text" class="form-control" id="input_idsupplier" value="<?php echo rtrim($function_GetBarangByID['ID_SUPPLIER'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tgl Masuk *</label>
											<div class="col-lg-6">
												<input name="dateTglMasuk" type="date" class="form-control" id="input_tglmasuk" value="<?php echo $function_GetBarangByID['TGL_MASUK'][0];?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Merk</label>
											<div class="col-lg-6">
												<select name="selectMerk" class="form-control mb-3" id="input_merk">
													<option value="0">--Pilih Merk--</option>
													<?php
													$function_GetAllMerk = GetAllMerk();
													
													for( $i=0;$i<$function_GetAllMerk['TOTAL_ROW'];$i++ ){
														
														if( rtrim($function_GetAllMerk['ID'][$i]) == rtrim($function_GetBarangByID['ID_MERK'][0]) ){
															$selected_merk = ' selected ';														
														} else {
															$selected_merk = '';
														}
														
														?>
														<option value="<?php echo $function_GetAllMerk['ID'][$i];?>" <?php echo $selected_merk;?> ><?php echo $function_GetAllMerk['NAMA'][$i];?></option>
														<?php
														
													}
													
													?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tipe *</label>
											<div class="col-lg-6">
												<input name="textTipe" type="text" class="form-control" id="input_tipe" value="<?php echo rtrim($function_GetBarangByID['TIPE'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">ID Principal *</label>
											<div class="col-lg-6">
												<input name="textIDPrincipal" type="text" class="form-control" id="input_idprincipal" value="<?php echo rtrim($function_GetBarangByID['ID_PRINCIPAL'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Harga Perolehan *</label>
											<div class="col-lg-6">
												<input name="numberHargaPerolehan" type="number" class="form-control" id="input_hargaperolehan" value="<?php echo $function_GetBarangByID['HRG_PEROLEHAN'][0];?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Harga Jual *</label>
											<div class="col-lg-6">
												<input name="numberHargaJual" type="number" class="form-control" id="input_hargajual" value="<?php echo $function_GetBarangByID['HRG_JUAL'][0];?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2">Status *</label>
											<div class="col-lg-6">
												<select name="selectStatus" class="form-control mb-3" id="input_status">
													<option value="0" <?php if( $function_GetBarangByID['STATUS'][0] == 0 ){ echo ' selected '; } ?> >Tidak Aktif</option>
													<option value="1" <?php if( $function_GetBarangByID['STATUS'][0] == 1 ){ echo ' selected '; } ?> >Aktif</option>
												</select>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Komputer *</label>
											<div class="col-lg-6">
												<input name="textKomputer" type="text" class="form-control" id="input_komputer" value="<?php echo rtrim($function_GetBarangByID['KOMPUTER'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">User *</label>
											<div class="col-lg-6">
												<input name="textUser" type="text" class="form-control" id="input_user" value="<?php echo rtrim($function_GetBarangByID['NAMA_USER'][0]);?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tgl Entri *</label>
											<div class="col-lg-6">
												<input name="dateTglEntri" type="date" class="form-control" id="input_tglentri" value="<?php echo $function_GetBarangByID['TGL_ENTRI'][0];?>" >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Diskonv *</label>
											<div class="col-lg-6">
												<input name="textDiskonv" type="text" class="form-control" id="input_diskonv" value="<?php echo rtrim($function_GetBarangByID['DISKONV'][0]);?>" >
											</div>
										</div>
				
										<?php
										if( $_SESSION['OSH']['ROLES'] == 'superadmin' ){
											?>
											<div class="form-group row">
												<label class="col-lg-3 control-label text-lg-right pt-2">Rumah Sakit *</label>
												<div class="col-lg-6">
													<select class="form-control mb-3" id="input_idrs" name="selectRumahSakit" required >
														<option value="">--Pilih Rumah Sakit--</option>
														<?php
														$function_GetAllRumahSakit = GetAllRumahSakit();
														
														for( $i=0;$i<$function_GetAllRumahSakit['TOTAL_ROW'];$i++ ){
															
															if( $function_GetAllRumahSakit['ID'][$i] == $function_GetBarangByID['ID_RS'][0] ){
																$selected_idrs = ' selected ';
															} else {
																$selected_idrs = '';
															}
															
															?>
															<option value="<?php echo $function_GetAllRumahSakit['ID'][$i];?>" <?php echo $selected_idrs;?> ><?php echo $function_GetAllRumahSakit['NAMA'][$i];?></option>
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
						</div>
					<!-- end: page -->
					
						<input type="hidden" name="module" value="UpdateBarang" />
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