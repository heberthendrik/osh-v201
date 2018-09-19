<?php
session_start();
/* error_reporting(E_ALL); */
/* ini_set('display_errors', 1); */
include("../../library/function_list.php");
$repository_url = "../../MASTER";
?>
<!doctype html>
<html class="fixed sidebar-light">
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
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/jquery-ui/jquery-ui.theme.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/morris/morris.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/morris/morris.css" />
		<link rel="stylesheet" href="<?php echo $repository_url;?>/vendor/chartist/chartist.min.css" />

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
						<h2>Dashboard</h2>
					
						<div class="right-wrapper text-right">
							<ol class="breadcrumbs">
								<li>
									<a href="<?php echo GetMasterLink();?>/module/Dashboard/index.php">
										<i class="fas fa-home"></i>
									</a>
								</li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open=""><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>
					
					<div class="row">
						<div class="col-lg-3 mb-3">
							<section class="card card-featured-left card-featured-primary mb-3">
								<div class="card-body">
									<div class="widget-summary">
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title">Today Lab Number</h4>
												<div class="info">
													<?php
													$query_gettodaylabnumber = "select COUNT(ID::int) as todaylabnumber from tab_lab_master where created_at::date = '".date('Y-m-d')."'::date";
													$result_gettodaylabnumber = pg_query($db, $query_gettodaylabnumber);
													$row_gettodaylabnumber = pg_fetch_assoc($result_gettodaylabnumber);
													$todaylabnumber = $row_gettodaylabnumber['todaylabnumber'];
													?>
													<strong class="amount"><?php echo $todaylabnumber;?></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<div class="col-lg-3 mb-3">
							<section class="card card-featured-left card-featured-secondary">
								<div class="card-body">
									<div class="widget-summary">
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title">Today Completed Report</h4>
												<div class="info">
													<?php
													$query_gettodaycompletedreport = "select SUM(kd_acc::int) as todaycompletedreport from tab_lab_master where created_at::date = '".date('Y-m-d')."'::date";
													$result_gettodaycompletedreport = pg_query($db, $query_gettodaycompletedreport);
													$row_gettodaycompletedreport = pg_fetch_assoc($result_gettodaycompletedreport);
													$todaycompletedreport = $row_gettodaycompletedreport['todaycompletedreport'];
													
													if( $todaycompletedreport > 0 ){
														$todaycompletedreport = $todaycompletedreport;
													} else {
														$todaycompletedreport = 0;
													}
													?>
													<strong class="amount"><?php echo $todaycompletedreport;?></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<div class="col-lg-3 mb-3">
							<section class="card card-featured-left card-featured-tertiary mb-3">
								<div class="card-body">
									<div class="widget-summary">
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title">Today Pending Approval</h4>
												<div class="info">
												<?php
												$query_gettodaypendingapproval = "select COUNT(kd_acc::int) as todaypendingapproval from tab_lab_master where created_at::date = '".date('Y-m-d')."'::date and kd_acc = '0' ";
												$result_gettodaypendingapproval = pg_query($db, $query_gettodaypendingapproval);
												$row_gettodaypendingapproval = pg_fetch_assoc($result_gettodaypendingapproval);
												$todaypendingapproval = $row_gettodaypendingapproval['todaypendingapproval'];
												?>
													<strong class="amount"><?php echo $todaypendingapproval;?></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
						<div class="col-lg-3 mb-3">
							<section class="card card-featured-left card-featured-quaternary mb-3">
								<div class="card-body">
									<div class="widget-summary">
										<div class="widget-summary-col">
											<div class="summary">
												<h4 class="title">Today Number of Customers</h4>
												<div class="info">
												<?php
												$query_getnumberofcustomertoday = "select COUNT(ID::int) as numberofcustomertoday from tab_lab_master where created_at::date = '".date('Y-m-d')."'::date group by nama ";
												$result_getnumberofcustomertoday = pg_query($db, $query_getnumberofcustomertoday);
												$row_getnumberofcustomertoday = pg_fetch_assoc($result_getnumberofcustomertoday);
												$todaynumberofcustomers = $row_getnumberofcustomertoday['numberofcustomertoday'];
												if( $todaynumberofcustomers > 0 ){
													$todaynumberofcustomers = $todaynumberofcustomers;
												} else {
													$todaynumberofcustomers = 0;
												}
												?>
													<strong class="amount"><?php echo $todaynumberofcustomers;?></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<section class="card">
								<header class="card-header">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>
					
									<h2 class="card-title">Statistik Laboratorium Harian</h2>
									<p class="card-subtitle">Total data laboratorium per hari dalam bulan ini.</p>
								</header>
								<div class="card-body">
					
									<!-- Flot: Bars -->
									<div class="chart chart-md" id="flotBars"></div>
									
									<?php
									for($i=0;$i<=date('d');$i++){
										$query_gettodaylabnumber = "select COUNT(ID::int) as todaylabnumber from tab_lab_master where created_at::date = '".date('2018-09-'.($i+1))."'::date";
										$result_gettodaylabnumber = pg_query($db, $query_gettodaylabnumber);
										$row_gettodaylabnumber = pg_fetch_assoc($result_gettodaylabnumber);
										$todaylabnumber_barchart[] .= $row_gettodaylabnumber['todaylabnumber'];
										
										$string_flotbarsdata .= '["'.($i+1).' '.date('M').'", '.$row_gettodaylabnumber['todaylabnumber'].']';
										
										if( $i != date('d') ){
											$string_flotbarsdata .= ',';
										}
										
									}
									?>
									
									<script type="text/javascript">
										/*
										var flotBarsData = [
											["1 September", 28],
											["2 September", 42],
											["3 September", 25],
											["4 September", 23],
											["5 September", 37],
											["6 September", 33],
											["7 September", 18],
											["8 September", 14],
											["9 September", 18],
											["10 September", 15],
											["11 September", 4]
										];
										*/
										
										var flotBarsData = [<?php echo $string_flotbarsdata;?>];
					
										// See: js/examples/examples.charts.js for more settings.
					
									</script>
					
								</div>
							</section>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6">
							<section class="card">
								<header class="card-header">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>
					
									<h2 class="card-title">Statistik Umur</h2>
									<p class="card-subtitle">Data statistik perbandingan umur pasien</p>
								</header>
								<div class="card-body">
					
									<!-- Flot: Pie -->
									<div class="chart chart-md" id="flotPie"></div>
									
									<?php
									$query_get = "select count(id) as total_row from public.tab_lab_master where umur_sat = 'Tahun' and umur < 20";
									$result_get = pg_query($db, $query_get);
									$row_get = pg_fetch_assoc($result_get);
									$age_statistik_lessthan20 = $row_get['total_row'];
									
									$query_get = "select count(id) as total_row from public.tab_lab_master where umur_sat = 'Tahun' and umur >= 20 and umur <30";
									$result_get = pg_query($db, $query_get);
									$row_get = pg_fetch_assoc($result_get);
									$age_statistik_between20and30 = $row_get['total_row'];
									
									$query_get = "select count(id) as total_row from public.tab_lab_master where umur_sat = 'Tahun' and umur > 30";
									$result_get = pg_query($db, $query_get);
									$row_get = pg_fetch_assoc($result_get);
									$age_statistik_largerthan30 = $row_get['total_row'];
									?>
									
									<script type="text/javascript">
					
										var flotPieData = [{
											label: "< 20",
											data: [
												[1, <?php echo $age_statistik_lessthan20;?>]
											],
											color: '#0088cc'
										}, {
											label: "20 - 30",
											data: [
												[1, <?php echo $age_statistik_between20and30;?>]
											],
											color: '#2baab1'
										}, {
											label: "> 30",
											data: [
												[1, <?php echo $age_statistik_largerthan30;?>]
											],
											color: '#734ba9'
										}];
					
										// See: js/examples/examples.charts.js for more settings.
					
									</script>
					
								</div>
							</section>
						</div>
						<div class="col-lg-6">
							<section class="card">
								<header class="card-header">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>
			
									<h2 class="card-title">Statistik Jenis Kelamin</h2>
									<p class="card-subtitle">Data statistik perbandingan jenis kelamin pasien</p>
								</header>
								<div class="card-body">
									<div class="row text-center">
										<div class="col-lg-6">
											<div class="circular-bar">
												<?php
												$query_get = "select count(id) as total_row from public.tab_lab_master where sex = 'L'";
												$result_get = pg_query($db, $query_get);
												$row_get = pg_fetch_assoc($result_get);
												$age_statistik_L = $row_get['total_row'];
												
												$query_get = "select count(id) as total_row from public.tab_lab_master where sex = 'P'";
												$result_get = pg_query($db, $query_get);
												$row_get = pg_fetch_assoc($result_get);
												$age_statistik_P = $row_get['total_row'];
												
												$prosentase_L = $age_statistik_L / ($age_statistik_L + $age_statistik_P) * 100;
												$prosentase_P = $age_statistik_P / ($age_statistik_L + $age_statistik_P) * 100;
												?>
												<div class="circular-bar-chart" data-percent="<?php echo $prosentase_L;?>" data-plugin-options='{ "barColor": "#0088CC", "delay": 300 }'>
													<strong>Laki-Laki</strong>
													<label><span class="percent"><?php echo $prosentase_L;?></span>%</label>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="circular-bar">
												<div class="circular-bar-chart" data-percent="<?php echo $prosentase_P;?>" data-plugin-options='{ "barColor": "#2BAAB1", "delay": 600 }'>
													<strong>Perempuan</strong>
													<label><span class="percent"><?php echo $prosentase_P;?></span>%</label>
												</div>
											</div>
										</div>
									</div>
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
		<script src="<?php echo $repository_url;?>/vendor/jquery-ui/jquery-ui.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jquery-appear/jquery-appear.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/flot/jquery.flot.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/flot.tooltip/flot.tooltip.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/flot/jquery.flot.pie.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/flot/jquery.flot.categories.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/flot/jquery.flot.resize.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jquery-sparkline/jquery-sparkline.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/raphael/raphael.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/morris/morris.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/gauge/gauge.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/snap.svg/snap.svg.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/liquid-meter/liquid.meter.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/jquery.vmap.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>
		<script src="<?php echo $repository_url;?>/vendor/chartist/chartist.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $repository_url;?>/js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo $repository_url;?>/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $repository_url;?>/js/theme.init.js"></script>

		<!-- Examples -->
		<script src="<?php echo $repository_url;?>/js/examples/examples.dashboard.js"></script>
		<script src="<?php echo $repository_url;?>/js/examples/examples.charts.js"></script>

	</body>
</html>