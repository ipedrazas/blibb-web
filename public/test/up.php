<?php

require_once(__DIR__.'/../../system/config.php');


$k = getKey();
$uname = getUserName($k);
// $email = getUserEmail($k);
$image = getUserImage($k);

echo $k . "<br>";
echo $uname . "<br>";
// echo $email . "<br>";
echo $image  . "<br>";
	
?>