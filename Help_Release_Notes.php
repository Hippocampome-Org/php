<?php
  include ("access_db.php");
?>
<?php
session_start();
$query = "SELECT permission FROM user WHERE id = '1'";
  $rs = mysql_query($query);
  while(list($permission) = mysql_fetch_row($rs)) {
    if ($permission == 0) {	
      $permission1 = $permission;
      $_SESSION['perm'] = 0;
    }
    else{
		$_SESSION['perm'] = 1;
	}
    
  }
$perm = $_SESSION['perm'];
//if ($perm == NULL)
if ($perm == 1 && $_SESSION['flag']== NULL)
	header("Location:error1.html");
?>
<?php
/*session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Release Notes</title>
<script type="text/javascript" src="style/resolution.js"></script>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0.15in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:115%;}
@page WordSection1
	{size:8.5in 11.0in;
	margin:.5in .5in .5in .5in;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>
		
<BR><BR><BR><BR><BR><BR><BR>
	
<div class=WordSection1>
		
<p class=MsoNormal><b><u><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>Release Notes:</span></u></b></p>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4M (24 Feb 2015):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 115: Modify the code on the marker and ephys evidence pages to display any linking information.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 123: Add code to handle and display marker notes.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 150: Property page markers rendering format error under certain conditions.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4L (19 Feb 2015):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 047: Add Marker linking information.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 048: Add Ephys linking information.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 072: Add figures to electrophysiology evidence pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 114: Amend the import scripts and database to handle linking information for ephys evidence.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 161: Amend the import scripts and database to handle linking information for marker evidence.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4K (12 Dec 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 008: Add code to the portal to handle weakly positive expression as simple positive expression.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 075: PMID search.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 082: Send email.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 122: Handle new curly brace codes in marker data spreadsheet.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 148: In ephys matrix, last line of column headings partially cut off.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 149: CA2 SO is not an option in the value drop-down.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4J (21 Nov 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 108: Sub P Rec "Negative" evidence missing for CA1 neuron types hippocampo-subicular projecting (0313p) and trilaminar(0113p).
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed issue 116: Full replacement for Ruby code.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed issue 117: CA1 and CA3 Axo-Axonic neuron page warning.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 130: The various combinations of axonal/dendritic/somatic evidence should all be toggle-able.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 133: Check boxes at the top to select what marker evidence appears and what is hidden.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 137: No evidence shown when clicking on CA1 LMR Projecting DG SG axon in morphology matrix.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 139: No evidence appears for CA1 (i)0333 Ivy: a-act2 (negative) clicking from the Neuron page.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 140: Internet Explorer matrix rendering speed too slow.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 143: The search should be changed to sub P rec.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 144: In the search marker list, the markers should be alphabetized.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue: Upgraded jqGrid and jQuery to the latest possible releases with related Javascript and CSS mods.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue: Compressed PNG files for browser rendering performance improvement.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4I (17 Aug 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 008: Add code to the portal to handle weakly positive expression as simple positive expression.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 010: Add "Major Neurotransmitter" to the list of Neuron type searches.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 023: Change the style of the open/close buttons on the Evidence Pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 043: Reformat connectivity sections of the Neuron pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 119: GABAa \alpha1 column in marker matrix is blank.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 121: New markers in spreadsheet not being read into database.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 124: Animal and protocol should always be listed on marker evidence page.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 128: The "flag" for axonal evidence should be red, not blue.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 132: A user should be able to select whether they want to see info about positive expression or negative expression (or even both).
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 134: Species/protocol toggles for marker evidence.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue    : Minimized the evidence row gaps on the marker evidence pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue    : Minimized the evidence row gaps on the morphology evidence pages.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4H (26 Jul 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 136: When clicking on an ephys value from the neuron page, an error is encountered.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4G (22 Jul 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 023: Change the style of the open/close buttons on the Evidence Pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 102: Add soma locations to the morphology matrix.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 118: Add code to matrices to display full names on Dev and short names on Rev and Prod.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 120: NG (neurogranin) marker is not being displayed in the marker matrix.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 127: Add gray soma circle to legend at bottom of morph matrix.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Partially Fixed Issue 072: Add figures to electrophysiology evidence pages. Figure functionality along with other functionality and layout similar to morphology page added to the Ephys page. Once the spreadsheet linking figure captions to figure files and ephys interpretations has been created, the csv2db ingest code must be enhanced to read it.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4F (8 Jul 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 125: The HC region is repeated twice in the I/O source/target section.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4E (28 Jun 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 004: Increase robustness of author search so that different versions of names are caught.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 040: Proper tagging of axonal/dendritic information on the morphology evidence page.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 073: Morphology purple squares - toggle axonal/dendritic info on Evidence Pages.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4D (18 Jun 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 011: Add Major Neurotransmitter information to the database.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 109: Update the php code that reads the (+)/(-) tags for the matrices.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4C (6 Jun 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 058: Figure error - TML representative figure.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 097: Missing markers from neuron pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 098: Missing Spruston H soma evidence for DG mossy.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 099: Missing Bartos SG soma evidence for DG TML.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 106: Missing association in the database between fragments and cell types.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4B (31 May 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 094: Lack of evidence for CB- flag for mossy cells.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 107: Author search does not work when Author's name has apostrophe.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4A (27 May 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed page layout: More efficient rendering on small screens.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed major fault: Author search is not returning type names properly.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 052: Duplicate articles in marker evidence (Example: CA3 03330p MFA CCK).
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 061: Make 'Hippocampome ID: 2503 (original: 160880)' less prominent on the evidence pages.
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed Issue 101: Missing Lingenhohl IV soma evidence for EC (+) 223331 multiform III-IV-V cells.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 4 (14 May 2014):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Major update of web interface and content.
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 3B:</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>An updated list of known connections between neuronal types and types known not to be connected have been incorporated into the Neuron Pages and the static Connectivity Matrix.
(15 Jun 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>In the Author Search results, the phrase "(to be determined)" now appears instead of "no type."
(12 Jun 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Stimulus-related current and time values now appear for relevant electrophysiological properties on Neuron and Evidence Pages.
(8 Jun 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>All units now appear properly on the Electrophyiology Evidence Pages.
(8 Jun 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Electrophysiological values are now uniformly rounded to 1 decimal point on the Matrix, Neuron, and Evidence Pages, except for APwidth, Slow AHP, and Sag ratio, which are round to 2 places.
(29 May 2013)
</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 3A:</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Replaced missing code, which fixes the missing connectivity information on the Neuron pages.
(21 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Changed the way Targets of output and Sources of input appear on neuron_page.php page.
(15 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>In marker matrix, "no information available" squares are no longer linked to an (empty) evidence page.
(14 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>All the evidence pages having neuron types linkable which takes user to neuron_page.php displaying information about that neuron type.
(5 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>All the evidence pages and neuron_page.php page having author names linkable that takes user to Find_author.php page directly displaying information about the author without selecting anything.
(2 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Fixed spacing before and after commas within electrophysiology data on neuron and evidence pages.
(2 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Restored missing 5HT-3 and Sub P marker evidence.
(2 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The property_page_ephys.php showing up the information in proper format and spacing.
(28 April 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Neuron types showing up in the author table on Find_author.php page and the table now uses datatables functionality.
(20 April 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Changed the list of articles to accordion functionality sorted by first initial of author.
(25 March 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>On the Neuron pages, the "known non-targets/sources" sections have been relabeled and reordered.</span></p>
<!-- Modified code is between the comments "Start R 2C connectivity changes" and "End R 2C connectivity changes" -->

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>On the Neuron pages, when there are no types listed for a connectivity section, the phrase "none known" is now used rather than "none."</span></p>
<!-- Modified code is between the comments "Start R 2C connectivity changes" and "End R 2C connectivity changes" -->

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>On the Neuron and Evidence pages, single values for electrophysiological properties are now labeled as "(n=1)."</span></p>
<!-- New code added to neuron.php and property_page_ephys.php is tagged with the comment "R 2C (n=1)" -->

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The results from the Author search have been reworked, such that they may be reordered or searched.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>In the Electrophysiology Matrix, the units have been moved out of the matrix body and into the column headers."</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The electrophysiology parameter names and abbreviations have been unified across all portal pages.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Citations from Tricoire et al., 2011, are now correctly attributed to CA1 (-)1003 SO O-LM cells rather than to CA1 (-)1002 O-LM cells.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 2D (16 May 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Progress made in vetting entorhinal cortex marker information.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 2C (25 April 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Some typographical errors were corrected in the Marker Expression Evidence.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Progress made in vetting Subiculum marker information.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 2B (23 April 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Progress made in vetting CA3 marker information.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 2A (16 April 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Spelling error corrected on the PMID/ISBN search page.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Slight rewording of some of the Bibliographic Protocols.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Spelling error corrected on the Connectivity Help page.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>"Ongoing search" icon added to the legend of the Markers matrix.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>An Acknowledgements page has been added.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Text on the Home page has been changed from blue to black.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The disclaimer text on the Home page has been enlarged.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The Hippocampome.org email address on the Home page has been turned into a web link.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The reference to Title 17 of the US Code, Section 170, on the Home page has been turned into a web link.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Values for Vrest now correctly display negative signs.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Standardized the layout of the Home Page.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Progress made in vetting CA3 marker information.</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Corrected missing electrophysiological values for some neuronal types.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 1B (09 April 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>All of the morphology data is now fully vetted.</span></p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Progress was made in vetting CA3 marker information. Marker information in the entorhinal cortex was correctly labeled as unvetted.</span></p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Progress was made in vetting electrophysiological information.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 1A (04 April 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Added warning to the connectivity matrix indicating that it is not interactive.</span></p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Increased the resolution of the connectivity matrix so the text is more legible.</span></p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Added definitions for the abbreviations used in the connectivity matrix legend.</span></p>

<p class=MsoListParagraphCxSpMiddle style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Added note to the Home Page about the known lack of uniformity across all combinations of browsers and screen resolutions.</span></p>

</BR></BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; (26 March 2013):</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Released v1.0&alpha;.</span></p>


</div>
<!-- ------------------------ -->

</body>

</html>
