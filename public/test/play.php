<?php

	$pwd = 'ivan';
	$salt = '3da0a18fcdf0fbe70fe8f24ccf593cd7f33ad262';
	echo sha1($pwd . $salt);

?>