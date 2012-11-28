<?php
/*

	I'm trying to find our what is the num of followers ceiling. Blibbs and Items contain followers's name. The biggest issue is that we can hit a relative small maximum.
	Let's find out!

	Max Followers ~ 500K <-- Not good to have follower names in objects. 

*/


require_once(__DIR__.'/../../system/config.php');


	$b = new Blb();

	$b->n = 'Soy un Blibb';
	$b->d = 'Para jugar y comprar';
	$b->u = 'ipedrazas';
	$b->c = new DateTime('now');
	$b->o = $opts;
	$b->t= $t;

	$followers = array();

	for ($i=0; $i <559800; $i++) { 
		$followers[] = 'follower_#'.$i;
	}
	echo $i . '<br>';

	$b->f = $followers;

	Dbo::save($b);

?>