<?php

require('../sys/config.php'); 




	$name = 'alpheta';
	$email = "alpheta@blibb.net";
	$pwd = "bl1bbnet";
	$salt = sha1($email . strtotime("now"));
	$cpw = sha1($pwd . $salt);

	$name2 = 'ipedrazas';
	$email2 = "ipedrazas@gmail.com";
	$pwd2 = "ivan";
	$salt2 = sha1($email2 . strtotime("now"));
	$cpw2 = sha1($pwd2 . $salt2);
	


Db::insert('users', array(
	     'n' => $name , 'p' => $cpw, 'c' => new DateTime('now'), 'e' => $email, 's' => $salt
   	)
   ); 	

/*


	$name2 = 'mquintans';
	$email2 = "mquintans@gmail.com";
	$pwd2 = "manu";
	$salt2 = sha1($email2 . strtotime("now"));
	$cpw2 = sha1($pwd2 . $salt2);

*/

Db::insert('users', array(
	     'n' => $name2 , 'p' => $cpw2, 'c' => new DateTime('now'), 'e' => $email2, 's' => $salt2
   	)
   ); 	


   echo 'User inserted';
?>

