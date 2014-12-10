<?php
session_start();
include ("access_db.php"); // data base access

$perm = $_SESSION['perm'];
if ($perm == '')
	header("Location:error1.html");

$research = $_REQUEST['research'];

// Define all the necessary classes needed for the application
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.temporary_result_neurons.php');

//$n_markers = 36;
$n_markers = 37;

// Name in alphabetic order for MARKERS: ************************************
$name_markers = array(
		"0"=>"5HT_3",  
		"1" =>"a-act2",
		"2"=>"AChE",
		"3" =>"CB",
		"4" =>"CB1",
		"5"=>"CCK",
		"6" =>"CGRP",
		"7" =>"ChAT",
		"8" =>"CoupTF_2",
		"9" =>"CR",
		"10" =>"DYN",
		"11" =>"EAAT3",
		"12" =>"ENK",
		"13" =>"GABAa_alfa",
		"14" =>"GAT_1",
		"15" =>"GlyT2",
		"16" =>"mGluR1a",
		"17" =>"mGluR2_3",
		"18" =>"mGluR7a",
		"19" =>"mGluR8a",
		"20" =>"MOR",
		"21" =>"Mus2R",
		"22" =>"NG",
		"23" =>"NKB",
		"24"=>"nNOS",
		"25" =>"NPY",
		"26" =>"PPTA",
		"27" =>"PPTB",
		"28" =>"PV",
		"29" =>"RLN",
		"30" =>"SOM",
		"31" =>"Sub_P_Rec",
		"32" =>"vAChT",
		"33" =>"vGluT2",
		"34" =>"vGluT3",
		"35" =>"VIAAT",
		"36" =>"VIP"
);

function getUrlForLink($id,$img,$key,$color1)
{
	$url = $img;
	if($img!='')
	{
		if($key=="GABAa_alfa")
			$keyProperty = "Gaba-a-alpha";
		else if($key=="CoupTF_2")
			$keyProperty = "CoupTF II";
		else if($key=="Sub_P_Rec")
			$keyProperty = "Sub P Rec";
		else if($key=="5HT_3")
			$keyProperty = "5HT-3";
		else if($key=="a-act2")
			$keyProperty = "alpha-actinin-2";
		else if($key=="GAT_1")
			$keyProperty = "GAT-1";
		else if($key=="mGluR2_3")
			$keyProperty = "mGluR2/3";
		else
			$keyProperty = $key;
		
		if($color1!=NULL)
		  $url ='<a href="property_page_markers.php?id_neuron='.$id.'&val_property='.$keyProperty.'&color='.$color1.'&page=markers" target="_blank">'.$img.'</a>';
	}
	return ($url);
}

// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel) // $id = type_id,$id_property = propert_id,
{
	//echo " Type id: ".$id." Property Id : ".$id_property;
	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************

function check_color($variable, $unvetted, $conflict_note)
{
/*	if ($variable == 'weak_positive')

// CHANGED to be the same as the positive example, to make positive and weakly positive the same
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive.png' border='0' width='15px' />";
		
		$link[1] = $variable;
	}*/



//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive.png' border='0' width='15px' />";	
//		
//		$link[1] = $variable;
//	}

	if ($variable == 'negative')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/negative_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/negative.png' border='0' width='15px' />";			

		$link[1] = $variable;
	}
//	if ($variable == 'positive-negative')
//	{
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
			/* echo "Variable ".$variable;
			echo " Conflict Note :".$conflict_note; */
			if ($unvetted == 1)
				$link[0] = "<img src='images/marker/positive-negative-species_unvetted.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/positive-negative-species.png' border='0' width='15px' />";		
		}	
		elseif ($conflict_note == "conflicting data")
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
		else
		{
			$link[0] = "<img src='images/marker/negative_positive_unvetted.png' border='0' width='15px' />";
		}
	
		$link[1] = $variable;
//	}	
//	if ($variable == 'positive-negative-weak_positive')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive-negative-weak_positive_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive-negative-weak_positive.png' border='0' width='15px' />";		
//	
//		$link[1] = $variable;
//	}	
//	if ($variable == 'positive-weak_positive')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive-weak_positive_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive-weak_positive.png' border='0' width='15px' />";		
//
//		$link[1] = $variable;
//	}		
//	if ($variable == 'negative-weak_positive')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/negative-weak_positive_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/negative-weak_positive.png' border='0' width='15px' />";	
//
//		$link[1] = $variable;
//	}	
	if ($variable == 'positive'|| $variable == 'weak_positive')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive.png' border='0' width='15px' />";
		
		$link[1] = $variable;
	}
//	if ($variable == 'negative-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/negative-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/negative-unknown.png' border='0' width='15px' />";	
//	
//		$link[1] = $variable;
//	}	

//	if ($variable == 'positive-negative-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive-negative-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive-negative-unknown.png' border='0' width='15px' />";		
//
//		$link[1] = $variable;
//	}
//	if ($variable == 'positive-negative-weak_positive-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive-negative-weak_positive-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive-negative-weak_positive-unknown.png' border='0' width='15px' />";			
//
//		$link[1] = $variable;
//	}	
//	if ($variable == 'positive-weak_positive-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive-weak_positive-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive-weak_positive-unknown.png' border='0' width='15px' />";		
//
//		$link[1] = $variable;
//	}	
//	if ($variable == 'weak_positive-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/weak_positive-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/weak_positive-unknown.png' border='0' width='15px' />";	
//	
//		$link[1] = $variable;
//	}	
//	if ($variable == 'negative-weak_positive-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/negative-weak_positive-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/negative-weak_positive-unknown.png' border='0' width='15px' />";		
//
//		$link[1] = $variable;
//	}	
	
//	if ($variable == 'positive-unknown')
//	{
//		if ($unvetted == 1)
//			$link[0] = "<img src='images/marker/positive-unknown_unvetted.png' border='0' width='15px' />";
//		else
//			$link[0] = "<img src='images/marker/positive-unknown.png' border='0' width='15px' />";		
//
//		$link[1] = $variable;
//	}		
	if ($variable == 'unknown')
	{
		$link[0] = "<img src='images/unknown.png' border='0' width='15px' />";
		//$link[1] = $variable;
		$link[1] = NULL;
	}	
	
	if ($variable == 'nothing')
	{
		$link[0] = "<img src='images/nothing.png' border='0' width='15px'/>";
		$link[1] = NULL;
	}
	
	return ($link);
}

function check_positive_negative($variable, $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown) 
{	
	/* if($variable=='5HT_3')
	{
		echo " Hippo Positive ".$hippo_positive[$variable];
		echo " Hippo Negative ".$hippo_negative[$variable];
		echo " Weak Positive ".$hippo_weak_positive[$variable];
		echo " Hippo Unknown ".$hippo_unknown[$variable];
	} */
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 0))
		$result = 'negative';
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 1))
		$result = 'negative-unknown';		
				
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 0))
		$result = 'positive-negative';
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 1))
		$result = 'positive-negative-unknown';		
		
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 0))
		$result = 'positive-negative-weak_positive';
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 1))
		$result = 'positive-negative-weak_positive-unknown';		
		
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 0))
		$result = 'positive-weak_positive';		
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 1))
		$result = 'positive-weak_positive-unknown';				
		
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 0))
		$result = 'weak_positive';	
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 1))
		$result = 'weak_positive-unknown';			
		
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 0))
		$result = 'negative-weak_positive';		
	if (($hippo_negative[$variable] == 1) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 1) && ($hippo_unknown[$variable] == 1))
		$result = 'negative-weak_positive-unknown';				
		
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 0))
		$result = 'positive';			
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 1) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 1))
		$result = 'positive-unknown';		
	
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 1))
		$result = 'unknown';							
							
	if (($hippo_negative[$variable] == 0) && ($hippo_positive[$variable] == 0) && ($hippo_weak_positive[$variable] == 0) && ($hippo_unknown[$variable] == 0))
		$result = 'nothing';			
	
	return ($result);
}
if(!isset($_GET['page'])) $page=1;
else $page = $_GET['page'];
//page=1&rows=5&sidx=1&sord=asc
// get how many rows we want to have into the grid - rowNum parameter in the grid
if(!isset($_GET['rows'])) $limit=122;
else $limit = $_GET['rows'];

// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel
if(!isset($_GET['sidx'])) $sidx=1;
else $sidx = $_GET['sidx'];

// sorting order - at first time sortorder
if(!isset($_GET['sord'])) $sord="asc";
else $sord = $_GET['sord'];

// if we not pass at first time index use the first column for the index or what you want
if(!$sidx) $sidx =1;

$type = new type($class_type);

$research = $_REQUEST['research'];
$table = $_REQUEST['table_result'];
if (isset($research)) // From page of search; retrieve the id from search_table (temporary) -----------------------
{
	$table_result = $_REQUEST['table_result'];
	$temporary_result_neurons = new temporary_result_neurons();
	$temporary_result_neurons -> setName_table($table_result);
	
	$temporary_result_neurons -> retrieve_id_array();
	$n_id_res = $temporary_result_neurons -> getN_id();
	$number_type = 0;
	for ($i2=0; $i2<$n_id_res; $i2++)
	{
		$id2 = 	$temporary_result_neurons -> getID_array($i2); // Retrieve  each ID corresponding to the id Array

		if (strpos($id2, '0_') == 1);
		else
		{
			$type -> retrive_by_id($id2); // For each Id  retrieve the type characteristics
			$status = $type -> getStatus(); // Retrieve the status for each id
				
			if ($status == 'active')
			{
				$id_search[$number_type] = $id2;
				$position_search[$number_type] = $type -> getPosition();
				$number_type = $number_type + 1;
			}
		}
	} // END $i2

	array_multisort($position_search, $id_search);
	// sort($id_search);
}
else // not from search page --------------
{
		if($_GET['_search']=='false') // Condition to check ifthe 
		{
			$type -> retrive_id();
			$number_type = $type->getNumber_type();
		}
		else{
			//Retrieve types by Search conditions

			//echo "Search ".$_GET['_search'];
			/* echo "Search Field : ".$_GET['searchField']; // – the name of the field defined in colModel
			echo "Search String : ".$_GET['searchString']; // – the string typed in the search field
			echo "Search Operator : ".$_GET['searchOper']; //– the operator choosen in the search field (ex. equal, greater than, …) */
				
		}
}

$property = new property($class_property);

$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);

//$hippo_select = $_SESSION['hippo_select'];
$count = $number_type;
//echo "The number of elements are ".$count." and the limit is ".$limit;
if($count <= $limit)
	$limit = $count;

// calculate the total pages for the query
if( $count > 0 && $limit > 0) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}

// if for some reasons the requested page is greater than the total
// set the requested page to total page
if ($page > $total_pages) 
	$page=$total_pages;

// calculate the starting position of the rows
$start = $limit*$page - $limit;

// if for some reasons start position is negative set it to 0
// typical case is that the user type 0 for the requested page
if($start <0) 
	$start = 0;

$n_DG = 0;
$n_CA3 = 0;
$n_CA2 = 0;
$n_CA1 = 0;
$n_SUB = 0;
$n_EC = 0;

//header("Content-type: application/json;charset=utf-8");
$responce = (object) array('page' => $page, 'total' => $total_pages, 'records' =>$count, 'rows' => "");

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

if($research!="1")
{
	//$type -> retieve_ordered_List($start,$limit);
	$type -> retrive_id();
	$number_type = $type->getNumber_type();
}
//$number_type=$number_type+6;
$neuron = array("DG"=>'DG(18)',"CA3"=>'CA3(25)',"CA3c"=>'CA3(25)',"CA2"=>'CA2(5)',"CA1"=>'CA1(39)',"SUB"=>'SUB(3)',"EC"=>'EC(31)');
$neuronColor = array("DG"=>'#770000',"CA3"=>'#C08181',"CA3c"=>'#C08181',"CA2"=>'#FFCC00',"CA1"=>'#FF6103',"SUB"=>'#FFCC33',"EC"=>'#336633');
//$prev_subregion="NONE";
for ($i=0; $i<$number_type; $i++) //$number_type // Here he determines the number of active neuron types to print each row in the data table
{
	// ARRAY Creation for hippocampome properties: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	$hippo_property_id = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
			"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,
			"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,
			"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
			"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL,
			"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
			//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
			"MOR" =>NULL,"NG" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
			"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
			"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
	);
	
	$hippo_property = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
			"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,
			"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,
			"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, 
			"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL,
			"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
			"MOR" =>NULL, "NG" =>NULL,"NKB" =>NULL, "PPTA" =>NULL,
			"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
			"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
	);
	
	$hippo = array("CB"=>NULL,"CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
			"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,
			"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,
			"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
			"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL,
			"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
			//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
			"MOR" =>NULL, "NG" =>NULL,"NKB" =>NULL, "PPTA" =>NULL,
			"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
			"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
	);
	
	$hippo_negative = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, 
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
							"MOR" =>NULL,"NG" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);
							
			$hippo_positive = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL,"NG" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);						
			
			$hippo_weak_positive = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);			
							
			$hippo_unknown = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL, "NG" =>NULL,"NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);

			$hippo_color = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
									"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,
									"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P_Rec" =>NULL,
									"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
									"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL,
									"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
									"MOR" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
									"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
									"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL);
	
	
		if(isset($id_search))
		{
			$id = $id_search[$i];	
		}
		else
			$id = $type->getID_array($i);
	 

			
	 $type -> retrive_by_id($id); // Retrieve id
	 $nickname = $type->getNickname(); // Retrieve nick name
	 $position = $type->getPosition(); // Retrieve the position
	 $subregion = $type -> getSubregion(); // Retrieve the sub region
	 $excit_inhib =$type-> getExcit_Inhib();
	
	$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id); // Retrieve distinct Property ids for each type id
	$n_property = $evidencepropertyyperel -> getN_Property_id(); // Count of the number of properties for a given type id
	
	$q=0;

	for ($i5=0; $i5<$n_property; $i5++) // For Each Property id he derieves by using an Index
	{
		$Property_id = $evidencepropertyyperel -> getProperty_id_array($i5); // retrive the respective property id at a particular id index
		
		$property -> retrive_by_id($Property_id); // For each property id retrieve the respective properties
		$rel1 = $property->getRel(); // Retrieve a predicate for a particular property id
		$part1 = $property->getPart(); // Retrieve Subject (from the property table)
		if ($rel1 == 'has expression')
		{
			$id_p[$q] = $property->getID(); // Retrieve the id
			$val[$q] = $property->getVal(); // retrieve object
			$part[$q] = $property->getPart(); // Retrieve the subject
			$rel[$q] = $property->getRel(); // Retrieve the Predicate
			$q = $q+1;
		}
	
	}
	
	for ($ii=0; $ii<$q; $ii++) // For all the properties derieved check the required conditions
	{
		if (strpos($part[$ii], 'Gaba-a') == 'TRUE')
			$part[$ii] = 'GABAa_alfa';
		else if (strpos($part[$ii], 'CoupTF') == 'TRUE')
			$part[$ii] = 'CoupTF_2';
		else;
		if ($part[$ii] == 'Sub P Rec')
			$part[$ii] = 'Sub_P_Rec';
		if ($part[$ii] == '5HT-3')						// CLR modified this line
			$part[$ii] = '5HT_3';								// CLR modified this line
		if ($part[$ii] == 'alpha-actinin-2')
			$part[$ii] = 'a-act2';
		if ($part[$ii] == 'GAT-1')
			$part[$ii] = 'GAT_1';
		if ($part[$ii] == 'mGluR2/3')
			$part[$ii] = 'mGluR2_3';
		
		if ($val[$ii] == 'positive')
			$hippo_positive[$part[$ii]]=1;
		if ($val[$ii] == 'negative')
		$hippo_negative[$part[$ii]]=1;
		if ($val[$ii] == 'weak_positive')
			$hippo_weak_positive[$part[$ii]]=1;
		if ($val[$ii] == 'unknown')
			$hippo_unknown[$part[$ii]]=1;
		
		$hippo_property_id[$part[$ii]] = $id_p[$ii];
	}
	
	$hippo_property['CB'] = check_positive_negative('CB', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['CR'] = check_positive_negative('CR', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['CCK'] = check_positive_negative('CCK', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['nNOS'] = check_positive_negative('nNOS', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['NPY'] = check_positive_negative('NPY', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['PV'] = check_positive_negative('PV', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['SOM'] = check_positive_negative('SOM', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['VIP'] = check_positive_negative('VIP', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['CB1'] = check_positive_negative('CB1', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['ENK'] = check_positive_negative('ENK', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['GABAa_alfa'] = check_positive_negative('GABAa_alfa', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['Mus2R'] = check_positive_negative('Mus2R', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['Sub_P_Rec'] = check_positive_negative('Sub_P_Rec', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['vGluT3'] = check_positive_negative('vGluT3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['CoupTF_2'] = check_positive_negative('CoupTF_2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['5HT_3'] = check_positive_negative('5HT_3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown); 
	$hippo_property['RLN'] = check_positive_negative('RLN', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['a-act2'] = check_positive_negative('a-act2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['ChAT'] = check_positive_negative('ChAT', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['DYN'] = check_positive_negative('DYN', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['EAAT3'] = check_positive_negative('EAAT3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['GlyT2'] = check_positive_negative('GlyT2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['mGluR1a'] = check_positive_negative('mGluR1a', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['mGluR7a'] = check_positive_negative('mGluR7a', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['mGluR8a'] = check_positive_negative('mGluR8a', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['MOR'] = check_positive_negative('MOR', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['NG'] = check_positive_negative('NG', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['NKB'] = check_positive_negative('NKB', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['PPTA'] = check_positive_negative('PPTA', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['PPTB'] = check_positive_negative('PPTB', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['vAChT'] = check_positive_negative('vAChT', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['VIAAT'] = check_positive_negative('VIAAT', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['vGluT2'] = check_positive_negative('vGluT2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['AChE'] = check_positive_negative('AChE', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['GAT_1'] = check_positive_negative('GAT_1', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['mGluR2_3'] = check_positive_negative('mGluR2_3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	$hippo_property['CGRP'] = check_positive_negative('CGRP', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
	
//	if (strpos($nickname, '(+)') == TRUE)
	if ($excit_inhib == 'e')
		$fontColor='#339900';
//	if (strpos($nickname, '(-)') == TRUE)
	if ($excit_inhib == 'i')
		$fontColor='#CC0000';
/*	for ($f1=0; $f1<6; $f1++){
		$hippo[$f1]="";
		$hippo_color[$f1]="";
	}*/
	for ($f1=0; $f1<$n_markers; $f1++)  //$n_markers set to 36
	{
		
		$evidencepropertyyperel -> retrieve_conflict_note($hippo_property_id[$name_markers[$f1]], $id);
	    $conflict_note = $evidencepropertyyperel -> getConflict_note();
	    
	    $nam_unv1 = check_unvetted1($id, $hippo_property_id[$name_markers[$f1]], $evidencepropertyyperel);
		$img = check_color($hippo_property[$name_markers[$f1]], $nam_unv1, $conflict_note);
		$hippo[$name_markers[$f1]] =$img[0];
		
		if ($img[1] == NULL)
		{
			/* if ($name_markers[$f1] == 'a-act2') // if name_markers is a-act2
				$hippo[$name_markers[$f1]] =$img[0]." ".$unvetted_act2;
			else */
				$hippo[$name_markers[$f1]] =$img[0];
		}
		else	  
			$hippo_color[$name_markers[$f1]] = $img[1];
	}

	  $responce->rows[$i]['cell']=array('<span style="color:'.$neuronColor[$subregion].'"><strong>'.$neuron[$subregion].'</strong></span>','<a href="neuron_page.php?id='.$id.'" target="blank" title="'.$type->getName().'"><font color="'.$fontColor.'">'.$nickname.'</font></a>',
	
	  		getUrlForLink($id,$hippo['5HT_3'],$name_markers['0'],$hippo_color['5HT_3']),
			getUrlForLink($id,$hippo['a-act2'],$name_markers['1'],$hippo_color['a-act2']),
			getUrlForLink($id,$hippo['AChE'],$name_markers['2'],$hippo_color['AChE']),
			getUrlForLink($id,$hippo['CB'],$name_markers['3'],$hippo_color['CB']),
			getUrlForLink($id,$hippo['CB1'],$name_markers['4'],$hippo_color['CB1']),
			getUrlForLink($id,$hippo['CCK'],$name_markers['5'],$hippo_color['CCK']),
			getUrlForLink($id,$hippo['CGRP'],$name_markers['6'],$hippo_color['CGRP']),
			getUrlForLink($id,$hippo['ChAT'],$name_markers['7'],$hippo_color['ChAT']),
			getUrlForLink($id,$hippo['CoupTF_2'],$name_markers['8'],$hippo_color['CoupTF_2']),
			getUrlForLink($id,$hippo['CR'],$name_markers['9'],$hippo_color['CR']),
			getUrlForLink($id,$hippo['DYN'],$name_markers['10'],$hippo_color['DYN']),
			getUrlForLink($id,$hippo['EAAT3'],$name_markers['11'],$hippo_color['EAAT3']),
			getUrlForLink($id,$hippo['ENK'],$name_markers['12'],$hippo_color['ENK']),
			getUrlForLink($id,$hippo['GABAa_alfa'],$name_markers['13'],$hippo_color['GABAa_alfa']),
			getUrlForLink($id,$hippo['GAT_1'],$name_markers['14'],$hippo_color['GAT_1']),
			getUrlForLink($id,$hippo['GlyT2'],$name_markers['15'],$hippo_color['GlyT2']),
			getUrlForLink($id,$hippo['mGluR1a'],$name_markers['16'],$hippo_color['mGluR1a']),
			getUrlForLink($id,$hippo['mGluR2_3'],$name_markers['17'],$hippo_color['mGluR2_3']),
			getUrlForLink($id,$hippo['mGluR7a'],$name_markers['18'],$hippo_color['mGluR7a']),
			getUrlForLink($id,$hippo['mGluR8a'],$name_markers['19'],$hippo_color['mGluR8a']),
			getUrlForLink($id,$hippo['MOR'],$name_markers['20'],$hippo_color['MOR']),
			getUrlForLink($id,$hippo['Mus2R'],$name_markers['21'],$hippo_color['Mus2R']),
			getUrlForLink($id,$hippo['NG'],$name_markers['22'],$hippo_color['NG']),
			getUrlForLink($id,$hippo['NKB'],$name_markers['23'],$hippo_color['NKB']),
			getUrlForLink($id,$hippo['nNOS'],$name_markers['24'],$hippo_color['nNOS']),
			getUrlForLink($id,$hippo['NPY'],$name_markers['25'],$hippo_color['NPY']),
			getUrlForLink($id,$hippo['PPTA'],$name_markers['26'],$hippo_color['PPTA']),
			getUrlForLink($id,$hippo['PPTB'],$name_markers['27'],$hippo_color['PPTB']),
			getUrlForLink($id,$hippo['PV'],$name_markers['28'],$hippo_color['PV']),
			getUrlForLink($id,$hippo['RLN'],$name_markers['29'],$hippo_color['RLN']),
			getUrlForLink($id,$hippo['SOM'],$name_markers['30'],$hippo_color['SOM']),
			getUrlForLink($id,$hippo['Sub_P_Rec'],$name_markers['31'],$hippo_color['Sub_P_Rec']),
			getUrlForLink($id,$hippo['vAChT'],$name_markers['32'],$hippo_color['vAChT']),
			getUrlForLink($id,$hippo['vGluT2'],$name_markers['33'],$hippo_color['vGluT2']),
			getUrlForLink($id,$hippo['vGluT3'],$name_markers['34'],$hippo_color['vGluT3']),
			getUrlForLink($id,$hippo['VIAAT'],$name_markers['35'],$hippo_color['VIAAT']),
			getUrlForLink($id,$hippo['VIP'],$name_markers['36'],$hippo_color['VIP']));  

}
//echo json_encode($responce);
?>
