<?php



function doIncrement($oId, $att, $col){
	
	try {
		$m = new Mongo(); // connect
	    $db = $m->selectDB("blibb");
		$collecttion = new MongoCollection($db, $col);
	    $collecttion->update(array('_id' => new MongoId($oId)), array('$inc' => array($att => 1)), array("upsert" => true));
	    return true;
	}catch ( MongoConnectionException $e ) {
	    return false;
	}	
}

?>