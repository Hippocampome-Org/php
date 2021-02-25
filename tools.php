<?php
  include ("permission_check.php");
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google Analytics Tracking -->  
<?php include_once("analytics.php") ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hippocampome.org Tools</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>
<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>	
<br>
<div class='title_area' style="position:absolute; top:80px; left:30%;width:500px;">
	<br>
	<center><font class="font1"><u>Hippocampome.org Tools</u></font></center>
</div>
<div style="position:absolute; top:145px; left:30%;width:500px;">	
		<font class='font1a'><u>Synapse Probabilities</u></font> &nbsp; &nbsp;
		<ul> 
			<li><a href='connprob.php'><font class="font7"> Calculate Synaptic Connection Probabilities</font></a></li>
			</ul>
			
		<font class='font1a'><u>Synaptic Physiology</u></font> &nbsp; &nbsp;
		<br>
		<span style='position:relative;top:10px'><span style='position:relative;left:23px'><font class="font7">The convergence of a four-state and a three-state formalism of a synaptic plasticity model in the <a href='https://senselab.med.yale.edu/modeldb/ShowModel?model=266934'>NEURON Simulation Environment</a></font></span>
		<ul> 
		<span style='position:relative;left:23px'><li><a href='#'><font class="font7"> Synapse Modeling Utility and Trace Reconstructor</font></a></li></span>
		<br>
		<li><a href='#'><font class="font7"> Program plus Digitized Traces and Optimization Results</font></a></li>
		<br>
		<li><a href='https://github.com/k1moradi/SynapseModelingUtility'><font class="font7"> GitHub page</font></a></li>
		<br>
		<li><a href='#'><font class="font7"> Machine Learning Library and Preprocessed Data</font></a></li>
		</span>
		</ul>	
	<br />
</div>
</body>
</html>
