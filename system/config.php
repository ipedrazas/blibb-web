<?php

session_start(); 



require_once(__DIR__.'/lib/lib.php');

require_once(__DIR__.'/classes/common.php');
require_once(__DIR__.'/classes/bmail.php');
require_once(__DIR__.'/classes/Mustache.php');
require_once(__DIR__.'/classes/Mobile_Detect.php');
require_once(__DIR__.'/classes/SimpleImage.php');

require_once(__DIR__.'/../lib/Pest/Pest.php');


require_once('functions.php'); 

$ini_array = parse_ini_file("/var/blibb/blibb.ini",true);

define('REST_API_URL', $ini_array['api_url']);
define('UPLOAD_DIR',$ini_array['upload_dir']);
