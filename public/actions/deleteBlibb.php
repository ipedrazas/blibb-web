<?php

require_once(__DIR__.'/../../system/config.php');


class DeleteBlibb extends lib {

    public function run() {

        $user = require_login();
		$bid = $this->gt("id");
		$pest = new Pest(REST_API_URL);
        $pestParams = array();
        $pestParams['b'] = $bid;
        $pestParams['k'] = getKey();        
		$ret = $pest->post('/blibb/del',$pestParams);    	
        $dest = '/user/'. $user;        
        header("Location: " . $dest);
    }

}

$app = new DeleteBlibb();

$app->run();