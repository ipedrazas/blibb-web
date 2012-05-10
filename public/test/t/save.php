<?php 

	$label = $_POST['value'];
	$oid = $_POST['tid'];
	$order = $_POST['order'];
	$cid = $_POST['cid'];

	require_once(__DIR__.'/../../../system/config.php');

	$pest = new Pest('http://localhost:5000');

	$result = $pest->post('/ctrl/view',array(
			'i' => $cid
		));

	$m = new Mustache();

	$v['ctrl_name'] = $label;
	$v['ctrl_slug'] = 'lbl';

	$res = $m->render($result,$v);


	echo  $res;

?>