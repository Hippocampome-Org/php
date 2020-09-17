<?php
	function generate_file_list($num_gs_files, $num_pm_files, $gs_files, $pm_files, $progress_counter) {
		/*
			Progress counter is a number that represents how far in the current parameters the 
			combination generator has processed.
		*/
		$file_list = array();
		$gs_size = sizeof($gs_files);
		$pm_size = sizeof($pm_files);
		$file_numbers = "";

		if ($num_gs_files==4 && $num_pm_files==1) {
			$f1_num1 = $progress_counter % $gs_size;
			$f2_num1 = floor($progress_counter / $gs_size) % $gs_size;
			$f3_num1 = floor($progress_counter / pow($gs_size,2)) % $gs_size;
			$f4_num1 = floor($progress_counter / pow($gs_size,3)) % $gs_size;
			$f5_num1 = floor($progress_counter / pow($gs_size,4)) % $pm_size;
			$f1_num2 = $gs_files[$f1_num1];
			$f2_num2 = $gs_files[$f2_num1];
			$f3_num2 = $gs_files[$f3_num1];
			$f4_num2 = $gs_files[$f4_num1];
			$f5_num2 = $pm_files[$f5_num1];
			// try to avoid dups
			while ($f1_num2 == $f2_num2 || $f1_num2 == $f3_num2 || $f1_num2 == $f4_num2) {
				$f1_num2 = ($f1_num2 + 1) % $gs_size;
			}
			while ($f2_num2 == $f1_num2 || $f2_num2 == $f3_num2 || $f2_num2 == $f4_num2) {
				$f2_num2 = ($f2_num2 + 1) % $gs_size;
			}
			while ($f3_num2 == $f1_num2 || $f3_num2 == $f2_num2 || $f3_num2 == $f4_num2) {
				$f3_num2 = ($f3_num2 + 1) % $gs_size;
			}
			while ($f4_num2 == $f1_num2 || $f4_num2 == $f2_num2 || $f4_num2 == $f3_num2) {
				$f4_num2 = ($f4_num2 + 1) % $gs_size;
			}
			$f1="scholar,../extract_citations/gs_results/csv_results/query_results_gs".$f1_num2.".csv\n";
			$f2="scholar,../extract_citations/gs_results/csv_results/query_results_gs".$f2_num2.".csv\n";
			$f3="scholar,../extract_citations/gs_results/csv_results/query_results_gs".$f3_num2.".csv\n";
			$f4="scholar,../extract_citations/gs_results/csv_results/query_results_gs".$f4_num2.".csv\n";
			$f5="pubmed,../extract_citations/pubmed_results/29/query_results_pm".$f5_num2.".csv";
			$file_numbers = "gs".$f1_num2.",gs".$f2_num2.",gs".$f3_num2.",gs".$f4_num2.",pm".$f5_num2;
		}

		array_push($file_list, trim($f1));
		array_push($file_list, trim($f2));
		array_push($file_list, trim($f3));
		array_push($file_list, trim($f4));
		array_push($file_list, trim($f5));

		//$progress_counter++;

		$results = array($file_list, $file_numbers);
		return $results;
	}
?>