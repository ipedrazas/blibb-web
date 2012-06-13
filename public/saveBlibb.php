<?php

include_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {

    	

		$bname = $this->gt("bname");
		$bdesc = $this->gt("bdesc");
		$bgroup = $this->gt("bgroup");
		$template = $this->gt("btemplate");
		$user = require_login();
		$key = $this->gt("bkey");
		$bimage = $this->gt("bimage");
		$bslug = $this->gt("bslug");

    	$pest = new Pest(REST_API_URL);
    	$result = $pest->post('/blibb',array(
			'bname' => $bname,
			'bdesc' => $bdesc,
			'bgroup' => $bgroup,
			'btemplate' => $template,
			'bimage' => $bimage,
			'bkey' => $key,
			'slug' => $bslug
		));

		$jsonResult = json_decode($result);
		$result = $jsonResult->id;

		header("Location: addItem?b=$result");
 		// header("Location: editBlibbCss?b=$result");
    	
    }

    private function sendInvites($emails, $user, $blibb, $blibb_name){
    	$m = new BMail();
    	if(strlen($emails)>0){
    		$e = explode(" ", $emails);
    		foreach ($e as $email) {
    			if($m->email_valid($email)){
	    			$text = $user . ' has invited you to join his new blibb. If you want to join it, please, copy an paste this url into your browser: http://blibb.net/actions/addToGroupBlibb?b='.$blibb;
	    			$html = $user . ' has invited you to join his new blibb. If you want to join it, please, click the link <a href="http://blibb.net/atgb?b='.$blibb.'">'.$blibb_name.'</a><br/> Thanks!<br />Your :blibb Team!';
	    			$m->sendMail($email,$email,'Invite to join a Blibb',$html,$text);
    			}
    		}
    	}
    }
}

require_login();
$app = new Application();
$app->run();  

