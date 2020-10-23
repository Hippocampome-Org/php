<?php
  include ("/var/www/html/php/permission_check.php");
?>
<html>
<!--
This software is for generating json files

Author: Nate Sutton 
Date:   2020
-->
<?php
if ($_REQUEST['page']!="main_page") {
echo "
<head>
	<title>Json Generation</title>
	<link rel='icon' href='../../images/Hippocampome_logo.ico'>
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
";
}
?>
<body>
<?php
	include ("generate_json_params.php"); // import parameters for this software

	if ($_REQUEST['page']!="main_page") {
		echo "<br><hr><center><h2><a href='generate_json.php' style='color:black;text-decoration:none'>Json Generation Page</a></h2>Note: this page's operations require read and write access to a directory specified<br>in its source code. If that is not availible online this should be run offline to complete its operations.</center><br><hr>";

		echo "<h3><center>Choose Json files to create:</center></h3>";

		echo "<center><button onclick=\"window.location.href = '?page=phases_matrix';\" class='button'>Generate phases matrix json</button></center><br><hr>";
	}

	function retrieve_values($conn, $i, $theta_values, $spw_values, $other_values, $neuron_ids, $conditions) {
		/*
			If statement used below in theta min and max query to avoid blank values being reported as
			0.0 which would be incorrect.
		*/
		$entry_output = "";
		$theta_id = ''; $theta = ''; $swr_ratio = ''; $other = '';
		$species = ''; $age = ''; $gender = ''; $rec = ''; $behav = '';
		$min_range = ''; $max_range = ''; $count = '';
		$theta_found = false;
		$ripple = ''; $gamma = ''; $run_stop_ratio = ''; $epsilon = '';

		// theta section
		$sql = "SELECT GROUP_CONCAT(DISTINCT id) as id, IF (theta != 0, GROUP_CONCAT(DISTINCT CAST(theta AS DECIMAL (10 , 2 ))), '') AS theta_val, GROUP_CONCAT(DISTINCT species) as species, GROUP_CONCAT(DISTINCT age) as age, GROUP_CONCAT(DISTINCT gender) as gender, GROUP_CONCAT(DISTINCT recordingAssignment) as recordingAssignment, GROUP_CONCAT(DISTINCT behavioralStatus) as behavioralStatus FROM phases WHERE cellID = ".$neuron_ids[$i];
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		$sql = $sql." GROUP BY theta ORDER BY CAST(GROUP_CONCAT(DISTINCT CAST(metadataRank AS DECIMAL (10 , 2 ))) AS DECIMAL (10 , 2 ));";
		//$entry_output = $entry_output.$sql;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				if ($theta_found == false) {
					$theta_id = $row['id'];
					$theta = $row['theta_val'];
					$species = $row['species'];
					$age = $row['age'];
					$gender = $row['gender'];
					$rec = $row['recordingAssignment'];
					$behav = $row['behavioralStatus'];
					if ($theta != '') {
						$theta_found = true;
					}
				}
			}
		}
		$sql = "SELECT MIN(IF (theta != 0, CAST(theta AS DECIMAL (10 , 2 )), 'NA')) AS min_range, MAX(IF (theta != 0, CAST(theta AS DECIMAL (10 , 2 )), -1E200)) AS max_range, COUNT(theta) AS count FROM phases WHERE cellID = ".$neuron_ids[$i];
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$min_range = $row['min_range'];
				$max_range = $row['max_range'];
				$count = $row['count'];
			}
		}
		$entry_output = $entry_output."\"<center><span id='theta".$i."'><a href='property_page_phases.php?pre_id=".$neuron_ids[$i]."' title='Range: [".$min_range.", ".$max_range."]\\nMeasurements: ".$count."\\nRepresentative selection: ".$species.", ".$age.", ".$gender.",\\n".$rec.",\\n".$behav."' target='_blank'>".$theta."</a></span></center></div>\",";
		array_push($theta_values, $entry_output);

		// swr ratio section
		$entry_output = "";
		$sql = "SELECT IF (SWR_ratio != 0, CAST(SWR_ratio as DECIMAL(10,2)), '') AS swr_ratio_val FROM phases WHERE id = ".$theta_id;
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		//$entry_output = $entry_output.$sql;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			$row = $result->fetch_assoc();
			$swr_ratio = $row['swr_ratio_val'];
		}
		$sql = "SELECT MIN(IF (SWR_ratio != 0, CAST(SWR_ratio AS DECIMAL (10 , 2 )), 'NA')) AS min_range, MAX(IF (SWR_ratio != 0, CAST(SWR_ratio AS DECIMAL (10 , 2 )), -1E200)) AS max_range, COUNT(SWR_ratio) AS count FROM phases WHERE cellID = ".$neuron_ids[$i];
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$min_range = $row['min_range'];
				$max_range = $row['max_range'];
				$count = $row['count'];
			}
		}		
		//if ($swr_ratio != '' && $swr_ratio != 0) {
			$entry_output = $entry_output."\"<center><span id='swr_ratio".$i."'><a href='property_page_phases.php?pre_id=".$neuron_ids[$i]."' title='Range: [".$min_range.", ".$max_range."]\\nMeasurements: ".$count."' target='_blank'>".$swr_ratio."</a></span></center></div>\",";
		//} 
		array_push($spw_values, $entry_output);

		// other column section
		$entry_output = "";
		$sql = "SELECT ripple, gamma, run_stop_ratio, epsilon FROM phases WHERE id = ".$theta_id;
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$ripple = $row['ripple'];
				$gamma = $row['gamma'];
				$run_stop_ratio = $row['run_stop_ratio'];
				$epsilon = $row['epsilon'];
			}
		}
		if ($theta != '' && $theta != 0) {
			if ($ripple != '') {
				$other = "ripple";
			}
			else if ($gamma != '') {
				$other = "gamma";
			}
			else if ($run_stop_ratio != '') {
				$other = "run/stop ratio";
			}
			else if ($epsilon != '') {
				$other = "epsilon";
			}
			$entry_output = $entry_output."\"<center><span id='other".$i."'><a href='property_page_phases.php?pre_id=".$neuron_ids[$i]."' title='".$other."' target='_blank'>".$other."</a></span></center></div>\"]},";
		} 
		array_push($other_values, $entry_output);

		return Array($theta_values, $spw_values, $other_values);		
	}

	/*
	Generate matrices section
	*/
	if ($page=='phases_matrix') {
		for ($i = 0; $i < count($neuron_ids); $i++) {
			$write_output = retrieve_values($conn, $i, $theta_values, $spw_values, $other_values, $neuron_ids, $conditions);
			$theta_values = $write_output[0];
			$spw_values = $write_output[1];
			$other_values = $write_output[2];
		}
		//echo $spw_values[1]."<br>";

		/* 
		Write to File 
		
		$new_row_col is used because a new row occurs every certain
		number of columns when reading the file.
		*/
		$output_file = fopen($json_output_file, 'w') or die("Can't open file.");
		/* specify rows to use from template file */
		$init_col = 0;
		$init_col2 = 1;
		$theta_col = 2;
		$spw_col = 3;
		$other_col = 4;
		$new_row_col = 5;
		$neuron_classes = 28;
		$max_rows = 100000;
		/* specify indices */
		$neuron_group_cols = array(); // new file indexes
		$theta_cols = array();
		$spw_cols = array();
		$other_cols = array();
		$total_rows = $new_row_col*$neuron_classes;//($new_row_col*$new_row_col)+(2*$new_row_col);	
		$i_t = 0;
		$i_s = 0;
		$i_o = 0;
		//$n_out = 0;		
		//$p_out = 0;
		$nl = $json_new_line; // new line
		/* create arrays of selected template indexes */
		for ($i = 0; $i < $max_rows; $i++) {
			array_push($neuron_group_cols, ($init_col+($new_row_col*$i)));
			array_push($neuron_group_cols, ($init_col2+($new_row_col*$i)));
			array_push($theta_cols, ($theta_col+($new_row_col*$i)));
			array_push($spw_cols, ($spw_col+($new_row_col*$i)));
			array_push($other_cols, ($other_col+($new_row_col*$i)));
		}	

		for ($i = 0; $i<$total_rows; $i++) {
			if ($i==($total_rows-1)) {
				$last_index = count($other_output[0])-1; // last line
				fwrite($output_file, "\"".$other_output[0][$last_index]."\"]}]}"); 
			}
			elseif (in_array($i, $neuron_group_cols)) {
				fwrite($output_file, $neuron_groups[$i]);
			}
			elseif (in_array($i, $theta_cols)) {
				fwrite($output_file, $theta_values[$i_t].$nl);
				$i_t++;
			}
			elseif (in_array($i, $spw_cols)) {
				fwrite($output_file, $spw_values[$i_s].$nl);
				//echo $i." ".$spw_values[$i_s]."<br>";
				$i_s++;
			}
			elseif (in_array($i, $other_cols)) {
				fwrite($output_file, $other_values[$i_o].$nl);
				$i_o++;
			}
		}
		fclose($output_file);	
		echo "<br><br>Json file written.";
	}
?>
</body>