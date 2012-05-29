<?php

require_once(__DIR__.'/../../system/config.php');


class CheckInvite extends lib {

    public function run() {

		$user = $this->gt("id");
		$pest = new Pest(REST_API_URL);
		$jresp = $pest->get('/user/invite/' . $user);
    	
    	$users = json_decode($jresp);
    	if(isset($users->email)){
    		echo 'True';
    	}else{
    		echo 'False';
    	}
    }

}

$app = new CheckInvite();

$app->run();