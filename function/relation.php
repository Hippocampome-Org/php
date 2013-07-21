<?php
function relation($n, $property)
{
	if ($property == 'Morphology')
	{
		if ($n == 0)
			$relation = 'is found in';
		if ($n == 1)
			$relation = 'is not found in';
	}

	if ($property == 'Molecular markers')
	{
		if ($n == 0)
			$relation = 'is expressed';
		if ($n == 1)
			$relation = 'is not expressed';		
		if ($n == 2)
			$relation = 'unknown';									
	}

	if ($property == 'Electrophysiology')
	{
		if ($n == 0)
			$relation = '=';
		if ($n == 1)
			$relation = '<';		
		if ($n == 2)
			$relation = '<=';
		if ($n == 3)
			$relation = '>';
		if ($n == 4)
			$relation = '>=';
	}
	
	return $relation;
}
?>