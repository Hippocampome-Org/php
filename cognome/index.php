<!DOCTYPE html>
<html>
<!-- Site for Hippocampus region models and theories that are described computationally in terms of spiking neural networks. 
References: Javascript select redirect: https://www.webdeveloper.com/d/211180-drop-down-menus-with-url-link-options/2-->
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
</head>
<body>
  <div style="width:90%;position:relative;left:5%;">
    <!-- start of header -->    
    
  <!-- end of header -->  
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML="<a href='index.php' style='text-decoration: none;color:black !important'><span class='title_section'>Hippocampus Region Models and Theories</span></a>";
  </script>
  <!-- end of header -->  

  <?php
  include('mysql_connect.php');     

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
    $sql = "SELECT ".$dim_col[$i]." FROM ".$dim_tbl[$i];
    $result = $conn->query($sql);
    $j=1;
    if ($result->num_rows > 0) {       
      while($row = $result->fetch_assoc()) { 
        $dim_name[$i][$j]=$row[$dim_col[$i]];
        $j++;
      }
    } 
  }

  // Generate artcile results
  echo "
  <form action='#' method='POST' style='font-size:1em;'>
  <center><span style='display: inline-block;'>
  Subject:
  <select name='subject' size='1' class='select-css'>";
  $sql = "SELECT subject FROM subjects";
  $result = $conn->query($sql);
  $sub_i=0; 
  $selection_received=$_POST['subject'];
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
      $sub_i=$sub_i+1;
      $selection='';
      if ($selection_received == $sub_i) {
        $selection=" selected='selected'";
      }
      echo "<option value=".$sub_i." ".$selection.">".$row["subject"]."</option>";
    }
  }
  else { echo "0 results"; } 
  echo "</select></span><span style='display: inline-block;'>&nbsp; &nbsp;Dimension:
  <select name='dimension' size='1' class='select-css'>";
  $sql = "SELECT dimension FROM dimensions";
  $result = $conn->query($sql);
  $dim_i=0; 
  $selection_received=$_POST['dimension'];  
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
      $dim_i=$dim_i+1;
      $selection='';
      if ($selection_received == $dim_i) {
        $selection=" selected='selected'";
      }      
      echo "<option value=".$dim_i." ".$selection.">".$row["dimension"]."</option>";
    }
  }
  else { echo "0 results"; } 
  echo "</select></span></span><span style='display: inline-block;'>&nbsp; &nbsp;Property:
  <select name='property' size='1' class='select-css'>";
  $sql = "SELECT property FROM properties";
  $result = $conn->query($sql); 
  $pro_i=0;
  $selection_received=$_POST['property'];  
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
      $pro_i=$pro_i+1;
      $selection='';
      if ($selection_received == $pro_i) {
        $selection=" selected='selected'";
      }      
      echo "<option value=".$pro_i." ".$selection.">".$row["property"]."</option>";
    }
  }
  else { echo "0 results"; } 
  echo "</select></span></span><span style='display: inline-block;'>
  <input type='hidden' name='form_submitted' value='1' />
  &nbsp; &nbsp;<input type='submit' value='   go   '  class='select-css'></span>
  </center></form><br>";

  $subject = 1;
  $dimension = 1;
  $property = 1;
  if ($_POST['form_submitted']=='1') {
    $subject = $_POST['subject'];
    $dimension = $_POST['dimension'];
    $property = $_POST['property'];
  }
  $dim_id = '';
  $dim_desc = '';
  $dim_relation = '';
  $article_id = 'article_id';
  switch($dimension) {
    case 1: $dim_id = 'detail_id'; 
    $dim_desc = 'Level of Detail';
    $dim_relation = 'article_has_detail'; break;
    case 2: $dim_id = 'level_id'; 
    $dim_desc = 'Level of Implementation';
    $dim_relation = 'article_has_implmnt'; break;
    case 3: $dim_id = 'theory_id';
    $dim_desc = 'Theory'; 
    $dim_relation = 'article_has_theory'; break;
    case 4: $dim_id = 'keyword_id'; 
    $dim_desc = 'Keyword';
    $dim_relation = 'article_has_keyword'; break;
    case 5: $dim_id = 'theory_id_1'; 
    $dim_desc = 'Theory Competition';
    $dim_relation = 'theory_has_competition'; break;    
  }

  echo "<center><div style='font-size:1em;display: inline-block;text-align: center;margin: 0 auto;'>Sorted by: ".$dim_desc."</div></center><br>";
  $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification, ".$dim_relation.".".$dim_id." FROM articles, article_has_subject, ".$dim_relation." WHERE article_has_subject.`subject_id` = ".$subject." AND ".$dim_relation.".`".$article_id."` = articles.id AND article_has_subject.article_id = articles.id ORDER BY ".$dim_relation.".`".$dim_id."`";
  $result = $conn->query($sql);
  $i=0; 
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
      $dim_type_desc=$dim_name[$dimension][$row[$dim_id]];
      if ($dim_type_desc=='') {$dim_type_desc='not yet described';};
      echo "<div class='article_details'><div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Article Abstract</label><div class='collapsible-content'><div class='content-inner'><p>
      ".$row["abstract"]."
      </p></div><a style='font-size:10px'><hr></a></div></div>";
      $i++;      
      echo "<u>Citation</u>: " . $row["citation"].
      "<br><u>Url</u>: <a href='".$row["url"]."'>" . $row["url"].
      "</a> <br><u>".$dim_desc."</u>: ".$row[$dim_id].". Dimension type description: ".$dim_type_desc."."."<span style='float:right;font-size:18px;'><a href='/browse.php?art_id=".$row["id"]."'>Full Details</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>";
      if ($row["theory"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Theory</label><div class='collapsible-content'><div class='content-inner'><p>
      ".$row["theory"]."
      </p></div><a style='font-size:10px'><hr></a></div></div>";
      $i++;};
      if ($row["modeling_methods"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Modeling Methods</label><div class='collapsible-content'><div class='content-inner'><p>
      ".$row["modeling_methods"]."
      </p></div><a style='font-size:10px'><hr></a></div></div>";
      $i++;};
      if ($row["curation_notes"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Curation Notes</label><div class='collapsible-content'><div class='content-inner'><p>
      ".$row["curation_notes"]."
      </p></div><a style='font-size:10px'><hr></a></div></div>";
      $i++;};
      if ($row["inclusion_qualification"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Inclusion Qualification</label><div class='collapsible-content'><div class='content-inner'><p>
      ".$row["inclusion_qualification"]."
      </p></div><a style='font-size:10px'><hr></a></div></div>";
      $i++;};            
      echo "</div><br>"; 
    } 
  } 
  else { echo "<br>No results yet but content is being added to the database on a consistent basis. There sould be more results soon if you check back later."; } 

  $conn->close();

  ?>
</div>
</body>
</html>
