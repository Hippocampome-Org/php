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
    document.getElementById('header_title').innerHTML="<a href='index.php' style='text-decoration: none;color:black !important'><span class='title_section'>Hippocampus Region Models and Theories</span></a>";
    document.getElementById('fix_title').style='width:90%;position:relative;left:5%;';
  </script>
  <!-- end of header -->  

  <?php
  // retreive dimension names
  include('dimension_names.php');

  /*
    generate article results
    the dimension search bar is created here
  */
  include('search_option.php');    
  echo "
  <form action='#' method='POST' style='font-size:1em;'>
  <center>";
  search_option($cog_conn, $sql, "Subject dimension", "subject", "subjects", "all_on");
  echo "&nbsp";
  search_option($cog_conn, $sql, "Other dimension", "dimension", "dimensions", "all_on");
  echo "&nbsp";
  search_option($cog_conn, $sql, "Detail", "property", "properties", "all_off"); 
  echo "<span style='display: inline-block;'>
  <input type='hidden' name='form_submitted' value='1' />
  &nbsp; &nbsp;<input type='submit' value='   go   '  class='select-css'></span>
  </center></form><br>";

  // check for user's dimension selection
  include('get_dimension.php');

  if ($subject_desc != "" || $dim_desc != "" || $prop_desc != "") {
    echo "<center><div style='font-size:1em;display: inline-block;text-align: center;margin: 0 auto;'>";
    if ($subject != 0) {
      echo "Filtered by Subject: ".$subject_desc;
    }
    if ($subject != 0 && ($dimension != 0 || $property != 1)) {
      echo "; ";
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

  /*
    Build query
  */
  $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification, ";
  if ($dimension != 0) {
    $sql = $sql.$dim_relation.".".$dim_id.", ";
  }
  $sql = $sql."articles.".$prop_id." FROM articles, article_has_subject";
  if ($dimension != 0) {
    $sql = $sql.", ".$dim_relation;
  }
  $sql = $sql." WHERE ";
  if ($subject != 0) {
    $sql = $sql."article_has_subject.`subject_id` = ".$subject." AND ";
  }
  if ($dimension != 0) {
    $sql = $sql.$dim_relation.".`".$article_id."` = articles.id AND ";
  }
  $sql = $sql."article_has_subject.article_id = articles.id";
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
