<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		$bid = $this->gt("b");
		$params = "t.v.default.wb";

		$pest = new Pest(REST_API_URL);
    	$result = $pest->get('/blibb/' .$bid . '/p/' . $params);

		$blibb = json_decode($result);

		
		$t = $blibb->template;
		$i = $t->v->default;

		$k = getKey();
		// $v['id'] = $bid;
		// $v['key'] = $k;

		// $m = new Mustache();

		$buffer = '';
		foreach($i as $f){
			$w = $f->wb;
			// print_r($w);
			
		// 	// Hack because Mustache replaces {{elems}} that are
		// 	// not in the previous template
		// 	$w = str_replace("[[", "{{", $w);
		// 	$w = str_replace("]]", "}}", $w);
		// 	$res = $m->render($w,$v);
			$buffer .= $w;

		}


		$dest = $this->getParameter("f","",$_GET);

    	$this->render('addItem',compact('current_user','buffer','thumb', 'bid','dest','k'));
        
    }

}

$app = new Application();
$app->run();  

