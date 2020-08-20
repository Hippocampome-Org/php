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
// Open the file for reading
$i = 0;
$start = 1;
$end = 10;
$new_result = "";
if (($h = fopen($filename, "r")) !== FALSE) 
{
  $new_result = $new_result."<table border=1>";
  // Convert each line into the local $data variable
  while (($data = fgetcsv($h, 10000, ",")) !== FALSE) 
  {		
  	if ($i == 0 || ($i >= $start && $i <= $end)) {
    // Read the data from a single line
    $new_result = $new_result."<tr><td>".$data[0]."</td><td>".$data[19]."</td><td>".$data[1]."</td><td>".$data[2]."</td><td>".$data[3]."</td><td>".$data[5]."</td></tr>";
    
    //msleep(.1);
	}
	$i++;
  }
  $new_result = $new_result."</table>";
  echo $new_result;
  //echo "<script>document.getElementById('results').innerHTML = '$new_result';</script>";

  // Close the file
  fclose($h);

  echo "<br><center><a href='?start=21&end=30'>prev</a>&nbsp;&nbsp;<a href='start=31&end=40'>next</a></center>";
  //$html = file_get_contents("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&term=\"Three cases of enduring memory impairment after bilateral damage limited to the hippocampal formation\"");
  //$html = file_get_contents("http://www.example.com/");
  //$html = file_get_contents("https://www.graddiv.ucsb.edu/");
  //$html = file_get_contents("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/");
  //$html=file_get_contents('https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=8756452&retmode=json&rettype=abstract');
  //$html = file_get_contents("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&term=\"Three cases of enduring memory impairment after bilateral damage limited to the hippocampal formation\"retmode=json&rettype=abstract");
  //$html=file_get_contents('https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&field=title&term=\"Three cases of enduring memory impairment after bilateral damage limited to the hippocampal formation\"&WebEnv=webenv&retmode=json&rettype=abstract');
  $html=file_get_contents("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&retmode=json&term=%22Three%20cases%20of%20enduring%20memory%20impairment%20after%20bilateral%20damage%20limited%20to%20the%20hippocampal%20formation%22");
  //echo $html;
  /*$html_lines = $html;//explode("<br>", $html);
  $pmid_found = array();
  foreach ($html_lines as $line) {
	//preg_match('/<Id>(.*)<\/Id>/', $lines, $pmid_found);
	preg_match('idlist\"\:\[\"(\d+)\"\]', $lines, $pmid_found);
	echo "PMID: ".$pmid_found[1];
	//echo $line;
  }*/
	//preg_match('idlist\"\:\[\"(\d+)\"\]', $html, $pmid_found);
  /*preg_match('\"(\d+)\"', $html, $pmid_found);
	echo "PMID: ".$pmid_found;
	echo $html;*/
	$pattern='~.*idlist\"\:\[\"(\d+)\"\].*~';
  $result = preg_match($pattern, $html, $match);
  $id = $match[1];
  echo $id;
  	/*
  	$c = curl_init("https://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&field=title&term=\"Three cases of enduring memory impairment after bilateral damage limited to the hippocampal formation\"");
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt(... other options you want...)

	$html = curl_exec($c);
	echo $html;

	if (curl_error($c))
	    die(curl_error($c));

	// Get the status code
	$status = curl_getinfo($c, CURLINFO_HTTP_CODE);

	curl_close($c);
	*/
	//$ch = curl_init("http://www.example.com/");
	//$fp = fopen("example_homepage.txt", "w");

	//curl_setopt($ch, CURLOPT_FILE, $fp);
	//curl_setopt($ch, CURLOPT_HEADER, 0);

	/*$test = curl_exec($ch);
	//echo $test;
	if(curl_error($ch)) {
	    fwrite($fp, curl_error($ch));
	}
	curl_close($ch);*/
	//fclose($fp);
}
?>
<!--/table-->
</body>
</html>