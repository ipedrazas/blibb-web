<?php
	require_once(__DIR__.'/../inc/header.php');
?>
<link rel="stylesheet" href="css/user.css">
<style>
#nform{
	margin-top: 30px;
}
#controlContainer{
	margin-bottom: 30px;
	width: 85%;
	padding: 10px;
	padding-bottom: 30px;
}
input, textarea{
	width: 66%;
}


</style>

   	<div class="container">
		<div class="page-header">
  				<h1>New Control</h1>
		</div>
				
			
		<div class="row">
			<div class="span8 offset2">
				<form action="saveControl" enctype="multipart/form-data" method="post" id="nform" class="well">
					<input type="hidden" name="k" value="<?php echo $k ?>" />
					<div class="control-group offset1">
				      <div class="controls">
				        <input type="text" class="span4" id="title" name="control_name" placeholder="Control Name">
				      </div>
				    </div>
				     <div class="control-group offset1">
				      <div class="controls">
				        <label for="control_type">Control Type:</label> <select name="control_type">
				        	<option value="01">Text</option>
				        	<option value="02">Multi line</option>
				        	<option value="03">Date</option>
				        	<option value="04">List</option>
				        	<option value="61">Twitter</option>
				        	<option value="51">URL</option>
				        	<option value="21">Image</option>
				        	<option value="31">MP3</option>
				        	<option value="41">Document</option>
				        </select>
				      </div>
				    </div>
					<div class="control-group offset1">
						<div class="controls">
							<textarea class="span4" id="description" name="control_button" placeholder="html for the button" rows="5"></textarea>
						</div>
					</div>
					<div class="control-group offset1">
						<div class="controls">
							<textarea class="span4" id="description" name="control_ui" placeholder="html for the control in the form" rows="5"></textarea>
						</div>
					</div>
					<div class="control-group offset1">
						<div class="controls">
							<textarea class="span4" id="description" name="control_value" placeholder="html for rendering the content of the control" rows="5"></textarea>
						</div>
					</div>
				    <div class="offset1">
				    	<input type="reset" id="reset" value="Cancel" name="cancel" class="btn">
				    	<input type="submit" id="submit" name="create" value="Save" class="btn btn-primary">
				    </div>
				</form>
			</div>
		</div>

</div>
	
<?php
require_once(__DIR__.'/../inc/footer.php');
?>