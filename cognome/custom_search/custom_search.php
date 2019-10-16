<!--?php include ("permission_check.php"); ?-->
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="../main.css">
  <?php include('set_theme.php'); ?>
  <?php include('function/hc_header.php'); ?>
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
  <?php include("function/hc_body.php"); ?> 
  <div style="width:90%;position:relative;left:5%;"> 
    <br>
    <!-- start of header -->
    <?php echo file_get_contents('header.html'); ?>
    <script type='text/javascript'>
      document.getElementById('header_title').innerHTML="<a href='custom_search.php' style='text-decoration: none;color:black !important'><span class='title_section'>Custom Search</span></a>";
    </script>
    <!-- end of header -->

    <?php
    $dir = "/home/natemsut/public_html/cognome/cognome/custom_search/literature/txt_ver/";
    //$dir = "http://localhost/general/cognome_articles/txt_ver_full/"; // directory of literature in text file format  

    if (isset($_GET['fileview'])) {
      $myFile = $_GET['fileview'];
      $fh = fopen($myFile, 'r');
      $theData = fread($fh, filesize($myFile));
      echo "<center>File Contents</center>";
      echo "<font style='font-size:18px;'>".$theData."</font>";
      fclose($fh);
    }

    echo "<div class='article_details'><form action='#' method='POST'><center><u><span style='font-size:24px;'>Enter Query</span></u><br><br><textarea name='search_query' style='width:600px;height:100px;font-size:18px;'>";
    if (isset($_POST['search_query'])) {
      echo $_POST['search_query'];
    }
    echo"</textarea><br>";
    echo "<div class='wrap-collabsible' id='art_select' style='width:550px;'><input id='instructions' class='toggle' type='checkbox'><label for='instructions' class='lbl-toggle'>Instructions</label><div class='collapsible-content'><div class='content-inner' style='font-size:18px;'>";
    echo "Enter search into text area and seperate search terms with the word \" and \". For example: \"grid cells and place cells\". Set the max keyterm results dropdown to select the maximum number of results to return per keyword.";
    echo "</div></input></div></div>";
    echo "<span style='font-size:22px;position:relative;top:4px;font-family:arial;'>Max keyterm text sample results&nbsp;&nbsp;</span>";
    echo "<select name='max_keyterm_results' style='width:45px;height:30px;font-size:18px;position:relative;top:5px;'>";    
    for ($k_i = 1; $k_i <= 20; $k_i++) {
      echo "<option value='".$k_i."'";
      if (isset($_POST['max_keyterm_results'])) {
        if ($k_i == $_POST['max_keyterm_results']) {
          echo " selected";
        }
      }
      else if ($k_i == 10) {
        echo " selected";
      }
      echo ">".$k_i."</option>";
    }
    echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>";
    echo "<span style='font-size:22px;position:relative;top:4px;font-family:arial;'>Number of articles to search&nbsp;&nbsp;</span>";
    echo "<select name='articles_to_search' style='width:45px;height:30px;font-size:18px;position:relative;top:5px;'>"; 
    $max_art =array("all",10,50,100);
    for ($a_i = 0; $a_i < sizeof($max_art); $a_i++) {
      echo "<option value='".$max_art[$a_i]."'";
      if (isset($_POST['articles_to_search'])) {
        if ($_POST['articles_to_search'] == $max_art[$a_i]) {
          echo " selected";
        }
      }
      else if ($a_i == "all") {
        echo " selected";
      }
      echo ">".$max_art[$a_i]."</option>";
    }
    echo "</select>";    
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<input type='submit' value='search' style='font-size:20px;padding:5px;padding-left:20px;padding-right:20px;position:relative;top:6px;'></center></form></div>";

    if (isset($_POST['search_query'])) {
      $search_query = preg_replace('/[\'\"]/', '', $_POST['search_query']);
      $query = preg_split("/ AND /i", $search_query);/*explode(' AND ', $search_query);*/

      echo "<br><div class='article_details'>
        <center><u>Search Results</u></center>";

      include('search.php'); 

      if (isset($_POST['max_keyterm_results'])) {
        $max_matches = $_POST['max_keyterm_results'];
      }
      else {
        $max_matches = 10;
      }

      if (isset($_POST['articles_to_search'])) {
        $articles_to_search = $_POST['articles_to_search'];
      }
      else {
        $articles_to_search = "all";
      }

      search_directory($dir, $articles_to_search, $max_matches, $query);

      echo "</div>";
    }

    ?>
  <br><br><br><br><br>
  </div>
</body>
</html>