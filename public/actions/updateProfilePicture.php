<?php

require_once(__DIR__.'/../../system/config.php');


class UpdateImage extends lib {

    public function run() {

		$image_id = $this->gt("id");
		$k = getKey();
		$pest = new Pest(REST_API_URL);
    	$result = $pest->post('/user/image',array(
			'user_id' => getUserId($k),
			'image_id' => $image_id
			));

		echo $result;
    }



}


$app = new UpdateImage();
$app->run();  
