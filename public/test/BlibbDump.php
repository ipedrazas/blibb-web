<?php


require_once(__DIR__.'/../../system/config.php');


	$bid = '4f3720d8700ed65608000000';
	$mbid = new MongoId($bid);
	$b = Dbo::findOne('Blb', array('_id' => $mbid));


	$blibb = $b->toArray();

	
	$itemBox = stripslashes($blibb['template']);
	$css =  stripslashes($blibb['css']);

	$bItems = Dbo::find('Item', array('b' => $bid), array('sort' => array('c' => -1))); 
	$entries = array();
		
	foreach ($bItems as $item) {
		$entries[] =  $item->toArray();
	}

	$blibb['ENTRIES'] = $entries;
	$m = new Mustache();
		
	$content =  $m->render($itemBox, $blibb);

	// echo $content;
	print_r($blibb);

?>