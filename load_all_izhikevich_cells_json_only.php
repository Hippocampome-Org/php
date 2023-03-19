<?php
//ini_set('display_errors', 1); error_reporting(~0);
$izhikevich_model_json = "cache/session_matrix_izhikevichMockUp_NOHTML.json";
$get_matrix = "getizhikevich2.php";
$matrix_type = "Izhikevich_model_json_only";

if (file_exists($izhikevich_model_json))
{
  
	error_log("If");
  session_start();
  include ("access_db.php");
 	include ("permission_check.php");
  $_SESSION[$matrix_type] = file_get_contents($izhikevich_model_json);
}
else
{
  
  error_log("Else");
  include $get_matrix;
  $_SESSION[$matrix_type] = json_encode($responce);
  $fp = fopen($izhikevich_model_json, 'w');
  fwrite($fp, $_SESSION[$matrix_type]);
  fclose($fp); 
  
}

//$_SESSION['morphology_set'] = 1;
//echo "done";

?>
