<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("access_db.php");

include ("function/property.php");
include ("function/part.php");
include ("function/relation.php");
include ("function/value.php");
include ("function/ephys_unit_table.php");

require_once('class/class.type.php');
require_once('class/class.epdata.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.temporary_search.php');

$type = new type($class_type);
$number_type = $type->getNumber_type();
$epdata = new epdata($class_epdata);
$property_ob = new property($class_property);
$evidencepropertyyperel =  new evidencepropertyyperel($class_evidence_property_type_rel);
$epdataevidencerel =  new epdataevidencerel($class_epdataevidencerel);
$temporary_search = new temporary_search();

$full_search_string="";


// Comes from INDEX:PHP and in this case the program creates the temporary table:
if ($_REQUEST['searching'])
{
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$ip_address = str_replace('.', '_', $ip_address);
	$time_t = time();
	
	$name_temporary_table ='search1_'.$ip_address."__".$time_t;
	echo " Temporary Table Name : ".$name_temporary_table;
	$_SESSION['name_temporary_table'] = $name_temporary_table;

	// Creates the temporary table:
	$temporary_search -> setName_table($name_temporary_table);
	$temporary_search -> create_temp_table();
	
	$temporary_search -> insert_temporary('1', NULL, NULL, NULL, NULL, NULL);	
}


$N = $_REQUEST['N'];
{
	// ************ INSERT THE DATA IN THE TEMPORARY TABLE ********************************************************************************			
	// Insert the property in the temporary table: --------------------------------------------------------------
	$property = $_REQUEST['property'];
	if ($property)
	{		
		$name_temporary_table = $_SESSION['name_temporary_table'];
		
		$temporary_search -> setName_table($name_temporary_table);
		$temporary_search -> update(1, $property, NULL, NULL, NULL, $N);	
	}
	
	// Insert the part in the temporary table: --------------------------------------------------------------
	$part = $_REQUEST['part'];
	if ($part)
	{	
		$name_temporary_table = $_SESSION['name_temporary_table'];
	
		$temporary_search -> setName_table($name_temporary_table);
		$temporary_search -> update(2, NULL, $part, NULL, NULL, $N);
	}
	
	// Insert the part in the temporary table: --------------------------------------------------------------
	$relation = $_REQUEST['relation'];
	if ($relation)
	{	
		$name_temporary_table = $_SESSION['name_temporary_table'];

		$temporary_search -> setName_table($name_temporary_table);
		$temporary_search -> update(3, NULL, NULL, $relation, NULL, $N);
	}
	
	// Insert the value in the temporary table: --------------------------------------------------------------
	$value = $_REQUEST['value'];
	if ($value)
	{	
		$name_temporary_table = $_SESSION['name_temporary_table'];

		$temporary_search -> setName_table($name_temporary_table);
		$temporary_search -> update(4, NULL, NULL, NULL, $value, $N);
	}
		
	// OPERATOR *** creates a new searc line and nue row in the temporary table:
	$operator = $_REQUEST['operator'];
	if ($operator)
	{
		$N = $_REQUEST['N'];
		$N_old = $N - 1;
	
		$name_temporary_table = $_SESSION['name_temporary_table'];
		$temporary_search -> setName_table($name_temporary_table);
		
		// Check if all field are filled, otherway the program does not insert a new line:		
		$temporary_search -> retrieve_by_id($N_old);
		
		$property3 = $temporary_search -> getProperty();
		$part3 = $temporary_search -> getPart();
		$relation3 = $temporary_search -> getRelation();
		$value3 = $temporary_search -> getValue();	
					
		if (($property3 == 'Molecular markers') || ($property3 == 'Major Neurontransmitter'))
		{
			if ( ($property3 != NULL) && ($part3 != NULL) && ($relation3 != NULL )
			&& ($property3 != '-') && ($part3 != '-') && ($relation3 != '-' ) )
			{
					$temporary_search -> insert_temporary($N, NULL, NULL, NULL, NULL, $operator);
			}	
		
		}	
		else 
		{
			if ( ($property3 != NULL) && ($part3 != NULL) && ($relation3 != NULL ) && ($value3 != NULL) 
			&& ($property3 != '-') && ($part3 != '-') && ($relation3 != '-' ) && ($value3 != '-'))
			{
					$temporary_search -> insert_temporary($N, NULL, NULL, NULL, NULL, $operator);
			}
		}
	}

	// Remove a search line:
	$line = $_REQUEST['remove_line'];
	if ($line)
	{
		$name_temporary_table = $_SESSION['name_temporary_table'];
		$temporary_search -> setName_table($name_temporary_table);

		$temporary_search -> remove_line($line);
	}
	
	// ***************************************************************************************************************************
}


// Clear all ---------------------------------------------
if ($_REQUEST['clear_all'])
{
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$query = "TRUNCATE $name_temporary_table";
	$rs = mysql_query($query);

	// Creates the temporary table:
	$temporary_search -> setName_table($name_temporary_table);	
	$temporary_search -> insert_temporary('1', NULL, NULL, NULL, NULL, NULL);
}
// -------------------------------------------------------



$n_property = 5;

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
// Javascript function *****************************************************************************************************
function property(link, i0)
{
	var property_name=link[link.selectedIndex].value;
	var N = i0;

	var destination_page = "search.php";
	location.href = destination_page+"?property="+property_name+"&N="+N;
}

function part(link, i0)
{
	var part_name=link[link.selectedIndex].value;
	var N = i0;

	var destination_page = "search.php";
	location.href = destination_page+"?part="+part_name+"&N="+N;
}

function relation(link, i0)
{
	var relation_name=link[link.selectedIndex].value;
	var N = i0;

	var destination_page = "search.php";
	location.href = destination_page+"?relation="+relation_name+"&N="+N;
}

function value1(link, i0)
{
	var name=link[link.selectedIndex].value;
	var N = i0;

	var destination_page = "search.php";
	location.href = destination_page+"?value="+name+"&N="+N;
}

function operator(link, i0)
{
	var name=link[link.selectedIndex].value;
	var N = i0;

	var N_new = N + 1;
	
	var destination_page = "search.php";
	location.href = destination_page+"?operator="+name+"&N="+N_new;
}

</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Find Neuron</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>	

<div class='title_area'>
	<font class="font1">Search by neuron type</font>
</div>
		
<!-- submenu no tabs 
<div class='sub_menu'>
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="left">
			<font class='font1'><em>Find:</em></font> &nbsp; &nbsp; 
		
			<font class="font7_B">Neuron</font> <font class="font7_A">|</font> 
			<a href="find_author.php?searching=1"><font class="font7"> Author</font> </a> <font class="font7_A">|</font> 
			<a href="find_pmid.php?searching=1"><font class="font7"> PMID/ISBN</font> </a><font class="font7_A">|</font> 
			</font>	
		</td>
	</tr>
	</table>
</div>
-->
<!-- ------------------------ -->

<div class="table_position_search_page">
<table width="95%" border="0" cellspacing="5" cellpadding="0" class='body_table'>
  <tr>
    <td >
		<!-- ****************  BODY **************** -->	
		<br /><br />
		<table border="0" cellspacing="3" cellpadding="0" class='table_search'>
		<tr>
			<td align="center" width="4%" class='table_neuron_page3'>  </td>
			<td align="center" width="22%" class='table_neuron_page3'> Property </td>
			<td align="center" width="18%" class='table_neuron_page3'> Part </td>
			<td align="center" width="22%" class='table_neuron_page3'> Relation </td>
			<td align="center" width="31%" class='table_neuron_page3'> Value </td>
			<td align="center" width="8%" class='table_neuron_page3'>  Operator </td>
		</tr>
		</table>
		
		<!-- TABLE SEARCH -->
		<table border="0" cellspacing="3" cellpadding="0" class='table_search'>
		<?php
		
		$temporary_search -> retrieve_n_search();
		$n_search = $temporary_search -> getN_search();
		
		// Retrieve Number of ID:
		$temporary_search -> retrieve_id_array();
		$n_id = $temporary_search -> getN_id();
		
		
		for ($i0=0; $i0<$n_id; $i0++)
			$id_2[$i0] = $temporary_search -> getID_array($i0);


		for ($i0=0; $i0<$n_id; $i0++)
		{	
			print ("<tr>");
			
			$temporary_search -> retrieve_by_id($id_2[$i0]);
			
			$id1 = $temporary_search -> getID();
			$N1 = $temporary_search -> getN();
			$property1 = $temporary_search -> getProperty();
			$part1 = $temporary_search -> getPart();
			$relation1 = $temporary_search -> getRelation();
			$value1 = $temporary_search -> getValue();
			
			if ( ($n_id != 1) || ($i0 != 0) ) {
				print ("<td align='center' width='4%' class='table_neuron_page1'>
						<a href='search.php?remove_line=$id1'><img src='images/delete.png' width='15px' border='0'></a>
						</td>");
			}
			else
				print ("<td align='center' width='4%'> </td>");
				
			// Property **************************************************************************************************
			print ("<td width='17%' align='center' class='table_neuron_page1'>");
			print ("<select name='property' size='1' cols='10' class='select1' onChange=\"property(this, $id1)\">");
			
			if ($property1)
				print ("<OPTION VALUE='$property1'>$property1</OPTION>");
								
			print ("<OPTION VALUE='-'>-</OPTION>");
			for ($i=0; $i<$n_property; $i++)
			{
				$value_property = property($i); 
				
				if ($value_property != $property1)
					print ("<OPTION VALUE='$value_property'>$value_property</OPTION>");
			}
			print ("</select>");
			print ("</td>");
			// END Property **************************************************************************************************

			// Part **************************************************************************************************	
			$value_part = array();
		
			if ($property1 == 'Morphology')
				$n_part = 3;
			if ($property1 == 'Molecular markers')
				$n_part = 33;
			if ($property1 == 'Electrophysiology')
				$n_part = 10;		
			if ($property1 == 'Connectivity')
				$n_part = 2;
			if ($property1 == 'Major Neurontransmitter')	
				$n_part = 2;								
			
			for ($i=0; $i<$n_part; $i++)
				$value_part[$i] = part($i, $property1); 
														
			print ("<td width='18%' align='center' class='table_neuron_page1'>");
			print ("<select name='part' size='1' cols='10' class='select1' onChange=\"part(this, $id1)\">");
			
			if ($part1)
				print ("<OPTION VALUE='$part1'>$part1</OPTION>");
								
			print ("<OPTION VALUE='-'>-</OPTION>");

			sort($value_part);
			
			for ($i=0; $i<$n_part; $i++)
			{
				if ($value_part[$i] != $part1)
					print ("<OPTION VALUE='$value_part[$i]'>$value_part[$i]</OPTION>");
			}
			print ("</select>");
			print ("</td>");				
			// END Part **************************************************************************************************

			// Relation **************************************************************************************************
			if ($property1 == 'Morphology')
				$n_relation = 2;
			if ($property1 == 'Molecular markers')
				$n_relation = 3;
			if ($property1 == 'Electrophysiology')
				$n_relation = 5;	
			if ($property1 == 'Connectivity')
				$n_relation = 3;
			if ($property1 == 'Major Neurontransmitter')
				$n_relation = 2;
			
			print ("<td width='22%' align='center' class='table_neuron_page1'>");									

			print ("<select name='relation' size='1' cols='10' class='select1' onChange=\"relation(this, $id1)\">");
			
			if ($relation1)
				print ("<OPTION VALUE='$relation1'>$relation1</OPTION>");
			
			print ("<OPTION VALUE='-'>-</OPTION>");
			
			for ($i=0; $i<$n_relation; $i++) {
				$value_relation = relation($i, $property1, $part1);
				
				if ($value_relation != $relation1)
					print ("<OPTION VALUE='$value_relation'>$value_relation</OPTION>");
			}
			
			print ("</select>");

				
			print ("</td>");																	
			// END Relation **************************************************************************************************

			// Value **************************************************************************************************				
			if ($property1 == 'Electrophysiology') {	
				// in case Electrophysiology is need to have the max, min and mean of value1 from table Epdata------------
				if ($part1 == 'tau m')
					$part2 = 'tm';
				else if ($part1 == 'R in')
					$part2 = 'Rin';		
				else if ($part1 == 'V rest')
					$part2 = 'Vrest';
				else if ($part1 == 'V thresh')
					$part2 = 'Vthresh';
				else if ($part1 == 'Fast AHP')
					$part2 = 'fast_AHP';
				else if ($part1 == 'AP ampl')
					$part2 = 'AP_ampl';						
				else if ($part1 == 'AP width')
					$part2 = 'AP_width';						
				else if ($part1 == 'Max F.R.')
					$part2 = 'max_fr';					
				else if ($part1 == 'Slow AHP')
					$part2 = 'slow_AHP';						
				else if ($part1 == 'Sag ratio')
					$part2 = 'sag_ratio';					
				else
					$part2 = $part1;
	
				$unit = $ephys_unit_table[$part2];
				$property_ob -> retrive_ID(3, $part2, NULL, NULL);
				$n_id_property = $property_ob -> getNumber_type();
						
				for ($z1=0; $z1<$n_id_property; $z1++) {
					$property_id = $property_ob -> getProperty_id($z1);

					$evidencepropertyyperel -> retrive_evidence_id1($property_id);
				
					$n_evidence_id = $evidencepropertyyperel -> getN_evidence_id();
				
					for ($z2=0; $z2<$n_evidence_id ; $z2++)
					{
						$evidence_id = $evidencepropertyyperel -> getEvidence_id_array($z2);
					
						$epdataevidencerel -> retrive_Epdata($evidence_id);
						$id_epdata = $epdataevidencerel -> getEpdata_id();
					
						$epdata -> retrive_value1_array($id_epdata);
					
						$value_1[$z2] = $epdata -> getValue1_array(0);						
					}
				}
							
			 	if ($part2 != NULL)
					sort ($value_1);

	            // STM Setting min/max values via SQL
	            //$query_base = " FROM Epdata WHERE subject = '$part2'";
	            //$max_query = "SELECT MAX (value1)" . $query_base;
	            //$min_query = "SELECT MIN (value1)" . $query_base;
	
	            $yy=$n_evidence_id-1;			
	            $min_value1 = $value_1[0];
	            $max_value1 = $value_1[$yy]; 
	
	            // Mean: 
	            $mean_value1 = ($min_value1 + $max_value1) / 2;
							
				$query = "UPDATE $name_temporary_table SET max = '$max_value1', min = '$min_value1', mean = '$mean_value1' WHERE id = '$id1' ";	
				$rs2 = mysql_query($query);	
				// ---------------------------------------------------------------------------------------------------------
						
			}	
							
			if ($property1 == 'Morphology')
				$n_value = 32;
			if ($property1 == 'Molecular markers')
				$n_value = 0;
			if ($property1 == 'Electrophysiology')
				$n_value = 11;
			if ($property1 == 'Major Neurontransmitter')
				$n_value = 0;
			if ($property1 == 'Connectivity') {
				$type -> retrive_id();
				$n_value = $type->getNumber_type();
			}
			
																
			print ("<td width='31%' align='center' class='table_neuron_page1'>");
			
			if ($n_value == 0) ;
			else
				print ("<select name='value' size='1' cols='10' class='select1' onChange=\"value1(this, $id1)\">");
			
			if ($value1)
				print ("<OPTION VALUE='$value1'>$value1</OPTION>");
								
	        print ("<OPTION VALUE='-'>-</OPTION>");
        	for ($i=0; $i<$n_value; $i++) {
	            if ($property1 == 'Electrophysiology') // STM hack for correct ephys units
					$value_value = value_ephys($i, $property1, $min_value1, $max_value1, $unit);
	            elseif ($property1 == 'Connectivity')
					$value_value = value_connectivity($i, $type);
	            else
					$value_value = value($i, $property1, $min_value1, $max_value1); 
				
				if ($value_value != $value1)
					print ("<OPTION VALUE='$value_value'>$value_value</OPTION>");
			}
				
			print ("</select>");
			print ("</td>");				
			// END Value **************************************************************************************************

			// Operator **************************************************************************************************	
				
			$tt1 = $i0 + 1;
			$i_new = $id_2[$tt1];
			
			$query = "SELECT operator FROM $name_temporary_table WHERE id = '$i_new'";
			$rs = mysql_query($query);
			
			while(list($operator) = mysql_fetch_row($rs))						
				$operator1 = $operator;
			
			print ("<td width='8%' align='center' class='table_neuron_page1'>");
			
			print ("<select name='value' size='1' cols='10' class='select1' onChange=\"operator(this, $id1)\">");	
			
			if ($operator1)
				print ("<OPTION VALUE='$operator1'>$operator1</OPTION>");
													
			print ("<OPTION VALUE='-'>-</OPTION>");
			print ("<OPTION VALUE='AND'>AND</OPTION>");
			print ("<OPTION VALUE='OR'>OR</OPTION>");
			print ("</select>");
			print ("</td>");
			
			$operator1 = NULL;		
			// END Operator **************************************************************************************************

			print ("</tr>");
		} // end FOR $i0
		?>
		</table>

	<br /><br />
	<div align="center">
	<table width="600px" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width='100%' align='center' bgcolor="#CCCCCC">
		<?php
			// Search is assembled in a non-editable box for the user's benefit:
			$query = "SELECT N, operator, property, part, relation, value FROM $name_temporary_table";
			$rs = mysql_query($query);
			$n9=0;
			while(list($N, $operator, $property, $part, $relation, $value) = mysql_fetch_row($rs))
			{	
				if (($part == '-') || ($part == NULL));
				else
				{
					if ($n9 == 0){
						if ($value == NULL) { // for markers, no value, so no space after relation 
							print ("$part: ($relation) ");
							$full_search_string = $part . ": (" . $relation . ")";
						}
						else {
							print ("$part: ($relation $value) ");
							$full_search_string = $part . ": (" . $relation . " " . $value . ")";
						}
					}
					else{
						if ($value == NULL) { // for markers, no value, so no space after relation
							print ("<br>$operator $part: ($relation) ");
							$full_search_string = $full_search_string . " " . $operator . " " . $part . ": (" . $relation . ")";
						}
						else {
							print ("<br>$operator $part: ($relation $value) ");
							$full_search_string = $full_search_string . " " . $operator . " " . $part . ": (" . $relation . " " . $value . ")";
						}
					}					
				}
				$n9 = $n9 + 1;
			}				
		?>
		</td>
	</tr>
	</table>
	<?php
		$_SESSION['full_search_string'] = $full_search_string;
	?>
	</div>

		<br /><br />		
		<div align="center">
		<table width='400px'>
		<tr>
		<td width='40%'><form action="search.php" method="post" style='display:inline'>	
			<input type='submit' name='clear_all' value='CLEAR ALL' />
		</form></td>
		<td width='20%'></td>
		<td width='40%'><form action='search_engine.php' method="post">
			<input type="submit" name='go_search' value='  SEARCH  ' />
			<input type="hidden" name='name_table' value='<?php print $name_temporary_table ?>' />
		</form></td>
		</tr>
		</table>
		</div>	
		</td>
		<td width="20%">
		<br /><br />
		<!-- Table for minimun, maximun and mean value for Electrophysiological data -->
		<div align="left">
		<?php
		$query = "SELECT DISTINCT part, max, min, mean FROM $name_temporary_table WHERE property = 'Electrophysiology'";
		$rs = mysql_query($query);
		$m1 = 0;
		while(list($part, $max, $min, $mean) = mysql_fetch_row($rs))
		{
			$part_3[$m1] = $part;
			$max_3[$m1] = $max;
			$min_3[$m1] = $min;
			$mean_3[$m1] = $mean;
			$m1 = $m1 + 1;
		}	
		?>	
		
		<?php
		for ($i6=0; $i6<$m1; $i6++)
		{
			if  ($part_3[$i6] != NULL)
			{
		?> 
				<table border="0" cellpadding="0" cellspacing="0" class='table_search2'>
				<tr>
					<td width='100%' align='center' bgcolor='#6699CC'>
						<font class='font6'><strong>Electrophysiology <?php print $part_3[$i6]; ?>:</strong></font>
					</td>
				</tr>	
				<tr>
					<td width='100%' align='center' bgcolor='#6699CC'>
						<font class='font6'>Minimum = <?php print "$min_3[$i6] $unit"; ?></font>
					</td>
				</tr>
				<tr>
					<td width='100%' align='center' bgcolor='#6699CC'>
						<font class='font6'>Median = <?php print "$mean_3[$i6] $unit"; ?></font>
					</td>
				</tr>
				<tr>
					<td width='100%' align='center' bgcolor='#6699CC'>
						<font class='font6'>Maximum = <?php print "$max_3[$i6] $unit"; ?></font>
					</td>
				</tr>		
				</table>
				<br />
		<?php
			}
		}	
		?>	
		</div>	
	
	</td>
  </tr>
</table>
</div>
</body>
</html>
