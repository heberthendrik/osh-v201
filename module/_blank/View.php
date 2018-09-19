<?php include('../include/top_header.php') ?>
			
			<div class="inner">
				<!--\\\\\\\ inner start \\\\\\-->
				
				<?php include('../include/navigation_sidebar.php'); ?>
				
				<div class="contentpanel">
					<!--\\\\\\\ contentpanel start\\\\\\-->
					<div class="pull-left breadcrumb_admin clear_both">
						<div class="pull-left page_title theme_color">
							<h1>Master Data Bank</h1>
						</div>
					</div>
					<div class="container clear_both padding_fix">
						<!--\\\\\\\ container  start \\\\\\-->
						<div id="main-content">
							<div class="page-content">
							
								<?php include('../include/system_message.php') ?>

								<div class="row">
									<div class="col-md-12">
										<div class="block-web">
											<div class="panel-body" style="padding:0px;text-align:right;">
											
												<a href="Add.php"><button type="button" class="btn btn-primary">Tambah Bank</button></a>
												
											</div>
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-md-12">
										<div class="block-web">
											<div class="header">
												<h3 class="content-header">Data Bank </h3>
											</div>
											<div class="porlets-content">
												<div class="table-responsive">
													<table  class="display table table-bordered table-striped" id="dynamic-table">
														<thead>
															<tr>
																<th>ID</th>
																<th>Bank</th>
																<th>Tindakan</th>
															</tr>
														</thead>
														<tbody>
															<?php
															
															$function_GetAllBank = GetAllBank();
															
															for( $i=0;$i<$function_GetAllBank['TOTAL_ROW'];$i++ ){
															
																?>
																<tr>
																	<td><?php echo $function_GetAllBank['ID'][$i];?></td>
																	<td><?php echo $function_GetAllBank['BANK'][$i];?></td>
																	<td><a href="Detail.php?id=<?php echo $function_GetAllBank['ID'][$i];?>"><i class="fa fa-sign-in"></i> Lihat Detail</a></td>
																</tr>
																<?php
															}
															?>
														</tbody>
														<tfoot>
															<tr>
																<th>ID</th>
																<th>Bank</th>
																<th>Tindakan</th>
															</tr>
														</tfoot>
													</table>
												</div>
												<!--/table-responsive-->
											</div>
											<!--/porlets-content-->
										</div>
										<!--/block-web--> 
									</div>
									<!--/col-md-12--> 
								</div>
								<!--/row-->
								
							</div>
							<!--/page-content end--> 
						</div>
						<!--/main-content end--> 
					</div>
					<!--\\\\\\\ container  end \\\\\\-->
				</div>
				<!--\\\\\\\ content panel end \\\\\\-->
			</div>
			<!--\\\\\\\ inner end\\\\\\-->
		</div>
		<!--\\\\\\\ wrapper end\\\\\\-->
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Compose New Task</h4>
					</div>
					<div class="modal-body"> content </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<!-- sidebar chats -->
		<nav class="atm-spmenu atm-spmenu-vertical atm-spmenu-right side-chat">
			<div class="header">
				<input type="text" class="form-control chat-search" placeholder=" Search">
			</div>
			<div href="#" class="sub-header">
				<div class="icon"><i class="fa fa-user"></i></div>
				<p>Online (4)</p>
			</div>
			<div class="content">
				<p class="title">Family</p>
				<ul class="nav nav-pills nav-stacked contacts">
					<li class="online"><a href="#"><i class="fa fa-circle-o"></i> Steven Smith</a></li>
					<li class="online"><a href="#"><i class="fa fa-circle-o"></i> John Doe</a></li>
					<li class="online"><a href="#"><i class="fa fa-circle-o"></i> Michael Smith</a></li>
					<li class="busy"><a href="#"><i class="fa fa-circle-o"></i> Chris Rogers</a></li>
				</ul>
				<p class="title">Friends</p>
				<ul class="nav nav-pills nav-stacked contacts">
					<li class="online"><a href="#"><i class="fa fa-circle-o"></i> Vernon Philander</a></li>
					<li class="outside"><a href="#"><i class="fa fa-circle-o"></i> Kyle Abbott</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Dean Elgar</a></li>
				</ul>
				<p class="title">Work</p>
				<ul class="nav nav-pills nav-stacked contacts">
					<li><a href="#"><i class="fa fa-circle-o"></i> Dale Steyn</a></li>
					<li><a href="#"><i class="fa fa-circle-o"></i> Morne Morkel</a></li>
				</ul>
			</div>
			<div id="chat-box">
				<div class="header">
					<span>Richard Avedon</span>
					<a class="close"><i class="fa fa-times"></i></a>    
				</div>
				<div class="messages nano nscroller has-scrollbar">
					<div class="content" tabindex="0" style="right: -17px;">
						<ul class="conversation">
							<li class="odd">
								<p>Hi John, how are you?</p>
							</li>
							<li class="text-right">
								<p>Hello I am also fine</p>
							</li>
							<li class="odd">
								<p>Tell me what about you?</p>
							</li>
							<li class="text-right">
								<p>Sorry, I'm late... see you</p>
							</li>
							<li class="odd unread">
								<p>OK, call me later...</p>
							</li>
						</ul>
					</div>
					<div class="pane" style="display: none;">
						<div class="slider" style="height: 20px; top: 0px;"></div>
					</div>
				</div>
				<div class="chat-input">
					<div class="input-group">
						<input type="text" placeholder="Enter a message..." class="form-control">
						<span class="input-group-btn">
						<button class="btn btn-danger" type="button">Send</button>
						</span>      
					</div>
				</div>
			</div>
		</nav>
		<!-- /sidebar chats -->   
		
		<script src="../../repo/js/jquery-2.1.0.js"></script>
		<script src="../../repo/js/bootstrap.min.js"></script>
		<script src="../../repo/js/common-script.js"></script>
		<script src="../../repo/js/jquery.slimscroll.min.js"></script>
		<script src="../../repo/plugins/data-tables/jquery.dataTables.js"></script>
		<script src="../../repo/plugins/data-tables/DT_bootstrap.js"></script>
		<script src="../../repo/plugins/data-tables/dynamic_table_init.js"></script>
		<script src="../../repo/plugins/edit-table/edit-table.js"></script>
		<script>
			jQuery(document).ready(function() {
			    EditableTable.init();
			});
		</script>
		<script src="../../repo/js/jPushMenu.js"></script> 
		<script src="../../repo/js/side-chats.js"></script>
	</body>
</html>