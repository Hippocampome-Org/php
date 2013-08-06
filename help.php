<?php
session_start();
include ("access_db.php");

$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
?>

<head>
<title>Help</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php include ("function/title.php"); ?>

<div id="menu_main_button_new">

	<form action="index.php" method="post" style='display:inline'>
		<input type="submit" name='index' value='Home' class="main_button"/> 
	</form>
	<form action="morphology.php" method="post" style='display:inline'>
		<input type="submit" name='browsing' value='Browse' class="main_button"/>
	</form>
	<form action="search.php" method="post" style='display:inline' target="_blank">
		<input type="submit" name='searching' value='Search' class="main_button" />
	</form>
		
</div>
		
<div class='sub_menu'>
	
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="left">
			<font class='font1'><em>Morphology:</em></font> &nbsp; &nbsp;
			<ul> 
			<li><a href='Help_Morphological_Abbreviations.php' target="_blank"><font class="font7"> Abbreviations</font></a></li>
  			<li><a href='Help_Morphological_Bibliographic_Protocols.php' target="_blank"><font class="font7"> Bibliographic Protocols</font></a></li>
  			<li><a href='Help_Morphological_Interpretations_Brief.php' target="_blank"><font class="font7"> Interpretations (Brief)</font></a>
  			<li><a href='Help_Morphological_Interpretations_Full.php' target="_blank"><font class="font7"> Interpretations (Full)</font></a></li>
			</ul>
			
			<font class='font1'><em>Molecular markers:</em></font> &nbsp; &nbsp;
			<ul>
			<li><a href='Help_Marker_Abbreviations.php' target="_blank"><font class="font7"> Abbreviations</font></a></li>
			</ul>
			
			<font class='font1'><em>Electrophysiology:</em></font> &nbsp; &nbsp;
			<ul>
  			<li><a href='Help_Electrophysiological_Abbreviations_and_Definitions.php' target="_blank"><font class="font7"> Abbreviations and Definitions</font></a></li>
			</ul>
			
			<font class='font1'><em>Connectivity:</em></font> &nbsp; &nbsp;			
			<ul>
			<li><a href='Help_Connectivity.php' target="_blank"><font class="font7"> Definitions and Protocols</font></a></li>  			
			</ul>
			
			<font class='font1'><em>Miscellaneous:</em></font> &nbsp; &nbsp;			
			<ul>
  			<li><a href='Help_In_Progress.php' target="_blank"><font class="font7"> In Progress ...</font></a></li>
  			<li><a href='Help_Release_Notes.php' target="_blank"><font class="font7"> Release Notes</font></a></li>
  			<li><a href='Hippocampome_Video_Overview/Hippocampome_Video_Overview_player.html' target="_blank"><font class="font7"> Hippocampome Video Overview</font></a></li>
  			<li><a href='Help_Other_Useful_Links.php' target="_blank"><font class="font7"> Other Useful Links</font></a></li>
  			<li><a href='Help_Acknowledgements.php' target="_blank"><font class="font7"> Acknowledgements</font></a></li>
			</ul>
						
		</td>
	</tr>
	</table>
	<br />
</div>	

</body>

</html>
