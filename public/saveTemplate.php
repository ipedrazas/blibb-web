<?php

require_once(__DIR__.'/../system/config.php');

class SaveTemplateApplication extends lib {

    public function run() {
		$current_user = require_login();
		$name = $this->gt("template_name");
		$desc = $this->gt("template_desc");
		$k = $this->gt("k");
		$key = getKey();
		if($k===$key){
			$view = 'getControls';
			$pest = new Pest(REST_API_URL);
			$tid = $pest->post('/template', array(
				'bname' => $name,
				'bdesc' => $desc,
				'thumbnail' => 'draft.png',
				'bstatus' => 'draft',
				'bkey' => $key
			));
			
			$controls = $pest->get('/ctrls', array());
			$t = json_decode($controls,true);
			$r = $t['resultset'];
			
		    $this->render($view,  compact('msg', 'r','tid', 'name', 'desc'));
		}
		
    }

}

$app = new SaveTemplateApplication();
$app->run();  