<?php

require_once(__DIR__.'/../system/config.php');


class ViewTemplate extends lib {

    public function run() {

    	$this->setRedirect();
    	$fullView = $this->getParameter("v","",$_GET);

		$tid = $this->getParameter("t","",$_GET);
		$tbid = new MongoId($tid);
		$t = Dbo::findOne('Template', array('_id' => $tbid));

		$owner = false;
		
		$current_user = current_user();

		$username = $t->u;	
		if($username === $current_user){
			$owner = true;
		}
		
		$name = $t->n;
		$desc = $t->d;

		// Get the System Controls Blibb

		$this->render('viewTemplate',compact( 'owner', 'current_user', 'tid', 'name','desc'));

        
    }
}

$app = new ViewTemplate();
$app->run();  

