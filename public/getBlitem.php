<?php
	
	require_once(__DIR__.'/../system/config.php');

	$pest = new Pest('http://localhost:5000');
	$cid = $_POST['c_id'];
	$tid = $_POST['t_id'];

	$m = new Mustache();

	$result = $pest->get('/ctrl/ui/' . $cid);

	$v['t_id'] = $tid;
	$v['c_id'] = $cid;

	$r = $m->render($result,$v);

	echo $r;

?>