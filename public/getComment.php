<?php

require_once(__DIR__.'/../system/config.php');


class GetCommentApplication extends lib {

    public function run() {

        $result = '';
		$item = $this->getParameter("i","",$_POST);
		$comments = Dbo::find('Comment', array('i' => $item), array('sort' => array('c' => -1)));
        foreach($comments as $c){
            $result  .=  $c->renderBox();
        }
        $this->render('ajaxResponse',  compact('result'));
    }

}

$app = new GetCommentApplication();

$app->run();