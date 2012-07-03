<?php

require_once(__DIR__.'/../system/config.php');

class NewUserApplication extends lib {

    public function run() {

		$name = $this->gt("username");
		$pwd = $this->gt("pwd");
		$email = $this->gt("email");
		$code = $this->gt("invite");

		// 
		$pestParams = array();
		$pestParams['user'] = $name;
		$pestParams['pwd'] = $pwd;
		$pestParams['email'] = $email;
		$pestParams['code'] = $code;

		$pest = new Pest(REST_API_URL);

		$jval = $pest->get('/sys/validate/' . $code);
		$val = json_decode($jval);

		if($val->result){
			$jresult = $pest->post('/user',$pestParams);
			$result = json_decode($jresult);
			
			// send email
			$mail = new BMail();
			$subject = 'Welcome to :blibb';
			$file = __DIR__."/../data/welcome.html";
			$contents = file($file); 
			$html = implode($contents);
			$text = $html;
			$from = 'info@blibb.net';
			$fromName = 'Blibb';
			$mail->sendMail($email, $email, $subject, $html, $text);

			header("Location: login");
		}else{
			$msg =  'Code is not valid';
			$this->render('registry',  compact('msg'));
		}
		
		
		// print_r($res);
		// header("Location: login");
    }

}

$app = new NewUserApplication();
$app->run();  