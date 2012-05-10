<?php

require_once(__DIR__.'/../../system/config.php');

class GetAlbum extends lib {

    public function run() {
		
		$b = $this->gt("b");
		$call = $this->gt("callback");
		$pest = new Pest('http://localhost:5000');
		$result = $pest->get('/items/'.$b);

		header('Content-type: application/javascript');
		echo '/**/'.$call.'('.$result .')';	
     
    }

}


$app = new GetAlbum();
$app->run();  

