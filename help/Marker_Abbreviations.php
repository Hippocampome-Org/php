<?php
session_start();

$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("../function/icon.html"); ?>
<title>Help</title>
<script type="text/javascript" src="style/resolution.js"></script>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.msopapdefault, li.msopapdefault, div.msopapdefault
	{mso-style-name:msopapdefault;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:115%;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";}
.MsoChpDefault
	{font-size:10.0pt;}
@page WordSection1
	{size:8.5in 11.0in;
	margin:1.0in 1.0in 1.0in 1.0in;}
div.WordSection1
	{page:WordSection1;}
@page WordSection2
	{size:8.5in 11.0in;
	margin:1.0in 1.0in 1.0in 1.0in;}
div.WordSection2
	{page:WordSection2;}
-->
</style>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php include ("../function/title.php"); ?>

	<div id="menu_main_button_new">

  	<form action="../index.php" method="post" style='display:inline'>
  		<input type="submit" name='index' value='Home' class="main_button"/> 
  	</form>
  	<form action="../morphology.php" method="post" style='display:inline'>
  		<input type="submit" name='browsing' value='Browse' class="main_button"/>
  	</form>
  	<form action="../search.php" method="post" style='display:inline' target="_blank">
  		<input type="submit" name='searching' value='Search' class="main_button" />
  	</form>
  	<form action="../help.php" method="post" style='display:inline' target="_blank">
  		<input type="submit" name='help' value='Help' class="main_button"/>
  	</form>

	</div>
		
	
	<div class=WordSection1>

	  <BR><BR><BR><BR><BR><BR><BR><BR>
    <p class=MsoNormal <b><u><span
    style='font-size:16.0pt;font-family:"Arial","sans-serif";color:black'>Biomolecular
    Marker Abbreviations</span></u></b></p>

	</div>

	
  <b><u><span style='font-size:16.0pt;font-family:"Arial","sans-serif";
  color:black'><br clear=all style='page-break-before:auto'>
  </span></u></b>
  
  <div class=WordSection2>

  <table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=919
   style='width:688.9pt;margin-left:4.55pt;border-collapse:collapse'>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><b><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>Abbreviation</span></b></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><b><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>Name</span></b></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>5HT-3</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>serotonin type 3 receptor</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>a-act2</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>alpha actinin 2</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>AChE</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>acetylcholinesterase</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>CB </span></p>
    </td>
    <td width=225 nowrap valign=bottom style='width:168.95pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>calbindin</span></p>
    </td>
    <td width=231 nowrap valign=bottom style='width:173.05pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>CB1</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>cannabinoid receptor type 1</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>CCK</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>cholecystokinin</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>CGRP</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>calcitonin gene related peptide</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>ChAT</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>choline acetyltransferase</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>CoupTF II</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>chicken ovalbumin upstream promoter transcription factor II</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>CR</span></p>
    </td>
    <td width=225 nowrap valign=bottom style='width:168.95pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>calretinin</span></p>
    </td>
    <td width=231 nowrap valign=bottom style='width:173.05pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>DYN</span></p>
    </td>
    <td width=225 nowrap valign=bottom style='width:168.95pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>dynorphin</span></p>
    </td>
    <td width=231 nowrap valign=bottom style='width:173.05pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>EAAT3</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>excitatory amino acid transporter 3</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>ENK</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>enkephalin</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>GABAa \alpha</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>gamma aminobutyric acid-a receptor alpha subunit</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>GAT-1</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>gamma aminobutyric acid transporter-1</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>GlyT2</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>glycine transporter 2</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>mGluR1a</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>metabotropic glutamate receptor 1 alpha</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>mGluR2/3</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>metabotrobic glutamate receptor 2/3</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>mGluR7a</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>metabotropic glutamate receptor 7a</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>mGluR8a</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>metabotropic glutamate receptor 8a</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>MOR</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>mu-opioid receptor</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>Mus2R</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>muscarinic type 2 receptor</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>NKB</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>neurokinin B</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>nNOS</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>neuronal nitric oxide synthase</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>NPY</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>neuropeptide Y</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>PPTA</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>preprotachykinin A</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>PV</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>parvalbumin</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>RLN</span></p>
    </td>
    <td width=225 nowrap valign=bottom style='width:168.95pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>reelin</span></p>
    </td>
    <td width=231 nowrap valign=bottom style='width:173.05pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>SOM</span></p>
    </td>
    <td width=456 nowrap colspan=2 valign=bottom style='width:4.75in;padding:
    0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>somatostatin</span></p>
    </td>
    <td width=205 nowrap valign=bottom style='width:153.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'></td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>sub P rec</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>substance P receptor</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vAChT</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vesicular acetylcholine transporter</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vGluT2</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vesicular glutamate transporter 2</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vGluT3</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vesicular glutamate transporter 3</span></p>
    </td>
   </tr>
   <tr style='height:12.75pt'>
    <td width=258 nowrap valign=bottom style='width:193.45pt;padding:0in 5.4pt 0in 5.4pt;
    height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>VIP</span></p>
    </td>
    <td width=661 nowrap colspan=3 valign=bottom style='width:495.45pt;
    padding:0in 5.4pt 0in 5.4pt;height:12.75pt'>
    <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
    normal'><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
    color:black'>vasoactive intestinal polypeptide</span></p>
    </td>
   </tr>
  </table>
  
  <p class=MsoNormal><span style='font-size:14.0pt;line-height:115%'>&nbsp;</span></p>
  
  </div>
<!-- ------------------------ -->

</body>

</html>
