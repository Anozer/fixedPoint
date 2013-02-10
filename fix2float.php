<?php
	/*
	 * Sylvain MARIEL (sylvain.mariel@otmax.fr)
	 * Fixed point/floating point conversion (v1.5)
	 * 2013 February
	 */
	
	
	$theNb = $_GET['nb'];
	$theNb = str_replace(",", ".", $theNb);
	
	if(!is_numeric($theNb)) die('<span class="label label-important">Erreur</span> Nombre incorrect');
	
	echo fix2float($theNb);
	
	
	
	
	// ********************************************************************
		
	// positive number conversion (signed ot unsigned)
	function fix2float_pos($binary_str)
	{
		$fracLen = strlen($binary_str) - strpos($binary_str, ".") - 1;			// fractional part size, point search
		return bindec(str_replace(".", "", $binary_str)) * pow(2,-$fracLen);	// X bits right shift (*2^-X) to find the fract part
	}
	
	// negative number conversion (signed)
	function fix2float_neg($binary_str)
	{
		// principle : find the absolute value then add a "-" (ascii character)

		$fracLen = strlen($binary_str) - strpos($binary_str, ".") - 1;	// fractional part size, point search
		$binary_str = str_replace(".", "", $binary_str);				// we remove the point char to get a beautiful binary number, with no fractional part
		
		// Two's complement : inverting
		$binary_str = str_replace("1", "2", $binary_str);
		$binary_str = str_replace("0", "1", $binary_str);
		$binary_str = str_replace("2", "0", $binary_str);
		// Two's complement : +1, then conversion
		$binary_nb = bindec($binary_str) + 1;
		
		// right shift to find the fract part
		$binary_nb = $binary_nb * pow(2,-$fracLen);
		
		return "-".$binary_nb;
	}
	
	// converting according to the sign bit
	function fix2float($binary_str)
	{
		// if the first bit of the string is '0' => positive, else negative
		if(substr($binary_str, 0, 1) == "0")	return fix2float_pos($binary_str);
		else									return fix2float_neg($binary_str);
	}
	

?>