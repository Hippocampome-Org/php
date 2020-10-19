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
	include ("generate_json_params.php"); // import parameters for this software

	echo "<br><hr><center><h2><a href='generate_json.php' style='color:black;text-decoration:none'>Json Generation Page</a></h2>Note: this page's operations require read and write access to a directory specified<br>in its source code. If that is not availible online this should be run offline to complete its operations.</center><br><hr>";

	echo "<h3><center>Choose Json files to create:</center></h3>";

	echo "<center><button onclick=\"window.location.href = '?page=phases_matrix';\" class='button'>Generate phases matrix json</button></center><br><hr>";

	function retrieve_values($conn, $i, $write_output, $neuron_ids) {
			$entry_output = "";
			if ($type == 'phases_matrix') {
				$theta = '';
				$swr_ratio = '';
				$min_range = '';
				$max_range = '';
				$count = '';
				$sql = "SELECT AVG(theta) AS theta, AVG(SWR_ratio) AS swr_ratio, MIN(theta) as min_range, MAX(theta) as max_range, COUNT(theta) as count FROM hippocsv2db.phases WHERE cellID = ".$neuron_ids[$i];
				//$entry_output = $entry_output.$sql;
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						$theta = $row['theta'];
						$swr_ratio = $row['swr_ratio'];
						$min_range = $row['min_range'];
						$max_range = $row['max_range'];
						$count = $row['count'];
					}
				}
				if ($theta != '' && $theta != 0) {
					$entry_output = $entry_output."<center><a href='property_page_pahses.php?pre_id=".$neuron_ids[$i]." title='Range: [".$min_range.", ".$max_range."]\\nMeasurements: ".$count."' target='_blank'>".$theta."</a></center></div>";
				} 
			}
			array_push($write_output, $entry_output);	
		}

		return $write_output;		
	}

	/*
	Generate matrices section

	$i is row that is a neuron type	
	$j is column that is a parcel type
	*/
	if (true) {
		for ($i = 0; $i < count($neuron_ids); $i++) {
			if ($page=='phases_matrix') {	
				$write_output = retrieve_values($conn, $i, $write_output, $neuron_ids);
			}
		}

		/* 
		Write to File 
		
		$new_row_col is used because a new row occurs every certain
		number of columns when reading the file.
		*/
		if ($page=='phases_matrix') {
			$json_output_file = $path_to_files."json_files/cond".$cond_num."_".$param.".json";
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
			}
			fclose($output_file);			
		}		

		if ($page!='') {
			echo "<br><center>Status: json files condition #".$cond_num." param ".$param." successfully written.<br>";
			echo "<br><hr><br><br>";
		}
	}
	else if ($cond_num <= $num_conds) {
			echo "<br><center>Status: moving to processing condition #".($cond_num + 1)."<br>";
			echo "<br><hr><br><br>";
	}
	else if ($cond_num > $num_conds) {
			echo "<br><center>Status: finished processing<br>";
			echo "<br><hr><br><br>";
	}

	if (($page=='phases_matrix') && !($cond_num >= $num_conds && $param_num > sizeof($params))) {
		if ($param_num <= sizeof($params)) {
			$param_num++;
		}
		else {
			$cond_num++;
			$param_num = 0;
		}
		if ($page=='phases_matrix') {
			echo "<script>
			window.location.replace('generate_json.php?page=phases_matrix&cond_num=".$cond_num."&param_num=".$param_num."');
			</script>";
		}
	}
?>
</body>