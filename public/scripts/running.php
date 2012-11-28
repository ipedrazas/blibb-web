<?php

require(__DIR__.'/../../system/config.php'); 

	$template = new template();
	
	$template->n = 'RunningBlibb';
	$template->d = 'Running Log!';
	$template->t = 'running.png';
	$template->f = false;
	$template->g= false; // This flag allows collaborative creation.
	// 

	$Templateviews =  array();
	$rb = '<div class="blibbName">{{name}}</div><div class="blibbDesc">{{desc}}</div><div class="blibbDate">{{created}}</div><div class="blibbAuthor">{{owner}}</div><div id="player"></div><div class="entryItems">{{#ENTRIES}}{{{.}}}{{/ENTRIES}}</div>';

	$view->rb = $rb;

	$view->sb = '.blibbName{font-size: 28px;background-color: black;color: white;font-weight: bolder;padding: 15px 35px;} .blibbDesc{font-size:20px;padding: 15px 50px 20px 50px;background-color: gray;color: white;} .blibbDate{display: none} .blibbAuthor{display:none} .entryItems{margin-top: 20px;} ';


	$templateFile = __DIR__ . '/template/running.htm';
	$cssFile = __DIR__ . '/template/running.css';
	
	if(file_exists($templateFile)){
		$view->ri = file_get_contents($templateFile);
	} 
	if(file_exists($cssFile)){
		$view->si = file_get_contents($cssFile);
	}

	$Templateviews['Default'] = $view;

	$mobileCss = __DIR__ . '/template/runningMobile.css';

	$viewM->rb = $rb;

	$viewM->sb = 'html , body {	margin: 0;} .blibbName{font-weight: bolder;color: #365791;background-color: #D7E3F7;margin:0;padding-top: 12px;padding-left: 30px;padding-bottom: 12px;font-size: 45px;} .entryItems{	margin: 10px; } ul li{	display: inline;	padding-right: 25px;} #options a:link, a:visited{	color: #80848C;	text-decoration: none;} .blibbAuthor{ display: none} .blibbDate{ display: none} .blibbDesc{display : none}';
	
	if(file_exists($templateFile)){
		$viewM->ri = file_get_contents($templateFile);
	}
	if(file_exists($mobileCss)){
		$viewM->si = file_get_contents($mobileCss);
	}

	$Templateviews['Mobile'] = $viewM;

	$template->v = $Templateviews;

	$elems =  array();

	$e1->l = 'Distance';
	$e1->s = 'distance';
	$e1->t = 'units';  // we really need a way to solve this!!! 
	$e1->w = '<label for="'.$e1->s.'">'.$e1->l.':</label><input name="b-'.$e1->s.'" id="'.$e1->s.'"  type="text" /><select name="units"><option value="Km">Km</option><option value="Mi">Miles</option></select>';
	$elems[] = $e1;

	$e2->l = 'Time';
	$e2->s = 'time';
	$e2->t = 'input';
	$e2->w = '<label for="'.$e2->s.'">'.$e2->l.':</label><input name="b-'.$e2->s.'" id="'.$e2->s.'"  type="text" />';
	$elems[] = $e2;

	$e3->l = 'Date';
	$e3->s = 'date';
	$e3->t = 'input';
	$e3->w = '<label for="'.$e3->s.'">'.$e3->l.':</label><input name="b-'.$e3->s.'" id="datepicker"  type="text" />';
	$elems[] = $e3;

	$template->i = $elems;

	$template->c = new DateTime('now');

	Dbo::save($template);

	echo 'Template '. $template->n .' created';

?>

