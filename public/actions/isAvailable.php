<?php

require_once(__DIR__.'/../../system/config.php');


class UserAvailableApplication extends lib {

    public function run() {

		$user = $this->gt("user");
		$pest = new Pest(REST_API_URL);
		$jresp = $pest->get('/user/name/' . $user);
    	
    	$users = json_decode($jresp);
    	if(isset($users->email)){
    		echo 'True';
    	}else{
    		echo 'False';
    	}
    }

}

$app = new UserAvailableApplication();

$app->run();