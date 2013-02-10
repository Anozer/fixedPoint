<?php
	/*
	 * Sylvain MARIEL (sylvain.mariel@otmax.fr)
	 * Conversion nombre à virgule fixe/flottante (v1.4)
	 * Janvier 2013
	 */
	
	
	// conversion d'un nombre positif (signé ou non signé)
	function fix2float_pos($binary_str)
	{
		$fracLen = strlen($binary_str) - strpos($binary_str, ".") - 1;			// taille de la partie fractionnaire, recherche de la virgule
		return bindec(str_replace(".", "", $binary_str)) * pow(2,-$fracLen);	// décallage de X bits vers la droite (*2^-X) pour retrouver la partie fractionnaire
	}
	
	// conversion d'un nombre négatif (signé)
	function fix2float_neg($binary_str)
	{
		// principe : trouver la valeur absolu et rajouter un "-"

		$fracLen = strlen($binary_str) - strpos($binary_str, ".") - 1;	// taille de la partie fractionnaire
		$binary_str = str_replace(".", "", $binary_str);				// on enlève la virgule pour avoir un joli nombre binaire sans partie fractionnaire
		
		// complément à 2 : inversion
		$binary_str = str_replace("1", "2", $binary_str);
		$binary_str = str_replace("0", "1", $binary_str);
		$binary_str = str_replace("2", "0", $binary_str);
		// complément à 2 : +1, et conversion
		$binary_nb = bindec($binary_str) + 1;
		
		// décallage vers la droite pour retrouver la partie fractionnaire
		$binary_nb = $binary_nb * pow(2,-$fracLen);
		
		return "-".$binary_nb;
	}
	
	// conversion en fonction du bit de signe
	function fix2float($binary_str)
	{
		// si 1er bit de la chaine est '0' => positif
		if(substr($binary_str, 0, 1) == "0")	return fix2float_pos($binary_str);
		else									return fix2float_neg($binary_str);
	}
	
	
	
	$theNb = $_GET['nb'];
	$theNb = str_replace(",", ".", $theNb);
	
	if(!is_numeric($theNb)) die('<span class="label label-important">Erreur</span> Nombre incorrect');
	
	echo fix2float($theNb);

?>