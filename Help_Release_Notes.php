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
<?php include ("function/title.php"); ?>

	<div id="menu_main_button_new_clr">
	<?php
	if ($research);	
	else
	{
	?>	
	<form action="morphology.php" method="get" style='display:inline'>
		<input type="submit" name='browsing' value='Browse' class="main_button"/>
	</form>
	<form action="search.php" method="get" style='display:inline'>
		<input type="submit" name='searching' value='Search' class="main_button" />
	</form>
	<form action="help.php" method="post" style='display:inline' target="_blank">
		<input disabled type="submit" name='help' value='Help' class="main_button_no_work"/>
	</form>
	<?php
	}
	?>		
	</div>
		
			  <BR><BR><BR><BR><BR><BR><BR>
	
<div class=WordSection1>
		
<p class=MsoNormal><b><u><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>Release Notes:</span></u></b></p>

<!--
<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 3A:</span></p>
-->
<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Changed the list of articles to accordion functionality sorted by first initial of author.
(25 March 2013)
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
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>The property_page_ephys.php showing up the information in proper format and spacing.
( 28 April 2013)
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
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>All the evidence pages having neuron types linkable which takes user to neuron_page.php displaying information about that neuron type.
(5 May 2013)
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
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Replaced missing code, which fixes the missing connectivity information on the Neuron pages.
(21 May 2013)
</span></p>

<p class=MsoListParagraphCxSpFirst style='text-indent:-.25in'><span
style='font-size:14.0pt;line-height:115%;font-family:Symbol'>·<span
style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>In marker matrix, "no information available" squares are no longer linked to an (empty) evidence page.
(14 May 2013)
</span></p>

<BR><BR>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:115%;
font-family:"Arial","sans-serif"'>v1.0&alpha; R 3A:</span></p>

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
