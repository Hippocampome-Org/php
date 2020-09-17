<html>
<?php
	set_time_limit(0); // prevent processing time timeout.
	include("generate_file_list.php");
	$base_dir = "combined_results";
	$file_dir = "3";
	$list_file = $base_dir."/".$file_dir."/filelist.txt";
	$file_list = array();
	$line_num = 0;
	$file_num = 0;
	$progress_counter = 0;
	$core_sum = 0;
	$high_score = 0;
	$output_dataset = FALSE;
	$output_filepath = "combined_results/combined/combined_".$file_dir.".csv";
	$core_articles_path = "core_collection_articles.csv";
	$core_articles = array();
	$output_lines = array();
	$gs_files = array(1,2,3,4,5,26,27,28,29);
	$pm_files = array(29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58);

	// activation trigger
	$run_extraction = FALSE;
	if (isset($_REQUEST['run']) && $_REQUEST['run']=='yes') {
		$run_extraction = TRUE;
	}

	echo "<br><center><h4><a href='combine_results.php' style='text-decoration:none'>Combine Results</a></h4></center><br>";
	echo "<center><h3><table>
	<tr><td>File combinations processed:</td><td><textarea id='combos_processed'>0</textarea></td></tr>
	<tr><td>File combination currently processing:&nbsp;&nbsp;&nbsp;&nbsp;</td><td><textarea id='current_processing'>0</textarea></td></tr>
	<tr><td>Current combo articles processed:</td><td><textarea id='articles_processed'>0</textarea></td></tr>
	<tr><td>Current combo files processed:</td><td><textarea id='files_processed'>0</textarea></td></tr>
	<tr><td>Highest scoring files:</td><td><textarea id='high_score_files'>0</textarea></td></tr>
	<tr><td>Highest scoring matches:</td><td><textarea id='high_score_matches'>0</textarea></td></tr>
	</table></h3></center>";

	echo "<br><center><h4><a href='?run=yes' style='text-decoration:none'>Run extraction</a></h4></center><br>";

	if ($run_extraction) {
	/*if (($fh = fopen($list_file, "r")) !== FALSE) 
	{
	  while (! feof($fh)) 
	  {	
	  	$line = fgets($fh);
	  	array_push($file_list, trim($line));
	  }
	}
	fclose($fh); // Close the file*/

	if (($fh = fopen($core_articles_path, "r")) !== FALSE) 
	{
	  $line = fgets($fh); // skip column names
	  while (! feof($fh)) 
	  {	
	  	$line = fgets($fh);
	  	array_push($core_articles, trim($line));
	  }
	}
	fclose($fh);

	$core_found = array_fill(0, sizeof($core_articles), 0);

	function extract_articles($file_desc, $output_lines, $core_articles, $core_found, $line_num) {
		$db_name = explode(',', $file_desc)[0];
		$file_name = explode(',', $file_desc)[1];
		$title = "";
		$title_matches = array();

		if ($file_name!="" && ($fh = fopen($file_name, "r")) !== FALSE) 
		{
		  while (($line_array = fgetcsv($fh, 10000, ",")) !== FALSE)
		  {	
		  	if ($db_name == 'scholar') {
		  		$title = str_replace("\"", "", $line_array[2]);
		  		$year = $line_array[3];
		  	}
		  	if ($db_name == 'pubmed') {
		  		$title = str_replace("\"", "", $line_array[1]);
		  		$year = str_replace("\"", "", $line_array[6]);
		  	}

			if ($title != "Title") {
				for ($i = 0; $i < sizeof($core_articles); $i++) {
					// add escape charactors
					$title2 = $title;
					$special_chars = "~,`,!,@,#,$,%,^,&,*,(,),-,_,=,+,{,},|,:,;,\\\\,\\\",',<,>,.,?,/";
					$schars_array = explode(",", $special_chars);
					foreach ($schars_array as $char) {
						$escaped_char = "\\".$char;
						$title2 = str_replace($char,$escaped_char,$title2);
					}

					$title4 = str_replace("[","",$title2);
					$title5 = str_replace("]","",$title4);
					$pattern = "/(".$title5.".*)/";
					$title_matches = array();
					preg_match($pattern, $core_articles[$i], $title_matches);
					if (sizeof($title_matches) > 0 && $title != "") {
						$core_found[$i] = 1;
	  					array_push($output_lines, "\"".$title."\",".$year);
	  					//echo $core_articles[$i]."<br>";
					}
				}
	  		}

		  	$line_num++;
		  }
		}

		$results_array = array($output_lines, $core_found, $line_num);
		return $results_array;
	}

	// search file combinations
	for ($i = 0; $i < pow(sizeof($gs_files),4); $i++) {
		$file_list_array = generate_file_list(4, 1, $gs_files, $pm_files, $i);
		$file_list = $file_list_array[0];
		$file_numbers = $file_list_array[1];
		$core_found = array_fill(0, sizeof($core_articles), 0);
		$output_lines = array();
		for ($j = 0; $j < sizeof($file_list); $j++) {
			$file_num++;
			$results_array = extract_articles($file_list[$j], $output_lines, $core_articles, $core_found, $line_num);
			$output_lines = $results_array[0];
			$core_found = $results_array[1];
			$line_num = $results_array[2];
		}

		// count results
		$core_sum = 0;
		$avoid_dups = array();
		foreach ($output_lines as $line) {
			$dup_found = FALSE;
			foreach ($avoid_dups as $found_title) {
				if ($line == $found_title) {
					$dup_found = TRUE;
				}			
			}
			if ($dup_found == FALSE && $line!="\"\",0") {
				array_push($avoid_dups, $line);
				$core_sum++;
			}
		}

		if ($core_sum >= $high_score) {
			echo "<script>document.getElementById('high_score_matches').value = '$core_sum';</script>";
			echo "<script>document.getElementById('high_score_files').value = '$file_numbers';</script>";
			$high_score = $core_sum;
			//foreach ($output_lines)
			//echo sizeof($output_lines)."<br>";
			/*foreach ($output_lines as $test) {
				echo $test."<br>";
			}*/
		}
		echo "<script>document.getElementById('combos_processed').value = '$i';</script>";
		echo "<script>document.getElementById('current_processing').value = '$file_numbers';</script>";
		//if ($line_num % 10000 == 0) {
  			echo "<script>document.getElementById('articles_processed').value = '$line_num';</script>";
  		//}
		echo "<script>document.getElementById('files_processed').value = '$file_num';</script>";
		ob_flush();
	    flush();
	}

  	// Output dataset
  	if ($output_dataset) {
		$output_file = fopen($output_filepath, 'w') or die("Can't open file.");
		fwrite($output_file, "title,year\n");

		/*for ($i = 0; $i < sizeof($core_found); $i++) {
			if ($core_found[$i]==1) {
				//fwrite($output_file, $core_articles[$i]."\n");
				$core_sum++;
			}
		}*/

		$avoid_dups = array();
		foreach ($output_lines as $line) {
			$dup_found = FALSE;
			foreach ($avoid_dups as $found_title) {
				if ($line == $found_title) {
					$dup_found = TRUE;
				}			
			}
			if ($dup_found == FALSE && $line!="\"\",0") {
				fwrite($output_file, $line."\n");
				array_push($avoid_dups, $line);
				$core_sum++;
			}
		}
		fclose($output_file);	

		echo "<br><center><h3>Titles matched: ".$core_sum.".<br>Articles processed: ".$line_num.".<br>Results file creation completed.</h3></center>";
		}
	}

?>