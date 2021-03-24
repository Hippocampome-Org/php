<?php include ("permission_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
  <?php include('function/hc_header.php'); ?>
  <?php $selected_db = $cog_database; ?>
</head>
<body>
  <?php include("function/hc_body.php"); ?> 
  <br><br>
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <div style="width:80%;position:relative;left:10%;">
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML='General Statistics and Reporting';
    document.getElementById('fix_title').style='width:80%;position:relative;left:10%;';
  </script>
  <!-- end of header -->   

  <center>
  <?php
  //include('mysql_connect.php');    

  /* Determine if article cutoff should occur with a starting max id
     and a ending max id. */
  if (isset($_GET['only_evidence_anno']) && $_GET['only_evidence_anno']==true) {
    $GLOBALS['art_cutoff_use'] = true;
  }
  $GLOBALS['art_start_cutoff'] = 117;
  $GLOBALS['art_end_cutoff'] = 313;
  //error_reporting(0);

  /*
  Glossary
  */
  echo "<div class='article_details' style='min-width:500px;'><div class='wrap-collabsible' id='art_select'><input id='collapsible1' class='toggle' type='checkbox'><label for='collapsible1' class='lbl-toggle'>Glossary:</label><div class='collapsible-content'><div class='content-inner' style='height:600px;overflow: auto;'><center><span style='font-size:30px'><u>Glossary</u></span></center><br>";
  
    echo "<center><table>";/*<table style='font-size:0.8em;'>";*/
  
  // Collect dimension names
  $dim_tbl=array(
    1=>"details",
    2=>"implementations",
    3=>"theory_category",
    4=>"keywords");
  $dim_col=array(
    1=>"detail_level",
    2=>"level",
    3=>"category",
    4=>"keyword");
  
  include('glossary.php'); 
  echo "<tr></tr></table><br><br></div></input></div></div></div>";   

  /*
    Report literature statistics
  */
  // only evi adjustments
  function only_evi_adj($temp_tbl, $temp_col) {
    $sql = " AND ($temp_tbl$temp_col <= ".$GLOBALS['art_start_cutoff']." OR $temp_tbl$temp_col = 310 OR $temp_tbl$temp_col = 313 OR $temp_tbl$temp_col = 314 OR $temp_tbl$temp_col = 266 OR $temp_tbl$temp_col = 267 OR $temp_tbl$temp_col = 269 OR $temp_tbl$temp_col = 270 OR $temp_tbl$temp_col = 303 OR $temp_tbl$temp_col = 288 OR $temp_tbl$temp_col = 305);";
    return $sql;
  }

  $only_evi = " WHERE (id <= ".$GLOBALS['art_start_cutoff']." OR id = 310 OR id = 313 OR id = 314 OR id = 266 OR id = 267 OR id = 269 OR id = 270 OR id = 303 OR id = 288 OR id = 305);";
  $temp_tbl = "article_has_subject.";
  $temp_col = "article_id";
  $only_evi_2 = only_evi_adj($temp_tbl, $temp_col);
  $temp_tbl = "";
  $temp_col = "article_id";
  $only_evi_3 = only_evi_adj($temp_tbl, $temp_col);

  $sql = "SELECT COUNT(*) FROM $selected_db.articles";
  if ($GLOBALS['art_cutoff_use']==true) {
    $sql = $sql.$only_evi;
  }
  $result = $cog_conn->query($sql);
  $article_count = $result->fetch_assoc();
  echo "<br><div class='article_details'>Total number of articles: ".$article_count["COUNT(*)"];
  echo "<br><br><a href='reporting.php' style='background-color:lightgrey;border-radius: 20px;border:1px solid black;text-decoration: none;' class='button_padding'>statistics on all articles</a>&nbsp&nbsp<a href='reporting.php?only_evidence_anno=true' style='background-color:lightgrey;border-radius: 20px;border:1px solid black;text-decoration: none;' class='button_padding'>only articles with evidence annotations</a><br><br>
    Database version to use: <select name='param_1' size='1' style='height:25px;'><option value='core'>Core collection</option><option value='extended'>Extended collection</option></select>&nbsp;&nbsp;<input type='submit' value='Update' style='height:25px;width:75px;font-size:14px;' />&nbsp;<font size=2>(Note: database switch not yet working)</font></div>";

  echo "<br><div class='article_details'><center><u>Subjects</u></center><br>";

  echo "<table cellspacing='5px' cellpadding='30px' style='font-size:20px;'><tr><th><u>Subject</u></th><th><u>Articles</u></th><th><u>Theories</u></th><th><u>Keywords</u></th><tr>";

  $sql = "SELECT COUNT(*) FROM $selected_db.subjects";
  $result = $cog_conn->query($sql);
  $row = $result->fetch_assoc();    
  $dim_count = $row["COUNT(*)"];   
  
  for($i=1;$i<$dim_count+1;$i++) {
    $sql = "SELECT subject FROM $selected_db.subjects WHERE id=".$i;
    $result = $cog_conn->query($sql);
    $row = $result->fetch_assoc();
    $subj_names[$i]=$row["subject"];
  }

  function find_subject_annos($i, $selected_db, $cog_conn) {
    $sql = "SELECT subject FROM $selected_db.subjects WHERE id=".$i;
    $sql2 = "SELECT COUNT(*) FROM $selected_db.article_has_subject WHERE subject_id=".$i;
    $sql3 = "SELECT COUNT(*) FROM $selected_db.article_has_subject, article_has_theory WHERE article_has_subject.subject_id=".$i." AND article_has_subject.article_id=article_has_theory.article_id";
    $sql4 = "SELECT COUNT(*) FROM $selected_db.article_has_subject, article_has_keyword WHERE article_has_subject.subject_id=".$i." AND article_has_subject.article_id=article_has_keyword.article_id";
    if ($GLOBALS['art_cutoff_use']==true) {
       $sql2 = $sql2.$only_evi_2;
       $sql3 = $sql3.$only_evi_2;
       $sql4 = $sql4.$only_evi_2;
    }
    $result = $cog_conn->query($sql);
    $row = $result->fetch_assoc();
    $result2 = $cog_conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $result3 = $cog_conn->query($sql3);
    $row3 = $result3->fetch_assoc();
    $result4 = $cog_conn->query($sql4);
    $row4 = $result4->fetch_assoc();            
    echo "<tr><td>".$row["subject"]."</td><td><center>".$row2["COUNT(*)"]."</center></td><td><center>".$row3["COUNT(*)"]."</center></td><td><center>".$row4["COUNT(*)"]."</center></td></tr>";
  }
  echo "<tr><td><center><u>Spatial Navigation and Memory</u></center></td></tr>";  
  find_subject_annos(1, $selected_db, $cog_conn);
  echo "<tr><td><br><center><u>Non-spatial Learning and Memory</u></center></td></tr>";  
  find_subject_annos(2, $selected_db, $cog_conn);
  find_subject_annos(6, $selected_db, $cog_conn);
  find_subject_annos(7, $selected_db, $cog_conn);
  find_subject_annos(8, $selected_db, $cog_conn);
  find_subject_annos(10, $selected_db, $cog_conn);
  find_subject_annos(11, $selected_db, $cog_conn);
  find_subject_annos(12, $selected_db, $cog_conn);
  find_subject_annos(14, $selected_db, $cog_conn);
  echo "<tr><td><br><center><u>Pattern Completion and Separation</u></center></td></tr>";  
  find_subject_annos(5, $selected_db, $cog_conn);
  echo "<tr><td><br><center><u>Neurological Disorders</u></center></td></tr>";  
  find_subject_annos(15, $selected_db, $cog_conn);
  find_subject_annos(16, $selected_db, $cog_conn);
  find_subject_annos(18, $selected_db, $cog_conn);
  echo "<tr><td><br><center><u>Other Models</u></center></td></tr>";  
  find_subject_annos(3, $selected_db, $cog_conn);
  find_subject_annos(17, $selected_db, $cog_conn);
  echo "</table></div>";

  /*
  Dimensions
  */
  echo "<br><div class='article_details'><center><u>Dimensions</u></center>";

  echo "<table cellspacing='5px' cellpadding='30px' style='font-size:20px;'><tr><th><u>Dimension</u></th><th><u>Annotations</u></th><th><u>Articles</u></th><br>";
  
  $dim_tbl=array(
    1=>"article_has_detail",
    2=>"article_has_implmnt",
    3=>"article_has_theory",
    4=>"article_has_keyword",
    5=>"article_has_region",
    6=>"article_has_scale");

  $sql = "SELECT COUNT(*) FROM $selected_db.dimensions";
  $result = $cog_conn->query($sql);
  $row = $result->fetch_assoc();    
  $dim_count = $row["COUNT(*)"];   
  for($i=1;$i<$dim_count+1;$i++) {
    $sql = "SELECT dimension FROM $selected_db.dimensions WHERE id=".$i;
    $sql2 = "SELECT COUNT(*) FROM $selected_db.".$dim_tbl[$i];
    $sql3 = "SELECT COUNT(DISTINCT article_id) FROM $selected_db.".$dim_tbl[$i];
    if ($i == 6) {
      $sql2 = "SELECT COUNT(*) FROM $selected_db.".$dim_tbl[$i]." WHERE scale_id != ''";
      $sql3 = "SELECT COUNT(DISTINCT article_id) FROM $selected_db.".$dim_tbl[$i]." WHERE scale_id != ''";
    }    
    if ($GLOBALS['art_cutoff_use']==true) {
      $temp_tbl = $dim_tbl[$i].".";
      $temp_col = "article_id";
      $syntax_term = "WHERE";
      if ($i == 6) {
        $syntax_term = "AND";
      }
      $only_evi_3 = " $syntax_term ($temp_tbl$temp_col <= ".$GLOBALS['art_start_cutoff']." OR $temp_tbl$temp_col = 310 OR $temp_tbl$temp_col = 313 OR $temp_tbl$temp_col = 314 OR $temp_tbl$temp_col = 266 OR $temp_tbl$temp_col = 267 OR $temp_tbl$temp_col = 269 OR $temp_tbl$temp_col = 270 OR $temp_tbl$temp_col = 303 OR $temp_tbl$temp_col = 288 OR $temp_tbl$temp_col = 305);";      
      $sql2 = $sql2.$only_evi_3;
      $sql3 = $sql3.$only_evi_3;
    }
    $result = $cog_conn->query($sql);
    if ($result->num_rows > 0) {       
      while($row = $result->fetch_assoc()) {          
        $result2 = $cog_conn->query($sql2);
        if ($result2->num_rows > 0) {       
          while($row2 = $result2->fetch_assoc()) { 
            $result3 = $cog_conn->query($sql3);
            if ($result3->num_rows > 0) {       
              while($row3 = $result3->fetch_assoc()) {             
                echo "<tr><td>".$row["dimension"]."</td><td><center>".$row2["COUNT(*)"]."</center></td><td><center>".$row3["COUNT(DISTINCT article_id)"]."</center></td><tr>";
              }
            }
          }
        }
      }
    }
  }
  
  echo "</table></div></center>";

  /*
    Report dimension content details

    Note: index i is dimension type, j is dimension property, k is subject
  */

  $wrap_col_numb = 4;
  $dim_id_names=array(
    1=>"detail_id",
    2=>"level_id",
    3=>"theory_id",
    4=>"keyword_id",
    5=>"region_id",
    6=>"scale_id");  
  $dim_heading=array(
    1=>"Levels of Detail",
    2=>"Implementation Levels",
    3=>"Theory Categories",
    4=>"Keywords",
    5=>"Anatomical Regions",
    6=>"Network Scales");

  $art_id_names=array(
    1=>"article_has_detail.article_id",
    2=>"article_has_implmnt.article_id",
    3=>"article_has_theory.article_id",
    4=>"article_has_keyword.article_id",
    5=>"article_has_region.article_id",
    6=>"article_has_scale.article_id");

  echo "</div><div style='min-width:1700px;position:relative;left:10%;'>";
  echo "<br><center><div class='article_details'><center><u>Articles with Dimension Values</u></center>";
  echo "<br>Individual counts of a dimensions value annotations given a subject are listed. Each entry in the matrices<br>below contains the count value on the left and percentage within its group on the right.<br>";

  $sql = "SELECT COUNT(*) FROM $selected_db.subjects";
  $result = $cog_conn->query($sql);
  $row = $result->fetch_assoc();    
  $dim_count = $row["COUNT(*)"]; 

  echo "<br><table width='400px' class='reporting_table'>";
  for($i=1;$i<(sizeof($dim_name)+1);$i++) {
    echo "<tr width='300px' style='width:500px;'><th class='reporting_table_head'><br><u>".$dim_heading[$i]."</u><br><br>";
    echo "</th></tr>";
    echo "<tr width='300px' style='width:500px;' class='reporting_table_head'><th class='reporting_table_head'><u>Subject</u>";
    for($j=1;$j<(sizeof($dim_name[$i])+1);$j++) {
      echo "<th width='50px' style='word-wrap:break-word' class='reporting_table_head'><u>".$dim_name[$i][$j]."</u></th>";
    }    
    disp_dim_arts($dim_name, $subj_names, $i, $j, "article_has_subject", $dim_tbl, "subject_id", $dim_id_names, "article_has_subject.article_id", $art_id_names, $cog_conn, $selected_db);
    echo "</th></tr>"; 
  }
  echo "</table>";  

  function disp_dim_arts($dim_name, $subj_names, $i, $j, $subj_tbl, $dim_tbl, $subj_id_name, $dim_id_names, $subj_art_id, $art_id_names, $cog_conn, $selected_db) {
    for($k=1;$k<(sizeof($subj_names)+1);$k++) {
      echo "<tr width='300px' style='width:500px;'>";
      echo "<td width='50px' style='word-wrap:break-word' class='reporting_table_body'>".$subj_names[$k]."</td>";

      for($j=1;$j<(sizeof($dim_name[$i])+1);$j++) {
        $table1 = $subj_tbl;
        $table2 = $dim_tbl[$i];
        $id_name_1 = $subj_id_name;
        $id_name_2 = $dim_id_names[$i];
        $id_val_1 = $k;
        $id_val_2 = $j;
        $art1 = $subj_art_id;
        $art2 = $art_id_names[$i];

        dim_art_num($dim_name, $table1, $table2, $id_name_1, $id_name_2, $id_val_1, $id_val_2, $art1, $art2, $cog_conn, false, $selected_db);
      }
      echo "</tr>";      
    }   
    /* display totals for all subjects */
    echo "<tr width='300px' style='width:500px;'>";
    echo "<td width='50px' style='word-wrap:break-word' class='reporting_table_head'>all</td>";
    for($j=1;$j<(sizeof($dim_name[$i])+1);$j++) {
      $table1 = $subj_tbl;
      $table2 = $dim_tbl[$i];
      $id_name_1 = $subj_id_name;
      $id_name_2 = $dim_id_names[$i];
      $id_val_1 = $k;
      $id_val_2 = $j;
      $art1 = $subj_art_id;
      $art2 = $art_id_names[$i];
      dim_art_num($dim_name, $table1, $table2, $id_name_1, $id_name_2, $id_val_1, $id_val_2, $art1, $art2, $cog_conn, true, $selected_db);
    }
    echo "</tr>";
  }

  function dim_art_num($dim_name, $table1, $table2, $id_name_1, $id_name_2, $id_val_1, $id_val_2, $art1, $art2, $cog_conn, $all_toggle, $selected_db) {
    /*
      Number of articles given a subject and dimension value

      Example query: SELECT DISTINCT COUNT(*) FROM $selected_db.article_has_detail, article_has_subject WHERE detail_id = 3 AND subject_id = 2 AND article_has_detail.article_id = article_has_subject.article_id;
    */

    if ($all_toggle==false) {
      echo "<td width='50px' style='word-wrap:break-word' class='reporting_table_body'><center>";
      $sql = "SELECT DISTINCT COUNT(*) FROM $selected_db.".$table1.", $selected_db.".$table2." WHERE ".$id_name_1." = ".$id_val_1." AND ".$id_name_2." = ".$id_val_2." AND ".$art1." = ".$art2;
      if ($GLOBALS['art_cutoff_use']==true) {
        $temp_tbl = "";
        $temp_col = $art1;
        $only_evi_temp = only_evi_adj($temp_tbl, $temp_col);
        $sql = $sql.$only_evi_temp;
      }
    }
    else {
      echo "<td width='50px' style='word-wrap:break-word' class='reporting_table_head'><center>";
      $sql = "SELECT DISTINCT COUNT(".$id_name_2.") FROM $selected_db.".$table1.", $selected_db.".$table2." WHERE ".$id_name_2." = ".$id_val_2." AND ".$art1." = ".$art2;
      if ($GLOBALS['art_cutoff_use']==true) {
        $temp_tbl = "";
        $temp_col = $art1;
        $only_evi_temp = only_evi_adj($temp_tbl, $temp_col);
        $sql = $sql.$only_evi_temp;        
      }
    }
    $result = $cog_conn->query($sql);
    $row = $result->fetch_assoc();
    if ($all_toggle==false) {
      $dim_val = $row["COUNT(*)"];
      $sql = "SELECT DISTINCT COUNT(".$id_name_2.") FROM $selected_db.".$table1.", $selected_db.".$table2." WHERE ".$id_name_2." = ".$id_val_2." AND ".$art1." = ".$art2;
      if ($GLOBALS['art_cutoff_use']==true) {
        $temp_tbl = "";
        $temp_col = $art1;
        $only_evi_temp = only_evi_adj($temp_tbl, $temp_col);
        $sql = $sql.$only_evi_temp;        
      }
      $result = $cog_conn->query($sql);
      $row2 = $result->fetch_assoc();
      $dim_val_total = $row2["COUNT(".$id_name_2.")"];
      /* avoid division by zero */
      if ($dim_val_total > 0) {
        $percent = round($dim_val/$dim_val_total, 3)*100;
      }
      else {
        $percent = 0;
      }
      echo "<div style='position:relative;width:100px;font-size:17px;'><span style='float:left'>".$dim_val."</span><span style='float:right'>".$percent."%</span></div>";
    }
    else {
      $dim_val_total = $row["COUNT(".$id_name_2.")"];
      $sql = "SELECT DISTINCT COUNT(".$id_name_2.") FROM $selected_db.".$table1.", $selected_db.".$table2." WHERE ".$art1." = ".$art2;
      if ($GLOBALS['art_cutoff_use']==true) {
        $temp_tbl = "";
        $temp_col = $art1;
        $only_evi_temp = only_evi_adj($temp_tbl, $temp_col);
        $sql = $sql.$only_evi_temp;        
      }
      $result = $cog_conn->query($sql);
      $row2 = $result->fetch_assoc();
      $all_dim_val = $row2["COUNT(".$id_name_2.")"];
      /* avoid division by zero */
      if ($all_dim_val > 0) {
        $percent = round($dim_val_total/$all_dim_val, 3)*100;
      }
      else {
        $percent = 0;
      }
      echo $dim_val_total." (".$percent."% of all)";
    }
    echo "</center></td>";      
  }

  echo "</div>";  

  $cog_conn->close();

  ?></center></table>
</div></div><br>
</body>
</html>