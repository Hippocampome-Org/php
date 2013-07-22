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
<title>Morphology Matrix</title>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<font class="font7_B">Morphology</font> <font class="font7_A">|</font> 
			<a href='markers.php'><font class="font7">Molecular Markers</font></a> <font class="font7_A">|</font> 
			<a href='ephys.php'><font class="font7">Electrophysiology</font></a><font class="font7_A">|</font> 
			<a href='connectivity.php'><font class="font7"> Connectivity</font></a>						
		</td>
	</tr>
	</table>
	<br />

	<?php
		}
	?>
</div>	
<!-- ------------------------ -->

<div class='table_position'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="20">
    <td></td>
  </tr>
  <tr>
    <td>
		<!-- ****************  BODY **************** -->

		<font class='font1'>Morphology matrix</font> &nbsp; &nbsp;&nbsp; &nbsp;
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
		<img src="images/morphology/axons_present.png" width="10px" border="0"/> <font class='font5'>Axon present </font> &nbsp; &nbsp; 
		<img src="images/morphology/dendrites_present.png" width="10px" border="0"/> <font class='font5'>Dendrite present </font>&nbsp; &nbsp; 
		<img src="images/morphology/somata_present.png" width="10px" border="0"/> <font class='font5'>Axon & Dendrite present </font> &nbsp; &nbsp; 
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
		  		<table border="0" cellspacing="1" cellpadding="0" class='table_10'>
				  <tr>
					<td width="26.5%" align="center">
					</td>
					<td width="8%" align="center" bgcolor="#770000">
						<font class='font_table_index2'>DG</font>
					</td>
					<td width="10%" align="center" bgcolor="#C08181">
						<font class='font_table_index2'>CA3</font>
					</td>
					<td width="8%" align="center" bgcolor="#FFFF99">
						<font class='font_table_index'>CA2</font>
					</td>
					<td width="8%" align="center" bgcolor="#FF6103">
						<font class='font_table_index'>CA1</font>
					</td>
					<td width="6%" align="center" bgcolor="#FFCC33">
						<font class='font_table_index'>SUB</font>
					</td>
					<td width="12%" align="center" bgcolor="#336633">
						<font class='font_table_index2'>EC</font>			
					</td>					
				  </tr>
				</table>
		</td>
	</tr>

	<tr>
		<td>
		
			<table border="1" cellspacing="0" cellpadding="0" class='table_11'>
			  <tr height="50px">
				<td width="26.3%" align="center" colspan="3">	
					<font class='font1'>Neuron Type	</font>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SMo.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SMi.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SG.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/H.png" width="10px" border='0'/>
				</td>
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SLM.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SR.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SL.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/SO.png" width="10px" border='0'/>
				</td>			
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SLM.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SR.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/SO.png" width="10px" border='0'/>
				</td>			
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SLM.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SR.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/SO.png" width="10px" border='0'/>
				</td>			
	
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SM.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/PL.png" width="10px" border='0'/>
				</td>	
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/I.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/II.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" >	
					<img src="images/name/III.png" width="10px" border='0'/>
				</td>	
				<td width="2%" align="center" >	
					<img src="images/name/IV.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/V.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" >	
					<img src="images/name/VI.png" width="10px" border='0'/>
				</td>
			  </tr>
			</table>

		</td>
	</tr>

	<tr>
		<td>
		<div class="divinterno">
		
		
		<form name="nomeform">
		
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
					//$type -> retrive_by_id($id_search[$W1]);
					//$DG_position[$n_DG] = $type->getPosition();
					// $DG_position[$n_DG]=$id_search[$W1];
					$DG_position[$n_DG] = $id_search[$W1];					
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
			$hippo = array("DG_SMo"=>NULL,"DG_SMi"=>NULL,"DG_SG"=>NULL,"DG_H"=>NULL,
							"CA3_SLM" =>NULL, "CA3_SR" =>NULL, "CA3_SL" =>NULL, "CA3_SP" =>NULL, "CA3_SO" =>NULL,		
							"CA2_SLM" =>NULL, "CA2_SR" =>NULL, "CA2_SP" =>NULL, "CA2_SO" =>NULL,	
							"CA1_SLM" =>NULL, "CA1_SR" =>NULL, "CA1_SP" =>NULL, "CA1_SO" =>NULL,
							"SUB_SM" =>NULL, "SUB_SP" =>NULL, "SUB_PL" =>NULL,
							"EC_I" =>NULL, "EC_II" =>NULL, "EC_III" =>NULL, "EC_IV" =>NULL, "EC_V" =>NULL, "EC_VI" =>NULL );
			
			$hippo_axon = array("DG_SMo"=>0,"DG_SMi"=>0,"DG_SG"=>0,"DG_H"=>0,
							"CA3_SLM" =>0, "CA3_SR" =>0, "CA3_SL" =>0, "CA3_SP" =>0, "CA3_SO" =>0,		
							"CA2_SLM" =>0, "CA2_SR" =>0, "CA2_SP" =>0, "CA2_SO" =>0,	
							"CA1_SLM" =>0, "CA1_SR" =>0, "CA1_SP" =>0, "CA1_SO" =>0,
							"SUB_SM" =>0, "SUB_SP" =>0, "SUB_PL" =>0,
							"EC_I" =>0, "EC_II" =>0, "EC_III" =>0, "EC_IV" =>0, "EC_V" =>0, "EC_VI" =>0 );
			
			$hippo_dendrite = array("DG_SMo"=>0,"DG_SMi"=>0,"DG_SG"=>0,"DG_H"=>0,
							"CA3_SLM" =>0, "CA3_SR" =>0, "CA3_SL" =>0, "CA3_SP" =>0, "CA3_SO" =>0,		
							"CA2_SLM" =>0, "CA2_SR" =>0, "CA2_SP" =>0, "CA2_SO" =>0,	
							"CA1_SLM" =>0, "CA1_SR" =>0, "CA1_SP" =>0, "CA1_SO" =>0,
							"SUB_SM" =>0, "SUB_SP" =>0, "SUB_PL" =>0,
							"EC_I" =>0, "EC_II" =>0, "EC_III" =>0, "EC_IV" =>0, "EC_V" =>0, "EC_VI" =>0 );

			$hippo_id_property = array("DG_SMo"=>0,"DG_SMi"=>0,"DG_SG"=>0,"DG_H"=>0,
							"CA3_SLM" =>0, "CA3_SR" =>0, "CA3_SL" =>0, "CA3_SP" =>0, "CA3_SO" =>0,		
							"CA2_SLM" =>0, "CA2_SR" =>0, "CA2_SP" =>0, "CA2_SO" =>0,	
							"CA1_SLM" =>0, "CA1_SR" =>0, "CA1_SP" =>0, "CA1_SO" =>0,
							"SUB_SM" =>0, "SUB_SP" =>0, "SUB_PL" =>0,
							"EC_I" =>0, "EC_II" =>0, "EC_III" =>0, "EC_IV" =>0, "EC_V" =>0, "EC_VI" =>0 );
		
			// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++				
																
			$n_DG = 0;	
			if ($research) 
				$id = $id_search[$i];
			else
				$id = $type->getID_array($i);
						
			$type -> retrive_by_id($id);
			$nickname = $type->getNickname();
			$position = $type->getPosition();
								
			// retrive propertytyperel.property_id By type.id 
			$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id);
		
			$n_property_id = $evidencepropertyyperel -> getN_Property_id();
			$q=0;
			for ($i5=0; $i5<$n_property_id; $i5++)
			{
				$Property_id = $evidencepropertyyperel -> getProperty_id_array($i5);

				$property -> retrive_by_id($Property_id);

				$rel = $property->getRel();
				$part1 = $property->getPart();

				if (($rel == 'in') && ($part1 != 'somata'))
				{
					$id_p[$q] = $property->getID();
					$val[$q] = $property->getVal();
					$part[$q] = $property->getPart();
					$q = $q+1;
				}	
			}

			for ($ii=0; $ii<$q; $ii++)
			{	
				$val_array=explode(':', $val[$ii]);
				
				// DG +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'DG')
				{					
					$ttype = "DG_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;	
						
					$hippo_id_property[$ttype] =$id_p[$ii]; 
				}
				
				// CA3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'CA3')
				{
					$ttype = "CA3_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];
				}			
				// CA2 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'CA2')
				{
					$ttype = "CA2_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}			
				// CA1 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'CA1')
				{
					$ttype = "CA1_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}					
				// SUB +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'SUB')
				{
					$ttype = "SUB_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}				
				// EC +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'EC')
				{
					$ttype = "EC_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}							
			}

			// DG ---------------------------------------------------------------------
			$hippo[DG_SMo]=check_axon_dendrite('DG_SMo',$hippo_axon, $hippo_dendrite);
			$hippo[DG_SMi]=check_axon_dendrite('DG_SMi',$hippo_axon, $hippo_dendrite);
			$hippo[DG_SG]=check_axon_dendrite('DG_SG',$hippo_axon, $hippo_dendrite);			
			$hippo[DG_H]=check_axon_dendrite('DG_H',$hippo_axon, $hippo_dendrite);	
			// CA3 ---------------------------------------------------------------------
			$hippo[CA3_SLM]=check_axon_dendrite('CA3_SLM',$hippo_axon, $hippo_dendrite);
			$hippo[CA3_SR]=check_axon_dendrite('CA3_SR',$hippo_axon, $hippo_dendrite);
			$hippo[CA3_SL]=check_axon_dendrite('CA3_SL',$hippo_axon, $hippo_dendrite);			
			$hippo[CA3_SP]=check_axon_dendrite('CA3_SP',$hippo_axon, $hippo_dendrite);						
			$hippo[CA3_SO]=check_axon_dendrite('CA3_SO',$hippo_axon, $hippo_dendrite);	
			// CA2 ---------------------------------------------------------------------
			$hippo[CA2_SLM]=check_axon_dendrite('CA2_SLM',$hippo_axon, $hippo_dendrite);
			$hippo[CA2_SR]=check_axon_dendrite('CA2_SR',$hippo_axon, $hippo_dendrite);		
			$hippo[CA2_SP]=check_axon_dendrite('CA2_SP',$hippo_axon, $hippo_dendrite);						
			$hippo[CA2_SO]=check_axon_dendrite('CA2_SO',$hippo_axon, $hippo_dendrite);				
			// CA1 ---------------------------------------------------------------------
			$hippo[CA1_SLM]=check_axon_dendrite('CA1_SLM',$hippo_axon, $hippo_dendrite);
			$hippo[CA1_SR]=check_axon_dendrite('CA1_SR',$hippo_axon, $hippo_dendrite);		
			$hippo[CA1_SP]=check_axon_dendrite('CA1_SP',$hippo_axon, $hippo_dendrite);						
			$hippo[CA1_SO]=check_axon_dendrite('CA1_SO',$hippo_axon, $hippo_dendrite);	
			// SUB ---------------------------------------------------------------------
			$hippo[SUB_SM]=check_axon_dendrite('SUB_SM',$hippo_axon, $hippo_dendrite);
			$hippo[SUB_SP]=check_axon_dendrite('SUB_SP',$hippo_axon, $hippo_dendrite);		
			$hippo[SUB_PL]=check_axon_dendrite('SUB_PL',$hippo_axon, $hippo_dendrite);						
			// EC ---------------------------------------------------------------------
			$hippo[EC_I]=check_axon_dendrite('EC_I',$hippo_axon, $hippo_dendrite);
			$hippo[EC_II]=check_axon_dendrite('EC_II',$hippo_axon, $hippo_dendrite);
			$hippo[EC_III]=check_axon_dendrite('EC_III',$hippo_axon, $hippo_dendrite);
			$hippo[EC_IV]=check_axon_dendrite('EC_IV',$hippo_axon, $hippo_dendrite);
			$hippo[EC_V]=check_axon_dendrite('EC_V',$hippo_axon, $hippo_dendrite);
			$hippo[EC_VI]=check_axon_dendrite('EC_VI',$hippo_axon, $hippo_dendrite);

			if (!$research)
			{		
				if ( ($position == 201) || ($position == 301) || ($position == 401) || ($position == 501) || ($position == 601))    		
				{										
					print ("<tr height='4px'><td colspan='35' bgcolor='#FF0000'></td></tr>");
				}
			}
			else
			{
				if ( ($id == $first_CA3) || ($id == $first_CA2) || ($id == $first_CA1) || ($id == $first_SUB) || ($id == $first_EC))
				{
				 	print ("<tr height='4px'><td colspan='35' bgcolor='#FF0000'></td></tr>");
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
					$bkcolor='#C08181';
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
							print ("<font class='font2' color='#770000'><strong>DG</strong></font> ");
//					if ($id == $DG_position[1])
//						print ("<font class='font2' color='#770000'>($n_DG)</font> ");									
					if ($id == $first_CA3)
						print ("<font class='font2' color='#C08181'> <strong>CA3</strong> </font> ");
//					if ($id == $CA3_position[1])
//						print ("<font class='font2' color='#770000'>($n_CA3)</font> ");													
					if ($id == $first_CA2)
						print ("<font class='font2' color='#FFCC00'> <strong>CA2</strong> </font> ");
//					if ($id == $CA2_position[1])
//						print ("<font class='font2' color='#770000'>($n_CA2)</font> ");											
					if ($id == $first_CA1)
						print ("<font class='font2' color='#FF6103'> <strong>CA1</strong> </font> ");
//					if ($id == $CA1_position[1])
//						print ("<font class='font2' color='#770000'>($n_CA1)</font> ");													
					if ($id == $first_SUB)
						print ("<font class='font2' color='#FFCC33'> <strong>SUB</strong> </font> ");
//					if ($id == $SUB_position[1])
//						print ("<font class='font2' color='#770000'>($n_SUB)</font> ");											
					if ($id == $first_EC)
						print ("<font class='font2' color='#336633'> <strong>EC</strong> </font> ");
//					if ($id == $EC_position[1])
//						print ("<font class='font2' color='#770000'>($n_EC)</font> ");															
				}
				else
				{
					if ($position == 101)
						print ("<font class='font2' color='#770000'> <strong>DG</strong> </font> ");				
					if ($position == 102)
						print ("<font class='font2' color='#770000'> (18) </font> ");				
					if ($position == 201)
						print ("<font class='font2' color='#C08181'> <strong>CA3</strong> </font> ");		
					if ($position == 202)
						print ("<font class='font2' color='#C08181'> (25) </font> ");				
					if ($position == 301)
						print ("<font class='font2' color='#FFCC00'> <strong>CA2</strong> </font> ");			
					if ($position == 302)
						print ("<font class='font2' color='#FFCC00'> (5) </font> ");				
					if ($position == 401)
						print ("<font class='font2' color='#FF6103'> <strong>CA1</strong> </font> ");		
					if ($position == 402)
						print ("<font class='font2' color='#FF6103'> (40) </font> ");				
					if ($position == 501)
						print ("<font class='font2' color='#FFCC33'> <strong>SUB</strong> </font> ");				
					if ($position == 502)
						print ("<font class='font2' color='#FFCC33'> (3) </font> ");				
					if ($position == 601)
						print ("<font class='font2' color='#336633'> <strong>EC</strong> </font> ");	
					if ($position == 602)
						print ("<font class='font2' color='#336633'> (31) </font> ");				
				}	
					
					
				print ("</td>");

				print ("<td width='3%' align='center'  bgcolor='$bkcolor'>");
				print ("<input type='checkbox' name='$select_nick_name2' value='$select_nick_name2' onClick=\"ctr('$select_nick_name2', '$bkcolor', '$select_nick_name_check')\" id='$select_nick_name_check' />");
				print ("</td>");


				print ("<td width='20%' align='right'>");
			
					print ("<a href='neuron_page.php?id=$id' target='_blank' class='font_cell'>");
					
					if (strpos($nickname, '(+)') == TRUE)
						print ("<font color='#339900'>$nickname</font>");
					if (strpos($nickname, '(-)') == TRUE)
						print ("<font color='#CC0000'>$nickname</font>");
					
					print ("</a>");
				print ("</td>");


				// DG ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					$select_morp_DG_SMo = $select_morp.$i;
					print ("<td width='2%' align='center' id='$select_morp_DG_SMo'>");	
					
						$unvetted_DG_SMo = check_unvetted1($id, $hippo_id_property[DG_SMo], $evidencepropertyyperel);						
						$color = check_color($hippo[DG_SMo], $unvetted_DG_SMo);
						
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_SMo&color=$color[1]&page=1' target='_blank'>");
						print ($color[0]);	
						print ("</a>");
					}
					print ("</td>");


					print ("<td width='2%' align='center' id='$select_morp1'>");
						
						$unvetted_DG_SMi = check_unvetted1($id, $hippo_id_property[DG_SMi], $evidencepropertyyperel);
						$color = check_color($hippo[DG_SMi], $unvetted_DG_SMi);
						
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_SMi&color=$color[1]&page=1' target='_blank'>");
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_DG_SG = check_unvetted1($id, $hippo_id_property[DG_SG], $evidencepropertyyperel);
						$color = check_color($hippo[DG_SG], $unvetted_DG_SG);
						
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_SG&color=$color[1]&page=1' target='_blank'>");
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_DG_H = check_unvetted1($id, $hippo_id_property[DG_H], $evidencepropertyyperel);
						$color = check_color($hippo[DG_H], $unvetted_DG_H);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_H&color=$color[1]&page=1' target='_blank'>");
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");								
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				
				// CA3 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_CA3_SLM = check_unvetted1($id, $hippo_id_property[CA3_SLM], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SLM], $unvetted_CA3_SLM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SLM&color=$color[1]&page=1' target='_blank'>");	
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_CA3_SR = check_unvetted1($id, $hippo_id_property[CA3_SR], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SR], $unvetted_CA3_SR);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SR&color=$color[1]&page=1' target='_blank'>");		
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_CA3_SL = check_unvetted1($id, $hippo_id_property[CA3_SL], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SL], $unvetted_CA3_SL);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SL&color=$color[1]&page=1' target='_blank'>");		
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");
					

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA3_SP = check_unvetted1($id, $hippo_id_property[CA3_SP], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SP], $unvetted_CA3_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SP&color=$color[1]&page=1' target='_blank'>");		
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");		
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_CA3_SO = check_unvetted1($id, $hippo_id_property[CA3_SO], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SO], $unvetted_CA3_SO);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SO&color=$color[1]&page=1' target='_blank'>");		
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");												
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++				
				
				// CA2 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_CA2_SLM = check_unvetted1($id, $hippo_id_property[CA2_SLM], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SLM], $unvetted_CA2_SLM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SLM&color=$color[1]&page=1' target='_blank'>");	
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA2_SR = check_unvetted1($id, $hippo_id_property[CA2_SR], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SR], $unvetted_CA2_SR);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SR&color=$color[1]&page=1' target='_blank'>");		
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");
						

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA2_SP = check_unvetted1($id, $hippo_id_property[CA2_SP], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SP], $unvetted_CA2_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SP&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");		
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_CA2_SO = check_unvetted1($id, $hippo_id_property[CA2_SO], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SO], $unvetted_CA2_SO);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SO&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");												
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					
				
				// CA1 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_CA1_SLM = check_unvetted1($id, $hippo_id_property[CA1_SLM], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SLM], $unvetted_CA1_SLM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SLM&color=$color[1]&page=1' target='_blank'>");		
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_CA1_SR = check_unvetted1($id, $hippo_id_property[CA1_SR], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SR], $unvetted_CA1_SR);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SR&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
						

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA1_SP = check_unvetted1($id, $hippo_id_property[CA1_SP], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SP], $unvetted_CA1_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SP&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");		
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
							
						$unvetted_CA1_SO = check_unvetted1($id, $hippo_id_property[CA1_SO], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SO], $unvetted_CA1_SO);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SO&color=$color[1]&page=1' target='_blank'>");				
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");																			
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					
				
				// SUB ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_SUB_SM = check_unvetted1($id, $hippo_id_property[SUB_SM], $evidencepropertyyperel);
						$color = check_color($hippo[SUB_SM], $unvetted_SUB_SM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=SUB_SM&color=$color[1]&page=1' target='_blank'>");				
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_SUB_SP = check_unvetted1($id, $hippo_id_property[SUB_SP], $evidencepropertyyperel);
						$color = check_color($hippo[SUB_SP], $unvetted_SUB_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=SUB_SP&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
						

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_SUB_PL = check_unvetted1($id, $hippo_id_property[SUB_PL], $evidencepropertyyperel);	
						$color = check_color($hippo[SUB_PL], $unvetted_SUB_PL);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=SUB_PL&color=$color[1]&page=1' target='_blank'>");				
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");																				
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					
				
				// EC ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_EC_I = check_unvetted1($id, $hippo_id_property[EC_I], $evidencepropertyyperel);	
						$color = check_color($hippo[EC_I], $unvetted_EC_I);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_I&color=$color[1]&page=1' target='_blank'>");				
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_II = check_unvetted1($id, $hippo_id_property[EC_II], $evidencepropertyyperel);
						$color = check_color($hippo[EC_II], $unvetted_EC_II);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_II&color=$color[1]&page=1' target='_blank'>");				
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
					

					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_III = check_unvetted1($id, $hippo_id_property[EC_III], $evidencepropertyyperel);
						$color = check_color($hippo[EC_III], $unvetted_EC_III);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_III&color=$color[1]&page=1' target='_blank'>");					
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_IV = check_unvetted1($id, $hippo_id_property[EC_IV], $evidencepropertyyperel);
						$color = check_color($hippo[EC_IV], $unvetted_EC_IV);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_IV&color=$color[1]&page=1' target='_blank'>");				
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_V = check_unvetted1($id, $hippo_id_property[EC_V], $evidencepropertyyperel);
						$color = check_color($hippo[EC_V], $unvetted_EC_V);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_V&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
					

					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_VI = check_unvetted1($id, $hippo_id_property[EC_VI], $evidencepropertyyperel);
						$color = check_color($hippo[EC_VI], $unvetted_EC_VI);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_VI&color=$color[1]&page=1' target='_blank'>");			
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");																			
					// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
				print ("</tr>");
		}
		
		print ("</table>");
		?>
		
		</form>
		
		
		
		</div>
		</td>
	</tr>

	</table>		
		
		
	</td>
  </tr>
</table>
</div>
</body>
</html>
