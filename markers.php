<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
	
include ("access_db.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.temporary_result_neurons.php');
	
$width1='25%';
$width2='2%';
//$n_markers = 37;
$n_markers = 36;

// Name in alphabetic order for MARKERS: ************************************
$name_markers = array(	
				"0"=>"5HT_3",  // CLR modified this line
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
//				"22" =>"NK1", 
//				"23" =>"NKB",
//				"24"=>"nNOS",
//				"25" =>"NPY", 
//				"26" =>"PPTA",
//				"27" =>"PPTB", 
//				"28" =>"PV", 
//				"29" =>"RLN", 
//				"30" =>"SOM", 
//				"31" =>"Sub_P",	
//				"32" =>"vAChT", 
//				"33" =>"vGluT2",
//				"34" =>"vGluT3", 
//				"35" =>"VIAAT",
//				"36" =>"VIP", 
				"22" =>"NKB",
				"23"=>"nNOS",
				"24" =>"NPY", 
				"25" =>"PPTA",
				"26" =>"PPTB", 
				"27" =>"PV", 
				"28" =>"RLN", 
				"29" =>"SOM", 
				"30" =>"Sub_P",	
				"31" =>"vAChT", 
				"32" =>"vGluT2",
				"33" =>"vGluT3", 
				"34" =>"VIAAT",
				"35" =>"VIP", 
				);	
//******************************************************************************
// Name Image alphabetic order for MARKERS: ************************************
$link_image_markers = array(	
				"0"=>"<img src='images/name_marker/5HT_3.png' />", 
				"1" =>"<img src='images/name_marker/a-act2.png' />", 
				"2"=>"<img src='images/name_marker/AChE.png' />",
				"3" =>"<img src='images/name_marker/CB.png' />",
				"4" =>"<img src='images/name_marker/CB1.png' />",
				"5"=>"<img src='images/name_marker/CCK.png' />",				
				"6" =>"<img src='images/name_marker/CGRP.png' />",				
				"7" =>"<img src='images/name_marker/ChAT.png' />",
				"8" =>"<img src='images/name_marker/CoupTF_2.png' />",
				"9" =>"<img src='images/name_marker/CR.png' />",
				"10" =>"<img src='images/name_marker/DYN.png' />",
				"11" =>"<img src='images/name_marker/EAAT3.png' />",
				"12" =>"<img src='images/name_marker/ENK.png' />",
				"13" =>"<img src='images/name_marker/GABAa_ALFA.png' />",
				"14" =>"<img src='images/name_marker/GAT-1.png' />",
				"15" =>"<img src='images/name_marker/Gly_T2.png' />",
				"16" =>"<img src='images/name_marker/mGluR1a.png' />", 
				"17" =>"<img src='images/name_marker/mGluR2_3.png' />", 				
				"18" =>"<img src='images/name_marker/mGluR7a.png' />", 
				"19" =>"<img src='images/name_marker/mGluR8a.png' />",
				"20" =>"<img src='images/name_marker/MOR.png' />", 
				"21" =>"<img src='images/name_marker/Mus2R.png' />", 
//				"22" =>"<img src='images/name_marker/NK1.png' />", 
//				"23" =>"<img src='images/name_marker/NKB.png' />",
//				"24"=>"<img src='images/name_marker/nNOS.png' />",
//				"25" =>"<img src='images/name_marker/NPY.png' />", 
//				"26" =>"<img src='images/name_marker/PPTA.png' />",
//				"27" =>"<img src='images/name_marker/PPTB.png' />", 
//				"28" =>"<img src='images/name_marker/PV.png' />", 
//				"29" =>"<img src='images/name_marker/RLN.png' />", 
//				"30" =>"<img src='images/name_marker/SOM.png' />", 
//				"31" =>"<img src='images/name_marker/sub_P.png' />",	
//				"32" =>"<img src='images/name_marker/vAChT.png' />", 
//				"33" =>"<img src='images/name_marker/vGluT2.png' />",
//				"34" =>"<img src='images/name_marker/vGlu_T3.png' />", 
//				"35" =>"<img src='images/name_marker/VIAAT.png' />",
//				"36" =>"<img src='images/name_marker/VIP.png' />", 
				"22" =>"<img src='images/name_marker/NKB.png' />",
				"23"=>"<img src='images/name_marker/nNOS.png' />",
				"24" =>"<img src='images/name_marker/NPY.png' />", 
				"25" =>"<img src='images/name_marker/PPTA.png' />",
				"26" =>"<img src='images/name_marker/PPTB.png' />", 
				"27" =>"<img src='images/name_marker/PV.png' />", 
				"28" =>"<img src='images/name_marker/RLN.png' />", 
				"29" =>"<img src='images/name_marker/SOM.png' />", 
				"30" =>"<img src='images/name_marker/sub_P.png' />",	
				"31" =>"<img src='images/name_marker/vAChT.png' />", 
				"32" =>"<img src='images/name_marker/vGluT2.png' />",
				"33" =>"<img src='images/name_marker/vGlu_T3.png' />", 
				"34" =>"<img src='images/name_marker/VIAAT.png' />",
				"35" =>"<img src='images/name_marker/VIP.png' />", 
				);	
// **************************************************************************************************				
				
// FUNCTIONS -------------------------------------------------------------------------------
// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel)
{

	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************
				
				
function check_color($variable, $unvetted, $conflict_note)
{
	if ($variable == 'weak_positive')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/positive_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/positive.png' border='0' width='15px' />";	
		
		$link[1] = $variable;
	}
	if ($variable == 'negative')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/marker/negative_unvetted.png' border='0' width='15px' />";
		else
			$link[0] = "<img src='images/marker/negative.png' border='0' width='15px' />";			

		$link[1] = $variable;
	}
	if ($variable == 'positive-negative')
	{
		// Check the conflict_note:
		if ($conflict_note == "subtypes")
		{
			if ($unvetted == 1)
				$link[0] = "<img src='images/marker/positive-negative-subtypes_unvetted.png' border='0' width='15px' />";
			else
				$link[0] = "<img src='images/marker/positive-negative-subtypes.png' border='0' width='15px' />";		
		}
		elseif ($conflict_note == "species differences")
		{
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
		else
		{
			$link[0] = "<img src='images/marker/negative_positive_unvetted.png' border='0' width='15px' />";
		}
	
		$link[1] = $variable;
	}	
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
	if ($variable == 'positive')
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

// ------------------------------------------------------------------------------------------

$type = new type($class_type);

$research = $_REQUEST['research'];

if ($research) // From page of search; retrieve the id from search_table (temporary) -----------------------
{
	$table_result = $_REQUEST['table_result'];

	$temporary_result_neurons = new temporary_result_neurons();
	$temporary_result_neurons -> setName_table($table_result);

	$temporary_result_neurons -> retrieve_id_array();
	$n_id_res = $temporary_result_neurons -> getN_id();

	$number_type = 0;
	for ($i2=0; $i2<$n_id_res; $i2++)
	{
		$id2 = 	$temporary_result_neurons -> getID_array($i2);
		
		if (strpos($id2, '0_') == 1);
		else
		{
			$type -> retrive_by_id($id2);
			$status = $type -> getStatus();
			
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
	$type -> retrive_id();
	$number_type = $type->getNumber_type();
}
// -------------------------------------------------------------------------------------------------------------

$property = new property($class_property);

$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">

function ctr(select_nick_name2, color, select_nick_name_check)
{

	if (document.getElementById(select_nick_name_check).checked == false)
	{	
		document.getElementById(select_nick_name2).bgColor = "#FFFFFF";
		
	}
	else if (document.getElementById(select_nick_name_check).checked == true)
		document.getElementById(select_nick_name2).bgColor = "#EBF283";	
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Markers Matrix</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php include ("function/title.php"); ?>

	<div id="menu_main_button_new">
	<?php
		if ($research);
		else
		{
	?>		
			<form action="index.php" method="post" style='display:inline'>
				<input type="submit" name='index' value='Home' class="main_button"/> 
			</form>
			<form action="search.php" method="post" style='display:inline' target="_blank">	
				<input type="submit" name='searching' value='Search' class="main_button"/> 
			</form>				
			<form action="help.php" method="post" style='display:inline' target="_blank">
				<input type="submit" name='help' value='Help' class="main_button"/>
			</form>
	<?php
		}
	?>	
	</div>


<div class='sub_menu'>
	<?php
		if ($research);
		else
		{
	?>
			<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" align="left">
					<font class='font1'><em>Matrix:</em></font> &nbsp; &nbsp; 
					<a href='morphology.php'><font class="font7">Morphology</font></a> <font class="font7_A">|</font> 
					<font class="font7_B"> Markers</font> <font class="font7_A">|</font> 
					<a href='ephys.php'><font class="font7">Electrophysiology</font> </a><font class="font7_A">|</font> 
					<a href='connectivity.php'><font class="font7"> Connectivity</font></a>
					</font>	
				</td>
			</tr>
			</table>
	<?php
		}
	?>		
</div>
<!-- ------------------------ -->

<div class="table_position">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="20">
    <td></td>
  </tr>
  <tr>
    <td>
		<!-- ****************  BODY **************** -->
		
		<font class='font1'>Markers matrix</font>
		<?php 
			if ($research){
				$full_search_string = $_SESSION['full_search_string'];
				if ($number_type == 1)
					print ("<font class='font3'> $number_type Result  [$full_search_string]</font>");
				else
					print ("<font class='font3'> $number_type Results  [$full_search_string]</font>");			
			}
		?>		
		<br />
		<font class='font5'><strong>Legend:</strong> </font>&nbsp; &nbsp;
		<img src='images/positive.png' width="13px" border="0"/> <font class='font5'>Positive </font> &nbsp; &nbsp; 
		<img src='images/negative.png' width="13px" border="0"/> <font class='font5'>Negative </font>&nbsp; &nbsp; 
		<img src="images/positive-negative-subtypes.png" width="13px" border="0"/> <font class='font5'>Positive-Negative (subtypes) </font> &nbsp; &nbsp; 
		<img src="images/positive-negative-species.png" width="13px" border="0"/> <font class='font5'>Positive-Negative (species/protocol differences) </font> &nbsp; &nbsp; 
		<img src="images/positive-negative-conflicting.png" width="13px" border="0"/> <font class='font5'>Positive-Negative (conflicting data) </font> &nbsp; &nbsp; 
		<img src="images/unknown.png" width="13px" border="0"/> <font class='font5'>No Information Available </font> &nbsp; &nbsp; 
		<img src="images/searching.png" width="13px" border="0"/> <font class='font5'>Search ongoing </font> &nbsp; &nbsp;
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#339900" size="2"> +/green: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Excitatory</font>
		&nbsp; &nbsp; 
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#CC0000" size="2"> -/red: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Inhibitory</font>
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>Pale versions of the colors in the matrix indicate interpretations of neuronal property information that have not yet been fully verified.</font>
		<br />


<table border="0" cellspacing="0" cellpadding="0" class="tabellauno">
	<tr>
 		<td>

				
		<table border="1" cellspacing="0" cellpadding="0" class="table_10">
		  <tr height="50px">
		  
			<td width="30%" align="center" colspan="3">	
				<font class='font1'>Neuron Type</font>		
			</td>
			<?php
			for ($i=0; $i<$n_markers; $i++)
			{
				print ("<td width='$width2' align='center' >$link_image_markers[$i]</td>");				
			}
			?>
		  </tr>
		</table>
		
		</td>
	</tr>

	<tr>
		<td>
		<div class="divinterno">
		
		
		<?php
		// calculate the first number for each zone, only in case of reseach ------------------------------------------------
		$n_DG = 0;	
		$n_CA3 = 0;
		$n_CA2 = 0;
		$n_CA1 = 0;		
		$n_SUB = 0;			
		$n_EC = 0;			
		if ($research) 
		{				
			for($W1=0; $W1<$number_type; $W1++)
			{
				if ($id_search[$W1] < 1999)
				{
					$DG_position[$n_DG]=$id_search[$W1];
					$n_DG = $n_DG + 1;	
				}	
				if ( ($id_search[$W1] >= 2000) && ($id_search[$W1] < 2999) )
				{
					$CA3_position[$n_CA3]=$id_search[$W1];
					$n_CA3 = $n_CA3 + 1;	
				}	
				if ( ($id_search[$W1] >= 3000) && ($id_search[$W1] < 3999) )
				{
					$CA2_position[$n_CA2]=$id_search[$W1];
					$n_CA2 = $n_CA2 + 1;	
				}				
				if ( ($id_search[$W1] >= 4000) && ($id_search[$W1] < 4999) )
				{
					$CA1_position[$n_CA1]=$id_search[$W1];
					$n_CA1 = $n_CA1 + 1;	
				}				
				if ( ($id_search[$W1] >= 5000) && ($id_search[$W1] < 5999) )
				{
					$SUB_position[$n_SUB]=$id_search[$W1];
					$n_SUB = $n_SUB + 1;	
				}				
				if ( ($id_search[$W1] >= 6000) && ($id_search[$W1] < 6999) )
				{
					$EC_position[$n_EC]=$id_search[$W1];
					$n_EC = $n_EC + 1;	
				}				
			}
			
			if ($n_DG != 0)
			{
				sort($DG_position);	
				$first_DG = $DG_position[0];
			}
			if ($n_CA3 != 0)
			{			
				sort($CA3_position);	
				$first_CA3 = $CA3_position[0];	
			}
			if ($n_CA2 != 0)
			{
				sort($CA2_position);	
				$first_CA2 = $CA2_position[0];				
			}
			if ($n_CA1 != 0)
			{
				sort($CA1_position);	
				$first_CA1 = $CA1_position[0];			
			}			
			if ($n_SUB != 0)
			{
				sort($SUB_position);	
				$first_SUB = $SUB_position[0];		
			}						
			if ($n_EC != 0)
			{
				sort($EC_position);	
				$first_EC = $EC_position[0];		
			}						
		}
		// ------------------------------------------------------------------------------------------------------------------

		print ("<table border='1' cellspacing='0' cellpadding='0' class='tabelladue'>");
		
		// Retrive the NICKNAME in table TYPE 		
		for ($i=0; $i<$number_type; $i++) //$number_type
		{
			// ARRAY Creation for axon, dendrite and total: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			$hippo_property_id = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);
							
			$hippo_negative = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);
							
			$hippo_positive = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);						
			
			$hippo_weak_positive = array("CB"=>NULL, "CR"=>NULL,"CCK"=>NULL,"nNOS"=>NULL,
							"NPY" =>NULL, "PV" =>NULL, "SOM" =>NULL, "VIP" =>NULL, "CB1" =>NULL,		
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P" =>NULL,	
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
							"ENK" =>NULL, "GABAa_alfa" =>NULL, "Mus2R" =>NULL, "Sub_P" =>NULL,	
							"VgluT3" =>NULL, "CoupTF_2" =>NULL, "5HT_3" =>NULL, "RLN" =>NULL, // CLR modified this line
							"a-act2" =>NULL, "ChAT" =>NULL, "DYN" =>NULL, "EAAT3" =>NULL, 
							"GlyT2" =>NULL, "mGluR1a" =>NULL, "mGluR7a" =>NULL, "mGluR8a" =>NULL,
//							"MOR" =>NULL, "NKB" =>NULL, "NK1" =>NULL, "PPTA" =>NULL,
							"MOR" =>NULL, "NKB" =>NULL, "PPTA" =>NULL,
							"PPTB" =>NULL, "vAChT" =>NULL, "VIAAT" =>NULL, "vGluT2" =>NULL,
							"AChE" =>NULL, "GAT_1" =>NULL, "mGluR2_3" =>NULL, "CGRP" =>NULL
							);																		
			// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++				
									
			if ($research) 
				$id = $id_search[$i];
			else
				$id = $type->getID_array($i);									
									
			$type -> retrive_by_id($id);
			$nickname = $type->getNickname();
			$position = $type->getPosition();
			
			// retrive propertytyperel.property_id By type.id 
			$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id);
			$n_property = $evidencepropertyyperel -> getN_Property_id();
			
			$q = 0;
			for ($ii=0; $ii<$n_property; $ii++)
			{
				$Property_id = $evidencepropertyyperel -> getProperty_id_array($ii);
				
				$property -> retrive_by_id($Property_id);
				$rel1 = $property->getRel();
		
				if ($rel1 == 'has expression')
				{ 
					$id_p[$q] = $property->getID();
					$val[$q] = $property->getVal();
					$part[$q] = $property->getPart();
					$rel[$q] = $property->getRel();
					$q = $q+1;
				}									
			}
		
			for ($ii=0; $ii<$q; $ii++)
			{		
				// Must change the name of part to have similar name to database:
				if (strpos($part[$ii], 'Gaba-a') == 'TRUE')
					$part[$ii] = 'GABAa_alfa';
				else if (strpos($part[$ii], 'CoupTF') == 'TRUE')
					$part[$ii] = 'CoupTF_2';						
				else;
				
				if ($part[$ii] == 'Sub P')
					$part[$ii] = 'Sub_P';
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
			
			$hippo[CB] = check_positive_negative('CB', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[CR] = check_positive_negative('CR', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[CCK] = check_positive_negative('CCK', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[nNOS] = check_positive_negative('nNOS', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[NPY] = check_positive_negative('NPY', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[PV] = check_positive_negative('PV', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[SOM] = check_positive_negative('SOM', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[VIP] = check_positive_negative('VIP', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[CB1] = check_positive_negative('CB1', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[ENK] = check_positive_negative('ENK', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[GABAa_alfa] = check_positive_negative('GABAa_alfa', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[Mus2R] = check_positive_negative('Mus2R', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[Sub_P] = check_positive_negative('Sub_P', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[vGluT3] = check_positive_negative('vGluT3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[CoupTF_2] = check_positive_negative('CoupTF_2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo["5HT_3"] = check_positive_negative('5HT_3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown); // CLR modified this line
			$hippo[RLN] = check_positive_negative('RLN', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);			
			$hippo[a-act2] = check_positive_negative('a-act2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[ChAT] = check_positive_negative('ChAT', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[DYN] = check_positive_negative('DYN', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[EAAT3] = check_positive_negative('EAAT3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[GlyT2] = check_positive_negative('GlyT2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[mGluR1a] = check_positive_negative('mGluR1a', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[mGluR7a] = check_positive_negative('mGluR7a', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[mGluR8a] = check_positive_negative('mGluR8a', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[MOR] = check_positive_negative('MOR', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[NKB] = check_positive_negative('NKB', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
//			$hippo[NK1] = check_positive_negative('NK1', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[PPTA] = check_positive_negative('PPTA', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[PPTB] = check_positive_negative('PPTB', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[vAChT] = check_positive_negative('vAChT', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);
			$hippo[VIAAT] = check_positive_negative('VIAAT', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);		
			$hippo[vGluT2] = check_positive_negative('vGluT2', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);	
			$hippo[AChE] = check_positive_negative('AChE', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);	
			$hippo[GAT_1] = check_positive_negative('GAT_1', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);				
			$hippo[mGluR2_3] = check_positive_negative('mGluR2_3', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);	
			$hippo[CGRP] = check_positive_negative('CGRP', $hippo_positive, $hippo_negative, $hippo_weak_positive, $hippo_unknown);	
						
			if (!$research)
			{
				if ( ($position == 201) || ($position == 301) || ($position == 401) || ($position == 501) || ($position == 601))    		
				{										
					print ("<tr height='4px'><td colspan='40' bgcolor='#FF0000'></td></tr>");
				}
			}
			else
			{
				if ( ($id == $first_CA3) || ($id == $first_CA2) || ($id == $first_CA1) || ($id == $first_SUB) || ($id == $first_EC))
				{
				 	print ("<tr height='4px'><td colspan='40' bgcolor='#FF0000'></td></tr>");
				}
			}			

			$select_nick_name2 = str_replace(':', '_', $nickname);
			$select_nick_name_check  = $select_nick_name2."_check";
							
			print ("<tr id='$select_nick_name2'>");
			
				if ($position < 200)
				{
					$bkcolor='#770000';
				}
				else if ($position < 300)
				{
					$bkcolor='#BF7474';
				}
				else if ($position < 400)
				{
					$bkcolor='#FFFF99';
				}	
				else if ($position < 500)
				{
					$bkcolor='#FF6103';
				}	
				else if ($position < 600)
				{
					$bkcolor='#FFCC33';
				}				
				else if ($position < 700)
				{
					$bkcolor='#336633';
				}											
				else
				{
					$bkcolor='#FFFFFF';	
				}

				print ("<td width='3%' align='center' class='cella_1'>");
	
				if ($research) 
				{
					if ($id == $first_DG)
							print ("<font class='font22' color='#770000'><strong>DG</strong></font> ");		
					if ($id == $first_CA3)
						print ("<font class='font22' color='#BF7474'><strong>CA3</strong></font> ");						
					if ($id == $first_CA2)
						print ("<font class='font22' color='#FFCC00'><strong>CA2</strong></font> ");					
					if ($id == $first_CA1)
						print ("<font class='font22' color='#FF6103'><strong>CA1</strong></font> ");							
					if ($id == $first_SUB)
						print ("<font class='font22' color='#FFCC33'><strong>SUB</strong></font> ");					
					if ($id == $first_EC)
						print ("<font class='font22' color='#336633'><strong>EC</strong></font> ");									
				}
				else
				{	
					if ($position == 101)
						print ("<font class='font22' color='#770000'><strong>DG</strong></font> ");				
					if ($position == 102)
						print ("<font class='font22' color='#770000'>(18)</font> ");				
					if ($position == 201)
						print ("<font class='font22' color='#BF7474'><strong>CA3</strong></font> ");		
					if ($position == 202)
						print ("<font class='font22' color='#BF7474'>(25)</font> ");				
					if ($position == 301)
						print ("<font class='font22' color='#FFCC00'><strong>CA2</strong></font> ");			
					if ($position == 302)
						print ("<font class='font22' color='#FFCC00'>(5)</font> ");				
					if ($position == 401)
						print ("<font class='font22' color='#FF6103'><strong>CA1</strong></font> ");		
					if ($position == 402)
						print ("<font class='font22' color='#FF6103'>(40)</font> ");				
					if ($position == 501)
						print ("<font class='font22' color='#FFCC33'><strong>SUB</strong></font> ");				
					if ($position == 502)
						print ("<font class='font22' color='#FFCC33'>(3)</font> ");				
					if ($position == 601)
						print ("<font class='font22' color='#336633'><strong>EC</strong></font> ");	
					if ($position == 602)
						print ("<font class='font22' color='#336633'>(31)</font> ");				
				}	
					
				print ("</td>");

				
				print ("<td width='3%' align='center' bgcolor='$bkcolor'>	");
				print ("<input type='checkbox' name='$select_nick_name2' value='$select_nick_name2' onClick=\"ctr('$select_nick_name2', '$bkcolor', '$select_nick_name_check')\" id='$select_nick_name_check' />");
				print ("</td>");	
				print ("<td width='24%' align='center'>	");
					print ("<a href='neuron_page.php?id=$id' target='_blank' class='font_cell'>");
					
					if (strpos($nickname, '(+)') == TRUE)
						print ("<font color='#339900'>$nickname</font>");
					if (strpos($nickname, '(-)') == TRUE)
						print ("<font color='#CC0000'>$nickname</font>");
						
					print ("</a>");
				print ("</td>");						
						
				for ($f1=0; $f1<$n_markers; $f1++)  //$n_markers
				{
					if ($name_markers[$f1] == 'a-act2')
					{
						// Retrieve the conflict_note value from evidencepropertytyperel table:
						$evidencepropertyyperel -> retrieve_conflict_note($hippo_property_id[$name_markers[$f1]], $id);
						$conflict_note = $evidencepropertyyperel -> getConflict_note();
											
						print ("<td width='$width2' align='center' >");
						$unvetted_a_act2 = check_unvetted1($id, $hippo_property_id[a-act2], $evidencepropertyyperel);
						$color = check_color($hippo[a-act2], $unvetted_a_act2, $conflict_note);
						if ($color[1] == NULL)
							print ("$color[0] $unvetted_act2 ");	
						else	
						{
							print ("<a href='property_page_markers.php?id_neuron=$id&val_property=a-act2&color=$color[1]&page=markers' target='_blank'>");	
							print ($color[0]);	
							print ("</a>");
						}
						print ("</td>");					
					}
					else
					{						
						// Retrieve the conflict_note value from evidencepropertytyperel table:
						$evidencepropertyyperel -> retrieve_conflict_note($hippo_property_id[$name_markers[$f1]], $id);
						$conflict_note = $evidencepropertyyperel -> getConflict_note();
					
						print ("<td width='$width2' align='center' >");										
							$nam_unv1 = check_unvetted1($id, $hippo_property_id[$name_markers[$f1]], $evidencepropertyyperel);
							$color = check_color($hippo[$name_markers[$f1]], $nam_unv1, $conflict_note);
							if ($color[1] == NULL)
								print "$color[0]";	
							else	
							{
								print ("<a href='property_page_markers.php?id_neuron=$id&val_property=$name_markers[$f1]&color=$color[1]&page=markers' target='_blank'>  ");	
								print ($color[0]);
								print ("</a>");
							}
						print ("</td>");
					}
				}
				// ---------------------------------------------------------------------------------------------------------------------------------
		}

		print ("</tr>");
		print ("</table>");
		?>
		
		</div>
		</td>
	</tr>

</table>			
		
		<br /><br />		
	</td>
  </tr>
</table>
</div>
</body>
</html>
