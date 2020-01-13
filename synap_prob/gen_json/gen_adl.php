<html>
<!--
This page is for generating the axon-dendrite lengths json file
-->
<?php
	include ("../../permission_check.php"); // must be logged in

	$parcel_group = array($groups_text, "DG:SMo:D", "DG:SMo:A", "DG:SMi:D", "DG:SMi:A", "DG:SG:D", "DG:SG:A", "DG:H:D", "DG:H:A", "DG:All:D", "DG:All:A", "CA3:SP:D", "CA3:SP:A", "CA3:SL:D", "CA3:SL:A", "CA3:SR:D", "CA3:SR:A", "CA3:SLM:D", "CA3:SLM:A", "CA3:SO:D", "CA3:SO:A", "CA3:All:D", "CA3:All:A", "CA2:All:D", "CA2:All:A", "CA2:SO:D", "CA2:SO:A", "CA2:SP:D", "CA2:SP:A", "CA2:SR:D", "CA2:SR:A", "CA2:SLM:D", "CA2:SLM:A", "CA1:SLM:D", "CA1:SLM:A", "CA1:SR:D", "CA1:SR:A", "CA1:SP:D", "CA1:SP:A", "CA1:SO:D", "CA1:SO:A", "CA1:All:D", "CA1:All:A", "Sub:SM:D", "Sub:SM:A", "Sub:SP:D", "Sub:SP:A", "Sub:PL:D", "Sub:PL:A", "Sub:All:D", "Sub:All:A", "EC:I:D", "EC:I:A", "EC:II:D", "EC:II:A", "EC:III:D", "EC:III:A", "EC:IV:D", "EC:IV:A", "EC:V:D", "EC:V:A", "EC:VI:D", "EC:VI:A", "EC:All:D", "EC:All:A");
	$write_output = array();
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

	echo "<br>Completed record: ";
	//for ($i = 0; $i < count($neuron_group) + 2; $i++) {
	for ($i = 0; $i < 2; $i++) {
		$all_totals='';
		echo $i." ";
		for ($j=0;$j<count($parcel_group)+1;$j=$j+2) {
			$entry_output = "\"";
			for ($adi=0;$adi<2;$adi++) {
	            if ($adi==0) {
	              $j_adj2=$j;
	              //echo "&nbsp;";
	              //array_push($write_output, "&nbsp;");
	              $entry_output = $entry_output."&nbsp;";
	            }
	            if ($adi==1) {
	              $j_adj2=$j+1;
	              //echo "<hr class='hr_sub_cell'>";
	              //echo "&nbsp;";
	              $entry_output = $entry_output."<hr class='hr_sub_cell'>&nbsp;";
	            }
	            // detect appropriate matrix data to populate            
				$sql = "SELECT CAST(STD(mean_path_length) AS DECIMAL(10,2)) AS std_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(MIN(mean_path_length) AS DECIMAL(10,2)) AS min_sd, CAST(MAX(mean_path_length) AS DECIMAL(10,2)) AS max_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj2]."' AND mean_path_length!='';";
				//array_push($write_output, $sql);
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
					  $avg_trunk = $row['avg_trunk'];
					  if ($avg_trunk != '' && $avg_trunk != 0) {
					    $value_result = "<center><a href='#' title='Mean: ".$row['avg']."\\nCount of Recorded Values: ".$row['count_sd']."\\nStandard Deviation: ".$row['std_sd']."\\nMinimum Value: ".$row['min_sd']."\\nMaximum Value: ".$row['max_sd']."'>".$avg_trunk."</a></center>";
					    //echo $value_result;
					    $entry_output = $entry_output.$value_result;
					  }
					}
				}			
			}
			//echo "&nbsp;";
			array_push($write_output, $entry_output."\",");
		}
	}

	/*
	Read from Json Template
	*/
	$myFile = "/var/www/html/synapse_probabilities/php/synap_prob/gen_json/n_by_k_template.json";
	$json_template = file($myFile);

	/* 
	Write to File 
	Note: file must be already created as a blank file and
	write access must be set for the user running this page.

	$new_row is used because a new row occurs every certain
	number of columns when reading the file.
	*/
	$myFile = "/var/www/html/synapse_probabilities/php/synap_prob/gen_json/adl_db_results.json";
	$myFileLink = fopen($myFile, 'w') or die("Can't open file.");
	/* specify rows to use from template file */
	$init_row = 0;
	$init_row2 = 1;
	$new_row = 28;
	$max_rows = 100000;
	$template_rows = array();
	for ($r_i = 0; $r_i < $max_rows; $r_i++) {
		array_push($template_rows, ($init_row+($new_row*$r_i)));
		array_push($template_rows, ($init_row2+($new_row*$r_i)));
	}	
	//echo $template_rows[0]." ".$template_rows[1]." ".$template_rows[2]." ".$template_rows[3];

	for ($o_i = 0; $o_i<count($json_template); $o_i++) {
		if ($o_i==(count($json_template)-1)) {
			fwrite($myFileLink, "\"\"]]}"); // last line
		}
		else if (in_array($o_i, $template_rows)) {// || ($o_i-2)%$new_row || ($o_i-3)%$new_row) {
			fwrite($myFileLink, $json_template[$o_i]);
			//echo count($json_template)."mod<br>";
			//echo "<br>".$o_i." ".$json_template[$o_i];
		}
		else {
			if ($write_output[$o_i] != "") {
				$text_output = $write_output[$o_i]."\n";
			}
			else {
				$text_output = "\"\",\n";
			}
			fwrite($myFileLink, $text_output);
			//echo "no mod<br>";
			//echo "<br>".$o_i." ".$text_output;
		}
	}
	fclose($myFileLink);

	echo "<br><br><center>Json file successfully written.";

	echo "<br><br><button onClick='window.location.reload();''>Reload Page</button></center>";
?>