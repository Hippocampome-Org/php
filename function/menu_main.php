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
		<li class="topfirst"><a href="http://www.hippocampome.org/phpdev/morphology.php" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/news.png" alt="" id="image_news"/>Browse</span></a>
	
		<ul>
	
			<li class="subfirst"><a href="http://www.hippocampome.org/phpdev/morphology.php">Morphology</a></li>
        <li><a href="http://www.hippocampome.org/phpdev/markers.php">Molecular markers</a></li>
        <li><a href="http://www.hippocampome.org/phpdev/ephys.php">Membrane biophysics</a></li>
        <li><a href="http://www.hippocampome.org/phpdev/connectivity.php">Connectivity</a></li>
        <li><a href="http://www.hippocampome.org/phpdev/synaptome.php">Synaptic physiology</a></li>
         <!--?php 
          if ($permission != 1 && $_SESSION["fp"]==1) {
        ?-->
        <li><a href="http://www.hippocampome.org/phpdev/firing_patterns.php">Firing patterns</a></li>
         <!--?php   
          }
        ?--> 
          <!--?php 
          if ($permission != 1 && $_SESSION["im"]==1) {
        ?-->
        <li><a href="http://www.hippocampome.org/phpdev/Izhikevich_model.php">Izhikevich models</a></li>
        <!--?php   
          }
        ?--> 
        <li><a href="cognome/index.php">Cognome</a></li>        
        <li><a href="http://synapt.22web.org">Synaptome</a></li>
		</ul></li>
	
		<li class="topmenu"><a href="http://www.hippocampome.org/phpdev/search.php?searching=1" style="height:32px;line-height:32px;"><span><img src="function/menu_support_files/find.png" alt="" id="image_find"/>Search</span></a>
	
		<ul>
	
			<li><a href="http://www.hippocampome.org/phpdev/find_author.php?searching=1">Author</a></li>
			<li><a href="http://www.hippocampome.org/phpdev/find_neuron_name.php?searching=1">Neuron Name/Synonym</a></li>
			<?php
				if ($permission != 1 && $_SESSION["fp"]==1) {
			?>
			<li><a href="http://www.hippocampome.org/phpdev/find_neuron_fp.php?searching=1">Original Firing Pattern</a></li>
			<?php   
				}
			?> 
			<li><a href="http://www.hippocampome.org/phpdev/find_neuron_term.php?searching=1">Neuron Term (Neuron ID)</a></li>
			<li class="subfirst"><a href="http://www.hippocampome.org/phpdev/search.php?searching=1">Neuron Type</a></li>
			<li><a href="http://www.hippocampome.org/phpdev/find_pmid.php?searching=1">PMID/ISBN</a></li>
			<li><a href="http://www.hippocampome.org/phpdev/search_engine_custom.php">Search Engine</a></li>
	
		</ul></li>
	
		<li class="toplast"><a href="http://www.hippocampome.org/phpdev/help.php" style="height:32px;line-height:32px;"><img src="function/menu_support_files/help.png" alt=""/>Help</a>
		
		<ul>
		
		    <li><a href="http://www.hippocampome.org/phpdev/Help_Quickstart.php">Quickstart</a></li>
		    <li><a href="http://www.hippocampome.org/phpdev/Help_FAQ.php">FAQ</a></li>
		    <li><a href="http://www.hippocampome.org/phpdev/Help_Known_Bug_List.php">Known Bugs and Issues</a></li>
		    <li><a href="http://www.hippocampome.org/phpdev/user_feedback_form_entry.php">User Feedback Form</a></li>
		    <li><a href="http://www.hippocampome.org/phpdev/Help_Other_Useful_Links.php">Other Useful Links</a></li>
		    		
		</ul></li>
	
	</ul>
	</div>  

</body>
</html>
