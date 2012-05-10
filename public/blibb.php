<?php

require_once(__DIR__.'/../system/config.php');


class Application extends lib {

    public function run() {

    	$this->setRedirect();
    	$fullView = $this->gt("v");
		$bid = $this->gt("b");
		$pest = new Pest('http://localhost:5000');
    	$jb = $pest->get('/blibb/' . $bid . '/view/Default');
 		$bli = json_decode($jb);
 		$bname = $bli->name;
 		$bdesc = $bli->description;
 		$author = $bli->owner;
 		$btags = array();
 		
 		if(isset($bli->tags)){
 			$btags = $bli->tags;
 		}
 		
 		$view = $bli->Default[0];
 		$blibbBox = stripcslashes($view->rb);
 		$css = '<style>' . $view->sb . chr(10) . $view->si . '</style>';
 		$date = new DateTime( $bli->date);
 		
		$owner = false;
		$current_user = current_user();
		if($author === $current_user){
			$owner = true;
		}

		$bItems = $pest->get('/blitem/'. $bid .'/items');
		$bItems = str_replace('$oid', "oid", $bItems);
		$its = json_decode($bItems);
		$results = $its->count;
		$fields = $its->fields;

		// print_r($its);

		if($results > 0){
			$rs = $its->items;			
			$itemsResult =  array();
			foreach ($rs as $eRs) {
				// print_r($eRs);
				$_blitem = array();
				$_blitem['id'] =  $eRs->id;
				
				foreach ($fields as $field) {
					$type = $eRs->$field->t;
					if($type=='15'){
						$slug = $field;
						$obj = $eRs->$field;
						$value =  $obj->oid;
						$_blitem[$slug] = $value;
					}
					else if($type=='1f'){						
						$slug = $field;
						$obj = $eRs->$field;
						$song_id = $obj->id->oid;
						$value =  $song_id; //'<audio controls preload><source src="actions/playMp3?i=' . $song_id . '" /></audio>';
						$_blitem[$field] = $value;
					}else if($type=='33'){						
						$url = $eRs->$field->v;
						if(isset($url->url)){
							$_blitem['BOOKMARK'] = $url;
						}else{
							$tArray['title'] = 'Processing...';
							$tArray['domain'] = 'Processing...';
							$_blitem['BOOKMARK'] = $tArray;	
						}
						
					}else{
						if(isset($eRs->$field->v)){
							$_blitem[$field] = $eRs->$field->v;
						}else{
							$_blitem[$field] = '';
						}
						
					}						
				}
				// Comments
				$cmnts = $eRs->cs;
				$comments = json_decode($cmnts);
				$_blitem['COMMENTS'] =  $comments->resultset;
				$_blitem['key'] = getKey();
				if (isset($eRs->tags)){
					$_blitem['TAGS'] = $eRs->tags;	
				}				
				$itemsResult[] = $_blitem;
			}

			// print_r($itemsResult);

			$blibb['name'] = $bname;
			$blibb['desc'] = $bdesc;
			$blibb['owner'] = $author;
			$blibb['created'] = $date->format('d-m-Y H:i:s');
	    	$blibb['ENTRIES'] = $itemsResult;
	    	$blibb['css'] = $css;
	    	$blibb['bid'] = $bid;
	    	$blibb['TAGLIST'] = $btags;

	    	$m = new Mustache();
			$content =  $m->render($blibbBox, $blibb);

		}else{
			$content = "There are no blitems yet";
		}
		
		if($this->gt('i')==1){
			$view = 'iBlibb';	
		}else{
			$view = 'viewBlibb';
		}


		$content = str_replace('<blibb:menuBar/>', $this->getMenuBar(), $content);
		$content = str_replace('<blibb:footer/>', $this->getFooter(), $content);
		// print_r($this->getMenuBar());

		$this->render($view, compact('content','css', 'owner','bid', 'entries', 'current_user'));

        
    }

    private function getFooter(){
    	return '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write("<script src=\"js/libs/jquery-1.7.1.min.js\"><\/script>")</script>
<script src="/js/libs/bootstrap.js"></script>
<script>
	$("#logout").live("click", function(){ 
		event.preventDefault();    
		$("#logoff").submit();
	}); 
	$(".dropdown-toggle").dropdown();
</script>
<form action="logout" method="post" id="logoff"></form>
';

    }

    private function getMenuBar(){
    	$userName = current_user();
    	$res = '<link rel="stylesheet" href="/css/bootstrap-responsive.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="/css/blibb.css">
			<style>

			header {	
				height: 50px;
				width: 100%;
				margin: 0 auto;
				padding-top: 10px;

			}
			.topbar{
				top: 0;
				left: 0;
				right: 0;
				position: fixed;
				background-color: #b21006;
				height: 40px;
			}

			.topbar img{
				vertical-align: text-bottom;
				margin-left: 50px;
			}
			.topTitle{
				color: white;
				line-height: 19px;
				font-size: 1.8em;
				font-weight: bolder;
				margin-left: 5px;
				margin-top: 5px;
			}
			.topbar a:hover {
				text-decoration: none;
			}
			a.dropdown-toggle:link{	
				color: white;
				font-weight: bolder;
			}
			a.dropdown-toggle:visited{	
				color: white;
				font-weight: bolder;
			}
			 

			.nav > li > a.dropdown-toggle:hover {
			  text-decoration: none;
			  background-color: #b21006;
			  color: #FB8F3D;
			}

			.dropdown-menu a {
				line-height: 15px;
			}

			</style>
			<header class="topbar">
				<div class="container">
			          <a href="/" class="brand">
			            <img src="/img/blibb-logo-30-2white.png" alt="Blibb" title="Blibb" border="0"/> <span class="topTitle">:blibb</span>  
			          </a>';
          
            if(empty($userName)){
            	$res .=  '<ul class="menu">        
	              <li><a href="/login">Sign In</a></li>
	              <li><a href="/signup">Sign up</a></li>
	            </ul>
	            ';
          	}else{ 
          		$res .= '<ul class="nav" style="float: right; margin-right: 105px">
		              <li class="dropdown">
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $userName .'<b class="caret"></b></a>
		                <ul class="dropdown-menu">
		                  <li><a href="/profile?p='. $userName .'">Profile</a></li>
		                  <li><a href="/user/'. $userName .'">UserSpace</a></li>
		                  <li><a href="#" id="logout">Log Out</a></li>
		                </ul>
		              </li>
		            </ul>
            		';
         	}
         	$res .='</div>
					</header>
					<div id="clear"></div>
					<div id="main">
				    	';
    	return $res;
    }
}

$app = new Application();
$app->run();  
