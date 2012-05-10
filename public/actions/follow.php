<?php

require_once(__DIR__.'/../../system/config.php');

/*

	This action has to 

	1.- Queue request to process Follow Doc.
	2.- Return ok msg to Ajax request.

	1.1.- Fetch FollowDoc, if it doesn't exist, create a new one.
	1.2.- Add user to FollowDoc
	1.4.- Inc nf in FollowDoc
	1.5.- Inc nf in Blibb
	1.6.- Inc fb in User

	[NOTE: SimpleMongoPhp doesn't allow to inc a field ]

*/


class FollowBlibbApplication extends lib {

    public function run() {

		$current_user = require_login();
		$uid = current_user_id();		
		$oid = $this->getParameter("o","",$_GET);
		$col = $this->getParameter("t","",$_GET);

		$f = Dbo::findOne('Follow', array('o' => $oid));

		if(empty($f)){
			$f = new Follow();
			$f->o = $oid;			
		}

		if($f->isFollowedBy($current_user)){
			$msg = "Yo are already a follower! ";
		}else{

			$f->i = ''.$uid;
			$f->u = $current_user;
			$f->t = $col;

			Dbo::save($f);
			
			doIncrement($oid,'nf',$col);
			
			$msg = "Following! " . $oid . " " . $col;			
		}

    	$this->render('showMessage',compact('msg'));
        
    }

}


$app = new FollowBlibbApplication();
$app->run();  

