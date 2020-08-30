<html>
<head>
	<title>Extract citations</title>
</head>
<body>
<?php
$base_dir = "gs_results/1/";
$filename = $base_dir."page1.txt";
$max_lines = 200;
$cite_found = false;
$cite_found_counter = 0;
$title_lines = [];
$free_pub_found = false;
$sort_date_found = false;
$articles_found = 0;
$year_line_num = 0;
// reported vars
$citations = 0;
$year = 0;
$citations_per_year = 0;
$title = '';
$title_final = '';
$authors = '';
$journal = '';
$url = '';

if (($fh = fopen($filename, "r")) !== FALSE) 
{
	for($i = 0; $i<$max_lines; $i++) {
		if (!feof($fh)) {
			$line = fgets($fh);

			preg_match('/Cited by (\d+)/', $line, $cited_by_results);
			if ($cited_by_results[1] != '') {
				//echo "Citations: ".$cited_by_results[1]."<br>";
				$cite_found_counter = 0;
				$title_results = [];
				$title_lines = [];
				$year_results = [];
				$cite_found = true;
				$free_pub_found = false;		
				$citations = $cited_by_results[1];
				$cited_by_results = [];
				$citations_per_year = floatval($citations)/floatval($year);
				// output article
				echo $citations.",".$year.",".number_format($citations_per_year,2).",".trim($title_final).",".$authors.",".$journal.",".$url."<br>";
				// reset
				$citations = 0;
				$year = 0;
				$citations_per_year = 0;
				$title = '';		
				$title_final = '';
				$authors = '';
				$journal = '';
				$url = '';
			}
			preg_match('/Sort by date/', $line, $sort_date_results);
			if (sizeof($sort_date_results) > 0) {
				// use "sort by date" to trigger title collection
				// through $cite_found
				$cite_found = true;
			}

			preg_match('/\[\w+\] (.*)/', $line, $title_results);
			if ($title_results[1] != '') {
				array_push($title_lines, $title_results[1]);
			}
			if ($cite_found_counter == 1 && sizeof($title_lines) == 0) {
				$title = $line;
				$year_line_num = 2;
			}
			if ($cite_found_counter == 2) {
				if (sizeof($title_lines) > 1) {
					$title = $title_lines[1];
					$year_line_num = 3;
				}
				else if (sizeof($title_lines) > 0) {
					$title = $line;
					$year_line_num = 3;
				}
			}
			if ($free_pub_found == true) {
				$title = preg_replace('/(\[\w+\] )(.*)/', '$2', $line);
			}			
			preg_match('/Free from Publisher/', $line, $free_pub_results);
			if (sizeof($free_pub_results) > 0) {
				$free_pub_found = true;
				$year_line_num++;
			}
			if ($cite_found_counter == 3) {
				$articles_found++;
				if ($title != "Previous\n" && $articles_found < 11) {
					//echo $title."<br>";
					$title_final = $title;
				}
			}
			if ($year_line_num != 0) {
				if ($cite_found_counter==$year_line_num) {
					preg_match('/.* ([12][09]\d+) .*/', $line, $year_results);
					if ($year_results[1] != '') {
						//echo "Year: ".$year_results[1]."<br>";
						$year = $year_results[1];
					}
				}
			}

			if ($cite_found == true) {
				$cite_found_counter++;
			}
		}
  	}
}
fclose($fh);
?>
</body>
</html>