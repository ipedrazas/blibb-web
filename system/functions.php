<?php


require_once(__DIR__.'/../lib/getid3/getid3.php');



function getKey(){
  $redis = new Predis\Client();
  return $redis->get(session_id());
}

function getUserName(){
  $redis = new Predis\Client();
  return $redis->get(getKey().':name');
}

function getUserImage(){
  $redis = new Predis\Client();
  return $redis->get(getKey().':thumbnail');
}

function getUserId(){
  $redis = new Predis\Client();
  return $redis->get(getKey().':id');
}
// Logs into the user $user
function log_in($user_id, $user_name){

  $redis = new Predis\Client();
  $userkey = hash('sha1', $user_name . $user_id . time());
  $expire = 3600;

  $redis->set(session_id(),$userkey);
  $redis->set($userkey,$user_name);
  
  $basekey = $userkey . ':';
  $namekey = $basekey.'name';
  $imagekey = $basekey.'thumbnail';
  $idkey = $basekey.'id';
//http://localhost/img/60x60.gif
  $redis->set($namekey, $user_name);
  $redis->set($imagekey, $user_name);
  $redis->set($idkey, $user_id);

  $redis->expire($userkey,$expire);
  $redis->expire($namekey,$expire);
  $redis->expire($imagekey,$expire);
  $redis->expire($idkey,$expire);

  $_SESSION['user_id'] = $user_id;
  $_SESSION['user_name'] = $user_name;
  $_SESSION['user_key'] =  $userkey;
}


// Returns the currently logged in user (if any)
function current_user(){
  static $current_user;
  
  if(!$current_user){
    if(isset($_SESSION['user_name'])){
      return $_SESSION['user_name'];
    }
    if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
      $u = Dbo::findOne('User', array('_id' => $user_id));
      if(strlen($u->n)>0){
        return $u->n;
      }
    }
  }
  return $current_user;
}

function current_user_id(){
  if(isset($_SESSION['user_id'])){
      return $_SESSION['user_id'];
    }
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


?>