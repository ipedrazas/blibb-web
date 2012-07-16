<?php

require_once(__DIR__.'/../system/config.php');

class Application extends lib {

    public function run() {

		
	    session_unset();
	    session_destroy();
	    session_write_close();
	    session_regenerate_id();
    	$result = ' bye!';
        $this->render('logout',compact('result'));
    }

}

$app = new Application();

$app->run();  