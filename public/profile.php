<?php

require_once(__DIR__.'/../system/config.php');

class ProfileApplication extends lib {

    public function run() {
		$current_user = current_user();
		$nuser = $this->gt("p");

		$pest = new Pest(REST_API_URL);
		$jr = $pest->get('/user/name/' . $nuser);
		$user = json_decode($jr);

		if($current_user === $user->username){
			$view = "profile";
		}else{
			//readonly
			$view = "profileRO";
		}

		// // print_r($user);
		// // print_r($current_user);

		if(isset($user->error)){
			header('HTTP/1.0 404 Not Found');
		}else{
			// username
			$username = $user->username;
			// email
			$email = $user->email;
			// picture
			$pwd = "password";

			$image = $user->image_url;

		    $this->render($view,  compact('username','email','pwd','image'));
		}


    }

}

$app = new ProfileApplication();
$app->run();
