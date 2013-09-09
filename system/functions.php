<?php


require_once(__DIR__.'/../lib/getid3/getid3.php');


function getUser(){
  if(isset($_SESSION['USER'])){
   return $_SESSION['USER'];
  }
}

function getUserName(){
  $user = getUser();
  if(isset($user->username)){
    return $user->username;
  }
  return '';
}

function getKey(){
  $user = getUser();
  if(isset($user->key)){
    return $user->key;
  }else{
    return '';
  }
}

function isAdmin(){
  $user = getUser();
  if(isset($user->role)){
    $role =  $user->role;
    if($role === 'admin'){
      return true;
    }
  }
  return false;
}

function getUserImage(){
  $user = getUser();
  return $user->image_url;
}

function setUserImage($image){
  $user = getUser();
  $user->image_url = $image;
   $_SESSION['USER'] = $user;
}

function getUserId(){
  $user = getUser();
  return $user->id;
}
// Logs into the user $user
function log_in($k){
    $user = json_decode($k);
    $_SESSION['USER'] = $user;
}


// Returns the currently logged in user (if any)
function current_user(){
  static $current_user = 0;
  if(!$current_user){
    if(isset($_SESSION['USER'])){
      return getUserName();
    }
  }
  return $current_user;
}

function current_user_id(){
  $user = getUser();
  return $user->id;
}

// Requires a current user
function require_login(){
  $user = current_user();
  if(!$user){
    $_SESSION['redirect_to'] = $_SERVER["REQUEST_URI"];
    header("Location: /login?lr=1");
    exit("You must log in.");
  }
  return $user;
}


  function getMP3Tags($filename){
    $getID3 = new getID3;
    $ThisFileInfo = $getID3->analyze($filename);
    $tags['song'] = !empty($ThisFileInfo['id3v2']['comments']['title'][0]) ?  $ThisFileInfo['id3v2']['comments']['title'][0] : 'Unknown';
    $tags['artist'] = !empty($ThisFileInfo['id3v2']['comments']['artist'][0]) ? $ThisFileInfo['id3v2']['comments']['artist'][0] : 'Unknown';
    $tags['album'] = !empty($ThisFileInfo['id3v2']['comments']['album'][0]) ? $ThisFileInfo['id3v2']['comments']['album'][0] : 'Unknown';
    $tags['genre'] = !empty($ThisFileInfo['id3v2']['comments']['genre'][0]) ? $ThisFileInfo['id3v2']['comments']['genre'][0] : 'Unknown';
    $tags['track_number'] = !empty($ThisFileInfo['id3v2']['comments']['track_number'][0]) ? $ThisFileInfo['id3v2']['comments']['track_number'][0] : 'Unknown';
    $tags['year'] = !empty($ThisFileInfo['id3v2']['comments']['year'][0]) ? $ThisFileInfo['id3v2']['comments']['year'][0] : 'Unknown';
    $tags['band'] = !empty($ThisFileInfo['id3v2']['comments']['band'][0]) ? $ThisFileInfo['id3v2']['comments']['band'][0] : 'Unknown';
    $tags['time'] = !empty($ThisFileInfo['playtime_string']) ? $ThisFileInfo['playtime_string'] : 'Unknown';
    $tags['mime_type'] = !empty($ThisFileInfo['mime_type']) ? $ThisFileInfo['mime_type'] : 'Unknown';


    return $tags;
  }

  function analyzeImage($filename){
    $getID3 = new getID3;
    $ThisFileInfo = $getID3->analyze($filename);
    $image['size'] = $ThisFileInfo['filesize'];
    $format = $ThisFileInfo['fileformat'];
    $image['format'] = $format;
    $image['width'] = $ThisFileInfo['video']['resolution_x'];
    $image['height'] = $ThisFileInfo['video']['resolution_y'];
    $image['mime_type'] = $ThisFileInfo['mime_type'];
    if(!empty($ThisFileInfo['tags'][$format]['Software'][0])){
          $image['soft'] = $ThisFileInfo['tags'][$format]['Software'][0];
    }

    return $image;
  }


  function streamMP3($file, $user, $mime_type, $filename){

    if(file_exists($file)){
        header('Content-type: {$mime_type}');
        header('Content-length: ' . filesize($file));
        header('Content-Disposition: filename="' . $filename);
        header('X-Pad: avoid browser bug');
        header('Cache-Control: no-cache');
        readfile($file);
    }else{
        header("HTTP/1.0 404 Not Found");
    }

  }

  /**
 * Modifies a string to remove all non ASCII characters and spaces.
 * @param  string $text The text to slugify
 * @return string       The slugified text
 */
function slugify ($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  // trim
  $text = trim($text, '-');
  // transliterate
  if (function_exists('iconv')) {
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  }
  // lowercase
  $text = strtolower($text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // default output
  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


function renderByType($elem, $type){
  if($type=='3d'){
    if(isset($elem->name)){
      $res = $elem->name;
      if(isset($elem->screen_name)){
        $res .=  ', @' . $elem->screen_name;
      }
      return $res;
    }
  }
  return $elem;
}


function cleanUp($text){
  $text = str_replace('</p>', "\n", $text);
  return json_encode(strip_tags($text, '<a>'));
}
?>
