<html>
<!--
This page is for generating the axon-dendrite lengths json file

$parcels_skip are parcels to skip when reporting non-all groups
-->
<?php
	include ("../../permission_check.php"); // must be logged in

	$parcel_group = array("DG:SMo:D", "DG:SMo:A", "DG:SMi:D", "DG:SMi:A", "DG:SG:D", "DG:SG:A", "DG:H:D", "DG:H:A", "DG:All:D", "DG:All:A", "CA3:SP:D", "CA3:SP:A", "CA3:SL:D", "CA3:SL:A", "CA3:SR:D", "CA3:SR:A", "CA3:SLM:D", "CA3:SLM:A", "CA3:SO:D", "CA3:SO:A", "CA3:All:D", "CA3:All:A", "CA2:All:D", "CA2:All:A", "CA2:SO:D", "CA2:SO:A", "CA2:SP:D", "CA2:SP:A", "CA2:SR:D", "CA2:SR:A", "CA2:SLM:D", "CA2:SLM:A", "CA1:SLM:D", "CA1:SLM:A", "CA1:SR:D", "CA1:SR:A", "CA1:SP:D", "CA1:SP:A", "CA1:SO:D", "CA1:SO:A", "CA1:All:D", "CA1:All:A", "Sub:SM:D", "Sub:SM:A", "Sub:SP:D", "Sub:SP:A", "Sub:PL:D", "Sub:PL:A", "Sub:All:D", "Sub:All:A", "EC:I:D", "EC:I:A", "EC:II:D", "EC:II:A", "EC:III:D", "EC:III:A", "EC:IV:D", "EC:IV:A", "EC:V:D", "EC:V:A", "EC:VI:D", "EC:VI:A", "EC:All:D", "EC:All:A");
	$parcels_skip = array(8,9,20,21,22,23,40,41,48,49,62,63);
	$write_output = array();
	$parcel_region = array();
	$parcel_layers = array();
	$parcel_output = array();
	$parcel_a_d = array();
	$vert_parcel_group = array("DG", "CA3", "CA2", "CA1", "Sub", "EC");
	$all_parcel_dend = array("DG:All:D", "CA3:All:D", "CA2:All:D", "CA1:All:D", "Sub:All:D", "EC:All:D");
	$all_parcel_axon = array("DG:All:A", "CA3:All:A", "CA2:All:A", "CA1:All:A", "Sub:All:A", "EC:All:A");
	$all_parcel_search = array();

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

	/* Maunally sorted neuron group
	Note: the auto sorted one no longer used due to
	needing the same ordering as on the morphology page */
	$neuron_group = array("Granule", "Hilar Ectopic Granule", "Semilunar Granule", "Mossy", "Mossy MOLDEN", "AIPRIM", "DG Axo-Axonic", "DG Basket", "DG BC CCK+", "HICAP", "HIPP", "HIPROM", "MOCAP", "MOLAX", "MOPP", "DG Neurogliaform", "Outer Molecular Layer", "Total Molecular Layer", "CA3 Pyramidal", "CA3c Pyramidal", "CA3 Giant", "CA3 Granule", "CA3 Axo-Axonic", "CA3 Horizontal AA", "CA3 Basket", "CA3 BC CCK+", "CA3 Bistratified", "CA3 IS Oriens", "CA3 IS Quad", "CA3 Ivy", "CA3 LMR-Targeting", "Lucidum LAX", "Lucidum ORAX", "Lucidum-Radiatum", "Spiny Lucidum", "Mossy Fiber-Associated", "MFA ORDEN", "CA3 O-LM", "CA3 QuadD-LM", "CA3 Radiatum", "CA3 R-LM", "CA3 SO-SO", "CA3 Trilaminar", "CA2 Pyramidal", "CA2 Basket", "CA2 Wide-Arbor BC", "CA2 Bistratified", "CA2 SP-SR", "CA1 Pyramidal", "Cajal-Retzius", "CA1 Radiatum Giant", "CA1 Axo-axonic", "CA1 Horizontal AA", "CA1 Back-Projection", "CA1 Basket", "CA1 BC CCK+", "CA1 Horizontal BC", "CA1 Bistratified", "CA1 IS LMO-O", "CA1 IS LM-R", "CA1 IS LMR-R", "CA1 IS O-R", "CA1 IS O-Target QuadD", "CA1 IS R-O", "CA1 IS RO-O", "CA1 Ivy", "CA1 LMR", "CA1 LMR Projecting", "CA1 Neurogliaform", "CA1 NGF Projecting", "CA1 O-LM", "CA1 Recurrent O-LM", "CA1 O-LMR", "CA1 Oriens/Alveus", "CA1 Oriens-Bistratified", "CA1 O-Bistrat Projecting", "CA1 OR-LM", "CA1 Perforant Path-Assoc", "CA1 PPA QuadD", "CA1 Quadrilaminar", "CA1 Radiatum", "CA1 R-Recv Apical-Target", "Schaffer Collateral-Assoc", "SCR R-Targeting", "CA1 SO-SO", "CA1 Hipp-SUB Proj ENK+", "CA1 Trilaminar", "CA1 Radial Trilaminar", "SUB EC-Proj Pyramidal", "SUB CA1-Proj Pyramidal", "SUB Axo-axonic", "LI-II Multipolar-Pyramidal", "LI-II Pyramidal-Fan", "MEC LII-III PC-Multiform", "MEC LII Oblique Pyramidal", "MEC LII Stellate", "LII-III Pyramidal-Tripolar", "LEC LIII Multipolar Principal", "MEC LIII Multipolar Principal", "LIII Pyramidal", "LEC LIII Complex Pyramidal", "MEC LIII Complex Pyramidal", "MEC LIII BP Cmplx PC", "LIII Pyramidal-Stellate", "LIII Stellate", "LIII-V Bipolar Pyramidal", "LIV-V Pyramidal-Horiz", "LIV-VI Deep Multipolar", "MEC LV Multipolar-PC", "LV Deep Pyramidal", "MEC LV Pyramidal", "MEC LV Superficial PC", "MEC LV-VI PC-Polymorph", "LEC LVI Multipolar-PC", "LII Axo-Axonic", "MEC LII Basket", "LII Basket Multipolar Interneuron", "LEC LIII Multipolar Interneuron", "MEC LIII Multipolar Interneuron", "MEC LIII Superficial MPI", "LIII Pyramidal-Looking Interneuron", "MEC LIII Superficial Trilayered Interneuron");

	echo "<br>Completed processing record: ";
	/*
	$i is row that is a neuron type
	The lines "array_push($write_output, $entry_output."\"\",\n");"
	is to account for the first 2 non-value columns
	
	$j is column that is a parcel type
	*/
	for ($i = 0; $i < count($neuron_group); $i++) {
	//for ($i = 0; $i < 5; $i++) {
		$all_totals='';
		echo $i." ";
		array_push($write_output, $entry_output."\"\",");
		array_push($write_output, $entry_output."\"\",");
		for ($j=0;$j<count($parcel_group);$j=$j+2) {
			if (!in_array($j, $parcels_skip)) {
				$entry_output = "\"";
				$i_adj = $i;
				$j_adj = $j;
				// manual rules for organizing column order as listed on the morphology page
				if ($j == 10) {$j_adj = 16;}
				else if ($j == 12) {$j_adj = 14;}
				else if ($j == 14) {$j_adj = 12;}
				else if ($j == 16) {$j_adj = 10;}
				for ($adi=0;$adi<2;$adi++) {
		            if ($adi == 0) {
	                    $j_adj2 = $j_adj;
	                    $entry_output = $entry_output."&nbsp;";
	                }
	                if ($adi == 1) {
	                    $j_adj2 = $j_adj + 1;
	                    $entry_output = $entry_output."<hr class='hr_sub_cell'>&nbsp;";
	                }
	            
	                $sql    = "SELECT CAST(STD(total_length) AS DECIMAL(10,2)) AS std_tl, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='" . $neuron_group[$i_adj] . "' AND neurite_quantified.neurite='" . $parcel_group[$j_adj2] . "' AND total_length!='';";
	                $result = $conn->query($sql);
	                if ($result->num_rows > 0) {
	                    while ($row = $result->fetch_assoc()) {
	                        $avg_trunk = $row['avg_trunk'];
	                        if ($avg_trunk != '' && $avg_trunk != 0) {
	                            $entry_output = $entry_output."<a href='#' title='Mean: " . $row['avg'] . "\\nCount of Recorded Values: " . $row['count_tl'] . "\\nStandard Deviation: " . $row['std_tl'] . "'>" . $avg_trunk . "</a>";
	                        }
	                    }
	                }                        			
				}
				$entry_output = $entry_output."\",";
				array_push($write_output, $entry_output);				
			} 
		}
		// find all parcel values
		for ($adi = 0; $adi < 2; $adi++) {
	        if ($adi == 0) {
	            $a_or_d = 'Dendrite: ';
	            $prcl   = '';
	            $nl     = "\\n";
	            $all_parcel_search = new ArrayObject($all_parcel_dend);
	        } else {
	            $a_or_d = 'Axon: ';
	            $prcl   = '';
	            $nl     = "";
	            $all_parcel_search = new ArrayObject($all_parcel_axon);
	        }
	        for ($s_i = 0; $s_i < count($all_parcel_search); $s_i++) {
                $sql    = "SELECT CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='" . $neuron_group[$i_adj] . "' AND neurite_quantified.neurite='" . $all_parcel_search[$s_i] . "' AND total_length!='';";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row        = $result->fetch_assoc();
                    if ($row['count_tl'] > 0) {
                    $all_totals = $all_totals . $prcl . $a_or_d . '\\nAverage Total Length: ' . $row['avg'] . ' \\nValues Count: ' . $row['count_tl'] . '\\nStandard Deviation: ' . $row['std'] . $nl;
                	}
                }
	    	}
	    	if ($all_totals=='') {
	    		$all_totals = $all_totals . 'Average Total Length: 0\\nValues Count: 0\\nStandard Deviation: 0';
	    	}
	    }
		array_push($parcel_output, $all_totals);
	}
	/*
	Read from input files
	*/
	$path_to_files = "/var/www/html/synapse_probabilities/php/synap_prob/gen_json/";
	$json_template_file = $path_to_files."n_by_k_template.json";
	$json_template = file($json_template_file);

	$json_template_file = $path_to_files."neuron_classes.json";
	$neuron_classes = file($json_template_file);

	/* 
	Write to File 
	Note: file must be already created as a blank file and
	write access must be set for the user running this page.

	$new_row is used because a new row occurs every certain
	number of columns when reading the file.
	*/
	$json_template_file = $path_to_files."adl_db_results.json";
	$output_file = fopen($json_template_file, 'w') or die("Can't open file.");
	/* specify rows to use from template file */
	$init_row = 0;
	$init_row2 = 1;
	$new_row = 28;
	$max_rows = 100000;
	$template_rows = array();
	$parcel_rows = array();
	$parc_out = 0;
	for ($r_i = 0; $r_i < $max_rows; $r_i++) {
		array_push($template_rows, ($init_row+($new_row*$r_i)));
		array_push($parcel_rows, ($init_row2+($new_row*$r_i)));
	}	

	for ($o_i = 0; $o_i<count($json_template); $o_i++) {
		if ($o_i==(count($json_template)-1)) {
			fwrite($output_file, "\"\"]]}"); // last line
		}
		else if (in_array($o_i, $template_rows)) {
			fwrite($output_file, $json_template[$o_i]);
		}
		else if (in_array($o_i, $parcel_rows)) {
			$line_start = substr($neuron_classes[$parc_out], 0, 34);
			$title = $parcel_output[$parc_out];
			$line_end = substr($neuron_classes[$parc_out], 34);
			if ($line_start != '') {
				$full_line = $line_start." title='".$title."'".$line_end;
			}
			else {
				$full_line = "\"\",";
			}
			fwrite($output_file, $full_line);
			$parc_out++;
		}
		else {
			if ($write_output[$o_i] != "") {
				$text_output = $write_output[$o_i]."\n";
			}
			else {
				$text_output = "\"\",\n";
			}
			fwrite($output_file, $text_output);
		}
	}
	fclose($output_file);

	echo "<br><br><center>Json file successfully written.";

	echo "<br><br><button onClick='window.location.reload();''>Reload Page</button></center>";
?>