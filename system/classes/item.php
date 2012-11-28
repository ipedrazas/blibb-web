<?php



class Item extends Dbo{

	private $hasComments = false;
	private $hasGeo = false;

	static private $options = array("cmts", "frk", "fw", "geo", "tgs");
	
	public function getId(){
		return (string) $this->_id;
	}

	function toSemanticArray(){
		return $this->i;
	}
	
	function toArray(){
		$item = $this->i;
		$item['id'] =  $this->_id;
		$item['username'] =  $this->u;
		return $item;
	}
	function render(){
		echo "<b>$this->n</b> : $this->v"; 
	}

	function isBoxed(){
		return !empty($this->x);
	}

	function getBox(){
		return $this->x;
	}

	static function isOption($item){
		foreach(self::$options as $opt){
			if($item === $opt){
				return true;
			}	
		}		
		return false;
	}

	

	function getOptions(){
		$buffer = '<ul class="itemOptions">';
		if($this->hasComments){
			$buffer = $buffer . '<li><a href="addComment">Comments</a></li>';
		}
		if($this->hasGeo){
			$buffer = $buffer . '<li><a href="addGeo">Get Location</a></li>';
		}

		$buffer = $buffer . '</ul>';

		return $buffer;

	}

	function renderWithTempalate(){
		$m = new Mustache;
		$items = $it->i;
		echo $m->render($template,$items);
	}

}