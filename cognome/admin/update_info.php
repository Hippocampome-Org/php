<?php
  // existing article for modificiation detected
  $sql = "UPDATE `natemsut_hctm`.`articles` SET `url` = \"".$_POST['url']."\", `year` = \"".$_POST['year']."\", `title`= \"".$_POST['title']."\", `theory` = \"".$_POST['theory']."\", `modeling_methods` = \"".$_POST['modeling_methods']."\", `journal` = \"".$_POST['journal']."\", `citation` = \"".$_POST['citation']."\", `abstract` = \"".$_POST['abstract']."\", `curation_notes` = \"".$_POST['curation_notes']."\", `official_id` = \"".$_POST['art_off_id']."\", `authors` = \"".$_POST['authors']."\", `inclusion_qualification` = \"".$_POST['inclusion_qualification']."\" WHERE (`id` = ".$art_num.");";
  $result = $conn->query($sql);

  function get_count($conn, $tbl) {
    // return count of entities for a property type
    $sql = "SELECT id FROM $tbl";
    $result = $conn->query($sql);
    $n_i = 1;
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        $n_i++;
      }
    }
    return $n_i;
  }

  $subjects_count = get_count($conn, "subjects");
  $regions_count = get_count($conn, "regions");
  $theories_count = get_count($conn, "theory_category");
  $neuron_types_count = get_count($conn, "neuron_types");
  $keywords_count = get_count($conn, "keywords");
  
  // submit research properties
  // subjects
  $subjects = array();
  for ($i = 1; $i < $subjects_count; $i++) {
    if (isset($_POST["subject$i"])) {
      array_push($subjects, $i);
    }
  }
  process_deletions($conn,$art_num,'article_has_subject','subject_id',$sel_sbj,$subjects);
  process_additions($conn,$art_num,'article_has_subject','subject_id',$sel_sbj,$subjects); 
  // details
  if ($_POST['details']!='') {
    $det_lvl=$_POST['details'];
    process_deletions($conn,$art_num,'article_has_detail','detail_id',$sel_det,$det_lvl);
    process_additions($conn,$art_num,'article_has_detail','detail_id',$sel_det,$det_lvl); 
  }
  // implementations
  if ($_POST['implementations']!='') {
    $impl_lvl=$_POST['implementations'];
    process_deletions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);
    process_additions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);       
  }
  // scales
  if ($_POST['network_scales']!='') {
    $network_scale_update=$_POST['network_scales'];
    process_deletions($conn,$art_num,'article_has_scale','scale_id',$sel_scl,$network_scale_update);
    process_additions($conn,$art_num,'article_has_scale','scale_id',$sel_scl,$network_scale_update);       
  }  
  // neuron types
  $neuron_type_update = array();
  $neuron_type_fuzzy_update = array();
  for ($i = 1; $i < $neuron_types_count; $i++) {
    if (isset($_POST["neuron_p$i"])) {
      array_push($neuron_type_update, $i);
    }
    if (isset($_POST["neuron_f$i"])) {
      array_push($neuron_type_fuzzy_update, $i);
    }    
  }
  process_deletions($conn,$art_num,'article_has_neuron','neuron_id',$sel_nrn,$neuron_type_update);
  process_additions($conn,$art_num,'article_has_neuron','neuron_id',$sel_nrn,$neuron_type_update);    
  process_deletions($conn,$art_num,'article_has_neuronfuzzy','neuron_id',$sel_nrnfzy,$neuron_type_fuzzy_update);
  process_additions($conn,$art_num,'article_has_neuronfuzzy','neuron_id',$sel_nrnfzy,$neuron_type_fuzzy_update);
  // regions
  $regions_list = array();
  for ($i = 1; $i < $regions_count; $i++) {
    if (isset($_POST["region$i"])) {
      array_push($regions_list, $i);
    }
  }  
  process_deletions($conn,$art_num,'article_has_region','region_id',$sel_rgn,$regions_list);
  process_additions($conn,$art_num,'article_has_region','region_id',$sel_rgn,$regions_list);  
  // theories    
  $theories = array();
  for ($i = 1; $i < $theories_count; $i++) {
    if (isset($_POST["category$i"])) {
      array_push($theories, $i);
    }
  }   
  process_deletions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);
  process_additions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);    
  // keywords
  $keywords = array();
  for ($i = 1; $i < $keywords_count; $i++) {
    if (isset($_POST["keyword$i"])) {
      array_push($keywords, $i);
    }
  }   
  process_deletions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);
  process_additions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);        

  // update evidence entries
  include('sub_evidence.php');
?>