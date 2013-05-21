<?php
session_start();
include ("access_db.php");

$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");

require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.temporary_result_neurons.php');


// FUNCTIONS -------------------------------------------------------------------------------
// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel)
{

	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************



function check_color($variable, $unvetted)
{
	if ($variable == 'red')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/axons_present_unvetted.png' border='0'/>";
		else
			$link[0] = "<img src='images/morphology/axons_present.png' border='0'/>";
		
		$link[1] = $variable;
	
	}
	if ($variable == 'blue')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/dendrites_present_unvetted.png' border='0'/>";	
		else	
			$link[0] = "<img src='images/morphology/dendrites_present.png' border='0'/>";	
		
		$link[1] = $variable;
	}
	if ($variable == 'violet')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/somata_present_unvetted.png' border='0'/>";
		else	
			$link[0] = "<img src='images/morphology/somata_present.png' border='0'/>";
		$link[1] = $variable;
	}
	if ($variable == NULL)
	{
		$link[0] = "<img src='images/blank_morphology.png' border='0'/>";
		$link[1] = $variable;
	}	
	
	return ($link);
}

function check_axon_dendrite($variable, $hippo_axon, $hippo_dendrite)
{
	if (($hippo_axon[$variable] == 1) && ($hippo_dendrite[$variable] == 1))
		$result = 'violet';
	if (($hippo_axon[$variable] == 1) && ($hippo_dendrite[$variable] == 0))
		$result = 'red';
	if (($hippo_axon[$variable] == 0) && ($hippo_dendrite[$variable] == 1))
		$result = 'blue';

	return ($result);
}	

// ------------------------------------------------------------------------------------------

$color_selected ='#EBF283';


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

$hippo_select = $_SESSION['hippo_select'];

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
<title>Help</title>
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
	<form action="morphology.php" method="post" style='display:inline'>
		<input type="submit" name='browsing' value='Browse' class="main_button"/>
	</form>
	<form action="search.php" method="post" style='display:inline' target="_blank">
		<input type="submit" name='searching' value='Search' class="main_button" />
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
			<font class='font1'><em>Morphology:</em></font> &nbsp; &nbsp;
			<ul> 
				<li><a href='Help_Morphological_Abbreviations.php' target="_blank"><font class="font7"> Abbreviations</font></a></li>
  			<li><a href='Help_Morphological_Bibliographic_Protocols.php' target="_blank"><font class="font7"> Bibliographic Protocols</font></a></li>
  			<li><a href='Help_Morphological_Interpretations_Brief.php' target="_blank"><font class="font7"> Interpretations (Brief)</font></a>
  			<li><a href='Help_Morphological_Interpretations_Full.php' target="_blank"><font class="font7"> Interpretations (Full)</font></a></li>
			</ul>
			<font class='font1'><em>Molecular markers:</em></font> &nbsp; &nbsp;
			<ul>
				<li><a href='Help_Marker_Abbreviations.php' target="_blank"><font class="font7"> Abbreviations</font></a></li>
			</ul>
			<font class='font1'><em>Electrophysiology:</em></font> &nbsp; &nbsp;
			<ul>
  			<li><a href='Help_Electrophysiological_Abbreviations_and_Definitions.php' target="_blank"><font class="font7"> Abbreviations and Definitions</font></a></li>
			</ul>
			<font class='font1'><em>Connectivity:</em></font> &nbsp; &nbsp;			
			<ul>
				<li><a href='Help_Connectivity.php' target="_blank"><font class="font7"> Definitions and Protocols</font></a></li>  			
			</ul>
			<font class='font1'><em>Miscellaneous:</em></font> &nbsp; &nbsp;			
			<ul>
  			<li><a href='Help_In_Progress.php' target="_blank"><font class="font7"> In Progress ...</font></a></li>
  			<li><a href='Help_Release_Notes.php' target="_blank"><font class="font7"> Release Notes</font></a></li>
  			<li><a href='Hippocampome_Video_Overview/Hippocampome_Video_Overview_player.html' target="_blank"><font class="font7"> Hippocampome Video Overview</font></a></li>
  			<li><a href='Help_Other_Useful_Links.php' target="_blank"><font class="font7"> Other Useful Links</font></a></li>
  			<li><a href='Help_Acknowledgements.php' target="_blank"><font class="font7"> Acknowledgements</font></a></li>
			</ul>
						
		</td>
	</tr>
	</table>
	<br />

	<?php
		}
	?>
</div>	
<!-- ------------------------ -->

</body>

</html>
