<?php

require_once(__DIR__.'/../../system/config.php');


class ForkBlibb extends lib {

    public function run() {

        $user = require_login();
        $pestParams = array();
        $pestParams['b'] = $this->gt("id");
        $pestParams['login_key'] = getKey();
        $pest = new Pest(REST_API_URL);
        $ret = $pest->post('/blibb/fork', $pestParams);

        $dest = '/user/'. $user;
        header("Location: " . $dest);

    }

}

$app = new ForkBlibb();

$app->run();
