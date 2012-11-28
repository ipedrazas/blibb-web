<?php

require_once(__DIR__.'/../system/config.php');


class SaveItemApp extends lib {

    public function run() {

        $user = require_login();

        $bid = $this->gt("b");
        $tags = $this->gt("tags");


        $keys = array_keys($_POST);
        $itemData = array();
        $opts = array();
        $now = new DateTime('now');
        $img = '';

        $pestParams = array();
        $pestParams['blibb_id'] = $bid;
        $pestParams['login_key'] = getKey();
        $pestParams['app_token'] = '';

        $pestParams['tags'] = $tags;

            foreach($keys as $k){
                $val = $_POST[$k];
                if(!empty($val)){
                    $pestParams[$k] = $val;
                }
            }

            // print_r($pestParams);

            $pest = new Pest(REST_API_URL);
            try {
                $result = $pest->post('/blitem',$pestParams);
                header("Location: blibb?b=$bid");
            } catch (Pest_Unauthorized $e) {
                // 401
                $errorMsg = '<li class="errorLogin">You are not authorised to write in the Blibb!</li>';
                $_SESSION['ERROR'] = $errorMsg;
                header("Location: addItem?b=$bid");
            }


    }


}

$app = new SaveItemApp();
$app->run();

