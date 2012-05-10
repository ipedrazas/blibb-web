<?php

require_once(__DIR__.'/../../system/config.php');


class ClippApplication extends lib {

    public function run() {
		
		$bid = $this->getParameter("b","",$_GET);
		$iid = $this->getParameter("i","",$_GET);

		$current_user = require_login();
		
		$miid = new MongoId($iid);
		$i = Dbo::findOne('Item', array('_id' => $miid));

		$iBid = $i->b;
		$mibid = new MongoId($iBid);
		$iB = Dbo::findOne('Blb', array('_id' => $mibid));

		$view = $iB->getView('Default');

		$css = "<style>" . $iB->getItemStyle($view) . '</style>';
		$itemTemplate = $iB->getItemTemplate($view);
		$m = new Mustache();
		$itemBox = $m->render($itemTemplate, $i->toArray()); 
		$itemBox = str_replace("entry", "clippedEntry", $itemBox);

		$newItem = new Item();
		$newItem->b = $bid;
		$newItem->u = $current_user;
		$newItem->i = $i->i;
		$newItem->x = $itemBox;
		$newItem->c = new DateTime('now');

		Dbo::save($newItem);

		$msg = "Item " . $iid . " clipped to " . $bid . " as " . $newItem->_id;

    	$this->render('showMessage',compact('msg'));
        
    }

}


$app = new ClippApplication();
$app->run();  

