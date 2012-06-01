<?php

session_start(); 

require_once('Db.php'); 
require_once('Dbo.php'); 

require_once(__DIR__.'/classes/blb.php'); 
require_once(__DIR__.'/classes/template.php');
require_once(__DIR__.'/classes/item.php');
require_once(__DIR__.'/classes/user.php');
require_once(__DIR__.'/classes/audit.php');
require_once(__DIR__.'/classes/comment.php');
require_once(__DIR__.'/classes/userPage.php');


require_once(__DIR__.'/classes/follow.php');
require_once(__DIR__.'/classes/like.php');
require_once(__DIR__.'/classes/tag.php');

require_once(__DIR__.'/lib/lib.php');

require_once(__DIR__.'/classes/common.php');
require_once(__DIR__.'/classes/bmail.php');
require_once(__DIR__.'/classes/Mustache.php');
require_once(__DIR__.'/classes/Mobile_Detect.php');
require_once(__DIR__.'/classes/SimpleImage.php');

require_once(__DIR__.'/../lib/Pest/Pest.php');
require 'Predis/Autoloader.php';

Predis\Autoloader::register();

require_once('functions.php'); 

$mongo = new Mongo(); 
 
define('MONGODB_NAME', 'blibb'); 
define('REST_API_URL', 'http://api.' . $_SERVER['SERVER_NAME']);
define('UPLOAD_DIR','/home/blibb_web/shared/media');


Dbo::addClass('Blb', 'blibbs'); // class, collection
Dbo::addClass('Template', 'templates');
Dbo::addClass('Item', 'items');
Dbo::addClass('User', 'users');
Dbo::addClass('Comment', 'comments');
Dbo::addClass('UserPage', 'userpages');
Dbo::addClass('Picture', 'pictures'); 
Dbo::addClass('Follow', 'follows'); 
Dbo::addClass('Like', 'likes'); 
Dbo::addClass('Tag', 'tags'); 