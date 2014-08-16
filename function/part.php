<?php
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
		if ($n == 0)
			$part = 'CB';
		if ($n == 1)
			$part = 'CR';
		if ($n == 2)
			$part = 'CCK';
		if ($n == 3)
			$part = 'nNOS';
		if ($n == 4)
			$part = 'NPY';
		if ($n == 5)
			$part = 'PV';						
		if ($n == 6)
			$part = 'SOM';
		if ($n == 7)
			$part = 'VIP';
		if ($n == 8)
			$part = 'CB1';
		if ($n == 9)
			$part = 'ENK';
		if ($n == 10)
			$part = 'GABAa-&alpha;';
		if ($n == 11)
			$part = 'Mus2R';			
		if ($n == 12)
			$part = 'sub P';
		if ($n == 13)
			$part = 'vGluT3';
		if ($n == 14)
			$part = 'CoupTF II';
		if ($n == 15)
			$part = '5HT-3';
		if ($n == 16)
			$part = 'RLN';
		if ($n == 17)
			$part = '&alpha;-act2';	
		if ($n == 18)
			$part = 'ChAT';
		if ($n == 19)
			$part = 'DYN';			
		if ($n == 20)
			$part = 'EAAT3';
		if ($n == 21)
			$part = 'GlyT2';
		if ($n == 22)
			$part = 'mGluR1a';
		if ($n == 23)
			$part = 'mGluR7a';
		if ($n == 24)
			$part = 'mGluR8a';
		if ($n == 25)
			$part = 'MOR';		
		if ($n == 26)
			$part = 'NKB';	
		if ($n == 27)
			$part = 'NK1';
		if ($n == 28)
			$part = 'PPTA';			
		if ($n == 29)
			$part = 'PPTB';
		if ($n == 30)
			$part = 'vAChT';
		if ($n == 31)
			$part = 'VIAAT';	
		if ($n == 32)
			$part = 'vGluT2';						
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