<?php include ("../permission_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <!--
    Name: Parse Authors
    Author: Nate Sutton
    Copyright: 2019

    Description: Parses author names

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
      document.getElementById('header_title').innerHTML="<a href='parse_authors.php' style='text-decoration: none;color:black !important'><span class='title_section'>Automatic Author Parsing</span></a>";
    </script>
    <!-- end of header -->

    <?php

    $cog_database = "cognome_core";
    echo "Using database: ".$cog_database."<br><br>";

    /*
      Import author names
    */
    $author_names=array();
    $author_art_ids=array();
    $author_names_unique=array();
    $sql = "SELECT id, authors FROM $cog_database.articles;";
    $result = $cog_conn->query($sql); 
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        $art_id = $row["id"];
        $auth_str = $row["authors"];
        $pattern='/([\w]+[\'\- ]?[\w]+[\,][\W]?[\w]+[\.]? ?[\w]?[\.]? ?[\w]?[\.]? ?[\w]?[\.]? ?[\w]?[\.]? ?[\w]?[\.]?)/u';

        $success = preg_match_all($pattern, $auth_str, $match);
        if ($success) {
          foreach ($match[1] as $name){
            array_push($author_names,$name);
            array_push($author_art_ids,$art_id);
          }
        }
      }
    }   
    $author_names_unique=array_unique($author_names);   

    /*
      Export article has author relations
    */
    $i=0;
    foreach ($author_names as $name){
      
      $sql = "INSERT INTO `$cog_database`.`article_has_author` (`article_id`, `author_name`) VALUES ('".$author_art_ids[$i]."', '".$author_names[$i]."');";
      $result = $cog_conn->query($sql);
      usleep(50000); #avoid overload      
      //echo $author_art_ids[$i].", ".$author_names[$i]."<br>"; // test output
      $i++;
    }    

    /*
      Export unique author names
    */
    sort($author_names_unique);

    foreach ($author_names_unique as $name){
      
      $sql = "INSERT INTO `$cog_database`.`authors` (`author`) VALUES ('".$name."');";
      $result = $cog_conn->query($sql);
      usleep(50000); #avoid overload      
      //echo $name."<br>"; // test output
    }
    

    echo "Successfully updated author names.";

    ?></div></div><br>
  </div>
</body>
</html>    