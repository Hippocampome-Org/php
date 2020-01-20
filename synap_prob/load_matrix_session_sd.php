<?php

//include 'getMorphology.php';
//$_SESSION['morphology'] = json_encode($responce);

$session_matrix_cache_file = "synap_prob/gen_json/sd_db_results.json";
$matrix_type = "synaptic_distance";

if (file_exists($session_matrix_cache_file))
{
  session_start();
  include ("access_db.php");
 	 include ("permission_check.php");
  $_SESSION[$matrix_type] = file_get_contents($session_matrix_cache_file);
  $jsonStr = $_SESSION[$matrix_type];
}

?>
