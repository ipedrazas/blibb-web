<?php

require_once(__DIR__.'/../system/config.php');


class bDashboard extends lib {

    public function run() {
    	$current_user = require_login(); 
    	$this->setRedirect();
		$bid = $this->gt("b");

		$pest = new Pest(REST_API_URL);
    	$jb = $pest->get('/blibb/' . $bid . '/view/Default');
 		$bli = json_decode($jb);
 		$bli->dk = hash('sha1', $bli->name . $bli->decription);
 		$bli->id=$bid;
 		// print_r($bli);
 		$this->render('blibbDashboard', compact(bli));
    }
}

$app = new bDashboard();
$app->run();  
