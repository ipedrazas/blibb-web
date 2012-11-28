<?php

require(__DIR__.'/../../system/config.php'); 

	$template = new template();
	
	$template->n = 'Blog 3v';
	$template->d = 'Template to use for a blog';
	$template->t = 'blog.png';

	$Templateviews =  array();

	$rb = '<div class="blibbName">{{name}}</div><div class="blibbDesc">{{desc}}</div><div class="blibbDate">{{created}}</div><div class="blibbAuthor">{{owner}}</div><div id="player"></div><div class="entryItems">{{#ENTRIES}}{{{.}}}{{/ENTRIES}}</div>';
	$view->rb = $rb;

	$view->sb = '.blibbName{font-size: 28px;background-color: black;color: white;font-weight: bolder;padding: 15px 35px;} .blibbDesc{font-size:20px;padding: 15px 50px 20px 50px;background-color: gray;color: white;} .blibbDate{display: none} .blibbAuthor{display:none} .entryItems{margin-top: 20px;} ';

	$templateFile = __DIR__ . '/template/blog2.htm';
	$cssFile = __DIR__ . '/template/blog.css';
	
	if(file_exists($templateFile)){
		$view->ri = file_get_contents($templateFile);
	} 
	if(file_exists($cssFile)){
		$view->si = file_get_contents($cssFile);
	}

	$Templateviews['Default'] = $view;

	$mobileCss = __DIR__ . '/template/blogMobile.css';

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

	$e1->l = 'Created';
	$e1->s = 'Created';
	$e1->t = 'date';
	$e1->w = '<label for="b-'.$e1->l.'">'.$e1->l.':</label><input name="b-'.$e1->l.'" id="datepicker"  type="text" />';
	$elems[0] = $e1;

	$e2->l = 'Post Title';
	$e2->s = 'Post_Title';
	$e2->t = 'input';
	$e2->w = '<label for="b-'.$e2->s.'">'.$e2->l.':</label><input name="b-'.$e2->s.'" placeholder="'.$e2->l.'" size="50" type="text" />';
	$elems[1] = $e2;


	$e3->l = 'Post Body';
	$e3->s = 'Post_Body';
	$e3->t = 'txt';
	$e3->w = '<label for="b-'.$e3->s.'">'.$e3->l.':</label><textarea rows="5" cols="50" name="b-'.$e3->s.'" ></textarea>';
	$elems[2] = $e3;

	$template->i = $elems;

	$template->c = new DateTime('now');

	Dbo::save($template);

	echo 'Blog Template created';
?>

