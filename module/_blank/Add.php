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
						
						<?php include('../include/system_message.php') ?>

						<form action="Process.php" method="post" class="form-horizontal row-border">
						
							<div class="row">
								<div class="col-md-12">
									<div class="block-web">
										<div class="panel-body" style="padding:0px;text-align:right;">
										
											<a href="View.php"><button type="button" class="btn btn-warning">Kembali</button></a>
											<input type="submit" name="submitSimpan" value="Simpan" class="btn btn-primary" />
											
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-md-12">
									<div class="block-web">
										<div class="header">
											<div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
											<h3 class="content-header">Data Bank</h3>
										</div>
										<div class="porlets-content">
											
											<div class="form-group">
												<label class="col-sm-3 control-label">Bank</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="textBank">
												</div>
											</div>
											
										</div>
										<!--/porlets-content-->
									</div>
									<!--/block-web--> 
								</div>
								<!--/col-md-6-->
							</div>
							<!--/row--> 
							<input type="hidden" name="module" value="BankAdd" />
						</form>
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
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Compose New Task</h4>
					</div>
					<div class="modal-body">sgxdfgxfg </div>
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
		<script type="text/javascript"  src="../../repo/plugins/toggle-switch/toggles.min.js"></script> 
		<script src="../../repo/plugins/checkbox/zepto.js"></script>
		<script src="../../repo/plugins/checkbox/icheck.js"></script>
		<script src="../../repo/js/icheck-init.js"></script>
		<script src="../../repo/js/jquery.slimscroll.min.js"></script>
		<script src="../../repo/js/icheck.js"></script>
		<script type="text/javascript" src="../../repo/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
		<script type="text/javascript" src="../../repo/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
		<script type="text/javascript" src="../../repo/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> 
		<script type="text/javascript" src="../../repo/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js"></script> 
		<script type="text/javascript" src="../../repo/js/form-components.js"></script> 
		<script type="text/javascript"  src="../../repo/plugins/input-mask/jquery.inputmask.min.js"></script> 
		<script type="text/javascript"  src="../../repo/plugins/input-mask/demo-mask.js"></script> 
		<script type="text/javascript"  src="../../repo/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script> 
		<script type="text/javascript"  src="../../repo/plugins/dropzone/dropzone.min.js"></script> 
		<script type="text/javascript" src="../../repo/plugins/ckeditor/ckeditor.js"></script>
		<script>
			/*==Porlets Actions==*/
			    $('.minimize').click(function(e){
			      var h = $(this).parents(".header");
			      var c = h.next('.porlets-content');
			      var p = h.parent();
			      
			      c.slideToggle();
			      
			      p.toggleClass('closed');
			      
			      e.preventDefault();
			    });
			    
			    $('.refresh').click(function(e){
			      var h = $(this).parents(".header");
			      var p = h.parent();
			      var loading = $('&lt;div class="loading"&gt;&lt;i class="fa fa-refresh fa-spin"&gt;&lt;/i&gt;&lt;/div&gt;');
			      
			      loading.appendTo(p);
			      loading.fadeIn();
			      setTimeout(function() {
			        loading.fadeOut();
			      }, 1000);
			      
			      e.preventDefault();
			    });
			    
			    $('.close-down').click(function(e){
			      var h = $(this).parents(".header");
			      var p = h.parent();
			      
			      p.fadeOut(function(){
			        $(this).remove();
			      });
			      e.preventDefault();
			    });
			
		</script>
		<script src="../../repo/js/jPushMenu.js"></script> 
		<script src="../../repo/js/side-chats.js"></script>
	</body>
</html>