<?php

require(__DIR__.'/../../system/config.php'); 

	$template = new template();
	date_default_timezone_set('Europe/London');
	
	$template->n = 'PlayBlibb';
	$template->d = 'Create your own playlist, I mean, playblibbs!';
	$template->t = 'music.png';
	$template->f = true;
	// 

	$Templateviews =  array();

	$rb = '<div class="blibbName">{{name}}</div><div class="blibbDesc">{{desc}}</div><div class="blibbDate">{{created}}</div><div class="blibbAuthor">{{owner}}</div><div id="player"></div><div class="entryItems">{{#ENTRIES}}{{{.}}}{{/ENTRIES}}</div>';
	$view->rb = $rb;

	$view->sb = '.blibbName{font-size: 28px;background-color: black;color: white;font-weight: bolder;padding: 15px 35px;} .blibbDesc{font-size:20px;padding: 15px 50px 20px 50px;background-color: gray;color: white;} .blibbDate{display: none} .blibbAuthor{display:none} .entryItems{margin-top: 20px;} ';


	$templateFile = __DIR__ . '/template/music.htm';
	$cssFile = __DIR__ . '/template/music.css';
	
	if(file_exists($templateFile)){
		$view->ri = file_get_contents($templateFile);
	} 
	if(file_exists($cssFile)){
		$view->si = file_get_contents($cssFile);
	}

	$Templateviews['Default'] = $view;

	$mobileCss = __DIR__ . '/template/musicMobile.css';

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

	$e1->l = 'Song';
	$e1->s = 'Song';
	$e1->t = 'file';
	$e1->w = '<label for="'.$e1->s.'">'.$e1->l.':</label><input name="'.$e1->s.'" id="'.$e1->s.'"  type="file" /><input type="hidden" name="u-'.$e1->s.'" />';
	$elems[0] = $e1;

	$template->i = $elems;

	$template->c = new DateTime('now');

	Dbo::save($template);

	echo 'Template playblibb created';
?>

