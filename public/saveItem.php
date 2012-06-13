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
		$pestParams['b'] = $bid;
		$pestParams['k'] = $bkey;

		$pestParams['tags'] = $tags;
		
		foreach($keys as $k){		
			
			if(strpos($k,'-')===2){ 
				// $name = substr($k,3);		
				$val = $_POST[$k];			
				// Add item only if it has value
				if(!empty($val)){
					$pestParams[$k] = $val;	
				}			
			}else{
				echo strpos($k,'-') . '<br>';
			}
			
		}

		// print_r($pestParams);

		$pest = new Pest(REST_API_URL);
		$result = $pest->post('/blitem',$pestParams);
		
		$dest = $this->gt("f");

		if(!empty($dest)){
			header("Location: blibb?b=$bid&f=" . $dest);
		}else{
			header("Location: blibb?b=$bid");	
		}    	
    }

   
    
}

require_login();
$app = new SaveItemApp();
$app->run();  

