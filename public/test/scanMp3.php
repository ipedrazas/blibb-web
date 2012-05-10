<?php


// This test ha to prove that we can upload mp3s to a Blibb


     $mp3 = "/home/ivan/Downloads/01_-_Sweet_Child_O'_Mine.mp3"; //The mp3 file.
 
     $filesize = filesize($mp3);
     $file = fopen($mp3, "r");

     fseek($file, -128, SEEK_END); // It reads the 
     
     $tag = fread($file, 3);
     
     if($tag == "TAG")
     {
         $data["song"] = trim(fread($file, 30));
         $data["artist"] = trim(fread($file, 30));
         $data["album"] = trim(fread($file, 30));
         $data["year"] = trim(fread($file, 4));
         $data["comment"] = trim(fread($file, 30));
         $data["genre"] = trim(fread($file, 1));
         
     }
     else
         die("MP3 file does not have any ID3 tag!");
     
     fclose($file);

     while(list($key, $value) = each($data))
     {
         print("$key: $value<br>\r\n");    
     }



 ?>    
