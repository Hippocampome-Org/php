<html>
<!--
This software is for generating json files

Note: $path_to_files must be an existing and read/write access
granted directory to read/write files with this software.
For example on linux, run
$ chmod -R 777 <directory>
where <directory> is the $path_to_files folder

Author: Nate Sutton 
Date:   2020
-->
<head>
	<title>Json Generation</title>
</head>
<body>
<?php
	include ("../../permission_check.php"); // must be logged in

	$path_to_files = "/var/www/html/synapse_probabilities/php/synap_prob/gen_json/";

	/*
	Read from input files

	Note: these are pre-existing files, not ones generates by this page.
	*/
	$json_template_file = $path_to_files."neuron_groups.json";
	$neuron_groups = file($json_template_file);

	$json_template_file = $path_to_files."neuron_groups_ordered.json";
	$neuron_groups_ordered = file($json_template_file);

	$json_template_file = $path_to_files."neuron_classes.json";
	$neuron_classes = file($json_template_file);

	$json_template_file = $path_to_files."neuron_classes_ordered.json";
	$neuron_classes_ordered = file($json_template_file);

	$json_template_file = $path_to_files."json_new_line.json";
	$json_new_line = file($json_template_file);
	$json_new_line = $json_new_line[0];

	$page = '';
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}

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

	$neuron_group_long = array("DG Granule (+)2201p", "DG Hilar Ectopic Granule (+)2203p", "DG Semilunar Granule (+)2311p", "DG Mossy (+)0103", "DG Mossy MOLDEN (+)2323", "DG AIPRIM (-)2333", "DG Axo-Axonic (-)2233", "DG Basket (-)2232", "DG Basket CCK+ (-)2232", "DG HICAP (-)2322", "DG HIPP (-)1002", "DG HIPROM (-)1333p", "DG MOCAP (-)0331", "DG MOLAX (-)3302", "DG MOPP (-)3000", "DG Neurogliaform (-)3000p", "DG Outer Molecular Layer (-)3222", "DG Total Molecular Layer (-)3303", "CA3 Pyramidal (+)23223p", "CA3c Pyramidal (+)03223p", "CA3 Giant (+)22010", "CA3 Granule (+)22100", "CA3 Axo-Axonic (-)22232", "CA3 Horizontal Axo-Axonic (-)00012", "CA3 Basket (-)22232", "CA3 Basket CCK+ (-)22232", "CA3 Bistratified (-)03333", "CA3 Interneuron Specific Oriens (-)01113", "CA3 Interneuron Specific Quad (-)03333p", "CA3 Ivy (-)03333", "CA3 LMR-Targeting (-)33200", "CA3 Lucidum LAX (-)02310", "CA3 Lucidum ORAX (-)03311", "CA3 Lucidum-Radiatum (-)03300", "CA3 Spiny Lucidum Dentate-Projecting (-)01320p", "CA3 Mossy Fiber-Associated (-)03330p", "CA3 Mossy Fiber-Associated ORDEN (-)02332p", "CA3 O-LM (-)11003", "CA3 QuadD-LM (-)12222", "CA3 Radiatum (-)03000", "CA3 R-LM (-)12000", "CA3 SO-SO (-)00003", "CA3 Trilaminar (-)01113p", "CA2 Pyramidal (+)2333p", "CA2 Basket (-)2232", "CA2 Wide-Arbor Basket (-)2232p", "CA2 Bistratified (-)0313p", "CA2 SP-SR (-)0322", "CA1 Pyramidal (+)2223p", "CA1 Radiatum Giant (+)2201", "CA1 Axo-Axonic (-)2232", "CA1 Horizontal Axo-Axonic (-)0012", "CA1 Back-Projection (-)1133p", "CA1 Basket (-)2232", "CA1 Basket CCK+ (-)2232", "CA1 Horizontal Basket (-)0012", "CA1 Bistratified (-)0333", "CA1 Interneuron Specific LMO-O (-)2003", "CA1 Interneuron Specific LM-R (-)2100", "CA1 Interneuron Specific LMR-R (-)2300", "CA1 Interneuron Specific O-R (-)0102", "CA1 Interneuron Specific O-Targeting QuadD (-)2223", "CA1 Interneuron Specific R-O (-)0221", "CA1 Interneuron Specific RO-O (-)0203", "CA1 Ivy (-)0333", "CA1 LMR (-)3300", "CA1 LMR Projecting (-)3300p", "CA1 Neurogliaform (-)3000", "CA1 Neurogliaform Projecting (-)3000p", "CA1 O-LM (-)1002", "CA1 Recurrent O-LM (-)1003", "CA1 O-LMR (-)1102", "CA1 Oriens/Alveus (-)2233", "CA1 Oriens-Bistratified (-)0103", "CA1 Oriens-Bistratified Projecting (-)1113p", "CA1 OR-LM (-)1202", "CA1 Perforant Path-Associated (-)3200p", "CA1 Perforant Path-Associated QuadD (-)3222", "CA1 Quadrilaminar (-)3333", "CA1 Radiatum (-)0300", "CA1 R-Receiving Apical-Targeting (-)1300", "CA1 Schaffer Collateral-Assoc (-)2311", "CA1 Schaffer Collateral-Receiving R-Targeting (-)0322", "CA1 SO-SO (-)0003", "CA1 Hippocampo-Subicular Projecting ENK+ (-)0313p", "CA1 Trilaminar (-)0113p", "CA1 Radial Trilaminar (-)2333", "SUB EC-Projecting Pyramidal (+)331p", "SUB CA1-Projecting Pyramidal (+)331p", "SUB Axo-axonic (-)210", "EC LI-II Multipolar-Pyramidal (+)231000", "EC LI-II Pyramidal-Fan (+)331000p", "MEC LII-III Pyramidal-Multiform (+)233111", "MEC LII Oblique Pyramidal (+)221100", "MEC LII Stellate (+)331111p", "EC LII-III Pyramidal-Tripolar (+)333000p", "LEC LIII Multipolar Principal (+)113330", "MEC LIII Multipolar Principal (+)003310", "EC LIII Pyramidal (+)223111p", "LEC LIII Complex Pyramidal (+)233310", "MEC LIII Complex Pyramidal (+)313300", "MEC LIII Bipolar Complex Pyramidal (+)133100", "EC LIII Pyramidal-Stellate (+)223200p", "EC LIII Stellate (+)223000", "EC LIII-V Bipolar Pyramidal (+)223331", "EC LIV-V Pyramidal-Horizontal (+)220233p", "EC LIV-VI Deep Multipolar Principal (+)000333p", "MEC LV Multipolar-Pyramidal (+)001331", "EC LV Deep Pyramidal (+)220033", "MEC LV Pyramidal (+)331131p", "MEC LV Superficial Pyramidal (+)213330", "MEC LV-VI Pyramidal-Polymorphic (+)000023", "LEC LVI Multipolar-Pyramidal (+)001133", "EC LII Axo-Axonic (-)030000", "MEC LII Basket (-)031000", "EC LII Basket-Multipolar (-)230000", "LEC LIII Multipolar Interneuron (-)023000", "MEC LIII Multipolar Interneuron (-)113220", "MEC LIII Superficial Multipolar Interneuron (-)233000", "EC LIII Pyramidal-Looking Interneuron (-)023300", "MEC LIII Superficial Trilayered Interneuron (-)333000");

	echo "<br><center><h2><a href='generate_json.php' style='color:black;text-decoration:none'>Json Generation Page</a></h2>Note: this page's operations require read and write access to a directory specified<br>in its source code. If that is not availible online this should be run offline to complete its operations.</center><br><hr>";

	if ($page!='') {
		echo "<br>Completed processing record: ";
	}
	/*
	$i is row that is a neuron type	
	$j is column that is a parcel type
	*/
	for ($i = 0; $i < count($neuron_group); $i++) {
	//for ($i = 0; $i < 5; $i++) {
		$all_totals='';
		if ($page!='') {echo $i." ";}
		if ($page=='dal' || $page=='sd') {
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
		            
		            	if ($page == 'dal') {
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
		                elseif ($page == 'sd') {
		                	$sql    = "SELECT CAST(STD(mean_path_length) AS DECIMAL(10,2)) AS std_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(MIN(mean_path_length) AS DECIMAL(10,2)) AS min_sd, CAST(MAX(mean_path_length) AS DECIMAL(10,2)) AS max_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='" . $neuron_group[$i_adj] . "' AND neurite_quantified.neurite='" . $parcel_group[$j_adj2] . "' AND mean_path_length!='';";
			                $result = $conn->query($sql);
	                        if ($result->num_rows > 0) {
	                            while ($row = $result->fetch_assoc()) {
	                                $avg_trunk = $row['avg_trunk'];
	                                if ($avg_trunk != '' && $avg_trunk != 0) {
			                            $entry_output = $entry_output."<a href='#' title='Mean: " . $row['avg'] . "\\nCount of Recorded Values: " . $row['count_sd'] . "\\nStandard Deviation: " . $row['std_sd'] . "\\nMinimum Value: " . $row['min_sd'] . "\\nMaximum Value: " . $row['max_sd'] . "'>" . $avg_trunk . "</a>";
			                        }
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
		        if ($page == 'dal') {
			        for ($s_i = 0; $s_i < count($all_parcel_search); $s_i++) {
		                $sql    = "SELECT CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='" . $neuron_group[$i_adj] . "' AND neurite_quantified.neurite='" . $all_parcel_search[$s_i] . "' AND total_length!='';";
		                $result = $conn->query($sql);
		                if ($result->num_rows > 0) {
		                    $row        = $result->fetch_assoc();
		                    if ($row['count_tl'] > 0 && $row['avg'] != '' && $row['count_tl'] != '' && $row['std'] != '') {
		                    $all_totals = $all_totals . $prcl . $a_or_d . '\\nAverage Total Length: ' . $row['avg'] . ' \\nValues Count: ' . $row['count_tl'] . '\\nStandard Deviation: ' . $row['std'] . $nl;
		                	}
		                }
			    	}
		    	}
		    	elseif ($page == 'sd') {
		    		for ($s_i = 0; $s_i < count($all_parcel_search); $s_i++) {
	                    $sql    = "SELECT CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='" . $neuron_group[$i_adj] . "' AND neurite_quantified.neurite='" . $all_parcel_search[$s_i] . "' AND mean_path_length!='';";
	                    $result = $conn->query($sql);
	                    if ($result->num_rows > 0 && $row['avg'] != '' && $row['count_sd'] != '' && $row['std'] != '') {
	                        $row        = $result->fetch_assoc();
	                        $all_totals = $all_totals . $prcl . $a_or_d . '\\nAverage Somatic Distance: ' . $row['avg'] . '\\nValues Count: ' . $row['count_sd'] . '\\nStandard Deviation: ' . $row['std'] . $nl;
	                    }
	                }
		    	}
		    }
			if ($page == 'dal') {
		    	if ($all_totals=='') {
		    		$all_totals = $all_totals . 'Average Total Length: 0\\nValues Count: 0\\nStandard Deviation: 0';
		    	}
		    }
		    elseif ($page == 'sd') {
				if ($all_totals=='') {
		    		$all_totals = $all_totals . 'Average Somatic Distance: 0\\nValues Count: 0\\nStandard Deviation: 0';
		    	}    	
		    }
			array_push($parcel_output, $all_totals);	  
		}
		elseif ($page=='ps') {			
			for ($j=0;$j<count($neuron_group);$j++) {
			//for ($j=0;$j<5;$j++) {
				$entry_output = "";
				$sql = "SELECT CAST(AVG(potential_synapses) AS DECIMAL(5,5)) AS ps_avg FROM potential_synapses WHERE potential_synapses.source_name='".$neuron_group_long[$i]."' AND potential_synapses.target_name='".$neuron_group_long[$j]."' AND potential_synapses.potential_synapses!='';";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						$ps_avg = $row['ps_avg'];
						if ($ps_avg != '' && $ps_avg != 0) {
							$entry_output = $entry_output."<a href='#' title='Variance Will Be\\nAdded Later Here'>".$ps_avg."</a>";            
						}
					}
				} 			
				array_push($write_output, $entry_output);	
			}
		} 
	}

	/* 
	Write to File 
	
	$new_row_col is used because a new row occurs every certain
	number of columns when reading the file.
	*/
	if ($page == 'dal') {
		$json_output_file = $path_to_files."adl_db_results.json";
	}
	elseif ($page == 'sd') {
		$json_output_file = $path_to_files."sd_db_results.json";
	}
	elseif ($page == 'ps') {
		$json_output_file = $path_to_files."ps_db_results.json";
	}
	echo "<br>";

	if ($page == 'dal' || $page == 'sd') {
		$output_file = fopen($json_output_file, 'w') or die("Can't open file.");
		/* specify rows to use from template file */
		$init_col = 0;
		$init_col2 = 1;
		$new_row_col = 28;
		$total_neuron_classes = 122;
		$max_rows = 100000;
		/* specify indices */
		$neuron_group_cols = array(); // new file indexes
		$neuron_class_cols = array();
		$total_rows = ($total_neuron_classes*$new_row_col)+(2*$total_neuron_classes);
		$t_out = 0;		
		$n_out = 0;		
		$p_out = 0;
		$nl = $json_new_line; // new line
		/* create arrays of selected template indexes */
		for ($r_i = 0; $r_i < $max_rows; $r_i++) {
			array_push($neuron_group_cols, ($init_col+($new_row_col*$r_i)));
			array_push($neuron_class_cols, ($init_col2+($new_row_col*$r_i)));
		}	

		for ($o_i = 0; $o_i<$total_rows; $o_i++) {
			if ($o_i==($total_rows-1)) {
				$last_index = count($write_output)-1; // last line
				fwrite($output_file, $write_output[$last_index]."]}]}"); 
			}
			elseif (in_array($o_i, $neuron_group_cols)) {
				//if ($o_i>2) {fwrite($output_file, "\"\"]},{\"cell\":[");}
				fwrite($output_file, $neuron_groups_ordered[$t_out]);
				$t_out++;
			}
			elseif (in_array($o_i, $neuron_class_cols)) {
				$line_start = substr($neuron_classes[$n_out], 0, 34);
				$title = $parcel_output[$n_out];
				$line_end = substr($neuron_classes[$n_out], 34);
				if ($line_start != '') {
					$full_line = $line_start." title='".$title."'".$line_end;
				}
				else {
					$full_line = "\"\",";
				}
				fwrite($output_file, $full_line);
				$n_out++;
			}
			else {
				if ($write_output[$p_out] != "") {
					$text_output = $write_output[$p_out].$nl;
				}
				else {
					$text_output = "\"\",".$nl;
				}
				fwrite($output_file, $text_output);
				$p_out++;
			}
			if ($o_i == 100 || $o_i == 1000 || $o_i == 5000 || $o_i == 10000) {
				echo "<br>Output line ".$o_i." written";
			}
		}
		fclose($output_file);	

		echo "<br><br><center>Json file successfully written.<br>";	
	}
	elseif ($page=='ps') {
		$output_file = fopen($json_output_file, 'w') or die("Can't open file.");
		/* specify rows to use from template file */
		$init_col = 0;
		$init_col2 = 1;
		$new_row_col = 123;
		$max_rows = 100000;
		/* specify indices */
		$neuron_group_cols = array(); // new file indexes
		$neuron_class_cols = array();
		$total_rows = ($new_row_col*$new_row_col)+(2*$new_row_col);
		$t_out = 0;		
		$n_out = 0;		
		$p_out = 0;
		$nl = $json_new_line; // new line
		/* create arrays of selected template indexes */
		for ($r_i = 0; $r_i < $max_rows; $r_i++) {
			array_push($neuron_group_cols, ($init_col+($new_row_col*$r_i)));
			array_push($neuron_class_cols, ($init_col2+($new_row_col*$r_i)));
		}	

		for ($o_i = 0; $o_i<$total_rows; $o_i++) {
			if ($o_i==($total_rows-1)) {
				$last_index = count($write_output)-1; // last line
				fwrite($output_file, "\"".$write_output[$last_index]."\"]}]}"); 
			}
			elseif (in_array($o_i, $neuron_group_cols)) {
				//if ($o_i>2) {fwrite($output_file, "\"\"]},{\"cell\":[");}
				fwrite($output_file, $neuron_groups_ordered[$t_out]);
				$t_out++;
			}
			elseif (in_array($o_i, $neuron_class_cols)) {
				fwrite($output_file, $neuron_classes_ordered[$n_out]);
				$n_out++;
			}
			else {
				if ($write_output[$p_out] != "") {
					$text_output = "\"".$write_output[$p_out]."\",".$nl;
				}
				else {
					$text_output = "\"\",".$nl;
				}
				fwrite($output_file, $text_output);
				$p_out++;
			}
			if ($o_i == 100 || $o_i == 1000 || $o_i == 5000 || $o_i == 10000) {
				echo "<br>Output line ".$o_i." written";
			}
		}
		fclose($output_file);	

		echo "<br><br><center>Json file successfully written.<br>";		
	}

	echo "<hr><h3><center>Choose Json file to create:</center></h3>";

	echo "<center><button onclick=\"window.location.href = '?page=dal';\" style='padding:10px;'>Generate Dendrite Axon Length Json</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onclick=\"window.location.href = '?page=sd';\" style='padding:10px;'>Generate Synaptic Distance Json</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onclick=\"window.location.href = '?page=ps';\" style='padding:10px;'>Generate Synaptic Probabilities Json</button></center>";
?>
</body>