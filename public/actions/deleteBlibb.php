<?php

require_once(__DIR__.'/../../system/config.php');


class DeleteBlibb extends lib {

    public function run() {

        $user = require_login();
		$bid = $this->gt("id");
		$pest = new Pest(REST_API_URL);
		$ret = $pest->delete('/blibb/'. $bid . '/'. getKey());    	
        $dest = '/user/'. $user;        
        header("Location: " . $dest);
    }

}

$app = new DeleteBlibb();

$app->run();