<?php

require_once(__DIR__.'/../system/config.php');


class NewControl extends lib {

    public function run() {
		$current_user = require_login();
    	$view = 'newControl';
    	$k = getKey();

		if(isAdmin($k)){
			$this->render($view,  compact('msg', 'r','k'));	
		}else{
			$msg = "You have to be administrator to access this area!";
			$this->render('showMessage',  compact('msg', 'r','k'));
		}
	    
    }

}

$app = new NewControl();
$app->run();  