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
 		<h1>Add Item:</h1>
 		<br><br>
 		<form action="saveItem" enctype="multipart/form-data" method="post" id="addItem">
 		 <input type="hidden" name="b" value="<?php echo $bid ?>">
 		 <input type="hidden" name="k" value="<?php echo getKey(); ?>">

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
					<li><a name="addItem" href="#" class="btn btn-primary">Add Item</a></li>
				</ul>
			</fieldset>
		</form>
		<div id="upload_image_file" style="display:none;">
		    <form enctype="multipart/form-data" id="upload_image_file_blibb">
		        <input name="file" type="file" />
		        <input type="button" id="image_btn" value="Upload" />

		    	<progress style="display:none"></progress>
		    <div id="result"></div>
		</div>
	</div>



<script type="text/javascript">

$('#image_btn').click(function(){
    $('progress').show();
    var formData = new FormData($('#upload_image_file_blibb')[0]);
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

function errorHandler(e){
    $('progress').hide();
    var alert = "<div class='alert alert-error'><a class='close' data-dismiss='alert'>×</a>There was an error uploading your picture!</div>";
    $('#imagebox').after(alert);
}
</script>
<?php
require_once(__DIR__.'/../inc/footer.php');
?>

