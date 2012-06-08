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
 		$jfields = $pest->get('/blibb/meta/fields/' . $bid );
 		$fields = json_decode($jfields);
 		$bli->fields = $fields;
 		// print_r($fields);
 		$this->render('blibbDashboard', compact(bli));
    }
}

$app = new bDashboard();
$app->run();  
