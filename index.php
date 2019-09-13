<?php
  include ("access_db.php");
  include ("page_counter.php");  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<?php
/* include("simphp-2.0.php"); */

//-------user login required check----------
$_SESSION['perm'] = 0;
$_SESSION['fp']=0;
$_SESSION['if']=0;
$_SESSION['im']=0;
$query = "SELECT permission FROM user WHERE id=2"; // id=2 is anonymous user
$rs = mysqli_query($conn,$query);
list($permission) = mysqli_fetch_row($rs);
if ($permission == 1) { 
  $_SESSION['perm'] = 1;
}
else{
  $_SESSION['perm'] = 0;
}
//-------------------------------------------
//$_SESSION['perm'] = 0;
$permission1 = $_SESSION['perm'];
if ($_SESSION['perm'] == 0) {
  if (array_key_exists('password', $_REQUEST)) {
    $query = "SELECT permission FROM user WHERE password = '{$_REQUEST['password']}'";
    $rs = mysqli_query($conn,$query);
    while(list($permission) = mysqli_fetch_row($rs)) {
      if ($permission == 1) { 
        $permission1 = $permission;
        $_SESSION['perm'] = $permission1;
      }
      else;
    }
      $query = "SELECT permission FROM user WHERE id=3";
      $rs = mysqli_query($conn,$query);
      while(list($permission) = mysqli_fetch_row($rs)) {
          if ($permission == 1) {
              $_SESSION['fp']=1;
          }
      }
      $query = "SELECT permission FROM user WHERE id=4";
      $rs = mysqli_query($conn,$query);
      while(list($permission) = mysqli_fetch_row($rs)) {
          if ($permission == 1) {
              $_SESSION['if']=1;
          }
      }
      $query = "SELECT permission FROM user WHERE id=5";
      $rs = mysqli_query($conn,$query);
      while(list($permission) = mysqli_fetch_row($rs)) {
          if ($permission == 1) {
              $_SESSION['im']=1;
          }
      }
  }
}
// delete temporary table for the research: -----------------
include("function/remove_table_research.php");
remove_table_by_tyme();
// ------------------------------------------------------------
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="style/resolution.js"></script>
<link rel="stylesheet" href="function/menu_support_files/menu_main_style.css" type="text/css" />
<script src="jqGrid-4/js/jquery-1.11.0.min.js" type="text/javascript"></script>

<style type="text/css">
#dvLoading {
  background-image: url(images/ajax-loader.gif);
  background-repeat: no-repeat;
  background-position: center;
  height: 100px;
  width: 100px;
  position: fixed;
  z-index: 1000;
  left: 70%;
  top: 15%;
  margin: -25px 0 0 -25px;
}
</style>

<script>
jQuery(document).ready(function() {
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_markers.php',
    success: function() {}
  }); 
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_ephys.php',
    success: function() {}
  }); 
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_morphology.php',
    success: function() {}
  });
  $.ajax({
      type: 'GET',
      cache: false,
      contentType: 'application/json; charset=utf-8',
      url: 'load_matrix_session_connectivity.php',
      success: function() {}
    });
	$.ajax({
		type: 'GET',
		cache: false,
		contentType: 'application/json; charset=utf-8',
		url: 'load_matrix_session_firing.php',
		success: function() {}
  });
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_firing_parameter.php',
    success: function() {}
  });
  $('div#menu_main_button_new_clr').css('display','block');
});
</script>

<?php
include("function/icon.html");
?>

<title id="title_id">Hippocampome</title>

</head>

<body>

<?php 
include("function/title.php");
if ($permission1 != 0) {
?>
<div id="menu_main_button_new_clr" style="display:none;">
  <ul id="css3menu0" class="topmenu">
    <li class="topfirst"><a href="morphology.php" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/news.png" alt="" id="image_news"/>Browse</span></a>
      <ul>
        <li class="subfirst"><a href="morphology.php">Morphology</a></li>
        <li><a href="markers.php">Molecular markers</a></li>
        <li><a href="ephys.php">Membrane biophysics</a></li>
        <li><a href="connectivity.php">Connectivity</a></li>
        <li><a href="synaptome.php">Synaptic physiology</a></li>
         <?php 
          if ($permission != 1 && $_SESSION["fp"]==1) {
        ?>
        <li><a href="firing_patterns.php">Firing patterns</a></li>
         <?php   
          }
        ?> 
          <?php 
          if ($permission != 1 && $_SESSION["im"]==1) {
        ?>
        <li><a href="Izhikevich_model.php">Izhikevich models</a></li>
        <?php   
          }
      ?> 
      </ul>
    </li>
    <li class="topmenu"><a href="search.php?searching=1" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/find.png" alt="" id="image_find"/>Search</span></a>
      <ul>
        <li><a href="find_author.php?searching=1">Author</a></li>
        <li><a href="find_neuron_name.php?searching=1">Neuron Name/Synonym</a></li>
        <?php 
          if ($permission != 1 && $_SESSION["fp"]==1) {
        ?>
        <li><a href="find_neuron_fp.php?searching=1">Original Firing Pattern</a></li>
        <?php   
          }
        ?> 
        <li><a href="find_neuron_term.php?searching=1">Neuron Term (Neuron ID)</a></li>
        <li class="subfirst"><a href="search.php?searching=1">Neuron Type</a></li>
        <li><a href="find_pmid.php?searching=1">PMID/ISBN</a></li>
        <li><a href="search_engine_custom.php">Advanced Search</a></li>
      </ul>
    </li>
    <li class="toplast"><a href="help.php" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/help.png" alt=""/>Help</span></a>
      <ul>
        <li><a href="Help_Quickstart.php">Quickstart</a></li>
        <li><a href="Help_FAQ.php">FAQ</a></li>
        <li><a href="Help_Known_Bug>List.php">Known Bugs and Issues</a></li>
        <li><a href="user_feedback_form_entry.php">User Feedback Form</a></li>
        <li><a href="Help_Other_Useful_Links.php">Other Useful Links</a></li>
      </ul>
    </li>
  </ul>
</div>  
<?php   
}
?>  
<script>
jQuery(document).ready(function() {
  $("#menu_main_button_new_clr").css("diplay","none");
});
</script>

<br /><br /><br /><br /><br /><br /><br />

<table width=1100 class='index_table' id="table_load">
  <tr>    
    <td width="50%">
    <!-- ****************  BODY **************** -->
      <font class='font1' color='#000000'>
      WELCOME TO THE HIPPOCAMPOME PORTAL
      </font>
      <BR>
      <font class='font2' color='#000000'>
      v1.5 - Released: 09/06/2019
      <br>
      19,598 Pieces of Knowledge (PoK) and 29,848 Pieces of Evidence (PoE)
      <br>
      <br>
      The Hippocampome is a curated knowledge base of the circuitry
      of the hippocampus of normal adult, or adolescent, rodents at
      the mesoscopic level of neuronal types. Knowledge concerning
      dentate gyrus, CA3, CA2, CA1, subiculum, and entorhinal cortex
      is distilled from published evidence and is continuously updated
      as new information becomes available. Each reported neuronal
      property is documented with a pointer to, and excerpt from,
      relevant published evidence, such as citation quotes or illustrations.
      <br><br>
      The goal of the Hippocampome is dense coverage of available data
      characterizing neuronal types. The Hippocampome is a public and
      free resource for the neuroscience community, and the knowledge
      is presented for user-friendly browsing and searching and for
      machine-readable downloading.
      <br><br>
      If you have feedback on either functionality or content, or if you
      would like to be informed when the first official version is released,
      please fill out the
      <a href="user_feedback_form_entry.php">feedback form</a>
      or email us at
      <a href="mailto:Hippocampome.org@gmail.com">Hippocampome.org@gmail.com</a>.
      <br><br>
      The release of v1.0 on 09/23/2015 includes 3,697 PoK and 13,888 PoE. Reference: <b>Wheeler et al., 2015</b>.
      <a href="http://elifesciences.org/content/4/e09960">
      <i>Hippocampome.org: A knowledge base of neuron types in the rodent hippocampus</i></a>.
      eLife 2015;4:e09960.
      <br><br>
      The release of v1.1 on 10/17/2016 includes 3,697 PoK, 13,888 PoE, and the Neuron Term Portal, which allows one to view definitions for 
      terms and phrases used on this website. Reference: <b>Hamilton et al., 2016</b>
      <a href="http://link.springer.com/article/10.1007/s40708-016-0053-3">
      <i>Name-calling in the hippocampus (and beyond): coming to terms with neuron types and properties</i></a>.
      Brain Informatics (2016); doi:10.1007/s40708-016-0053-3.
      <br><br>
      The release of v1.2 on 11/06/2016 includes 3,936 PoK, 14,399 PoE, and a clickable Connectivity Matrix, an interactive Connectivity Navigator, and the
      ability to Search by Connectivity. Reference: <b>Rees et al., 2016</b>
      <a href="http://www.eneuro.org/content/3/6/ENEURO.0205-16.2016">
      <i>Graph theoretic and motif analyses of the hippocampal neuron type
      potential connectome</i></a>. eNeuro Nov 2016, ENEURO.0205-16.2016; DOI: 10.1523/ENEURO.0205-16.2016.
      </font>

      <br><br>

      <?php
        if ($permission1 == 0) {
      ?>

      <form action="index.php" method="post" id="form_load">
        <font class='font2'> Please insert password: </font><br />
        <input type="password" size="50" name='password' class='select1' id="password_load"/>
        <input type="submit" name='ok' value=' OK ' id="submit_load"/>
      </form>

      <?php
        }
        else;
      ?>

      <br>
    </td>

    <td width="50%" style='vertical-align:top; padding-top:0px; padding-left:50px'>
      <img src='images/brain6.png' width='450px' id="image_brain"/>
      <font class='font2' color='#000000'>
      <br><br><br>
      The release of v1.3 on 06/30/2017 includes 10,822 PoK, 21,285 PoE, and a downloadable list of Allen Brain Atlas (ABA) predictions of marker
      expressions and a utility for viewing the effects of thresholds on ABA marker expression predictions.
      Reference: <b>Hamilton et al., 2017</b>
      <a href = "http://www.sciencedirect.com/science/article/pii/S073170851730794X">
      <i>Molecular fingerprinting of principal neurons in the rodent hippocampus: a neuroinformatics approach.</i></a>
      Journal of Pharmaceutical and Biomedical Analysis 2017 Sep 10;144:269-278; doi: 10.1016/j.jpba.2017.03.062.
      <br><br>
      The release of v1.4 on 08/15/2019 includes an additional 7,946 PoK, 8,486 PoE, and the ability to
      access the Synapse Knowledge Base.
      Reference: <b>Moradi and Ascoli, 2019</b>
      <a href = "https://doi.org/10.1002/hipo.23148">
      <i>A comprehensive knowledge base of synaptic electrophysiology in the rodent hippocampal formation.</i></a>
      Hippocampus 2019 (in press); doi: https://doi.org/10.1002/hipo.23148.
      <br><br>
      <b>*NEW*</b> The release of v1.5 on 09/06/2019 includes an additional 830 PoK, 77 PoE, and relational
      expression inferences in the knowledge base.
      Reference: <b>White, et al., 2019</b>
      <a href = "https://www.biorxiv.org/content/10.1101/633883v1">
      <i>Molecular Expression Profiles of Morphologically Defined Hippocampal Neuron Types: Empirical Evidence and
      Relational Inferences.</i></a>
      Hippocampus 2019 (in press); doi: https://doi.org/10.1101/633883.
      </font>
    </td>
  </tr>

  <tr>
    <td colspan="2">
        <!--      <div class='version'> -->
        <div class='version2'>
          <!--  <a href='http://peg.gd/2yN' target="_blank">http://peg.gd/2yN</a> -->
          <hr class='hr2'/>
          <font class='font3' color='#000000'>
          <a href="Help_Terms_of_Use.php">Terms of Use</a>
          <br><br>
            NOTICE: Non-licensed copyrighted content that may be incorporated into this not-for-profit, educational web
            portal was vetted using the "fair use" criteria defined in
            <a href="http://www.copyright.gov/title17/92chap1.html#107" target="_blank">Title 17 of the U.S. Code,
            &sect; 107</a>. This content, cited throughout this portal, may be protected by Copyright Law and unavailable
            for reuse.  Except otherwise noted, this web portal is &copy; 2015-2019 by George Mason University, under a
            <a href =' http://creativecommons.org/licenses/by-sa/3.0/' target="_blank">Creative Commons
            Attribution-ShareAlike [CC BY-SA] license</a>. 

          <!-- <br /><p><?php echo $info; ?> -->
          <br /><p><?php $webpage_id_number = 1; include('report_hits.php'); ?>
          <br>
          19,598 Pieces of Knowledge (PoK) and 29,848 Pieces of Evidence (PoE)
          <br />Last Update: 06 Sep 2019 (<a href="Help_Release_Notes.php">v1.5</a>)</font>
          <br />
        </div>
    </td>   
  </tr>
</table>

</body>

</html>
