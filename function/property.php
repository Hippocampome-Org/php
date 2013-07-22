<?php
function property($n)
{
	if ($n == 0)
		$property = 'Morphology';
	if ($n == 1)	
		$property = 'Molecular markers';
	if ($n == 2)
		$property = 'Electrophysiology';

	return $property;
}
?>