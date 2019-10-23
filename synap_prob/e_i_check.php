<?php
	//function e_i_check($parcel, $neuron, $p_g, $e_neurons, $i_neurons) {
	function e_i_check($parcel, $neuron) {
		$p_g = array("DG", "CA3", "CA2", "CA1", "Sub", "EC");
		$e_neurons = array(
			array('Granule','Hilar Ectopic Granule','Semilunar Granule','Mossy','Mossy MOLDEN'),
			array('CA3 Pyramidal','CA3c Pyramidal','CA3 Giant','CA3 Granule'),
			array('CA2 Pyramidal'),
			array('CA1 Pyramidal','Cajal-Retzius','CA1 Radiatum Giant'),
			array('SUB EC-Proj Pyramidal','SUB CA1-Proj Pyramidal'),
			array('LI-II Multipolar-Pyramidal','LI-II Pyramidal-Fan', 'MEC LII-III PC-Multiform', 'MEC LII Oblique Pyramidal', 'MEC LII Stellate', 'LII-III Pyramidal-Tripolar', 'LEC LIII Multipolar Principal', 'MEC LIII Multipolar Principal', 'LIII Pyramidal', 'LEC LIII Complex Pyramidal', 'MEC LIII Complex Pyramidal', 'MEC LIII BP Cmplx PC', 'LIII Pyramidal-Stellate', 'LIII Stellate', 'LIII-V Bipolar Pyramidal', 'LIV-V Pyramidal-Horiz', 'LIV-VI Deep Multipolar', 'MEC LV Multipolar-PC', 'LV Deep Pyramidal', 'MEC LV Pyramidal', 'MEC LV Superficial PC', 'MEC LV-VI PC-Polymorph', 'LEC LVI Multipolar-PC')
		);
		$i_neurons = array(
			array('AIPRIM','DG Axo-Axonic','DG Basket','DG BC CCK+','HICAP','HIPP','HIPROM','MOCAP','MOLAX','MOPP','DG Neurogliaform','Outer Molecular Layer','Total Molecular Layer'),
			array('CA3 Axo-Axonic', 'CA3 Horizontal AA', 'CA3 Basket', 'CA3 BC CCK+', 'CA3 Bistratified', 'CA3 IS Oriens', 'CA3 Interneuron Specific Quad', 'CA3 Ivy', 'CA3 LMR-Targeting', 'Lucidum LAX', 'Lucidum ORAX', 'Lucidum-Radiatum', 'Spiny Lucidum', 'Mossy Fiber-Associated', 'MFA ORDEN', 'CA3 O-LM', 'CA3 QuadD-LM', 'CA3 Radiatum', 'CA3 R-LM', 'CA3 SO-SO', 'CA3 Trilaminar'),
			array('CA2 Basket','CA2 Wide-Arbor BC','CA2 Bistratified','CA2 SP-SR'),
			array('CA1 Axo-Axonic', 'CA1 Horizontal AA', 'CA1 Back-Projection', 'CA1 Basket', 'CA1 BC CCK+', 'CA1 Horizontal BC', 'CA1 Bistratified', 'CA1 IS LMO-O', 'CA1 IS LM-R', 'CA1 IS LMR-R', 'CA1 IS O-R', 'CA1 IS O-Target QuadD', 'CA1 IS R-O', 'CA1 IS RO-O', 'CA1 Ivy', 'CA1 LMR', 'CA1 LMR Projecting', 'CA1 Neurogliaform', 'CA1 NGF Projecting', 'CA1 O-LM', 'CA1 Recurrent O-LM', 'CA1 O-LMR', 'CA1 Oriens/Alveus', 'CA1 Oriens-Bistratified', 'CA1 O-Bistrat Projecting', 'CA1 OR-LM', 'CA1 Perforant Path-Assoc', 'CA1 PPA QuadD', 'CA1 Quadrilaminar', 'CA1 Radiatum', 'CA1 R-Recv Apical-Target', 'Schaffer Collateral-Assoc', 'SCR R-Targeting', 'CA1 SO-SO', 'CA1 Hipp-SUB Proj ENK+', 'CA1 Trilaminar', 'CA1 Radial Trilaminar'),
			array('SUB Axo-axonic'),
			array('LII Axo-Axonic','MEC LII Basket','LII Basket Multipolar Interneuron','LEC LIII Multipolar Interneuron','MEC LIII Multipolar Interneuron','MEC LIII Superficial MPI','LIII Pyramidal-Looking Interneuron','MEC LIII Superficial Trilayered Interneuron')
		);

		$output = $neuron;
		//$output = ($neuron==$i_neurons[0][6]).' '.$neuron.sizeof($p_g).sizeof($i_neurons);
		// return e or i coloring and link
		$p_n=0;
		for ($i=0;$i<sizeof($p_g);$i++) {
			if ($parcel == $p_g[$i]) {
				$p_n = $i;
			}
		}
		//for ($i=0;$i<count($e_neurons[$p_n]);$i++) {
		for ($i=0;$i<sizeof($p_g);$i++) {
			for ($j=0;$j<sizeof($e_neurons[$i]);$j++) {
				//if (!strcmp($neuron,$e_neurons[$i][$j])) {
				if ($neuron==$e_neurons[$i][$j]) {
					$output = "<font class='excite_green'>".$neuron."</font>";
				}
			}
		}
		//for ($i=0;$i<count($i_neurons[$p_n]);$i++) {
		for ($i=0;$i<sizeof($p_g);$i++) {
			for ($j=0;$j<sizeof($i_neurons[$i]);$j++) {
				//if (!strcmp($neuron,$i_neurons[$i][$j])) {
				if ($neuron==$i_neurons[$i][$j]) {
					$output = "<font class='inhib_red'>".$neuron."</font>";
				}
			}
		}

		return $output;
	}
?>