<?php
/*

Template

	Name (n)
	Description (d)
	Thumbnail (t)
	Created (c)
	Owner (u)

	Upload (f)  [true]
	
	TemplateViews (v) [
				Write (w)
				Read (r)
				Style (s)
				
			]

	Items (i) [
				Label (l)
				Slug (s) <-- used as a text id for html controls
				Type (t)
				ItemView (v) [
							Name (n)
							Write (w)
							Read (r)
							Style (s)
							Box (b)
				]
				
			]

*/


require(__DIR__.'/../../system/config.php'); 

	$template = new template();
	
	$template->n = 'Timeline';
	$template->d = 'Template to create a timeline. Picture, description and date';
	$template->t = 'blog.png';
	$template->f = true;

	$Templateviews =  array();

	$view1->w = '';  
	$view1->rb = '<div class="blibbName">{{name}}</div><div class="blibbDesc">{{desc}}</div><div class="blibbDate">{{created}}</div><div class="blibbAuthor">{{owner}}</div><div class="entryItems">{{#ENTRIES}}{{{.}}}{{/ENTRIES}}</div>';

	$view1->sb = '.blibbName{font-size: 28px;background-color: black;color: white;font-weight: bolder;padding: 15px 35px;} .blibbDesc{font-size:20px;padding: 15px 50px 20px 50px;background-color: gray;color: white;} .blibbDate{display: none} .blibbAuthor{display:none} .entryItems{margin-top: 20px;} ';
	


	$templateFile = __DIR__ . '/template/timeline.htm';
	$cssFile = __DIR__ . '/template/timeline.css';
	
	if(file_exists($templateFile)){
		$view1->ri = file_get_contents($templateFile);
	} 
	if(file_exists($cssFile)){
		$view1->si = file_get_contents($cssFile);
	}

	$Templateviews['Default'] = $view1;

	$view2->n = 'Mobile';
	$view2->w = '';  
	$view2->r = '';
	$view2->s = '';
	$Templateviews['Mobile'] = $view2;

	$template->v = $Templateviews;
	$elems =  array();

	$e1->l = 'Created';
	$e1->s = 'Created';
	$e1->t = 'date';
	$e1->w = '<label for="b-'.$e1->s.'">'.$e1->l.':</label><input name="b-'.$e1->s.'" id="datepicker"  type="text" />';
	$elems[0] = $e1;

	$e2->l = 'Picture';
	$e2->s = 'Picture';
	$e2->t = 'input';
	$e2->w = '<label for="'.$e2->s.'">Upload a '.$e2->l.':</label><input name="'.$e2->s.'" id="'.$e2->s.'"  type="file" /><input type="hidden" name="i-'.$e2->s.'" />';
	$elems[1] = $e2;


	$e3->l = 'Descrition';
	$e3->s = 'Descrition';
	$e3->t = 'input';
	$e3->w = '<label for="b-'.$e3->s.'">'.$e3->l.':</label><input name="b-'.$e3->s.'" placeholder="'.$e3->l.'" size="50" type="text" />';
	$elems[2] = $e3;

	$template->i = $elems;
	$template->c = new DateTime('now');

	Dbo::save($template);

	echo 'Timeline Template created!';
?>