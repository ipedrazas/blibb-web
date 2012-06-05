<?php
require_once(__DIR__.'/../inc/header.php');
?>

<link rel="stylesheet" href="css/user.css">

<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script> 

<script>

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
		var name = $("#uname").val();
		var email = $("#email").val();
		var pwd = $("#password").val();

		if (name) {
			if(email){
				if(pwd){
					isOk = true;	
				}else{
				   	$('#errorMsg').show();
					$('#errorMsg').html("You have to write a password");	
				}
			}else{
				$('#errorMsg').show();
				$('#errorMsg').html("You have to an email");
			}
	    }else{
	    	$('#errorMsg').show();
			$('#errorMsg').html("You have to write a name");
		}
		  return isOk;
	} );
	
</script>

	    	<section id="main">				
					<form action="saveUser" method="post" id="nform" >
						
						<label for="name">User Name:</label>
						<input name="name" id="uname" placeholder="New UserName" size="70" type="text" /><br>
						
						<label for="email">Email:</label>
						<input name="email" id="email" placeholder="Email" size="70" type="text" /><br>

						<label for="pssword">Password:</label>
						<input name="password" id="password" placeholder="Password" size="70" type="password" /><br>

						<input type="submit" value="create" class="btn btn-primary">
					</form>
				<div id="errorMsg" class="msg error" style="display:none"></div>
			</section>


<?php
require_once(__DIR__.'/../inc/footer.php');
?>