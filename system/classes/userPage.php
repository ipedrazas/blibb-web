<?php

/**
*	This class get's the page that people see when they access the userspace
*		BlibbBrief: Image, Title, ShortDesc, Num Comments, Num Followers, Num Tags
*		UserInfo: Thumbnail, Name, presentation
*		Blibbist: List of Blibbs, Title, Thumbnail
*		Tags: Tag Cloud of the user
*		Groups: groups of the user
*
**/

class UserPage extends Dbo{
		
	public function getId(){
		return (string) $this->_id;
	}
	

}