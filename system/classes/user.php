<?php

class User extends Dbo{

	public function getId(){
		return (string) $this->_id;
	}
	
	function render(){
		echo "<b>$this->n</b> : $this->p"; 

	}

	function authenticate($user,$pwd){
		if($this->e === $user){
			if($this->p === sha1($pwd . $this->s)){
				return true;
			}	
		}		
		return false;
	}

	function hasTwitter(){
		if((!empty($this->tt)) && (!empty($this->ts)) ){
			return true;
		}
		return false;
	}

}