<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {
    	$m = new Mustache();

    	$this->setRedirect();
		$iid = $this->gt("i");

		$pest = new Pest(REST_API_URL);
    	$jb = $pest->get('/blitem/' . $iid );

 		$bli = json_decode($jb);
 		// print_r($bli);

 		$cs = json_decode($bli->cs);


 		$comments = $cs->resultset;
 		// print_r($comments);
 		$commentTemplate = '<div class="post-comment"><div class="thumbnail span1 pull-right"><img src="{{th}}" alt=""></div><h3>{{u}} <small>{{comment_date}}</small></h3>{{t}}</div>';

 		foreach ($comments as $rawIt) {
			$eComments[] =  chr(10) . stripcslashes($m->render($commentTemplate,$rawIt));
		}

		$bli->COMMENTS = $eComments;

 		$b = $bli->b;
    	$bt = $pest->get('/blibb/' . $b . '/template' );

    	$btemplate = json_decode($bt);
    	// print_r($btemplate);

 		$body = $bli->body;

 		$bname = $btemplate->t->n;
 		
 		$bdesc = $btemplate->t->d;
 		$author = $btemplate->t->u;
 		$view = $btemplate->t->v->Default[0];
 		$blibbBox = stripcslashes($view->rb);
 		$css = '<style>' . $view->sb . chr(10) . $view->si . ' .comments{display: inline;}</style>';
 		$itemTemplate = $view->ri;
 		// echo $btemplate->t->c['$date'];
 		// $date = new DateTime( $btemplate->t->c);

		$owner = false;
		
		$current_user = current_user();
				
		// if($author === $current_user){
		// 	$owner = true;
		// }
		

		

		// $bItems = $pest->get('/blitems/' . $bid );
		// $bItems = str_replace('$oid', "oid", $bItems);
		// $its = json_decode($bItems);
		// $results = $its->results;

		// if($results > 0){
		// 	$rs = $its->resultset;
		// 	$itemsResult =  array();
		// 	foreach ($rs as $eRs) {
		// 		$elementRs = json_decode($eRs);
		// 		$objId = $elementRs->_id;
		// 		$_blitem = array();
		// 		$_blitem['id'] = $objId->oid;
		// 		$itemsRs = $elementRs->i;
		// 		foreach ($itemsRs as $elems) {
					
		// 			$type = $elems->t;
		// 			if($type=='15'){
		// 				$slug = $elems->s;
		// 				$obj = $elems->v;
		// 				$value =  $obj->oid; //'<a href="actions/getImage?id=' . $obj->oid . '&i=1" border="0"><img src="actions/getImage?id=' . $obj->oid . '" alt="thumbnail" />';
		// 				$_blitem[$slug] = $value;
		// 			}
		// 			else if($type=='1f'){
						
		// 				$slug = $elems->s;
		// 				$obj = $elems->v;
		// 				$song_id = $obj->id->oid;
		// 				$value =  $song_id; //'<audio controls preload><source src="actions/playMp3?i=' . $song_id . '" /></audio>';
		// 				$_blitem[$slug] = $value;
						

		// 			}else{
		// 				$slug = $elems->s;
		// 				$value = $elems->v;
		// 				$_blitem[$slug] = $value;
		// 			}
					
		// 		}
		// 		$itemsResult[] = $_blitem;
		// 	}

		// 	foreach ($itemsResult as $rawIt) {
				$entries[] =  chr(10) . stripcslashes($m->render($itemTemplate,$bli));
		// 	}

			// print_r($itemTemplate);

			$blibb['name'] = $bname;
			$blibb['desc'] = $bdesc;
			$blibb['owner'] = $author;
			// $blibb['created'] = $date->format('d-m-Y H:i:s');
	    	$blibb['ENTRIES'] = $entries;
	    	
	    	$blibb['css'] = $css;
			$content =  $m->render($blibbBox, $blibb);

		// }else{
		// 	$content = "There are no blitems yet";
		// }
		
		// if($this->gt('i')==1){
			// $view = 'iBlibb';	
		// }else{
			$view = 'viewBlibb';
		// }

		$this->render($view, compact('content','css', 'owner','bid', 'entries', 'current_user'));

        
    }
}

$app = new Application();
$app->run();  

