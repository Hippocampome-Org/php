<?php

$untracked_markers_array = array();
$name_markers = array(
						"CB",
						"CR",
						"PV",
						"CB1",
						"Mus2R",
						"Sub P Rec",
						"5HT-3",
						"GABAa &alpha; 1",	
						"mGluR1a",
						"vGluT3",
						"CCK",
						"ENK",
						"NPY",
						"SOM",
						"VIP",
						"NG",
						"&alpha;-act2",
						"CoupTF II",
						"nNOS",
						"RLN",  
					);

function getSubject_untracked()
{
	global $untracked_markers_array;
	global $name_markers;
	
	$query = "SELECT DISTINCT subject FROM Property WHERE predicate = 'has expression'";
	$rs = mysqli_query($GLOBALS['conn'],$query);
	$n = 20;
	$count = 0;
	while(list($subject) = mysqli_fetch_row($rs))
	{
		// The actual names of these differ in the database
		// Hence using the name that needs to be displayed
		if($subject == "Gaba-a-alpha")
			$subject = "GABAa &alpha; 1";
		else if($subject == "alpha-actinin-2")
			$subject = "&alpha;-act2";
	
		$flag = 0;
		for($i = 0; $i < count($name_markers); $i++)
		{
			// Check if Subject has Tracked Markers
			if(strcmp($name_markers[$i], $subject) == 0)
			{
				$flag = 1;
				$count++;
				break;
			}
		}
		if($flag == 0)
		{
			// Store only the Untracked Markers
			$untracked_markers_array[$n] = $subject;
			$n = $n +1;
		}
	}
}

function part($n, $property)
{
	if ($property == 'Morphology')
	{
		if ($n == 0)
			$part = 'Soma';
		if ($n == 1)
			$part = 'Dendrite';
		if ($n == 2)
			$part = 'Axon';
	}

	if ($property == 'Molecular markers')
	{
		global $name_markers;
		global $untracked_markers_array;

		// For the first 20 use the arrary with Tracked markers
		if($n < 20)
			$part = $name_markers[$n];	
		else
			$part = $untracked_markers_array[$n];
	}

	if ($property == 'Electrophysiology')
	{
		if ($n == 0)
			$part = 'V rest';
		if ($n == 1)
			$part = 'R in';
		if ($n == 2)
			$part = 'tau m';
		if ($n == 3)
			$part = 'V thresh';
		if ($n == 4)
			$part = 'Fast AHP';
		if ($n == 5)
			$part = 'AP ampl';						
		if ($n == 6)
			$part = 'AP width';
		if ($n == 7)
			$part = 'Max F.R.';
		if ($n == 8)
			$part = 'Slow AHP';
		if ($n == 9)
			$part = 'Sag ratio';
	}
	
	if ($property == 'Connectivity')
	{	
		if ($n == 0)
			$part = 'Pre-synaptic input';
		if ($n == 1)
			$part = 'Post-synaptic output';
	}
	
	if ($property == 'Major Neurontransmitter')
	{
		if($n == 0)
			$part = 'GABA';
		if($n == 1)
			$part = 'Glutamate';
	}
	
	return $part;
}
?>