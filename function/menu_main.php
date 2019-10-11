<!-- <%@LANGUAGE="JAVASCRIPT" CODEPAGE="1252"%> -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<link rel="stylesheet" href="function/menu_support_files/menu_main_style.css" type="text/css" />
<title></title>
<?php
$query = "SELECT permission FROM user WHERE id=2"; // id=2 is anonymous user
$rs = mysqli_query($conn,$query);
list($permission) = mysqli_fetch_row($rs);
session_start();
?>
</head>

<body>

	<div id="menu_main_button_new_clr">

	<ul id="css3menu0" class="topmenu">
		<li class="topfirst"><a href="morphology.php" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/news.png" alt="" id="image_news"/>Browse</span></a>
	
		<ul>
	
			<li class="subfirst"><a href="morphology.php">Morphology</a></li>
			<li><a href="markers.php">Molecular markers</a></li>
            <li><a href="ephys.php">Membrane biophysics</a></li>
            <li><a href="connectivity.php">Connectivity</a></li>
            <li><a href="synaptome.php">Synaptic physiology</a></li>
	        <li><a href="firing_patterns.php">Firing patterns</a></li>
	        <li><a href="Izhikevich_model.php">Izhikevich models</a></li>
	         <?php 
            if ($permission != 1 && $_SESSION["sy"]==1) {
          ?>
          <li><a href="synapse_probabilities.php">Synapse probabilities</a></li>
          <?php   
            }
          ?> 
	        <?php 
	          if ($permission != 1 && $_SESSION["cg"]==1) {
	        ?>
	        <li><a href="http://hc.22web.org">Cognome</a></li>
	         <?php   
	          }
	        ?> 
	          <?php 
	          if ($permission != 1 && $_SESSION["sp"]==1) {
	        ?>
	        <li><a href="http://synapt.22web.org">Synaptome</a></li>
	        <?php   
	          }
	        ?> 
		</ul></li>
	
		<li class="topmenu"><a href="search.php?searching=1" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/find.png" alt="" id="image_find"/>Search</span></a>
	
		<ul>
	
			<li><a href="find_author.php?searching=1">Author</a></li>
			<li><a href="find_neuron_name.php?searching=1">Neuron Name/Synonym</a></li>
			<li><a href="find_neuron_fp.php?searching=1">Original Firing Pattern</a></li>
			<li><a href="find_neuron_term.php?searching=1">Neuron Term (Neuron ID)</a></li>
			<li class="subfirst"><a href="search.php?searching=1">Neuron Type</a></li>
			<li><a href="find_pmid.php?searching=1">PMID/ISBN</a></li>
			<li><a href="search_engine_custom.php">Advanced Search</a></li>
	
		</ul></li>
	
		<li class="toplast"><a href="help.php" style="height:32px;line-height:32px;"><img src="function/menu_support_files/help.png" alt=""/>Help</a>
		
		<ul>
		
		    <li><a href="Help_Quickstart.php">Quickstart</a></li>
		    <li><a href="Help_FAQ.php">FAQ</a></li>
		    <li><a href="Help_Known_Bug_List.php">Known Bugs and Issues</a></li>
		    <li><a href="user_feedback_form_entry.php">User Feedback Form</a></li>
		    <li><a href="Help_Other_Useful_Links.php">Other Useful Links</a></li>
		    		
		</ul></li>
	
	</ul>
	</div>  

</body>
</html>
