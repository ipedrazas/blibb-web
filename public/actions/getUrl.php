<?php

	require_once(__DIR__.'/../../system/config.php');

	$username = 'blb';
	$password = 'blb';
	$keyword = '';				// optional keyword
	$format = 'simple';				// output format: 'json', 'xml' or 'simple'
	$url = $_GET['url'];

	$pest = new Pest('http://ccs.im');

	$result = $pest->post('/yourls-api.php',array(
		'url'      => $url,
		'keyword'  => $keyword,
		'format'   => $format,
		'action'   => 'shorturl',
		'username' => $username,
		'password' => $password
		));

	
	echo $result;

?>