<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
	
include ("access_db.php");
include ("function/name_ephys.php");
include ("function/name_ephys_for_evidence.php");
include ("function/get_abbreviation_definition_box.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.synonym.php');
require_once('class/class.fragment.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.article.php');
require_once('class/class.author.php');
require_once('class/class.evidencefragmentrel.php');
require_once('class/class.articleevidencerel.php');
require_once('class/class.articleauthorrel.php');
require_once('class/class.evidencemarkerdatarel.php');
require_once('class/class.markerdata.php');
require_once('class/class.evidenceevidencerel.php');
require_once('class/class.epdata.php');
require_once('class/class.epdataevidencerel.php');

function show_ephys($var)
{
	if($var == 'Vrest')
	{	
		$name_show = 'V<small><sub>rest</small></sub>';
		$flag = 2;
		$units='mV';
	}
	if($var == 'Rin')
	{	
		$name_show = 'R<small><sub>in</small></sub>';
		$flag = 2;
		$units='M&Omega;';
	}
	if($var == 'tm')
	{	
		$name_show = '&tau;<small><sub>m</small></sub>';
		$flag = 1;
		$units='ms';
	}
	if($var == 'Vthresh')
	{	
		$name_show = 'V<small><sub>thresh</small></sub>';
		$flag = 2;
		$units='mV';
	}	
	if($var == 'fast_AHP')
	{	
    //		$name_show = 'Fast AHP<small><sub>ampl</small></sub>';
		$name_show = 'Fast AHP';
		$flag = 2;
		$units='mV';
	}	
	if($var == 'AP_ampl')
	{	
		$name_show = 'AP<small><sub>ampl</small></sub>';
		$flag = 1;
		$units='mV';
	}		
	if($var == 'AP_width')
	{	
		$name_show = 'AP<small><sub>width</small></sub>';
		$flag = 1;
		$units='ms';
	}		
	if($var == 'max_fr')
	{	
		$name_show = 'Max F.R.';
		$flag = 1;
		$units='Hz';
	}		
	if($var == 'slow_AHP')
	{	
		$name_show = 'Slow AHP';
		$flag = 1;
		$units='mV';
	}
	if($var == 'sag_ratio')
	{	
		$name_show = 'Sag ratio';
		$flag = 1;
		$units='';
	}

	$res[0]= $name_show;    //name showed
	$res[1] =$flag;
	$res[2] =$units;

	return($res);
}


$id_neuron = $_REQUEST['id_neuron'];
$id_ephys = $_REQUEST['id_ephys'];
$ep1 = $_REQUEST['ep'];

$ep= real_name_ephys($ep1);

$complete_name = real_name_ephys_evidence($ep1);


$type = new type($class_type);
$type -> retrive_by_id($id_neuron);

$articleevidencerel = new articleevidencerel($class_articleevidencerel);
$article = new article($class_article);

$epdataevidencerel = new epdataevidencerel($class_epdataevidencerel);
$epdata = new epdata($class_epdata);

$evidenceevidencerel = new evidenceevidencerel($class_evidenceevidencerel);
$articleevidencerel = new articleevidencerel($class_articleevidencerel);
$article = new article($class_article);

$evidencefragmentrel = new evidencefragmentrel($class_evidencefragmentrel);
$fragment = new fragment ($class_fragment);


// retrieve the id_property by using $ep (es. Vrest):
$property = new property($class_property);
$property -> retrive_ID(3, $ep, NULL, NULL);

$id_property = $property -> getProperty_id(0);

// retrieve the id_evidence by id_type amd id_property:
$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);
$evidencepropertyyperel -> retrive_evidence_id($id_property, $id_neuron);

$n_evidence_id = $evidencepropertyyperel -> getN_evidence_id();

for ($i1=0; $i1<$n_evidence_id; $i1++)
{
	$id_evidence[$i1] = $evidencepropertyyperel -> getEvidence_id_array($i1);

	// with evidence_id1 it needs to have evidence_id2 that is used for the id_article
	$evidenceevidencerel -> retrive_evidence2_id($id_evidence[$i1]);
	$id_evidence_2[$i1] = $evidenceevidencerel -> getEvidence2_id_array(0);

	// retrieve the id_epdata by id_evidence:
	$epdataevidencerel -> retrive_Epdata($id_evidence[$i1]);
	$id_epdata[$i1] = $epdataevidencerel -> getEpdata_id();
}// end FOR $i1

$n_epdata = $n_evidence_id;


// Retrieve all information from table: EPDATA:
$value1_tot = 0;

for ($i1=0; $i1<$n_epdata; $i1++)
{
	$epdata -> retrive_all_information($id_epdata[$i1]);
	$raw[$i1] = $epdata -> getRaw();
	$value1[$i1]=$epdata -> getValue1();
	$value2[$i1] = $epdata -> getValue2();
	$error[$i1] =  $epdata -> getError();
	$n_measurement[$i1] =  $epdata -> getN();
	$istim[$i1] =  $epdata -> getIstim();	
	$time[$i1] =  $epdata -> getTime();	
	$std_sem[$i1] =  $epdata -> getStd_sem();		
		
} // end FOR $i1


// ARTICLE -----------------------------------------------------------------------
for ($i1=0; $i1<$n_epdata; $i1++)
{

	// retriveve information about fragment: --------------
	$evidencefragmentrel -> retrive_fragment_id_1($id_evidence_2[$i1]);
	$id_fragment = $evidencefragmentrel -> getFragment_id();
	$fragment -> retrive_by_id($id_fragment);
	$fragment_page_location[$i1] = $fragment -> getPage_location();
	
	// retrieve the article_id ffrom evidencearticleRel:
	$articleevidencerel -> retrive_article_id($id_evidence_2[$i1]);
	$id_article = $articleevidencerel -> getarticle_id_array(0);

	$id_article_1[$i1] = $id_article;

	$article -> retrive_by_id($id_article);
	
	$title[$i1] = $article -> getTitle();
	$publication[$i1] = $article -> getPublication();
	$year[$i1] = $article -> getYear();
	$volume[$i1] = $article -> getVolume();
	$pages[$i1] = $article -> getFirst_page()." - ".$article ->getLast_page();
	$pmcid[$i1] = $article -> getPmcid();
	$nihmsid[$i1] = $article -> getNihmsid();
	$doi[$i1] = $article -> getDoi();
	$citation[$i1] = $article -> getCitation_count();
	$PMID1[$i1] = $article -> getPmid_isbn($pmid_isbn);
	$issue[$i1] = $article -> getIssue($pmid_isbn);
	
	$articleauthorrel = new articleauthorrel($class_articleauthorrel);
	$author = new author($class_author);
	
	// retrive the Author Position from ArticleAuthorRel
	$articleauthorrel -> retrive_author_position($id_article);
	$n_author = $articleauthorrel -> getN_author_id();
	for ($ii3=0; $ii3<$n_author; $ii3++)
		$auth_pos[$ii3] = $articleauthorrel -> getAuthor_position_array($ii3);
		
	sort ($auth_pos);
	
	$name_authors = NULL;
	for ($ii3=0; $ii3<$n_author; $ii3++)
	{
		$articleauthorrel -> retrive_author_id($id_article, $auth_pos[$ii3]);
		$id_author = $articleauthorrel -> getAuthor_id_array(0);
		
		$author -> retrive_by_id($id_author);
		$name_a = $author -> getName_author_array(0);
		
		$name_authors = $name_authors.', '.$name_a;
	}
	$name_authors[0] = '';		

	$nominative_authors[$i1] = $name_authors;

} // end FOR $i1

$n_article = $n_epdata;

$res=show_ephys($ep);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Evidence Page</title>
 <script type="text/javascript" src="style/resolution.js"></script> 
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php include ("function/title.php"); ?>
		
<div align="center" class="title_3">
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%">
			<font size='5' color="#990000" face="Verdana, Arial, Helvetica, sans-serif">Evidence Page</font>
		</td>
	</tr>
	</table>
</div>

<br><br /><br><br />

<!-- ---------------------- -->
<table width="85%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="150">
    <td></td>
  </tr>
  <tr>
    <td align="center">
		<!-- ****************  BODY **************** -->
		<!-- TABLE NAME AND PROPERTY-->
		<table width="80%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td width="20%" align="right" class="table_neuron_page1">
					Neuron Type
				</td>
				<td align="left" width="80%" class="table_neuron_page2">
					&nbsp; <?php print $type->getName(); ?>
				</td>				
			</tr>							
		</table>
		
		<br />				
		
		<?php
		
		for ($i1=0; $i1<$n_article; $i1++)
		{		
			print ("<table width='80%' border='0' cellspacing='2' cellpadding='5'>");
			
			print ("
				<tr>
				<td width='10%' align='center'>
				</td>
				<td width='5%' align='center' class='table_neuron_page2' valign='center'>
			");							
	
									
			if (strlen($PMID1[$i1]) > 10 )
			{									
				$link2 = "<a href='$link_isbn$PMID1[$i1]' target='_blank'>";
				$string_pmid = "<strong>ISBN: </strong>".$link2;	
			}
			else
			{
				$value_link ='PMID: '.$PMID1[$i1];
				$link2 = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$value_link' target='_blank'>";								
				$string_pmid = "<strong>PMID: </strong>".$link2;			
			}
			
			if ($issue[$i1] != NULL)
				$issue_tot = "($issue[$i1]),";
			else
				$issue_tot = "";			

			if ($doi[$i1] != NULL)
				$doi_tot = "DOI: $doi[$i1]";
			else
				$doi_tot = "";
								
			print ("
				</td>							
				<td align='left' width='85%' class='table_neuron_page2'>
				
				<font color='#000000'>
				<strong>$title[$i1]</strong></font> <br>
				$nominative_authors[$i1] <br>
				$publication[$i1], $year[$i1], $volume[$i1] $issue_tot pages: $pages[$i1] <br>
				$string_pmid <font class='font13'>$PMID1[$i1]</font></a>; $doi_tot ");
				
				if ($fragment_page_location[$i1])
				{
					print ("<br>Page location: $fragment_page_location[$i1]");
				}	
				
				print ("</td>	
				</tr>	
			
			<tr>
				<td width='10%' align='center'>
				</td>					
				<td width='5%' align='center' class='table_neuron_page2'>
				</td>								
				<td align='left' width='85%' class='table_neuron_page2'>");
				if ($res[0]=='Sag ratio')
					print ("<strong>$complete_name:</strong> ");
				else
				  print ("<strong>$complete_name ($res[0]):</strong> ");
			
				// *************************************************************************************************
				// *************************************************************************************************
				
				// BEGIN CLR modifications...				
				
				// both value1 and value2:
				if ($value1[$i1] && $value2[$i1] && !$istim[$i1])
				{
					if ($res[2] != '')
    					$meas ="[$value1[$i1], $value2[$i1]] $res[2]";
					else
					    $meas ="[$value1[$i1], $value2[$i1]]";
				}
				// no value2, but has value1 and error:
				if ($value1[$i1] && $error[$i1] && !$istim[$i1])
				{
					// original code, pre-Vrest minus sign kludge
					if ($res[2] != '')
    					$meas="$value1[$i1] &plusmn; $error[$i1] $res[2]";
					else
					    $meas="$value1[$i1] &plusmn; $error[$i1]";
							
					// start of Vrest minus sign kludge
					//if ($res[0] == 'V<small><sub>rest</small></sub>')
					//	$meas =" -$value1[$i1] &plusmn; $error[$i1] $res[2] ";
					//else
					//	$meas =" $value1[$i1] &plusmn; $error[$i1] $res[2] ";
					// end of Vrest minus sign kludge
				}
				// no value2, but has value1 and error:
				if ($value1[$i1] && !$value2[$i1] && !$error[$i1] && !$istim[$i1])
				{ 	
						$meas ="$value1[$i1] $res[2]";
				}				
				// istim field
				if (($istim[$i1]) and ($istim[$i1] !='unknown' ))
				{ 
					
					if ($value2[$i1])
					{
						$mean_value = ($value1[$i1] + $value2[$i1]) / 2;
						$range = "[$value1[$i1] - $value2[$i1]]";
					}
					else
					{
						$mean_value = "$value1[$i1]";	
						$range = "";
					}
					
					if ($error[$i1])
						$error_value = "&plusmn; $error[$i1]";
					else
					  $error_value = "";
					if ($time[$i1])
						 $time_val = ", $time[$i1] ms";
					else
					   $time_val = "";
					if ($istim[$i1])
						$istim_show =", $istim[$i1] pA";
					else
					  $istim_show ="";

					if ($res[2] != '')	
							$meas ="$mean_value $range $error_value $res[2]$istim_show$time_val";
					else
							{
							    if ($error_value=='' && $range == '')
									    $meas="$mean_value$istim_show$time_val";
									elseif ($error_value=='')
    									$meas="$mean_value $range$istim_show$time_val";
									elseif ($range == '')
											$meas="$mean_value $error_value$istim_show$time_val";
							}
				}				
			

				if ($error[$i1])
				{
					if ($std_sem[$i1] == 'std')
						$std_sem_value = ", Mean &plusmn; SD";
					else if ($std_sem[$i1] == 'sem')	
						$std_sem_value = ", Mean &plusmn; SEM";
					else
						$std_sem_value ='';
						
					$n_error=1;	
				}
				else
					$std_sem_value ='';		
				
				
				if ($n_measurement[$i1])
					$N = "(n=$n_measurement[$i1])";
				else 	 						// R 2C (n=1)
					$N = "(n=1)";	// R 2C (n=1)
				  

				print ("$meas $N$std_sem_value");	
				print ("</td></tr></table>");
				
			// ... END CLR modifications		

			print ("<br>");

		} // end FOR $i1		
    // Abbreviation Definition Box
    if (array_unique($std_sem)) {  // checks for non-null vals
      $definitions = get_abbreviation_definitions($std_sem);
      $definition_str = implode('; ', $definitions);
      print "<table align='center' width='80%' border='0' cellspacing='2' cellpadding='2'>
        <tr>
        <td width='10%' align='right'>
        </td>
        <td align='left' padding='2' width='90%' class='table_neuron_page2'>
        $definition_str
        </td>				
        </tr>							
        </table>";
    }

		?>

		</td>
	</tr>	
</table>	
	
	
</body>
</html>
