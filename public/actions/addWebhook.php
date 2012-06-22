<?php

require_once(__DIR__.'/../../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		
		$pestParams = array();
		$pestParams['blibb_id'] = $this->gt("id");
		$pestParams['action'] = $this->gt("action");
		$pestParams['login_key'] = getKey();
		$pestParams['fields'] = $this->gt('fields');
		$pestParams['callback'] = $this->gt("callback");


		$pest = new Pest(REST_API_URL);
		$jresult = $pest->post('/blibb/actions/webhook',$pestParams);
		echo $jresult;

		// print_r($pestParams);
        
    }

}

$app = new Application();
$app->run();  

