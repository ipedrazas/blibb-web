<?php

require_once(__DIR__.'/../inc/header.php');
?>
<div class="container">
        <ul id="messages">

        <?php
			if(isset($errorMsg)){
				echo $errorMsg;
			}
        ?>
        </ul>

		<section id="login" class="span4 offset4">
			<form accept-charset="UTF-8" action="login" class="new_user_session" id="new_user_session" method="post">
				<fieldset>
					<legend><strong>Log In!</strong></legend>
				<div style="margin:0;padding:0;display:inline">
					<input name="utf8" type="hidden" value="&#x2713;" />
					<input name="t" type="hidden" value="<?php echo $reqHash ?>" />
				</div>
				<p class"offset2">
				  <label for="u">Username or Email <small>Don't have an account? <a href="signup.php" tabindex="999">Sign up</a></small></label>

				  <input id="u" class="span4" name="u" placeholder="email@example.com" size="30" type="text" />
				</p>


				<p class"offset2">
				  <label for="p">Password <small><a href="forgotpassword.php" tabindex="999">Forgot your password?</a></small></label>

				  <input id="p" class="span4" name="p" size="30" type="password" />
				</p>

				<p class"offset3">
					<input type="submit" class="btn btn-primary span4" value="Log in">
				</p>
				</fieldset>
			</form>
		</section>
	</div>
<?php
require_once(__DIR__.'/../inc/footer.php');
?>
