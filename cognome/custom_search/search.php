<!--
	Usage - import this file and linclude the line:
	  search_directory($dir, $max_matches, $query);
	
	$dir: directory of literature
	$max_matches: max matches per keyword to return
	$query: keyterms

	Reference: http://www.tizag.com/phpT/fileread.php
-->
<head><title>Search</title></head>
<div style='font-family: arial'>
<?php
$tot_mch = 0;
$total_results = array();
global $tot_mch;
global $total_results;

function report_results($results_text, $total_results, $query, $articles_searched) {
	// report overall results
	$results_text = 'Total Article Matches<br><br>';
	for ($i = 0; $i < sizeof($total_results); $i++) {
		$results_text = $results_text.$total_results[$i]." for keyterm \"".$query[$i]."\"<br>";
	}
	$results_text = $results_text."<br>".$articles_searched." total articles searched";
	echo "<script>update_overall('".$results_text."')</script>";	
}

function search_directory($dir, $articles_to_search, $max_matches, $query) {
	global $tot_mch;
	global $total_results;
	$articles_searched = 0;

	// describe overall results
	$total_results = array_fill(0, sizeof($query), 0);
	echo "<script>
	function update_overall(update_text) {
		document.getElementById('overall_results_summary').innerHTML = update_text;
	}
	</script>";

	echo "<br><div class='wrap-collabsible' id='art_select'><input id='collapsible_ovrl_rslts' class='toggle' type='checkbox' checked><label for='collapsible_ovrl_rslts' class='lbl-toggle'>Overall Results</label><div class='collapsible-content'><div class='content-inner' style='font-size:22px;' id='overall_results_summary'>";
	echo "Overall results<br>";
	echo "<br>Now loading overall results. Please wait until the search is completed for the results to display here.</div></input></div></div>";

	// run directory search
	if ($handle = opendir($dir)) {
	    while ($file = readdir($handle)) {
	    	if ($file != "." && $file != "..") {
	    		if ($articles_to_search == "all" || $articles_searched < $articles_to_search) {
	        		$total_results = search($dir.$file, $file, $max_matches, $query);
	        		$articles_searched++;
	        	}
	    	}

	    	if ($articles_searched < 25 || $articles_searched == 50 || $articles_searched == 100 || $articles_searched == 150 || $articles_searched == 200 || $articles_searched == 250) {
	    		report_results($results_text, $total_results, $query, $articles_searched);
	    	}
	    }
	    closedir($handle);
	}

	report_results($results_text, $total_results, $query, $articles_searched);
}

function search($file, $filename, $max_matches, $query) {
	global $tot_mch;
	global $total_results;

	// set file details
	echo "<br><center><font style='font-size:20px;'>File: <a href='?fileview=".$file."' target='_blank'>".$filename."</a></font></center><br>";
	/*echo "<br><center><font style='font-size:20px;'>File: <a href='/general/cognome_articles/".substr($filename, 0, -4)."''>".substr($filename, 0, -4)."</a></font></center><br>";*/
	$myFile = $file;
	$fh = fopen($myFile, 'r');
	$file_contents = fread($fh, filesize($myFile));
	fclose($fh);

	$file_contents2 = preg_replace('/\n/', '<br>', $file_contents); // remove newlines

	echo "<div class='wrap-collabsible' id='art_select'><input id='collapsible_srch_".$tot_mch."' class='toggle' type='checkbox'><label for='collapsible_srch_".$tot_mch."' class='lbl-toggle'>First lines in the file</label><div class='collapsible-content'><div class='content-inner' style='font-size:18px;'>";
	echo "<div style='background-color:#dedede;padding:20px;'><center><span style='font-size:16px;'>".substr($file_contents2, 0, 400)."</span></center></div><br>";
	echo "</div></input></div></div>";
	$tot_mch++;

	$file_contents = preg_replace('/\n/', ' ', $file_contents); // remove newlines	

	for ($f_i = 0; $f_i < sizeof($query); $f_i++) {
		// set patterns
		$pattern_keyterm = $query[$f_i];
		$pattern = "/(.{1,500}[ -\(]".$pattern_keyterm."[\)s -].{1,500})/i"; // /i is case insensitive
		$num_matches = preg_match_all($pattern, $file_contents, $matches);

		// update totals
		if ($num_matches > 0) {
			$total_results[$f_i]++;
		}

		// Find maximum matches to report
		$match_limit = 0;
		if ($num_matches >= $max_matches) {
			$match_limit = $max_matches;
		}
		else {
			$match_limit = $num_matches;
		}

		if ($num_matches > 0) {
		    echo "<div class='wrap-collabsible' id='art_select'><input id='collapsible_srch_".$tot_mch."' class='toggle' type='checkbox'><label for='collapsible_srch_".$tot_mch."' class='lbl-toggle'>".$num_matches." matches for keyterm: \"".$pattern_keyterm."\"</label><div class='collapsible-content'><div class='content-inner' style='font-size:18px;max-height: 550px;overflow: auto;'>";

			// Report matches
			for ($i = 0; $i < $match_limit; $i++) {
				$replacement = "<font style='color:blue'>".$pattern_keyterm."</font>";
				$match = preg_replace('/[ -]('.$pattern_keyterm.')[s -]/i', ' '.$replacement.' ', $matches[0][$i]);
				echo $match."<br><br>";
				$tot_mch++;
			}

			echo "</div></input></div></div>";	
		}
		else {
			echo "<div style='background-color:#dedede;'><span style='font-size:22px;position:relative;left:33px;top:-4px;font-family:arial;'>0 matches for keyterm: \"".$pattern_keyterm."\"</span></div>";
		}
	}
	echo "<br>";

	return $total_results;
}
?>

</div>