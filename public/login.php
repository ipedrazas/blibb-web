<?php


require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {

    	$expire = 86400 ; // 1 day
    	
		$reqHash = hash('sha1', session_id() + session_id());
		$t = $this->gt("t");
		// it comes from the login form
		if($t === $reqHash){
			$user = $this->gt("u");
			$pwd =  $this->gt("p");

			$user = stripslashes($user);
			$pwd = stripslashes($pwd);

			$u = Dbo::findOne('User', array('e' => $user));

			if(empty($u->n)){
				$errorMsg = '<li class="errorLogin">User or Password not found!</li>';
				
			}else{	
				if($u->authenticate($user,$pwd)){
					$u->la = new DateTime('now');
					Dbo::save($u);
					if(!isset($_SESSION['redirect_to'])){
						$destURL = 'main';
					}else{
						$destURL = $_SESSION['redirect_to'];	
						unset($_SESSION['redirect_to']);
					}						
					log_in($u->_id,$u->n);

					header("Location: $destURL");
					exit();
				}else{
					$errorMsg = ' <li class="errorLogin">User or Password not found!</li>';
				}	
			}
			
		}else{
			$errorMsg = '';
		}
    	$this->render('login',compact('errorMsg','reqHash'));        
    }
}

$app = new Application();
$app->run();  

