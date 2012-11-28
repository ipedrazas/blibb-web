<?php

require_once(__DIR__.'/../system/config.php');

class NewUserApplication extends lib {

    public function run() {  	
	    $this->render('registry',  compact('msg'));
    }

}

$app = new NewUserApplication();
$app->run();  