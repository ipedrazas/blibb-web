<?php
require_once(__DIR__.'/../inc/header.php');
?>

<link type="text/css" href="/css/addItem.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/user.css">
<link href="/css/fileuploader.css" rel="stylesheet" type="text/css">

<link type="text/css" href="/css/blitzer/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/js/libs/jquery.ui.core.js"></script>
<script type="text/javascript" src="/js/libs/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/js/libs/jquery.ui.datepicker.js"></script>
<script>
	$(function() {
	    	$( "#datepicker" ).datepicker();
		});
	$('a[name=addItem]').live("click", function(){
		$('#addItem').submit();
	});

	$('a[name=cancel]').live("click", function(){
		$('#addItem')[ 0 ].reset();
	});


</script>



 	<div class="container">
 		<h1>Edit Item:</h1>
 		<br><br>
 		<form action="updateItem" enctype="multipart/form-data" method="post" id="addItem">
 		 <input type="hidden" name="blibb_id" value="<?php echo $bid ?>">
 		 <input type="hidden" name="blitem_id" value="<?php echo $iid ?>">
 		 <input type="hidden" name="k" value="<?php echo getKey(); ?>">
 		 <input type="hidden" name="fields" value="<?php echo $fields ?>">

			<?php echo $buffer; ?>
			<label for="tags" >Tags:</label>
			 <input type="input" name="tags" value="" />
			 <?php
			 	if(isset($_SESSION['ERROR'])){
			 		echo "<div class='alert alert-error'><a class='close' data-dismiss='alert'>×</a>" . $_SESSION['ERROR']. "</div>";
			 		unset($_SESSION['ERROR']);
			 	}
			 ?>
				<fieldset>
				<ul>
					<li><a name="cancel" href="#" class="btn">Cancel</a></li>
					<li><a name="addItem" href="#" class="btn btn-primary">Update Item</a></li>
				</ul>
			</fieldset>
		</form>
	</div>

<script type="text/javascript">
<?php

	// foreach ($elements as $key => $value) {
	// 	echo "$('[name=". $key ."]').val('". htmlentities($value) ."');";
	// }


	echo $data_set;

	if(count($tags) >  0){
		$tgs = implode(" ", $tags);
		echo "$('[name=tags]').val('". htmlentities($tgs) ."');";
	}



?>
</script>


<?php
require_once(__DIR__.'/../inc/footer.php');
?>

