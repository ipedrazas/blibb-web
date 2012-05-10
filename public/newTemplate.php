<?php

require_once(__DIR__.'/../system/config.php');


class NewTemplateApplication extends lib {

    public function run() {
		$current_user = require_login();
    	$view = 'newTemplate';	
    	$k = getKey();

	    $this->render($view,  compact('msg', 'r','k'));
    }

}

$app = new NewTemplateApplication();
$app->run();  