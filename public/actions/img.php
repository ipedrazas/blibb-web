<?php

require_once(__DIR__.'/../../system/config.php');


class ImageStream extends lib {

    public function run() {
		
		$bid = $this->gt("i");

		if(!empty($bid)){

			$mbid = new MongoId($bid);
			$b = Dbo::findOne('Picture', array('_id' => $mbid));

			if($b){
				$file = $b->u['file'];
				$mime = $b->u['mime_type'];

				if(!empty($file)){
		
					header('Content-Type: ' . $mime);
					readfile($file);

				}

			}
			//echo '<pre>'.htmlentities(print_r($b, true)).'</pre>';
			//header('X-Sendfile: ' . $file);
		}        
    }

}

$app = new ImageStream();
$app->run();  