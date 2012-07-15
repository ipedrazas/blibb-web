<?php

require_once(__DIR__.'/../system/config.php');


class SaveItemApp extends lib {

    public function run() {

    	$user = require_login();

		$bid = $this->gt("b");
		$bkey = $this->gt("k");
		$tags = $this->gt("tags");

		
		$keys = array_keys($_POST);
		$itemData = array();
		$opts = array();
		$now = new DateTime('now');
		$img = '';
		
		$pestParams = array();
		$pestParams['blibb_id'] = $bid;
		$pestParams['login_key'] = $bkey;
		$pestParams['app_token'] = '';

		$pestParams['tags'] = $tags;

		if($bkey === getKey()){
			foreach($keys as $k){		
				if(strpos($k,'-')===2){ 
					$val = $_POST[$k];			
					if(!empty($val)){
						$pestParams[$k] = $val;	
					}			
				}else{
					echo strpos($k,'-') . '<br>';
				}
				
			}

			// print_r($pestParams);

			$pest = new Pest(REST_API_URL);
			try {
				$result = $pest->post('/blitem',$pestParams);
				header("Location: blibb?b=$bid");	
			} catch (Pest_Unauthorized $e) {
			    // 401
			    $errorMsg = '<li class="errorLogin">You are not authorised to write in the Blibb!</li>';
			    $_SESSION['ERROR'] = $errorMsg;
			    header("Location: addItem?b=$bid");
			} 
		}else{
			$errorMsg = '<li class="errorLogin">You are not authorised to write in the Blibb!</li>';
			$_SESSION['ERROR'] = $errorMsg;
			header("Location: addItem?b=$bid");
		}
		
			
    }

    
}

require_login();
$app = new SaveItemApp();
$app->run();  

