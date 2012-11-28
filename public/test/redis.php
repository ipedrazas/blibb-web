
<?php

// http://pear.nrk.io/

// Registering the channel:
// 	pear channel-discover pear.nrk.io
// Listing available packages:
// 	pear remote-list -c nrk
// Installing a package:
// 	pear install nrk/package_name

require 'Predis/Autoloader.php';
Predis\Autoloader::register();

	$redis = new Predis\Client();

	echo $redis->get('48a601910ca02a0b3ab88839c94d28180b7a52ea').'<hr>';


	$v1 = array(
			'name' => 'Ivan',
			'age' => 38
		);

	$v2 = array(
			'name' => 'Nico',
			'age' => 2
		);

	$u = array(
		'u:001' => 'a',
		'u:002' => 'b',
		);


	$redis->mset($v1);

	$ret = $redis->mget(array_keys($v1));

	print_r($ret);
	echo '<br>';

	$repeat = 'algo';
	$redis->set('k',$repeat);

	$repeat = 'something';
	$redis->set('k',$repeat);

	echo $redis->get('k');
	echo '<br>';

	$key = '1234567';
	$redis->set($key,'ipedrazas');
	$redis->set($key.':name','Ivan Pedrazas');
	$redis->set($key.':email','ipedrazas@gmail.com');

	$rr = $redis->mget($key);
	print_r($rr);

	echo '<br>';

	$u2 = array(
		$key => '0',
		$key . ':name' => 'a',
		$key . ':email' => 'b',
		);

	$rr1 = $redis->mget(array_keys($u2));

	print_r($rr1);
	

?>