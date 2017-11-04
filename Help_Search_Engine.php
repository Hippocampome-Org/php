<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Search Engine</title>
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
	font-size:9.5pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	font-size:9.5pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:9.5pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	margin-bottom:.0001pt;
	line-height:115%;
	font-size:9.5pt;
	font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	line-height:115%;
	font-size:9.5pt;
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

<body lang=EN-US link=blue vlink=purple style='tab-interval:.5in'>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>

		
<BR><BR><BR><BR><BR>
		
<div class=WordSection1>

<p style='margin:0in;margin-bottom:.0001pt'><b style='mso-bidi-font-weight:
normal'><span style='font-size:24.0pt;font-family:"Calibri","sans-serif"'>Advanced
Connectivity Search Engine<o:p></o:p></span></b></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>I] Objective: <o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>The objective of search engine is to find a
connection between two neuron types. The source neuron is presynaptic, whereas
destination neuron is postsynaptic. The criteria for fetching the presynaptic
or postsynaptic neuron are morphology, electrophysiology, markers, firing
patterns, and firing pattern parameters. Also, the neuron name, ID, and type
can be included in criteria.<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>II] Syntax for writing a query*:<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Connection:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Presynaptic:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Morphology_Clause
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Electrophysiology_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Markers_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>FiringPattern_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>FiringPatternParameters_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Name_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Neurotransmitter_Clause
,<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Include_Clause,<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Exclude_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>),
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Postsynaptic:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Morphology_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Electrophysiology_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Markers_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>FiringPattern_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>FiringPatternParameters_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Name_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND/OR<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Neurotransmitter_Clause
,<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Include_Clause,<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Exclude_Clause<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>)<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>)<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>* Although the examples presented in this
document are indented and cross multiple lines for legibility, the search
engine only accepts query strings presented in a single continuous line.<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>III] Steps for writing a search query:<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>1)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Start
with string given below:<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt;text-indent:9.0pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Connection:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.25in;
margin-bottom:.0001pt;text-indent:45.0pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Presynaptic:(<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:63.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>),
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:63.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Postsynaptic:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:81.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:63.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt;text-indent:9.0pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>2)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Repeat
steps 3-6 for the Presynaptic and Postsynaptic conditions to form a search
query.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>3)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>First
select the Criterion_Clauses from below ('V] Section Clauses') that are
required for your search query. Each Criterion_Clause is optional so you don't
need to include all of them, just choose those that are required for your
search.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>4)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>For
multiple criteria add an operator (AND/OR) in between them.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>5)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>For
each criterion, add single- or multiple-parameter criteria. Surround multiple-parameter
criteria by parentheses. For more details, go to 'V] Section Clauses.' <o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>6)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Now
add the Name, Neurotransmitter, Include, and Exclude criteria. All are
optional.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l7 level1 lfo3'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>7)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Paste
the search query in the search engine and click on 'SEE RESULTS' to fetch the matching
connections.<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>IV] Sample Query:<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Connection:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Presynaptic:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Morphology:Soma:DG:0???
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Neurotransmitter:Inhibitory<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>),
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Postsynaptic:(<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>FiringPatternParameter:delay_ms:&gt;0
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Markers:D-:CCK
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>AND
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Electrophysiology:vrest&lt;0<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>)<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>)<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>V] Section Clauses:<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>1)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Morphology:</span></b><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'> It will AND/OR the neuron types list,
matching Morphology criteria with the existing list of presynaptic/postsynaptic
neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt;text-indent:9.0pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>criteria: Morphology:Condition:Subregion:LayerValues<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:63.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Condition:
Axons, Dendrites, and Soma<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:63.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Subregion:
DG, CA3, CA2, CA1, SUB, and EC<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:63.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>LayerValues:
a string of 1s, 0s, or ?s whose length is equal to the number of layers
present within the given subregion: DG(4), CA3(5), CA2(4), CA1(4), SUB(3), and
EC(6).<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:1.25in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>1
= present<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:1.25in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>0
= absent<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:1.25in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>?
= present or absent<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l12 level1 lfo11'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Axons
in DG Hilus<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Morphology:Axons:DG:???1<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l12 level1 lfo11'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Dendrites
in DG outer Stratum Moleculare (SMo: at 1st index of layer values) and in DG
inner Stratum Moleculare (SMi: 2nd index) but not in DG Hilus (H: 4th index)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Morphology:Dendrites:DG:11?0<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l12 level1 lfo11'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>C)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Soma
not in any layer of CA3:<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:.25in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Morphology:Soma:CA3:00000<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l12 level1 lfo11'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>D)</span></span><![endif]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Morphology:(Axons:DG:0???
AND (Dendrites:DG:1111 OR Soma:CA3:10001))<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l12 level1 lfo11'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>E)<span style='font:7.0pt "Times New Roman"'>&nbsp;
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Invalid:
?s in the Condition and Layer. ?s only allowed in LayerValues.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:45.0pt;
margin-bottom:.0001pt;text-indent:9.0pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Morphology:(Axons:?:0??? AND (?:DG:1111 OR
Soma:CA3:10001))<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>2)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Electrophysiology:</span></b><span style='font-size:
20.0pt;font-family:"Calibri","sans-serif"'> It will AND/OR the neuron types
list, matching Electrophysiology criteria with the existing list of
presynaptic/postsynaptic neuron types. Only use the Electrophysiology parameter
names provided in Table 1.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l14 level1 lfo13'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a maximum firing rate greater than 29.89 Hz.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><span
style='mso-spacerun:yes'>� </span><span style='mso-tab-count:1'>� </span>Electrophysiology:max_fr:&gt;29.89<span
style='mso-tab-count:2'>������������� </span><span style='mso-tab-count:1'>�������� </span><span
style='mso-tab-count:1'>��� </span>[with use of :]<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><span
style='mso-spacerun:yes'>� </span><span style='mso-tab-count:1'>� </span>Electrophysiology:max_fr&gt;29.89<span
style='mso-tab-count:3'>����������������������� </span><span style='mso-tab-count:
1'>��� </span><span style='mso-tab-count:1'>�������� </span>[without use of :]<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l14 level1 lfo13'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a maximum firing rate greater than 29.89 Hz or a
resting potential greater than or equal to 4.3 mV.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Electrophysiology:(max_fr:&gt;29.89 OR
Vrest:&gt;=4.3)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Electrophysiology:(max_fr&gt;29.89 OR
Vrest&gt;=4.3)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l14 level1 lfo13'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>C)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a maximum firing rate greater than 29.89 Hz or a
resting potential greater than or equal to 4.3 mV and an input resistance equal
to 147 M.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Electrophysiology:((max_fr:&gt;29.89 OR
Vrest:&gt;=4.3) AND Rin:147)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Electrophysiology:((max_fr&gt;29.89 OR
Vrest&gt;=4.3) AND Rin=147)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:1.5in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt;text-indent:.5in'><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>IMPORTANT **** For
equal either use : or =, but not both at same time ****<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.25in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Valid: Electrophysiology:Rin:147 /
Electrophysiology:Rin=147<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.25in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Invalid: Electrophysiology:Rin:=147<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>3)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Markers:</span></b><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'> It will AND/OR the neuron types list,
matching Marker criteria with the existing list of presynaptic/postsynaptic
neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l20 level1 lfo19'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a positive direct inference for CCK.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><span
style='mso-spacerun:yes'>� </span><span style='mso-tab-count:1'>� </span>Markers:D+:CCK<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l20 level1 lfo19'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have positive direct inference for CCK and negative
direct inference for CB.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><span
style='mso-spacerun:yes'>� </span><span style='mso-tab-count:1'>� </span>Markers:(D+:CCK
AND D-:CB)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l20 level1 lfo19'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>C)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Multiple
marker criteria.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><span
style='mso-spacerun:yes'>� </span><span style='mso-tab-count:1'>� </span>Markers:(D+:CCK
OR (D-:CB AND D-:PV))<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l20 level1 lfo19'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>D)</span></span><![endif]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Inferred Markers.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:.25in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Markers:(I+:CCK OR (I-:CB AND I-:PV))<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>4)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>FiringPattern:</span></b><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'> It will AND/OR the neuron types list,
matching Firing-Pattern criteria with the existing list of
presynaptic/postsynaptic neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l10 level1 lfo21'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have the firing pattern ASP.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPattern:D+:ASP.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l10 level1 lfo21'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have the firing patterns ASP. and FASP.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPattern:(D+:ASP. AND D+:FASP.)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l10 level1 lfo21'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>C)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Multiple
firing-pattern criteria<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPattern:(D-:PSWB AND (D+:ASP. OR
D-:FASP.))<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>5)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>FiringPatternParameter:</span></b><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif"'> It will AND/OR the
neuron types list, matching Firing-Pattern Parameter criteria with the existing
list of presynaptic/postsynaptic neuron types. Only use the Firing-Pattern
Parameter names provided in Table 1.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l15 level1 lfo23'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a Firing-Pattern Parameter delay value greater than
2 ms.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPatternParameter:delay_ms:&gt;2<span
style='mso-tab-count:2'>�������������� </span><span style='mso-tab-count:2'>���������������� </span>[with
use of :]<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:45.0pt;
margin-bottom:.0001pt;text-indent:27.0pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPatternParameter:delay_ms&gt;2<span
style='mso-tab-count:2'>��������������� </span><span style='mso-tab-count:2'>�������������� </span>[without
use of :]<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l15 level1 lfo23'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a Firing-Pattern Parameter delay value greater than
2 ms and a current stimulation value less than or equal to 4.3 pA.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPatternParameter:(delay_ms:&gt;2 OR
istim_pa:&lt;=4.3)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPatternParameter:(delay_ms&gt;2 OR
istim_pa&lt;=4.3)<span style='mso-tab-count:1'>����� </span><o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l15 level1 lfo23'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>C)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Find
all neuron types that have a Firing-Pattern Parameter delay value greater than
2 ms and a current stimulation value less than or equal to 4.3 pA and the
number of interspike intervals equal to 1.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPatternParameter:((delay_ms:&gt;2 OR
istim_pa:&lt;=4.3) AND nisi:1)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>FiringPatternParameter:((delay_ms&gt;2 OR
istim_pa&lt;=4.3) AND nisi=1)<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:27.0pt;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.25in;
margin-bottom:.0001pt;text-indent:.25in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>IMPORTANT **** For equal either use : or =,
but not both at same time ****<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.25in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Valid: FiringPatternParameter:nisi:1 /
FiringPatternParameter:nisi=1<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.25in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Invalid: FiringPatternParameter:nisi:=1<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>6)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Name:</span></b><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'> It will AND/OR the neuron types list,
matching Name criteria with the existing list of presynaptic/postsynaptic
neuron types. Only use a Name keyword for the search that does not contain any
spaces. Instead of the full neuron name, use the ID when one Includes or Excludes
a neuron type.<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt;text-indent:.5in'><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>*** Do not include
'' or &quot;&quot; surrounding a neuron name ***<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Name:(
(name1 AND name2) OR (name3 OR name4))<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.75in;
margin-bottom:.0001pt'><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>7)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Neurotransmitter:</span></b><span style='font-size:
20.0pt;font-family:"Calibri","sans-serif"'> It will only keep those
presynaptic/postsynaptic neuron types that match the specified
neurotransmitter.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l23 level1 lfo25'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Only
keep the Inhibitory neuron types in the list of presynaptic/postsynaptic neuron
types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Neurotransmitter:Inhibitory<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l23 level1 lfo25'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Only
keep the Excitatory neuron types in the list of presynaptic/postsynaptic neuron
types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Neurotransmitter:Excitatory<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l23 level1 lfo25'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>C)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Keep
both the Inhibitory and Excitatory neuron types in the list of
presynaptic/postsynaptic neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Neurotransmitter:Both<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>8)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Include:</span></b><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'> It will Include the list of given neuron types
in the existing list of presynaptic/postsynaptic neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l1 level1 lfo26'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Add
Granule cells to the list of presynaptic/postsynaptic neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:13.5pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Include:1000&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-
<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l1 level1 lfo26'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Add
Granule, Mossy, and MOLAX cells to the list of presynaptic/postsynaptic neuron
types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Include:(1000,1002,1005)<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'><span style='mso-spacerun:yes'>��� </span><o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l6 level1 lfo6'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>9)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><b><span style='font-size:20.0pt;font-family:
"Calibri","sans-serif"'>Exclude:</span></b><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'> It will Exclude the list of given neuron types
from the existing list of presynaptic/postsynaptic neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l17 level1 lfo27'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>A)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Remove
Granule cells from the list of presynaptic/postsynaptic neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Exclude:1000 <o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:58.5pt;
margin-bottom:.0001pt;text-indent:-.25in;mso-list:l17 level1 lfo27'><![if !supportLists]><span
style='font-size:20.0pt;font-family:"Calibri","sans-serif";mso-fareast-font-family:
Calibri'><span style='mso-list:Ignore'>B)<span style='font:7.0pt "Times New Roman"'>
</span></span></span><![endif]><span style='font-size:20.0pt;font-family:"Calibri","sans-serif"'>Remove
Granule, Mossy, and MOLAX cells from the list of presynaptic/postsynaptic
neuron types.<o:p></o:p></span></p>

<p style='margin-top:0in;margin-right:0in;margin-bottom:0in;margin-left:.5in;
margin-bottom:.0001pt;text-indent:.5in'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Exclude:(1000,1002,1005)<o:p></o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>Table 1.<o:p></o:p></span></p>

<div>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 title=""
 summary="" style='border-collapse:collapse;border:none;mso-border-alt:solid #A3A3A3 1.0pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 0in 0in 0in'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  background:#002060;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:white'>Morphology<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border:solid #A3A3A3 1.0pt;
  border-left:none;mso-border-left-alt:solid #A3A3A3 1.0pt;background:#002060;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:white'>Markers<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border:solid #A3A3A3 1.0pt;
  border-left:none;mso-border-left-alt:solid #A3A3A3 1.0pt;background:#002060;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:white'>Electrophysiology<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border:solid #A3A3A3 1.0pt;
  border-left:none;mso-border-left-alt:solid #A3A3A3 1.0pt;background:#002060;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:white'>Firing Pattern <o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border:solid #A3A3A3 1.0pt;
  border-left:none;mso-border-left-alt:solid #A3A3A3 1.0pt;background:#002060;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:white'>Firing pattern parameters<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Axons<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CB<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Vrest<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ASP.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>istim_pa<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Dendrites<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CR<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Rin<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ASP.ASP.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>tstim_pa<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Soma<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PV<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>tm<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ASP.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>delay_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CB1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Vthresh<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ASP.SLN<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>pfs_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Mus2R<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>fast_AHP<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>D.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>swa_mv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Sub P Rec<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AP_ampl<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>D.ASP.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>nisi<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>5HT-3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AP_width<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>D.RASP.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Gaba-a-alpha<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>max_fr<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>D.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>sd_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR1a<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slow_AHP<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>D.PSTUT<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>max_isi_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>vGluT3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>sag_ratio<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>D.TSWB.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>min_isi_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CCK<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>first_isi_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ENK<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PSTUT<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav1_2_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>NPY<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'></td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PSWB<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav1_3_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>SOM<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'></td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>RASP.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav1_4_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>VIP<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'></td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>RASP.ASP.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>last_isi_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>NG<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>RASP.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiavn_n_1_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>alpha-actinin-2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>RASP.SLN<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiavn_n_2_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CoupTF II<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TSTUT.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiavn_n_3_ms<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>nNOS<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TSTUT.ASP.<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>maxisi_minisi<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>RLN<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TSTUT.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>maxisin_isin_m1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>DYN<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TSTUT.SLN<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>maxisin_isin_p1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>NKB<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TSWB.NASP<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ai<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PPTA<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TSWB.SLN<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>rdmax<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>vGluT2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>df<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GAT-1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>sf<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CGRP<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>tmax_scaled<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:27'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR2/3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isimax_scaled<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:28'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR5<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav_scaled<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:29'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Prox1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>sd_scaled<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:30'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa \delta<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:31'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>VILIP<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:32'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Mus1R<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:33'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Mus3R<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:34'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Mus4R<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>css_yc1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:35'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ErbB4<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>xc1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:36'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CaM<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:37'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Y1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:38'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Man1a<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope3<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:39'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Bok<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept3<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:40'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PCP4<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>xc2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:41'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AMIGO2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>yc2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:42'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AMPAR 2/3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f1_2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:43'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Disc1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f1_2crit<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:44'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PSA-NCAM<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f2_3<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:45'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>BDNF<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f2_3crit<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:46'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p-CREB<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f3_4<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:47'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>SCIP<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f3_4crit<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:48'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Math-2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p1_2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:49'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Neuropilin2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p2_3<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:50'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>vGAT<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p3_4<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:51'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p1_2uv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:52'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Caln<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p2_3uv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:53'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>vGlut1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p3_4uv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:54'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isii_isii_m1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:55'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>i<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:56'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>SPO<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav_i_n_isi1_i_m1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:57'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\alpha 2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>maxisij_isij_m1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:58'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\alpha 3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>maxisij_isij_p1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:59'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\alpha 4<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>nisi_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:60'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt;tab-stops:108.95pt'><span
  style='font-size:20.0pt;font-family:"Calibri","sans-serif";color:black'>GABAa\alpha
  5<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav_ms_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:61'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\alpha 6<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>maxisi_ms_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:62'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\beta 1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>minisi_ms_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:63'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\beta 2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>first_isi_ms_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:64'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\beta 3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>tmax_scaled_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:65'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\gamma 1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isimax_scaled_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:66'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABAa\gamma 2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>isiav_scaled_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:67'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR5a<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>sd_scaled_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:68'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GAT-3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:69'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>ChAT<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:70'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>EAAT3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope1_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:71'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GlyT2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept1_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:72'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR7a<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>css_yc1_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:73'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR8a<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>xc1_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:74'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>MOR<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope2_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:75'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>vAChT<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept2_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:76'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AChE<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>slope3_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:77'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Kv3.1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>intercept3_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:78'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Cx36<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>xc2_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:79'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Sub P<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>yc2_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:80'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Id-2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f1_2_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:81'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AR-beta1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f1_2crit_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:82'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>AR-beta2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f2_3_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:83'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>SATB1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f2_3crit_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:84'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>TH<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f3_4_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:85'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>NECAB1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f3_4crit_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:86'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>mGluR4<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p1_2_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:87'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Chrna2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p2_3_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:88'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>SATB2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p3_4_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:89'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>Ctip2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p1_2uv_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:90'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CXCR4<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p2_3uv_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:91'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GABA-B1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p3_4uv_c<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:92'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GluA2<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>m_2p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:93'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GluA1<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>c_2p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:94'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GluA3<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>m_3p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:95'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>GluA4<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>c1_3p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:96'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>PPE<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>c2_3p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:97'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>CRF<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>m1_4p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:98'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>c1_4p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:99'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>m2_4p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:100'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>c2_4p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:101'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>n_isi_cut_3p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:102'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>n_isi_cut_4p<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:103'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f_12<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:104'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f_crit_12<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:105'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f_23<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:106'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f_crit_23<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:107'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f_34<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:108'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>f_crit_34<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:109'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p_12<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:110'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p_12_uv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:111'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p_23<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:112'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p_23_uv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:113'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p_34<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:114'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>p_34_uv<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:115'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>m_fasp<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:116'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>c_fasp<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:117;mso-yfti-lastrow:yes'>
  <td width=181 valign=top style='width:108.75pt;border:solid #A3A3A3 1.0pt;
  border-top:none;mso-border-top-alt:solid #A3A3A3 1.0pt;padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=261 valign=top style='width:156.45pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=284 valign=top style='width:170.5pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=232 valign=top style='width:139.1pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=287 valign=top style='width:171.9pt;border-top:none;border-left:
  none;border-bottom:solid #A3A3A3 1.0pt;border-right:solid #A3A3A3 1.0pt;
  mso-border-top-alt:solid #A3A3A3 1.0pt;mso-border-left-alt:solid #A3A3A3 1.0pt;
  padding:4.0pt 4.0pt 4.0pt 4.0pt'>
  <p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
  font-family:"Calibri","sans-serif";color:black'>n_isi_cut_fasp<o:p></o:p></span></p>
  </td>
 </tr>
</table>

</div>

<p style='margin:0in;margin-bottom:.0001pt'><span style='font-size:20.0pt;
font-family:"Calibri","sans-serif"'>&nbsp;<o:p></o:p></span></p>

</div>

</body>

</html>
