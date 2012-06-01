<?php

session_start(); 



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

define('REST_API_URL', 'http://api.' . $_SERVER['SERVER_NAME']);
define('UPLOAD_DIR','/home/blibb_web/shared/media');
