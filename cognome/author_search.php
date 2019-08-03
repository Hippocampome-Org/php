<!DOCTYPE html>
<html>
<head>
  <!--
    Name: Author Search
    Author: Nate Sutton
    Copyright: 2019

    Description: Search by Author

    References: https://www.rexegg.com/regex-php.html
  -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
  <script type="text/javascript">
    function toggle_vis(elem_name) {
     var elem = document.getElementById(elem_name);
     if (elem.style.display === "none") {
      elem.style.display = "block";
    } else {
      elem.style.display = "none";
    }
  }
</script>
</head>
<body>
  <div style="width:90%;position:relative;left:5%;"> 
    <!-- start of header -->
    <?php echo file_get_contents('header.html'); ?>
    <script type='text/javascript'>
      document.getElementById('header_title').innerHTML="<a href='author_search.php' style='text-decoration: none;color:black !important'><span class='title_section'>Search by Author</span></a>";
    </script>
    <!-- end of header -->

    <?php
    include('mysql_connect.php'); 

    mysqli_set_charset($conn,"utf8mb4");    

    $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N',
      'O','P','Q','R','S','T','U','V','W','X','Y','Z');

    //$letter_patterns = array('/$[A].*/');
    $letter_patterns=array(
    'A'=>'/^[Aa].*/',
    'B'=>'/^[Bb].*/',
    'C'=>'/^[Cc].*/',
    'D'=>'/^[Dd].*/',
    'E'=>'/^[Ee].*/',
    'F'=>'/^[Ff].*/',
    'G'=>'/^[Gg].*/',
    'H'=>'/^[Hh].*/',
    'I'=>'/^[Ii].*/',        
    'J'=>'/^[Jj].*/',
    'K'=>'/^[Kk].*/',
    'L'=>'/^[Ll].*/',
    'M'=>'/^[Mm].*/',
    'N'=>'/^[Nn].*/',
    'O'=>'/^[Oo].*/',
    'P'=>'/^[Pp].*/',
    'Q'=>'/^[Qq].*/',
    'R'=>'/^[Rr].*/',
    'S'=>'/^[Ss].*/',
    'T'=>'/^[Tt].*/',
    'U'=>'/^[Uu].*/',
    'V'=>'/^[Vv].*/',
    'W'=>'/^[Ww].*/',
    'X'=>'/^[Xx].*/',
    'Y'=>'/^[Yy].*/',
    'Z'=>'/^[Zz].*/');

    if (isset($_GET['letter'])) {
      $letter = $_GET['letter'];
    }
    else {
      $letter = 'A';
    }

    $dimensions = 2; // not yet including theory competition
    $dim_id = '';
    $dim_desc = '';
    $dim_relation = '';

    $dim_row=array(
      1=>"detail_id",
      2=>"level_id",
      3=>"theory_id",
      4=>"keyword_id");
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

    function report_dim($dim_id, $dim_desc, $dim_val, $dim_type_desc) {
        echo "<br><u>".$dim_desc."</u>: ".$dim_val.". Dimension type description: ".$dim_type_desc.".";
    }

    function set_dim($dimension, $dim_val, $dim_name) {
      $dim_type_desc=$dim_name[$dimension][$dim_val];

      switch($dimension) {
        case 1: $dim_id = 'detail_id'; 
        $dim_desc = 'Level of Detail';
        report_dim($dim_id, $dim_desc, $dim_val, $dim_type_desc); break;
        case 2: $dim_id = 'level_id'; 
        $dim_desc = 'Level of Implementation';
        report_dim($dim_id, $dim_desc, $dim_val, $dim_type_desc); break;
        case 3: $dim_id = 'theory_id';
        $dim_desc = 'Theory'; 
        report_dim($dim_id, $dim_desc, $dim_val, $dim_type_desc); break;
        case 4: $dim_id = 'keyword_id'; 
        $dim_desc = 'Keyword';
        report_dim($dim_id, $dim_desc, $dim_val, $dim_type_desc); break;
        case 5: $dim_id = 'theory_id_1'; 
        $dim_desc = 'Theory Competition';
        report_dim($dim_id, $dim_desc, $dim_val, $dim_type_desc); break;
      }
    }

    function alink($first_letter) {
      echo "<a href='?letter=".$first_letter."'>".$first_letter."</a>&nbsp";
    }

    echo "<div class='article_details'><center>";

    foreach ($letters as $auth_letter) {
      alink($auth_letter);
    }
    echo "</center></div>";

    echo "<br><div class='article_details'>";

    if (isset($_GET['author_id'])) {
      /*
        Find author name
        Get article ids that incldue the author
        Output formatted reports on each article corresponding to the id
      */
      $author_id = $_GET['author_id'];
      $sql = "SELECT author FROM natemsut_hctm.authors WHERE id = ".$author_id.";";
      $author_name = $conn->query($sql)->fetch_assoc()['author'];
      echo "<center><u>".$author_name."</u></center></div><br>";

      $author_ids = array();
      $sql = "SELECT article_id FROM natemsut_hctm.article_has_author WHERE author_name='".$author_name."';";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 
          array_push($author_ids,$row['article_id']);
        }
      }

      $i=0;
      foreach ($author_ids as $id) {
        $sql = "SELECT DISTINCT articles.id, articles.url, articles.citation, articles.theory, articles.modeling_methods, articles.abstract, articles.curation_notes, articles.inclusion_qualification FROM natemsut_hctm.articles WHERE articles.id = ".$id.";";
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) {
            // abstract
            echo "<div class='article_details'><div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Article Abstract</label><div class='collapsible-content'><div class='content-inner'><p>
            ".$row["abstract"]."
            </p></div><a style='font-size:10px'><hr></a></div></div>";
            $i++;     
            // citation
            echo "<u>Citation</u>: " . $row["citation"].
            "<br><u>Url</u>: <a href='".$row["url"]."'>" . $row["url"].
            "</a>";
            // dimensions
            /*
            for ($dim_id=1;$dim_id<=$dimensions;$dim_id++) {
              set_dim($dim_id,$row[$dim_row[$dim_id]],$dim_name);
            }
            */
            // full details
            echo "<span style='float:right;font-size:18px;'><a href='/browse.php?art_id=".$row["id"]."'>Full Details</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>";
            // theory notes
            if ($row["theory"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Theory</label><div class='collapsible-content'><div class='content-inner'><p>
            ".$row["theory"]."
            </p></div><a style='font-size:10px'><hr></a></div></div>";
            $i++;};
            // modeling methods
            if ($row["modeling_methods"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Modeling Methods</label><div class='collapsible-content'><div class='content-inner'><p>
            ".$row["modeling_methods"]."
            </p></div><a style='font-size:10px'><hr></a></div></div>";
            $i++;};
            // curation notes
            if ($row["curation_notes"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Curation Notes</label><div class='collapsible-content'><div class='content-inner'><p>
            ".$row["curation_notes"]."
            </p></div><a style='font-size:10px'><hr></a></div></div>";
            $i++;};
            // inclusion qualification
            if ($row["inclusion_qualification"]!='') {echo "<div class='wrap-collabsible'><input id='collapsible".$i."' class='toggle' type='checkbox'><label for='collapsible".$i."' class='lbl-toggle'>Inclusion Qualification</label><div class='collapsible-content'><div class='content-inner'><p>
            ".$row["inclusion_qualification"]."
            </p></div><a style='font-size:10px'><hr></a></div></div>";
            $i++;};
            echo "</div><br>"; 
          }
        }
      }
    }
    else {
      $sql = "SELECT id, author FROM natemsut_hctm.authors;";
      $result = $conn->query($sql); 
      if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
          $author = $row["author"];
          $auth_id = $row["id"];
          if (preg_match($letter_patterns[$letter], $author)) {
            echo "<a href='?author_id=".$auth_id."'>".$author."</a><br>";
          }
        }
      }   
    }
    echo "</div>";

    $conn->close();  

    ?></div></div><br>
  </div>
</body>
</html>        