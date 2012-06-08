<?php

require_once(__DIR__.'/../../system/config.php');


class UpdateImage extends lib {

    public function run() {

		$image_id = $this->gt("id");
		$object_id = $this->gt("oid");
		$type = $this->gt("type");

		switch ($type) {
			case 'blibb':
				$url_image = '/blibb/action/image';
				break;
			case 'blitem':
				$url_image = '/blitem/action/image';
				break;
			case 'user':
				$url_image = '/user/image';
				$k = getKey();
				$object_id = getUserId($k);
			default:
				
				break;
		}

		$k = getKey();
		$pest = new Pest(REST_API_URL);
    	$result = $pest->post($url_image,array(
			'object_id' => $object_id,
			'image_id' => $image_id
			));

		echo $image_id;
    }
}

$app = new UpdateImage();
$app->run();  
