<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
	margin:23.75pt .25in .25in 23.75pt;}
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

<p class=MsoNormal style='line-height:normal'><b><u><span style='font-size:
16.0pt;font-family:"Arial","sans-serif"'>Bibliography</span></u></b></p>

	<table width="70%" border="0" cellspacing="0" cellpadding="0" style="position:absolute; top:180px; left:80px;">
	<tr>
		<td width="100%" align="left">
		<?php 
			$t="SELECT distinct a.id,a.publication AS pub,a.volume AS vol,a.pmid_isbn AS pmid,a.issue AS iss,a.first_page AS first,a.last_page AS last,a.year AS yea,a.doi AS doi,a.title AS ttl FROM Article AS a where publication is not NULL ORDER BY a.title";
			$r=mysql_query($t);
			$l=0;
			while($row = mysql_fetch_array($r, MYSQL_ASSOC))
			{
				$ttls[$l]=$row['ttl'];
				$publi[$l]=$row['pub'];
				$pm[$l]=$row['pmid'];
				$is[$l]=$row['iss'];
				$fir[$l]=$row['first'];
				$las[$l]=$row['last'];
				$ye[$l]=$row['yea'];
				$volu[$l]=$row['vol'];
				$article_id[$l]=$row['id'];
				$doi_list[$l]=$row['doi'];
				$l++;
			}
			for($ll=0;$ll<$l;$ll++)
			{
				$article_author_rel="SELECT DISTINCT b.Author_id AS auth_id FROM ArticleAuthorRel AS b WHERE b.Article_id='$article_id[$ll]' ORDER BY b.author_pos";
				$results=mysql_query($article_author_rel);
				if($publi[$ll]!="")
				{
					print("<br/>");
					print("<b>".$ttls[$ll]."</b>");
					print("<br/>");
					$g=0;
					while($rows = mysql_fetch_array($results, MYSQL_ASSOC))
					{
						$auth_id=$rows['auth_id'];
						$fetch_auth="SELECT DISTINCT c.name AS name_auth FROM Author c WHERE c.id='$auth_id'";
						$ress=mysql_query($fetch_auth);
						while($arows = mysql_fetch_array($ress, MYSQL_ASSOC))
						{
							$auth_name=$arows['name_auth'];
							$auth_name=preg_replace("/'/", "&#39;", $auth_name);
							if ($g == 0)
							{
								print($auth_name);
							}
							else
							{
								print(", ".$auth_name);
							}
						}	
						$g++;
					}
					print(".<br/>");
					print($publi[$ll].", ");
					print($ye[$ll].", ");
					print($volu[$ll]." (");
					print($is[$ll]."), pages: ");
					print($fir[$ll]." - ".$las[$ll]);
					print(".<br/>");
					print("PMID/ISBN: ");
					print($pm[$ll]);
					print("<br/>");
				}	
			}	
		?>
		</td>
	</tr>
	</table>
	<br/>

</div>
<!-- ------------------------ -->

</body>

</html>
