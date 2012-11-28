<?php

require_once(__DIR__.'/../../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		$bid = $this->gt("k");
		

		$pestParams = array();
		$pestParams['comment'] = $this->gt("comment");
		$pestParams['login_key'] = getKey();
		$pestParams['item_id'] = $this->gt("item_id");

		$pest = new Pest(REST_API_URL);
		$jresult = $pest->post('/comment',$pestParams);
		
		echo $jresult;

		// print_r($pestParams);
        
    }

}

$app = new Application();
$app->run();  

