<?php

require_once(__DIR__.'/../../system/config.php');


class UserAvailableApplication extends lib {

    public function run() {

		$user = $this->gt("user");
		$pest = new Pest(REST_API_URL);
		$jresp = $pest->get('/user/name/' . $user);
    	
    	$users = json_decode($jresp);
    	if(isset($users->email)){
            // if it's set, the user is taken
    		echo 'False';
    	}else{
    		echo 'True';
    	}
    }

}

$app = new UserAvailableApplication();

$app->run();