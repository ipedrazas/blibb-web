<?php

class Comment extends Dbo{
	
	public function getId(){
		return (string) $this->_id;
	}

	function getCreationDate(){		
		$d = $this->c['date'];
		$date = DateTime::createFromFormat('Y-m-j H:i:s', $d);
		return $date->format('d/m/Y');
	}


	function renderBox(){
		$m = new Mustache();
		return $m->render($this->getBoxTemplate(), $this);;
	}

	private function getBoxTemplate(){
		$result = "
					<div class=\"Comment\" id=\"comment_{{_id}}\">
					    <div class=\"Meta\">
					        <span class=\"Author\">
					            <a title=\"{{u}}\" href=\"/profile/{{u}}\" class=\"ProfileLink\">
					            <img src=\"{{a}}\" alt=\"{{u}}\" class=\"ProfilePhotoMedium\"></a>
					            <a href=\"/profile/{{u}}}\">$this->u</a>
					        </span>
					         <span class=\"MItem DateCreated\">
					            <a href=\"/comment/{{_id}}#Comment_{{_id}}\" class=\"Permalink\" rel=\"nofollow\">
					            	
					            </a>
					        </span>
					    </div>
					      	<div class=\"Message\">{{{t}}}</div>
					</div>
					";
					//<time title=\"{{c}}}\" datetime=\"{{c}}}\">{{c}}}</time>
		return $result;

	}

}