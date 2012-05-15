<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		$bid = $this->gt("b");
		$params = "t.i.w";

		$pest = new Pest(REST_API_URL);
    	$result = $pest->get('/blibb/' .$bid . '/p/' . $params);

		$blibb = json_decode($result);

		// print_r($blibb);
		
		$t = $blibb->t;
		$i = $t->i;
		
		$k = getKey();
		$v['id'] = $bid;
		$v['key'] = $k;

		$m = new Mustache();

		$buffer = '';
		foreach($i as $f){
			$w = $f->w;
			
			// Hack because Mustache replaces {{elems}} that are
			// not in the previous template
			$w = str_replace("[[", "{{", $w);
			$w = str_replace("]]", "}}", $w);
			$res = $m->render($w,$v);
			$buffer .= $res. "<br>";

		}
		// print_r($buffer);

		$dest = $this->getParameter("f","",$_GET);

    	$this->render('addItem',compact('current_user','buffer','thumb', 'bid','dest','k'));
        
    }

}

$app = new Application();
$app->run();  

