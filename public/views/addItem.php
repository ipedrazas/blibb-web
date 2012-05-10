<?php
require_once(__DIR__.'/../inc/header.php');
?>

<link type="text/css" href="css/blitzer/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<link type="text/css" href="css/addItem.css" rel="stylesheet" />
<link rel="stylesheet" href="css/user.css">
<link href="css/fileuploader.css" rel="stylesheet" type="text/css">	
<script>

	$('a[name=addItem]').live("click", function(){	
		$('#addItem').submit();
	}); 
	
	$('a[name=cancel]').live("click", function(){	
		$('#addItem')[ 0 ].reset();
	});

</script>



 	<div class="container">
 		<h1>Add Item:</h1>
 		<br><br>
 		<form action="saveItem" enctype="multipart/form-data" method="post" id="addItem">
 		 <input type="hidden" name="b" value="<?php echo $bid ?>">
 		 <input type="hidden" name="f" value="<?php echo $dest ?>">
 		 <input type="hidden" name="k" value="<?php echo $k ?>">

			<?php echo $buffer; ?>
			<label for="tags" >Tags:</label>
			 <input type="input" name="tags" value="" />

				<fieldset>
					
				<ul>
					<li><a name="cancel" href="#" class="bNewBlibb">Cancel</a></li>
					<li><a name="addItem" href="#" class="bNewBlibb">Add Item</a></li>
				</ul>
			</fieldset>		
		</form>
	</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('#datepicker').datepicker({
	        defaultDate: +7 
	    });
	});
</script>

<?php
require_once(__DIR__.'/../inc/footer.php');
?>