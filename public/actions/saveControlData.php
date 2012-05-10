<?php 

	require_once(__DIR__.'/../../system/config.php');

	$controls = $_POST['value'];
	$oid = $_POST['tid'];
	$order = $_POST['order'];
	$cid = $_POST['cid'];

	$title = '';
	$help = '';

	$res = explode(',',$controls);
	$c = 1;
	foreach($res as $r){		
		$t  = explode(':',$r);
		if(trim($t[0])=='c_title'){
			$title = $t[1];
		}
		if(trim($t[0])=='c_help'){
			$help = $t[1];
		}
		$c++;
	}

	$pest = new Pest('http://localhost:5000');
	$result = $pest->get('/ctrl/view/' . $cid);

	$ctrlView = json_decode($result);


	$m = new Mustache();

	$v['ctrl_name'] = $title;
	$v['ctrl_help'] = $help;
	$v['ctrl_slug'] = slugify($title);
	$v['ctrl_id'] = $cid;
	$v['ctrl_order'] = $order;
	$v['ctrl_typex'] = $ctrlView->tx;

	$res = $m->render($ctrlView->v,$v);

	echo $res;


	$params = array(
			'cid' => $cid,
			'tid' => $oid,
			'order' => $order,
			'title' => $title,
			'help' => $help,
			'view' =>  $res,
			'slug' => slugify($title),
			'typex' => $ctrlView->tx,
			'k' => getKey()
		);

	// print_r($params);

	$ctrlAdded = $pest->post('/template/add', $params);




?>