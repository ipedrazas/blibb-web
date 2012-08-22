<?php
	require_once(__DIR__.'/../inc/header.php');

	$k = getKey();
	$user_id = getUserId($k);
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
								<img src="<?php echo $image ?>" alt="<?php echo $username ?> profile's picture" width="245" id="profile_picture"/>
								<a href="#" id="update_profile_pict">Change Image</a>
								<div id="update_profile_pict_form" style="display:none">
									<form enctype="multipart/form-data" id="profile_image_form">
										<input name="file" type="file" />
										<input type="button" id="image_btn" value="Upload" />
									</form>
									<progress style="display:none"></progress>
									<div id="result"></div>
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
					</div>
				</div> <!-- profile -->
			</div>

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

		$('#update_profile_pict').click(function(event){
			event.preventDefault();
			$('#update_profile_pict_form').show();
		});

		$('#image_btn').click(function(){
		        $('progress').show();
		        var formData = new FormData($('#profile_image_form')[0]);
		        formData.append('login_key', '<?php echo getKey() ?>');
		        $.ajax({
		            url: '<?php echo REST_API_URL ?>/image/upload',
		            type: 'POST',
		            xhr: function() {
		                myXhr = $.ajaxSettings.xhr();
		                return myXhr;
		            },
		            success: completeHandler,
		            error: errorHandler,
		            data: formData,
		            cache: false,
		            contentType: false,
		            processData: false
		        });
		    });
		    function completeHandler(e){
		        $('progress').hide();
		        $('#profile_picture').attr('src', e.upload);
		        // update user profile
 				$.post('<?php echo REST_API_URL ?>/user/image', { user_id: '<?php echo $user_id ?>', image_url: e.upload  },
				   function(data) {
				    	$alert = "<div class='alert alert-success'><a class='close' data-dismiss='alert'>×</a>User Profile has been updated</div>";
						$('#imagebox').after($alert);
						// TODO:
						// Update image_url in php session
				   });
		    }

		    function errorHandler(e){
		        $('progress').hide();
		        var alert = "<div class='alert alert-error'><a class='close' data-dismiss='alert'>×</a>There was an error uploading your picture!</div>";
		        $('#imagebox').after(alert);
		    }
			</script>

	</div> <!-- profileBox -->
</div><!-- container -->

<?php
require_once(__DIR__.'/../inc/footer.php');
?>
