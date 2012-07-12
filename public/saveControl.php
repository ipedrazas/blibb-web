

	<?php

require_once(__DIR__.'/../system/config.php');

class SaveControl extends lib {

    public function run() {


		$current_user = require_login();
		$name = $this->gt("control_name");
		$type = $this->gt("control_type");
		$ui = $this->gt("control_ui");
		$button = $this->gt("control_button");
		$read = $this->gt("control_read");
		$write = $this->gt("control_write");
		$k = $this->gt("k");
		$key = getKey();
		if($k===$key){
			$pest = new Pest(REST_API_URL);
			$jcontrols = $pest->post('/controls', array(
					'login_key' => $key, 
					'control_name' => $name,
					'control_ui' => $ui,
					'control_type' => $type,
					'control_read' => $read,
					'control_button' => $button,
					'control_write' => $write
			));

		    header("Location: listControls");
		}else{
			header("Location: login");
		}
		
    }

}

$app = new SaveControl();
$app->run();  