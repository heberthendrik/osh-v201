			
				<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
				<aside id="sidebar-left" class="sidebar-left">
				
				    <div class="sidebar-header">
				        <div class="sidebar-title">
				            Navigation
				            
				        </div>
				        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>
				
				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">
				            
				                <ul class="nav nav-main">
				                    <li <?php if( strpos($actual_link, '/Dashboard/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Dashboard/index.php">
				                            <i class="fas fa-home" aria-hidden="true"></i>
				                            <span>Beranda</span>
				                        </a>                        
				                    </li>
				                    <li <?php if( strpos($actual_link, '/Ruang/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Ruang/index.php">
				                            <i class="fa fa-fw fa-bed" aria-hidden="true"></i>
				                            <span>Ruang</span>
				                        </a>                        
				                    </li>
				                    <li <?php if( strpos($actual_link, '/Kelas/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Kelas/index.php">
				                            <i class="fa fa-fw fa-file-medical-alt" aria-hidden="true"></i>
				                            <span>Kelas</span>
				                        </a>                        
				                    </li>
				                    <li <?php if( strpos($actual_link, '/Status/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Status/index.php">
				                            <i class="fa fa-fw fa-file" aria-hidden="true"></i>
				                            <span>Status</span>
				                        </a>                        
				                    </li>
				                    <li <?php if( strpos($actual_link, '/Dokter/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Dokter/index.php">
				                            <i class="fa fa-fw fa-user-md" aria-hidden="true"></i>
				                            <span>Dokter</span>
				                        </a>                        
				                    </li>
				                    <li <?php if( strpos($actual_link, '/Petugas/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Petugas/index.php">
				                            <i class="fa fa-fw fa-id-card-alt" aria-hidden="true"></i>
				                            <span>Petugas</span>
				                        </a>                        
				                    </li>
				                    <!--
				                    <li <?php if( strpos($actual_link, '/Barang/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Barang/index.php">
				                            <i class="fa fa-fw fa-medkit" aria-hidden="true"></i>
				                            <span>Barang</span>
				                        </a>                        
				                    </li>
				                    -->
				                    <li <?php if( strpos($actual_link, '/Pasien/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Pasien/index.php">
				                            <i class="fa fa-fw fa-diagnoses" aria-hidden="true"></i>
				                            <span>Pasien</span>
				                        </a>                        
				                    </li>
				                    <li <?php if( strpos($actual_link, '/KodeLab/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/KodeLab/index.php">
				                            <i class="fa fa-fw fa-prescription-bottle-alt" aria-hidden="true"></i>
				                            <span>Kode Lab</span>
				                        </a>                        
				                    </li>
				                    <?php
				                    if( $_SESSION['OSH']['ID_ROLE'] == 1 ){
					                    ?>
						                <li <?php if( strpos($actual_link, '/RumahSakit/') != false ){ echo ' class="nav-active" '; } ?> >
					                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/RumahSakit/index.php">
					                            <i class="fa fa-fw fa-hospital" aria-hidden="true"></i>
					                            <span>Rumah Sakit</span>
					                        </a>                        
					                    </li>   
					                    <?php
				                    }
				                    ?>
				                    <?php
				                    if( $_SESSION['OSH']['ID_ROLE'] == 1 || $_SESSION['OSH']['ID_ROLE'] == 2 ){
					                    ?>
					                    <li <?php if( strpos($actual_link, '/User/') != false ){ echo ' class="nav-active" '; } ?> >
					                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/User/index.php">
					                            <i class="fa fa-fw fa-users" aria-hidden="true"></i>
					                            <span>User</span>
					                        </a>                        
					                    </li>
					                    <?php
					                }
					                ?>
					                <!--
					                <?php
				                    if( $_SESSION['OSH']['ID_ROLE'] == 1 ){
					                    ?>
					                    <li <?php if( strpos($actual_link, '/Slider/') != false ){ echo ' class="nav-active" '; } ?> >
					                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Master/Slider/index.php">
					                            <i class="fa fa-fw fa-image" aria-hidden="true"></i>
					                            <span>Slider</span>
					                        </a>                        
					                    </li>
					                    <?php
					                }
					                ?>
					                -->
				                    <li <?php if( strpos($actual_link, '/Lab/') != false ){ echo ' class="nav-active" '; } ?> >
				                        <a class="nav-link" href="<?php echo GetMasterLink(); ?>/module/Lab/index.php">
				                            <i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i>
				                            <span>Hasil Lab</span>
				                        </a>                        
				                    </li>
				                    
				
				                </ul>
				            </nav>
				
							<!--
				            <hr class="separator" />
				
				            <div class="sidebar-widget widget-tasks">
				                <div class="widget-header">
				                    <h6>Projects</h6>
				                    <div class="widget-toggle">+</div>
				                </div>
				                <div class="widget-content">
				                    <ul class="list-unstyled m-0">
				                        <li><a href="#">Porto HTML5 Template</a></li>
				                        <li><a href="#">Tucson Template</a></li>
				                        <li><a href="#">Porto Admin</a></li>
				                    </ul>
				                </div>
				            </div>
				
				            <hr class="separator" />
				
				            <div class="sidebar-widget widget-stats">
				                <div class="widget-header">
				                    <h6>Company Stats</h6>
				                    <div class="widget-toggle">+</div>
				                </div>
				                <div class="widget-content">
				                    <ul>
				                        <li>
				                            <span class="stats-title">Stat 1</span>
				                            <span class="stats-complete">85%</span>
				                            <div class="progress">
				                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
				                                    <span class="sr-only">85% Complete</span>
				                                </div>
				                            </div>
				                        </li>
				                        <li>
				                            <span class="stats-title">Stat 2</span>
				                            <span class="stats-complete">70%</span>
				                            <div class="progress">
				                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
				                                    <span class="sr-only">70% Complete</span>
				                                </div>
				                            </div>
				                        </li>
				                        <li>
				                            <span class="stats-title">Stat 3</span>
				                            <span class="stats-complete">2%</span>
				                            <div class="progress">
				                                <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
				                                    <span class="sr-only">2% Complete</span>
				                                </div>
				                            </div>
				                        </li>
				                    </ul>
				                </div>
				            </div>
				            -->
				            
				        </div>
				
				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
				                    
				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>
				        
				
				    </div>
				
				</aside>