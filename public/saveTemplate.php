<?php

require_once(__DIR__.'/../system/config.php');

class SaveTemplateApplication extends lib {

    public function run() {
    	
		$current_user = require_login();
		$name = $this->gt("template_name");
		$desc = $this->gt("template_desc");
		$key = getKey();
		
			// $view = 'getControls';
			$view = 'formBuilder';
			$pest = new Pest(REST_API_URL);
			$jtemplate = $pest->post('/template', array(
				'template_name' => $name,
				'template_description' => $desc,
				'thumbnail' => 'draft.png',
				'login_key' => $key
			));
			
			$template = json_decode($jtemplate);
			$tid = $template->result;
			// print_r($template);
			$jcontrols = $pest->get('/controls', array());
			$temp = json_decode($jcontrols,true);
			$controls = $temp['controls'];
			// print_r($controls);
		    $this->render($view,  compact('msg', 'controls','tid', 'name', 'desc'));
		
    }
}

$app = new SaveTemplateApplication();
$app->run();  