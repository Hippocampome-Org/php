<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Known Bugs</title>
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

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>
		
<body lang=EN-US style='tab-interval:.5in'>

<div class=WordSection1>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #151 - Empty search results are returned when
searching for dendrites in CA3 stratum oriens (SO) and a lack of dendrites in
CA3 stratum radiatum (SR).<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #152 - On the Neuron pages, the values for some
electrophysiological properties have associated with them a zero standard
deviation, even though non-zero values are shown on the associated Evidence
pages.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #153 - There is a duplicate quote that appears on
the Evidence pages for CA1 Bistratified CCK expression, under the entry for
Pawelzik et al., 2002 (PMID 11807843).<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #157 - On the Neuron pages, the Sources of Input
and Targets of Output <span class=SpellE>subtables</span> are sometimes
incomplete and/or incorrect.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #167 - On the Evidence pages for molecular
biomarkers, when the Open All Evidence/Close All Evidence functions are
performed, the Animal/Protocol/Expression selectors are all automatically reset
and must be re-selected.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #184 - In the Author search results, the neuron
types are supposed to be listed for each citation returned; however, the
response “(to be determined)” still appears fairly frequently.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #188 - Odd UNICODE characters sometimes appear in
the citation quotes on the Evidence pages, in particular, Evidence pages for
molecular biomarkers.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #189 - The gray outline boxes on the Neuron pages
are not properly left- and right-justified for all supported browsers.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>A Neuron page
summarizes all of the known properties of a given neuronal type, including its
morphology, molecular biomarkers, electrophysiological properties, and known
and potential connectivity with other neuronal types.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>An Evidence
page summarizes all of the known bibliographic citations that support a given
piece of knowledge, by presenting original quotations or figures that support
that knowledge.<o:p></o:p></span></p>

</div>

</body>

</html>
