<?php

require_once(__DIR__.'/../system/config.php');


class ListImages extends lib {

    public function run() {


    	$this->setRedirect();
		
		if(isset($_GET['u'])){
			$username = $this->gt("u");
		}else{
			$username = current_user();
		}

		$pest = new Pest(REST_API_URL);
    	$jpict_ids = $pest->get('/user/pictures/' . $username );
 		$pict_ids = json_decode($jpict_ids);

        $this->render('images', compact(pict_ids));
    }

}

$app = new ListImages();

$app->run();  