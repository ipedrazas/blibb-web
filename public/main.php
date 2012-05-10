<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
    	

		$userspace = $this->gt("id");
		
		if(!empty($userspace)){			
			// because the way the Apache2/nginx rewrite
			// works
			$pos = strpos($userspace,'/user');
			if($pos===0){
				$userspace = substr($userspace, 6);
			}
		}else{
			$userspace = current_user();
		}
		


		$pest = new Pest('http://localhost:5000');
    	$jresp = $pest->get('/blibb/' . $userspace);
    	
    	$this->setRedirect();
		$current_user = current_user();
		$owner = false;
		if($userspace === $current_user){
			$owner = true;
		}

    	$result = json_decode($jresp);
    	$rs = $result->results;

    	// print_r($result);
    	$count = $result->count;
		$blibbs = array();
		$gblibbs = array();
		$m = new Mustache();


		$file = __DIR__."/templates/blibb-bigbox.html";
		$contents = file($file); 
		$bbox = implode($contents);

		$file2 = __DIR__."/templates/blibb-smallbox.html";
		$contents2 = file($file2); 
		$bbox_1 = implode($contents2);

		$i = 0;
    	if($count>0){
    		foreach ($rs as $blibb) {
    			if($i==0){
    				$blbb =  $m->render($bbox, $blibb);
    			}else{
    				$blibbs[] =  $m->render($bbox_1, $blibb);
    			}
    			$i++;
    		}
    	}else{
    		$blibbs[] = "There are no blibbs in this space...";
    	}
    	$k = getKey();
    	$this->render('html5_Blibb', compact('userspace','owner','blibbs','blbb', 'k'));		
	}

}



$app = new Application();
$app->run();  

