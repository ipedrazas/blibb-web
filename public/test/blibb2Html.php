<?php

require_once(__DIR__.'/../../system/config.php');


// This is a mustache test.
// Get a Blibb Template and add the data.
// Get its items and mustache them.

	$bid  = '4f2ea393700ed62904000000';
	
	$mbid = new MongoId($bid);
	$b = Dbo::findOne('Blb', array('_id' => $mbid)); 

	$blibb = $b->toArray();
	$m = new Mustache();

	$template = $b->getTemplate();
	$itemBox = stripslashes($template['wb']);
	$css = stripslashes($template['wc']);
	

	$bItems = Dbo::find('Item', array('b' => $bid), array('sort' => array('c' => -1))); 
	$entries = array();
	
	foreach ($bItems as $item) {
		$entries[] =  $item->toArray();
	}
	
	echo "<style>" . $css . "</style>";
	$blibb['ENTRIES'] = $entries;
	echo $m->render($itemBox, $blibb);
	
?>