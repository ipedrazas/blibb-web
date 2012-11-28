<?php

class Follow extends Dbo{
	
	public function getId(){
		return (string) $this->_id;
	}

	function isFollowedBy($user){
		// first check if it has any follower
		if($this->nf>0){
			$followers = $this->f;
			print_r($followers);
			foreach ($followers as $u) {

				if($u['u']===$user){
					return true;
				}
			}		
		}
		return false;
	}	

}