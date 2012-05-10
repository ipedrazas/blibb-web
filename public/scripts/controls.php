<?php

require(__DIR__.'/../../system/config.php'); 

	$template = new template();
	
	$template->n = 'Controls';
	$template->d = 'Html Controls to create Templates';
	$template->t = 'blog.png';

	$Templateviews =  array();

	$rb = '<div class="blibbName">{{name}}</div><div class="blibbDesc">{{desc}}</div><div class="blibbDate">{{created}}</div><div class="blibbAuthor">{{owner}}</div><div id="player"></div><div class="entryItems">{{#ENTRIES}}{{{.}}}{{/ENTRIES}}</div>';
	$view->rb = $rb;

	$view->sb = '.blibbName{font-size: 28px;background-color: black;color: white;font-weight: bolder;padding: 15px 35px;} .blibbDesc{font-size:20px;padding: 15px 50px 20px 50px;background-color: gray;color: white;} .blibbDate{display: none} .blibbAuthor{display:none} .entryItems{margin-top: 20px;} ';

	$templateFile = __DIR__ . '/template/controls.htm';
	$cssFile = __DIR__ . '/template/controls.css';
	
	if(file_exists($templateFile)){
		$view->ri = file_get_contents($templateFile);
	} 
	if(file_exists($cssFile)){
		$view->si = file_get_contents($cssFile);
	}

	$Templateviews['Default'] = $view;

	// $mobileCss = __DIR__ . '/template/blogMobile.css';

	// $viewM->rb = $rb;

	// $viewM->sb = 'html , body {	margin: 0;} .blibbName{font-weight: bolder;color: #365791;background-color: #D7E3F7;margin:0;padding-top: 12px;padding-left: 30px;padding-bottom: 12px;font-size: 45px;} .entryItems{	margin: 10px; } ul li{	display: inline;	padding-right: 25px;} #options a:link, a:visited{	color: #80848C;	text-decoration: none;} .blibbAuthor{ display: none} .blibbDate{ display: none} .blibbDesc{display : none}';
	
	// if(file_exists($templateFile)){
	// 	$viewM->ri = file_get_contents($templateFile);
	// }
	// if(file_exists($mobileCss)){
	// 	$viewM->si = file_get_contents($mobileCss);
	// }

	// $Templateviews['Mobile'] = $viewM;

	$template->v = $Templateviews;

	$elems =  array();

	$e1->l = 'Name';
	$e1->s = 'name';
	$e1->t = 'input';
	$e1->w = '<label for="b-'.$e1->l.'">'.$e1->l.':</label><input name="b-'.$e1->l.'" placeholder="'.$e1->l.'" size="50"  type="text" />';
	$elems[0] = $e1;

	// $e11->l = 'Slug';
	// $e11->s = 'slug';
	// $e11->t = 'input';
	// $e11->w = '<label for="b-'.$e11->l.'">'.$e11->l.':</label><input name="b-'.$e11->l.'" placeholder="'.$e11->l.'" size="50"  type="text" />';
	// $elems[1] = $e11;

	$e2->l = 'Description';
	$e2->s = 'description';
	$e2->t = 'input';
	$e2->w = '<label for="b-'.$e2->s.'">'.$e2->l.':</label><input name="b-'.$e2->s.'" placeholder="'.$e2->l.'" size="50" type="text" />';
	$elems[1] = $e2;

	// $e3->l = 'View - Read';
	// $e3->s = 'r';
	// $e3->t = 'txt';
	// $e3->w = '<label for="b-'.$e3->s.'">'.$e3->l.':</label><textarea rows="5" cols="50" name="b-'.$e3->s.'" ></textarea>';
	// $elems[3] = $e3;

	// $e4->l = 'View - ReadStyle';
	// $e4->s = 'rs';
	// $e4->t = 'txt';
	// $e4->w = '<label for="b-'.$e4->s.'">'.$e4->l.':</label><textarea rows="5" cols="50" name="b-'.$e4->s.'" ></textarea>';
	// $elems[4] = $e4;

	// $e5->l = 'Write';
	// $e5->s = 'w';
	// $e5->t = 'txt';
	// $e5->w = '<label for="b-'.$e5->s.'">'.$e5->l.':</label><textarea rows="5" cols="50" name="b-'.$e5->s.'" ></textarea>';
	// $elems[5] = $e5;

	// $e6->l = 'Write Style';
	// $e6->s = 'ws';
	// $e6->t = 'txt';
	// $e6->w = '<label for="b-'.$e6->s.'">'.$e6->l.':</label><textarea rows="5" cols="50" name="b-'.$e6->s.'" ></textarea>';
	// $elems[6] = $e6;

	$template->i = $elems;

	$template->c = new DateTime('now');

	Dbo::save($template);

	echo 'Blog Template created';
?>

