<?php

// 	javascript:void(
	// window.open(
	// 	%22http://blibb.co/action/quick-add?
	// 		token={{USER_TOKEN}}&
	// 		url=%22+escape(location.href)+%22
	// 		&title=%22+escape(document.title)+%22
	// 		&viaurl=%22+escape(document.referrer)+%22
	// 		&description=%22+(document.getSelection?document.getSelection():window.getSelection()),
	// 	%20%22%22,%20%22fullscreen=no,toolbar=no,status=yes,menubar=no,scrollbars=no,resizable=no,
	// 	directories=no,location=no,width=600,height=400%22));

// http://localhost/action/quick-add?token=1234567890987654321url=https%3A//seesmic.com/web/index.html%3Fredirect%3D1%26locale%3Den%23dashboard&title=Seesmic&viaurl=https%3A//seesmic.com/web/index.html&description=

require_once(__DIR__.'/../../system/config.php');


class QuickAdd extends lib {

	 public function run() {

	 	$token = $this->gt('token');
	 	$url = $this->gt('url');
	 	$title = $this->gt('title');
	 	$viaurl = $this->gt('viaurl');
	 	$description = $this-> gt('description');

	 	// TODO
	 	// Get and display User Bookmarks blibbs
	 	// Tags  textbox
	 	// Description textbox?

	 	echo "User: " . $token . "<br/>";
	 	echo "Url: " . $url . "<br/>";
	 	echo "Title: " . $title . "<br/>";
	 	echo "viaUrl: " . $viaurl . "<br/>";
	 	echo "Description: " . $description . "<br/>";


	 }
}


$app = new QuickAdd();
$app->run();  

?>