<?php

require_once(__DIR__.'/../system/config.php');


class EditItem extends lib {

    public function run() {

		$current_user = require_login();
		$iid = $this->gt("id");
		$url = $this->gt("curl");

		// print_r("Curl " . $url);
		$this->setRedirect($url);
		$params = "t.v.default,f";

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
		$fields = implode(",", $blibb->fields);

		$t = $blibb->template;
		$buffer = $t->v->default->wb;

		$entries = $item->i;

		$data_set = '';
		foreach($entries as $entry){
			// print_r($entry);
			$data_set .= "$('[name=" . $entry->s . "]').val(". cleanUp($entry->v) .");";
		}
		// print_r($buffer);
		// print_r($_SESSION['redirect_to']);
    	$this->render('editItem',compact('current_user', 'buffer', 'bid', 'iid' ,'elements', 'tags', 'data_set', 'fields'));
    }
}

$app = new EditItem();
$app->run();


