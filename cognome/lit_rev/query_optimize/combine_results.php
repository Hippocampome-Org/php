<html>
<?php
	$base_dir = "combined_results";
	$file_dir = "1";
	$list_file = $base_dir."/".$file_dir."/filelist.txt";
	$file_list = array();
	$line_num = 0;
	$file_num = 0;
	$output_filepath = "combined_results/combined/combined_".$file_dir.".csv";
	$core_articles_path = "core_collection_articles.csv";
	$core_articles = array();
	$output_lines = array();
	$run_extraction = FALSE;
	if (isset($_REQUEST['run']) && $_REQUEST['run']=='yes') {
		$run_extraction = TRUE;
	}

	echo "<br><center><h4><a href='combine_results.php' style='text-decoration:none'>Combine Results</a></h4></center><br>";
	echo "<center><h3>Articles processed: <textarea id='articles_processed'>0</textarea><br>Files processed: <textarea id='files_processed'>0</textarea></h3></center>";

	if ($run_extraction) {
	if (($fh = fopen($list_file, "r")) !== FALSE) 
	{
	  while (! feof($fh)) 
	  {	
	  	$line = fgets($fh);
	  	array_push($file_list, trim($line));
	  }
	}
	fclose($fh); // Close the file

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

		if (($fh = fopen($file_name, "r")) !== FALSE) 
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
					if (sizeof($title_matches) > 0) {
						$core_found[$i] = 1;
	  					array_push($output_lines, "\"".$title."\",".$year);
					}
				}
	  		}

	  		if ($line_num % 2000 == 0) {
	  			echo "<script>document.getElementById('articles_processed').value = '$line_num';</script>";
	  			ob_flush(); // realtime update
        		flush(); // realtime update
	  		}
		  	$line_num++;
		  }
		}

		$results_array = array($output_lines, $core_found, $line_num);
		return $results_array;
	}

	for ($i = 0; $i < sizeof($file_list); $i++) {
		$file_num++;
		$results_array = extract_articles($file_list[$i], $output_lines, $core_articles, $core_found, $line_num);
		$output_lines = $results_array[0];
		$core_found = $results_array[1];
		$line_num = $results_array[2];
		echo "<script>document.getElementById('files_processed').value = '$file_num';</script>";
	  	ob_flush();
        flush();
	}

  	// Output dataset
	$output_file = fopen($output_filepath, 'w') or die("Can't open file.");
	fwrite($output_file, "title,year\n");
	foreach ($output_lines as $line) {
		fwrite($output_file, $line);
		fwrite($output_file, "\n");
	}
	fclose($output_file);	

	$core_sum = 0;
	for ($i = 0; $i < sizeof($core_found); $i++) {
		if ($core_found[$i]==1) {
			$core_sum++;
		}
	}
	echo "<br><center><h3>Titles matched: ".$core_sum.".<br>Articles processed: ".$line_num.".<br>Results file creation completed.</h3></center>";
	}

	echo "<br><center><h4><a href='?run=yes' style='text-decoration:none'>Run extraction</a></h4></center><br>";
?>