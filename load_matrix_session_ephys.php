<?php
//function load_session_matrix(){
	

//	if($_SESSION['perm']!=0)
//	{
	//	include 'getMorphology.php';
	//	$_SESSION['morphology'] = json_encode($responce);
	
	//	include 'getMarkers.php';
	//	$_SESSION['markers'] = json_encode($responce);
		include 'getEphys.php';
		$_SESSION['ephys'] = json_encode($responce);
		echo "done";
//	}
//	echo "failed";
//}
?>