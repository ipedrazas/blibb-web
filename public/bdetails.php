<?php

require_once(__DIR__.'/../system/config.php');


class bDashboard extends lib {

    public function run() {
    	$current_user = require_login(); 
    	$this->setRedirect();
		$bid = $this->gt("b");

		$pest = new Pest(REST_API_URL);
    	$jb = $pest->get('/blibb/' . $bid . '/view');
 		$bli = json_decode($jb);
 		$bli->dk = hash('sha1', $bli->name . $bli->description);
 		$bli->id=$bid;

 		$jfields = $pest->get('/blibb/meta/fields/' . $bid );
 		$fields = json_decode($jfields);
 		$bli->fields = $fields->fields;
 		// print_r($fields);
 		// print_r($bli);


 		$jwhs = $pest->get('/blibb/meta/webhooks/' . $bid );
 		$whs = json_decode($jwhs);
 		$bli->webhooks = $whs->webhooks;
 		$num_views = $bli->stats[0]->num_views;
 		$num_writes = $bli->stats[1]->num_writes;
 		$num_items = $bli->stats[2]->num_items;
 		
 		$this->render('blibbDashboard', compact('bli', 'num_items', 'num_writes', 'num_views'));
    }
}

$app = new bDashboard();
$app->run();  
