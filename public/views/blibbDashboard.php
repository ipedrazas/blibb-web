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

			.parameter{
				color: blue;
			}
			.optionalParameter{
				color: orange;
			}


		</style>
<link href="/css/fileuploader.css" rel="stylesheet" type="text/css">
<script src="/js/fileuploader.js" type="text/javascript"></script>
<script>
	$(function() {
		createUploader('imageUploader', '<?php echo $bli->id  ?>', '<?php echo getKey(); ?>');
	});
	function createUploader(element, bid, key){
		var uploader = new qq.FileUploader({
			element: document.getElementById(element),
			action: 'actions/uploadImage',
			allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
			 params: {
				bid: bid,
				k: key
			},
			onComplete: function(id, fileName, responseJSON){
				var resp =  responseJSON.id;
				$('#bimg').val(resp);
				var srcI = "<?php echo REST_API_URL ?>/picture/" + resp + "/260";
				updatePicture(resp);
				$("#img_image").attr("src",srcI);
				$(".qq-upload-failed-text").hide();
			},
		});
	}

	function updatePicture(picture){
		$.post("/actions/updateImage", { id: picture, oid: '<?php echo $bli->id ?>', type: 'blibb' },
		   function(data) {
			 $alert = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>" + data +"</div>";
			$('#imagebox').after($alert);
		   });
	}

</script>

		<div class="container">

			<div class="row">
				<div class="page-header">
					<h1><a href="blibb?b=<?php echo $bli->id; ?>"><?php echo $bli->name; ?></a> - Dashboard</h1>
				</div>
			</div>

			<div class="tabbable tabs-left">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#general" data-toggle="tab"><i class="icon-home"></i> General</a></li>
					<li><a href="#layout" data-toggle="tab"><i class="icon-columns"></i> Template</a></li>
					<li><a href="#items" data-toggle="tab"><i class="icon-th-list"></i> Items</a></li>
					<li><a href="#data" data-toggle="tab"><i class="icon-list-alt"></i> Data</a></li>
					<li><a href="#api" data-toggle="tab"><i class="icon-random"></i> API</a></li>
					<li><a href="#integrations" data-toggle="tab"><i class="icon-refresh"></i> Integrations</a></li>
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
									<img id="img_image" src="<?php echo REST_API_URL ?>/picture/<?php echo $bli->img; ?>/160" alt="">
								</a>
							</div>

							<input type="hidden" name="bimage" value="" id="bimg">
							<div class="control-group">
								<label class="control-label">Change</label>
								<div class="controls">
									<div id="imageUploader" name="uploadImage">
										<noscript><p>Please enable JavaScript to use file uploader.</p></noscript>
									</div>

								</div>
							</div>
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
										<strong>Num of Elements:</strong> <?php echo $num_items; ?>
										<br>
										<strong>Hits:</strong> <?php echo $num_views; ?>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!-- Tab: Data -->
					<div class="tab-pane span10" id="data">

						<h3>Data:</h3>
						<p>
							If you want to upload a file to pre-populate a Blibb, please use one of the following options:
						</p>
						<iframe name="upload_iframe" src="" style="display:none;"></iframe>
						<form action="<?php echo REST_API_URL . '/loader/excel' ?>" method="post" id="file_upload" enctype="multipart/form-data" target="upload_iframe">
						<ul>
							<li>
								Excel Spreadsheet <input type="radio" value="excel" name="file_type" checked="checked"/>
							</li>
							<li style="display:none">
								Comma separated values <input type="radio" value="excel" name="file_type"/>
							</li>
							<li><input type="file" name="file" /></li>
							<li>
								<input type="hidden" name="login_key" value="<?php echo getKey(); ?>">
								<input type="hidden" name="blibb_id" value="<?php echo $bli->id; ?>">
								<input type="submit" value="Upload" />
							</li>
						</ul>
						</form>
						<!--
						<h3>Export</h3>
						<p>Select the format you want to export your data</p>
						<ul>
							<li><a href="#">Sql File</a></li>
							<li><a href="#">CSV File</a></li>
							<li><a href="#">Excel File</a></li>
							<li><a href="#">Json File</a></li>
						</ul>
					-->
					</div>
					<!-- Tab: Layout -->
					<div class="tab-pane span10" id="layout">
						<h2>Template:</h2>
						<form class="form-horizontal">
						  <fieldset>

						    <div class="control-group">
					            <label class="control-label">Template model</label>
					            <div class="controls">
					              <label class="radio">
					                <input type="radio" name="template-model" id="template-model1" value="box">
					                <a href="/blibb?b=<?php echo $bli->id ?>"><i class="icon-th-large"></i> Boxes</a>
					              </label>
					              <label class="radio">
					                <input type="radio" name="template-model" id="template-model2" value="table">
					                 <a href="/blibb?b=<?php echo $bli->id ?>&v=table"><i class="icon-th"></i> Table</a>
					              </label>
					            </div>
					          </div>
						  </fieldset>
						</form>
					</div>

					<!-- Tab: items -->
					<div class="tab-pane span10" id="items">
						<h2>Items:</h2>
						<a href="/addItem?b=<?php echo $bli->id ?>" class="btn btn-primary">Add new Item</a>

						<table class="table table-striped">
							<thead>
								<tr>
									<?php
										$fields = $items[0]->fields;
										 foreach ($fields as $tfield) {
										 	$field = explode("-", $tfield);
										 	echo '<th>' . $field[1] . '</th>';
										 }
									?>
								</tr>
							</thead>
							<tbody>

							<?php

								foreach ($items as $item) {
									echo '<tr>';
										 foreach ($fields as $tfield) {
										 	$field = explode("-", $tfield);
										 	echo '<td>' . renderByType($item->$field[1], $field[0]) . '</td>';
										}
									echo '<td><a href="editItem?id='.$item->id.'"><i class="icon-pencil"></i> Edit </a><a href="deleteItem?id='.$item->id.'"> <i class="icon-trash"></i> Delete</a></td>';
									echo '<tr>';
								}
							?>

							</tbody>
						</table>

					</div>

					<!-- Tab: API -->
					<div class="tab-pane span10" id="api">
						<h3>Blibb URL </h3>
						<a href="<?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug . '.xml'; ?>" target="_blank"><img src="/img/rss.png" width="16" height="16" alt="xml feed" /></a>
						<code><a href="<?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug; ?>" target="_blank"><?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug; ?></a></code>


						<h2>API Methods</h2>

						<h3>Collection</h3>
						<!-- API Method code -->
					<div class="accordion" id="accordion-api">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-api" data-target="#method1" href="#method1">
									Get Items - Paginated
								</a>
							</div>
							<div id="method1" class="accordion-body collapse">
								<div class="accordion-inner">
									<h3>Method <code>[GET] <a href="<?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug; ?>" target="_blank"><?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug ."<span class=\"optionalParameter\">[?page=2,3..90]</span>"; ?></a></code></h3>

									<h3>Parameters</h3>
									<code class="optionalParameter">[optional] page:</code>
									<p>This API call returns a maximum of 20 objects. The result contains the numer of objects available but it's up to the app. to fetch the following pages if nedded.</p>
									<h3>Result</h3>
									<p>
										The json returned has the follwoing structure:
										<ul>
											<li>
												<strong>blibb</strong>
												<ul>
													<li><strong>id:</strong> ID of he Blibb</li>
													<li><strong>name:</strong> name of the Blibb</li>
													<li><strong>description:</strong> description of the Blibb</li>
													<li><strong>owner:</strong> owner of the Blibb</li>
													<li><strong>img_id:</strong> picture id of the image associted to this Blibb</li>
													<li><strong>img_sizes:</strong> array with the different available widths for the image</li>
													<li><strong>tags:</strong> array of tags</li>
													<li><strong>num_items:</strong> total items contained in this Blibb</li>
													<li><strong>num_views:</strong> number of hits</li>
												</ul>
											</li>
											<li>
												<strong>items:</strong> items returned by this request.
												<ul>
													<?php
														$curl_params = '';
														$i=1;
														foreach ($bli->fields as $field) {
															$curl_params .= $field . "=test-" . $i++ . "&";
															echo '<li><strong>' . $field . '</strong></li>';
														}
														$curl_params = substr_replace($curl_params ,"",-1);
													?>
												</ul>
											</li>
										</ul>
									</p>
								</div>
							</div>
						</div>
						<!-- -->
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-api" href="#method2">
									Add Item
								</a>
							</div>
							<div id="method2" class="accordion-body collapse">
								<div class="accordion-inner">
									<h3>Method <code>[POST] <?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug; ?></code></h3>
									<h3>Parameters</h3>
									<code>loging_key: value of the [LOGIN] API call</code>
									<code>app_token: <?php echo $bli->dk; ?></code>
									<code>tags: tags sepparated by commas</code>
									<?php
										foreach ($bli->fields as $field) {
											echo '<code>' . $field . '</code>';
										   }    ?>

									<h3>Test</h3>
									<code>
										login_key = curl -d "u=[username]&p=[password]" <?php echo REST_API_URL ?>/login<br/>
										curl -d "login_key=[login_key]&app_token=&<?php echo $curl_params; ?>" <?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug; ?></code>
								</div>
							</div>
						</div>
						<h3>Tags</h3>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-api" href="#method3">
									Get Items by Tag
								</a>
							</div>
							<div id="method3" class="accordion-body collapse">
								<div class="accordion-inner">
									<h3>Method <code>[GET] <?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug . '/tag/<span class="parameter">&lt;tag&gt;</span>' ; ?></code></h3>
									<h3>Parameters</h3>
									<code>tag</code>
									<p>
										This API call returns all the items with a tag equal specified in the url.
									</p>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-api" href="#method4">
									Add Tag to Item
								</a>
							</div>
							<div id="method4" class="accordion-body collapse">
								<div class="accordion-inner">
									<h3>Method <code>[POST] <?php echo REST_API_URL . "/" . $bli->owner . "/" . $bli->slug . '/tag' ; ?></code></h3>
									<h3>Parameters</h3>
									<code>tag</code>
									<code>key</code>
									<code>app_token</code>
									<p>
										API call to add a tag to an item. Adding tags to items add them to the parent Blibb. The tag is added only if it does not exist.
									</p>
								</div>
							</div>
						</div>
						<h3>Comments</h3>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-api" href="#method5">
									Get Comments
								</a>
							</div>
							<div id="method5" class="accordion-body collapse">
								<div class="accordion-inner">
									<h3>Method <code>[GET] <?php echo REST_API_URL . '/comment/<span class="parameter">&lt;parent_id&gt;</span>' ; ?></code></h3>
									<h3>Parameters</h3>
									<code>parent_id</code>
									<p>
										To fetch the commments associated to an item, you have to pass the item_id
									</p>
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-api" href="#method6">
									Add Comment to Item
								</a>
							</div>
							<div id="method6" class="accordion-body collapse">
								<div class="accordion-inner">
									<h3>Method <code>[POST] <?php echo REST_API_URL . "/comment"; ?></code></h3>
									<h3>Parameters</h3>
									<p>
										<ul>
											<li>
												<strong>login_key</strong>: this is the key that the /login api call returns.
											</li>
											<li>
												<strong>item_id</strong>: Item id you want to add the comment to.
											</li>
											<li>
												<strong>comment</strong>: comment you want to add.
											</li>


										</ul>
									</p>
								</div>
							</div>
						</div>
					</div>
					</div>

					<!-- Tab: Security-->
					<div class="tab-pane span10" id="integrations">
						<h2>Integrations</h2>
						<p>This section is where you can configure the different networks and integrations.</p>
						<h2>Webhook</h2>
						<div class="controls">
							<label class="control-label">Action:</label>
							<select name="webhook-action" id="webhook-action">
								<option value="get_entries">Get Blibb</option>
								<option value="new_entry">New Entry</option>
								<option value="new_comment">New Comment</option>
							</select>
						</div>
						<div class="controls">
							<label class="control-label">Fields: (Choose the fields you want to return.)</label>
							<select multiple="multiple" id="webhook-fields" name="webhook-fields">
								<option value="blibb.num_views">Number Views</option>
								<option value="blibb.num_items">Number Items</option>
								<?php
									foreach ($bli->fields as $field) {
										echo '<option>' . $field . '</option>';
									}
								?>
							</select>
						</div>
						<div class="controls">
							<label class="control-label">Callback URL:</label> <input class="input-large" type="text" name='webhook-callback' id="webhook-callback" placeholder="http://">
						</div>
						<a href="#" id="addwebhook" class="btn btn-primary">Add Webhook</a>
						<div class="controls" id="reg-webhooks">
							<h3>Registered Webhooks</h3>
							<div id="webhooks_lst">
								<?php
									if(count($bli->webhooks)>0){
										foreach ($bli->webhooks as $wh) {
											echo "<div class='webhook'>"  . $wh->action  . " - " . $wh->callback . " [" . $wh->fields . "]</div>" ;
										}
									}else{
										echo '<div id="nowebhooks">No Webhooks defined yet.</div>';
									}
								?>
							</div>
						</div>
						<h3>Twitter</h3>
						<p><a class="big" href="">Link your twitter account <i class="icon-twitter-sign"></i></a></p>
						<h3>Ducksboard</h3>
						<p>
							In order to push and pull data from your Ducksboard you have to set your API Key.
							<label>Ducksboard API Key:</label>
							<input name="ducks-api" value=""/> <a href="#" class="btn btn-primary">Save Key</a>
						</p>
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

			$(".collapse").collapse({
				parent: true,
				toggle: true
			});

			$('#addwebhook').live("click", function(e){
				e.preventDefault();
				var action = $('#webhook-action').val();
				var callback = $('#webhook-callback').val();
				var fields = $('#webhook-fields').val();
				$.post("/actions/addWebhook", { id: '<?php echo $bli->id ?>', action: action, callback: callback, fields: fields },
					function(data) {
						var webhook = "<div class='webhook'>" + action + " - " + callback + " [" + fields + "]</div>" ;
						var alert = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>Webhook added succesfully</div>";
						$('#reg-webhooks').after(alert);
						$('#nowebhooks').hide();
						$('#webhooks_lst').append(webhook);
				});
			});


		</script>


<?php
require_once(__DIR__.'/../inc/footer.php');
?>
