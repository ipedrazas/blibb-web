<?php

require_once(__DIR__.'/../system/config.php');


class EditItem extends lib {

    public function run() {

		$current_user = require_login();
		$iid = $this->gt("id");
		$params = "t.v.default";

		$pest = new Pest(REST_API_URL);

		$jitem = $pest->get('/blitem/' . $iid . '?flat=1');
		$item = json_decode($jitem);

		$items = $item->i;
		$tags = array();
		if(isset($item->tg)){
			$tags = $item->tg;
		}
		$elements = array();
		foreach ($items as $e) {
			$elements[$e->t . '-' . $e->s] = $e->v;
		}

		$bid = $item->b;
    	$result = $pest->get('/blibb/' .$bid . '/p/' . $params);
		$blibb = json_decode($result);

		// print_r($item);
		// print_r($blibb);

		$t = $blibb->template;
		$buffer = $t->v->default->wb;

		$entries = $item->i;

		$data_set = '';
		foreach($entries as $entry){
			// print_r($entry);
			$data_set .= "$('[name=" . $entry->s . "]').val(". json_encode($entry->v) .");";
		}
		// print_r($buffer);
		// print_r($data_set);
    	$this->render('editItem',compact('current_user', 'buffer', 'bid', 'iid' ,'elements', 'tags', 'data_set'));
    }
}

$app = new EditItem();
$app->run();


