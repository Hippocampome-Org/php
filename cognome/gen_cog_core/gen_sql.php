<?php 
	include ("../permission_check.php");

	$cog_core_db = "cognome_core";
	$art_file = "remove_articles.sql";
	$aut_file = "remove_authors.sql";
	$det_file = "remove_details.sql";
	$impl_file = "remove_implementations.sql";
	$kwd_file = "remove_keywords.sql";
	$nrn_file = "remove_neurons.sql";
	$reg_file = "remove_regions.sql";
	$scl_file = "remove_scales.sql";
	$sub_file = "remove_subjects.sql";
	$subevi_file = "remove_subjects_evi.sql";
	$thr_file = "remove_theories.sql";
	$all_files = array($art_file, $aut_file, $det_file, $impl_file, $kwd_file, $nrn_file, $reg_file, $scl_file, $sub_file, $subevi_file, $thr_file);
	$ids_for_removal = array();
	$sql = file_get_contents('find_ids.sql');
	$result = $cog_conn->query($sql);
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        array_push($ids_for_removal,$row['id']);
        //echo "\n".$row['id'];
      }
    } 

	/* articles */
	// clear files
	for ($i = 0; $i < count($all_files); $i++) {
		$file = fopen($all_files[$i], 'w') or die("Can't open file.");
		fclose($file);
	}
	// open in append mode
	$out_art = fopen($art_file, 'a') or die("Can't open file.");
	$out_aut = fopen($aut_file, 'a') or die("Can't open file.");
	$out_det = fopen($det_file, 'a') or die("Can't open file.");
	$out_impl = fopen($impl_file, 'a') or die("Can't open file.");
	$out_kwd = fopen($kwd_file, 'a') or die("Can't open file.");
	$out_nrn = fopen($nrn_file, 'a') or die("Can't open file.");
	$out_reg = fopen($reg_file, 'a') or die("Can't open file.");
	$out_scl = fopen($scl_file, 'a') or die("Can't open file.");
	$out_sub = fopen($sub_file, 'a') or die("Can't open file.");
	$out_subevi = fopen($subevi_file, 'a') or die("Can't open file.");
	$out_thr = fopen($thr_file, 'a') or die("Can't open file.");

	for ($i = 0; $i < count($ids_for_removal); $i++) {
		$id = $ids_for_removal[$i];

		$line = "DELETE FROM `$cog_core_db`.`articles` WHERE (`id` = '$id');\n";
		fwrite($out_art, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_author` WHERE (`article_id` = '$id');\n";
		fwrite($out_aut, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_detail` WHERE (`article_id` = '$id');\n";
		fwrite($out_det, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_implmnt` WHERE (`article_id` = '$id');\n";
		fwrite($out_impl, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_keyword` WHERE (`article_id` = '$id');\n";
		fwrite($out_kwd, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_neuron` WHERE (`article_id` = '$id');\n";
		fwrite($out_nrn, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_region` WHERE (`article_id` = '$id');\n";
		fwrite($out_reg, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_scale` WHERE (`article_id` = '$id');\n";
		fwrite($out_scl, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_subject` WHERE (`article_id` = '$id');\n";
		fwrite($out_sub, $line);
		$line = "DELETE FROM `$cog_core_db`.`evidence_of_subjects` WHERE (`article_id` = '$id');\n";
		fwrite($out_subevi, $line);
		$line = "DELETE FROM `$cog_core_db`.`article_has_theory` WHERE (`article_id` = '$id');\n";
		fwrite($out_thr, $line);
	}

	fclose($out_art);	
	fclose($out_aut);	
	fclose($out_det);	
	fclose($out_impl);	
	fclose($out_kwd);	
	fclose($out_nrn);	
	fclose($out_reg);	
	fclose($out_scl);	
	fclose($out_sub);	
	fclose($out_subevi);	
	fclose($out_thr);	

	echo "\nSQL files written.\n";
?>