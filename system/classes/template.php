<?php



class Template extends Dbo {

	public function getId(){
		return (string) $this->_id;
	}

	public function isGroup(){
		return $this->g;
	}

	function render(){
		echo "$this->n , $this->d <br>"; 

	}

	function renderAdd($b_id){

		$img = $this->t;

		if(empty($img)){
			$html = '<li><a href="addt?b='.$b_id.'&t='.$this->_id.'">'.$this->n.'</a></li>';
		}else{
			$html =	'<li><a href="addt?b='.$b_id.'&t='.$this->_id.'"><img src="/img/templates/'.$img.'" hspace="10" width="50" height="60">'.$this->n.' </a></li>';
		}
		
		echo $html;
	}

	function renderTemplates(){

		$img = $this->t;

		if(empty($img)){
			$html = '<li><a href="#" name="template" id="'.$this->_id.'">'.$this->n.'</a></li>';
		}else{
			$html =	'<li><a href="#" name="template" id="'.$this->_id.'"><img src="/img/templates/'.$img.'" hspace="10" width="50" height="60">'.$this->n.' </a></li>';
		}
		
		echo $html;
	}	


}