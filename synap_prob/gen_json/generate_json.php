<html>
<!--
This software is for generating json files

Author: Nate Sutton 
Date:   2020
-->
<head>
	<title>Json Generation</title>
	<link rel="icon" href="../../images/Hippocampome_logo.ico">
	<style>
	body {
    	background-color: lightgrey;
	}
	.button {
		padding:20px;
		font-size:20px;
		border-radius: 30px;
		border-color: darkgrey;
		border: 2px solid darkgrey;
	}
	</style>
</head>
<body>
<?php
	// import parameters for this software
	include ("generate_json_params.php");	

	echo "<br><hr><center><h2><a href='generate_json.php' style='color:black;text-decoration:none'>Json Generation Page</a></h2>Note: this page's operations require read and write access to a directory specified<br>in its source code. If that is not availible online this should be run offline to complete its operations.</center><br><hr>";


	echo "<h3><center>Choose Json file to create:</center></h3>";

	echo "<center><button onclick=\"window.location.href = '?page=dal';\" class='button'>Dendrite Axon Length</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onclick=\"window.location.href = '?page=sd';\" class='button'>Somatic Distance</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onclick=\"window.location.href = '?page=ps';\" class='button'>Number of Potential Synapses</button><br><br><button onclick=\"window.location.href = '?page=noc';\" class='button'>Number of Contacts</button>&nbsp;&nbsp;&nbsp;&nbsp;<button onclick=\"window.location.href = '?page=prosyn';\" class='button'>Synaptic Probabilities</button></center><br><hr>";

	if ($page!='') {
		echo "<br>Completed processing record: ";
	}

	/*
	Generate matrices section

	$i is row that is a neuron type	
	$j is column that is a parcel type
	*/
	for ($i = 0; $i < count($neuron_ids); $i++) {
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
			                $sql    = "SELECT CAST(STD(total_length) AS DECIMAL(10,2)) AS std_tl, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.unique_id=".$neuron_ids[$i_adj]." AND neurite_quantified.neurite='" . $parcel_group[$j_adj2] . "' AND total_length!='';";
			                $result = $conn->query($sql);
			                if ($result->num_rows > 0) {
			                    while ($row = $result->fetch_assoc()) {
			                        $avg_trunk = $row['avg_trunk'];
			                        if ($avg_trunk != '' && $avg_trunk != 0) {
			                            $entry_output = $entry_output."<a href='property_page_synpro.php?id_neuron=".$neuron_ids[$i_adj]."&val_property=".$parcel_ids[$j_adj2];
				                            if ($adi == 0){
				                            	$entry_output = $entry_output."&color=red&page=1&sp_page=dal'";}
				                            else {
				                            	$entry_output = $entry_output."&color=blue&page=1&sp_page=dal'";	
				                            }
			                            	$entry_output = $entry_output." title='Mean: " . $row['avg'] . "\\nCount of Recorded Values: " . $row['count_tl'] . "\\nStandard Deviation: " . $row['std_tl'] . "' style='color:";
			                            	if ($adi) {$entry_output = $entry_output."blue";} 
			                            	else {$entry_output = $entry_output."red";}
			                            $entry_output = $entry_output." !important' target='_blank'>" . $avg_trunk . "</a>";                            	
			                        }
			                    }
			                }  
		                }
		                elseif ($page == 'sd') {
		                	$sql    = "SELECT CAST(STD(mean_path_length) AS DECIMAL(10,2)) AS std_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(MIN(mean_path_length) AS DECIMAL(10,2)) AS min_sd, CAST(MAX(mean_path_length) AS DECIMAL(10,2)) AS max_sd FROM neurite_quantified WHERE neurite_quantified.unique_id=".$neuron_ids[$i_adj]." AND neurite_quantified.neurite='" . $parcel_group[$j_adj2] . "' AND mean_path_length!='';";
			                $result = $conn->query($sql);
	                        if ($result->num_rows > 0) {
	                            while ($row = $result->fetch_assoc()) {
	                                $avg_trunk = $row['avg_trunk'];
	                                if ($avg_trunk != '' && $avg_trunk != 0) {
			                            $entry_output = $entry_output."<a href='property_page_synpro.php?id_neuron=".$neuron_ids[$i_adj]."&val_property=".$parcel_ids[$j_adj2];
			                            	if ($adi == 0){
				                            	$entry_output = $entry_output."&color=red&page=1&sp_page=sd'";}
				                            else {
				                            	$entry_output = $entry_output."&color=blue&page=1&sp_page=sd'";	
				                            }
			                            	$entry_output = $entry_output." title='Mean: " . $row['avg'] . "\\nCount of Recorded Values: " . $row['count_sd'] . "\\nStandard Deviation: " . $row['std_sd'] . "\\nMinimum Value: " . $row['min_sd'] . "\\nMaximum Value: " . $row['max_sd'] . "' style='color:";
			                            	if ($adi) {$entry_output = $entry_output."blue";} 
			                            	else {$entry_output = $entry_output."red";}
			                            $entry_output = $entry_output." !important' target='_blank'>" . $avg_trunk . "</a>";
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
		            $a_or_d = 'Axon: ';
		            $prcl   = '';
		            $nl     = "\\n";
		            $all_parcel_search = new ArrayObject($all_parcel_axon);
		        } else {
		            $a_or_d = 'Dendrite: ';
		            $prcl   = '';
		            $nl     = "";
		            $all_parcel_search = new ArrayObject($all_parcel_dend);	            
		        }
		        if ($page == 'dal') {
			        for ($s_i = 0; $s_i < count($all_parcel_search); $s_i++) {
		                $sql    = "SELECT CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.unique_id=".$neuron_ids[$i_adj]." AND neurite_quantified.neurite='" . $all_parcel_search[$s_i] . "' AND total_length!='';";
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
		    		/*for ($s_i = 0; $s_i < count($all_parcel_search); $s_i++) {
	                    $sql    = "SELECT CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd FROM neurite_quantified WHERE neurite_quantified.unique_id=".$neuron_ids[$i_adj]." AND neurite_quantified.neurite='" . $all_parcel_search[$s_i] . "' AND mean_path_length!='';";
	                    $result = $conn->query($sql);
	                    if ($result->num_rows > 0 && $row['avg'] != '' && $row['count_sd'] != '' && $row['std'] != '') {
	                        $row        = $result->fetch_assoc();
	                        $all_totals = $all_totals . $prcl . $a_or_d . '\\nAverage Somatic Distance: ' . $row['avg'] . '\\nValues Count: ' . $row['count_sd'] . '\\nStandard Deviation: ' . $row['std'] . $nl;
	                    }
	                }*/
	                //$all_totals = $all_totals . $neuron_group_hnc[$i_adj];
	                //$all_totals = $neuron_group_long[$i_adj];
		    	}
		    }
			if ($page == 'dal') {
		    	if ($all_totals=='') {
		    		$all_totals = $all_totals . 'Average Total Length: 0\\nValues Count: 0\\nStandard Deviation: 0';
		    	}
		    }
		    /*elseif ($page == 'sd') {
				if ($all_totals=='') {
		    		//$all_totals = $all_totals . 'Average Somatic Distance: 0\\nValues Count: 0\\nStandard Deviation: 0';
		    		$all_totals = $all_totals . $neuron_group_hnc[$i_adj];
		    	}    	
		    }*/
			array_push($parcel_output, $neuron_group_long2[$i_adj]."\\n".$all_totals);	  
		}
		elseif ($page=='ps') {	
			$write_output = n_by_m_values($conn, 'ps', $neuron_group_hnc, $neuron_group_long, $i, $write_output, $neuron_ids);
		} 
		elseif ($page=='noc') {	
			$write_output = n_by_m_values($conn, 'noc', $neuron_group_hnc, $neuron_group_long, $i, $write_output, $neuron_ids);
		}
		elseif ($page=='prosyn') {	
			$write_output = n_by_m_values($conn, 'prosyn', $neuron_group_hnc, $neuron_group_long, $i, $write_output, $neuron_ids);
		}
	}

	function n_by_m_values($conn, $type, $neuron_group, $neuron_group_long, $i, $write_output, $neuron_ids) {
		for ($j=0;$j<count($neuron_ids);$j++) {
			$entry_output = "";
			if ($type == 'ps') {
				$sql = "SELECT CAST(potential_synapses AS DECIMAL(10,5)) as val FROM number_of_contacts as nc, SynproTypeTypeRel as ttr WHERE nc.source_name='".$neuron_group_long[$i]."' AND nc.target_name='".$neuron_group_long[$j]."' AND nc.source_id=ttr.type_id AND nc.potential_synapses!='' AND nc.neurite=CONCAT((SELECT subregion FROM SynproTypeTypeRel WHERE type_id=nc.source_id),':All:Both');";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						$val = $row['val'];
						if ($val != '' && $val != 0) {
							$entry_output = $entry_output."<a href='property_page_synpro_pvals.php?id_neuron_source=".$neuron_ids[$i]."&id_neuron_target=".$neuron_ids[$j]."&color=blue&page=1&nm_page=ps' title='Variance Will Be\\nAdded Later Here' target='_blank'>".$val."</a>";
						}
					}
				} 
			}
			elseif ($type == 'noc') {
				$sql = "SELECT CAST(number_of_contacts AS DECIMAL(5,2)) as val FROM number_of_contacts as nc, SynproTypeTypeRel as ttr WHERE nc.source_name='".$neuron_group_long[$i]."' AND nc.target_name='".$neuron_group_long[$j]."' AND nc.source_id=ttr.type_id AND nc.number_of_contacts!='' AND nc.neurite=CONCAT((SELECT subregion FROM SynproTypeTypeRel WHERE type_id=nc.source_id),':All:Both');";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						$val = $row['val'];
						if ($val != '' && $val != 0) {
							$entry_output = $entry_output."<center><a href='property_page_synpro_pvals.php?id_neuron_source=".$neuron_ids[$i]."&id_neuron_target=".$neuron_ids[$j]."&color=blue&page=1&nm_page=noc' title='".$val."' target='_blank'>".$val."</a></center>";  
						}
					}
				} 	
			}		
			elseif ($type == 'prosyn') {
				$sql = "SELECT CAST(probability AS DECIMAL(10,5)) as val FROM number_of_contacts as nc, SynproTypeTypeRel as ttr WHERE nc.source_name='".$neuron_group_long[$i]."' AND nc.target_name='".$neuron_group_long[$j]."' AND nc.source_id=ttr.type_id AND nc.probability!='' AND nc.neurite=CONCAT((SELECT subregion FROM SynproTypeTypeRel WHERE type_id=nc.source_id),':All:Both');";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						$val = $row['val'];
						if ($val != '' && $val != 0) {
							$entry_output = $entry_output."<a href='property_page_synpro_pvals.php?id_neuron_source=".$neuron_ids[$i]."&id_neuron_target=".$neuron_ids[$j]."&color=blue&page=1&nm_page=prosyn' title='".$val."' target='_blank'>".$val."</a>";            
						}
					}
				} 	
			}
			array_push($write_output, $entry_output);	
		}

		return $write_output;
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
	elseif ($page == 'noc') {
		$json_output_file = $path_to_files."noc_db_results.json";
	}
	elseif ($page == 'prosyn') {
		$json_output_file = $path_to_files."prosyn_db_results.json";
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

		echo "<br><br><center>Json file successfully written.<br><br><hr>";	
	}
	elseif ($page == 'ps' || $page == 'noc' || $page == 'prosyn') {
		$output_file = fopen($json_output_file, 'w') or die("Can't open file.");
		/* specify rows to use from template file */
		$init_col = 0;
		$init_col2 = 1;
		$new_row_col = 124;
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

		echo "<br><br><center>Json file successfully written.<br><br><hr>";		
	}
	echo "<br><br>";
?>
</body>