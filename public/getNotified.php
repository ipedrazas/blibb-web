<?php

require_once(__DIR__.'/../system/config.php');

class Application extends lib {

    public function run() {
    	$mail = new BMail();
    	$common = new Common();
		$email = $this->gt("email");

   	// Add email to DB
   		$ip = $common->getIpAddress();
		$browser = $_SERVER['HTTP_USER_AGENT'];



	 	$subject = 'Blibb Notification List';
		$file = __DIR__."/../data/mail.html";
		$contents = file($file);
		$html = implode($contents);

		$file2 = __DIR__."/../data/mail.txt";
		$contents2 = file($file2);
		$text = implode($contents2);

		$from = 'info@blibb.net';
		$fromName = 'Blibb';
		$mail->sendMail($email, $email, $subject, $html, $text);

		$msg = "<h2>Thanks!</h2>Stay tunned, we're planning to start sending invitations pretty soon!";
		$pest = new Pest(REST_API_URL);
		$result = $pest->post('/sys/add/tobeta',array(
			'email' => $email,
			'ip' => $ip,
			'browser' => $browser
		));

	    $this->render('showMessage',  compact('msg'));
    }

}

$app = new Application();
$app->run();
