<?php

require_once(__DIR__.'/../../system/config.php');


class StreamImage extends lib {

    public function run() {

		$i = $this->gt("id");
		$size = $this->gt("i");

		if($i === 'undefined'){
			die ("{'error':'Image not found'}");
		}
		$pest = new Pest(REST_API_URL);
    	$jresp = $pest->get('/picture/' . $i);
    	$picture = json_decode($jresp);
    	

		// $image = $this->GetFileData(REST_API_URL . '/picture/'.$i.'/'.$size);//($path . $img_id . '.' . $format); 

		ob_start();
		// $length = strlen($image);
		header('Last-Modified: '.date('r'));
		header('Accept-Ranges: bytes');
		header('Content-Length: '.$picture->size);
		header('Content-Type: ' . $picture->mime_type);
		print(file_get_contents(REST_API_URL . '/picture/'.$i.'/'.$size));
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

