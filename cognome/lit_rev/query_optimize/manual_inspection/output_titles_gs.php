<?php

$input_filename=$argv[1];
preg_match('/\/([a-zA-Z0-9_]+)\.csv/', $input_filename, $input_matches);
$output_filename="temp_output/".$input_matches[1]."_mod.csv";
$lines_all=array();

// read input
if (($fh = fopen($input_filename, "r")) !== FALSE) 
{
  $line = fgets($fh); // skip column names
  while (($line_array = fgetcsv($fh, 10000, ",")) !== FALSE){	
  	array_push($lines_all, "\"".trim($line_array[2])."\",\"".trim($line_array[3])."\"");
  }
}
fclose($fh);

// write output
$output_file = fopen($output_filename, 'w') or die("Can't open file.");
foreach ($lines_all as $line) {
	fwrite($output_file, $line."\n");
}
fclose($output_file);

?>