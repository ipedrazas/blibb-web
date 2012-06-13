
 <?php
require_once(__DIR__.'/../inc/header.php');
?>
		
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style type="text/css">

			.navbar-inner {
				border-radius: 0;
				-webkit-border-radius: 0;
				background-color: #B21006;
				background-image: none;
			}

			#addItem-btn {
				margin-right: 10px;
			}

			a {
				color: #9D261D;
				text-decoration: none;
			}

			a:hover {
				color: #5C1611;
				text-decoration: underline;
			}

			.nav-list .active > a, .nav-list .active > a:hover {
				color: white;
				text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
				background-color: #9D261D;
			}

			.nav > li > a:hover {
				text-decoration: none;
				background-color: #EEE;
			}

			
		</style>
		

		<div class="container">
			<form class="form-horizontal" action="saveUser" method="post">
  				<fieldset>
    				<legend>Registration Form</legend>

    				<div class="control-group offset2">
      					<label class="control-label" for="user">Your username</label>
      					<div class="controls">
        					<input type="text" name="username" class="input-xlarge" id="user">
      					</div>
    				</div>

    				<div class="control-group offset2" id="mailBox">
      					<label class="control-label" for="mail">Your email</label>
      					<div class="controls">
        					<input type="email" name="email" class="input-xlarge" id="mail">
        					<p class="help-block">email@example.com</p>
      					</div>
    				</div>

    				<div class="control-group offset2">
      					<label class="control-label" for="pwd">Password</label>
      					<div class="controls">
        					<input type="password" name="pwd" class="input-xlarge" id="pwd">
      					</div>
    				</div>

    				<div class="control-group offset2">
      					<label class="control-label" for="reg.code">Invitation code</label>
      					<div class="controls">
        					<input type="text" name="invite" class="input-xlarge" id="invite">
        					<p class="help-block">Enter here your code for our private beta</p>
      					</div>
      					<?php
							if(isset($msg)){
								echo "<div id=\"userMsg\" class='alert alert-error'>".$msg."</div>";
							}
						?>
    				</div>

    				<div class="form-actions">
			        	<button type="reset" class="btn offset2">Cancel</button>
			        	<button type="submit" class="btn btn-primary">Register</button>
			        </div>
  				</fieldset>
			</form>
			


		</div>
		<script type="text/javascript">

			$('#invite').live("focusout", function(){	
				var invite = $(this).val();
				$.get("/actions/checkInvite", { id: invite },
					   function(data) {
					   	if(data==='True'){
							$alert = "<div id=\"userMsg\" class='alert alert-success'><i class=\"icon-ok\"></i></div>";
							$('#user').after($alert);
					   	}else{
							$alert = "<div id=\"userMsg\" class='error'><i class=\"icon-remove\" ></i></div>";
							$('#user').after($alert);
					   	}
					   	$('#userMsg').delay(3000).fadeOut('slow');
					    
					});
			}
			
			$('#user').live("onfocusin", function(){	
				$('#userMsg').hide();
			});

			$('#user').live("focusout", function(){	
				var user = $(this).val();
				if(user.length>2){
					$.get("/actions/isAvailable", { user: user },
					   function(data) {
					   	if(data==='True'){
							$alert = "<div id=\"userMsg\" class='alert alert-success'><i class=\"icon-ok\"></i></div>";
							$('#user').after($alert);
					   	}else{
							$alert = "<div id=\"userMsg\" class='error'><i class=\"icon-remove\" ></i></div>";
							$('#user').after($alert);
					   	}
					   	$('#userMsg').delay(8000).fadeOut('slow');
					    
					});
				}
			}); 
		</script>
<?php
require_once(__DIR__.'/../inc/footer.php');
?>