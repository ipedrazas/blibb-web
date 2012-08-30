<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {

		$current_user = require_login();
		$bid = $this->gt("b");
		$params = "t.v.default";

		$pest = new Pest(REST_API_URL);
    	$result = $pest->get('/blibb/' .$bid . '/p/' . $params);

		$blibb = json_decode($result);

		// print_r($blibb);

		$t = $blibb->template;
		$i = $t->v->default;

		$buffer = $i->wb;

    	$this->render('addItem',compact('current_user','buffer','thumb', 'bid','dest','k'));
    }
}

$app = new Application();
$app->run();

