<?php




//$n_markers = 36;
$n_markers = 99;
$n_columns = $n_markers + 3;


// Name in alphabetic order for MARKERS: ************************************
$name_markers = array(
		"0"=>"CB",
		"1"=>"CR",
		"2"=>"PV",		
		"3"=>"5HT_3",
		"4"=>"CB1",
		"5"=>"GABAa_alfa",
		"6"=>"mGluR1a",
		"7"=>"Mus2R",
		"8"=>"Sub_P_Rec",		
		"9"=>"vGluT3",		
		"10"=>"CCK",
		"11"=>"ENK",
		"12"=>"NG",
		"13"=>"NPY",
		"14"=>"SOM",
		"15"=>"VIP",		
		"16"=>"a-act2",
		"17"=>"CoupTF_2",
		"18"=>"nNOS",
		"19"=>"RLN",		
		"20"=>"AChE",
		"21"=>"AMIGO2",
		"22"=>"AR-beta1",
		"23"=>"AR-beta2",
		"24"=>"BDNF",
		"25"=>"Bok",
		"26"=>"Caln",
		"27"=>"CaM",
		"28"=>"CGRP",
		"29"=>"ChAT",
		"30"=>"Chrna2",
		"31"=>"CRF",
		"32"=>"Ctip2",
		"33"=>"Cx36",
		"34"=>"CXCR4",
		"35"=>"Disc1",
		"36"=>"DYN",
		"37"=>"EAAT3",
		"38"=>"ErbB4",				
		"39"=>"GABAa_alpha2",
		"40"=>"GABAa_alpha3",
		"41"=>"GABAa_alpha4",
		"42"=>"GABAa_alpha5",
		"43"=>"GABAa_alpha6",
		"44"=>"GABAa_beta1",
		"45"=>"GABAa_beta2",
		"46"=>"GABAa_beta3",
		"47"=>"GABAa_delta",
		"48"=>"GABAa_gamma1",
		"49"=>"GABAa_gamma2",
		"50"=>"GABA-B1",
		"51"=>"GAT_1",
		"52"=>"GAT-3",
		"53"=>"GluA1",
		"54"=>"GluA2",
		"55"=>"GluA2_3",
		"56"=>"GluA3",
		"57"=>"GluA4",
		"58"=>"GlyT2",
		"59"=>"Id_2",
		"60"=>"Kv3_1",
		"61"=>"Man1a",
		"62"=>"Math-2",
		"63"=>"mGluR1",
		"64"=>"mGluR2",
		"65"=>"mGluR2_3",
		"66"=>"mGluR3",
		"67"=>"mGluR4",
		"68"=>"mGluR5",
		"69"=>"mGluR5a",
		"70"=>"mGluR7a",
		"71"=>"mGluR8a",
		"72"=>"MOR",
		"73"=>"Mus1R",
		"74"=>"Mus3R",
		"75"=>"Mus4R",
		"76"=>"NECAB1",
		"77"=>"Neuropilin2",
		"78"=>"NKB",
		"79"=>"p-CREB",
		"80"=>"PCP4",
		"81"=>"PPE",
		"82"=>"PPTA",
		"83"=>"Prox1",
		"84"=>"PSA-NCAM",
		"85"=>"SATB1",
		"86"=>"SATB2",
		"87"=>"SCIP",
		"88"=>"SPO",
		"89"=>"SubP",
		"90"=>"TH",
		"91"=>"vAChT",
		"92"=>"vGAT",
		"93"=>"vGlut1",
		"94"=>"vGluT2",
		"95"=>"VILIP",
		"96"=>"Wfs1",
		"97"=>"Y1",
		"98"=>"Y2"
);




function remap_marker_names($old_name) {
	$new_name = $old_name;

	if (strpos($old_name, 'Gaba-a') == 'TRUE')
		$new_name = 'GABAa_alfa';
	elseif (strpos($old_name, 'CoupTF') == 'TRUE')
		$new_name = 'CoupTF_2';
	else;	

	if ($old_name == 'Sub P Rec')
		$new_name = 'Sub_P_Rec';
	elseif ($old_name == '5HT-3')
		$new_name = '5HT_3';
	elseif ($old_name == 'alpha-actinin-2')
		$new_name = 'a-act2';
	elseif ($old_name == 'GAT-1')
		$new_name = 'GAT_1';
	elseif ($old_name == 'mGluR2/3')
		$new_name = 'mGluR2_3';
	elseif ($old_name == 'Kv3_1')
		$new_name = 'Kv3.1';
	elseif ($old_name == 'GluA2/3')
		$new_name = 'GluA2_3';
	elseif ($old_name == 'Id_2')
		$new_name = 'Id-2';
	elseif ($old_name == 'GABAa_delta')
		$new_name = 'GABAa \delta';
	elseif($old_name == "GABAa_alpha2")
		$new_name = "GABAa\alpha 2";
	elseif($old_name == "GABAa_alpha3")
		$new_name = "GABAa\alpha 3";
	elseif($old_name == "GABAa_alpha4")
		$new_name = "GABAa\alpha 4";
	elseif($old_name == "GABAa_alpha5")
		$new_name = "GABAa\alpha 5";
	elseif($old_name == "GABAa_alpha6")
		$new_name = "GABAa\alpha 6";
	elseif($old_name == "GABAa_beta1")
		$new_name = "GABAa\beta 1";
	elseif($old_name == "GABAa_beta2")
		$new_name = "GABAa\beta 2";
	elseif($old_name == "GABAa_beta3")
		$new_name = "GABAa\beta 3";
	elseif($old_name == "GABAa_gamma1")
		$new_name = "GABAa\gamma 1";
	elseif($old_name == "GABAa_gamma2")
		$new_name = "GABAa\gamma 2";
	elseif($old_name == "SubP")
		$new_name = "Sub P";

	/*elseif ($old_name == 'GABAa \delta')
		$new_name = '?';
	elseif ($old_name == 'GABAa\alpha 2')
		$new_name = '?';
	elseif ($old_name == 'GABAa\alpha 3')
		$new_name = '?';
	elseif ($old_name == 'GABAa\alpha 4')
		$new_name = '?';
	elseif ($old_name == 'GABAa\alpha 5')
		$new_name = '?';
	elseif ($old_name == 'GABAa\alpha 6')
		$new_name = '?';
	elseif ($old_name == 'GABAa\beta 1')
		$new_name = '?';
	elseif ($old_name == 'GABAa\beta 2')
		$new_name = '?';
	elseif ($old_name == 'GABAa\beta 3')
		$new_name = '?';
	elseif ($old_name == 'GABAa\gamma 1')
		$new_name = '?';
	elseif ($old_name == 'GABAa\gamma 2')
		$new_name = '?';*/
	elseif (strpos($old_name,"'_'") !== false)
		$new_name = str_replace("'_'", "_", $old_name);

	return $new_name;
}


// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel) // $id = type_id,$id_property = propert_id,
{
	//echo " Type id: ".$id." Property Id : ".$id_property;
	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}


function check_color($variable, $unvetted, $conflict_note,$permission)
{


	
	
	// Check the conflict_note:
	if ($conflict_note == "subtypes")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive-negative-subtypes_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive-negative-subtypes.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "species/protocol differences")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive-negative-species_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive-negative-species.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "subcellular expression differences")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive-negative-subcellular_unvetted.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/positive-negative-subcellular.png' border='0' width='15px' />";
	}
	elseif (($conflict_note == "conflicting data") || ($conflict_note == "unresolved"))
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive-negative-conflicting_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive-negative-conflicting.png' border='0' width='15px' />";
	}
	
	
	elseif ($conflict_note == "positive")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "negative")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/negative_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/negative.png' border='0' width='15px' />";
	}
	
	
	elseif ($conflict_note == "confirmed positive")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_confirmed_unvetted.png' border='0' width='15px' />";
		else
		{	
			if($permission!=1)
				$link[0] = "<img src='images/marker/positive_confirmed.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/positive.png' border='0' width='15px' />";
		}
	}
	elseif ($conflict_note == "confirmed negative")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/negative_confirmed_unvetted.png' border='0' width='15px' />";
		else
		{
			if($permission!=1)	
				$link[0] = "<img src='images/marker/negative_confirmed.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/negative.png' border='0' width='15px' />";
		}
	}
	
	
	elseif ($conflict_note == "positive inference")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_inference_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive_inference.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "negative inference")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/negative_inference_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/negative_inference.png' border='0' width='15px' />";
	}
	
	
	elseif ($conflict_note == "confirmed positive inference")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_inference_confirmed_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive_inference_confirmed.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "confirmed negative inference")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/negative_inference_confirmed_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/negative_inference_confirmed.png' border='0' width='15px' />";
	}
	
	
	elseif ($conflict_note == "positive; negative inference")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive-negative_inference_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive-negative_inference.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "positive inference; negative")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_inference-negative_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive_inference-negative.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "positive inference; negative inference" || $conflict_note == "inferential subtypes")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_inference-negative_inference-subtypes_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive_inference-negative_inference-subtypes.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "unresolved inferential conflict")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_inference-negative_inference-unresolved_unvetted.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/positive_inference-negative_inference-unresolved.png' border='0' width='15px' />";
	}
	elseif ($conflict_note == "species/protocol inferential conflict")
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_inference-negative_inference-species_unvetted.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/positive_inference-negative_inference-species.png' border='0' width='15px' />";
	}
	else {
		$link[0] = "<img src='images/marker/negative_positive_unvetted.png' border='0' width='15px' />";
	}

	$link[1] = $variable;



	if ($variable == 'unknown')
	{
		$link[0] = "<img src='images/unknown.png' border='0' width='15px' />";
		$link[1] = NULL;
	}

	if ($variable == 'nothing')
	{
		$link[0] = "<img src='images/nothing.png' border='0' width='15px'/>";
		$link[1] = NULL;
	}

	return ($link);
}


function determinePosNegCombosForAllMarkers($name_markers, $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_positive_inference, $hippo_negative_inference, $hippo_unknown) {
	for ($m1=0; $m1<count($name_markers); $m1++) {
		$remapped_part = remap_marker_names($name_markers[$m1]);
		$hippo_property[$name_markers[$m1]] = check_positive_negative($remapped_part, $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_positive_inference, $hippo_negative_inference, $hippo_unknown);
	}
	return $hippo_property;
}


function check_positive_negative($variable, $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_positive_inference, $hippo_negative_inference, $hippo_unknown)
{
	$variable = remap_marker_names($variable);
	
	if (($hippo_unknown[$variable]==1) && ($hippo_positive[$variable]!=1) && ($hippo_negative[$variable]!=1) && ($hippo_weak_positive[$variable]!=1) && ($hippo_positive_inference[$variable]!=1) && ($hippo_negative_inference[$variable]!=1))
		$result = 'unknown';
	else
	{
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-negative-weak_positive-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-negative-weak_positive-positive_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-negative-weak_positive-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-negative-weak_positive';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-negative-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-negative-positive_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-negative-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-negative';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-weak_positive-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-weak_positive-positive_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-weak_positive-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-weak_positive';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive-positive_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive-negative_inference';
		if (($hippo_positive[$variable]==1) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'negative-weak_positive-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'negative-weak_positive-positive_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'negative-weak_positive-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'negative-weak_positive';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'negative-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'negative-positive_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'negative-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==1) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'negative';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'weak_positive-positive_inference-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'weak_positive-positive_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'weak_positive-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==1) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'weak_positive';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'positive_inference-negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==1 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'positive_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==1))
			$result = 'negative_inference';
		if (($hippo_positive[$variable]==0) && ($hippo_negative[$variable]==0) && ($hippo_weak_positive[$variable]==0) && ($hippo_positive_inference[$variable]==0 ) && ($hippo_negative_inference[$variable]==0))
			$result = 'nothing';
	}
	return ($result);
}


function getUrlForLink($id,$img,$key,$color1)
{
	$url = $img;
	if($img!='') {
		if($key=="GABAa_alfa")
			$keyProperty = "Gaba-a-alpha";
		elseif($key=="CoupTF_2")
			$keyProperty = "CoupTF II";
		elseif($key=="Sub_P_Rec")
			$keyProperty = "Sub P Rec";
		elseif($key=="5HT_3")
			$keyProperty = "5HT-3";
		elseif($key=="a-act2")
			$keyProperty = "alpha-actinin-2";
		elseif($key=="GAT_1")
			$keyProperty = "GAT-1";
		elseif($key=="mGluR2_3")
			$keyProperty = "mGluR2/3";
		elseif($key=="GluA2_3")
			$keyProperty = "GluA2/3";
		elseif($key=="Kv3_1")
			$keyProperty = "Kv3.1";
		elseif($key=="Id_2")
			$keyProperty = "Id-2";
		elseif($key=="GABAa_delta")
			$keyProperty = "GABAa \delta";
		elseif($key=="GABAa_alpha2")
			$keyProperty = "GABAa\alpha 2";
		elseif($key=="GABAa_alpha3")
			$keyProperty = "GABAa\alpha 3";
		elseif($key=="GABAa_alpha4")
			$keyProperty = "GABAa\alpha 4";
		elseif($key=="GABAa_alpha5")
			$keyProperty = "GABAa\alpha 5";
		elseif($key=="GABAa_alpha6")
			$keyProperty = "GABAa\alpha 6";
		elseif($key=="GABAa_beta1")
			$keyProperty = "GABAa\beta 1";
		elseif($key=="GABAa_beta2")
			$keyProperty = "GABAa\beta 2";
		elseif($key=="GABAa_beta3")
			$keyProperty = "GABAa\beta 3";
		elseif($key=="GABAa_gamma1")
			$keyProperty = "GABAa\gamma 1";
		elseif($key=="GABAa_gamma2")
			$keyProperty = "GABAa\gamma 2";
		elseif($key=="SubP")
			$keyProperty = "Sub P";
		else
			$keyProperty = $key;

		if($color1!=NULL)
			$url ='<a href="property_page_markers.php?id_neuron='.$id.'&val_property='.$keyProperty.'&color='.$color1.'&page=markers" target="_blank">'.$img.'</a>';
	}
	return ($url);
}


function getUrlText($id,$key,$color1)
{
	if($key=="GABAa_alfa")
		$keyProperty = "Gaba-a-alpha";
	elseif($key=="CoupTF_2")
		$keyProperty = "CoupTF II";
	elseif($key=="Sub_P_Rec")
		$keyProperty = "Sub P Rec";
	elseif($key=="5HT_3")
		$keyProperty = "5HT-3";
	elseif($key=="a-act2")
		$keyProperty = "alpha-actinin-2";
	elseif($key=="GAT_1")
		$keyProperty = "GAT-1";
	elseif($key=="mGluR2_3")
		$keyProperty = "mGluR2/3";
	elseif($key=="GluA2_3")
		$keyProperty = "GluA2/3";
	elseif($key=="Kv3_1")
		$keyProperty = "Kv3.1";
	elseif($key=="Id_2")
		$keyProperty = "Id-2";
	elseif($key=="GABAa_delta")
		$keyProperty = "GABAa\delta";
	elseif(strpos($key,"'\'") !== false)
		$keyProperty = str_replace("'\'", "_", $key);
	else
		$keyProperty = $key;

	if($color1!=NULL)
		$url_text = '<a href="property_page_markers.php?id_neuron='.$id.'&val_property='.$keyProperty.'&color='.$color1.'&page=markers"';
	else
		$url_text = NULL;

	return ($url_text);
}


function remap_temp_table_names ($old_name) {
	
	if ($old_name == 'positive-negative-weak_positive-positive_inference-negative_inference') { $new_name = 'pos_neg_weak_posInf_negInf'; }
	elseif ($old_name == 'positive-negative-weak_positive-positive_inference') { $new_name = 'pos_neg_weak_posInf'; }
	elseif ($old_name == 'positive-negative-weak_positive-negative_inference') { $new_name = 'pos_neg_weak_negInf'; }
	elseif ($old_name == 'positive-negative-weak_positive') { $new_name = 'pos_neg_weak'; }
	elseif ($old_name == 'positive-negative-positive_inference-negative_inference') { $new_name = 'pos_neg_posInf_negInf'; }
	elseif ($old_name == 'positive-negative-positive_inference') { $new_name = 'pos_neg_posInf'; }
	elseif ($old_name == 'positive-negative-negative_inference') { $new_name = 'pos_neg_negInf'; }
	elseif ($old_name == 'positive-negative') { $new_name = 'pos_neg'; }
	elseif ($old_name == 'positive-weak_positive-positive_inference-negative_inference') { $new_name = 'pos_weak_posInf_negInf'; }
	elseif ($old_name == 'positive-weak_positive-positive_inference') { $new_name = 'pos_weak_posInf'; }
	elseif ($old_name == 'positive-weak_positive-negative_inference') { $new_name = 'pos_weak_negInf'; }
	elseif ($old_name == 'positive-weak_positive') { $new_name = 'pos_weak'; }
	elseif ($old_name == 'positive-positive_inference-negative_inference') { $new_name = 'pos_posInf_negInf'; }
	elseif ($old_name == 'positive-positive_inference') { $new_name = 'pos_posInf'; }
	elseif ($old_name == 'positive-negative_inference') { $new_name = 'pos_negInf'; }
	elseif ($old_name == 'positive') { $new_name = 'pos'; }
	elseif ($old_name == 'negative-weak_positive-positive_inference-negative_inference') { $new_name = 'neg_weak_posInf_negInf'; }
	elseif ($old_name == 'negative-weak_positive-positive_inference') { $new_name = 'neg_weak_posInf'; }
	elseif ($old_name == 'negative-weak_positive-negative_inference') { $new_name = 'neg_weak_negInf'; }
	elseif ($old_name == 'negative-weak_positive') { $new_name = 'neg_weak'; }
	elseif ($old_name == 'negative-positive_inference-negative_inference') { $new_name = 'neg_posInf_negInf'; }
	elseif ($old_name == 'negative-positive_inference') { $new_name = 'neg_posInf'; }
	elseif ($old_name == 'negative-negative_inference') { $new_name = 'neg_negInf'; }
	elseif ($old_name == 'negative') { $new_name = 'neg'; }
	elseif ($old_name == 'weak_positive-positive_inference-negative_inference') { $new_name = 'weak_posInf_negInf'; }
	elseif ($old_name == 'weak_positive-positive_inference') { $new_name = 'weak_posInf'; }
	elseif ($old_name == 'weak_positive-negative_inference') { $new_name = 'weak_negInf'; }
	elseif ($old_name == 'weak_positive') { $new_name = 'weak'; }
	elseif ($old_name == 'positive_inference-negative_inference') { $new_name = 'posInf_negInf'; }
	elseif ($old_name == 'positive_inference') { $new_name = 'posInf'; }
	elseif ($old_name == 'negative_inference') { $new_name = 'negInf'; }
	
	return $new_name;
}

?>
