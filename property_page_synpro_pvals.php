<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require_once('class/class.type.php');
require_once('class/class.property.php');

function checkNeuronProperty($color)
{
	$part="";
	if ($color == 'red')
		$part = "axons";
	if ($color == 'redSoma')
		$part = "axons_somata";
	if ($color == 'blue')
		$part = "dendrites";
	if ($color == 'blueSoma')
		$part = "dendrites_somata";
	if ($color == 'violet')
		$part = "axons_dendrites";
	if ($color == 'violetSoma')
		$part = "axons_dendrites_somata";
	if ($color == 'somata')
		$part = "somata";	
	return $part;
}

// set properties
$page = $_REQUEST['page'];
$nm_page = $_REQUEST['nm_page'];
$flag = $_REQUEST['flag'];
$id_neuron = $_SESSION['id_neuron'];
$val_property = $_SESSION['val_property'];
//$color = $_SESSION['color'];
$color = $_REQUEST['color'];
$type_source = new type($class_type);
$source_id = $_REQUEST['id_neuron_source'];
$type_source -> retrive_by_id($source_id);
$type_target = new type($class_type);
$target_id = $_REQUEST['id_neuron_target'];
$type_target -> retrive_by_id($target_id);
$property = new property($class_property);
$pre_id=$type_source->getId();
$pre_name=$type_source->getName();
$post_id=$type_target->getId();
$post_name=$type_target->getName();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Google Analytics Tracking -->  
<?php include_once("analytics.php") ?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); 
	$name=$type_source->getNickname();
	$name2=$type_target->getNickname();
	print("<title>Evidence - $name and $name2</title>");
?>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>

<div class='title_area' style="width:1200px;">
	<font class="font1">Synapse Probabilities - Parcel-Specific Potential Synapses Per Neuron Pair</font>
</div>

<br><br /><br><br />
<table width="85%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="40">
    <td></td>
  </tr>
  <tr>
    <td align="center">
		<!-- ****************  BODY **************** -->
		
		<!-- TABLE NAME AND PROPERTY-->
		<table width="80%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td width="20%" align="right" class="table_neuron_page1">
					Connection Details:
				</td>
				<td align="left" width="80%" class="table_neuron_page2">
					&nbsp; 
					<?php 
					print("From: <a href='neuron_page.php?id=$pre_id'>$pre_name</a> To: <a href='neuron_page.php?id=$post_id'>$post_name</a>"); 
					?>
				</td>				
			</tr>
			<tr>
				<td width="20%" align="right"></td>
				<td align="left" width="80%" class="table_neuron_page2">&nbsp; <strong>Hippocampome Presynaptic Neuron ID: </strong> <strong><?php echo $source_id?></strong></td>
			</tr>
			<tr>
				<td width="20%" align="right">
				</td>
				<td align="left" width="80%" class="table_neuron_page2">
				<?php
					$name1 = checkNeuronProperty($color);						
					print ("&nbsp; <strong>Hippocampome Postsynaptic Neuron ID: </strong> <strong>$target_id</strong>");
				?>
				</td>
			</tr>
			<tr>
				<td width="20%" align="right">
				</td>
				<td align="left" width="80%" class="table_neuron_page2">
					<?php
					$E_or_I_found=false;
					echo "&nbsp;&nbsp;Type: <b>";
					$query = "SELECT distinct target_E_or_I FROM number_of_contacts WHERE source_ID=$source_id and target_ID=$target_id;";
					$rs = mysqli_query($GLOBALS['conn'],$query);
					while(list($target_E_or_I) = mysqli_fetch_row($rs))
					{	
						if ($target_E_or_I=='E') {
							echo "Potential Excitatory Connections";
							$E_or_I_found=true;
						}
						else if ($target_E_or_I=='I') {
							echo "Potential Inhibitory Connections";
							$E_or_I_found=true;
						}
					}
					if (!$E_or_I_found) {
						echo "N/A";
					}
					echo "</b>";
					?>
				</td>
			</tr>								
		</table>
		
    <table width="80%" border="0" cellspacing="2" cellpadding="5" padding-top="5"> 
<tr>
</tr>
    </table>
		<br style='font-size: 8px;'>
		</center>
	<?php 
	include ('synap_prob/n_m_params.php');
	$cell_width='70px';
	$cell_height='30px';
	$cell_border='2px solid #282d7b';
	$parcel_group_match=null;
	for($as_i=0;$as_i<count($find_parcel_group_id);$as_i++) {
		if ($target_id==$find_parcel_group_id[$as_i]) {
			$parcel_group_match=$as_i;
		}
	}
	if ($find_parcel_group_name[$parcel_group_match]=='DG') {
			$parcel_group = $dg_group; $parcel_group_short = $dg_group_short;}
	else if ($find_parcel_group_name[$parcel_group_match]=='CA3') {
			$parcel_group = $ca3_group; $parcel_group_short = $ca3_group_short;}
	else if ($find_parcel_group_name[$parcel_group_match]=='CA2') {
			$parcel_group = $ca2_group; $parcel_group_short = $ca2_group_short;}		
	else if ($find_parcel_group_name[$parcel_group_match]=='CA1') {
			$parcel_group = $ca1_group; $parcel_group_short = $ca1_group_short;}
	else if ($find_parcel_group_name[$parcel_group_match]=='SUB') {
			$parcel_group = $sub_group; $parcel_group_short = $sub_group_short;}
	else if ($find_parcel_group_name[$parcel_group_match]=='EC') {
			$parcel_group = $ec_group; $parcel_group_short = $ec_group_short;}

	function query_value($source_id, $target_id, $parcel, $prop, $table) {
		$query = "
		SELECT source_ID, source_Name, target_ID, target_Name, neurite, CAST(AVG($prop) AS DECIMAL(10,5))
		FROM $table
		WHERE source_ID=$source_id AND target_ID=$target_id AND neurite='$parcel'
		AND $prop!=''
		GROUP BY source_ID, source_Name, target_ID, target_Name, neurite
		LIMIT 500000;
		";
		$rs = mysqli_query($GLOBALS['conn'],$query);
		while(list($sid, $son, $tid, $tan, $neu, $val) = mysqli_fetch_row($rs))
		{	
			echo $val;
		}
		//echo "<br>".$query;		
	}
	function report_parcel_values($title, $source_id, $target_id, $prop, $table, $cell_width, $cell_height, $cell_border, $parcel_group, $parcel_group_short,$color,$nm_page) {
	echo "
	<span style='float:middle;font-size:12px;background-color:white;' class='table_neuron_page2'><strong>$title</strong></span>
	<font style='font-size:4px'><br>
	<br></font>";
	echo "<table cellspacing='2' cellpadding='5' padding-top='5' class='table_neuron_page2' style='font-size:12px;bottom:5px;position:relative;background-color:white;'>
	<tr style='text-align:center'>";
	for ($pg_i=0;$pg_i<count($parcel_group_short);$pg_i++) {
		echo "<td style='width:$cell_width;height:$cell_height;'><strong>";
		echo $parcel_group_short[$pg_i]." ";
		echo "</strong></td>";
	}
	echo "</tr><tr style='text-align:center'>";
	for ($pg_i=0;$pg_i<count($parcel_group);$pg_i++) {
		echo "<td style='width:$cell_width;border:$cell_border;height:$cell_height;'><a href='property_page_synpro_nm.php?id_neuron_source=".$source_id."&id_neuron_target=".$target_id."&color=".$color."&page=1&nm_page=".$nm_page."' target='_blank' style='text-decoration:none'>";
		query_value($source_id, $target_id, $parcel_group[$pg_i], $prop, $table);
		echo "</a></td>";
	}
	echo "
	</tr>
	</table>";
	}
	if ($nm_page=='ps') {
		report_parcel_values('Potential number of synapses', $source_id, $target_id, 'potential_synapses', 'potential_synapses', $cell_width, $cell_height, $cell_border, $parcel_group, $parcel_group_short,$color,$nm_page);
	}
	else if ($nm_page=='noc') {
		report_parcel_values('Number of contacts', $source_id, $target_id, 'number_of_contacts', 'number_of_contacts', $cell_width, $cell_height, $cell_border, $parcel_group, $parcel_group_short,$color,$nm_page);
	}
	else if ($nm_page=='prosyn') {
		report_parcel_values('Probability of connection', $source_id, $target_id, 'probability', 'number_of_contacts', $cell_width, $cell_height, $cell_border, $parcel_group, $parcel_group_short,$color,$nm_page);
	}
	?>					
</body>
</html>	
