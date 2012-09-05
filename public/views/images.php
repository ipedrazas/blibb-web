 <?php
	require_once(__DIR__.'/../inc/header.php');

?>
 <!-- Adds the Filepicker.io javascript library to the page -->
<script src="https://api.filepicker.io/v0/filepicker.js"></script>


<script type="text/javascript">
    //Seting up Filepicker.io with your api key
    filepicker.setKey('AGz6SRen-RFC-vrh8rWR8z');

	$('a[name=upload]').live("click", function(){
		filepicker.getFile('image/*', function(url, data){
			console.log(url);
		    $('#result').append('<img src="' + url + '" />');
		  });
	});

</script>

<a name="upload" href="#" class="btn btn-primary">Upload</a>

<id id="result"><a></a></id>

<?php
require_once(__DIR__.'/../inc/footer.php');
?>
