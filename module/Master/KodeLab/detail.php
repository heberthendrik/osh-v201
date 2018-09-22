<?php
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../../library/function_list.php");
$repository_url = "../../../MASTER";
$current_id = $_GET['id'];
$kodelab_parameter['ID'] = $current_id;
$function_GetKodeLabByID = GetKodeLabByID($kodelab_parameter);
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

				<section role="main" class="content-body card-margin">
					<header class="page-header">
						<h2>Kode Lab</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
								<li><span>Kode Lab</span></li>
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
										<button type="submit" class="btn btn-primary" onclick="this.form.submit();">Simpan</button>
										<a class="modal-basic btn btn-danger" href="#modalTambahNilaiRujukan">Tambah Nilai Rujukan</a>	
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
														<a href="process.php?module=DeleteKodeLab&id=<?php echo $current_id ?>" class="btn btn-danger ">Hapus</a>
														<button class="btn btn-default modal-dismiss">Batal</button>
													</div>
												</div>
											</footer>
										</section>
									</div>
									
									<div id="modalTambahNilaiRujukan" class="modal-block modal-block-primary mfp-hide">
										<section class="card">
											<header class="card-header">
												<h2 class="card-title">Form Penambahan Nilai Rujukan</h2>
											</header>
											<div class="card-body">

												<div class="form-group">
													<label>Jenis Kelamin *</label>
														<select class="form-control mb-3" id="inputSex" name="selectSex" required >
															<option value="">--Pilih Jenis Kelamin--</option>
															<option value="L" <?php if( $function_GetKodeLabByID['STATUS'][0] == 'L' ){ echo ' selected '; } ?> >Laki - Laki</option>
															<option value="P" <?php if( $function_GetKodeLabByID['STATUS'][0] == 'P' ){ echo ' selected '; } ?> >Perempuan</option>
														</select>
												</div>
												<div class="form-group">
													<label for="inputAddress">Usia awal</label>
													<input type="number" name="numberUsiaAwal" class="form-control" id="inputUsiaAwal">
												</div>
												<div class="form-group">
													<label for="inputAddress">Usia akhir</label>
													<input type="number" name="numberUsiaAkhir" class="form-control" id="inputUsiaAkhir">
												</div>
												
												<div class="form-group">
													<label for="inputAddress">Satuan</label>
													<input type="text" name="textSatuan" class="form-control" id="inputSatuan">
												</div>
												
												<div class="form-group">
													<label for="inputAddress">Nilai Rujukan</label>
													<input type="number" name="textNilaiRujukan" class="form-control" id="inputNilaiRujukan">
												</div>
												
												<div class="form-group">
													<label for="inputAddress">Keterangan</label>
													<input type="text" name="textKeterangan" class="form-control" id="inputKeterangan">
												</div>
												<div class="form-group">
													<label>Status *</label>
													
													<select class="form-control mb-3" id="inputStatus" name="selectSex" required >
														<option value="0" <?php if( $function_GetKodeLabByID['STATUS'][0] == 'L' ){ echo ' selected '; } ?> >Tidak Aktif</option>
														<option value="1" <?php if( $function_GetKodeLabByID['STATUS'][0] == 'P' ){ echo ' selected '; } ?> >Aktif</option>
													</select>
													
												</div>

											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button onclick="window.location='process.php?module=TambahNilaiRujukan&id='+<?php echo $_GET['id'];?>+'&ket='+document.getElementById('inputKeterangan').value+'&sex='+document.getElementById('inputSex').value+'&usiaawal='+document.getElementById('inputUsiaAwal').value+'&usiaakhir='+document.getElementById('inputUsiaAkhir').value+'&satuan='+document.getElementById('inputSatuan').value+'&nilairujukan='+document.getElementById('inputNilaiRujukan').value+'&keterangan='+document.getElementById('inputKeterangan').value+'&status='+document.getElementById('inputStatus').value;" class="btn btn-primary modal-confirm">Simpan</button>
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
									
										<div class="row">
										
											<div class="col-lg-6">
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Nama Kode Lab *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namakodelab" name="textNama" value="<?php echo rtrim($function_GetKodeLabByID['NAME'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Group 1 *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_group1" name="textGroup1" value="<?php echo rtrim($function_GetKodeLabByID['GROUP_1'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Group 2 *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_group2" name="textGroup2" value="<?php echo rtrim($function_GetKodeLabByID['GROUP_2'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Group 3 *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_group3" name="textGroup3" value="<?php echo rtrim($function_GetKodeLabByID['GROUP_3'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Satuan *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_satuan" name="textSatuan" value="<?php echo rtrim($function_GetKodeLabByID['SATUAN'][0]);?>" required >
													</div>
												</div>
											</div>
											<div class="col-lg-6">
											
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Metoda *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_metoda" name="textMetoda" value="<?php echo rtrim($function_GetKodeLabByID['METODA'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Kode Lab *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namakodelab" name="textKodeLab" value="<?php echo rtrim($function_GetKodeLabByID['KD_LAB'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Kode LIS *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_kodelis" name="textKodeLis" value="<?php echo rtrim($function_GetKodeLabByID['KD_LIS'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Koma *</label>
													<div class="col-lg-8">
														<input type="number" class="form-control" id="input_koma" name="textKoma" value="<?php echo rtrim($function_GetKodeLabByID['KOMA'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">YFormat *</label>
													<div class="col-lg-8">
														<input type="number" class="form-control" id="input_yformat" name="textYFormat" value="<?php echo rtrim($function_GetKodeLabByID['YFORMAT'][0]);?>" required >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Kode dari alat *</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="inputkdfromdevice" name="textKodeDariAlat" value="<?php echo rtrim($function_GetKodeLabByID['KD_FROM_DEVICE'][0]);?>" required >
													</div>
												</div>
											
											</div>
											
										</div>
									
									</div>
								</section>
							</div>
						</div>
						
						<div class="row">
							<div class="col">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Nilai Rujukan</h2>
									</header>
									<div class="card-body">
										
										<table class="table table-bordered table-striped mb-0" id="datatable-default">
											<thead>
												<tr>
													<th>Jenis Kelamin</th>
													<th>Usia Awal</th>
													<th>Usia Akhir</th>
													<th>Satuan</th>
													<th>N Rujukan</th>
													<th>Keterangan</th>
													<th>Status</th>
													<th>Hapus Data</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$input_parameter_norujukan['ID_KDLAB'] = $current_id;
/* 												$function_GetAllNilaiRujukanByKodeLabID = GetAllNilaiRujukanByKodeLabID($input_parameter_norujukan); */
												
												for( $i=0;$i<$function_GetAllNilaiRujukanByKodeLabID['TOTAL_ROW'];$i++ ){
													
													?>
													<tr>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['SEX'][$i];?></td>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['AGE_1'][$i];?></td>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['AGE_2'][$i];?></td>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['UMUR_SAT'][$i];?></td>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['N_RUJUKAN'][$i];?></td>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['KET'][$i];?></td>
														<td><?php echo $function_GetAllNilaiRujukanByKodeLabID['STATUS'][$i];?></td>
														<td><a href="process.php?module=DeleteNilaiRujukan&id=<?php echo $function_GetAllNilaiRujukanByKodeLabID['ID'][$i];?>&kdlabid=<?php echo $current_id;?>" class="btn btn-danger">Hapus</a></td>
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
					
						<input type="hidden" name="module" value="UpdateKodeLab" />
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
		<script src="<?php echo $repository_url;?>/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
		
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
		
		<script src="<?php echo $repository_url;?>/js/examples/examples.datatables.default.js"></script>
		<script src="<?php echo $repository_url;?>/js/examples/examples.datatables.row.with.details.js"></script>
		<script src="<?php echo $repository_url;?>/js/examples/examples.datatables.tabletools.js"></script>

	</body>
</html>