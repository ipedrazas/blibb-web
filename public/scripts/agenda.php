<?php

require('../sys/config.php'); 

	$template = new template();
	
	$template->n = 'Agenda';
	$template->d = 'Template to create an Agenda';
	$template->t = 'agenda.png';
	$template->w = '<div id="entry">{{ITEM}}</div>';
	$template->c = new DateTime('now');
	$template->wc = '#entry {margin-top: 10px;padding-bottom: 7px;border-bottom: 1px dotted black;font-size: 100%;}';

	$elems =  array();

	$e1->l = 'Name';
	$e1->t = 'input';
	$e1->we = '<label for="b-'.$e1->l.'">'.$e1->l.':</label><input name="b-'.$e1->l.'" placeholder="'.$e1->l.'" size="50" type="text" />';
	$e1->wr = '<div class="{{CSS}}">{{'.$e1->l.'}}</div>';
	$e1->wc = '#entry .{{CSS}}  {color: #000;	font-size: 125%; font-weight: bolder;}';

	$elems[0] = $e1;

	$e2->l = 'Address';
	$e2->t = 'input';
	$e2->we = '<label for="b-'.$e2->l.'">'.$e2->l.':</label><input name="b-'.$e2->l.'" placeholder="'.$e2->l.'" size="50" type="text" />';
	$e2->wr = '<div class="{{CSS}}">{{'.$e2->l.'}}</div>';
	$e2->wc = '#entry .{{CSS}}  {color: #000;	font-size: 100%; margin-left:25px;}';

	$elems[1] = $e2;


	$e3->l = 'Picture';
	$e3->t = 'file';
	$e3->we = '<label for="b-'.$e3->l.'">'.$e3->l.':</label><input type="file" name="picture">';
	$e3->wr = '<div  class="{{CSS}}">{{Picture}}</div>';
	$e3->wc = '#entry .{{CSS}}  {color: green; font-size: 120%; }';

	$elems[2] = $e3;

	$e4->l = 'Email';
	$e4->t = 'input';
	$e4->we = '<label for="b-'.$e4->l.'">'.$e4->l.':</label><input name="b-'.$e4->l.'" placeholder="'.$e4->l.'" size="50" type="text" />';
	$e4->wr = '<div class="{{CSS}}">{{'.$e4->l.'}}</div>';
	$e4->wc = '#entry .{{CSS}}  {color: #000;	font-size: 100%; margin-left:25px;}';

	$elems[3] = $e4;

	$e5->l = 'Mobile';
	$e5->t = 'input';
	$e5->we = '<label for="b-'.$e5->l.'">'.$e5->l.':</label><input name="b-'.$e5->l.'" placeholder="'.$e5->l.'" size="50" type="text" />';
	$e5->wr = '<div class="{{CSS}}">{{'.$e5->l.'}}</div>';
	$e5->wc = '#entry .{{CSS}}  {color: #000;	font-size: 100%;  margin-left:25px;}';

	$elems[4] = $e5;

	$e6->l = 'Website';
	$e6->t = 'input';
	$e6->we = '<label for="b-'.$e6->l.'">'.$e6->l.':</label><input name="b-'.$e6->l.'" placeholder="'.$e6->l.'" size="50" type="text" />';
	$e6->wr = '<div class="{{CSS}}">{{'.$e6->l.'}}</div>';
	$e6->wc = '#entry .{{CSS}}  {color: #000;	font-size: 100%;  margin-left:25px;}';

	$elems[5] = $e6;


	$template->i = $elems;

	Dbo::save($template);

?>

