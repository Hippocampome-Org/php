<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

$parameter=$_GET['marker'];

include ("access_db.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.evidenceevidencerel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.epdata.php');
require_once('class/class.typetyperel.php');

include ("function/name_ephys.php");
include ("function/stm_lib.php");

$type = new type($class_type);
$type -> retrive_id();
$number_type = $type->getNumber_type();
$property_1 = new property($class_property);
$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);
$evidenceevidencerel = new evidenceevidencerel($class_evidenceevidencerel);
$epdataevidencerel = new epdataevidencerel($class_epdataevidencerel);
$epdata = new epdata($class_epdata);
$typetyperel = new typetyperel();

// SEARCH Function for MARKERS: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function markers_search($evidencepropertyyperel, $property_1, $type,$predicate,$parameter)
{
	
	$new_type_id_nan = array();

	// retrieve id_property from Property table using SUBJECT and PREDICATE:
	/* if ($predicate == 'is expressed')
	{ */
		/* $predicate3[1] = 'positive';
		$predicate3[2] = 'unknown';
		$nn = 2; */
	/* } */
	/* if ($predicate == 'is not expressed')
	{
		$predicate3[1] = 'negative';
		$predicate3[2] = 'unknown';
		$nn = 2;
	}
	if ($predicate == 'unknown')
	{
		$predicate3[1] = 'unknown';
		$nn = 1;		
	} */

	$n_tot = 0;
	
	$new_type_id = NULL;
	$type_id = NULL;
	$property_1 -> retrive_ID(2, $parameter, NULL, $predicate); // Retrieve  property IDs for subject and respective predicates
	$n_property_id = $property_1 -> getNumber_type(); // Count the number of Property IDs for a given subject and predicate
	
	for ($i0=0; $i0<$n_property_id; $i0++) // For Each Property Id
	{
		$property_id = $property_1 -> getProperty_id($i0); // retrieve the  property Id
		// retrieve the Type_id from EvidencePropertyTypeRel by using property_id:
		$evidencepropertyyperel -> retrive_Type_id_by_Property_id($property_id); // retrieve the neuron types from evidencepropertytype rel
		$n_type_id = $evidencepropertyyperel -> getN_Type_id(); // Get a count of the number of neuron type Ids
		for ($i1=0; $i1<$n_type_id; $i1++) // For each Type Id
		{
			if ($predicate == 'positive')
				$type_id[$n_tot] = $evidencepropertyyperel -> getType_id_array($i1);	// Get the total type ids for positive
			else
			{
				$type_r = $evidencepropertyyperel -> getType_id_array($i1); // get the type Id for unknown
				$type_id[$n_tot] = "10_".$type_r; // Append 10_
			}					
		  $n_tot = $n_tot + 1;
		} // END $i1
	} // END $i0
		// Now, the program must remove the doubble or more type_id:	
		if ($type_id != NULL)
			$new_type_id=array_unique($type_id); // Get unique Type Ids
	
	return $new_type_id;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Neurons</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>
<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");

	/* if (strpos($id, '0_') == 1)
	{
		$id = str_replace('10_', '', $id);
	
		$type -> retrive_by_id($id);
		$status = $type -> getStatus();
	
		if ($status == 'active')
		{
			$id_t_unknown[$n_result_tot_unknown] = $id;
			$name_type_unknown[$n_result_tot_unknown] = $type -> getNickname();
			$subregion_type_unknown[$n_result_tot_unknown] = $type -> getSubregion();
			$position_type_unknown[$n_result_tot_unknown] = $type -> getPosition();
			$n_result_tot_unknown = $n_result_tot_unknown +1;
		}
	}
	else
	{
		$type -> retrive_by_id($id);
		$status = $type -> getStatus();
			
		if ($status == 'active')
		{
			$id_t[$n_result_tot] = $id;
			$name_type[$n_result_tot] = $type -> getNickname();
			$subregion_type[$n_result_tot] = $type -> getSubregion();
			$position_type[$n_result_tot] = $type -> getPosition();
			$n_result_tot = $n_result_tot +1;
		}
	} */	
	$positive_marker_id = markers_search($evidencepropertyyperel, $property_1, $type,'positive',$parameter);
	?>
<body>
	<div class="table_position_search_page">
		<table border="0" cellspacing="3" cellpadding="0" class='table_result'>
			<tr>
				<td align="center" width="5%">&nbsp;</td>
				<td align="center" width="10%">&nbsp;</td>
				<td align="center" width='30%' class="table_neuron_page3">Neurons</td>
				<td align="right" width="55%">&nbsp;</td>
			</tr>
<?php 
$n_result_tot = 0;
$id_t = Array();
$name_type = "";
$subregion_type ="";
$position_type = "";

for ($i=0; $i<count($positive_marker_id); $i++)
{
	$type -> retrive_by_id($positive_marker_id[$i]);
	$status = $type -> getStatus();
		
	if ($status == 'active')
	{
		$id_t = $positive_marker_id[$i];
		$name_type = $type -> getNickname();
		$subregion_type = $type -> getSubregion();
		$position_type = $type -> getPosition();
		$n_result_tot = $n_result_tot + 1;
		
?>			<tr>
				<td align='center' width='5%'>&nbsp;</td>
				<td align='center' width='10%' class='table_neuron_page4'><?php print $n_result_tot?></td>
				<td align='center' width='30%' class='table_neuron_page4'><a href='neuron_page.php?id=<?php echo $id_t ?>'><font class='font13'><?php echo $subregion_type." ".$name_type  ?></font></a></td>
				<td align='right' width='55%'>&nbsp;</td>
			</tr>
<?php } 
} 
$unknown_marker_id = markers_search($evidencepropertyyperel, $property_1, $type,'unknown',$parameter);
?>				
		</table>
		<table border='0' cellspacing='3' cellpadding='0' class='table_result'>
			<tr>
				<td align='center' width='5%'>&nbsp;</td>
				<td align='center' width='10%'>&nbsp;</td>
				<td align='center' width='30%' class='table_neuron_page3'> Neurons with unknown expression </td>
				<td align='right' width='55%'>&nbsp;</td>
			</tr>
<?php 
$n_result_tot_unknown = 0;
for ($i=0; $i<count($unknown_marker_id); $i++)
{
	
	$id = $unknown_marker_id[$i];
	
	if (strpos($id, '0_') == 1)
		$id = str_replace('10_', '',$id);
	
		$type -> retrive_by_id($id);
		$status = $type -> getStatus();
	
		
	
	if ($status == 'active')
	{
		$id_t_unknown= $id;
		$name_type_unknown= $type -> getNickname();
		$subregion_type_unknown= $type -> getSubregion();
		$position_type_unknown= $type -> getPosition();
		$n_result_tot_unknown = $n_result_tot_unknown +1;
		
?>			<tr>
				<td align='center' width='5%'>&nbsp;</td>
				<td align='center' width='10%' class='table_neuron_page4'><?php print $n_result_tot_unknown?></td>
				<td align='center' width='30%' class='table_neuron_page4'><a href='neuron_page.php?id=<?php echo $id_t_unknown ?>'><font class='font13'><?php echo $subregion_type_unknown." ".$name_type_unknown ?></font></a></td>
				<td align='right' width='55%'>&nbsp;</td>
			</tr>
<?php } 
} ?>
		</table>
	</div>
</body>
