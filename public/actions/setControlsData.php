<?php

require_once(__DIR__.'/../../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		$controls = $this->gt("control");
		$template = $this->gt("template");
		$key = getKey();

		$jcontrols = json_encode($controls);
		print_r($controls);
		$pest = new Pest(REST_API_URL);
		$tid = $pest->post('/template/controls', array(
				'template' => $template,
				'controls' => $jcontrols,
				'login_key' => $key
			));
		print_r($tid);
		
        
    }

}

$app = new Application();
$app->run();  

