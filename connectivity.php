<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
	
include ("access_db.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.epdata.php');

$type = new type($class_type);
$type -> retrive_id();
$number_type = $type->getNumber_type();

$property = new property($class_property);

$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Connectivity Matrix</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php include ("function/title.php"); ?>

	<div id="menu_main_button_new">
	<form action="index.php" method="post" style='display:inline'>
		<input type="submit" name='index' value='Home' class="main_button"/> 
	</form>
	<form action="search.php" method="post" style='display:inline' target="_blank">	
		<input type="submit" name='searching' value='Search' class="main_button" /> 
	</form>			
	<form action="help.php" method="post" style='display:inline' target="_blank">
		<input type="submit" name='help' value='Help' class="main_button"/>
	</form>
	</div>
		
<div class='sub_menu'>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<a href='morphology.php'><font class="font7">Morphology</font></a> <font class="font7_A">|</font> 
			<a href='markers.php'><font class="font7">Molecular Markers</font></a> <font class="font7_A">|</font> 
			<a href='ephys.php'><font class="font7">Electrophysiology</font></a><font class="font7_A">|</font> 
			<font class="font7_B">Connectivity</font>
		</td>
	</tr>
	</table>
</div>
<!-- ------------------------ -->

<div class="table_position">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="30">
    <td></td>
  </tr>
  <tr>
    <td>
		<!-- ****************  BODY **************** -->

		<font class='font1'>Connectivity matrix</font>
		<br />
		<font class='font5'><strong>Legend:</strong> </font>&nbsp; &nbsp;
		<img src='images/connectivity/excitatory.png' width="13px" border="0"/> <font class='font5'>
							Potential Excitatory Non-PCL Connection </font> &nbsp; &nbsp; 
		<img src='images/connectivity/inhibitory.png' width="13px" border="0"/> <font class='font5'>
							Potential Inhibitory Non-PCL Connection </font>&nbsp; &nbsp; 
		<img src='images/connectivity/PCL_only.png' width="13px" border="0"/> <font class='font5'>
							Potential PCL-Only Connection </font>&nbsp; &nbsp;
		<br />
		
		<font class='font5'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </font> 
		<img src='images/connectivity/AIS_targeting.png' width="13px" border="0"/> <font class='font5'>
							PCL AIS Connection </font>&nbsp; &nbsp; 	
		<img src='images/connectivity/perisomatic_targeting.png' width="13px" border="0"/> <font class='font5'>
							PCL Perisomatic Connection </font>&nbsp; &nbsp; 						
		<img src='images/connectivity/known_connection.png' width="13px" border="0"/> <font class='font5'>
							Known Connection </font>&nbsp; &nbsp; 
		<img src='images/connectivity/known_nonconnection.png' width="13px" border="0"/> <font class='font5'>
							Known Non-Connection </font>&nbsp; &nbsp; 
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>PCL = Principal Cell Layer &nbsp; &nbsp; &nbsp; &nbsp; AIS = Axon Intial Segment</font>
		<br />
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>This matrix is not yet interactive.</font>

		<!--<img src='images/connectivity/PCL_overlap.png' width="13px" border="0"/> <font class='font5'>
							PCL Axon-Soma Overlap </font>&nbsp; &nbsp;   --> 
		
		<br />
		<!-- <iframe src='connectivity2.php' width='960px' height='650px' frameborder='0' scrolling='auto' name='body'></iframe> -->
		<!-- <img src="images/connectivity/connectivity/Connectivity_Matrix.jpg" width="80%"/> -->
		<img src="images/connectivity/Connectivity_Matrix.jpg"/ width="1500px">
		
		
	</td>
  </tr>
</table>
</body>
</html>
