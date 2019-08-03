<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
</head>
<body>
  <div style="width:80%;position:relative;left:10%;">
        
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML='General Statistics and Reporting';
  </script>
  <!-- end of header -->    

  <center>
  <?php
  include('mysql_connect.php');    

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
  for($i=1;$i<(sizeof($dim_tbl)+1);$i++) {
    echo "<tr><th><u>Dimension: ".$dim_tbl[$i]."</u></th><th><u>Type: ".$dim_col[$i]."</u></th>";
    echo "<tr><tr>";
    echo "<tr><td><center><u>ID</u></center></td><td><center><u>Description</u></center></td></tr>";
    $sql = "SELECT ".$dim_col[$i]." FROM ".$dim_tbl[$i];
    $result = $conn->query($sql);
    $j=1;
    if ($result->num_rows > 0) {       
      while($row = $result->fetch_assoc()) { 
        $dim_name[$i][$j]=$row[$dim_col[$i]];
        echo "<tr><td style='min-width:13em;'><center>".$j."</center></td><td style='min-width:10em;'>".$row[$dim_col[$i]]."</td></tr>";
        $j++;
      }
    } 
  }
  echo "<tr></tr></table><br><br></div></input></div></div></div>";   

  /*
    Report literature statistics
  */
  $sql = "SELECT COUNT(*) FROM natemsut_hctm.articles";
  $result = $conn->query($sql);
  $article_count = $result->fetch_assoc();
  echo "<br><div class='article_details'>Total number of articles: ".$article_count["COUNT(*)"]."</div>";

  echo "<br><div class='article_details'><center><u>Subjects</u></center><br>";

  echo "<table cellspacing='5px' cellpadding='30px' style='font-size:20px;'><tr><th><u>Subject</u></th><th><u>Articles</u></th><th><u>Theories</u></th><th><u>Keywords</u></th>";

  $sql = "SELECT COUNT(*) FROM natemsut_hctm.subjects";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();    
  $dim_count = $row["COUNT(*)"];   
  
  for($i=1;$i<$dim_count+1;$i++) {
    $sql = "SELECT subject FROM subjects WHERE id=".$i;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sql2 = "SELECT COUNT(*) FROM article_has_subject WHERE subject_id=".$i;
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $sql3 = "SELECT COUNT(*) FROM article_has_subject, article_has_theory WHERE article_has_subject.subject_id=".$i." AND article_has_subject.article_id=article_has_theory.article_id";
    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch_assoc();
    $sql4 = "SELECT COUNT(*) FROM article_has_subject, article_has_keyword WHERE article_has_subject.subject_id=".$i." AND article_has_subject.article_id=article_has_keyword.article_id";
    $result4 = $conn->query($sql4);
    $row4 = $result4->fetch_assoc();            
    echo "<tr><td>".$row["subject"]."</td><td><center>".$row2["COUNT(*)"]."</center></td><td><center>".$row3["COUNT(*)"]."</center></td><td><center>".$row4["COUNT(*)"]."</center></td>";
    $subj_names[$i]=$row["subject"];
  }
  echo "</table></div>";

  /*
  Dimensions
  */
  echo "<br><div class='article_details'><center><u>Dimensions</u></center>";

  echo "<table cellspacing='5px' cellpadding='30px' style='font-size:20px;'><tr><th><u>Dimension</u></th><th><u>Articles</u></th><br>";
  
  $dim_tbl=array(
    1=>"article_has_detail",
    2=>"article_has_implmnt",
    3=>"article_has_theory",
    4=>"article_has_keyword",
    5=>"theory_has_competition");

  $sql = "SELECT COUNT(*) FROM natemsut_hctm.dimensions";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();    
  $dim_count = $row["COUNT(*)"];   
  for($i=1;$i<$dim_count+1;$i++) {
    $sql = "SELECT dimension FROM dimensions WHERE id=".$i;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sql2 = "SELECT COUNT(*) FROM ".$dim_tbl[$i];
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    echo "<tr><td>".$row["dimension"]."</td><td><center>".$row2["COUNT(*)"]."</center></td><tr>";
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
    5=>"theory_id_1");  

  $art_id_names=array(
    1=>"article_has_detail.article_id",
    2=>"article_has_implmnt.article_id",
    3=>"article_has_theory.article_id",
    4=>"article_has_keyword.article_id",
    5=>"theory_has_competition.theory_id_2");

  echo "</div><div style='min-width:1700px;position:relative;left:10%;'>";
  echo "<br><center><div class='article_details'><center><u>Articles with Dimension Values</u></center>";

  $sql = "SELECT COUNT(*) FROM natemsut_hctm.subjects";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();    
  $dim_count = $row["COUNT(*)"]; 

  echo "<br><table width='400px' style='font-size:14px;'>";
  for($i=1;$i<(sizeof($dim_name)+1);$i++) {
    echo "<tr width='300px' style='width:500px;'><th><u>Subject</u>";
    for($j=1;$j<(sizeof($dim_name[$i])+1);$j++) {
      echo "<th width='50px' style='word-wrap:break-word'><u>".$dim_name[$i][$j]."</u></th>";
    }    
    #echo "<tr style='width:500px;'>";
    disp_dim_arts($dim_name, $subj_names, $i, $j, "article_has_subject", $dim_tbl, "subject_id", $dim_id_names, "article_has_subject.article_id", $art_id_names, $conn);
    #echo "</tr>";
    echo "</th></tr>"; 
  }
  echo "</table>";  

  function disp_dim_arts($dim_name, $subj_names, $i, $j, $subj_tbl, $dim_tbl, $subj_id_name, $dim_id_names, $subj_art_id, $art_id_names, $conn) {
    for($k=1;$k<(sizeof($subj_names)+1);$k++) {
      echo "<tr width='300px' style='width:500px;'>";
      echo "<td width='50px' style='word-wrap:break-word'>".$subj_names[$k]."</td>";

      for($j=1;$j<(sizeof($dim_name[$i])+1);$j++) {
        $table1 = $subj_tbl;
        $table2 = $dim_tbl[$i];
        $id_name_1 = $subj_id_name;
        $id_name_2 = $dim_id_names[$i];
        $id_val_1 = $k;
        $id_val_2 = $j;
        $art1 = $subj_art_id;
        $art2 = $art_id_names[$i];

        dim_art_num($dim_name, $table1, $table2, $id_name_1, $id_name_2, $id_val_1, $id_val_2, $art1, $art2, $conn);
      }
      echo "</tr>";      
    }   
  }

  function dim_art_num($dim_name, $table1, $table2, $id_name_1, $id_name_2, $id_val_1, $id_val_2, $art1, $art2, $conn) {
    /*
      Number of articles given a subject and dimension value

      Example query: SELECT DISTINCT COUNT(*) FROM natemsut_hctm.article_has_detail, natemsut_hctm.article_has_subject WHERE detail_id = 3 AND subject_id = 2 AND article_has_detail.article_id = article_has_subject.article_id;
    */

    echo "<td width='50px' style='word-wrap:break-word'><center>";      
    $sql = "SELECT DISTINCT COUNT(*) FROM natemsut_hctm.".$table1.", natemsut_hctm.".$table2." WHERE ".$id_name_1." = ".$id_val_1." AND ".$id_name_2." = ".$id_val_2." AND ".$art1." = ".$art2.";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo $row["COUNT(*)"];
    echo "</center></td>";      
  }

  echo "</div>";  

  $conn->close();

  ?></center></table>
</div></div><br>
</body>
</html>