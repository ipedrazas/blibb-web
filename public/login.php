<?php


require_once(__DIR__.'/../system/config.php');

class Login extends lib {
    public function run() {
		$reqHash = hash('sha1', session_id() + session_id());
		$t = $this->gt("t");
		// it comes from the login form
		if($t === $reqHash){
			$user = $this->gt("u");
			$pwd =  $this->gt("p");

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

				} catch (Pest_NotFound $e) {
				    // 404
				    $errorMsg = '<li class="errorLogin">User or Password not found!</li>';
				}
			}else{
				$errorMsg = '<li class="errorLogin">User or Password not found!</li>';
			}
		}else{
			$errorMsg = '';
		}
    	$this->render('login',compact('errorMsg','reqHash'));        
    }
}

$app = new Login();
$app->run();  

