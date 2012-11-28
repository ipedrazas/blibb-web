<?php


require_once(__DIR__.'/../../system/config.php');


?>

<!doctype html>

<html class="no-js" lang="en">
<head>  
<link rel="stylesheet" href="/css/bootstrap.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script src="/js/libs/bootstrap.js"></script>


<style>

.container{
//	background: url(/img/notebook.png) repeat-y;
	padding-top: 30px;
	padding-left: 115px;
}
.apiMethod{
	width: 940px;
	margin-left: 45px;
	padding: 20px 10px 10px 0px;
	border-bottom: 1px solid #EDF9FF;
}
p { 
	width:90%;
	white-space:normal; 
}
header{
	width: 940px;
	height: 80px;

}
</style>
</head>

<body>

<div class="container">
	<header>
		<h1>:blibb APIs</h1>

		<p>This page aims to create 2 simple things. Group some documentation about the different API methods 
			and provide a simple way to test every method. </p>
	</header>

	<h2>Blibb</h2>
	<div class="apiMethod">
		<h3>New Blibb <i class="icon-lock"></i></h3>
		<p class="api description authenticated">Creates a new Blibb using the parameters passed by the request <p>
		<p>
			<b>Verb:</b> /blibb <b>Method:</b> [POST]
		</p>
		<p>Parameters:
			<ul>
				<li>bname: name of the new Blibb</li>
				<li>bdesc: description of the new Blibb</li>
				<li>btemplate: template id used to create items for this Blibb</li>
				<li>bkey: user has to be logged in and has to provide his token_key</li>
				<li>bgroup: <span class="optional">[Optional]</span>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>

	<div class="apiMethod">
		<h3>Add User <i class="icon-lock"></i></h3>
		<p class="api description">Adds a user to a Group Blibb <p>
		<p>
			<b>Verb:</b> /blibb/adduser <b>Method:</b> [POST]
		</p>
		<p>Parameters:
			<ul>
				<li>blibb_id: id of the Blibb</li>
				<li>user: username to be added to the group of authors</li>
				<li>bkey: user has to be logged in and has to provide his token_key</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>

	<div class="apiMethod">
		<h3>Get Template</h3>
		<p class="api description">This method returns the Template asociated to a Blibb <p>
		<p>
			<b>Verb:</b> /blibb/<code>blibb_id</code>/template <b>Method:</b> [GET]
		</p>
		<p>Parameters:
			<ul>
				<li>blibb_id: id of the Blibb</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>
	<div class="apiMethod">
		<h3>Get Parameters</h3>
		<p class="api description">This method returns only the attributes specified in the params parameter. 
			This means that if you want to pull just the name, the params is n. If you want to return the name and description n,d<p>
		<p>
			<b>Verb:</b> /blibb/<code>blibb_id</code>/p/<code>params</code> <b>Method:</b> [GET]
		</p>
		<p>Parameters:
			<ul>
				<li>params: id of the Blibb</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>
	<div class="apiMethod">
		<h3>Get View</h3>
		<p class="api description">This method returns the view specified by the parameter<p>
		<p>
			<b>Verb:</b> /blibb/<code>blibb_id</code>/view/<code>view_name</code> <b>Method:</b> [GET]
		</p>
		<p>Parameters:
			<ul>
				<li>blibb_id: id of the Blibb</li>
				<li>view_name: name of the view. There are 3 system views: 'default' | 'mobile' | 'a11y'</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>
	<div class="apiMethod">
		<h3>Get objects by contributor</h3>
		<p class="api description">This method returns all the objects where the user is contributor<p>
		<p>
			<b>Verb:</b> /blibb/<code>user_name</code>/group <b>Method:</b> [GET]
		</p>
		<p>Parameters:
			<ul>
				<li>blibb_id: id of the Blibb</li>
				<li>view_name: name of the view. There are 3 system views: 'default' | 'mobile' | 'a11y'</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>
	<div class="apiMethod">
		<h3>Tag</h3>
		<p class="api description">Tag object<p>
		<p>
			<b>Verb:</b> /blibb/tag <b>Method:</b> [GET]
		</p>
		<p>Parameters:
			<ul>
				<li>blibb_id: id of the Blibb</li>
				<li>bkey: user has to be logged in and has to provide his token_key</li>
				<li>tag: tag</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>
	<div class="apiMethod">
		<h3>Delete</h3>
		<p class="api description">delete object<p>
		<p>
			<b>Verb:</b> /blibb/del <b>Method:</b> [GET]
		</p>
		<p>Parameters:
			<ul>
				<li>b: id of the Blibb</li>
				<li>k: user has to be logged in and has to provide his token_key</li>
			</ul>
		</p>
		<p><a href="#">Test here</a><p>
	</div>
</div>
</body>
</html>