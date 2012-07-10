<?php

require_once(__DIR__.'/../system/config.php');

class ListTemplates extends lib {

    public function run() {

    	// $current_user = require_login();
    	$current_user = require_login();
		$k = getKey();
    	
		$pest = new Pest(REST_API_URL);
		$url_api = '/template/' . getKey();;

    	$jtemplates = $pest->get($url_api);
 		$templates = json_decode($jtemplates);
 		$templates = $templates->result;

 		$this->render('listTemplates',compact('templates'));
        
    }
}

$app = new ListTemplates();
$app->run();  

