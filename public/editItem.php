<?php

require_once(__DIR__.'/../system/config.php');


class EditItem extends lib {

    public function run() {
		
		$current_user = require_login();
		$bid = $this->gt("b");
		$blitem_id = $this->gt("i");

		$params = "t.v.default";

		$pest = new Pest(REST_API_URL);
    	$result = $pest->get('/blibb/' .$bid . '/p/' . $params);

		$blibb = json_decode($result);

		$jblitem = $pest->get('/blitem/' . $blitem_id);
		$blitem = json_decode($jblitem);

		// print_r($blibb);
		// print_r($blitem);

		$t = $blibb->template;
		$i = $t->v->default;

		// $k = getKey();
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


		// $dest = $this->getParameter("f","",$_GET);

    	$this->render('editItem',compact('current_user','buffer','thumb', 'bid','dest','blitem'));
        
    }

}

$app = new EditItem();
$app->run();  

