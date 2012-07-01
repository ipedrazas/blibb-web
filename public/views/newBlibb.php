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

<script type="text/javascript" src="/js/jquery-ui-1.8.16.custom.min.js"></script> 
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
    	$("#bname").keyup(function(){
	        var Text = $(this).val();
	        Text = Text.toLowerCase();
	        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
	        $("#bslug").val(Text);        
		});             
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
    }
    
</script>
	<div class="container">
		<form action="saveBlibb" method="post" id="nform" class="form-horizontal" >
			<fieldset>
				<legend>Create blibb</legend>
			<input type="hidden" name="btemplate" id="btemplate" /> 
			<input type="hidden" name="bkey" value="<?php echo $key ?>" /> 
			
			<div class="control-group">
      			<label class="control-label" for="bname">Name:</label>
      			<div class="controls">
        			<input type="text" class="input-xxlarge" name="bname" id="bname" placeholder="New Blibb name" value="<?php echo $bname ?>">
        			
      			</div>
    		</div>

			<div class="control-group">
      			<label class="control-label" for="bslug">Slug:</label>
      			<div class="controls">
        			<input type="text" class="input-xxlarge" name="bslug" id="bslug" placeholder="Blibb unique name" value="<?php echo $bslug ?>">
        			
      			</div>
    		</div>

			<div class="control-group">
      			<label class="control-label" for="bdesc">Description:</label>
      			<div class="controls">
        			<textarea type="text" class="input-xxlarge txtEditor" name="bdesc" id="bname" placeholder="Enter your Blibb description"><?php echo $bdesc ?></textarea>
        			
      			</div>
    		</div>

			<input type="hidden" name="bimage" value="" id="bimg">
			<div class="control-group">
      			<label class="control-label">Image:</label>
      			<div class="controls">
        			<div id="imageUploader" name="uploadImage">
						<noscript><p>Please enable JavaScript to use file uploader.</p></noscript>         
					</div>
					<div id="im_image" style="display:none"><img id="img_image"  alt="thumbnail" width="260"/></div>
        			
      			</div>
    		</div>
		
			<div class="control-group">
				<label class="control-label" for="inlineCheckboxes">Who can read?</label>
				<div class="controls">
					<label class="checkbox inline">
						<input type="radio" id="inlineCheckbox1" name="read_access" value="1"> Only me
					</label>
					<label class="checkbox inline">
						<input type="radio" id="inlineCheckbox2" name="read_access" value="5"> Group
					</label>
					<label class="checkbox inline">
						<input type="radio" id="inlineCheckbox3" name="read_access" value="11" checked="checked"> Everybody
					</label>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inlineCheckboxes">Who can write?</label>
				<div class="controls">
					<label class="checkbox inline">
						<input type="radio" id="inlineCheckbox1" name="write_access" value="1" checked="checked"> Only me
					</label>
					<label class="checkbox inline">
						<input type="radio" id="inlineCheckbox2" name="write_access" value="5"> Group
					</label>
					<label class="checkbox inline">
						<input type="radio" id="inlineCheckbox3" name="write_access" value="11" > Everybody
					</label>
				</div>
			</div>
			<div class="control-group">
      			<label class="control-label" for="listTemplate">Template:</label>
      			<div class="controls">
        			<ul class="listTemplate">
						<?php								
							echo $t;
						?>	
					</ul>
      			</div>
    		</div>
			

			<div id="errorMsg" class="alert alert-error" style="display:none"></div>
			<?php
				if(isset($_SESSION['ERROR_MSG'])){					
					echo '<div id="error" class="alert alert-error">'.$_SESSION['ERROR_MSG'].'</div>';
				}
			?>

			<ul class="offset2">
				<li><a href="newTemplate" class="btn">Create a new Template</a></li>
				<li><a name="cancel" href="#" class="btn">Cancel</a></li>
				<li><a name="create" href="#" class="btn btn-primary">Save Blibb</a></li>
			</ul>
			
			</fieldset>
		</form>
				
</div>



<?php
require_once(__DIR__.'/../inc/footer.php');
?>