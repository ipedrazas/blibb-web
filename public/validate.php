<?php

require_once(__DIR__.'/../system/config.php');


class ValidateApplication extends lib {

    public function run() {

    	$cmail = new BMail();
		$email = $this->gt("id");
    	$result = $cmail->email_valid($email);
    	
        $this->render('ajaxResponse',  compact('result'));
    }

}

$app = new ValidateApplication();

$app->run();