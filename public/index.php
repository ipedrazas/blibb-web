<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
        $this->render('landpage');
    }

}

$app = new Application();

$app->run();  