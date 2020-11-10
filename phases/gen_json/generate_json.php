<?php
	include ("generate_json_params.php"); // import parameters for this software

	if ($page=="write_file" || $page==null) {
		include ("/var/www/html/php/permission_check.php");
		echo "
		<html>
		<!--
		This software is for generating json files

		Author: Nate Sutton 
		Date:   2020
		-->

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
		<body>
		<br><hr><center><h2><a href='generate_json.php' style='color:black;text-decoration:none'>Json Generation Page</a></h2>Note: this page's operations require read and write access to a directory specified<br>in its source code. If that is not availible online this should be run offline to complete its operations.</center><br><hr>

		<h3><center>Choose Json files to create:</center></h3>

		<center><button onclick=\"window.location.href = '?page=write_file';\" class='button'>Generate phases matrix json</button></center><br><hr>
		";
	}

	function retrieve_values($conn, $i, $theta_values, $spw_values, $firingrate_values, $other_values, $neuron_ids, $conditions, $best_ranks_theta, $best_ranks_swr, $best_ranks_firingrate, $npage_theta, $npage_swr, $npage_firingrate, $npage_other, $pmid_limit, $referenceID) {
		/*
			Return values for theta, swr_ratio, and other.
		*/
		$entry_output = "";
		$id = ''; $theta = ''; $swr_ratio = ''; $firingrate = ''; $other = '';
		$species = ''; $agetype = ''; $gender = ''; $rec = ''; $behav = '';
		$min_range = ''; $max_range = ''; $count = ''; $gender2 = '';
		$theta_found = false; $swr_found = false; $firingrate_found=false; $other_found = false;
		$ripple = ''; $gamma = ''; $run_stop_ratio = ''; $epsilon = '';
		$rank_entry_theta = array(); $rank_entry_swr = array(); $rank_entry_firingrate = array();
		$lowest_rank = ''; $lowest_rank_id = ''; $lowest_swr_rank = ''; $lowest_swr_rank_id = '';
		$lowest_firingrate_rank = ''; $lowest_firingrate_rank_id = '';
		$theta_median = ''; $swr_median = ''; $firingrate_median = ''; $npage_entry = array();
		$pmid_condition = "";// AND PMID_or_ISBN = \"$pmid_limit\"";
		$refid_condition = "";// AND referenceID = \"\\\"$referenceID\\\"\"";

		// theta section
		$sql = "SELECT GROUP_CONCAT(DISTINCT id) as id, CAST(GROUP_CONCAT(DISTINCT theta) AS DECIMAL (10 , 2 )) AS theta_val, GROUP_CONCAT(DISTINCT species) as species, GROUP_CONCAT(DISTINCT agetype) as agetype, GROUP_CONCAT(DISTINCT gender) as gender, GROUP_CONCAT(DISTINCT recordingMethod) as recordingMethod, GROUP_CONCAT(DISTINCT behavioralStatus) as behavioralStatus, GROUP_CONCAT(DISTINCT metadataRank) as metadataRank FROM phases WHERE cellID = ".$neuron_ids[$i]." AND theta != \"\"";
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		if ($pmid_limit != "") {
			$sql = $sql.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql = $sql.$refid_condition;
		}
		$sql = $sql." GROUP BY species, agetype, gender, recordingMethod, behavioralStatus, metadatarank ORDER BY CAST(GROUP_CONCAT(DISTINCT CAST(metadataRank AS DECIMAL (10 , 2 ))) AS DECIMAL (10 , 2 ));";
		//echo "<br><br><br><br><br><br><br><br>sql: ".$sql;
		//$entry_output = $entry_output.$sql;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				if ($theta_found == false) {
					$id = $row['id'];
					$theta = $row['theta_val'];
					$species = $row['species'];
					$agetype = $row['agetype'];
					$gender = $row['gender'];
					if ($gender == 'unknown') {$gender2 = 'unknown sex';} else {$gender2 = $gender;}
					$rec = $row['recordingMethod'];
					$behav = $row['behavioralStatus'];
					$rank = $row['metadataRank'];
					$parsed_rank = explode(',', $rank);
					$rank = $parsed_rank[0];
					if ($theta != '') {
						$theta_found = true;
						array_push($rank_entry_theta, $species);
						array_push($rank_entry_theta, $agetype);
						array_push($rank_entry_theta, $gender);
						array_push($rank_entry_theta, $rec);
						array_push($rank_entry_theta, $behav);
						$lowest_rank = $rank;
						$lowest_rank_id = $id;
					}
				}
			}
		}
		// find median
		$sql2 = "SELECT CAST(AVG(pp.theta) AS DECIMAL(10,2)) as median_val FROM (SELECT p.theta, @rownum:=@rownum+1 as `row_number`, @total_rows:=@rownum FROM phases p, (SELECT @rownum:=0) r WHERE p.theta is NOT NULL AND p.theta!='' AND p.cellid=".$neuron_ids[$i]." AND p.metadataRank=".$lowest_rank;
		if ($pmid_limit != "") {
			$sql2 = $sql2.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql2 = $sql2.$refid_condition;
		}
		$sql2 = $sql2." ORDER BY CAST(p.theta AS DECIMAL(10,2))) as pp WHERE pp.row_number IN (FLOOR((@total_rows+1)/2))";
		$result = $conn->query($sql2);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$theta_median = $row['median_val'];
			}
		}
		//if ($neuron_ids[$i] == 2000) {echo "<br><br><br><br><br><br><br><br>sql: ".$sql2;}
		// find min and max
		$sql4 = "SELECT MIN(CAST(theta AS DECIMAL (10 , 2 ))) AS min_range, MAX(CAST(theta AS DECIMAL (10 , 2 ))) AS max_range, COUNT(theta) AS count FROM phases WHERE cellID = ".$neuron_ids[$i]." AND theta != \"\"";
		if ($conditions != "") {
			$sql4 = $sql4.$conditions;
		}
		if ($pmid_limit != "") {
			$sql4 = $sql4.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql4 = $sql4.$refid_condition;
		}
		$result = $conn->query($sql4);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$min_range = $row['min_range'];
				$max_range = $row['max_range'];
				$count = $row['count'];
			}
		}
		$entry_output = $entry_output."\"<center><span id='theta".$i."'><a href='property_page_phases.php?id_neuron=".$neuron_ids[$i]."' title='Range: [".$min_range.", ".$max_range."]\\nMeasurements: ".$count."\\nRepresentative selection: ".$species.", ".$agetype.", ".$gender2.",\\n".$rec.", ".$behav."' target='_blank'>".$theta_median."</a></span></center></div>\",";
		array_push($best_ranks_theta, $rank_entry_theta);
		array_push($theta_values, $entry_output);
		array_push($npage_entry, $neuron_ids[$i]);
		array_push($npage_entry, $theta_median);
		array_push($npage_entry, "[".$min_range.", ".$max_range."]");
		array_push($npage_entry, $count);
		array_push($npage_entry, $species.", ".$agetype.", ".$gender.",<br>".$rec.", ".$behav);
		array_push($npage_theta, $npage_entry);

		// swr ratio section
		$entry_output = "";
		//$sql = "SELECT IF (SWR_ratio != 0.0, CAST(SWR_ratio as DECIMAL(10,2)), '') AS swr_ratio_val FROM phases WHERE id = ".$theta_id;
		$sql = "SELECT GROUP_CONCAT(DISTINCT id) as id, GROUP_CONCAT(DISTINCT cellid) as cellid, CAST(GROUP_CONCAT(DISTINCT SWR_ratio) AS DECIMAL (10 , 2 )) AS swr_ratio_val, GROUP_CONCAT(DISTINCT species) as species, GROUP_CONCAT(DISTINCT agetype) as agetype, GROUP_CONCAT(DISTINCT gender) as gender, GROUP_CONCAT(DISTINCT recordingMethod) as recordingMethod, GROUP_CONCAT(DISTINCT behavioralStatus) as behavioralStatus, GROUP_CONCAT(DISTINCT metadataRank) as metadataRank FROM phases WHERE cellID = ".$neuron_ids[$i]." AND SWR_ratio != \"\"";
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		if ($pmid_limit != "") {
			$sql = $sql.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql = $sql.$refid_condition;
		}
		$sql = $sql." GROUP BY species, agetype, gender, recordingMethod, behavioralStatus, metadatarank ORDER BY CAST(GROUP_CONCAT(DISTINCT CAST(metadataRank AS DECIMAL (10 , 2 ))) AS DECIMAL (10 , 2 ));";
		//echo "<br><br><br><br><br><br><br><br>sql: ".$sql;
		//$entry_output = $entry_output.$sql;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				if ($swr_found == false) {
					$id = $row['id'];
					$swr_ratio = $swr_ratio.$row['swr_ratio_val'];
					$species = $row['species'];
					$agetype = $row['agetype'];
					$gender = $row['gender'];
					if ($gender == 'unknown') {$gender2 = 'unknown sex';} else {$gender2 = $gender;}
					$rec = $row['recordingMethod'];
					$behav = $row['behavioralStatus'];
					$rank = $row['metadataRank'];
					$parsed_rank = explode(',', $rank);
					$rank = $parsed_rank[0];
					if ($swr_ratio != '') {
						$swr_found = true;
						array_push($rank_entry_swr, $species);
						array_push($rank_entry_swr, $agetype);
						array_push($rank_entry_swr, $gender);
						array_push($rank_entry_swr, $rec);
						array_push($rank_entry_swr, $behav);
						if ($rank < $lowest_rank) {
							$lowest_rank = $rank;
							$lowest_rank_id = $id;
						}
						$lowest_swr_rank = $rank;
						$lowest_swr_rank_id = $id;
					}
					//echo "cellid: ".$row['cellid']." swr_ratio: ".$swr_ratio." ".$sql."<br>\n";
				}
			}
		}
		// find median
		$sql2 = "SELECT CAST(AVG(pp.SWR_ratio) AS DECIMAL(10,2)) as median_val FROM (SELECT p.SWR_ratio, @rownum:=@rownum+1 as `row_number`, @total_rows:=@rownum FROM phases p, (SELECT @rownum:=0) r WHERE p.SWR_ratio is NOT NULL AND p.SWR_ratio!='' AND p.cellid=".$neuron_ids[$i]." AND p.metadataRank=".$lowest_swr_rank;
		if ($pmid_limit != "") {
			$sql2 = $sql2.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql2 = $sql2.$refid_condition;
		}
		$sql2 = $sql2." ORDER BY CAST(p.theta AS DECIMAL(10,2))) as pp WHERE pp.row_number IN (FLOOR((@total_rows+1)/2))";
		$result = $conn->query($sql2);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$swr_median = $row['median_val'];
			}
		}
		$sql4 = "SELECT MIN(CAST(SWR_ratio AS DECIMAL (10 , 2 ))) AS min_range, MAX(CAST(SWR_ratio AS DECIMAL (10 , 2 ))) AS max_range, COUNT(SWR_ratio) AS count FROM phases WHERE cellID = ".$neuron_ids[$i]." AND SWR_ratio != \"\"";
		if ($conditions != "") {
			$sql4 = $sql4.$conditions;
		}
		if ($pmid_limit != "") {
			$sql4 = $sql4.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql4 = $sql4.$refid_condition;
		}
		$result = $conn->query($sql4);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$min_range = $row['min_range'];
				$max_range = $row['max_range'];
				$count = $row['count'];
			}
		}		
		$entry_output = $entry_output."\"<center><span id='swr_ratio".$i."'><a href='property_page_phases.php?pre_id=".$neuron_ids[$i]."' title='Range: [".$min_range.", ".$max_range."]\\nMeasurements: ".$count."\\nRepresentative selection: ".$species.", ".$agetype.", ".$gender2.",\\n".$rec.", ".$behav."' target='_blank'>".$swr_median."</a></span></center></div>\",";
		array_push($best_ranks_swr, $rank_entry_swr);
		array_push($spw_values, $entry_output);
		$npage_entry = array();
		array_push($npage_entry, $neuron_ids[$i]);
		array_push($npage_entry, $swr_median);
		array_push($npage_entry, "[".$min_range.", ".$max_range."]");
		array_push($npage_entry, $count);
		array_push($npage_entry, $species.", ".$agetype.", ".$gender.",<br>".$rec.", ".$behav);
		array_push($npage_swr, $npage_entry);

		// in vivo firing rate section
		$entry_output = "";
		$sql = "SELECT GROUP_CONCAT(DISTINCT id) as id, GROUP_CONCAT(DISTINCT cellid) as cellid, CAST(GROUP_CONCAT(DISTINCT firingRate) AS DECIMAL (10 , 2 )) AS firingRate_val, GROUP_CONCAT(DISTINCT species) as species, GROUP_CONCAT(DISTINCT agetype) as agetype, GROUP_CONCAT(DISTINCT gender) as gender, GROUP_CONCAT(DISTINCT recordingMethod) as recordingMethod, GROUP_CONCAT(DISTINCT behavioralStatus) as behavioralStatus, GROUP_CONCAT(DISTINCT metadataRank) as metadataRank, GROUP_CONCAT(DISTINCT firingRateRank) AS firingRateRank FROM phases WHERE cellID = ".$neuron_ids[$i]." AND firingRate != \"\"";
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		if ($pmid_limit != "") {
			$sql = $sql.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql = $sql.$refid_condition;
		}
		$sql = $sql." GROUP BY species, agetype, gender, recordingMethod, behavioralStatus, metadataRank, firingraterank ORDER BY CAST(GROUP_CONCAT(DISTINCT CAST(metadataRank AS DECIMAL (10 , 2 ))) AS DECIMAL (10 , 2 )), CAST(GROUP_CONCAT(DISTINCT CAST(firingraterank AS DECIMAL (10 , 2 ))) AS DECIMAL (10 , 2 ));";
		//$entry_output = $entry_output.$sql;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				if ($firingrate_found == false) {
					$id = $row['id'];
					$firingrate = $firingrate.$row['firingRate_val'];
					$species = $row['species'];
					$agetype = $row['agetype'];
					$gender = $row['gender'];
					if ($gender == 'unknown') {$gender2 = 'unknown sex';} else {$gender2 = $gender;}
					$rec = $row['recordingMethod'];
					$behav = $row['behavioralStatus'];
					$rank = $row['metadataRank'];
					$parsed_rank = explode(',', $rank);
					$rank = $parsed_rank[0];
					if ($firingrate != '') {
						$firingrate_found = true;
						array_push($rank_entry_firingrate, $species);
						array_push($rank_entry_firingrate, $agetype);
						array_push($rank_entry_firingrate, $gender);
						array_push($rank_entry_firingrate, $rec);
						array_push($rank_entry_firingrate, $behav);
						if ($rank < $lowest_rank) {
							$lowest_rank = $rank;
							$lowest_rank_id = $id;
						}
						$lowest_firingrate_rank = $rank;
						$lowest_firingrate_rank_id = $id;
					}
				}
			}
		}
		// find median
		$sql2 = "SELECT CAST(AVG(pp.firingRate) AS DECIMAL(10,2)) as median_val FROM (SELECT p.firingRate, @rownum:=@rownum+1 as `row_number`, @total_rows:=@rownum FROM phases p, (SELECT @rownum:=0) r WHERE p.firingRate is NOT NULL AND p.firingRate!='' AND p.cellid=".$neuron_ids[$i]." AND p.metadataRank=".$lowest_firingrate_rank;
		if ($pmid_limit != "") {
			$sql2 = $sql2.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql2 = $sql2.$refid_condition;
		}
		$sql2 = $sql2." ORDER BY CAST(p.theta AS DECIMAL(10,2))) as pp WHERE pp.row_number IN (FLOOR((@total_rows+1)/2))";
		$result = $conn->query($sql2);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$firingrate_median = $row['median_val'];
			}
		}
		$sql4 = "SELECT MIN(CAST(firingRate AS DECIMAL (10 , 2 ))) AS min_range, MAX(CAST(firingRate AS DECIMAL (10 , 2 ))) AS max_range, COUNT(firingRate) AS count FROM phases WHERE cellID = ".$neuron_ids[$i]." AND firingRate != \"\"";
		if ($conditions != "") {
			$sql4 = $sql4.$conditions;
		}
		if ($pmid_limit != "") {
			$sql4 = $sql4.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql4 = $sql4.$refid_condition;
		}
		$result = $conn->query($sql4);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				$min_range = $row['min_range'];
				$max_range = $row['max_range'];
				$count = $row['count'];
			}
		}		
		$entry_output = $entry_output."\"<center><span id='firingrate".$i."'><a href='property_page_phases.php?pre_id=".$neuron_ids[$i]."' title='Range: [".$min_range.", ".$max_range."]\\nMeasurements: ".$count."\\nRepresentative selection: ".$species.", ".$agetype.", ".$gender2.",\\n".$rec.", ".$behav."' target='_blank'>".$firingrate_median."</a></span></center></div>\",";
		array_push($best_ranks_firingrate, $rank_entry_firingrate);
		array_push($firingrate_values, $entry_output);
		$npage_entry = array();
		array_push($npage_entry, $neuron_ids[$i]);
		array_push($npage_entry, $firingrate_median);
		array_push($npage_entry, "[".$min_range.", ".$max_range."]");
		array_push($npage_entry, $count);
		array_push($npage_entry, $species.", ".$agetype.", ".$gender.",<br>".$rec.", ".$behav);
		array_push($npage_firingrate, $npage_entry);

		// other column section
		$entry_output = "";
		//$sql = "SELECT ripple, gamma, run_stop_ratio, epsilon FROM phases WHERE id = ".$lowest_rank_id;
		$sql = "SELECT cellid, ripple, gamma, run_stop_ratio, epsilon, metadataRank, species, agetype, gender, recordingMethod, behavioralStatus FROM phases WHERE cellid = ".$neuron_ids[$i]." AND (ripple != '' OR gamma != '' OR run_stop_ratio != '' OR epsilon != '') AND (theta != '' OR swr_ratio != '')";
		if ($conditions != "") {
			$sql = $sql.$conditions;
		}
		if ($pmid_limit != "") {
			$sql = $sql.$pmid_condition;
		}
		if ($referenceID != "") {
			$sql = $sql.$refid_condition;
		}
		$sql = $sql." ORDER BY CAST(metadataRank AS DECIMAL (10 , 2 ))";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			while($row = $result->fetch_assoc()) {
				if ($other_found==false) {
					$ripple = $row['ripple'];
					$gamma = $row['gamma'];
					$run_stop_ratio = $row['run_stop_ratio'];
					$epsilon = $row['epsilon'];		
					$agetype = $row['agetype'];
					$gender = $row['gender'];
					if ($gender == 'unknown') {$gender2 = 'unknown sex';} else {$gender2 = $gender;}
					$rec = $row['recordingMethod'];
					$behav = $row['behavioralStatus'];
					$rank = $row['metadataRank'];
					$parsed_rank = explode(',', $rank);
					$rank = $parsed_rank[0];
					$other_found=true;
				}
			}
		}
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
		else if ($pmid_limit !='') {
			$other = "N/A";
		}
		$entry_output = $entry_output."\"<center><span id='other".$i."'><a href='property_page_phases.php?pre_id=".$neuron_ids[$i]."' title='Representative selection: ".$species.", ".$agetype.", ".$gender2.",\\n".$rec.", ".$behav."' target='_blank'>".$other."</a></span></center></div>\"]},";
		array_push($other_values, $entry_output);
		$npage_entry = array();
		array_push($npage_entry, $neuron_ids[$i]);
		array_push($npage_entry, $other);
		array_push($npage_entry, $species.", ".$agetype.", ".$gender.",<br>".$rec.", ".$behav);
		array_push($npage_other, $npage_entry);

		return Array($theta_values, $spw_values, $firingrate_values, $other_values, $best_ranks_theta, $best_ranks_swr, $best_ranks_firingrate, $npage_theta, $npage_swr, $npage_firingrate, $npage_other);	
	}

	/*
	Generate matrices section
	*/
	if ($page=="write_file" || $page=="main_page") {
		for ($i = 0; $i < count($neuron_ids); $i++) {
			if (!isset($pmid_limit)) {
				$pmid_limit = '';
			}
			if (!isset($referenceID)) {
				$referenceID = '';
			}
			$write_output = retrieve_values($conn, $i, $theta_values, $spw_values, $firingrate_values, $other_values, $neuron_ids, $conditions, $best_ranks_theta, $best_ranks_swr, $best_ranks_firingrate, $npage_theta, $npage_swr, $npage_firingrate, $npage_other, $pmid_limit, $referenceID);
			$theta_values = $write_output[0];
			$spw_values = $write_output[1];
			$firingrate_values = $write_output[2];
			$other_values = $write_output[3];
			$best_ranks_theta = $write_output[4];
			$best_ranks_swr = $write_output[5];
			$best_ranks_firingrate = $write_output[6];
			$npage_theta = $write_output[7];
			$npage_swr = $write_output[8];
			$npage_firingrate = $write_output[9];
			$npage_other = $write_output[10];
		}

		/* 
		Write to File 
		
		$new_row_col is used because a new row occurs every certain
		number of columns when reading the file.
		*/

		/* specify rows to use from template file */
		$init_col = 0;
		$init_col2 = 1;
		$theta_col = 2;
		$spw_col = 3;
		$firingrate_col = 4;
		$other_col = 5;
		$new_row_col = 6;
		$neuron_classes = 28;
		$max_rows = 100000;
		/* specify indices */
		$neuron_group_cols = array(); // new file indexes
		$theta_cols = array();
		$spw_cols = array();
		$firingrate_cols = array();
		$other_cols = array();
		$total_rows = $new_row_col*$neuron_classes;	
		$i_t = 0;
		$i_s = 0;
		$i_f = 0;		
		$i_o = 0;
		$nl = $json_new_line;
		$json_output_string = "";

		/* create arrays of selected template indexes */
		for ($i = 0; $i < $max_rows; $i++) {
			array_push($neuron_group_cols, ($init_col+($new_row_col*$i)));
			array_push($neuron_group_cols, ($init_col2+($new_row_col*$i)));
			array_push($theta_cols, ($theta_col+($new_row_col*$i)));
			array_push($spw_cols, ($spw_col+($new_row_col*$i)));
			array_push($firingrate_cols, ($firingrate_col+($new_row_col*$i)));
			array_push($other_cols, ($other_col+($new_row_col*$i)));
		}	

		if ($page=='write_file') {
			$output_file = fopen($json_output_file, 'w') or die("Can't open file.");
		}

		for ($i = 0; $i<$total_rows; $i++) {
			if ($i==($total_rows-1)) {
				$last_index = count($other_output[0])-1; // last line
				if ($page=='write_file') {
					fwrite($output_file, "\"".$other_output[0][$last_index]."\"]}]}"); 
				}
				if ($page=='main_page') {
					$json_output_string = $json_output_string."\"".$other_output[0][$last_index]."\"]}]}";
				}
			}
			elseif (in_array($i, $neuron_group_cols)) {
				if ($page=='write_file') {
					fwrite($output_file, $neuron_groups[$i]);
				}
				if ($page=='main_page') {
					$json_output_string = $json_output_string.$neuron_groups[$i];
				}
			}
			elseif (in_array($i, $theta_cols)) {
				if ($page=='write_file') {
					fwrite($output_file, $theta_values[$i_t].$nl);
				}
				if ($page=='main_page') {
					$json_output_string = $json_output_string.$theta_values[$i_t].$nl;
				}
				$i_t++;
			}
			elseif (in_array($i, $spw_cols)) {
				if ($page=='write_file') {
					fwrite($output_file, $spw_values[$i_s].$nl);
				}
				if ($page=='main_page') {
					$json_output_string = $json_output_string.$spw_values[$i_s].$nl;
				}
				$i_s++;
			}
			elseif (in_array($i, $firingrate_cols)) {
				if ($page=='write_file') {
					fwrite($output_file, $firingrate_values[$i_f].$nl);
				}
				if ($page=='main_page') {
					$json_output_string = $json_output_string.$firingrate_values[$i_f].$nl;
				}
				$i_f++;
			}
			elseif (in_array($i, $other_cols)) {
				if ($page=='write_file') {
					fwrite($output_file, $other_values[$i_o].$nl);
				}
				if ($page=='main_page') {
					$json_output_string = $json_output_string.$other_values[$i_o].$nl;
				}
				$i_o++;
			}
		}
		if ($page=='write_file') {
			fclose($output_file);	
			echo "<br><br>Json file written.";
		}
	}

if ($page=="write_file" || $page="") {
	echo "</body>";
}
?>