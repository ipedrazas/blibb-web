<?php

require_once(__DIR__.'/../system/config.php');

class PublishTemplateApplication extends lib {

    public function run() {
		$current_user = require_login();
		$tid = $this->gt("tid");
		
	
		
		$pest = new Pest(REST_API_URL);
		$r = $pest->post('/template/pub', array(
			'tid' => $tid,
			'view' => 'default',
			'k' => getKey()
		));
		$view = 'showMessage';
		
		$msg = 'Template saved succesfully';
	    $this->render($view,  compact('msg'));
    }

}

$app = new PublishTemplateApplication();
$app->run();  