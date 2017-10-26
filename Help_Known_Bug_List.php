<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bugs and Issues</title>
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

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span
style='font-size:16.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Known
Issues in v1.3<o:p></o:p></span></b></p>

<p class=MsoNormal><span style='font-family:"Arial","sans-serif"'>A Neuron page
summarizes all of the known properties of a given neuronal type, including its
morphology, molecular biomarkers, electrophysiological properties, and known
and potential connectivity with other neuronal types.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #85 – From a Neuron page, if you right click on two
links, such as first A:DG:SG and second D:DG:H, in order to open them in
separate tabs, and you click on the first tab, A:DG:SG, when you go to expand
any of the citations, the contents of the tab immediately switch over to the
second tab’s contents, D:DG:H.<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #253 – The current version of <span class=SpellE>jqGrid</span>
used by Hippocampome.org is 4.6 (as of 27-Nov-2015). The latest available
version of <span class=SpellE>jqGrid</span> (as of 19-Oct-2015, per
http://www.trirand.com/blog) is 5.0.1. Incorporating the latest version of <span
class=SpellE>jqGrid</span> will likely fix the lag in rendering the full marker
matrix problem.<o:p></o:p></span></p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt'><span
style='font-size:14.0pt;line-height:115%;font-family:"Arial","sans-serif"'>Issue
#352 – The <span class=GramE>Include:</span>() function does not work for
presynaptic connections. For example, in the following search query it does not
work:<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Connection:(Presynaptic:(Morphology:((Dendrites:DG:1111
AND Axons:DG:0???) AND (<span class=SpellE>Soma<span class=GramE>:DG</span></span>:??1?
OR <span class=SpellE>Soma<span class=GramE>:DG</span></span>:???1)) AND <span
class=SpellE>electrophysiology:Max_Fr</span>:&gt;50 AND <span class=SpellE>Neurotransmitter:Inhibitory</span>,
Include:(1009)), Postsynaptic:(<span class=SpellE>Morphology:Soma:DG</span>:??1?
AND <span class=SpellE>Neurotransmitter<span class=GramE>:Excitatory</span></span>))<o:p></o:p></span></p>

<p class=MsoNormal><span style='font-size:14.0pt;line-height:115%;font-family:
"Arial","sans-serif"'>Issue #357 – The potential connection between DG (e<span
class=GramE>)2201p</span> Granule and CA3 (i)03330p Mossy-Fiber Associated is
missing from the database.<o:p></o:p></span></p>

</div>

</body>

</html>

