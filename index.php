<?php
include ("access_db.php");



echo ("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">");

include ("simphp-2.0.php");
$_SESSION['perm'] = 0;
$permission1 = $_SESSION['perm'];

if (array_key_exists('password', $_REQUEST))
{
  $query = "SELECT permission FROM user WHERE password = '{$_REQUEST['password']}'";
  $rs = mysql_query($query);
  while(list($permission) = mysql_fetch_row($rs))
  {
    if ($permission == 1)
    {	
      $permission1 = $permission;
      $_SESSION['perm'] = $permission1;
      
    }	
    else;
  }
}
// delete temporary table for the research: -----------------
include ("function/remove_table_research.php");
remove_table_by_tyme();
// ------------------------------------------------------------
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="style/resolution.js"></script>

<!--  
<script type="text/javascript" src="jqGrid/js/jquery-1.8.3.js"></script>-->
<script type="text/javascript" src="jqGrid/js/jquery-1.7.2.min.js"></script>
<!-- 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">-->

</script>

<style>
#dvLoading{
background:#000 url(images/ajax-loader.gif) no-repeat center center;
  height: 100px;
  width: 100px;
  position: fixed;
  z-index: 1000;
  left: 50%;
   top: 50%;
  margin: -25px 0 0 -25px;
}

</style>

<script>

$(window).load(function(){

	  $('#dvLoading').fadeOut(0);

	});



jQuery(document).ready(function(){
//$( "#image_brain" ).load(function() {
//$( "#submit_load" ).click(function() {	
$( "#form_load" ).mouseover(function() {	
	  // Handler for .load() called.
//alert("in");

	$.ajax({
	    crossDomain: true,
	  type: "POST",
	 async: false,
	 // data:input,
	 contentType:"application/json; charset=utf-8",
	  url:"http://localhost/php_new/load_matrix_session_morphology.php",
	//  dataType: 'jsonp',
	  success: function(output_string) {
 	//	alert(output_string);
	     
	   },
	   error: function(xhr, status, error) {
		   var err = eval("(" + xhr.responseText + ")");
		   alert(err.Message);
		 }
	   
	}); 

	$(this).unbind("mouseover");
	
	
});


//$( "#image_news").load(function() {
//	$( "#submit_load").click(function() {
	$( ".topfirst").mouseover(function() {
	  // Handler for .load() called.
//alert("in");

	$.ajax({
	    crossDomain: true,
	  type: "POST",
	 async: false,
	 // data:input,
	 contentType:"application/json; charset=utf-8",
	  url:"http://localhost/php_new/load_matrix_session_ephys.php",
	//  dataType: 'jsonp',
	  success: function(output_string) {
	//alert(output_string);
	     
	   },
	   error: function(xhr, status, error) {
		   var err = eval("(" + xhr.responseText + ")");
		   alert(err.Message);
		 }
	   
	}); 

	$(this).unbind("mouseover");
	
});


$( "#image_find").load(function() {
	  // Handler for .load() called.
//alert("in");

	$.ajax({
	    crossDomain: true,
	  type: "POST",
	 async: false,
	 // data:input,
	 contentType:"application/json; charset=utf-8",
	  url:"http://localhost/php_new/load_matrix_session_markers.php",
	//  dataType: 'jsonp',
	  success: function(output_string) {
	//alert(output_string);
	     
	   },
	   error: function(xhr, status, error) {
		   var err = eval("(" + xhr.responseText + ")");
		   alert(err.Message);
		 }
	   
	}); 


	
});







});

/*

			function load_matrices() {
		  // Handler for .load() called.
	//alert("in");

		$.ajax({
		    crossDomain: true,
		  type: "POST",
		 async: false,
		 // data:input,
		 contentType:"application/json; charset=utf-8",
		  url:"http://localhost/php_new/load_matrix_sessions.php",
		//  dataType: 'jsonp',
		  success: function(output_string) {
//		alert(output_string);
		     
		   },
		   error: function(xhr, status, error) {
			   var err = eval("(" + xhr.responseText + ")");
			   alert(err.Message);
			 }
		   
		}); 
}

*/		
	



</script>



<?php include ("function/icon.html"); ?>
<title id="title_id">Hippocampome</title>

</head>

<body onload="AjaxFunction()">

<?php 
	include ("function/title.php");
	if ($permission1 != 0)
	{
		include ("function/menu_main.php");
		
	}
?>	

<br /><br /><br /><br /><br /><br /><br />

<table width=1100 class='index_table' id="table_load">
  <tr>		
    <td width="55%">
    <!-- ****************  BODY **************** -->
      <font class='font1' color='#000000'>
      WELCOME TO THE HIPPOCAMPOME PORTAL
      </font>
      <BR>
      <font class='font2' color='#000000'>
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
      *** Please note: This is an alpha-testing site.  The content is
      still being vetted for accuracy and has not yet undergone peer-review.
      As such, it may contain inaccuracies and should not (yet) be trusted
      as a scholarly resource.  The content does not yet appear uniformly
      across all combinations of browsers and screen resolutions.
      <br><br>
      If you have feedback on either functionality or content, or if you
      would like to be informed when the first official version is released,
      please email us at <a href="mailto:Hippocampome.org@gmail.com">Hippocampome.org@gmail.com</a>.

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

    <td width="45%" style='vertical-align:top; padding-top:100px; padding-left:50px'>
      <img src='images/brain6.png' width='450px' id="image_brain"/>
    </td>
  </tr>

  <tr>
    <td colspan="2">
        <!--			<div class='version'> -->
        <div class='version2'>
          <!--	<a href='http://peg.gd/2yN' target="_blank">http://peg.gd/2yN</a> -->
          <br><br>
          <hr class='hr2'/>
          <font class='font3' color='#000000'>
            NOTICE: Non-licensed copyrighted content that may be incorporated into this not-for-profit, educational web portal was vetted using the "fair use" criteria defined in <a href="http://www.copyright.gov/title17/92chap1.html#107" target="_blank">Title 17 of the U.S. Code, § 107</a>. This content, cited throughout this portal, may be protected by Copyright Law and unavailable for reuse.  Except otherwise noted, this web portal is &copy; 2013 by George Mason University, under a <a href =' http://creativecommons.org/licenses/by-sa/3.0/' target="_blank">Creative Commons Attribution-ShareAlike [CC BY-SA] license</a>. 

          <br /><p><? echo $info; ?>
          <br />Last Update: 9 July 2013 (<a href="Help_Release_Notes.php">v1.0&alpha; R 3B</a>)</font>
          <br />
        </div>
    </td>		
  </tr>
</table>


<!-- 
<div id="dvLoading"></div>
-->



</body>
<?php
/*
if($_SESSION['perm']!=0)
{
	include 'getMorphology.php';
	$_SESSION['morphology'] = json_encode($responce);
	include 'getMarkers.php';
	$_SESSION['markers'] = json_encode($responce);
	include 'getEphys.php';
	$_SESSION['ephys'] = json_encode($responce);
}
*/
?>
</html>
