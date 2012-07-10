<?php

require_once(__DIR__.'/../system/config.php');

class PublishTemplateApplication extends lib {

    public function run() {
		$current_user = require_login();
		$tid = $this->gt("template_id");

		print_r($tid);
		$pest = new Pest(REST_API_URL);
		$r = $pest->post('/template/pub', array(
			'template_id' => $tid,
			'view' => 'default',
			'login_key' => getKey()
		));

		print_r($r);

	    $destURL = "/user/" . $current_user;
	    header("Location: $destURL");
    }

}

$app = new PublishTemplateApplication();
$app->run();  