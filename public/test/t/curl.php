 <?php

   $URL = "http://localhost/api/hello.php?a=Ivan";

   $chwnd = curl_init();

   curl_setopt($chwnd, CURLOPT_URL,$URL);
   curl_setopt($chwnd, CURLOPT_VERBOSE, 1);
   curl_setopt($chwnd, CURLOPT_HEADER, TRUE);
   curl_setopt($chwnd, CURLOPT_POST, 0);
   curl_setopt($chwnd, CURLOPT_RETURNTRANSFER,1);
   curl_setopt($chwnd, CURLOPT_CUSTOMREQUEST, 'GET');
   curl_setopt($chwnd, CURLOPT_PROXY, ''); 
   
   $returned = curl_exec($chwnd);

   curl_close ($chwnd);

   echo $returned;

    // code adapted from Tony Spencer

?>