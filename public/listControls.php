<?php

require_once(__DIR__.'/../system/config.php');

class ListControls extends lib {

    public function run() {

    	// $current_user = require_login();
    	$current_user = require_login();
		$k = getKey();
    	
		$pest = new Pest(REST_API_URL);
		$url_api = '/controls';

    	$jcontrols = $pest->get($url_api);
 		$controls = json_decode($jcontrols);
 		$controls = $controls->controls;

 		$this->render('listControls',compact('controls'));
        
    }
}

$app = new ListControls();
$app->run();  

