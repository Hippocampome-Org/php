<?php include ("permission_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
  <?php include('function/hc_header.php'); ?>
</head>
<body>
  <?php include("function/hc_body.php"); ?> 
  <div style="width:90%;position:relative;left:5%;">
  <br><br>
  <!-- start of header -->
  <?php echo file_get_contents('header.html'); ?>
  <script type='text/javascript'>
    document.getElementById('header_title').innerHTML='Queries selected for article annotations';
  </script>
  <!-- end of header -->

<div class='article_details' style='text-align: center;margin: 0 auto;padding: .4rem;font-size:.9em;'>
	<span style='font-size:18px;text-align:left'>This is the list of queries selected which were generated by the optimization software. They had the most preferable balance of matching articles of interest as well as resulting in useful total a number of articles to review given time needed for reviewing. The queries were intentially designed to allow for an equal chance of any entity within a region, neural activity, or model group to appear in the article results returned.</span>
	<br>
	<br>
	<span style='font-size:20px;text-align:left'>Query template:
<br>&#60;region&#62; and &#60;neural activity&#62 and &#60;model&#62, where &#60;...&#62 is a keyword category</span>
<br>
<br>
<table style='font-size:16px;text-align:left'>
<tr><td style='text-align:center'>Final query selection</td><td style='text-align:center'>DB</td></tr>
<tr><td>Q1. (hippocampal OR hippocampus OR CA3 OR "entorhinal cortex" OR CA1 OR "dentate gyrus" OR CA2 OR subiculum) AND (network OR firing OR spiking OR circuit) AND (model OR computational OR simulation)<br><br></td><td>Google Scholar</td></tr>
<tr><td>Q2. ("hippocampus" OR "hippocampal" OR "entorhinal cortex" OR "CA1" OR "CA2" OR "CA3" OR "dentate gyrus" OR "subiculum") AND ("neural network" OR "network-level" OR "spiking" OR "firing" OR "circuit" ) AND ("computational" OR "simulation" OR "in silico")<br><br></td><td>Google Scholar</td></tr>
<tr><td>Q3. (CA3 OR "entorhinal cortex" OR CA1 OR "dentate gyrus" OR CA2 OR subiculum OR "medial temporal lobe") AND (spikes OR "activity pattern" OR "firing rates" OR "firing fields" OR "spiking activity") AND ("computation" OR "simulate" OR "neural model" OR "computations" OR "modeled" OR "computer model" OR "algorithm" OR "biologically realistic model" OR "computationally" OR "modelling" OR "neurocomputational model")<br><br></td><td>Pubmed</td></tr>
<tr><td>Q4. (CA3 OR "entorhinal cortex" OR CA1 OR "dentate gyrus" OR CA2 OR subiculum OR "medial temporal lobe") AND (spike OR circuit OR "neural network" OR "firing rate" OR "network models") AND (computational OR "network model" OR simulation)<br><br></td><td>Pubmed</td></tr>
<tr><td>Q5. (hippocampal OR hippocampus OR CA3 OR "entorhinal cortex" OR CA1 OR "dentate gyrus" OR CA2 OR subiculum OR "medial temporal lobe") AND (network OR firing OR spiking OR spike OR spikes OR circuit OR "cell firing") AND (model OR computational OR simulation OR simulations OR modeling OR models OR simulated OR computation OR simulate OR computations)<br><br></td><td>Pubmed</td></tr>
</table>
<br>
<span style='font-size:18px;text-align:left'>Some additional information is that 982 articles were used from Q1 (max returned). 975 articles were used from Q2 (max returned). 1700 articles were used from Q3, Q4, Q5 each (manually selected limit). Those 7057 articles contained 4574 unique article titles, and only the unique article titles were reviewed. The optimization software created queries using 50 possible queries based on the keywords listed in this site's help page were automatically shuffled together in sets of around 5 queries total. 10 were with Google Scholar and 40 were with Pubmed.
<br><br>The articles reviewed for annotation were further filtered by a citations per year limit which was manually set. As mentioned in this project's article, the CPY threshold was set at 10 to produce a balance between a desirable article collection size and time needed for annotations. Exceptions to the threshold were that any 2019 article had a threshold of 6 and the threshold did not apply to 2020 articles. The queries were run and citation numbers collected between Sept. 2020 and Oct. 2020, and the exceptions were added to be inclusive of articles that had limited time to gain citations.</span>
	<br>
	<br>
</div>
</body>
</html>