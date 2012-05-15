<?php

require_once(__DIR__.'/../system/config.php');

class ProfileApplication extends lib {

    public function run() {
		$current_user = current_user();
		$nuser = $this->gt("p");

		$pest = new Pest(REST_API_URL);
		$jr = $pest->get('/user/name/' . $nuser);
		$user = json_decode($jr);


		if($current_user === $user){
			$view = "profile";
		}else{
			//readonly
			$view = "profile";
			
		}

		// print_r($user);

		
		// username
		$username = $nuser;
		// email
		$email = $user->email;
		// picture
		$pwd = "password";
		$image = $user->t260;

	    $this->render($view,  compact('username','email','pwd','image'));
    }

}

$app = new ProfileApplication();
$app->run();  