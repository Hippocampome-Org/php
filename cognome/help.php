<?php include ("permission_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
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
    document.getElementById('header_title').innerHTML='Help and Details About the Site';
  </script>
  <!-- end of header -->

  <!-- theme section -->
  <?php
  echo "<form action='help.php' method='POST'><div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:.9em;'>Choose theme&nbsp&nbsp<select name='site_theme' id='site_theme' size='1' class='select-css' style='position:relative;top:-2px;'><option value='#'>Theme</option><option value='light_white_bg'";
  if (isset($_POST['site_theme']) && $theme=='light_white_bg') {
    echo " selected";
  }
    echo ">Light with White BG Theme</option><option value='light'";
  if (isset($_POST['site_theme']) && $theme=='light') {
    echo " selected";
  }
    echo ">Light Theme</option><option value='dark'";
  if (isset($_POST['site_theme']) && $theme=='dark') {
    echo " selected";
  }
  echo ">Dark Theme</option><option value='medium_dark'";
  if (isset($_POST['site_theme']) && $theme=='medium_dark') {
    echo " selected";
  }
  echo ">Medium Dark Theme</option></select>&nbsp&nbsp<input type='submit' value='  Update  ' style='height:30px;font-size:16px;position:relative;top:-2px;'></input></div></form><br>";
  ?>
  <!-- end of theme section -->

  <!-- main help descriptions -->
  <div class='article_details'>
  <u>Inclusion Criteria of Articles</u><br>
  Articles that describe cognitive/behavioral functions with neural activity that occurs in the hippocampal formation. The activity must be described as a spiking neural network computational model. Some form of a
  neural network algorithm must be included in the modeling. An original (not previously performed) simulation of the model must be included in the work.
  </div>
  <br><div class='article_details'>
  <u>Subject</u><br>
  This defines what subject area to display relevant work from.
  <br><br><u>Research Dimension</u><br>
  This defines what dimension to include with the work descriptions, and the dimension used for sorting the work.
  <br><br><u>Study Property</u><br>
  This defines specific properties to include with work descriptions. Selecting all causes all properties to be included. This option is not fully implemented yet, selecting any option includes all properties at the current time. Work will be done to implement it more later.
  <br><br><u>Go Button</u><br>
  Press this to update the results based on the options selection made.
  <br><br><u>Notes</u><br>
  The most content so far has been added to the spatial memory category. Try using that one to try the site out. Currently the dimensions are populated with sample data that does not reflect real knowledge. A purpose of this is to show the functionality of the site before the real data is entered in. The real data will be updated in the site on a consistent basis.</div>
  <br><div class='article_details'>
  <u>Comments, Questions, and Thoughts?</u><br>
  Send them to nsutton2 &lpar;&#8219;&agrave;&tcaron;&rpar; gmu.edu.
  </div>  

  <?php
  include('mysql_connect.php');    

  echo "<br><div class='article_details' style='min-width:500px;'><center><u>Glossary</u></center><br><center><table style='font-size:0.8em;'>";
  
  include('glossary.php');

  $conn->close();

  ?></center></table>
</div></div><br>
</div>
</body>
</html>