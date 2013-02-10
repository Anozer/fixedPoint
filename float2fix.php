<?php
	/*
	 * Sylvain MARIEL (sylvain.mariel@otmax.fr)
	 * Fixed point/floating point conversion (v1.5)
	 * 2013 February
	 */
	 
	
	
	define("PHP_INT_SIZE_OCT", PHP_INT_SIZE*8);
	define("PHP_INT_HALFSIZE_OCT", PHP_INT_SIZE_OCT/2);
	
	$theNb = $_GET['nb'];
	$theFracLen = $_GET['frac_len'];
	$theNb = str_replace(",", ".", $theNb);
	
	if(!is_numeric($theNb))			die('<span class="label label-important">Erreur</span> Nombre incorrect');
	if(!is_numeric($theFracLen))	$theFracLen = PHP_INT_HALFSIZE_OCT;

	echo float2fix($theNb, $theFracLen);
	
	
	
	// *********************************************************************
	
	function float2fix($nb, $partfrac_len = PHP_INT_HALFSIZE_OCT)
	{
		$nb2display = $nb*pow(2,$partfrac_len); // X bits left shift (*2^X) to move the fract part to integer part
		$nb2display = decbin($nb2display);		// integer binary transformation (if float : decbin only take the integer part...hence the previous shift)
		
		// if the nb is positive, we must add '0' before the number because decbin()
		if($nb >= 0)
		{
			$zero2display = (PHP_INT_SIZE_OCT) - strlen($nb2display);		// number of zeros to add
			for($i=0;$i<$zero2display;$i++) $nb2display = "0".$nb2display;	// adding
		}
		
		$dotPos = PHP_INT_SIZE_OCT - $partfrac_len; 									// searching the point position = fractionnal part size
		return substr($nb2display, 0, $dotPos) . "." . substr($nb2display, $dotPos);	// returning the string + the point character
	}
	
?>