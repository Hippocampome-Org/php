<!DOCTYPE html>
<html>
<head>
  <!--
    References: https://www.rexegg.com/regex-php.html
  -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="../main.css">
  <?php include('set_theme.php'); ?>
  <?php include('../function/hc_header.php'); ?>
</head>
<body>
  <?php include("../function/hc_body.php"); ?>
  <div style="width:90%;position:relative;left:5%;">
    <br><br>
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML='Literature Submission';
  </script>
  <!-- end of header -->    
  
  <?php
  include('mysql_connect.php');
  $sub_success='true';   

  $art_num=$_POST['new_art_numb'];
  $art_off_id=$_POST['art_off_id'];
  $art_mod_id=$art_num;
  
  function add_property($tbl,$row_name,$add_prop,$conn) {
    /*
      Adds literature property
    */
    $sql = "SELECT MAX(id) FROM natemsut_hctm.".$tbl.";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $prop_id = $row["MAX(id)"] + 1;
    $prop_name = $_POST[$add_prop];
    $sql = "INSERT INTO `natemsut_hctm`.`".$tbl."` (`id`, `".$row_name."`) VALUES ('".$prop_id."', '".$prop_name."');";
    $result = $conn->query($sql);
    echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><br>".$row_name." added: ".$prop_name."<br>
    <br><a href='mod_art.php'>Back to update articles collection page</a><br><br></div>";
  }

  function confirm_remove($tbl,$name,$rem_prop,$conn) {     
    /*
      Confirms if property should be removed
    */
    $prop_name = $_POST[$rem_prop];
    $sql = "SELECT id FROM natemsut_hctm.".$tbl." WHERE ".$name."='".$prop_name."';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
    echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><br>Are you sure you want to remove the following?<br><br>".$name.": ".$prop_name."<br>
    <br><form action='art_sub.php' method='POST'><input type='hidden' name='".$rem_prop."' value='".$_POST[$rem_prop]."' /><input type='hidden' name='confirm' value='yes' /><input type='submit' value='  yes  ' style='min-width:120px;min-height:40px;font-size:.9em;'/></form>
    &nbsp&nbsp&nbsp<form action='mod_art.php' method='POST'><input type='submit' value='  no  ' style='min-width:120px;min-height:40px;font-size:.9em;'/></form><br><br></div>";
  }

  function remove_property($tbl,$name,$rem_prop,$conn) {
    /*
      Removes literature property
    */    
    if (!isset($_POST['confirm'])) {    
      confirm_remove($tbl,$name,$rem_prop,$conn);
    }
    else if (isset($_POST['confirm']) && $_POST['confirm']== 'yes') {
      $prop_name = $_POST[$rem_prop];
      $sql = "SELECT id FROM natemsut_hctm.".$tbl." WHERE ".$name."='".$prop_name."';";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $prop_id = $row["id"];    
      $sql = "DELETE FROM `natemsut_hctm`.`".$tbl."` WHERE (`id` = '".$prop_id."');";
      $result = $conn->query($sql);
      echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><br>".$name." removed: ".$prop_name."<br>
      <br><a href='mod_art.php'>Back to update articles collection page</a><br><br></div>";
    }
  }

  // process research properties add/del or article del
  if (isset($_POST['remove_Article']) && $_POST['remove_Article']!= '') {
    remove_property('articles','citation','remove_Article',$conn);
  }  
  else if (isset($_POST['add_Subject']) && $_POST['add_Subject']!= '') {
    add_property('subjects','subject','add_Subject',$conn);
  }
  else if (isset($_POST['remove_Subject']) && $_POST['remove_Subject']!= '') {
    remove_property('subjects','subject','remove_Subject',$conn);    
  }  
  else if (isset($_POST['add_Detail']) && $_POST['add_Detail']!= '') {
    add_property('details','detail_level','add_Detail',$conn);
  }
  else if (isset($_POST['remove_Detail']) && $_POST['remove_Detail']!= '') {
    remove_property('details','detail_level','remove_Detail',$conn);    
  }  
  else if (isset($_POST['add_Implementation']) && $_POST['add_Implementation']!= '') {
    add_property('implementations','level','add_Implementation',$conn);
  }
  else if (isset($_POST['remove_Implementation']) && $_POST['remove_Implementation']!= '') {
    remove_property('implementations','level','remove_Implementation',$conn);    
  }        
  else if (isset($_POST['add_Theory']) && $_POST['add_Theory']!= '') {
    add_property('theory_category','category','add_Theory',$conn);
  }
  else if (isset($_POST['remove_Theory']) && $_POST['remove_Theory']!= '') {
    remove_property('theory_category','category','remove_Theory',$conn);
  }  
  else if (isset($_POST['add_Keyword']) && $_POST['add_Keyword']!= '') {
    add_property('keywords','keyword','add_Keyword',$conn);
  }
  else if (isset($_POST['remove_Keyword']) && $_POST['remove_Keyword']!= '') {
    remove_property('keywords','keyword','remove_Keyword',$conn);    
  }  
  else {

  // Check for existing property data
  $sel_sbj=array(); // subjects
  //$fnd_sbj=array(); // found subjects
  $sel_det=array(); // level of detail
  //$fnd_det=array();
  $sel_ipl=array(); // implementation level
  //$fnd_det=array();
  $sel_thy=array(); // theories
  //$fnd_thy=array();
  $sel_kwd=array(); // keywords   
  //$fnd_kwd=array();

  function chk_prop($sql, $conn, $tbl) {
    $matches=array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        array_push($matches,$row[$tbl]);
      }
    }    
    return $matches;
  }

  if ($art_mod_id!='') {
    $sql="SELECT subject_id FROM natemsut_hctm.article_has_subject WHERE article_id=".$art_mod_id;
    $tbl="subject_id";
    $sel_sbj=chk_prop($sql, $conn, $tbl);
    $sql="SELECT detail_id FROM natemsut_hctm.article_has_detail WHERE article_id=".$art_mod_id;
    $tbl="detail_id";
    $sel_det=chk_prop($sql, $conn, $tbl);
    $sql="SELECT level_id FROM natemsut_hctm.article_has_implmnt WHERE article_id=".$art_mod_id;
    $tbl="level_id";
    $sel_ipl=chk_prop($sql, $conn, $tbl);
    $sql="SELECT theory_id FROM natemsut_hctm.article_has_theory WHERE article_id=".$art_mod_id;
    $tbl="theory_id";
    $sel_thy=chk_prop($sql, $conn, $tbl);
    $sql="SELECT keyword_id FROM natemsut_hctm.article_has_keyword WHERE article_id=".$art_mod_id;
    $tbl="keyword_id";
    $sel_kwd=chk_prop($sql, $conn, $tbl);            
  }  

  function process_deletions($conn,$art_num,$tbl,$col,$old_entry,$new_entry) {
    /*
      Create any deletion of values
    */
    $verbose_comments=false;

    for ($i=0; $i<count($old_entry); $i++)
    { 
      if ($verbose_comments) {echo "<br>".$tbl." ".$col.": ".$old_entry[$i]."<br>";}
      if (!in_array($old_entry[$i],$new_entry)) {
        $sql = "SELECT id FROM natemsut_hctm.".$tbl." WHERE (`article_id` = '".$art_num."' AND `".$col."` = '".$old_entry[$i]."')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
          $row = $result->fetch_assoc();
          $del_id=$row["id"];
          if ($verbose_comments) {echo "<br>art_num:".$art_num."<br>del_id:<br>".$del_id."<br>".$sql."<br>";}          
          $sql = "DELETE FROM `natemsut_hctm`.`".$tbl."` WHERE (`id` = '".$del_id."')";
          $result = $conn->query($sql);            
          if ($verbose_comments) {echo "<br>deleted: ".$old_entry[$i]."<br>";}
        }
        if ($verbose_comments) {echo "<br>deleted: ".$sql."<br>";}
      }
      else {
        if ($verbose_comments) {echo "<br>not deleted: ".$old_entry[$i]."<br>";}
      }
    }
  }

  function process_additions($conn,$art_num,$tbl,$col,$old_entry,$new_entry) {
    /*
      Create any deletion of values
    */
    $verbose_comments=false;

    for ($i=0; $i<count($new_entry); $i++)
    {
      if ($verbose_comments) {echo "<br>".$tbl." ".$col.": ".$new_entry[$i]."<br>";}
      if (!in_array($new_entry[$i],$old_entry)) {
        $sql = "INSERT INTO `natemsut_hctm`.`".$tbl."` (`".$col."`, `article_id`) VALUES ('".$new_entry[$i]."', '".$art_num."');";
        $result = $conn->query($sql);
        if ($verbose_comments) {echo "<br>added: ".$new_entry[$i]."<br>";}
      }
      else {
        if ($verbose_comments) {echo "<br>not added: ".$new_entry[$i]."<br>";}
      }
    }   
  }

  // Check if article is existing one or new one
  $result = $conn->query("SELECT ID FROM natemsut_hctm.articles WHERE ID=".$art_num);
  if($result->num_rows == 0) { 
    // check for missing official id
    if($_POST['official_id'] == '') {
        echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><br>Error: missing official id description<br><br><a href='mod_art.php'>Back to update articles collection page</a><br><br></div>";
        exit();
    }
    // check for duplicate article
    $sql = "SELECT official_id FROM natemsut_hctm.articles WHERE official_id=\"".$art_off_id."\";";
    $result = $conn->query($sql);
    if($result->num_rows == 0 && $_POST['citation'] != '') {
      // submit article details
      $sql = "INSERT INTO `natemsut_hctm`.`articles` (`url`, `year`, `title`, `theory`, `modeling_methods`, `journal`, `citation`, `abstract`, `curation_notes`, `authors`, `official_id`, `inclusion_qualification`) VALUES (\"".$_POST['url']."\", \"".$_POST['year']."\", \"".$_POST['title']."\", \"".$_POST['theory']."\", \"".$_POST['modeling_methods']."\", \"".$_POST['journal']."\", \"".$_POST['citation']."\", \"".$_POST['abstract']."\", \"".$_POST['curation_notes']."\", \"".$_POST['authors']."\", \"".$_POST['art_off_id']."\", \"".$_POST['inclusion_qualification']."\");";
      $result = $conn->query($sql);

      // submit research properties
      if ($_POST['subjects']!='') {
        $subjects = $_POST['subjects'];
        for ($i=0; $i<count($subjects); $i++)
        {
          $sql = "INSERT INTO `natemsut_hctm`.`article_has_subject` (`subject_id`, `article_id`) VALUES ('".$subjects[$i]."', '".$_POST['new_art_numb']."');";
          $result = $conn->query($sql);
        }    
      }
      if ($_POST['details']!='') {
        $details = $_POST['details'];
        $sql = "INSERT INTO `natemsut_hctm`.`article_has_detail` (`detail_id`, `article_id`) VALUES ('".$details[0]."', '".$_POST['new_art_numb']."');";
        $result = $conn->query($sql);
      }
      if ($_POST['implmnts']!='') {
        $implmnts = $_POST['implmnts'];
        $sql = "INSERT INTO `natemsut_hctm`.`article_has_implmnt` (`level_id`, `article_id`) VALUES ('".$implmnts[0]."', '".$_POST['new_art_numb']."');";
        $result = $conn->query($sql);
      }
      if ($_POST['theories']!='') {
        $theories = $_POST['theories'];
        for ($i=0; $i<count($theories); $i++)
        {
          $sql = "INSERT INTO `natemsut_hctm`.`article_has_theory` (`theory_id`, `article_id`) VALUES ('".$theories[$i]."', '".$_POST['new_art_numb']."');";
          $result = $conn->query($sql);
        }    
      }
      if ($_POST['keywords']!='') {
        $keywords = $_POST['keywords'];
        for ($i=0; $i<count($keywords); $i++)
        {
          $sql = "INSERT INTO `natemsut_hctm`.`article_has_keyword` (`keyword_id`, `article_id`) VALUES ('".$keywords[$i]."', '".$_POST['new_art_numb']."');";
          $result = $conn->query($sql);
        }    
      }    
    } 
    else {
      // duplicate official id found
      $sub_success='false';
      echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><br>Article submission not successful";
      if ($_POST['citation'] != '') {
        echo " because article already exists in the database.<br>Existing article has official id ".$art_off_id." and url <a href='".$_POST['url']."' target='_blank'>".$_POST['url']."</a> .<br><br><a href='mod_art.php'>Back to update articles collection page</a><br><br></div>";
      }
      else {
        echo "<br>Error: missing citation description<br><br><a href='mod_art.php'>Back to update articles collection page</a><br><br></div>";
      }
    } 
  } 
  else {
    // existing article for modificiation detected
    $sql = "UPDATE `natemsut_hctm`.`articles` SET `url` = \"".$_POST['url']."\", `year` = \"".$_POST['year']."\", `title`= \"".$_POST['title']."\", `theory` = \"".$_POST['theory']."\", `modeling_methods` = \"".$_POST['modeling_methods']."\", `journal` = \"".$_POST['journal']."\", `citation` = \"".$_POST['citation']."\", `abstract` = \"".$_POST['abstract']."\", `curation_notes` = \"".$_POST['curation_notes']."\", `official_id` = \"".$_POST['art_off_id']."\", `authors` = \"".$_POST['authors']."\", `inclusion_qualification` = \"".$_POST['inclusion_qualification']."\" WHERE (`id` = ".$art_num.");";
    $result = $conn->query($sql);
    
    // submit research properties
    if ($_POST['subjects']!='') {
      $subjects = $_POST['subjects'];
      process_deletions($conn,$art_num,'article_has_subject','subject_id',$sel_sbj,$subjects);
      process_additions($conn,$art_num,'article_has_subject','subject_id',$sel_sbj,$subjects);  
    }
    if ($_POST['details']!='') {
      $det_lvl=$_POST['details'];
      process_deletions($conn,$art_num,'article_has_detail','detail_id',$sel_det,$det_lvl);
      process_additions($conn,$art_num,'article_has_detail','detail_id',$sel_det,$det_lvl); 
    }
    if ($_POST['implmnts']!='') {
      $impl_lvl=$_POST['implmnts'];
      process_deletions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);
      process_additions($conn,$art_num,'article_has_implmnt','level_id',$sel_ipl,$impl_lvl);       
    }
    if ($_POST['theories']!='') {
      $theories = $_POST['theories'];  
      process_deletions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);
      process_additions($conn,$art_num,'article_has_theory','theory_id',$sel_thy,$theories);       
    }
    if ($_POST['keywords']!='') {
      $keywords = $_POST['keywords'];   
      process_deletions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);
      process_additions($conn,$art_num,'article_has_keyword','keyword_id',$sel_kwd,$keywords);        
    }
  }

  if ($sub_success=='true') {
    echo "<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:1em;'><br>Literature collection update successful.<br>
    <br><a href='mod_art.php'>Back to update articles collection page</a><br><br></div>";
  }

  }

  $conn->close();

  ?></center></table>
</div></div><br>
</div>
</body>
</html>