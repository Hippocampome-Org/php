<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
	
include ("access_db.php");
include ("function/ephys_unit_table.php");
include ("function/ephys_num_decimals_table.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.epdata.php');
require_once('class/class.temporary_result_neurons.php');


function print_ephys_value_and_hover($param_str, $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2) {
	include ("function/ephys_unit_table.php");
	include ("function/ephys_num_decimals_table.php");
	
	$num_decimals = $ephys_num_decimals_table[$param_str];
	$units = $ephys_unit_table[$param_str];
	if ($units == 'MOhm')
		$units = 'M&Omega;';
	
	print ("<td width='7%' align='center' >");
	if ($unvetted_ephys2[$param_str] == 1)
		$color_unvetted = 'font4_unvetted';
	else
		$color_unvetted = 'font4';
		
	if ($ephys2[$param_str] != NULL)
		$formatted_value = number_format($ephys2[$param_str], $num_decimals, ".", "");
	else
		$formatted_value = NULL;
	
	if ($weighted_std_ephys2[$param_str] == 0);
	else
		$weighted_std_ephys2[$param_str] = number_format($weighted_std_ephys2[$param_str], $num_decimals,".","");
	
	
	if ($param_str == 'sag_ratio')
		$span_class_str = 'link_right';
	else
		$span_class_str = 'link_left';
	
	if ($number_type - $i <= 4)
		$span_class_str = $span_class_str . '_bottom';	
	
	print ("<span class=$span_class_str><a href='property_page_ephys.php?id_ephys=$id_ephys2[$param_str]&id_neuron=$id_type&ep=$param_str' class='$color_unvetted'>$formatted_value");
	
	//if ($nn_ephys2[$param_str] == 1)
	//	$print_str = $formatted_value . ' ' . $units;
	//else
		$print_str = $formatted_value . ' &plusmn; ' . $weighted_std_ephys2[$param_str] . ' ' . $units;
	
	print ("<span>$print_str<BR>");
	print ("Sources: $nn_ephys2[$param_str]<BR>");
	print ("Total cells: $tot_n1_ephys2[$param_str]<BR>");	
	print ("</span></a></span></td>");
}



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

$epdataevidencerel = new epdataevidencerel($class_epdataevidencerel);

$epdata = new epdata($class_epdata);

?>


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
<title>Ephys Matrix</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>	
		
<div class='title_area'>
	<font class="font1">Browse electrophysiology matrix</font>
</div>

<!--  submenu no tabs
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
					<a href='morphology.php'><font class="font7">Morphology</font> <font class="font7_A">|</font> 
					<a href='markers.php'><font class="font7"> Markers</font> </a> <font class="font7_A">|</font> 
					<font class="font7_B">Electrophysiology</font> <font class="font7_A">|</font> 
					<a href='connectivity.php'><font class="font7"> Connectivity</font></a>
					</font>	
				</td>
			</tr>
			</table>
	<?php
		}
	?>		
</div>
-->
<!-- ------------------------ -->

<div class="table_position">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr>
    <td>
		<!-- ****************  BODY **************** -->
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
		<font class='font5'><strong>Legend:</strong> </font>&nbsp;
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#339900" size="2"> +/green: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Excitatory</font>
		&nbsp; &nbsp; 
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#CC0000" size="2"> -/red: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Inhibitory</font>
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>Values presented are means across relevant sources weighted by the source population size.  Hovering over a value shows weighted mean &plusmn; SD.</font>
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>Pale versions of the colors in the matrix indicate interpretations of neuronal property information that have not yet been fully verified.</font>
		<br /><br />
			
				
<table border="0" cellspacing="0" cellpadding="0" class="tabellauno">
	<tr>
 		<td>
		  		<table border="0" cellspacing="1" cellpadding="0" class="table_10">
				  <tr>
					<td width="30%" align="center">
						<font class='font1'>Neuron Type	</font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>V<sub>rest</sub><br/><small>(mV)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>R<sub>in</sub><br/><small>(M&Omega;)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>&tau;<sub>m</sub><br/><small>(ms)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>V<sub>thresh</sub><br/><small>(mV)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>Fast AHP<br/><small>(mV)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>AP<sub>ampl</sub><br/><small>(mV)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>AP<sub>width</sub><br/><small>(ms)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>Max F.R.<br/><small>(Hz)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>Slow AHP<br/><small>(mV)</small></font>
					</td>
					<td width="7%" align="center" bgcolor="#999999">
						<font class='font_table_index5'>Sag ratio</font>
					</td>
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
		
		print ("<table border='1' cellspacing='1' cellpadding='0' class='tabelladue1'>");
		
		$n_ephys = 10;
		
		$ephys = array("0"=>"Vrest", "1"=>"Rin","2"=>"tm","3"=>"Vthresh", "4"=>"fast_AHP",
						"5" =>"AP_ampl", "6" =>"AP_width", "7" =>"max_fr", "8" =>"slow_AHP", "9" =>"sag_ratio");		
	
		// Retrive the NICKNAME in table TYPE 		
		for ($i=0; $i<$number_type; $i++) //$number_type
		{
			$model_ability = 0;
		
			$ephys2 = array("Vrest"=>NULL, "Rin"=>NULL,"tm"=>NULL, "Vthresh"=>NULL, "fast_AHP"=>NULL,
							"AP_ampl" =>NULL, "AP_width" =>NULL, "max_fr" =>NULL, "solw_AHP" =>NULL, "sag_ratio" =>NULL);
			$id_ephys2 = array("Vrest"=>NULL, "Rin"=>NULL,"tm"=>NULL, "Vthresh"=>NULL, "fast_AHP"=>NULL,			
							"AP_ampl" =>NULL, "AP_width" =>NULL, "max_fr" =>NULL, "solw_AHP" =>NULL, "sag_ratio" =>NULL);			

			$unvetted_ephys2 = array("Vrest"=>NULL, "Rin"=>NULL,"tm"=>NULL, "Vthresh"=>NULL, "fast_AHP"=>NULL,			
							"AP_ampl" =>NULL, "AP_width" =>NULL, "max_fr" =>NULL, "solw_AHP" =>NULL, "sag_ratio" =>NULL);	
						
														
			// retrieve the id_type from Type
			if ($research)
				$id_type = $id_search[$i];
			else
				$id_type = $type->getID_array($i);

			$type -> retrive_by_id($id_type);
			$nickname_type = $type->getNickname();
			$position = $type->getPosition();
			
			// retrieve the id_property from Property by using subject
			for ($i1=0; $i1<$n_ephys; $i1++)
			{
				$name_epys= $ephys[$i1];
				
				$property ->  retrive_ID(3, $name_epys, NULL, NULL);
				
				$n_id_property = $property -> getNumber_type();
				
				for ($ii2=0; $ii2<$n_id_property; $ii2++)
				{
					$evidence_id = NULL;
					$property_id = $property -> getProperty_id($ii2);
					
					// Keep only property_id related by id_type;
					// and retrieve id_evidence by these id:
					$evidencepropertyyperel -> retrive_evidence_id($property_id, $id_type);
					$nn = $evidencepropertyyperel ->getN_evidence_id();
					
					if ($nn == 0);
					else {  // there are more VALUE1:			
						for ($t1=0; $t1<$nn; $t1++) {
							$evidence_id = $evidencepropertyyperel -> getEvidence_id_array($t1);
							$epdataevidencerel -> retrive_Epdata($evidence_id);							
							$epdata_id = $epdataevidencerel -> getEpdata_id();																	
							$epdata -> retrive_all_information($epdata_id);
							
							$value1 = $epdata -> getValue1();
							$value2 = $epdata -> getValue2();
							if($value2)								
								$final_value_array[$t1] = ($value1 + $value2) / 2;
							else
								$final_value_array[$t1] = $value1;
							
							$n_measurement = $epdata -> getN();
							if (!$n_measurement)
								$n_measurement = 1;
							$n_array[$t1] = $n_measurement;
						}
						
						$tot_value = 0;
						$tot_n = 0;
						$tot_n_squared = 0;
						$weighted_sum = 0;
						for ($y1=0; $y1<$nn; $y1++) {
							$tot_value = $tot_value + $final_value_array[$y1];
							$tot_n = $tot_n + $n_array[$y1];
							$tot_n_squared = $tot_n_squared + pow($n_array[$y1],2);
							$weighted_sum = $weighted_sum + ($final_value_array[$y1] * $n_array[$y1]);
						}
							
						//$mean_value1 = $tot_value1 / $nn;
						
						// calculate weighted mean
						if ($tot_n != 0)
							$mean_value = $weighted_sum / $tot_n;
						else
							$mean_value = -999999; // print a value to indicate an error; div by 0						
						
						// calculated weighted variance
						if ($nn == 1)
							$weighted_var = 0;
						else {
							$weighted_var_sum = 0;
							for ($y2=0; $y2<$nn; $y2++)
								$weighted_var_sum = $weighted_var_sum + ($n_array[$y2] * pow($final_value_array[$y2] - $mean_value, 2));
	
							$weighted_var = $weighted_var_sum / $tot_n;
						}
						
						$weighted_std = sqrt($weighted_var);						
						
						$ephys2[$name_epys] = $mean_value;
						$id_ephys2[$name_epys] = $epdata_id;
						$nn_ephys2[$name_epys] = $nn;
						$tot_n1_ephys2[$name_epys] = $tot_n;
						$weighted_std_ephys2[$name_epys] = $weighted_std;
					}
		
					// Check the UNVETTED color: ***************************************************************************
					$evidencepropertyyperel -> retrive_unvetted($id_type, $property_id);
					$unvetted = $evidencepropertyyperel -> getUnvetted();					
					$unvetted_ephys2[$name_epys]=$unvetted;
						
					$property_id_ephys2[$name_epys] =  $property_id;								
				}
			}

			if (!$research)
			{
				if ( ($position == 201) || ($position == 301) || ($position == 401) || ($position == 501) || ($position == 601))    		
				{										
					print ("<tr height='4px'><td colspan='35' bgcolor='#FF0000'></td></tr>");
				}
			}
			else
			{
				if ( ($id_type == $first_CA3) || ($id_type == $first_CA2) || ($id_type == $first_CA1) || ($id_type == $first_SUB) || ($id_type == $first_EC))
				{
				 	print ("<tr height='4px'><td colspan='35' bgcolor='#FF0000'></td></tr>");
				}
			}			
			
			$select_nick_name2 = str_replace(':', '_', $nickname_type);
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
					if ($id_type == $first_DG)
							print ("<font class='font2' color='#770000'> <strong>DG</strong> </font> ");		
					if ($id_type == $first_CA3)
						print ("<font class='font2' color='#BF7474'> <strong>CA3</strong> </font> ");						
					if ($id_type == $first_CA2)
						print ("<font class='font2' color='#FFCC00'> <strong>CA2</strong> </font> ");					
					if ($id_type == $first_CA1)
						print ("<font class='font2' color='#FF6103'> <strong>CA1</strong> </font> ");							
					if ($id_type == $first_SUB)
						print ("<font class='font2' color='#FFCC33'> <strong>SUB</strong> </font> ");					
					if ($id_type == $first_EC)
						print ("<font class='font2' color='#336633'> <strong>EC</strong> </font> ");									
				}
				else
				{	
					if ($position == 101)
						print ("<font class='font2' color='#770000'> <strong>DG</strong> </font> ");				
					if ($position == 102)
						print ("<font class='font2' color='#770000'> (18) </font> ");				
					if ($position == 201)
						print ("<font class='font2' color='#BF7474'> <strong>CA3</strong> </font> ");		
					if ($position == 202)
						print ("<font class='font2' color='#BF7474'> (25) </font> ");				
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

				print ("<td width='3%' align='center' bgcolor='$bkcolor'>	");
				print ("<input type='checkbox' name='$select_nick_name2' value='$select_nick_name2' onClick=\"ctr('$select_nick_name2', '$bkcolor', '$select_nick_name_check')\" id='$select_nick_name_check' />");
				print ("</td>");

			
				print ("<td width='23.5%' align='center'>	");

					print ("<a href='neuron_page.php?id=$id_type' class='font_cell'>");
					
					if (strpos($nickname_type, '(+)') == TRUE)
						print ("<font color='#339900'>$nickname_type</font>");
					if (strpos($nickname_type, '(-)') == TRUE)
						print ("<font color='#CC0000'>$nickname_type</font>");
						
					print ("</a>");
				print ("</td>");

			// ---------------------------------------------------------------------------------------------------------------------------------------------		
				print_ephys_value_and_hover('Vrest', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
//				                   property_page_ephys.php?id_ephys=                 &id_neuron=        &ep=Vrest
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[Vrest]&id_neuron=$id_type&ep=Vrest' class='$color_unvetted'>$formatted_value</a></td>");

				print_ephys_value_and_hover('Rin', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[Rin]&id_neuron=$id_type&ep=Rin' class='$color_unvetted'>$formatted_value</a></td>");
	
				print_ephys_value_and_hover('tm', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[tm]&id_neuron=$id_type&ep=tau' class='$color_unvetted'>$formatted_value</a></td>");		

				print_ephys_value_and_hover('Vthresh', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[Vthresh]&id_neuron=$id_type&ep=V-thresh' class='$color_unvetted '>$formatted_value</a></td>");

				print_ephys_value_and_hover('fast_AHP', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[fast_AHP]&id_neuron=$id_type&ep=Fast AHP' class='$color_unvetted'>$formatted_value</a></td>");

				print_ephys_value_and_hover('AP_ampl', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[AP_ampl]&id_neuron=$id_type&ep=AP ampl' class='$color_unvetted'>$formatted_value</a></td>");

				print_ephys_value_and_hover('AP_width', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[AP_width]&id_neuron=$id_type&ep=AP width' class='$color_unvetted'>$formatted_value</a></td>");

				print_ephys_value_and_hover('max_fr', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[max_fr]&id_neuron=$id_type&ep=Max F.R.' class='$color_unvetted'>$formatted_value</a></td>");

				print_ephys_value_and_hover('slow_AHP', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
				//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[slow_AHP]&id_neuron=$id_type&ep=Slow AHP' class='$color_unvetted'>$formatted_value</a></td>");
		
				print_ephys_value_and_hover('sag_ratio', $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2);
					//print ("<a href='property_page_ephys.php?id_ephys=$id_ephys2[sag_ratio]&id_neuron=$id_type&ep=Sag-ratio' class='$color_unvetted'>$formatted_value</a></td>");
								
			print ("</tr>");
		}
		print ("</table>");
		?>		
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
