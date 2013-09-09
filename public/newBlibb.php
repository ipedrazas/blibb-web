<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {

		$current_user = require_login();

    	$pest = new Pest(REST_API_URL);
    	// $jts = $pest->get('/templates?filter=q:active&fields=n,d,t');
        $jts = $pest->get('/templates?filter=q:active,u:'.$current_user.'&fields=n,d,t');
 		$rs = json_decode($jts);
		$m = new Mustache();
 		$templates = array();
 		$template_html = '<dl id="{{id}}"><dt><img src="/img/templates/draft.png" hspace="10" width="50" height="60"></dt><dd>{{name}}</dd></dl>';
 		$t = '';
		foreach ($rs as $template) {
			$at['id'] = $template->id;
			$at['name'] = $template->name;
			$t .= $m->render($template_html, $at);

		}
 		$this->render('newBlibb',compact('current_user','t'));

    }
}

$app = new Application();
$app->run();

