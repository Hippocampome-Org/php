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
    document.getElementById('header_title').innerHTML="<a href='mod_art.php' style='text-decoration: none;color:black !important'><span class='title_section'>Update Articles Database</span></a>";
  </script>
  <!-- end of header -->
  
  <?php
  include('mysql_connect.php');  

  // add/modify/del options presented
  echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><form action='art_sub.php' method='POST'>Articles:&nbsp&nbsp<input type='button' value='  Add  ' onclick='toggleListDown()' style='height:30px;font-size:22px;position:relative;top:-2px;'>&nbsp&nbsp</input><input type='button' value='  Modify  ' onclick='toggleListUp()' style='height:30px;font-size:22px;position:relative;top:-2px;'></input>";
  $sql = "SELECT * FROM natemsut_hctm.articles ORDER BY ID DESC;";
  $result = $conn->query($sql);
  $articles_group=array();
  $articles_ids_group=array();
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {  
      $art_mod=$row["citation"];
      if ($art_mod!=''){
        array_push($articles_group,$art_mod);           
      }
      array_push($articles_ids_group,$row["id"]);
    }
  }  
  rem_art_button('Article',$articles_group);
  echo "</form>";

  $i=1;
  echo "<div class='wrap-collabsible' id='mod_art_select' style='display:none;'><input id='collapsible".$i."' class='toggle' type='checkbox' checked><label for='collapsible".$i."' class='lbl-toggle'>Article to Modify:</label><div class='collapsible-content'><div class='content-inner' style='height: 600px;overflow: auto;'><p><table border=1>";
  for ($i=0;$i<sizeof($articles_group);$i++) {
    echo "<tr><td><a href='?art_mod_id=".$articles_ids_group[$i]."' style='text-decoration: none;'>".$articles_group[$i]."</a></td></tr>";
  }
  echo "</table></p></div><a style='font-size:10px'><hr></a></div></div></div>"; 

  function rem_art_button($property,$property_group) {
    echo "&nbsp&nbsp<input type='button' value='  Remove  ' onclick='javascript:toggle_vis(\"remove_".$property."\")' style='height:30px;font-size:22px;position:relative;top:-2px;'>
    <span style='display:none;' id='remove_".$property."'><font style='font-size:.9em;'>Remove ".$property.":</font><br><select name='remove_".$property."' size='1' class='select-css' style='min-width:400px;max-width:70%;position:relative;top:-7px;'>";
    echo "<option value='' ></option>";
    for ($i=0;$i<count($property_group);$i++) {
      echo "<option value='".$property_group[$i]."' >".substr($property_group[$i],0,110)."</option>";
    }
    echo "</select>&nbsp&nbsp&nbsp<input type='submit' value='  Remove  ' style='height:28px;font-size:20px;position:relative;top:-7px;'></input></span>";
  }

  echo "<script type='text/javascript'>
  function toggleListUp() {
    var mod_arts = document.getElementById('mod_art_select');
    var displaySetting = mod_arts.style.display;
    mod_arts.style.display = 'block';
  }
  function toggleListDown() {
    var mod_arts = document.getElementById('mod_art_select');
    var displaySetting = mod_arts.style.display;
    mod_arts.style.display = 'none';
    window.location.replace('mod_art.php');
  }
  </script>";
  $conn->close();

  /*
    Check for prior collected article details
  */
  if (isset($_GET['art_mod_id'])) {
    $art_mod_id = $_GET['art_mod_id'];
    list($title, $year, $journal, $citation, $url, $abstract, $theory, $mod_meth, $cur_notes, $inc_qual, $authors, $art_off_id) = setArtDetails($art_mod_id,$servername,$username,$password,$dbname);
  }

  function setArtDetails($art_mod_id,$servername,$username,$password,$dbname) {
      // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);    
      // Check connection
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); echo 'connection failed';}  

    $sql = "SELECT * FROM natemsut_hctm.articles WHERE ID=".$art_mod_id.";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $title=$row["title"];
    $year=$row["year"];
    $journal=$row["journal"];
    $citation=$row["citation"];
    $url=$row["url"];
    $abstract=$row["abstract"];
    $theory=$row["theory"];
    $mod_meth=$row["modeling_methods"];
    $cur_notes=$row["curation_notes"];
    $inc_qual=$row["inclusion_qualification"];
    $authors=$row["authors"];
    $art_off_id=$row["official_id"];

    $conn->close();

    return array($title, $year, $journal, $citation, $url, $abstract, $theory, $mod_meth, $cur_notes, $inc_qual, $authors, $art_off_id);
  }

  /*
    Import from pubmed
  */
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);    
  // Check connection
  if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }  

  echo "<br><div class='article_details'><center>
  <form action='#' method='POST'>
  Import from pubmed id:&nbsp;<textarea name='pubmed_id' style='max-width:200px;max-height:25px;font-size:22px;overflow:hidden;resize:none;position:relative;top:5px;'>".$_POST['pubmed_id']."</textarea>&nbsp;&nbsp;<button style='min-width:75px;min-height:25px;position:relative;top:-2px;font-size:22px;'>Import</button>&nbsp;&nbsp;&nbsp;&nbsp;E.g. 27870120</form><br>
  <form action='art_sub.php' method='POST'>
  <span style='font-size:1em;'>Submit the Article to the Database: <input type='submit' value='  Submit  ' style='height:30px;font-size:22px;position:relative;top:-2px;'></input></span></center></div>";
  echo "<br><div class='article_details'>";
  $pubmed_id=$_POST['pubmed_id'];
  $pubmed_html=file_get_contents('https://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id='.$pubmed_id.'retmode=json&rettype=abstract');

  /* populate article data */
  // title
  if ($title=='') {
  $pattern='~.*ArticleTitle\>(.+)\<.*~';
  $result = preg_match($pattern, $pubmed_html, $match);
  $title = $match[1];
  }
  // year
  if ($year=='') {
  $pattern='~.*PubDate\W+Year\>(.+)\<.*~';
  $result = preg_match($pattern, $pubmed_html, $match);
  $year = $match[1];
  }
  // journal
  if ($journal=='') {
  $pattern='~.*JournalIssue\W+Title>(.+)\<.*~';
  $result = preg_match($pattern, $pubmed_html, $match);
  $journal = $match[1];
  }
  // citation data
  // authors
  if ($authors=='') {
    $authors='';
    $lastname_pattern='~.*LastName>(.+)\<.*~';
    $firstinitials_pattern='~.*Initials>(.+)\<.*~';
    $lastname_result = preg_match_all($lastname_pattern, $pubmed_html, $match_1,PREG_PATTERN_ORDER);
    $firstinitials_result = preg_match_all($firstinitials_pattern, $pubmed_html, $match_2,PREG_PATTERN_ORDER);
    for( $i = 0; $i<sizeof($match_1[0]); $i++ ) {
      $authors=$authors.$match_1[1][$i].', '.$match_2[1][$i].'., ';
    }
  }
  // volume
  if ($volume=='') {
    $pattern='~.*JournalIssue\W+Volume>(.+)\<.*~';
    $result = preg_match($pattern, $pubmed_html, $match);
    $volume = $match[1];  
  }
  // issue
  if ($issue=='') {  
    $pattern='~.*JournalIssue\W+Issue>(.+)\<.*~';
    $result = preg_match($pattern, $pubmed_html, $match);
    $issue = $match[1];   
  }
  // pages
  if ($pages=='') {  
    $pattern='~.*Pagination\W+MedlinePgn>(.+)\<.*~';
    $result = preg_match($pattern, $pubmed_html, $match);
    $pages = $match[1]; 
  }
  // combine for citation 
  if ($citation=='') {
    if ($title != '') {
      $citation=$authors.$title.' ('.$year.') '.$journal.', '.$volume.' '.$issue.' '.$pages.'.';
    }
    else {
      $citation='';
    }
  }
  // url
  if ($url=='') {
    if ($pubmed_id != '') {
      $url='https://www.ncbi.nlm.nih.gov/pubmed/'.$pubmed_id.'/';
    }
    else {
      $url='';
    }
  }
  // abstract
  if ($abstract=='') {  
    $pattern='~.*AbstractText>(.+)\<.*~';
    $result = preg_match($pattern, $pubmed_html, $match);
    $abstract = $match[1];  
  }
  // official id
  if ($pubmed_id != '') {
    $art_off_id=$pubmed_id;
  }  

  /* fix all special charactor issues */
  $remove_tag = "\<[A-Za-z0-9\/]+\>";
  $allowed_chr = "[^A-Za-z0-9\-\+\ \,\.\?\:\;\`\'\~\!\@\#\$\%\&\*\_\=\)\(\]\[\}\{\|\/\\\\]";
  $spec_chr = array("–", "'", "-", '"', "&quot;"); // original charactor
  $fixed_chr = array("-", "'", "-", "'", ""); // fixed charactor

  function remove_special_chr($string,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr) {
    $string=preg_replace('/'.$remove_tag.'/', '', $string);
    $string=preg_replace('/'.$allowed_chr.'/', '', $string);
    $string=str_replace($spec_chr, $fixed_chr, $string);    
    return $string;
  }
  
  $title=remove_special_chr($title,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $year=remove_special_chr($year,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $journal=remove_special_chr($journal,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $citation=remove_special_chr($citation,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $url=remove_special_chr($url,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $abstract=remove_special_chr($abstract,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $theory=remove_special_chr($theory,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $mod_meth=remove_special_chr($mod_meth,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $cur_notes=remove_special_chr($cur_notes,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $inc_qual=remove_special_chr($inc_qual,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);
  $authors=remove_special_chr($authors,$remove_tag,$allowed_chr,$spec_chr,$fixed_chr);

  /*
    Article details section
  */
  $det_lbl_wth='100px'; //article details label width
  echo "<center><u>Article Details</u></center>
  <br>
  <br>
  <table style='min-width:100%;'>
  <tr><td style='max-width:".$det_lbl_wth.";'>Title:</td><td><textarea name='title' style='min-width:100%;min-height:50px;font-size:22px;'>".$title."</textarea></td></tr>
  <tr><td style='max-width:".$det_lbl_wth.";'>Article Official ID:</td><td><textarea name='art_off_id' style='min-width:400px;max-height:25px;font-size:22px;overflow:hidden;resize:none;'>".$art_off_id."</textarea></td></tr>  
  <tr><td style='max-width:".$det_lbl_wth.";'>Year:</td><td><textarea name='year' style='max-width:70px;max-height:25px;font-size:22px;overflow:hidden;resize:none;'>".$year."</textarea></td></tr>  
  <tr><td style='max-width:".$det_lbl_wth.";'>Journal:</td><td><textarea name='journal' style='min-width:100%;min-height:25px;font-size:22px;'>".$journal."</textarea></td></tr>
  <tr><td style='max-width:".$det_lbl_wth.";'>Citation:</td><td><textarea name='citation' style='min-width:100%;min-height:125px;font-size:22px;'>".$citation."</textarea></td></tr>
  <tr><td style='max-width:".$det_lbl_wth.";'>Url:</td><td><textarea name='url' style='min-width:100%;min-height:25px;font-size:22px;' id='url'>".$url."</textarea></td></tr> 
  <tr><td style='max-width:".$det_lbl_wth.";'>Authors:</td><td><textarea name='authors' style='min-width:100%;min-height:25px;font-size:22px;' id='url'>".$authors."</textarea></td></tr> 
  <tr><td style='max-width:".$det_lbl_wth.";'>Abstract:</td><td><textarea name='abstract' style='min-width:100%;min-height:200px;font-size:22px;'>".$abstract."</textarea></td></tr>
  <tr><td style='max-width:".$det_lbl_wth.";'>Theory Notes:</td><td><textarea name='theory' style='min-width:100%;min-height:50px;font-size:22px;'>".$theory."</textarea></td></tr>
  <tr><td style='max-width:".$det_lbl_wth.";'>Modeling Methods:</td><td><textarea name='modeling_methods' style='min-width:100%;min-height:50px;font-size:22px;'>".$mod_meth."</textarea></td></tr>  
  <tr><td style='max-width:".$det_lbl_wth.";'>Citation Notes:</td><td><textarea name='curation_notes' style='min-width:100%;min-height:50px;font-size:22px;'>".$cur_notes."</textarea></td></tr>
  <tr><td style='max-width:".$det_lbl_wth.";'>Inclusion Qualification:</td><td><textarea name='inclusion_qualification' style='min-width:100%;min-height:50px;font-size:22px;'>".$inc_qual."</textarea></td></tr>  
  </table>
  </div>";  

  $sql = "SELECT MAX(id) FROM natemsut_hctm.articles;";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if ($art_mod_id=='') {
    $new_art_numb = $row["MAX(id)"] + 1; // new article id number
  }
  else {
    $new_art_numb = $art_mod_id;
  }
  echo "<input type='hidden' name='new_art_numb' value='".$new_art_numb."' />";

  /*
    Article research properties
  */
  // Check for existing property data
  $sel_sbj=array(); // subjects
  $sel_det=array(); // level of detail
  $sel_ipl=array(); // implementation level
  $sel_thy=array(); // theories
  $sel_kwd=array(); // keywords   

  function chk_prop($sql, $conn, $col) {
    /*
      Collect array of existing article properties
    */
    $matches=array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        array_push($matches,$row[$col]);
      }
    }    
    return $matches;
  }

  function add_rem_buttons($property,$property_group) {
    /*
      Provides buttons to add or remove article property
    */
    echo "<font style='font-size:1.3em;'><a href='javascript:toggle_vis(\"add_".$property."\")' style='text-decoration:none;color:black !important'>+</a>&nbsp<a href='javascript:toggle_vis(\"remove_".$property."\")' style='text-decoration:none;color:black !important'>–</a></font>
    <span style='display:none;' id='add_".$property."'><font style='font-size:.7em;'>Add ".$property.":</font><br><textarea name='add_".$property."' style='min-width:70%;max-height:25px;font-size:22px;'></textarea>&nbsp&nbsp&nbsp<input type='submit' value='  Add  ' style='height:28px;font-size:20px;position:relative;top:-7px;'></input></span>
    <span style='display:none;' id='remove_".$property."'><font style='font-size:.7em;'>Remove ".$property.":</font><br><select name='remove_".$property."' size='1' class='select-css' style='min-width:400px;position:relative;top:-7px;'>";
    echo "<option value='' ></option>";
    for ($i=0;$i<count($property_group);$i++) {
      echo "<option value='".$property_group[$i]."' >".$property_group[$i]."</option>";
    }
    echo "</select>&nbsp&nbsp&nbsp<input type='submit' value='  Remove  ' style='height:28px;font-size:20px;position:relative;top:-7px;'></input></span>";
  }

  /* 
    Collect and display existing article properties 
  */
  $tbl="natemsut_hctm.";     
  if ($art_mod_id!='') {   
    $col="subject_id";
    $sql="SELECT ".$col." FROM ".$tbl."article_has_subject WHERE article_id=".$art_mod_id;
    $sel_sbj=chk_prop($sql, $conn, $col);
    //
    $col="detail_id";    
    $sql="SELECT ".$col." FROM ".$tbl."article_has_detail WHERE article_id=".$art_mod_id;
    $sel_det=chk_prop($sql, $conn, $col);
    //
    $col="level_id";    
    $sql="SELECT ".$col." FROM ".$tbl."article_has_implmnt WHERE article_id=".$art_mod_id;
    $sel_ipl=chk_prop($sql, $conn, $col);   
    //
    $col="theory_id";      
    $sql="SELECT ".$col." FROM ".$tbl."article_has_theory WHERE article_id=".$art_mod_id;
    $sel_thy=chk_prop($sql, $conn, $col);
    //
    $col="keyword_id";      
    $sql="SELECT ".$col." FROM ".$tbl."article_has_keyword WHERE article_id=".$art_mod_id;
    $sel_kwd=chk_prop($sql, $conn, $col);  
    //
    $col="scale_id";    
    $sql="SELECT ".$col." FROM ".$tbl."article_has_scale WHERE article_id=".$art_mod_id;
    $sel_scl=chk_prop($sql, $conn, $col);  
    //
    $col="region_id";    
    $sql="SELECT ".$col." FROM ".$tbl."article_has_region WHERE article_id=".$art_mod_id;
    $sel_rgn=chk_prop($sql, $conn, $col);     
  }

  echo "<br><div class='article_details'>
  <center><u>Article Research Properties</u><br>
  Note: use control key to select multiple choices</center><br>
  <table>";

  function display_property($conn, $prop_desc, $but_desc, $tbl, $col, $select_group, $multi_sel) {
    echo "<tr><td style='min-width:350px;'>".$prop_desc."</td><td><select name='".$tbl."[]'";
    if ($multi_sel) {
      echo " size='5' multiple class='select-css' style='min-width:400px;'>";
    }
    else {
      echo " size='1' class='select-css' style='min-width:500px;position:relative;top:-5px;'>";
      echo "<option></option>";
    }
    $sql = "SELECT ".$col." FROM ".$tbl;
    $result = $conn->query($sql);
    $prop_group=array();  
    $i=0;
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        $i=$i+1;
        $selection='';
        if (in_array($i,$select_group)) {
          $selection='selected';
        }
        echo "<option value=".$i." ".$selection.">".$row[$col]."</option>";
        array_push($prop_group,$row[$col]);  
      }
    }
    echo "</select>&nbsp";
    add_rem_buttons($but_desc,$prop_group);
    echo "</td></tr>";
  }

  // display evidence textboxes
  include('display_evidence.php');     

  $evid_loc_h=40; // location textbox height
  $evid_des_h=100; // description textbox height
  display_property($conn, 'Subjects:', 'Subject', 'subjects', 'subject', $sel_sbj, true);
  display_evidence($conn, "Subject", "Location", "sub_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Subject", "Description", "sub_desc", $evid_des_h, $art_mod_id);
  //
  display_property($conn, 'Level of Detail:', 'Detail', 'details', 'detail_level', $sel_det, false);
  display_evidence($conn, "Detail", "Location", "det_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Detail", "Description", "det_desc", $evid_des_h, $art_mod_id);  
  //
  display_property($conn, 'Network Scale:', 'Scale', 'network_scales', 'scale', $sel_scl, false);  
  display_evidence($conn, "Scale", "Location", "scl_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Scale", "Description", "scl_desc", $evid_des_h, $art_mod_id);  
  //
  display_property($conn, 'Implementation Level:', 'Implementation', 'implementations', 'level', $sel_ipl, false);
  display_evidence($conn, "Implementation", "Location", "impl_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Implementation", "Description", "impl_desc", $evid_des_h, $art_mod_id);  
  //
  display_property($conn, 'Anatomical Region:', 'Region', 'regions', 'region', $sel_rgn, true);
  display_evidence($conn, "Region", "Location", "reg_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Region", "Description", "reg_desc", $evid_des_h, $art_mod_id);  
  //
  display_property($conn, 'Theories:', 'Theory', 'theory_category', 'category', $sel_thy, true);
  display_evidence($conn, "Theory", "Location", "thy_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Theory", "Description", "thy_desc", $evid_des_h, $art_mod_id);  
  //
  display_property($conn, 'Keywords:', 'Keyword', 'keywords', 'keyword', $sel_kwd, true);
  display_evidence($conn, "Keyword", "Location", "kwd_loc", $evid_loc_h, $art_mod_id);
  display_evidence($conn, "Keyword", "Description", "kwd_desc", $evid_des_h, $art_mod_id);

  echo "</table></div><br>";
  echo "<div class='article_details'><center><form action='art_sub.php' method='POST'>
  <span style='font-size:1.2em;'>Submit the Article to the Database: <input type='submit' value='  Submit  ' style='height:30px;font-size:22px;position:relative;top:-2px;'></input></span></center></div>";

  $conn->close();

  ?></center></table></form>
</div></div><br>
</div>
</body>
</html>