<?php

require_once(__DIR__.'/../../system/config.php');


class ReloadTemplateApplication extends lib {

    public function run() {
		
		$bid = $this->gt("b");
		$tName = $this->gt("t"); // Template name

		$current_user = require_login();		

		$msg = "Template hasn't been reloaded";
		if(!empty($tName)){
			$t = Dbo::findOne('Template', array('n' => $tName));
			$mbid = new MongoId($bid);
			$b = Dbo::findOne('Blb', array('_id' => $mbid));
			$b->t = $t;
			Dbo::save($b);
			$msg = "Template Reloaded";
		}

    	$this->render('showMessage',compact('msg'));
        
    }

}

$app = new ReloadTemplateApplication();
$app->run();  