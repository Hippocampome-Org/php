<?php include ("permission_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <!--
    References: https://www.rexegg.com/regex-php.html
    https://www.washington.edu/accesscomputing/webd2/student/unit5/module2/lesson5.html
  -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
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
    <br><br>
    <!-- start of header -->
    <?php echo file_get_contents('header.html'); ?>
    <script type='text/javascript'>
      document.getElementById('header_title').innerHTML="<a href='browse.php' style='text-decoration: none;color:black !important'><span class='title_section'>Browse Full Article Entries</span></a>";
    </script>
    <!-- end of header -->

    <?php
    include('mysql_connect.php');  

    /*
      Search by Author
    */
    $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N',
      'O','P','Q','R','S','T','U','V','W','X','Y','Z');

    function alink($first_letter) {
      echo "<a href='author_search.php?letter=".$first_letter."'>".$first_letter."</a>&nbsp";
    }   

    echo "<div class='wrap-collabsible' id='art_select'><input id='collapsible_auth_srch' class='toggle' type='checkbox' checked><label for='collapsible_auth_srch' class='lbl-toggle'>Search by Author:</label><div class='collapsible-content'><div class='content-inner' style='font-size:22px;'><p><table border=1><center>";
    
    foreach ($letters as $auth_letter) {
      alink($auth_letter);
    }

    echo "</center></table></p></div><a style='font-size:10px'><hr></a></div></div><br>";

  /*
    Check for prior collected article details
  */
    $expand_art_list='checked';
    $show_art_prop='display:none';
    if (isset($_GET['art_id'])) {
      $art_mod_id = $_GET['art_id'];
      //list($title, $year, $journal, $citation, $url, $abstract, $theory, $mod_meth, $cur_notes, $inc_qual, $authors, $art_off_id) = getArtDetails($art_mod_id,$servername,$username,$password,$dbname);
      list($title, $year, $journal, $citation, $url, $abstract, $theory, $mod_meth, $cur_notes, $inc_qual, $authors, $art_off_id) = getArtDetails($art_mod_id, $conn);
      list($sub_evid_loc, $sub_evid_des, $det_evid_loc, $det_evid_des, $scl_evid_loc, $scl_evid_des, $impl_evid_loc, $impl_evid_des, $rgn_evid_loc, $rgn_evid_des, $thy_evid_loc, $thy_evid_des, $kwd_evid_loc, $kwd_evid_des) = getResProperties($art_mod_id, $conn);
      $expand_art_list='';
      $show_art_prop='display:visible';
    }  

    //function getArtDetails($art_mod_id,$servername,$username,$password,$dbname) {
    function getArtDetails($art_mod_id, $conn) {
      // Create connection
      //$conn = new mysqli($servername, $username, $password, $dbname);    
      // Check connection
      //if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); echo 'connection failed';}  

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

      //$conn->close();

      return array($title, $year, $journal, $citation, $url, $abstract, $theory, $mod_meth, $cur_notes, $inc_qual, $authors, $art_off_id);
    }

    function getResProperties($art_mod_id, $conn) { 

      $sql = "SELECT evidence_of_details.evidence_position AS p1, evidence_of_details.evidence_description AS d1, evidence_of_implmnts.evidence_position AS p2, evidence_of_implmnts.evidence_description AS d2, evidence_of_keywords.evidence_position AS p3, evidence_of_keywords.evidence_description AS d3, evidence_of_regions.evidence_position AS p4, evidence_of_regions.evidence_description AS d4, evidence_of_scales.evidence_position AS p5, evidence_of_scales.evidence_description AS d5, evidence_of_subjects.evidence_position AS p6, evidence_of_subjects.evidence_description AS d6, evidence_of_theories.evidence_position AS p7, evidence_of_theories.evidence_description AS d7 FROM natemsut_hctm.evidence_of_details, natemsut_hctm.evidence_of_implmnts, natemsut_hctm.evidence_of_keywords, natemsut_hctm.evidence_of_regions, natemsut_hctm.evidence_of_scales, natemsut_hctm.evidence_of_subjects, natemsut_hctm.evidence_of_theories WHERE evidence_of_details.article_id=evidence_of_implmnts.article_id and evidence_of_details.article_id=evidence_of_keywords.article_id and evidence_of_details.article_id=evidence_of_regions.article_id and evidence_of_details.article_id=evidence_of_scales.article_id and evidence_of_details.article_id=evidence_of_subjects.article_id and evidence_of_details.article_id=evidence_of_theories.article_id and evidence_of_details.article_id=".$art_mod_id.";";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $sub_evid_loc=$row["p1"];
      $sub_evid_des=$row["d1"];
      $det_evid_loc=$row["p2"];
      $det_evid_des=$row["d2"];
      $scl_evid_loc=$row["p3"];
      $scl_evid_des=$row["d3"];
      $impl_evid_loc=$row["p4"];
      $impl_evid_des=$row["d4"];
      $rgn_evid_loc=$row["p5"];
      $rgn_evid_des=$row["d5"];
      $thy_evid_loc=$row["p6"];
      $thy_evid_des=$row["d6"];
      $kwd_evid_loc=$row["p7"];
      $kwd_evid_des=$row["d7"];
      
      return array($sub_evid_loc, $sub_evid_des, $det_evid_loc, $det_evid_des, $scl_evid_loc, $scl_evid_des, $impl_evid_loc, $impl_evid_des, $rgn_evid_loc, $rgn_evid_des, $thy_evid_loc, $thy_evid_des, $kwd_evid_loc, $kwd_evid_des);
    }      

  // articles list
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
    echo "</form>";

    $i=1;
    echo "<div class='wrap-collabsible' id='art_select'><input id='collapsible".$i."' class='toggle' type='checkbox' ".$expand_art_list."><label for='collapsible".$i."' class='lbl-toggle'>Article to View:</label><div class='collapsible-content'><div class='content-inner' style='height: 600px;overflow: auto;'><p><table border=1>";
    for ($i=0;$i<sizeof($articles_group);$i++) {
      echo "<tr><td><a href='?art_id=".$articles_ids_group[$i]."' style='text-decoration: none;'>".$articles_group[$i]."</a></td></tr>";
    }
    echo "</table></p></div><a style='font-size:10px'><hr></a></div></div>"; 
    $conn->close();

  /*
    Article details section
  */
  // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);    
  // Check connection
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } 

  $det_lbl_wth='200px'; //article details label width
  echo "<br><div class='article_details' style='".$show_art_prop."'>
  <center><u>Article Details</u></center>
  <br><table style='min-width:100%;'>
  <tr><td style='min-width:".$det_lbl_wth.";'>Title:</td><td class='browse_table'><label name='title' style='min-width:100%;min-height:50px;font-size:22px;'>".$title."</label></td></tr>
  <tr><td style='min-width:".$det_lbl_wth.";'>Article Official ID:</td><td class='browse_table'><label name='art_off_id' style='min-width:400px;max-height:25px;font-size:22px;overflow:hidden;resize:none;'>".$art_off_id."</label></td></tr>  
  <tr><td style='min-width:".$det_lbl_wth.";'>Year:</td><td class='browse_table'><label name='year' style='max-width:70px;max-height:25px;font-size:22px;overflow:hidden;resize:none;'>".$year."</label></td></tr>  
  <tr><td style='min-width:".$det_lbl_wth.";'>Journal:</td><td class='browse_table'><label name='journal' style='min-width:100%;min-height:25px;font-size:22px;'>".$journal."</label></td></tr>
  <tr><td style='min-width:".$det_lbl_wth.";'>Citation:</td><td class='browse_table'><label name='citation' style='min-width:100%;min-height:125px;font-size:22px;'>".$citation."</label></td></tr>
  <tr><td style='min-width:".$det_lbl_wth.";'>Url:</td><td class='browse_table'><label name='url' style='min-width:100%;min-height:25px;font-size:22px;' id='url'><a href='".$url."'>".$url."</a></label></td></tr> 
  <tr><td style='min-width:".$det_lbl_wth.";'>Authors:</td><td class='browse_table'><label name='authors' style='min-width:100%;min-height:25px;font-size:22px;' id='url'>".$authors."</label></td></tr> 
  <tr><td style='min-width:".$det_lbl_wth.";'>Abstract:</td><td class='browse_table'><label name='abstract' style='min-width:100%;min-height:200px;font-size:22px;'>".$abstract."</label></td></tr>
  <tr><td style='min-width:".$det_lbl_wth.";'>Theory Notes:</td><td class='browse_table'><label name='theory' style='min-width:100%;min-height:50px;font-size:22px;'>".$theory."</label></td></tr>
  <tr><td style='min-width:".$det_lbl_wth.";'>Modeling Methods:</td><td class='browse_table'><label name='modeling_methods' style='min-width:100%;min-height:50px;font-size:22px;'>".$mod_meth."</label></td></tr>  
  <tr><td style='min-width:".$det_lbl_wth.";'>Citation Notes:</td><td class='browse_table'><label name='curation_notes' style='min-width:100%;min-height:50px;font-size:22px;'>".$cur_notes."</label></td></tr>
  <tr><td style='min-width:".$det_lbl_wth.";'>Inclusion Qualification:</td><td class='browse_table'><label name='inclusion_qualification' style='min-width:100%;min-height:50px;font-size:22px;'>".$inc_qual."</label></td></tr>  
  </table>
  </div>";  

  /*
    Article research properties
  */
  // Check for existing property data
  $sel_sbj=array(); // subjects
  $sel_det=array(); // level of detail
  $sel_ipl=array(); // implementation level
  $sel_thy=array(); // theories
  $sel_kwd=array(); // keywords   

  function chk_prop($sql, $conn, $tbl) {
    /*
      Collect array of existing article properties
    */
      $matches=array();
      $result = $conn->query($sql);
      if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 
          array_push($matches,$row[$tbl]);
        }
      }    
      return $matches;
    }

  function chk_prop_name($sql, $conn, $tbl) {
    /*
      Collect name of article property
    */
      $match='';
      $result = $conn->query($sql);
      if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 
          $match=$row[$tbl];
        }
      }    
      return $match;
    }    

    function properties_included($prop_descript,$select_size,$col_descript,$tbl_descript,$sel_list,$conn,$multi,$sel_name,$non_sel_name) {
      /*
        Report properties that are selected
      */

      if ($multi != 'multiple') {
        $non_sel_size=1;
      }
      else {
        $non_sel_size=5;        
      }

      echo "<tr><td style='max-width:3%;'>".$prop_descript.":</td><td  class='browse_table_2'><span class='browse_table_title'>".$sel_name.":</span><br>
      <select name='selections[]' size='".$select_size."' ".$multi." class='select-css' style='min-width:400px;'>"; 
      for ($si=0;$si<sizeof($sel_list);$si++) {
        $prop_id=$sel_list[$si];
        $sql="SELECT ".$col_descript." FROM natemsut_hctm.".$tbl_descript." WHERE id=".$prop_id;
        $prop_name=chk_prop_name($sql, $conn, $col_descript);
        echo "<option value=".$prop_name.">".$prop_name."</option>";
      }
      echo "</select><br><span class='browse_table_title'>";
      echo $non_sel_name.":</span><br><select name='subjects[]' size='".$non_sel_size."' $multi class='select-css' style='min-width:400px;'>";
      $sql = "SELECT ".$col_descript." FROM ".$tbl_descript;
      $result = $conn->query($sql);
      $i=0;
      if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) { 
          $i=$i+1;
          if (!in_array($i,$sel_list)) {
            echo "<option value=".$i.">".$row[$col_descript]."</option>";
          }     
        }
      }  
      echo "</select>&nbsp";
      echo "</td></tr>";  
    }       

    function show_evidence($id, $desc, $e_loc, $e_des) {
      $table = "<table style='min-width:100%;'><tr><td style='min-width:200px;'>Location:&nbsp;&nbsp;&nbsp;&nbsp;</td><td class='browse_table'><label name='title' style='min-width:100%;min-height:50px;font-size:22px;'>".$e_loc."</label></td></tr><tr><td style='min-width:200px;'>Description:</td><td class='browse_table'><label name='title' style='min-width:100%;min-height:50px;font-size:22px;'>".$e_des."</label></td></tr></table>";
      echo "<tr><td></td><td class='browse_table_2'><div class='wrap-collabsible' id='evid_collap_".$id."'><input id='evid_".$id."' class='toggle' type='checkbox'><label for='evid_".$id."' class='lbl-toggle'>Evidence of ".$desc."</label><div class='collapsible-content'><div class='content-inner' style='font-size:22px;'>".$table."</div></div></input></div></td></tr>";      
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

    echo "<br><div class='article_details' style='".$show_art_prop."'>
    <center><u>Article Research Properties</u><br><br><table style='min-width:100%'>";
    properties_included('Subjects',3,'subject','subjects',$sel_sbj,$conn,'multiple','Subjects Included','Subjects Not Included'); 
    show_evidence("sub", "Subjects", $sub_evid_loc, $sub_evid_des);
    properties_included('Level of Detail',1,'detail_level','details',$sel_det,$conn,'single','Minimum Level of Detail Included','Other Levels of Detail');
    show_evidence("det", "Level of Detail", $det_evid_loc, $det_evid_des); 
    properties_included('Network Scale',1,'scale','network_scales',$sel_scl,$conn,'single','Network Scale Included','Other Network Scales');
    show_evidence("scl", "Network Scale", $scl_evid_loc, $scl_evid_des);
    properties_included('Implementation Level',1,'level','implementations',$sel_ipl,$conn,'single','Minimum Implementation Level Included','Other Implementation Levels'); 
    show_evidence("impl", "Implementation Level", $impl_evid_loc, $impl_evid_des);
    properties_included('Anatomical Region',3,'region','regions',$sel_rgn,$conn,'multiple','Anatomical Regions Included','Other Anatomical Regions'); 
    show_evidence("rgn", "Anatomical Region", $rgn_evid_loc, $rgn_evid_des);   
    properties_included('Theories',3,'category','theory_category',$sel_thy,$conn,'multiple','Theories Included','Theories Not Included');    
    show_evidence("thy", "Theories", $thy_evid_loc, $thy_evid_des);
    properties_included('Keywords',3,'keyword','keywords',$sel_kwd,$conn,'multiple','Keywords Included','Keywords Not Included');
    show_evidence("kwd", "Keywords", $kwd_evid_loc, $kwd_evid_des);
    echo "</table></div><br>";

    $conn->close();  

    ?></div></div><br>
  </div>
</body>
</html>