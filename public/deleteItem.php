<?php

require_once(__DIR__.'/../system/config.php');


class DeleteItem extends lib {

    public function run() {

        $current_user = require_login();
        $iid = $this->gt("id");
        $url = $this->gt("curl");
        $this->setRedirect($url);

        $pest = new Pest(REST_API_URL);
        $result = $pest->delete('/blitem/' .$iid . '/' . getKey());

        if(!isset($_SESSION['redirect_to'])){
                $destURL = 'main';
        }else{
            $destURL = $_SESSION['redirect_to'];
            unset($_SESSION['redirect_to']);
        }
        header("Location: $destURL");
        exit();
    }
}

$app = new DeleteItem();
$app->run();

