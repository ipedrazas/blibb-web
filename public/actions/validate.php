<?php

require_once(__DIR__.'/../../system/config.php');


class ValidateApplication extends lib {

    public function run() {

    	$cmail = new BMail();
		$email = $this->gt("id");
    	echo $cmail->email_valid($email);
    	
    }

}

$app = new ValidateApplication();

$app->run();