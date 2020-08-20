<html>
<head>
	<title>Browse literature results</title>
</head>
<body>
<div id="results" name="results"></div>
<!--table border=1-->
<?php
$filename = "/extra_files/shared_files/vm_shared_folder/PoPCites.csv";

function msleep($time)
{
    usleep($time * 1000000);
}

function article_info($title)
{
	// insert html code
	$title_adj="%22".$title."%22";
	$title_adj=str_replace(' ', '%20', $title);
	//$title_adj=str_replace('"', '%22', $title);

	//$pm_url = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&retmode=json&term=%22Three%20cases%20of%20enduring%20memory%20impairment%20after%20bilateral%20damage%20limited%20to%20the%20hippocampal%20formation%22";
	$pm_api_url = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&retmode=json&term=$title_adj";
	$html=file_get_contents($pm_api_url);
	//$html=file_get_contents("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&retmode=json&term=$title_adj");

	// id //
	$pattern='~.*idlist\"\:\[\"(\d+)\"\].*~';
	$result = preg_match($pattern, $html, $match);
	$id = $match[1];

	// abstract //
	$pm_url = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id='.$id.'retmode=json&rettype=abstract';
	$pubmed_html=file_get_contents($pm_url);
	$pattern='~.*AbstractText>(.+)\<.*~';
	$result = preg_match($pattern, $pubmed_html, $match);
	$abstract = $match[1];

	// authors //
	$authors='';
    $lastname_pattern='~.*LastName>(.+)\<.*~';
    $firstinitials_pattern='~.*Initials>(.+)\<.*~';
    $lastname_result = preg_match_all($lastname_pattern, $pubmed_html, $match_1,PREG_PATTERN_ORDER);
    $firstinitials_result = preg_match_all($firstinitials_pattern, $pubmed_html, $match_2,PREG_PATTERN_ORDER);
    for( $i = 0; $i<sizeof($match_1[0]); $i++ ) {
      $authors=$authors.$match_1[1][$i].', '.$match_2[1][$i].'., ';
    }

    // title //
	$pattern='~.*ArticleTitle\>(.+)\<.*~';
	$result = preg_match($pattern, $pubmed_html, $match);
	$pm_title = $match[1];
	$pm_title = str_replace('"', '\'', $pm_title);

	// year //
	$pattern='~.*PubDate\W+Year\>(.+)\<.*~';
	$result = preg_match($pattern, $pubmed_html, $match);
	$year = $match[1];

	// journal //
	$pattern='~.*JournalIssue\W+Title>(.+)\<.*~';
	$result = preg_match($pattern, $pubmed_html, $match);
	$journal = $match[1];
	
	return array($id, $abstract, $pm_title, $pm_api_url, $authors, $year, $journal, $pm_url);
}
// Open the file for reading
$i = 0;
$start = 1;
$end = 10;
$search_results = "";
if (($h = fopen($filename, "r")) !== FALSE) 
{
  $search_results = $search_results."<table border=1>";
  // Convert each line into the local $data variable
  while (($data = fgetcsv($h, 10000, ",")) !== FALSE) 
  {		
  	if ($i == 0) {
  		$search_results = $search_results."<tr><td>PoP<br>Citations</td><td>PoP<br>Citations by Year</td><td>PoP<br>Authors</td><td>PoP<br>Title</td><td>PoP<br>Year</td><td>PoP<br>Journal</td></tr>";
  	} 
  	else if ($i >= $start && $i <= $end) {
  		$title = $data[2];
	    // Read the data from a single line
	    $search_results = $search_results."<tr><td>".$data[0]."</td><td>".$data[19]."</td><td>".$data[1]."</td><td>".$title."</td><td>".$data[3]."</td><td>".$data[4]."</td></tr>";

		$search_results = $search_results."<tr><td>PM<br>ID</td><td>PM<br>Link</td><td>PM<br>Authors</td><td>PM<br>Abstract and Title</td><td>PM<br>Year</td><td>PM<br>Journal</td></tr>";

	    $article_details = article_info($title);
	    $pm_id = $article_details[0];
	    if ($pm_id=='') {
	    	$pm_id = 'N/A';
	    }
	    $pm_abstract = $article_details[1];
	    if ($pm_abstract=='') {
	    	$pm_abstract = 'N/A';
	    }	    
	    $pm_title = $article_details[2];
	    if ($pm_title=='') {
	    	$pm_title = 'N/A';
	    }
	    $pm_api_url = $article_details[3];
	    $pm_authors = $article_details[4];
	    if ($pm_authors=='') {
	    	$pm_authors = 'N/A';
	    }
	    $pm_year = $article_details[5];
	    if ($pm_year=='') {
	    	$pm_year = 'N/A';
	    }
	    $pm_journal = $article_details[6];
	    if ($pm_journal=='') {
	    	$pm_journal = 'N/A';
	    }
	    $pm_url = $article_details[7];

	    $search_results = $search_results."<tr><td>$pm_id</td><td><a href='".$data[6]."' target='_blank'>pm article link</a><br><br><a href='$pm_api_url' target='_blank'>pm api query link</a><br><br><a href='$pm_url' target='_blank'>pm query link</a></td><td>$pm_authors</td><td>$pm_title<br><br>$pm_abstract</td><td>$pm_year</td><td>$pm_journal</td></tr>";

	    msleep(.1);
	}
	$i++;
  }
  $search_results = $search_results."</table>";
  echo $search_results;

  // Close the file
  fclose($h);

	echo "<br><center><a href='?start=21&end=30'>prev</a>&nbsp;&nbsp;<a href='start=31&end=40'>next</a></center>";
}
?>
</body>
</html>