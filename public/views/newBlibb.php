<?php
	require_once(__DIR__.'/../inc/header.php');
	if(!isset($bname)){
		$bname = '';
		$bdesc = '';
		$msg = '';
		$bslug = '';
	}

?>

<link rel="stylesheet" href="css/user.css">

<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<script type="text/javascript">

	$('input[name=bgroup]').live("click", function(){	
		var checked = $(this).attr('checked');

		if(checked!='checked'){
			$('#groupInvites').hide();	
		}else{
			$('#groupInvites').show();	
		}
		
	}); 


	$('a[name=template]').live("click", function(){	
		event.preventDefault();		 
		var oid = $(this).attr('id');
		$('#btemplate').val(oid);
	}); 
	
	$('a[name=create]').live("click", function(){	
		$('#nform').submit();
	}); 
	
	$('a[name=cancel]').live("click", function(){	
		$('#nform')[ 0 ].reset();
	}); 

	$("#nform").live("submit", function(){	
		var isOk = false;
		var name = $("#bname").val();
		var template = $("#btemplate").val();

		if (name) {
			if(template){
				isOk = true;
			}else{
				$('#errorMsg').show();
				$('#errorMsg').html("You have to select a template");
			}
	    }else{
	    	$('#errorMsg').show();
			$('#errorMsg').html("You have to write a name");
		}
		  return isOk;
	} );	


</script>
<link href="css/fileuploader.css" rel="stylesheet" type="text/css">
<script src="js/fileuploader.js" type="text/javascript"></script>
<script>
    $(function() {                
        createUploader('imageUploader', '', '<?php echo $key ?>');
    }); 
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
            },
        });
       $("#bname").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#bslug").val(Text);        
});
    }
</script>
	<div class="container">
		<form action="saveBlibb" method="post" id="nform" >
			<input type="hidden" name="btemplate" id="btemplate" /> 
			<input type="hidden" name="bkey" value="<?php echo $key ?>" /> 
			<label for="bname">Name:</label>
			<input name="bname" id="bname" placeholder="New Blibb name" size="70" type="text" value="<?php echo $bname ?>"/><br>
			<label for="bslug">Slug:</label>
			<input name="bslug" id="bslug" placeholder="Blibb unique name" size="70" type="text" value="<?php echo $bslug ?>"/><br>
			<label for="bdesc">Description</label>
			<textarea name="bdesc" id="bname" placeholder="Enter your Blibb description" class="txtEditor" cols="70" rows="5"><?php echo $bdesc ?></textarea><br>
			<input type="hidden" name="bimage" value="" id="bimg">
<div>
			<label>image:</label>
			<div id="imageUploader" name="uploadImage">
				<noscript><p>Please enable JavaScript to use file uploader.</p></noscript>         
			</div>
			<div id="im_image" style="display:none"><img id="img_image"  alt="thumbnail" width="260"/></div>

			<label for="listTemplate">Template:</label>
			<ul class="listTemplate">
				<?php								
					echo $t;
				?>
				
			</ul>
			<br />
				<label for="bgroup">Allow Collaboration</label>
				<input type="checkbox" id="bgroup" name="bgroup" value="1" />
				<div id="groupInvites"><label for="invites"><textarea name="email_invites" placeholder="Please, enter the email adresses separated by space of the people you want to invite to this :blibb"></textarea></label></div>
			<br />
			
			<br />
			<?php if($msg){
				echo '<div id="errorMsg" class="msg error" >'.$msg.'</div>';
			 } ?>

			<ul>
				<li><a href="newTemplate" class="bNewBlibb">Create a new Template</a></li>
				<li><a name="cancel" href="#" class="bNewBlibb">Cancel</a></li>
				<li><a name="create" href="#" class="bNewBlibb">Save Blibb</a></li>
			</ul>
			

		</form>
				
</div>

			

<?php
require_once(__DIR__.'/../inc/footer.php');
?>