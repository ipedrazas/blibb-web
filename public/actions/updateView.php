<?php

require_once(__DIR__.'/../../system/config.php');


class updateView extends lib {

    public function run() {

        $current_user = require_login();
        $bid = $this->gt("blibb_id");
        $viewName = $this->gt("viewName");
        $viewHtml = $this->gt("viewHtml");


        $pestParams = array();
        $pestParams['blibb_id'] = $bid;
        $pestParams['login_key'] = getKey();
        $pestParams['viewName'] = $viewName;
        $pestParams['viewHtml'] = $viewHtml;


        $pest = new Pest(REST_API_URL);
        $jresult = $pest->put('/blibb/view',$pestParams);

        echo $jresult;

        // print_r($pestParams);

    }

}

$app = new updateView();
$app->run();

