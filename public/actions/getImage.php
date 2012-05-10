<?php

require_once(__DIR__.'/../../system/config.php');


class StreamImage extends lib {

    public function run() {

		$i = $this->gt("id");
		$size = $this->gt("i");

		if($i === 'undefined'){
			die ("{'error':'Image not found'}");
		}
		$pest = new Pest('http://localhost:5000');
    	$jresp = $pest->get('/picture/' . $i);
    	$picture = json_decode($jresp);



    	
    	$path  = $picture->path . '/'. $size . '/';
    	$img_id = $picture->id;
    	$format = $picture->format;

		$image = $this->GetFileData($path . $img_id . '.' . $format); 

		ob_start();
		$length = strlen($image);
		header('Last-Modified: '.date('r'));
		header('Accept-Ranges: bytes');
		header('Content-Length: '.$length);
		header('Content-Type: '. $picture->mime_type);
		print($image);
		ob_end_flush();
		
    }

    function GetFileData($sFilePath){
	    $fp = fopen($sFilePath, 'rb') or die('404! Unable to open file!');
	    $buf = '';
	    while(!feof($fp)){
	        $buf .= fgets($fp, 8192);
	    }
	    fclose($fp);
		return $buf; //returns False if failed, else the contents up to FileSize bytes.
	}

}


$app = new StreamImage();
$app->run();  

