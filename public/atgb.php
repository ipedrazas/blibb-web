<?php

require_once(__DIR__.'/../system/config.php');


class AddToGroupApplication extends lib {

    public function run() {
		
		$bid = $this->gt("b");
		
		$user = current_user();

		$conn = new Mongo();
		$q = $conn->blibb->blbs;
		$id = new MongoId($bid);
		$c = array('_id'=>$id);
		$u = array('$addToSet' => array('gu' => $user));
		$q->update($c,$u);
		// $q->update( array('_id' => $id), array('$addToSet' => ('gu','alpheta')));

		$msg =  $user . " added to " . $bid  . ' ';

		// print_r($conn->lastError());

    	$this->render('showMessage',compact('msg'));
        
    }

}

require_login();
$app = new AddToGroupApplication();
$app->run();  

// { '_id' : ObjectId('4f448ad8700ed68509000006')},  {$addToSet : {'gu' : 'alpheta'}}