<?php


require_once(__DIR__.'/../system/config.php');

class Login extends lib {
    public function run() {

		$t = $this->gt("t");
		// it comes from the login form

		$user = $this->gt("email");
		$pwd =  $this->gt("password");

		$user = stripslashes($user);
		$pwd = stripslashes($pwd);

		if($user && $pwd){
			$pest = new Pest(REST_API_URL);

			try {
			    $result = $pest->post('/login',array(
					'u' => $user,
					'p' => $pwd
				));
				log_in($result);
				if(!isset($_SESSION['redirect_to'])){
						$destURL = 'main';
				}else{
					$destURL = $_SESSION['redirect_to'];
					unset($_SESSION['redirect_to']);
				}

				header("Location: $destURL");
				exit();
				// print_r($result);
			} catch (Pest_Unauthorized $e) {
			    // 401
			    $errorMsg = '<li class="errorLogin">User or Password not found!</li>';
			} catch (Pest_NotFound $e) {
			    // 404
			    $errorMsg = '<li class="errorLogin">User or Password not found!</li>';
			}
		}else{
			$errorMsg = '<li class="errorLogin">User or Password not found!</li>';
		}

		$this->render('login',compact('errorMsg','reqHash'));
    }
}

$app = new Login();
$app->run();

