<?php
	/*
	 * Sylvain MARIEL (sylvain.mariel@otmax.fr)
	 * Conversion nombre à virgule fixe/flottante (v1.4)
	 * Janvier 2013
	 */
	 
	 
	define("PHP_INT_SIZE_OCT", PHP_INT_SIZE*8);
	define("PHP_INT_HALFSIZE_OCT", PHP_INT_SIZE_OCT/2);
	
	function float2fix($nb, $partfrac_len = PHP_INT_HALFSIZE_OCT)
	{
		$nb2display = $nb*pow(2,$partfrac_len); // décalage de X bits vers la gauche pour faire passer la partie fractionnaire en partie entière
		$nb2display = decbin($nb2display);		// transformation d'entier en binaire (si flottant : partie entière seule, d'où le décalage)
		
		// si nb positif, il manquera des '0' devant à cause de "decbin"
		if($nb >= 0)
		{
			$zero2display = (PHP_INT_SIZE_OCT) - strlen($nb2display);		// nombre de zéros à rajouter
			for($i=0;$i<$zero2display;$i++) $nb2display = "0".$nb2display;	// rajouts
		}
		
		$dotPos = PHP_INT_SIZE_OCT - $partfrac_len; 									// recherche de la position de la virgule = taille partie entière
		return substr($nb2display, 0, $dotPos) . "." . substr($nb2display, $dotPos);	// retour de la chaine + virgule
	}



	$theNb = $_GET['nb'];
	$theFracLen = $_GET['frac_len'];
	$theNb = str_replace(",", ".", $theNb);
	
	if(!is_numeric($theNb))			die('<span class="label label-important">Erreur</span> Nombre incorrect');
	if(!is_numeric($theFracLen))	$theFracLen = PHP_INT_HALFSIZE_OCT;

	echo float2fix($theNb, $theFracLen);
	
?>