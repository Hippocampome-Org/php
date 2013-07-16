<?php
function property($n)
{
	if ($n == 0)
		$property = 'Morphology';
	if ($n == 1)	
		$property = 'Markers';
	if ($n == 2)
		$property = 'Electrophysiology';
	if ($n == 3)
		$property = 'Connectivity';

	return $property;
}
?>