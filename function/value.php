<?php
function value($n, $property, $min, $max)
{
	if ($property == 'Morphology')
	{
		if ($n == 0)
			$value = 'Hippocampal formation'; 
		if ($n == 1)	
			$value = 'DG'; 
		if ($n == 2)
			$value = 'DG:SMo'; 
		if ($n == 3)	
			$value = 'DG:SMi'; 
		if ($n == 4)	
			$value = 'DG:SG';
		if ($n == 5)	 
			$value = 'DG:H'; 
		if ($n == 6)	
			$value = 'CA3'; 
		if ($n == 7)	
			$value = 'CA3:SLM'; 
		if ($n == 8)	
			$value = 'CA3:SR'; 
		if ($n == 9)	
			$value = 'CA3:SL'; 
		if ($n == 10)
			$value = 'CA3:SP'; 
		if ($n == 11)	
			$value = 'CA3:SO';
		if ($n == 12)	
			$value = 'CA2';			 
		if ($n == 13)	
			$value = 'CA2:SLM';
		if ($n == 14)	 
			$value = 'CA2:SR'; 
		if ($n == 15)	
			$value = 'CA2:SP'; 
		if ($n == 16)	
			$value = 'CA2:SO'; 
		if ($n == 17)	
			$value = 'CA1'; 			
		if ($n == 18)	
			$value = 'CA1:SLM'; 
		if ($n == 16)		
			$value = 'CA1:SR';
		if ($n == 19)	
			$value = 'CA1:SP'; 
		if ($n == 20)	
			$value = 'CA1:SO';
		if ($n == 21)	
			$value = 'SUB'; 			
		if ($n == 22)	
			$value = 'SUB:SM'; 
		if ($n == 23)	  	
			$value = 'SUB:SP';
		if ($n == 24)	
			$value = 'SUB:PL';
		if ($n == 25)	
			$value = 'EC';			
		if ($n == 26)	
			$value = 'EC:I';
		if ($n == 27)	
			$value = 'EC:II';
		if ($n == 28)	
			$value = 'EC:III';
		if ($n == 29)	
			$value = 'EC:IV';
		if ($n == 30)	
			$value = 'EC:V';
		if ($n == 31)	
			$value = 'EC:VI';
	}

	if ($property == 'Electrophysiology')
	{
		$dif = $max - $min;
		$var = $dif / 10;
	
		if ($n == 0)
			$value = $min.' mV'; 
		if ($n == 1)	
			$value = $min + $var.' mV'; 
		if ($n == 2)
			$value = $min + (2*$var).' mV';  	
		if ($n == 3)
			$value = $min + (3*$var).' mV'; 
		if ($n == 4)	
			$value = $min + (4*$var).' mV'; 
		if ($n == 5)
			$value = $min + (5*$var).' mV'; 					
		if ($n == 6)
			$value = $min + (6*$var).' mV'; 
		if ($n == 7)	
			$value = $min + (7*$var).' mV'; 
		if ($n == 8)
			$value = $min + (8*$var).' mV';
		if ($n == 9)
			$value = $min + (9*$var).' mV'; 
		if ($n == 10)	
			$value = $max.' mV'; 										
	}
	
	return $value;

}

// STM this is used on the ephys search page to generate
// electrophysiology values with the correct unit

function value_ephys($n, $property, $min, $max, $unit) {	
  $range = $max - $min;
  $step = $range / 10.;
  $value = ($min + $n * $step) . $unit;
  return $value;
}

?>
