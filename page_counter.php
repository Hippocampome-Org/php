<?php
	/*
		This is a webpage traffic hits counter. 
		
		Install instructions:
		For any site two database tables are needed. One 'hits' table and one 'nodups'
		table. All hit tracking for any page on the site are stored in the tables. 
		Currently there is a database named 'counters' that stores the tables for all
		hippocampome sites' hits. In this file, both tables specific to this site are 
		specified. 

		On each page, there needs to be two lines. 
		<?php include ("page_counter.php"); ?>
		<?php $webpage_id_number = 1; include('report_hits.php'); ?>
		
		** The page_counter.php line needs to be directly below the 
		include ("access_db.php") line to receive database access info correctly. **
		$webpage_id_number is the id number for unique tracking of each page on a
		site. The report_hits.php line goes anywhere on the page the hits are wanted 
		to be reported. The way they are displayed can be customized there if wanted.

		Files needed on each site:
		init_db_vars.php, page_counter.php, phpcount.php, report_hits.php

		Reference: https://defuse.ca/php-hit-counter.htm
	*/
	include ("init_db_vars.php");
	$hits_table = "campome_hits";
	$dups_table = "campome_nodupes";
	InitDBVars($servername, $username, $password, $hits_table, $dups_table);
	require_once("phpcount.php");
?>