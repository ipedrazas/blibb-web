
<?php 

	reset($content);
	while (list($key, $val) = each($content)) {
	    echo "$key : ".trim(strip_tags($val))."\n";
	}
	reset($entries);
	echo "\n";
	foreach ($entries as $entry) {
		while (list($key, $val) = each($entry)) {
	    	echo "$key : ".trim(strip_tags($val))."\n";
		}
		echo "\n";
	}
	
 

?>