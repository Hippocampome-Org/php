<?php
	include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Known Bugs and Issues</title>
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
<body lang=EN-US style='tab-interval:.5in'>
<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>
<BR><BR><BR><BR><BR><BR>
<div class='title_area'>
	<font class="font1">Known Bugs and Issues</font>
</div>
<div class=WordSection1>
<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>A Neuron page
summarizes all of the known properties of a given neuronal type, including its
morphology, molecular biomarkers, electrophysiological properties, and known
and potential connectivity with other neuronal types.<o:p></o:p></span></p>
<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>An Evidence
page summarizes all of the known bibliographic citations that support a given
piece of knowledge, by presenting original quotations or figures that support
that knowledge.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 032: Add <span class=SpellE>php</span> code to display quotes related to connectivity between cell types.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 033: Include quotes about known connectivity between cell types to the database.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 086: Add an interpretation notes column to the morphology figure files spreadsheet for import into the database.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 088: Amend the import scripts and database to handle the interpretation notes for the morphological evidence.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 089: Modify the <span class=SpellE>php</span> code on the morphology Evidence pages to display any interpretation notes.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 184: In the Author search results, the neuron types are supposed to be listed for each citation returned; however, the response “(to be determined)” still appears fairly frequently.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 187: Highlight the representative sources on a markers Evidence page, when there are conflicting expression reports.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 215: Ephys fragments need to be able to handle multiple sets of protocol conditions.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 215: Ephys fragments need to be able to handle multiple sets of protocol conditions.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 216: Add a new "Feedback" button to the banner.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 217: Add a basic feedback form.
</span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>
Issue 222: For conflicting data add a plain text descriptor to the marker evidence pages.
</span></p>

</div>
</body>
</html>
