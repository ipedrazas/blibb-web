<?php
	require_once(__DIR__.'/../inc/header.php');

?>

<style>
#profileBox{
	margin-top:100px;
}
.qq-upload-fail{
	display: none;
}
</style>
	<link rel="stylesheet" href="/css/profile.css">
	<div class="container">
	<div id="profileBox">
			
			<div class="tabbable tabs-left">
			  <ul class="nav nav-tabs">
				<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Profile</a></li>
				<li><a href="#friends" data-toggle="tab"><i class="icon-star"></i> Friends</a></li>
				<li><a href="#security" data-toggle="tab"><i class="icon-lock"></i> Security</a></li>
				<li><a href="#payments" data-toggle="tab"><i class="icon-shopping-cart"></i> Payments</a></li>
			  </ul>
			  <div class="tab-content" style="width: auto;">
				<div class="tab-pane active" id="profile">
					<div class="well">
						<form class="form-horizontal">
						  <fieldset>
							<legend>Profile info</legend>
							<div class="control-group">
							  <label class="control-label" for="input01">Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="input01" value="<?php echo $username ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="input02">Email</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" id="input02" value="<?php echo $email ?>">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="input03">Password</label>
							  <div class="controls">
								<input type="password" class="input-xlarge" id="input03" value="<?php echo $pwd ?>">
								
							  </div>
							</div>

							
							
							<div id="imagebox" class="control-group">
								<label class="control-label" for="inputFile">Picture</label>
								<div class="controls">
									 <div>
									 		<input type="hidden" name="bimage" value="" id="bimg">
											<div id="imageUploader" name="uploadImage">
												<noscript><p>Please enable JavaScript to use file uploader.</p></noscript>         
											</div>
										</div>
									  <div class="thumbnails help-block">
											<a href="#" class="thumbnail span2">
												<div id="im_image" ><img id="img_image"  alt="thumbnail" src="<?php echo $image ?>" /></div>
											  </a>
									  </div> 
									</div>
							</div>
							 
							<div class="control-group">
								<label class="control-label" for="select01">Measure Units</label>
								<div class="controls">
								  <select id="select01">
									<option>Imperial</option>
									<option>International System</option>
								  </select>
								  
								</div>
							  
							</div>

							<div class="offset2">
								<button class="btn btn-danger">Cancel</button>
								<button type="submit" class="btn btn-success">Save changes</button>
							</div>
						  </fieldset>
						</form>
					</div>
					
				</div>

				

				<div class="tab-pane" id="friends">
					<div class="well">
						<form class="form-search">
							<fieldset>
								<legend>Friend list</legend>
								<div class="control-group offset3">
									<div class="controls">
										<input type="text" class="input-xlarge1 search-query" placeholder="type your friend's name...">
										<button type="submit" class="btn">Search</button>
									</div>
								</div>
							</fieldset>
						</form>

						<ul class="thumbnails">
						  <li class="span3">
							<div class="thumbnail">
							  <img src="http://placehold.it/260x180" alt="">
							  <h3>Friend name</h3>
							  <p>Thumbnail caption right here...</p>
							  <div class="btn-toolbar">
							  <div class="btn-group">
								  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-user icon-white"></i> Groups
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#">Family</a></li>
									<li><a href="#">Blibb Team</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="icon-ok"></i> Add Group</a></li>
								  </ul>
								</div>
							  <div class="btn-group">
								  <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-cog icon-white"></i> Actions
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#"><i class="icon-envelope"></i> Send Message</a></li>
									<li><a href="#"><i class="icon-remove"></i> Remove friend</a></li>
								  </ul>
								</div>
							</div>
							</div>
						  </li>
						  <li class="span3">
							<div class="thumbnail">
							  <img src="http://placehold.it/260x180" alt="">
							  <h3>Friend name</h3>
							  <p>Thumbnail caption right here...</p>
							  <div class="btn-toolbar">
							  <div class="btn-group">
								  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-user icon-white"></i> Groups
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#">Family</a></li>
									<li><a href="#">Blibb Team</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="icon-ok"></i> Add Group</a></li>
								  </ul>
								</div>
							  <div class="btn-group">
								  <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-cog icon-white"></i> Actions
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#"><i class="icon-envelope"></i> Send Message</a></li>
									<li><a href="#"><i class="icon-remove"></i> Remove friend</a></li>
								  </ul>
								</div>
							</div>
							</div>
						  </li>
						  <li class="span3">
							<div class="thumbnail">
							  <img src="http://placehold.it/260x180" alt="">
							  <h3>Friend name</h3>
							  <p>Thumbnail caption right here...</p>
							  <div class="btn-toolbar">
							  <div class="btn-group">
								  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-user icon-white"></i> Groups
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#">Family</a></li>
									<li><a href="#">Blibb Team</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="icon-ok"></i> Add Group</a></li>
								  </ul>
								</div>
							  <div class="btn-group">
								  <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-cog icon-white"></i> Actions
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#"><i class="icon-envelope"></i> Send Message</a></li>
									<li><a href="#"><i class="icon-remove"></i> Remove friend</a></li>
								  </ul>
								</div>
							</div>
							</div>
						  </li>
						  <li class="span3">
							<div class="thumbnail">
							  <img src="http://placehold.it/260x180" alt="">
							  <h3>Friend name</h3>
							  <p>Thumbnail caption right here...</p>
							 <div class="btn-toolbar">
							  <div class="btn-group">
								  <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-user icon-white"></i> Groups
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#">Family</a></li>
									<li><a href="#">Blibb Team</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="icon-ok"></i> Add Group</a></li>
								  </ul>
								</div>
							  <div class="btn-group">
								  <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
									<i class="icon-cog icon-white"></i> Actions
									<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
									<li><a href="#"><i class="icon-envelope"></i> Send Message</a></li>
									<li><a href="#"><i class="icon-remove"></i> Remove friend</a></li>
								  </ul>
								</div>
							</div>
							</div>
						  </li>
						  
						</ul>


					</div>
				</div>

				

		
		<link href="css/fileuploader.css" rel="stylesheet" type="text/css">
		<script src="js/fileuploader.js" type="text/javascript"></script>

		<script src="js/bootstrap-tab.js">
			$('#profile').tab('show');
			$('#groups').tab('show');
			$('#friends').tab('show');
		</script>

		<script src="js/bootstrap-modal.js">
			$('#myModal').modal({
				keyboard: true,
				show: false
			});
		</script>

		<script src="js/bootstrap-dropdown.js">
			$('.dropdown-toggle').dropdown();
		</script>

		<script type="text/javascript">
			
			$(document).ready(function(){
				var val = $("#range").val();
				$("#money-val").html('$' + val);
				 createUploader('imageUploader', '<?php echo $key ?>');
			});

			$('#range').change(function() {
				var val = $("#range").val();
				val = parseFloat(val);
				val = val.toFixed(2);
				$("#money-val").html('$' + val);
			});

			function updateProfilePicture(picture){
				$.post("/actions/updateProfilePicture", { id: picture },
				   function(data) {
				     $alert = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>" + data +"</div>";
					$('#imagebox').after($alert);
				   });
			}

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
		            	var srcI = "actions/getImage?id=" + resp + "&i=260";
		            	$("#img_image").attr("src",srcI);
		            	$("#im_image").show();
		            	$(".qq-upload-failed-text").hide();
		            	updateProfilePicture(resp);
		            },
		        });
		    }
			</script> 

	</div> <!-- profileBox -->
</div><!-- container -->
		
