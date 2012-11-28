<?php
	
	require_once(__DIR__.'/../../../system/config.php');

	$pest = new Pest('http://localhost:5000');

	$tid = $_GET['tid'];

	$m = new Mustache();

	$result = $pest->get('/template/' . $tid);

	print_r($result);

?>