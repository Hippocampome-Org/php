<?php
  //echo "<br>update processed<br><br>";

  // existing article for modificiation detected
  $sql = "UPDATE `natemsut_hctm`.`articles` SET `url` = \"".$_POST['url']."\", `year` = \"".$_POST['year']."\", `title`= \"".$_POST['title']."\", `theory` = \"".$_POST['theory']."\", `modeling_methods` = \"".$_POST['modeling_methods']."\", `journal` = \"".$_POST['journal']."\", `citation` = \"".$_POST['citation']."\", `abstract` = \"".$_POST['abstract']."\", `curation_notes` = \"".$_POST['curation_notes']."\", `official_id` = \"".$_POST['art_off_id']."\", `authors` = \"".$_POST['authors']."\", `inclusion_qualification` = \"".$_POST['inclusion_qualification']."\" WHERE (`id` = ".$art_num.");";
  $result = $conn->query($sql);

  $sql = "SELECT id FROM neuron_types";
  $result = $conn->query($sql);
  $n_i = 1;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
      $n_i++;
    }
  }
  $neuron_types_count = $n_i;
  
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
  if ($_POST['implementations']!='') {
    $impl_lvl=$_POST['implementations'];
    process_deletions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);
    process_additions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);       
  }
  if ($_POST['network_scales']!='') {
    $network_scale_update=$_POST['network_scales'];
    process_deletions($conn,$art_num,'article_has_scale','scale_id',$sel_scl,$network_scale_update);
    process_additions($conn,$art_num,'article_has_scale','scale_id',$sel_scl,$network_scale_update);       
  }  
  // neuron types
  $neuron_type_update = array();
  for ($i = 1; $i < $neuron_types_count; $i++) {
    if (isset($_POST["neuron_p$i"])) {
      array_push($neuron_type_update, $i);
    }
  }
  if (count($neuron_type_update) > 0) {
    process_deletions($conn,$art_num,'article_has_neuron','neuron_id',$sel_nrn,$neuron_type_update);
    process_additions($conn,$art_num,'article_has_neuron','neuron_id',$sel_nrn,$neuron_type_update);    
  }
  // regions
  if ($_POST['regions']!='') {
    $regions_list = $_POST['regions'];  
    process_deletions($conn,$art_num,'article_has_region','region_id',$sel_rgn,$regions_list);
    process_additions($conn,$art_num,'article_has_region','region_id',$sel_rgn,$regions_list);       
  }  
  if ($_POST['theory_category']!='') {
    $theories = $_POST['theory_category'];  
    process_deletions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);
    process_additions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);       
  }
  if ($_POST['keywords']!='') {
    $keywords = $_POST['keywords'];   
    process_deletions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);
    process_additions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);        
  }

  // update evidence entries
  include('sub_evidence.php');
?>