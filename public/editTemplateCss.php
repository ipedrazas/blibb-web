<?php

require_once(__DIR__.'/../system/config.php');


class EditTemplateCss extends lib {

    public function run() {

    	$tid = $this->gt('tid');
    	$pest = new Pest(REST_API_URL);
    	$jb = $pest->get('/blibb/' . $bid . '/view/Default');
 		$bli = json_decode($jb);
 		$d = $bli->Default;
 		$t = $d[0];
 		$css = $t->sb;
    	
        $this->render('editCss',compact(css));
    }

}

$app = new EditTemplateCss();

$app->run();  