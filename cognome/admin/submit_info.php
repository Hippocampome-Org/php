<?php
  //echo "<br>new submission processed<br><br>";

  // submit article details
  $sql = "INSERT INTO `natemsut_hctm`.`articles` (`url`, `year`, `title`, `theory`, `modeling_methods`, `journal`, `citation`, `abstract`, `curation_notes`, `authors`, `official_id`, `inclusion_qualification`) VALUES (\"".$_POST['url']."\", \"".$_POST['year']."\", \"".$_POST['title']."\", \"".$_POST['theory']."\", \"".$_POST['modeling_methods']."\", \"".$_POST['journal']."\", \"".$_POST['citation']."\", \"".$_POST['abstract']."\", \"".$_POST['curation_notes']."\", \"".$_POST['authors']."\", \"".$_POST['art_off_id']."\", \"".$_POST['inclusion_qualification']."\");";
  $result = $conn->query($sql);

  // submit research properties
  if ($_POST['subjects']!='') {
    $subjects = $_POST['subjects'];
    for ($i=0; $i<count($subjects); $i++)
    {
      $sql = "INSERT INTO `natemsut_hctm`.`article_has_subject` (`subject_id`, `article_id`) VALUES ('".$subjects[$i]."', '".$_POST['new_art_numb']."');";
      $result = $conn->query($sql);
    }    
  }
  if ($_POST['details']!='') {
    $details = $_POST['details'];
    $sql = "INSERT INTO `natemsut_hctm`.`article_has_detail` (`detail_id`, `article_id`) VALUES ('".$details[0]."', '".$_POST['new_art_numb']."');";
    $result = $conn->query($sql);
  }
  if ($_POST['implmnts']!='') {
    $implmnts = $_POST['implmnts'];
    $sql = "INSERT INTO `natemsut_hctm`.`article_has_implmnt` (`level_id`, `article_id`) VALUES ('".$implmnts[0]."', '".$_POST['new_art_numb']."');";
    $result = $conn->query($sql);
  }
  if ($_POST['network_scales']!='') {
    $network_scales = $_POST['network_scales'];
    $sql = "INSERT INTO `natemsut_hctm`.`article_has_scale` (`scale_id`, `article_id`) VALUES ('".$network_scales[0]."', '".$_POST['new_art_numb']."');";
    $result = $conn->query($sql);
  }  
  if ($_POST['regions']!='') {
    $regions = $_POST['regions'];
    for ($i=0; $i<count($regions); $i++)
    {
      $sql = "INSERT INTO `natemsut_hctm`.`article_has_region` (`region_id`, `article_id`) VALUES ('".$regions[$i]."', '".$_POST['new_art_numb']."');";
      $result = $conn->query($sql);
    } 
  }
  if ($_POST['theories']!='') {
    $theories = $_POST['theories'];
    for ($i=0; $i<count($theories); $i++)
    {
      $sql = "INSERT INTO `natemsut_hctm`.`article_has_theory` (`theory_id`, `article_id`) VALUES ('".$theories[$i]."', '".$_POST['new_art_numb']."');";
      $result = $conn->query($sql);
    }    
  }
  if ($_POST['keywords']!='') {
    $keywords = $_POST['keywords'];
    for ($i=0; $i<count($keywords); $i++)
    {
      $sql = "INSERT INTO `natemsut_hctm`.`article_has_keyword` (`keyword_id`, `article_id`) VALUES ('".$keywords[$i]."', '".$_POST['new_art_numb']."');";
      $result = $conn->query($sql);
    }    
  } 

  // submit evidence entries
  //if ($_POST['sub_loc_evid']!='' || $_POST['sub_desc_evid']!='') {
    $sub_loc_evid = $_POST['sub_loc_evid'];
    $sub_desc_evid = $_POST['sub_desc_evid'];
    $sql = "INSERT INTO `natemsut_hctm`.`evidence_of_subjects` (`article_id`, `evidence_position`, `evidence_description`) VALUES ('".$art_num."', '".$sub_loc_evid."', '".$sub_desc_evid."');";
    $result = $conn->query($sql);    
  //}    
?>