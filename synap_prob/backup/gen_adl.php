<html>
<!--
This page is for generating the axon-dendrite lengths json file
-->
<?php
	include ("../permission_check.php"); // must be logged in

	$parcel_group = array($groups_text, "DG:SMo:D", "DG:SMo:A", "DG:SMi:D", "DG:SMi:A", "DG:SG:D", "DG:SG:A", "DG:H:D", "DG:H:A", "DG:All:D", "DG:All:A", "CA3:SP:D", "CA3:SP:A", "CA3:SL:D", "CA3:SL:A", "CA3:SR:D", "CA3:SR:A", "CA3:SLM:D", "CA3:SLM:A", "CA3:SO:D", "CA3:SO:A", "CA3:All:D", "CA3:All:A", "CA2:All:D", "CA2:All:A", "CA2:SO:D", "CA2:SO:A", "CA2:SP:D", "CA2:SP:A", "CA2:SR:D", "CA2:SR:A", "CA2:SLM:D", "CA2:SLM:A", "CA1:SLM:D", "CA1:SLM:A", "CA1:SR:D", "CA1:SR:A", "CA1:SP:D", "CA1:SP:A", "CA1:SO:D", "CA1:SO:A", "CA1:All:D", "CA1:All:A", "Sub:SM:D", "Sub:SM:A", "Sub:SP:D", "Sub:SP:A", "Sub:PL:D", "Sub:PL:A", "Sub:All:D", "Sub:All:A", "EC:I:D", "EC:I:A", "EC:II:D", "EC:II:A", "EC:III:D", "EC:III:A", "EC:IV:D", "EC:IV:A", "EC:V:D", "EC:V:A", "EC:VI:D", "EC:VI:A", "EC:All:D", "EC:All:A");
	$parcel_region = array();
	$parcel_layers = array();
	$parcel_a_d = array();
	$vert_parcel_group = array("DG", "CA3", "CA2", "CA1", "Sub", "EC");

	// Collect neuron types and sort them
	$neuron_group = array();
	$neuron_type_unsorted = array();
	$neuron_parcel_unsorted = array();
	$neuron_parcel_counts = array();
	$sql = "SELECT DISTINCT hippocampome_neuronal_class, subregion FROM neurite_quantified;";
	$result = $conn->query($sql);
	$nt_tot = 0;
	$nt_tot_old = 0;
	if ($result->num_rows > 0) { 
		while($row = $result->fetch_assoc()) {
		  $neuron_type = $row['hippocampome_neuronal_class'];
		  if ($neuron_type != '') {
		    array_push($neuron_type_unsorted, $neuron_type);
		    array_push($neuron_parcel_unsorted, $row['subregion']);
		  }
		  //echo $neuron_type."<br>";
		}
	}
	$number_of_parcels = sizeof($vert_parcel_group);
	$neuron_group = array_fill(0, sizeof($neuron_type_unsorted), 0);
	for ($v_i = 0; $v_i < $number_of_parcels; $v_i++) {  
		for ($ng_i = 0; $ng_i < sizeof($neuron_type_unsorted); $ng_i++) {
		  if ($neuron_parcel_unsorted[$ng_i] == $vert_parcel_group[$v_i]) {
		    $neuron_group[$nt_tot] = $neuron_type_unsorted[$ng_i];
		    $nt_tot++;
		  }
		}
		if (sizeof($neuron_parcel_counts)==0) {
		  array_push($neuron_parcel_counts, $nt_tot);
		  $nt_tot_old = $nt_tot;
		}
		else {
		  array_push($neuron_parcel_counts, ($nt_tot-$nt_tot_old));
		  $nt_tot_old = $nt_tot;
		}
	}

	for ($i = 0; $i < count($parcel_group); $i++) {
		$parcel_delim = explode(':', $parcel_group[$i]);
		array_push($parcel_region, $parcel_delim[0]);
		array_push($parcel_layers, $parcel_delim[1]);
		array_push($parcel_a_d, $parcel_delim[2]);
	}	

	for ($i = 0; $i < count($neuron_group) + 2; $i++) {
		$all_totals='';
		for ($j=0;$j<count($parcel_group)+1;$j++) {
			$sql = "SELECT CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i]."' AND neurite_quantified.neurite='".$parcel_group[$j]."' AND mean_path_length!='';";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) { 
			$row = $result->fetch_assoc();
			$new_entry = $prcl.$a_or_d.'\"Average Somatic Distance: '.$row['avg'].'\\nValues Count: '.$row['count_sd'].'\\nStandard Deviation: '.$row['std'].$nl;
			$all_totals = $all_totals.$new_entry;
			echo $new_entry."<br>";
			}
		}
	}
?>