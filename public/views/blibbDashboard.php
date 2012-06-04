<?php
	require_once(__DIR__.'/../inc/header.php');
?>

		<style type="text/css">

			.navbar-inner {
				border-radius: 0;
				-webkit-border-radius: 0;
				background-color: #B21006;
				background-image: none;
			}

			#addItem-btn {
				margin-right: 10px;
			}

			a {
				color: #9D261D;
				text-decoration: none;
			}

			a:hover {
				color: #5C1611;
				text-decoration: underline;
			}

			.nav-list .active > a, .nav-list .active > a:hover {
				color: white;
				text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
				background-color: #9D261D;
			}

			.nav > li > a:hover {
				text-decoration: none;
				background-color: #EEE;
			}

			.post-comment {
				min-height: 50px;
				margin-bottom: 15px;
				border-bottom: 1px solid #DDD;
			}

			.post-comment:last-child {
				border-bottom: none;
			}

			.dashboard_box{margin-bottom:15px;}
			.dashboard_box_title{width:auto;border:1px solid #ddd;background:#f7f7f7 url("//s3.amazonaws.com/wrapbootstrap/live/imgs/darkgrain.png");padding:10px 15px;font-size:18px;color:#444;-moz-border-radius-topleft:4px;-moz-border-radius-topright:4px;}
			.dashboard_box .dashboard_box_inner{-moz-border-radius-bottomleft:4px;-moz-border-radius-bottomright:4px;border:1px solid #ddd;border-top:none;padding:10px 15px;10px;15px;}

			code {
				width: 100%;
				display: block;
				margin-bottom: 15px;
			}

			.accordion-heading {
				background: #F7F7F7;
			}
			
		</style>
		

		<div class="container">

			<div class="row">
				<div class="page-header">
  					<h1><?php echo $bli->name ?> - Dashboard</h1>
				</div>
			</div>
	  		
			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs">
			    	<li class="active"><a href="#general" data-toggle="tab"><i class="icon-home"></i> General</a></li>
			    	<li><a href="#api" data-toggle="tab"><i class="icon-refresh"></i> API</a></li>
			    	<li><a href="#security" data-toggle="tab"><i class="icon-lock"></i> Security</a></li>
			  	</ul>

			  	<!-- Tab: general-->
			  	<div class="tab-content" style="width: auto;">
			    	<div class="tab-pane active span10" id="general">
			    		<h3>Description:</h3>
			    		<p id="desc"><!-- insert here description tag --><?php echo $bli->description ?></p>
			    		<a data-toggle="modal" href="#myModal">Change</a>
			    		

			    		<!-- Modal -->
			    		<div class="modal hide fade" id="myModal">
					  		<div class="modal-header">
					    		<a type="button" class="close" data-dismiss="modal">×</a>
					    		<h3>Description</h3>
					  		</div>
					  		<div class="modal-body">
					    		<p><strong>Write here your new description</strong></p>
					    		<textarea name="newdesc" id="newdesc" class="span6" rows="7"><!-- insert here description tag --></textarea>
					    		
					  		</div>
					  		<div class="modal-footer">
					    		<a href="#" class="btn" data-dismiss="modal">Close</a>
					    		<a href="#" class="btn btn-primary">Save changes</a>
					  		</div>
						</div>

			    		<h3>Image:</h3>
			    		<p>
			    			<div class="thumbnails">
								<a href="#" class="thumbnail span2">
									<img src="/actions/getImage?i=160&id=<?php echo $bli->img; ?>" alt="">
								</a>
				      		</div>
				      		<a href="#">Change</a>  
			    		</p>

			    		<!-- info boxes -->
			    		<div class="row">
				    		<div class="span5">
								<div class="dashboard_box">
									<div class="dashboard_box_title">Followers</div>
									<div class="dashboard_box_inner">
										<ul class="thumbnails">
											<li class="span1">
												<a href="#" class="thumbnail span1">
													<img src="http://placehold.it/160x160" alt="">
												</a>
											</li>
											<li class="span1">
												<a href="#" class="thumbnail span1">
													<img src="http://placehold.it/160x160" alt="">
												</a>
											</li>
											<li class="span1">
												<a href="#" class="thumbnail span1">
													<img src="http://placehold.it/160x160" alt="">
												</a>
											</li>
											<li class="span1">
												<a href="#" class="thumbnail span1">
													<img src="http://placehold.it/160x160" alt="">
												</a>
											</li>
											<li class="span1">
												<a href="#" class="thumbnail span1">
													<img src="http://placehold.it/160x160" alt="">
												</a>
											</li>
											<li class="span1">
												<a href="#" class="thumbnail span1">
													<img src="http://placehold.it/160x160" alt="">
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="span5">
								<div class="dashboard_box">
									<div class="dashboard_box_title">Latest comments</div>
									<div class="dashboard_box_inner">
										<div class="post-comment">
											<div class="btn pull-right">
												Go to item
											</div>
											<h4>Usuario <small>12:00 15-2-2012</small></h4>
											<p>Donec kjfkdfjls kjhgkf kjfhgdfjkgh kjdhfsgkjds gkhkd fghkj kfdhgkd hkhdsfkgj dkjhdksjfhg ksdg</p>
										</div>
										<div class="post-comment">
											<div class="btn pull-right">
												Go to item
											</div>
											<h4>Usuario <small>12:00 15-2-2012</small></h4>
											<p>Donec</p>

										</div>
									</div>
								</div>
							</div>
							<div class="span5">
								<div class="dashboard_box">
									<div class="dashboard_box_title">API usage (?)</div>
									<div class="dashboard_box_inner">
										toma que toma que toma, arsa arriquitaun
									</div>
								</div>
							</div>
						</div>

			    	</div>

			    	<!-- Tab: API -->
			    	<div class="tab-pane span10" id="api">

			    		<h3>Blibb URL</h3>
			    		<code><?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug; ?></code>

			    		<h3>Dev Key</h3>
			    		<code><?php echo $bli->dk; ?></code>

			    		<h3>API Methods</h3>

			    		<!-- API Method code -->
			    		<div class="accordion-group">
              				<div class="accordion-heading">
				                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#method1">
				                	Get Item
				                </a>
              				</div>
              				<div id="method1" class="accordion-body collapse in">
                				<div class="accordion-inner">
                  					<code>hola que tal</code>
                  					<h3>Options</h3>

                				</div>
              				</div>
            			</div>
            			<!-- -->
            			<div class="accordion-group">
              				<div class="accordion-heading">
				                <a class="accordion-toggle" data-toggle="collapse" href="#method2">
				                	Post Item
				                </a>
              				</div>
              				<div id="method2" class="accordion-body collapse in">
                				<div class="accordion-inner">
                  					<code>hola que tal</code>
                  					<h3>Options</h3>

                				</div>
              				</div>
            			</div>

			    	</div>

			    	<!-- Tab: Security-->
			    	<div class="tab-pane span10" id="security">
			    		<h2>Security</h2>
			    	</div>
			    </div>
			</div>

			    
		</div>
			
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-tab.js"></script>
		<script type="text/javascript" src="js/bootstrap-collapse.js"></script>
		<script type="text/javascript" src="js/bootstrap-modal.js"></script>


		<script type="text/javascript">
			$('#general').tab('show');
			$('#api').tab('show');
			$('#security').tab('show');

			$('#myModal').modal({
				show: false
			});
			
			$(".collapse").collapse();

		</script>
		
	</body>
	
</html>