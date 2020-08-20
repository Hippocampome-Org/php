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
	$pm_url = "https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&retmode=json&term=$title_adj";
	$html=file_get_contents($pm_url);
	//$html=file_get_contents("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&retmode=json&term=$title_adj");
	$pattern='~.*idlist\"\:\[\"(\d+)\"\].*~';
	$result = preg_match($pattern, $html, $match);
	$id = $match[1];
	//echo $id;
	$pubmed_html=file_get_contents('https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id='.$id.'retmode=json&rettype=abstract');
	$pattern='~.*AbstractText>(.+)\<.*~';
	$result = preg_match($pattern, $pubmed_html, $match);
	$abstract = $match[1];
	//echo $abstract;
	return array($id, $abstract, $title_adj, $pm_url);
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
  		$search_results = $search_results."<tr><td>Citations</td><td>Citations by Year</td><td>Authors</td><td>Title</td><td>Year</td><td>Journal</td></tr>";
  	} 
  	else if ($i >= $start && $i <= $end) {
  		$title = $data[2];
	    // Read the data from a single line
	    $search_results = $search_results."<tr><td>".$data[0]."</td><td>".$data[19]."</td><td>".$data[1]."</td><td>".$title."</td><td>".$data[3]."</td><td>".$data[4]."</td></tr>";

		$search_results = $search_results."<tr><td></td><td>Link</td><td>Authors</td><td>Abstract and Title</td><td>Year</td><td>Journal</td></tr>";

	    $article_details = article_info($title);
	    $pm_id = $article_details[0];
	    $pm_abstract = $article_details[1];
	    $pm_title = $article_details[2];
	    $pm_url = $article_details[3];
	    $search_results = $search_results."<tr><td></td><td><a href='".$data[6]."'>link</a><br><a href='$pm_url'>pm_link</a></td><td>".$data[1]."</td><td>$pm_title<br>$pm_abstract</td><td>".$data[3]."</td><td>".$data[5]."</td></tr>";

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