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
				</ul>
			  <div class="tab-content" style="width: auto;">
				<div class="tab-pane active" id="profile">
					<div class="well">
						<form class="form-horizontal" action="#" method="post">
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
										<div id="im_image" ><img id="img_image"  alt="thumbnail" src="/actions/getImage?i=260&id=<?php echo $image ?>" /></div>
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
					
				</div> <!-- profile -->

			
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
				$.post("/actions/updateImage", { id: picture, oid: '', type: 'user'  },
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
		
<?php
require_once(__DIR__.'/../inc/footer.php');
?>