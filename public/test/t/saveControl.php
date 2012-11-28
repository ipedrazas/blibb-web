<?php 

	$controls = $_POST['value'];
	$oid = $_POST['tid'];
	$order = $_POST['order'];
	$cid = $_POST['cid'];

	// require_once(__DIR__.'/../../../system/config.php');

	// $pest = new Pest('http://localhost:5000');

	// $result = $pest->post('/ctrl/view',array(
	// 		'i' => $cid
	// 	));

	// $m = new Mustache();

	// $v['ctrl_name'] = $label;
	// $v['ctrl_slug'] = 'lbl';

	// $res = $m->render($result,$v);

	$title = '';
	$help = '';

	$res = explode(',',$controls);
	$c = 1;
	foreach($res as $r){		
		$t  = explode(':',$r);
		if(trim($t[0])=='c_title'){
			$title = $t[1].$c;
		}
		if(trim($t[0])=='c_help'){
			$elp = $t[1].$c;
		}
		$c++;
	}

	// print_r($res);

	$slug = getSlug($title);
	echo $title . ' - ' . $help . ' - ' . $slug;

	function getSlug($title){
		return str_replace(' ', '', $title);
	}

?>