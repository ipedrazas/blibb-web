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
 		$bli->dk = hash('sha1', $bli->name . $bli->description);
 		$bli->id=$bid;

 		$jfields = $pest->get('/blibb/meta/fields/' . $bid );
 		$fields = json_decode($jfields);
 		$bli->fields = $fields;
 		// print_r($fields);
 		// print_r($bli);


 		$jwhs = $pest->get('/blibb/meta/webhooks/' . $bid );
 		$whs = json_decode($jwhs);
 		$bli->webhooks = $whs->webhooks;
 		
 		$this->render('blibbDashboard', compact('bli'));
    }
}

$app = new bDashboard();
$app->run();  
