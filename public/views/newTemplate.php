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
  				<h1>Template Builder</h1>
		</div>
				
			
		<div class="row">
			<div class="span8 offset2">
				<form action="saveTemplate" enctype="multipart/form-data" method="post" id="nform" class="well">
					<input type="hidden" name="k" value="<?php echo $key ?>" /> 
	        			<input type="hidden" name="s" value="1" /> 
					<div class="control-group offset1">
				      
				      <div class="controls">
				        <input type="text" class="span4" id="title" name="template_name" placeholder="Template Title">
				        
				      </div>
				    </div>

				    <div class="control-group offset1">
				      
				      <div class="controls">
				        <textarea class="span4" id="description" name="template_desc" placeholder="You can write a little description here"></textarea>
				        
				      </div>
				    </div>

				    <div class="offset1">
				    	<input type="reset" id="reset" value="Cancel" name="cancel" class="btn btn-danger">
				    	<input type="submit" id="submit" name="create" value="Save" class="btn">
				    </div>

				    

				</form>
			</div>
		</div>

</div>
	
<?php
require_once(__DIR__.'/../inc/footer.php');
?>