<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
		
		$current_user = require_login();
		$k = getKey();
    	

    	$pest = new Pest(REST_API_URL);
    	$jts = $pest->get('/template/active/n,d,t');
 		$rs = json_decode($jts);
 		
 		$count = $rs->count;
		$m = new Mustache();
 		$templates = array();
 		$template_html = '<dl id="{{id}}"><dt><img src="/img/templates/{{thumbnail}}" hspace="10" width="50" height="60"></dt><dd>{{name}}</dd></dl>';
 		$t = '';
 		if($count>0){
 			$resultset = $rs->resultset;
 			foreach ($resultset as $jt) {
 				$template = json_decode($jt);
 				$a = '$oid';
 				$at['id'] = $template->_id->$a;
 				$at['name'] = $template->n;
 				$at['thumbnail'] = $template->t;
 				$t .= $m->render($template_html, $at);
 				
 			}
 		}

 		$this->render('newBlibb',compact('current_user','t'));
        
    }
}

$app = new Application();
$app->run();  

