<?php
  //echo "<br>update processed<br><br>";

  // existing article for modificiation detected
  $sql = "UPDATE `natemsut_hctm`.`articles` SET `url` = \"".$_POST['url']."\", `year` = \"".$_POST['year']."\", `title`= \"".$_POST['title']."\", `theory` = \"".$_POST['theory']."\", `modeling_methods` = \"".$_POST['modeling_methods']."\", `journal` = \"".$_POST['journal']."\", `citation` = \"".$_POST['citation']."\", `abstract` = \"".$_POST['abstract']."\", `curation_notes` = \"".$_POST['curation_notes']."\", `official_id` = \"".$_POST['art_off_id']."\", `authors` = \"".$_POST['authors']."\", `inclusion_qualification` = \"".$_POST['inclusion_qualification']."\" WHERE (`id` = ".$art_num.");";
  $result = $conn->query($sql);
  
  // submit research properties
  if ($_POST['subjects']!='') {
    $subjects = $_POST['subjects'];
    process_deletions($conn,$art_num,'article_has_subject','subject_id',$sel_sbj,$subjects);
    process_additions($conn,$art_num,'article_has_subject','subject_id',$sel_sbj,$subjects);  
  }
  if ($_POST['details']!='') {
    $det_lvl=$_POST['details'];
    process_deletions($conn,$art_num,'article_has_detail','detail_id',$sel_det,$det_lvl);
    process_additions($conn,$art_num,'article_has_detail','detail_id',$sel_det,$det_lvl); 
  }
  if ($_POST['implmnts']!='') {
    $impl_lvl=$_POST['implmnts'];
    process_deletions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);
    process_additions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);       
  }
  if ($_POST['network_scales']!='') {
    $network_scale_update=$_POST['network_scales'];
    process_deletions($conn,$art_num,'article_has_scale','scale_id',$sel_scl,$network_scale_update);
    process_additions($conn,$art_num,'article_has_scale','scale_id',$sel_scl,$network_scale_update);       
  }  
  if ($_POST['regions']!='') {
    $regions_list = $_POST['regions'];  
    process_deletions($conn,$art_num,'article_has_region','region_id',$sel_rgn,$regions_list);
    process_additions($conn,$art_num,'article_has_region','region_id',$sel_rgn,$regions_list);       
  }  
  if ($_POST['theories']!='') {
    $theories = $_POST['theories'];  
    process_deletions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);
    process_additions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);       
  }
  if ($_POST['keywords']!='') {
    $keywords = $_POST['keywords'];   
    process_deletions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);
    process_additions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);        
  }

  function sub_evidence($conn, $loc_evid, $desc_evid, $col, $art_num) {
    // submit evidence entries
    if ($loc_evid!='' || $desc_evid!='') {
      // check for entry      
      $sql = "SELECT id FROM `natemsut_hctm`.`".$col."` WHERE (`article_id` = ".$art_num.");";   
      $result = $conn->query($sql);   
      $row = $result->fetch_assoc();
      $evid_id=$row["id"]; 
      // submit values 
      if ($evid_id!='') {
        $sql = "UPDATE `natemsut_hctm`.`".$col."` SET `evidence_position` = \"".$loc_evid."\", `evidence_description` = \"".$desc_evid."\" WHERE (`id` = ".$evid_id.");";
        $result = $conn->query($sql);
      }
      else {
        $sql = "INSERT INTO `natemsut_hctm`.`".$col."` (`article_id`, `evidence_position`, `evidence_description`) VALUES ('".$art_num."', '".$loc_evid."', '".$desc_evid."');";
        $result = $conn->query($sql); 
      }
    } 
  }

  // submit evidence entries
  $loc_evid_list = array($_POST['sub_loc_evid'],$_POST['det_loc_evid'],$_POST['scl_loc_evid'],$_POST['impl_loc_evid'],$_POST['reg_loc_evid'],$_POST['thy_loc_evid'],$_POST['kwd_loc_evid']);
  $desc_evid_list = array($_POST['sub_desc_evid'],$_POST['det_desc_evid'],$_POST['scl_desc_evid'],$_POST['impl_desc_evid'],$_POST['reg_desc_evid'],$_POST['thy_desc_evid'],$_POST['kwd_desc_evid']);
  $col_evid_list = array('evidence_of_subjects','evidence_of_details','evidence_of_scales','evidence_of_implmnts','evidence_of_regions','evidence_of_theories','evidence_of_keywords');
  for ($ei=0;$ei<count($loc_evid_list);$ei++) {
    sub_evidence($conn, $loc_evid_list[$ei], $desc_evid_list[$ei], $col_evid_list[$ei], $art_num);  
  }
?>