<?php
function relation($n, $property, $part)
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
	
	if ($property == 'Connectivity')
	{
		if (strpos($part,'input') == true) {
			if ($n == 0)
				$relation = 'potentially from';
			if ($n == 1)
				$relation = 'known to come from';
			if ($n == 2)
				$relation = 'known not to come from';
		}
		elseif (strpos($part,'output') == true) {
			if ($n == 0)
				$relation = 'potentially targeting';
			if ($n == 1)
				$relation = 'known to target';
			if ($n == 2)
				$relation = 'known not to target';
		}	

	}
	
	if ($property == 'Major Neurontransmitter')
	{
		if ($n == 0)
			$relation = 'is expressed';
		if ($n == 1)
			$relation = 'is not expressed';
	}
	
	return $relation;
}
?>