<?php


require_once(__DIR__.'/../../system/config.php');


    $mp3 = "/home/ivan/Downloads/01_-_Sweet_Child_O'_Mine.mp3"; //The mp3 file.


 // Initialize getID3 engine
    $getID3 = new getID3;
    // Analyze file and store returned data in $ThisFileInfo
    $ThisFileInfo = $getID3->analyze($mp3);


	// getid3_lib::CopyTagsToComments($ThisFileInfo);

    $tags['song'] = $ThisFileInfo['id3v2']['comments']['title'][0];
    $tags['artist'] = $ThisFileInfo['id3v2']['comments']['artist'][0];
    $tags['album'] = $ThisFileInfo['id3v2']['comments']['album'][0];
    $tags['genre'] = $ThisFileInfo['id3v2']['comments']['genre'][0];
    $tags['track_number'] = $ThisFileInfo['id3v2']['comments']['track_number'][0];
    $tags['year'] = $ThisFileInfo['id3v2']['comments']['year'][0];
    $tags['band'] = $ThisFileInfo['id3v2']['comments']['band'][0];
	$tags['time'] = $ThisFileInfo['playtime_string'];
    
    print_r($tags);


?>