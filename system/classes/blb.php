<?php

class Blb extends Dbo { 

	public function getId(){
		return (string) $this->_id;
	}

	function toSemanticArray(){
		return array( 	
						'id'=>$this->_id, 
						'name'=>$this->n,
						'desc'=>$this->d, 
						'owner'=>$this->u,
						'created'=>$this->getCreationDate()
					);
	}
	
	function toArray($view='Default'){
		$view = $this->getView($view);
		return array( 	
						'id'=>$this->_id, 
						'name'=>$this->n,
						'desc'=>$this->d, 
						'owner'=>$this->u,
						'created'=>$this->getCreationDate(),
						'template'=>$this->getBlibbTemplate($view) ,
						'css'=> $this->getBlibbStyle($view),
						'itemTemplate' => $this->getItemTemplate($view),
						'itemCss'=> $this->getItemStyle($view)
					);
	}

	public function isContributor($user){
		$contributors = $this->gu;
		if(isset($contributors)){
			foreach ($contributors as $c) {
				if($c === $user){
					return true;
				}
			}
		}
		return false;
	}

	function getBlibbTemplate($view){
		return stripslashes($view['rb']);
	}
	function getBlibbStyle($view){
		return stripslashes($view['sb']);
	}
	function getItemStyle($view){
		return stripslashes($view['si']);
	}
	function getItemTemplate($view){
		return stripslashes($view['ri']);
	}
	function getViews(){
		$t = $this->getTemplate();
		if(isset($t['_data'])){
			$tt = $t['_data'];
			return $tt['v'];
		}else{
			return $t['v'];
		}
		
	}
	function getView($viewName){
		$views = $this->getViews();
		$a = $views[$viewName];
		return $a[0];
	}
	function getTemplateFields($mode){
		$template = $this->getTemplate();
		$fields = array();
		if(!empty($template)){
			$tfields = $template['i'];
			foreach($tfields as $f){
				$fields[]  = $f[$mode];
			}	
		}
		
		return $fields;
	}

	function getReadFields(){
		return $this->getTemplateFields('r');
	}
	function getWriteFields(){
		return $this->getTemplateFields('w');
	}

	function isGroup(){
		$template = $this->getTemplate();
		if(isset($template['g'])){
			return $template['g'];
		}
		return false;
	}

	function getFields(){
		$template = $this->getTemplate();
		$fields = array();
		if(!empty($template)){
			$tfields = $template['i'];
			foreach($tfields as $f){
				$fields[$f['l']]  = $f['t'];
			}	
		}
		
		return $fields;
	}

	
	function getTemplateThumbnail(){
		$template = $this->t;
		return $template['t'];
	}

	function getThumbHtml(){
		return '<img src="/img/templates/'.$this->getTemplateThumbnail().'" width="50" height="60">';
	}

	function hasPosition(){
		return (!empty($this->pos['lon']) && !empty($this->pos['lat']));

	}

	function getLongitude(){
		return $this->pos['lon'];
	}

	function getLatitude(){
		return $this->pos['lat'];
	}

	function getShortDesc(){
		if(strlen($this->d)>120){
			return substr($this->d,0,118) . "....";
		}else{
			return $this->d;
		}
	}

	function renderBox(){
		$box = "<div id=\"bcontainer\" class=\"blcontainer\">" .
				"<div class=\"b\" id=\"".$this->_id."\">" .	
				'<div id="btext">' .
				"<h1 class=\"bname\">$this->n</h1>" .
				"<p class=\"bdesc\">".$this->getShortDesc()."</p>" .
				'</div>' .
				'<img src="/img/bthumb.png" />' .	
				'</div>';
		$box .= $this->getBOptions();
		$box .= '</div>';
		return $box;
	}

	function getBOptions(){
		$opts = '<div id="bottom">' .
				'<ul class="bopts">' .
				'<li><a href="#">Comments</a></li>' .
				'<li><a href="#">Followers</a></li>' ;
		if($this->hasPosition()){
			$opts .=		"<li><a href=\"#\"  id=\"showGeo\" name=\"".$this->_id."\">Add Location</a></li>";
		}else{
			$opts .=		"<li><a href=\"#\"  id=\"initGeo\" name=\"".$this->_id."\">Add Location</a></li>";	
		}		
		
		$opts .=		'<li><a href="#">Tags</a></li>' .
				'</ul>' .
				'</div>';
		return $opts;
	}


	function renderOptions(){
		$opts =  '<ul class="blbOptions">';
		$o = $this->o;
		foreach($o as $os){
			$key = key($o);
			if(!empty($key)){
				$opts .= "<li class=\"opt".$key."\">".$key."</li>";				
			}
			next($o);
		}					
		$opts .= '</ul>';
		return $opts;
	}

	function getCreationDate(){		
		$d = $this->c;
		//$date = DateTime::createFromFormat('Y-m-j H:i:s', $d);
		return $d; ##ate->format('d/m/Y');
	}
	function getTemplate(){
		// it will be an array
		return $this->t;
	}
	function isObject(){
		if(is_null($this->n)){
			return false;
		}else{
			return true;
		}
	}

	function getTemplateItems(){
		$t = $this->getTemplate();
		$tf = $t['i'];	
		foreach($tf as $f){
		}
	}

}

