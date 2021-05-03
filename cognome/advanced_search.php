<?php include ("permission_check.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title id="title_id">Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
  <?php include('function/hc_header.php'); ?>
</head>
<body>
  <?php include("function/hc_body.php"); ?>  
  <br><br> 
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <div style="width:90%;position:relative;left:5%;">
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML="<a href='advanced_search.php' style='text-decoration: none;color:black !important'><span class='title_section'>Advanced Search</span></a>";
    document.getElementById('fix_title').style='width:90%;position:relative;left:5%;';
  </script>
  <!-- end of header -->  

  <?php
  include('mysql_connect.php');     

  // retreive dimension names
  include('dimension_names.php');

  /*
    generate article results
    the dimension search bar is created here
  */
  $description  = "<br>Filter property -";
  $all_switch = "all_off";
  $prop_value = ''; $row_name = ''; $tbl_name = '';
  $second_filter = 'no filter';
  if (isset($_GET['second_filter'])) {
    $second_filter = $_GET['second_filter'];
  }

  include('search_option.php');    
  echo "
  <form action='#' method='POST' style='font-size:1em;'>
  <center>";
  search_option($cog_conn, $sql, "First filter: subject dimension", "subject", "subjects", "all_on");
  echo "<br><span style='display: inline-block;' style='a {text-decoration:none important!;};text-decoration:none important!;'>Second filter: dimension entity:&nbsp<a href='?second_filter=detail'><input type='button' class='light_bg select-css' value='level of detail'></a>&nbsp;<a href='?second_filter=implmnt'><input type='button' class='light_bg select-css' value='implementation level'></a>&nbsp;<a href='?second_filter=keyword'><input type='button' class='light_bg select-css' value='keyword'></a><br><a href='?second_filter=theory'><input type='button' class='light_bg select-css' value='theory or network algorithm'></a>&nbsp;<a href='?second_filter=scale'><input type='button' class='light_bg select-css' value='simulation scale'></a>&nbsp;<a href='?second_filter=neuron'><input type='button' class='light_bg select-css' value='neuron types'></a>&nbsp;<a href='?second_filter=region'><input type='button' class='light_bg select-css' value='anatomical region'></a></span>"; 
  function entity_options($cog_conn, $sql, $prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row, $all_switch, $description) {
    echo $description;
    search_option($cog_conn, $sql, $prop_name, $row_name, $tbl_name, $all_switch);

    return array($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row);
  }
  if ($second_filter=='detail') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "level of detail", "detail_level", "details", "article_has_detail", "detail_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  if ($second_filter=='implmnt') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "implementation level", "level", "implementations", "article_has_implmnt", "level_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  if ($second_filter=='keyword') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "keyword", "keyword", "keywords", "article_has_keyword", "keyword_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  if ($second_filter=='region') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "anatomical region", "region", "regions", "article_has_region", "region_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  if ($second_filter=='scale') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "simulation scale", "scale", "network_scales", "article_has_scale", "scale_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  if ($second_filter=='neuron') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "neuron type", "neuron", "neuron_types", "article_has_neuron", "neuron_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  if ($second_filter=='theory') {
    list($prop_name, $row_name, $tbl_name, $prop_relation_tbl, $prop_relation_row) = entity_options($cog_conn, $sql, "theory or network algorithm", "category", "theory_category", "article_has_theory", "theory_id", $all_switch, $description);
    $prop_value = $_POST[$row_name];
  }
  echo "<br>Sort:";
  search_option($cog_conn, $sql, "dimension", "dimension", "dimensions", "all_on");
  search_option($cog_conn, $sql, "detail", "property", "properties", "all_off"); 
  echo "<input type='hidden' name='form_submitted' value='1' />
  <br><span style='padding:20px'><input type='submit' value='   go   '  class='light_bg select-css'></span></span>
  </center></form><br>";

  // check for user's dimension selection
  include('get_dimension.php');

  if ($subject_desc != "" || $dim_desc != "" || $prop_desc != "") {
    echo "<center><div style='font-size:1em;display: inline-block;text-align: center;margin: 0 auto;'>";
    if ($subject != 0) {
      echo "First Filter: Subject: ".$subject_desc;
    }
    if ($subject != 0 && $prop_name != "" && $prop_ent_desc != "") {
      echo ";<br>";
    }
    if ($prop_name != "" && $prop_ent_desc != "") {
      echo "Second Filter: ";
      if ($prop_name == "level of detail") {
        echo "Level of Detail";
      }
      else if ($prop_name == "theory or network algorithm") {
        echo "Theory or Network Algorithm";
      }
      else {echo ucwords($prop_name);}
      echo ": ".$prop_ent_desc;
    }
    if (($subject != 0 || ($prop_name != "" && $prop_ent_desc != "")) && ($dimension != 0 || $property != 1)) {
      echo ";<br>";
    }
    if ($dimension != 0 || $property != 1) {
      echo "Sorted by: ";
    }
    if ($dimension != 0) {
      echo $dim_desc;
    }
    if ($dimension != 0 && $property != 1) {
      echo " and ";
    }    
    if ($property != 1) {
      echo $prop_desc;
    }
    if ($subject != 0 || $dimension != 0 || $property != 1) {
      echo ".";
    }
    echo "</div></center>";
  }
  echo "<br>";

  if ($second_filter == 'no filter' | $prop_value == '') {
    $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification, ".$dim_relation.".".$dim_id.", articles.".$prop_id." FROM articles, article_has_subject, ".$dim_relation." WHERE article_has_subject.`subject_id` = ".$subject." AND ".$dim_relation.".`".$article_id."` = articles.id AND article_has_subject.article_id = articles.id ORDER BY ".$dim_relation.".`".$dim_id."`, `articles`.`".$prop_id."` DESC;";
  }
  else {
    if ($dim_relation != $prop_relation_tbl) {
      $prop_relation = ", ".$prop_relation_tbl;
      $prop_tbl_join = " AND ".$prop_relation_tbl.".article_id = articles.id";
    }
    else {
      $prop_relation = '';
      $prop_tbl_join = '';
    }
    $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification, ".$dim_relation.".".$dim_id.", articles.".$prop_id." FROM articles, article_has_subject, ".$dim_relation.$prop_relation." WHERE article_has_subject.`subject_id` = ".$subject." AND ".$dim_relation.".`".$article_id."` = articles.id AND article_has_subject.article_id = articles.id AND ".$prop_relation_tbl.".".$prop_relation_row." = ".$prop_value.$prop_tbl_join." ORDER BY ".$dim_relation.".`".$dim_id."`, `articles`.`".$prop_id."` DESC;";
  }

  /*
    Build query
  */
  $prop_relation = '';
  $prop_tbl_join = '';
  if (($prop_value != "" || $second_filter != 'no filter')) {
    $prop_relation = $prop_relation_tbl;
    $prop_tbl_join = " AND ".$prop_relation_tbl.".article_id = articles.id";
  }
  $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification, ";
  if ($dimension != 0) {
    $sql = $sql.$dim_relation.".".$dim_id.", ";
  }
  if (($prop_value != "" || $second_filter != 'no filter')) {
    $sql = $sql.$prop_relation.".".$prop_relation_row.", ";
  }
  $sql = $sql."articles.".$prop_id." FROM articles, article_has_subject";
  if ($dimension != 0) {
    $sql = $sql.", ".$dim_relation;
  }
  if (($prop_value != "" || $second_filter != 'no filter') && ($dim_relation != $prop_relation_tbl)) {
    $sql = $sql.", ".$prop_relation;
  }
  $sql = $sql." WHERE ";
  if ($subject != 0) {
    $sql = $sql."article_has_subject.`subject_id` = ".$subject." AND ";
  }
  if ($dimension != 0) {
    $sql = $sql.$dim_relation.".`".$article_id."` = articles.id AND ";
  }
  $sql = $sql."article_has_subject.article_id = articles.id";
  if (($prop_value != "" || $second_filter != 'no filter')) {
    $sql = $sql." AND ".$prop_relation_tbl.".".$prop_relation_row." = ".$prop_value.$prop_tbl_join;
  }
  if ($dimension != 0 || $property != 1) {
    // set order by conditions
    // only proceeds if selections are not set to "all"
    $sql = $sql." ORDER BY ";
    if ($dimension != 0) {
      $sql = $sql.$dim_relation.".`".$dim_id."` ASC";
    }
    if ($dimension != 0 && $property != 1) {
      $sql = $sql." , ";
    }
    if ($property != 1) {
      $sql = $sql."`articles`.`".$prop_id."` DESC";
    }
  } 
  //echo $sql;

  // display articles based on the user's selection
  include('display_articles.php');

  $cog_conn->close();

  ?>
</div>
</body>
</html>
