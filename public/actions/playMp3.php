<?php

require_once(__DIR__.'/../../system/config.php');


class StreamMP3 extends lib {

    public function run() {

		$i = $this->gt("i");
		if(strlen($i)==24){
			$pest = new Pest('http://localhost:5000');
			$result = $pest->get('/song/'.$i);
			header('Content-type: application/json');
			
			$mp3 = json_decode($result);
			print_r($mp3);
			if(isset($mp3->i)){

				$song = $mp3->i;
			
				$path = $song->path;
				
				if(isset($son->mime_type)){
					$mime = $song->mime_type;
				}else{
					$mime = 'audio/mpeg';
				}
				
				if(is_file($path)){
					set_time_limit(0);

					$strContext=stream_context_create(
					    array(
					      'http'=>array(
					        'method'=>'GET',
					        'header'=>"Accept-language: en\r\n"
					      )
					    )
					  );
					
					$fpOrigin=fopen($song->path, 'rb', false, $strContext); //open a binary compatible stream
					header('content-type: '. $mime);   
					while(!feof($fpOrigin)){
					  $buffer=fread($fpOrigin, 8192); //we read chunks of 4096 bytes
					  echo $buffer; //And we send them back to the current user
					  flush();  //we try to flush the output buffer, in case there is a deflated or gzipped transfert betweenm the web server and the client
					}
					fclose($fpOrigin); 
				}  

			}

		}
		
		    
    }

}


$app = new StreamMP3();
$app->run();  

