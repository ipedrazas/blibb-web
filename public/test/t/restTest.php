<?php
require 'lib/Pest.php';

$pest = new Pest('http://localhost');

$welcome = $pest->get('/api/hello.php?a=Ivan');

echo $welcome;// $welcome;

?>