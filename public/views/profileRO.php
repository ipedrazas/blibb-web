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
			<div class="tab-content" style="width: 600px;">
				<div class="tab-pane active" id="profile">
					<div class="well">						
						<legend>Profile info</legend>
						
						<p>	
							<strong>Username:</strong><?php echo $username ?>
						</p><p>
						<strong>Email:</strong>	<?php echo $email ?>
						</p><p>
							<img id="img_image"  alt="thumbnail" src="<?php echo $image ?>" />
						</p>
					</div>					
				</div> <!-- profile -->			
			</div>
		</div>
	</div> <!-- profileBox -->
</div><!-- container -->
			
