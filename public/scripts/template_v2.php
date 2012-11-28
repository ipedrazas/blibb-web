<?php
/*

Template

	Name (n)
	Description (d)
	Thumbnail (t)
	Created (c)
	Owner (u)

	Upload (f)  [0 | 1 | *]
	
	TemplateViews (v) [
				Write (w)
				Read (r)
				Style (s)
				
			]

	Items (i) [
				Label (l)
				Type (t)
				ItemView (v) [
							Name (n)
							Write (w)
							Read (r)
							Style (s)
				]
				
			]

*/


require(__DIR__.'/../../system/config.php'); 

	$template = new template();
	
	$template->n = 'Blog v2.0';
	$template->d = 'Template to use for a blog';
	$template->t = 'blog.png';

	$Templateviews =  array();

	$view1->w = '';  
	$view1->rb = '<div class="blibbName">{{name}}</div><div class="blibbDesc">{{desc}}</div><div class="blibbDate">{{created}}</div><div class="blibbAuthor">{{owner}}</div><div class="entryItems">{{#ENTRIES}}{{{.}}}{{/ENTRIES}}</div>';

	$view1->ri = '<div id=\"entry\"><div class=\"postDate\">{{Created}}<\/div><div class=\"postTitle\">{{Title}}<\/div><div class=\"postBody\">{{{Post}}}<\/div><div id="options"><ul><li><a href="#" name="comments" id="{{id}}">Comments</a></li></ul><div id="box{{id}}"></div></div></div>';


	$view1->sb = '.blibbName{font-size: 28px;background-color: black;color: white;font-weight: bolder;padding: 15px 35px;} .blibbDesc{font-size:20px;padding: 15px 50px 20px 50px;background-color: gray;color: white;} .blibbDate{display: none} .blibbAuthor{display:none} .entryItems{margin-top: 20px;} ';
	
	$view1->si = ' #entry{margin-top: 10px;padding-bottom: 7px;padding-left: 65px; border-bottom: 1px dotted black;font-size: 100%;} #entry .postDate{font-size: 75%;color: #9C9A9A;float:right;margin-right: 45px} #entry .postTitle{color: #BA0909;font-size: 26px;font-weight: bolder;} #entry .postBody{font-size: 100%;width: 85%;color: #9C9A9A;padding-left: 45px;margin-top: 20px;margin-left: 55px;} ';

	$Templateviews['Default'] = $view1;

	$view2->n = 'Mobile';
	$view2->w = '';  
	$view2->r = '';
	$view2->s = '';
	$Templateviews['Mobile'] = $view2;

	$template->v = $Templateviews;


	$elems =  array();

	$e1->l = 'Created';
	$e1->t = 'date';
	$e1->w = '<label for="b-'.$e1->l.'">'.$e1->l.':</label><input name="b-'.$e1->l.'" id="datepicker"  type="text" />';
	$elems[0] = $e1;

	$e2->l = 'Title';
	$e2->t = 'input';
	$e2->w = '<label for="b-'.$e2->l.'">'.$e2->l.':</label><input name="b-'.$e2->l.'" placeholder="'.$e2->l.'" size="50" type="text" />';
	$elems[1] = $e2;


	$e3->l = 'Post';
	$e3->t = 'txt';
	$e3->w = '<label for="b-'.$e3->l.'">'.$e3->l.':</label><textarea rows="5" cols="50" name="b-'.$e3->l.'" >'.$e3->l.'</textarea>';
	$elems[2] = $e3;

	$template->i = $elems;

	$template->c = new DateTime('now');

	Dbo::save($template);


	echo 'Template_v2 created!';
?>