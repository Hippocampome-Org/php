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
  $prop_value = ''; $row_name = ''; $tbl_name = '';
  $filter = 'no filter';
  if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
  }

  include('search_option.php');    
  echo "
  <form action='#' method='POST' style='font-size:1em;'>
  <center>Select";
  search_option($cog_conn, $sql, "Subject", "subject", "subjects", "all_off");
  echo "<br>Sort By";
  search_option($cog_conn, $sql, "Dimension", "dimension", "dimensions", "all_off");
  search_option($cog_conn, $sql, "Detail", "property", "properties", "all_off");  
  echo "<span style='display: inline-block;' style='a {text-decoration:none important!;};text-decoration:none important!;'>Filter By:&nbsp<a href='?filter=detail'><input type='button' class='light_bg select-css' value='level of detail'></a>&nbsp;<a href='?filter=implmnt'><input type='button' class='light_bg select-css' value='implementation level'></a>&nbsp;<a href='?filter=theory'><input type='button' class='light_bg select-css' value='theory'></a>&nbsp;<a href='?filter=keyword'><input type='button' class='light_bg select-css' value='keyword'></a><br>";
  if ($filter=='detail') {
    $prop_name = "Level of Detail";
    $row_name = "detail_level";
    $tbl_name = "details";
    $prop_relation_tbl = "article_has_detail";
    $prop_relation_row = "detail_id";
    $all_switch = "all_off";
    $prop_value = $_POST[$row_name];
    echo "Filter Property -";
    search_option($cog_conn, $sql, $prop_name, $row_name, $tbl_name, $all_switch);
  }
  if ($filter=='implmnt') {
    $prop_name = "Implementation Level";
    $row_name = "level";
    $tbl_name = "implementations";
    $prop_relation_tbl = "article_has_implmnt";
    $prop_relation_row = "level_id";
    $all_switch = "all_off";
    $prop_value = $_POST[$row_name];
    echo "Filter Property -";
    search_option($cog_conn, $sql, $prop_name, $row_name, $tbl_name, $all_switch);
  }
  if ($filter=='keyword') {
    $prop_name = "Keyword";
    $row_name = "keyword";
    $tbl_name = "keywords";
    $prop_relation_tbl = "article_has_keyword";
    $prop_relation_row = "keyword_id";
    $all_switch = "all_off";
    $prop_value = $_POST[$row_name];
    echo "Filter Property -";
    search_option($cog_conn, $sql, $prop_name, $row_name, $tbl_name, $all_switch);
  }
  if ($filter=='theory') {
    $prop_name = "Theory";
    $row_name = "category";
    $tbl_name = "theory_category";
    $prop_relation_tbl = "article_has_theory";
    $prop_relation_row = "theory_id";
    $all_switch = "all_off";
    $prop_value = $_POST[$row_name];
    echo "Filter Property -";
    search_option($cog_conn, $sql, $prop_name, $row_name, $tbl_name, $all_switch);
  }
  echo "<input type='hidden' name='form_submitted' value='1' />
  <br><span style='padding:20px'><input type='submit' value='   go   '  class='light_bg select-css'></span></span>
  </center></form><br>";

  // check for user's dimension selection
  include('get_dimension.php');

  echo "<center><div style='font-size:1em;display: inline-block;text-align: center;margin: 0 auto;'>Sorted by: ".$dim_desc."</div></center><br>";
  if ($filter == 'no filter' | $prop_value == '') {
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

  // display articles based on the user's selection
  include('display_articles.php');

  $cog_conn->close();

  ?>
</div>
</body>
</html>
