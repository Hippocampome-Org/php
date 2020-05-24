<!DOCTYPE html>
<html>
<head>
  <!--
    References: https://www.rexegg.com/regex-php.html
    https://www.washington.edu/accesscomputing/webd2/student/unit5/module2/lesson5.html
  -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="../main.css">
  <?php include('set_theme.php'); ?>
  <?php include('../function/hc_header.php'); ?>
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
  <?php include("../function/hc_body.php"); ?>
  <div style="width:90%;position:relative;left:5%;"> 
    <br><br>
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML="<a href='review_suggs.php' style='text-decoration: none;color:black !important'><span class='title_section'>Review User Suggestions</span></a>";
  </script>
  <!-- end of header -->
  
  <?php
  include('mysql_connect.php');  

  $orig_db = "natemsut_hctm";
  $sugg_db = "natemsut_cog_sug";

  echo "<form name='register' id='register' action='register.php' method='POST'><center>";

  $sql = "SELECT * FROM $sugg_db.user_suggestions;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
      $username = $row['username'];
      //<tr><td>Entry:</td><td>".$row['id']."</td></tr>";
      $tbl = $row['table'];
      $id = $row['entry_id'];

      // get columns
      $all_cols = [];
      $sql_cols = "SHOW COLUMNS FROM $sugg_db.$tbl";
      //echo $sql_cols;
      $result_cols = $conn->query($sql_cols);
      if ($result_cols->num_rows > 0) { 
        while($row_rslt = $result_cols->fetch_assoc()) { 
          array_push($all_cols, $row_rslt['Field']);
        }
      }

      // get sugg entries
      $sugg_entry = [];
      $sql2 = "SELECT * FROM $sugg_db.$tbl WHERE id=$id;";
      //echo $sql2;
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        foreach ($all_cols as $col_name) {
          $col_entry_data = "[blank]";
          if ($row2[$col_name] != '') {
            $col_entry_data = $row2[$col_name];
            array_push($sugg_entry, $col_entry_data);
          }
          //echo "<tr><td>$col_name</td><td>".$col_entry_data."</td><tr>";
          //echo $col_name;
        }
      }
      // get orig entries
      $orig_entry = [];
      $sql2 = "SELECT * FROM $orig_db.$tbl WHERE id=$id;";
      //echo $sql2;
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        foreach ($all_cols as $col_name) {
          $col_entry_data = "[blank]";
          if ($row2[$col_name] != '') {
            $col_entry_data = $row2[$col_name];
            array_push($orig_entry, $col_entry_data);
          }
        }
      }

      // display differences
      for ($i = 0; $i < count($sugg_entry);$i++) {
        if ($sugg_entry[$i] != $orig_entry[$i]) {
          echo "<div class='article_details' style='padding: .4rem;font-size:.7em;'><br>";
          echo "<table>";
          echo "<tr><td>User suggestion from:</td><td>$username</td></tr>";
          echo "<tr><td>Suggested entry:</td></tr>";
          echo "<tr><td>".$all_cols[$i]."</td><td>".$sugg_entry[$i]."</td></tr>";   
          echo "<tr><td>Original entry:</td></tr>";
          $orig_entry_data = '[no entry]';
          if ($orig_entry[$i] != '') {
            $orig_entry_data = $orig_entry[$i];
          }
          echo "<tr><td>".$all_cols[$i]."</td><td>".$orig_entry_data."</td></tr>";
          echo "<tr><td><br></td></tr></table></div>";
        }
      }
      //echo "<tr><td><br></td></tr></table><br></div><br>";
    }
  }
  echo "</center></form><br>";   

  $conn->close();

  ?>
</div>
</body>
</html>  