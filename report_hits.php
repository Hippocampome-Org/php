<?php
	PHPCount::InitDB($_SESSION['servername'], $_SESSION['username'], $_SESSION['password'], $_SESSION['hitstbl'], $_SESSION['dupstbl']);
	PHPCount::AddHit($webpage_id_number);
	echo "Hits: ".PHPCount::GetTotalHits(false)."<br>";
	echo "Unique Visits: ".PHPCount::GetTotalHits(true);
?>