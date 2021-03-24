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
  <div style="width:90%;position:relative;left:5%;">
  <br><br> 
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML="<a href='index.php' style='text-decoration: none;color:black !important'><span class='title_section'>Hippocampus Region Models and Theories</span></a>";
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
  include('search_option.php');    
  echo "
  <form action='#' method='POST' style='font-size:1em;'>
  <center>";
  search_option($conn, $sql, "Subject", "subject", "subjects", "all_off");
  echo "&nbsp";
  search_option($conn, $sql, "Dimension", "dimension", "dimensions", "all_off");
  echo "&nbsp";
  search_option($conn, $sql, "Detail", "property", "properties", "all_off"); 
  echo "<span style='display: inline-block;'>
  <input type='hidden' name='form_submitted' value='1' />
  &nbsp; &nbsp;<input type='submit' value='   go   '  class='select-css'></span>
  </center></form><br>";

  // check for user's dimension selection
  include('get_dimension.php');

  echo "<center><div style='font-size:1em;display: inline-block;text-align: center;margin: 0 auto;'>Sorted by: ".$dim_desc."</div></center><br>";
  $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification, ".$dim_relation.".".$dim_id.", articles.".$prop_id." FROM articles, article_has_subject, ".$dim_relation." WHERE article_has_subject.`subject_id` = ".$subject." AND ".$dim_relation.".`".$article_id."` = articles.id AND article_has_subject.article_id = articles.id ORDER BY ".$dim_relation.".`".$dim_id."`, `articles`.`".$prop_id."` DESC;";

  // display articles based on the user's selection
  include('display_articles.php');

  $conn->close();

  ?>
</div>
</body>
</html>
