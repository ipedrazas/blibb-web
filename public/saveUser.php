<?php

require_once(__DIR__.'/../system/config.php');

class NewUserApplication extends lib {

    public function run() {
		$current_user = require_login();    	

		$name = $this->getParameter("name","",$_POST);
		$pwd = $this->getParameter("password","",$_POST);
		$email = $this->getParameter("email","",$_POST);
		
		$user = new User();
		$user->n = $name;
		$user->e = $email;
		$salt = sha1($email . strtotime("now"));
		$cpw = sha1($pwd . $salt);
		$user->p = $cpw;
		$user->s = $salt;
		$user->a = false;
		$user->rp = substr(sha1($email . strtotime("now").$email),0,-2);
		$user->c =  new DateTime('now');
		Dbo::save($user);

		$msg = "User $name created"; 
	    $this->render('showMessage',  compact('msg'));
    }

}

$app = new NewUserApplication();
$app->run();  