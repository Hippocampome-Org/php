<html>
<!-- 
	References: https://gist.github.com/hlashbrooke/ee208fb8be43d23da5a9
-->
<head>
	<title>Browse literature results</title>
	<style>
		.button_link {
			height:19px;
			width:28px;
			border:1px solid black;
			padding:4px;
			font-size:13px;
			font-family:arial;
			text-decoration: none;
			position:relative;
			top:-3px;
		}
		.button_link a { 
			text-decoration: none; 
		}
		textarea.custom_page {
		    white-space: normal;
		    text-align: center;
		    -moz-text-align-last: center; /* Firefox 12+ */
		    text-align-last: center;
		    height:24px;
		    width:38px;
		    position:relative;
		    top:5px;
		    resize:none;
		    font-size:12pt;
		}
	</style>
	<link rel='stylesheet' type='text/css' href='medium_dark_colors.css'> 
	<!--link rel='stylesheet' type='text/css' href='light_white_bg_colors.css'--> 
</head>
<body>
<!--table border=1-->
<?php
$base_dir = "query_results/1/";
$filename = $base_dir."PoPCites.csv";
$query_file = $base_dir."query.csv";

echo '<br><center><font style="font-size:22px">'.file_get_contents($query_file).'</font></center><br>';

	$start = 1;
	$end = 10;
	if (isset($_REQUEST['start'])) {
		if ($_REQUEST['start'] >= 0) {
			$start = $_REQUEST['start'];
		}
	}
	if (isset($_REQUEST['end'])) {
		if ($_REQUEST['end'] >= 0) {
			$end = $_REQUEST['end'];
		}
	}
	if (isset($_REQUEST['custom_page'])) {
		$custom_page = $_REQUEST['custom_page'];
		$start = ($custom_page*10)-9;
		$end = $custom_page*10;
	}
	else {
		$custom_page = round(($end/980)*100);
	}
	$prev_start = $start - 10;
  	$prev_end = $end - 10;
	$next_start = $start + 10;
  	$next_end = $end + 10;  	
  	echo "<center>Page ".round(($end/980)*100)." of 98. Showing articles with ids $start to $end.</center>";
	echo "<form action='lit_rev.php'><center><a href='?start=$prev_start&end=$prev_end' style='text-decoration:none;'><span class='button_link'>Prev</span></a>&nbsp;Page <textarea name='custom_page' id='custom_page' class='custom_page'>$custom_page</textarea> <input type='submit' value='Go' style='height:25px;width:36px;position:relative;top:-3px;' />&nbsp;<a href='?start=$next_start&end=$next_end' style='text-decoration:none;'><span class='button_link'>Next</span></a></center></form>";

function char_replace($find, $replace, $str)
{
	$newstr = "";
	$strlen = strlen($str);
	for( $i = 0; $i <= $strlen; $i++ ) {
    	$char = substr($str, $i, 1);
    	if ($char == $find) {
    		$char == $replace;
    	}
    	$newstr = $newstr.$char;
	}

	return $newstr;
}

function msleep($time)
{
    usleep($time * 1000000);
}

function article_info($title, $pop_authors)
{
	// insert html code
	//$title_adj="%22".$title."%22";
	$title_adj=str_replace(' ', '%20', $title);

	$pm_api_url = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&retmode=json&term=$title_adj%5Btitle%5D";
	// pop authors //
	foreach ($pop_authors as $author) {
		$author = str_replace(',', '', $author);
		if (strlen($author) > 3) {
			$pm_api_url = $pm_api_url."%20".$author."%20%5Bauthor%5D";
		}
	}
	$html=file_get_contents($pm_api_url);

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
$search_results = "";
if (($h = fopen($filename, "r")) !== FALSE) 
{
  $search_results = $search_results."<table border=1>";
  // Convert each line into the local $data variable
  while (($data = fgetcsv($h, 10000, ",")) !== FALSE) 
  {		
  	if ($i >= $start && $i <= $end) {
  		$title = $data[2];
  		$url = $data[6];

  		$search_results = $search_results."<tr><td>PoP<br>Citations</td><td>PoP<br>Citations by Year</td><td>PoP<br>Authors</td><td>PoP<br>Title</td><td>PoP<br>Year</td><td>PoP<br>Journal</td></tr>";
	    // Read the data from a single line
	    $search_results = $search_results."<tr><td>".$data[0]."</td><td>".$data[19]."</td><td>".$data[1]."</td><td>".$title."</td><td>".$data[3]."</td><td>".$data[4]."</td></tr>";

		$search_results = $search_results."<tr><td>PM<br>ID</td><td>PM<br>Link</td><td>PM<br>Authors</td><td>PM<br>Abstract and Title</td><td>PM<br>Year</td><td>PM<br>Journal</td></tr>";

		$pop_authors = str_replace(',', '', $pop_authors);
		$pop_authors = explode(" ", $data[1]);
	    $article_details = article_info($title, $pop_authors);
	    $pm_id = $article_details[0];
	    if ($pm_id=='') {
	    	$pm_id = 'N/A';
	    }
	    $pm_abstract = $article_details[1];
	    if ($pm_abstract=='') {
	    	$pm_abstract = $data[23]."<br>";
	    	if (strlen(file_get_contents($url))>100) {
	    	$pm_abstract = $pm_abstract."<object data=\"article_page.php?article_url=".$url."\" style=\"width:100%;height:500px\"><embed src=\"article_page.php?article_url=".$url."\" style=\"width:100%;height:500px\"> </embed>Error: Embedded data could not be displayed.</object>";

			}
	    }	    
	    $pm_title = $article_details[2];
	    if ($pm_title=='') {
	    	//$pm_title = 'N/A';
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

	    if (substr($url, 0, 24)=='https://books.google.com') {
	    	// format query for book search
	    	$query_html = file_get_contents($query_file);
	    	$query_html2 = str_replace('Query: ', '', $query_html);
	    	$query_html3 = str_replace(" ", "+", $query_html2);
	    	//$query_html4 = str_replace("AND", "", $query_html3);
	    	//$query_html4 = str_replace("AND", "", $query_html3);
	    	$search_phrase = '&q='.$query_html3;//.'&f=false';
	    	$url = $url.$search_phrase;
	    }
	    $search_results = $search_results."<tr><td>$pm_id</td><td><a href='".$url."' target='_blank'>pop article link</a><br><br><a href='$pm_api_url' target='_blank'>pm api query link</a><br><br><a href='$pm_url' target='_blank'>pm query link</a></td><td>$pm_authors</td><td>";
	    if ($pm_title != '') {
	    	$search_results = $search_results."$pm_title<br><br>";
			$search_results = $search_results."<font class='abstract_text'>";
		}
		else {
			$search_results = $search_results."<font class='abstract_text2'>";	
		}
	    $search_results = $search_results."$pm_abstract</font></td><td>$pm_year</td><td>$pm_journal</td></tr>";

	    msleep(.1);
	}
	$i++;
  }
  $search_results = $search_results."</table>";
  echo $search_results;

  // Close the file
  fclose($h);
	$prev_start = $start - 10;
  	$prev_end = $end - 10;
	$next_start = $start + 10;
  	$next_end = $end + 10;  	
  	echo "<center>Page ".round(($end/980)*100)." of 98. Showing articles with ids $start to $end.</center>";
	echo "<form action='lit_rev.php'><center><a href='?start=$prev_start&end=$prev_end' style='text-decoration:none;'><span class='button_link'>Prev</span></a>&nbsp;Page <textarea name='custom_page' id='custom_page' class='custom_page'>$custom_page</textarea> <input type='submit' value='Go' style='height:25px;width:36px;position:relative;top:-3px;' />&nbsp;<a href='?start=$next_start&end=$next_end' style='text-decoration:none;'><span class='button_link'>Next</span></a></center></form>";
}
?>
</body>
</html>