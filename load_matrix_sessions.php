<?php
//function load_session_matrix(){
	

//	if($_SESSION['perm']!=0)
//	{
		
			include 'getMorphology.php';
			$_SESSION['morphology'] = json_encode($responce);
			$_SESSION['morphology_set']=1;
			echo "done";
		
//		include 'getMarkers.php';
//		$_SESSION['markers'] = json_encode($responce);
//		include 'getEphys.php';
//		$_SESSION['ephys'] = json_encode($responce);
			
	
//	}
//	echo "failed";
//}
?>