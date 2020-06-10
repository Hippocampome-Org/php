<html>
<!--
This software is for generating json files

Author: Nate Sutton 
Date:   2020

Note:
The "CAST(STD(CAST" and similar entries is needed in below queries because it
first needs to cast the db value from text into decimal, then take std(), then
limit significant digits using cast again.

reference: https://stackoverflow.com/questions/37618679/format-number-to-n-significant-digits-in-php
https://stackoverflow.com/questions/5149129/how-to-strip-trailing-zeros-in-php

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

	echo "<center><button onclick=\"window.location.href = '?page=syn_model';\" class='button'>Synaptome Model Values</button></center><br><hr>";

	if ($page!='') {
		echo "<br>Completed processing record: ";
	}

	function toPrecision($value, $digits)
	{
	    if ($value == 0) {
	        $decimalPlaces = $digits - 1;
	    } elseif ($value < 0) {
	        $decimalPlaces = $digits - floor(log10($value * -1)) - 1;
	    } else {
	        $decimalPlaces = $digits - floor(log10($value)) - 1;
	    }

	    $answer = ($decimalPlaces > 0) ?
	        number_format($value, $decimalPlaces) : round($value, $decimalPlaces);
	    return $answer; // (float) is to remove trailing 0
	}

	/*
	Generate matrices section

	$i is row that is a neuron type	
	$j is column that is a parcel type
	*/
	for ($i = 0; $i < count($neuron_ids); $i++) {
	//for ($i = 0; $i < 5; $i++) {
		if ($page!='') {echo $i." ";}
		if ($page=='syn_model') {	
			$write_output = retreive_values($conn, 'syn_model', $neuron_group_hnc, $neuron_group_long, $i, $write_output, $neuron_ids);
		}
	}

	function retreive_values($conn, $type, $neuron_group, $neuron_group_long, $i, $write_output, $neuron_ids) {
		for ($j=0;$j<count($neuron_ids);$j++) {
		//for ($j=0;$j<3;$j++) {
			$entry_output = "";
			if ($type == 'syn_model') {
				$sql = "SELECT CAST(means_g AS DECIMAL(10,5)) as avg, CAST(std_g AS DECIMAL(10,5)) as std, CAST(min_g AS DECIMAL(10,5)) as min, CAST(max_g AS DECIMAL(10,5)) as max, CAST(cv_g AS DECIMAL(10,5)) as cv FROM tm_cond1 WHERE pre='".$neuron_group_long[$i]."' AND post='".$neuron_group_long[$j]."';";
				//$entry_output = $entry_output.$sql;
				$result = $conn->query($sql);
				if ($result->num_rows > 0) { 
					while($row = $result->fetch_assoc()) {
						$val = $row['avg'];
						if ($val != '' && $val != 0) {
							$entry_output = $entry_output."<center><a href='synaptome.php?id_neuron_source=".$neuron_ids[$i]."&id_neuron_target=".$neuron_ids[$j]."' title='Standard Deviation: ".$row['std']."\\nMin: ". $row['min']."\\nMax: ".$row['max']."\\nCoefficient of Variation: ".$row['cv']."' target='_blank'>".toPrecision($val,4)."</a></center>";
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
	if ($page == 'syn_model') {
		$json_output_file = $path_to_files."json_files/cond1_g.json";
	}
	echo "<br>";

	if ($page == 'syn_model') {
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