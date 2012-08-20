<?php

require_once(__DIR__.'/../system/config.php');


class UpdateItemApp extends lib {

    public function run() {

        $user = require_login();

        $bid = $this->gt("blibb_id");
        $tags = $this->gt("tags");
        $item_id = $this->gt("blitem_id");

        $keys = array_keys($_POST);
        $itemData = array();
        $opts = array();
        $now = new DateTime('now');
        $img = '';

        $pestParams = array();
        $pestParams['blibb_id'] = $bid;
        $pestParams['login_key'] = getKey();
        $pestParams['app_token'] = '';
        $pestParams['item_id'] = $item_id;

        $pestParams['tags'] = $tags;

            foreach($keys as $k){
                if(strpos($k,'-')===2){
                    $val = $_POST[$k];
                    if(!empty($val)){
                        $pestParams[$k] = $val;
                    }
                }else{
                    echo strpos($k,'-') . '<br>';
                }

            }

            // print_r($pestParams);

            $pest = new Pest(REST_API_URL);
            try {
                $result = $pest->put('/blitem',$pestParams);
                if(!isset($_SESSION['redirect_to'])){
                        $destURL = 'main';
                }else{
                    $destURL = $_SESSION['redirect_to'];
                    unset($_SESSION['redirect_to']);
                }
                header("Location: $destURL");
                exit();
            } catch (Pest_Unauthorized $e) {
                // 401
                $errorMsg = '<li class="errorLogin">You are not authorised to write in the Blibb!</li>';
                $_SESSION['ERROR'] = $errorMsg;
                header("Location: updateItem?b=$bid");
            }


    }


}

$app = new UpdateItemApp();
$app->run();

