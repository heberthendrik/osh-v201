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
<!-- 										<button type="submit" class="btn btn-primary">Simpan</button> -->
										<?php
										if( $function_GetLabMasterByID['OVERALL_STATUS'][0] == 1 && $_SESSION['OSH']['ID_ROLE'] == 4 ){
											?>
											<a class="btn btn-default" href="update_lab.php?id=<?php echo $_GET['id'];?>">Edit</a>
											<a class="modal-basic btn btn-success" href="#modalACC">ACC</a>		
											<a class="modal-basic btn btn-danger" href="#modalTolak">Tolak</a>		
											<?php
										}
										?>
										
										<?php
										if( $function_GetLabMasterByID['OVERALL_STATUS'][0] == 2 ){
											?>
											<a href="print_trigger.php?lid=<?php echo $_GET['id'];?>" target="_blank" class="btn btn-default">Print</a>
											<?php
										}
										?>
										
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
										<h2 class="card-title">Data Lab</h2>
										<img alt="<?php echo $_GET['id'];?>" src="../../library/barcode.php?text=<?php echo $display_nolab;?>" style="float:right;margin-top:-30px;margin-bottom:-10px;" />
									</header>
									<div class="card-body">
										
										<div class="row">
											<div class="col-lg-6">
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Tanggal</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['CREATED_AT'][0]);?>" disabled >
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">No. Lab</label>
													<div class="col-lg-8">
														<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($display_nolab);?>" disabled >
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
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($functionx_GetDokterByID['NAME'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Dokter ACC</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['DOCTOR_ACC_NAME'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Petugas</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['MASTER_USER_LAB_CREATION_NAME'][0]);?>" disabled >
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
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">No. Rekam Medis</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['NO_RM'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Nama</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['PATIENT_NAME'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Tanggal Lahir</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['BIRTH_DATE'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Umur</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['AGE'][0]);?> <?php echo rtrim($function_GetLabMasterByID['UMUR_SAT'][0]);?>" disabled >
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-lg-4 control-label text-lg-right pt-2" for="inputDefault">Alamat</label>
											<div class="col-lg-8">
												<input type="text" class="form-control" id="input_namalab" name="textNama" value="<?php echo rtrim($function_GetLabMasterByID['PATIENT_ADDRESS'][0]);?>" disabled >
											</div>
										</div>
									</div>
								</section>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-8">
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
													
													if( $function_GetLabMasterByID['IS_LAB_DETAIL_EDITED'][0] == 1 ){
														$row_labdetail['HASIL'] = $row_labdetail['HASIL_EDIT'];
													} else {
														$row_labdetail['HASIL'] = $row_labdetail['HASIL'];
													}
													
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
														<td data-title="Hasil" class="text-right"><b><?php echo $row_labdetail['HASIL'];?></b></td>
														<td data-title="N Rujukan" class="text-right"><?php echo $row_labdetail['NILAI_RUJUKAN'];?></td>
														<td data-title="Satuan" class="text-right"><?php echo $row_labdetail['SATUAN'];?></td>
													</tr>
													<?php
													
												}
												
												?>
											</tbody>
										</table>
										
									</div>
								</section>
							</div>
							
							<div class="col-lg-4">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Histogram PLT, RBC, WBC</h2>
									</header>
									<div class="card-body">
										
										<?php
										
										$id = $_GET['id'];
										
										$query_xx = "select * from lab_histogram where barcode_number = '".$display_nolab."'";
										$result_xx = $db->query($query_xx);
										$row_xx = $result_xx->fetch_assoc();
										$image_base64 = $row_xx['IMAGE'];
										$image_base64_decode = base64_decode($image_base64);
										
										$explode_decoding = explode("{", $image_base64_decode);
										
										$rawvalue_plt = $explode_decoding[3];
										/*
										$ltrim_rawvalue_plt = substr($rawvalue_plt, 8);
										$rtrim_rawvalue_plt = substr($ltrim_rawvalue_plt, 0, -12);
										$nett_array_plt = explode(",", $rtrim_rawvalue_plt);
										*/
										$ltrim_rawvalue_plt = substr($rawvalue_plt, 7);
										$rtrim_rawvalue_plt = substr($ltrim_rawvalue_plt, 0, -11);
										$row_getgraphdata['plt_value'] = $rtrim_rawvalue_plt;

										$rawvalue_rbc = $explode_decoding[5];
										/*
										$ltrim_rawvalue_rbc = substr($rawvalue_rbc, 8);
										$rtrim_rawvalue_rbc = substr($ltrim_rawvalue_rbc, 0, -12);
										$nett_array_rbc = explode(",", $rtrim_rawvalue_rbc);
										*/
										$ltrim_rawvalue_rbc = substr($rawvalue_rbc, 7);
										$rtrim_rawvalue_rbc = substr($ltrim_rawvalue_rbc, 0, -11);
										$row_getgraphdata['rbc_value'] = $rtrim_rawvalue_rbc;
										
										$rawvalue_wbc = $explode_decoding[7];
										/*
										$ltrim_rawvalue_wbc = substr($rawvalue_wbc, 8);
										$rtrim_rawvalue_wbc = substr($ltrim_rawvalue_wbc, 0, -4);
										$nett_array_wbc = explode(",", $rtrim_rawvalue_wbc);
										*/
										$ltrim_rawvalue_wbc = substr($rawvalue_wbc, 7);
										$rtrim_rawvalue_wbc = substr($ltrim_rawvalue_wbc, 0, -3);
										$row_getgraphdata['wbc_value'] = $rtrim_rawvalue_wbc;
										
										
										
										
										
										
										
										
										
										
										
										
										
										//$query_getgraphdata = "select * from public.tab_lab_histogram where id = '".$id."'";
										//$result_getgraphdata = pg_query($db, $query_getgraphdata);
										//$row_getgraphdata = pg_fetch_assoc($result_getgraphdata);
										
										$arr[0]['plt_value'] = $row_getgraphdata['plt_value'];
										$arr[0]['rbc_value'] = $row_getgraphdata['rbc_value'];
										$arr[0]['wbc_value'] = $row_getgraphdata['wbc_value'];
									
									
									    $x_pltvalue = $arr[0]['plt_value'];
									    $sanitize_x_pltvalue = str_replace('[', '', $x_pltvalue);
									    $sanitize_x_pltvalue2 = str_replace(']', '', $sanitize_x_pltvalue);
									    $array_x_pltvalue = explode(',', $sanitize_x_pltvalue2);
									
									    $plt_graph_setting['y_max'] = 30;
									    $plt_graph_setting['count_x'] = count($array_x_pltvalue);
									    $plt_graph_setting['graph_width'] = 280;
									    $plt_graph_setting['graph_height'] = 150;
									    $plt_graph_setting['graph_canvas_height'] = $plt_graph_setting['graph_height'] + 20;
									    $plt_graph_setting['y_divider'] = 3;
									    $plt_graph_setting['x_index_skipper'] = 5;
									    $plt_graph_setting['x_legend_position_adjustment'] = 2;
									    $plt_graph_setting['graph_padding_left'] = 20;
									    $plt_graph_setting['legend_y_padding_top'] = 10;
									    $plt_graph_setting['value_multiplier'] = $plt_graph_setting['graph_height'] / $plt_graph_setting['y_max'];
									    ?>
										<div style="margin-bottom:10px;"><span
									    	style="background:rgba(0, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>PLT
											</div>
										<canvas id="plt-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>"
										        width="<?php echo $plt_graph_setting['graph_width'];?>"></canvas>
										<script>
										    var c = document.getElementById("plt-chart");
										    var ctx = c.getContext("2d");
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>, 0);
										    ctx.lineTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
										    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'] + $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
										    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>, 0);
										    ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>, 0);
										    ctx.stroke();
										
										    /* HORIZONTAL RULER */
										        <?php
										        for ($i = 0; $i < $plt_graph_setting['y_divider']; $i++) {
										            ?>
										        ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) ?>);
										        ctx.lineTo(<?php echo $plt_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) ?>);
										            <?php
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										    /* VERTICAL RULER */
										        <?php
										        for ($i = 0; $i < $plt_graph_setting['count_x']; $i = $i + $plt_graph_setting['x_index_skipper']) {
										            ?>
										        ctx.moveTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , 0);
										        ctx.lineTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , <?php echo $plt_graph_setting['graph_height'];?>);
										            <?php
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										
										    /* LEGEND X */
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
										        <?php
										        for ($i = 0; $i < $plt_graph_setting['count_x']; $i = $i + $plt_graph_setting['x_index_skipper']) {
										            ?>
										        ctx.fillText("<?php echo $array_x_pltvalue[$i]; ?>",<?php echo (((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) - $plt_graph_setting['x_legend_position_adjustment']) + $plt_graph_setting['graph_padding_left']);?>,<?php echo $plt_graph_setting['graph_canvas_height'];?>);
										            <?php
										        }
										        ?>
										
										    /* LEGEND Y */
										        <?php
										        for ($i = 0; $i <= $plt_graph_setting['y_divider']; $i++) {
										            if ($i < $plt_graph_setting['y_divider']) {
										                ?>
										            ctx.fillText("<?php echo($plt_graph_setting['y_max'] - ($i * $plt_graph_setting['y_max'] / $plt_graph_setting['y_divider']));?>", 0,<?php echo (($i * $plt_graph_setting['graph_height'] / $plt_graph_setting['y_divider']) + $plt_graph_setting['legend_y_padding_top']); ?>);
										                <?php
										            }
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										    /* VALUE */
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $plt_graph_setting['graph_padding_left'];?>,<?php echo $plt_graph_setting['graph_height'];?>);
										        <?php
										        for ($i = 0; $i < $plt_graph_setting['count_x']; $i++) {
										
										            $default_pltvalue = $array_x_pltvalue[$i];
										            $reverse_pltvalue = $plt_graph_setting['graph_height'] - ($default_pltvalue * $plt_graph_setting['value_multiplier']);
										            $last_i = $i;
										            ?>
										        ctx.lineTo( <?php echo ((($i) * ($plt_graph_setting['graph_width'] / $plt_graph_setting['count_x'])) + $plt_graph_setting['graph_padding_left']);?> , <?php echo $reverse_pltvalue; ?> );
										            <?php
										        }
										        ?>
										    ctx.lineTo( <?php echo $plt_graph_setting['graph_width'];?>, <?php echo $plt_graph_setting['graph_height']; ?> );
										    ctx.stroke();
										    ctx.fillStyle = "rgba(0, 255, 0, 0.6)";
										    ctx.fill();
										
										</script>
									
									
									
									
									    <?php
									    $x_rbcvalue = $arr[0]['rbc_value'];
									    $sanitize_x_rbcvalue = str_replace('[', '', $x_rbcvalue);
									    $sanitize_x_rbcvalue2 = str_replace(']', '', $sanitize_x_rbcvalue);
									    $array_x_rbcvalue = explode(',', $sanitize_x_rbcvalue2);
									
									    $rbc_graph_setting['y_max'] = 300;
									    $rbc_graph_setting['count_x'] = count($array_x_rbcvalue);
									    $rbc_graph_setting['graph_width'] = 280;
									    $rbc_graph_setting['graph_height'] = 150;
									    $rbc_graph_setting['graph_canvas_height'] = $rbc_graph_setting['graph_height'] + 20;
									    $rbc_graph_setting['y_divider'] = 3;
									    $rbc_graph_setting['x_index_skipper'] = 6;
									    $rbc_graph_setting['x_legend_position_adjustment'] = 2;
									    $rbc_graph_setting['graph_padding_left'] = 20;
									    $rbc_graph_setting['legend_y_padding_top'] = 10;
									    $plt_graph_setting['value_multiplier'] = $rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_max'];
									    ?>
										<div style="margin-top:25px;margin-bottom:10px;"><span
										    style="background:rgba(255, 0, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>RBC
										</div>
										<canvas id="rbc-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>"
										        width="<?php echo $rbc_graph_setting['graph_width'];?>"></canvas>
										<script>
										    var c = document.getElementById("rbc-chart");
										    var ctx = c.getContext("2d");
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>, 0);
										    ctx.lineTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
										    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'] + $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
										    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>, 0);
										    ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'];?>, 0);
										    ctx.stroke();
										
										    /* HORIZONTAL RULER */
										        <?php
										        for ($i = 0; $i < $rbc_graph_setting['y_divider']; $i++) {
										            ?>
										        ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_divider']) ?>);
										        ctx.lineTo(<?php echo $rbc_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_divider']) ?>);
										            <?php
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										    /* VERTICAL RULER */
										        <?php
										        for ($i = 0; $i < $rbc_graph_setting['count_x']; $i = $i + $rbc_graph_setting['x_index_skipper']) {
										            ?>
										        ctx.moveTo( <?php echo ((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) + $rbc_graph_setting['graph_padding_left']);?> , 0);
										        ctx.lineTo( <?php echo ((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) + $rbc_graph_setting['graph_padding_left']);?> , <?php echo $rbc_graph_setting['graph_height'];?>);
										            <?php
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										
										    /* LEGEND X */
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
										        <?php
										        for ($i = 0; $i < $rbc_graph_setting['count_x']; $i = $i + $rbc_graph_setting['x_index_skipper']) {
										            ?>
										        ctx.fillText("<?php echo $array_x_rbcvalue[$i]; ?>",<?php echo (((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) - $rbc_graph_setting['x_legend_position_adjustment']) + $rbc_graph_setting['graph_padding_left']);?>,<?php echo $rbc_graph_setting['graph_canvas_height'];?>);
										            <?php
										        }
										        ?>
										
										    /* LEGEND Y */
										        <?php
										        for ($i = 0; $i <= $rbc_graph_setting['y_divider']; $i++) {
										            if ($i < $rbc_graph_setting['y_divider']) {
										                ?>
										            ctx.fillText("<?php echo($rbc_graph_setting['y_max'] - ($i * $rbc_graph_setting['y_max'] / $rbc_graph_setting['y_divider']));?>", 0,<?php echo (($i * $rbc_graph_setting['graph_height'] / $rbc_graph_setting['y_divider']) + $rbc_graph_setting['legend_y_padding_top']); ?>);
										                <?php
										            }
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										    /* VALUE */
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $rbc_graph_setting['graph_padding_left'];?>,<?php echo $rbc_graph_setting['graph_height'];?>);
										        <?php
										        for ($i = 0; $i < $rbc_graph_setting['count_x']; $i++) {
										
										            $default_rbcvalue = $array_x_rbcvalue[$i];
										            $reverse_rbcvalue = $rbc_graph_setting['graph_height'] - ($default_rbcvalue * $plt_graph_setting['value_multiplier']);
										            $last_i = $i;
										            ?>
										        ctx.lineTo( <?php echo ((($i) * ($rbc_graph_setting['graph_width'] / $rbc_graph_setting['count_x'])) + $rbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_rbcvalue; ?> );
										            <?php
										        }
										        ?>
										    ctx.lineTo( <?php echo $rbc_graph_setting['graph_width'];?>, <?php echo $rbc_graph_setting['graph_height']; ?> );
										    ctx.stroke();
										    ctx.fillStyle = "rgba(255, 0, 0, 0.6)";
										    ctx.fill();
										
										</script>
									
									
									
									
									    <?php
									    $x_wbcvalue = $arr[0]['wbc_value'];
									    $sanitize_x_wbcvalue = str_replace('[', '', $x_wbcvalue);
									    $sanitize_x_wbcvalue2 = str_replace(']', '', $sanitize_x_wbcvalue);
									    $array_x_wbcvalue = explode(',', $sanitize_x_wbcvalue2);
									
									    $wbc_graph_setting['y_max'] = 50;
									    $wbc_graph_setting['count_x'] = count($array_x_wbcvalue);
									    $wbc_graph_setting['graph_width'] = 280;
									    $wbc_graph_setting['graph_height'] = 150;
									    $wbc_graph_setting['graph_canvas_height'] = $wbc_graph_setting['graph_height'] + 20;
									    $wbc_graph_setting['y_divider'] = 5;
									    $wbc_graph_setting['x_index_skipper'] = 5;
									    $wbc_graph_setting['x_legend_position_adjustment'] = 2;
									    $wbc_graph_setting['graph_padding_left'] = 20;
									    $wbc_graph_setting['legend_y_padding_top'] = 10;
									    $plt_graph_setting['value_multiplier'] = $wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_max'];
									    ?>
										<div style="margin-top:25px;margin-bottom:10px;"><span
										    style="background:rgba(255, 255, 0, 0.6);margin-right:10px;padding-left:20px;padding-right:20px;border:1px solid #d6d4d4;">&nbsp;</span>WBC
										</div>
										<canvas id="wbc-chart" height="<?php echo $plt_graph_setting['graph_canvas_height'];?>"
										        width="<?php echo $wbc_graph_setting['graph_width'];?>"></canvas>
										<script>
										    var c = document.getElementById("wbc-chart");
										    var ctx = c.getContext("2d");
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>, 0);
										    ctx.lineTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
										    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'] + $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
										    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>, 0);
										    ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'];?>, 0);
										    ctx.stroke();
										
										    /* HORIZONTAL RULER */
										        <?php
										        for ($i = 0; $i < $wbc_graph_setting['y_divider']; $i++) {
										            ?>
										        ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo ($i + 1) * ($wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_divider']) ?>);
										        ctx.lineTo(<?php echo $wbc_graph_setting['graph_width'];?>,<?php echo ($i + 1) * ($wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_divider']) ?>);
										            <?php
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										    /* VERTICAL RULER */
										        <?php
										        for ($i = 0; $i < $wbc_graph_setting['count_x']; $i = $i + $wbc_graph_setting['x_index_skipper']) {
										            ?>
										        ctx.moveTo( <?php echo ((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) + $wbc_graph_setting['graph_padding_left']);?> , 0);
										        ctx.lineTo( <?php echo ((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) + $wbc_graph_setting['graph_padding_left']);?> , <?php echo $wbc_graph_setting['graph_height'];?>);
										            <?php
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										
										    /* LEGEND X */
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
										        <?php
										        for ($i = 0; $i < $wbc_graph_setting['count_x']; $i = $i + $wbc_graph_setting['x_index_skipper']) {
										            ?>
										        ctx.fillText("<?php echo $array_x_wbcvalue[$i]; ?>",<?php echo (((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) - $wbc_graph_setting['x_legend_position_adjustment']) + $wbc_graph_setting['graph_padding_left']);?>,<?php echo $wbc_graph_setting['graph_canvas_height'];?>);
										            <?php
										        }
										        ?>
										
										    /* LEGEND Y */
										        <?php
										        for ($i = 0; $i <= $wbc_graph_setting['y_divider']; $i++) {
										            if ($i < $wbc_graph_setting['y_divider']) {
										                ?>
										            ctx.fillText("<?php echo($wbc_graph_setting['y_max'] - ($i * $wbc_graph_setting['y_max'] / $wbc_graph_setting['y_divider']));?>", 0,<?php echo (($i * $wbc_graph_setting['graph_height'] / $wbc_graph_setting['y_divider']) + $wbc_graph_setting['legend_y_padding_top']); ?>);
										                <?php
										            }
										        }
										        ?>
										    ctx.strokeStyle = "#d6d4d4";
										    ctx.stroke();
										
										    /* VALUE */
										    ctx.beginPath();
										    ctx.moveTo(<?php echo $wbc_graph_setting['graph_padding_left'];?>,<?php echo $wbc_graph_setting['graph_height'];?>);
										        <?php
										        for ($i = 0; $i < $wbc_graph_setting['count_x']; $i++) {
										
										            $default_wbcvalue = $array_x_wbcvalue[$i];
										            $reverse_wbcvalue = $wbc_graph_setting['graph_height'] - ($default_wbcvalue * $plt_graph_setting['value_multiplier']);
										            $last_i = $i;
										            ?>
										        ctx.lineTo( <?php echo ((($i) * ($wbc_graph_setting['graph_width'] / $wbc_graph_setting['count_x'])) + $wbc_graph_setting['graph_padding_left']);?> , <?php echo $reverse_wbcvalue; ?> );
										            <?php
										        }
										        ?>
										    ctx.lineTo( <?php echo $wbc_graph_setting['graph_width'];?>, <?php echo $wbc_graph_setting['graph_height']; ?> );
										    ctx.stroke();
										    ctx.fillStyle = "rgba(255, 255, 0, 0.6)";
										    ctx.fill();
										
										</script>
										
									</div>
								</section>
							</div>
							
							
						</div>
					<!-- end: page -->
					
						<input type="hidden" name="module" value="UpdateLab" />
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