<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		$bid = $this->gt("k");
		

		$pestParams = array();
		$pestParams['c'] = $this->gt("comment");
		$pestParams['k'] = $this->gt("k");

		$parent = $this->gt("parent");
		$pestParams[$parent] = $this->gt("pid");

		$pest = new Pest('http://localhost:5000');
		$result = $pest->post('/comment',$pestParams);
		
		// $rMsg = json_decode($result);
		// $bid = $this->gt('b');
		// header("Location: blibb?b=$bid");
        
    }

}

$app = new Application();
$app->run();  

