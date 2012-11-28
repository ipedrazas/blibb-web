<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {

    	// print_r(getUser());

		$userspace = $this->gt("id");

		if(!empty($userspace)){
			$pos = strpos($userspace,'/user');
			if($pos===0){
				$userspace = substr($userspace, 6);
			}
		}else{
			$userspace = current_user();
		}

		$pest = new Pest(REST_API_URL);
        try {
        	$jresp = $pest->get('/blibb/' . $userspace);

        	$this->setRedirect();
    		$current_user = getUserName();
    		$owner = false;

    		// print_r($current_user . ' ' . $userspace);
    		if($userspace === $current_user){
    			$owner = true;
                $user = getUser();
    		}else{
                $juser = $pest->get('/user/' . $userspace);
                $user = json_decode($juser);
                $user = $user->user;
            }
            // print_r($user->username);
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
        			// print_r($blibb);
        			$blibb->REST_API_URL = REST_API_URL;
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
        	// print_r($blibbs);
        } catch (Pest_NotFound $e) {
            // 404

            $this->render('404');

        }

    	$admin = isAdmin();
    	$this->render('html5_Blibb', compact('user','owner','blibbs','blbb', 'k', 'admin'));
	}

}



$app = new Application();
$app->run();

