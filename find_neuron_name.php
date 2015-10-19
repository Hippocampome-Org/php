<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php	
require_once('class/class.temporary_neuronname.php');
require_once('class/class.type.php');
require_once('class/class.synonym.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.articleevidencerel.php');
require_once('class/class.articleauthorrel.php');
require_once('class/class.article.php');
require_once('class/class.author.php');
require_once('class/class.synonymtyperel.php');

$articleevidencerel = new articleevidencerel($class_articleevidencerel);
$temporary = new temporary_neuronname();
$type_1 = new type($class_type);
$synonym_1 = new synonym($class_synonym);	
$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);
$article = new article($class_article);
$author = new author($class_author);
$articleauthorrel = new articleauthorrel($class_articleauthorrel);
$synonymtyperel = new synonymtyperel('SynonymTypeRel');
	
// Resume searching
if ($_REQUEST['resume_searching_tab'])
{
	$resume_searching = $_SESSION['resume_searching'];	
	$name_temporary_table = $resume_searching;
	$_SESSION['name_temporary_table'] = $name_temporary_table;
	$temporary ->setName_table($name_temporary_table);
}

// Creates the temporary table for the search 
if ($_REQUEST['searching'])
{
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$ip_address = str_replace('.', '_', $ip_address);
	$time_t = time();
	$name_temporary_table ='search1_'.$ip_address."__".$time_t;
	$_SESSION['name_temporary_table'] = $name_temporary_table;
	$temporary ->setName_table($name_temporary_table);
	$temporary -> create_temp_table ($name_temporary_table);
	$temporary -> insert_temporary('C', 'CA1 (e)2201 Radiatum Giant');
	
	$temporary_search=0;
}
// New Request
if($_REQUEST['new'])
{
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$ip_address = str_replace('.', '_', $ip_address);
	$time_t = time();
	$name_temporary_table ='search1_'.$ip_address."__".$time_t;
	$_SESSION['name_temporary_table'] = $name_temporary_table;
	$temporary ->setName_table($name_temporary_table);
	$temporary -> create_temp_table ($name_temporary_table);
	$temporary -> insert_temporary($_GET["first_neuron"], $_GET["name_neuron"]);
	$temporary_search=0;
	
}

// update the letter in the temporary table: 
$letter = $_REQUEST['letter'];
if ($letter)
{
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$id_update = $_REQUEST['id'];
	/*----------------------------------new-------------------------------*/
					// retrieve all Names, Nicknames from table 'Type' and Names from table 'Synonym':
					$type_1 -> retrive_name();
				    $type_1->retrive_nickname();
					$synonym_1 -> retrive_name();
					$n_neuron_total_name = $type_1 -> getName_neuron();
					$n_neuron_total_nickname = $type_1 -> getNickname_neuron();
				    $n_neuron_total_synonym = $synonym_1 -> getName_neuron();
					
			    // keep only those names that have the first letter = $letter:
					
					$n_neuron = 0;
					$name_neuron = array();
						
					for ($i1=0; $i1<$n_neuron_total_name; $i1++)
					{
						$name_neuron1 = $type_1 -> getName_neuron_array($i1);		
						if ($letter == 'all')
						{
						$name_neuron[$n_neuron] = $name_neuron1;
						$n_neuron = $n_neuron + 1;		
						}
						else if ($name_neuron1[0] == $letter)
						{
						$name_neuron[$n_neuron] = $name_neuron1;					
						$n_neuron = $n_neuron + 1;
						}
                            						
					}
			if(n_neuron!== 0)
			{
			$temporary ->setName_table($name_temporary_table);
	        $temporary -> update_temporary($letter, $name_neuron[0], 1, $id_update);
	        }
			$temporary_search=0;
			$name_count=$n_neuron;	
			
			// keep only those names that have the first letter = $letter:
			$nick_neuron= array();
			$n_neuron1 = 0;		
	        for ($i1=0; $i1<$n_neuron_total_nickname; $i1++)
				{
				$name_nick_neuron = $type_1 -> getNickname_neuron_array($i1);			
				if ($letter == 'all')
					{
					$nick_neuron[$n_neuron] = $name_nick_neuron;
					$n_neuron = $n_neuron + 1;						
					}
				else if ($name_nick_neuron[0] == $letter)
						{
					    $nick_neuron[$n_neuron1] = $name_nick_neuron;
						$n_neuron1 = $n_neuron1 + 1;
						}					
				}				
			if($n_neuron1 !== 0)
			{
			$temporary ->setName_table($name_temporary_table);
			$temporary -> update_temporary($letter, $nick_neuron[0], 1, $id_update);
			}
			
			$temporary_search=0;
			$nickname_count=$n_neuron;
	
			// keep only those synonym names that have the first letter = $letter:
							
			$syn_neuron = array();
			$n_neuron2 = 0;
			for ($i1=0; $i1<$n_neuron_total_synonym; $i1++)
				{
				$name_syn_neuron = $synonym_1 -> getName_neuron_array($i1);		
				if ($letter == 'all')
					{
					$syn_neuron[$n_neuron] = $name_syn_neuron;
					$n_neuron = $n_neuron + 1;			
					}
					else if ($name_syn_neuron[0] == $letter)
						{
						$syn_neuron[$n_neuron2] = $name_syn_neuron;
						$n_neuron2 = $n_neuron2 + 1;
						}    						
					}
			
				if($n_neuron2 !==0)
				{
				$temporary ->setName_table($name_temporary_table);
				$temporary -> update_temporary($letter, $syn_neuron[0], 1, $id_update);
				}
				$temporary_search=0;
				}

	
			$neuron5 = $_REQUEST['neuron'];
			if ($neuron5)
				{
				$name_temporary_table = $_SESSION['name_temporary_table'];
				$id_update = $_REQUEST['id'];
				$temporary ->setName_table($name_temporary_table);
				$temporary -> update_temporary(NULL, $neuron5, 2, $id_update);
				$temporary_search=1;
				}

	// ADD a new line for a new Author: --------------------------------------------------------------------
if ($_REQUEST['plus'])
{
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$temporary ->setName_table($name_temporary_table);
	$temporary -> insert_temporary('C', 'CA1 (e)2201 Radiatum Giant');
	$temporary_search=0;	
}

// REMOVE line  -----------------------------------------------------------------------------------------
if ($_REQUEST['remove'])
{
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$temporary ->setName_table($name_temporary_table);
	$id_temp = $_REQUEST['id'];
	$temporary -> remove($id_temp);
	$temporary_search=1;
}

// Show result --------------------------------------------------------------------------------------------
if ($_REQUEST['see_result'])
{
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$temporary ->setName_table($name_temporary_table);
	$temporary_search=1;
}
if ($temporary_search == 1)
{
	$temporary -> retrieve_id();
	$n_id = $temporary -> getN_id();
}

// Clear all ---------------------------------------------
if ($_REQUEST['clear_all'])
{
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$query = "TRUNCATE $name_temporary_table";
	$rs = mysqli_query($GLOBALS['conn'],$query);
	// Creates the temporary table:
	$temporary -> setName_table($name_temporary_table);	
	$temporary -> insert_temporary('C', 'CA1 (e)2201 Radiatum Giant');
}
// -------------------------------------------------------
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
// Javascript function *****************************************************************************************************
function letter(link, id_1)
{
	var letter=link[link.selectedIndex].value;
	var id = id_1;
	
	var destination_page = "find_neuron_name.php";
	location.href = destination_page+"?letter="+letter+"&id="+id;
}

function neuron(link, id_1)
{
	var neuron=link[link.selectedIndex].value;
	var id = id_1;
	
	var destination_page = "find_neuron_name.php";
	location.href = destination_page+"?neuron="+neuron+"&id="+id;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>

<title>Find Neuron Name/Synonym</title>

<script type="text/javascript" src="style/resolution.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script src="DataTables-1.9.4/media/js/jquery.js" type="text/javascript"></script>
<script src="DataTables-1.9.4/media/js/jquery.dataTables.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="DataTables-1.9.4/media/css/demo_table_jui.css"/>
<link rel="stylesheet" type="text/css" href="DataTables-1.9.4/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css"/>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$('#tab_res').dataTable({
			"sPaginationType":"full_numbers",
			"bJQueryUI":true,
			"oLanguage": {
			      "sSearch": "Search for keywords inside the table:"
			    },
			"iDisplayLength": 25
		});
});
</script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>	
	
<div class='title_area'>
<font class="font1">Search by Neuron Name/Synonym</font>
</div>	
<div class="table_position_search_page" >
		<!-- ****************  BODY **************** -->
			<?php
			if ($temporary_search == 1)
				{
				if ($n_id == 1)
					print ("<font class='font12'>$n_id Neuron Name has been selected</font>");
					else if ($n_id > 1)
							print ("<font class='font12'> $n_id Neuron Names have been selected</font>");
					else
							print ("<font class='font12'> 0 Neuron Names have been selected</font>");
				}
			?>
			
				<table border="0" cellspacing="3" cellpadding="0" class='table_search' style ="width:auto">
					<tr >
		              <td align="center" width="10%" class='table_neuron_page3'>Neuron Initial</td>
			          <td align="center" width="20%" class='table_neuron_page3'>Name/Synonym</td>
					</tr>
				
				<?php
				$temporary -> retrieve_id();
				$n_search = $temporary -> getN_id();
				for ($i=0; $i<$n_search; $i++)
				{
					
				     print ("<tr>
							<td align='center' class='table_neuron_page1' style ='width: 20px'>");
						
						$id = $temporary -> getID_array($i);
						print ("<select name='letter1' size='1' cols='10' class='select1' onChange=\"letter(this, $id)\">");
						
						$temporary -> retrieve_letter_from_id($id);
						$letter_t = $temporary -> getLetter();
						if ($letter_t)
						{
							if ($letter_t == 'all')
								$letter_t  = 'all';
							print ("<OPTION VALUE='$letter_t'> $letter_t </OPTION>");					
						}
						print ("
							<OPTION VALUE='A'> A </OPTION>			
							<OPTION VALUE='B'> B </OPTION>
							<OPTION VALUE='C'> C </OPTION>
							<OPTION VALUE='D'> D </OPTION>
							<OPTION VALUE='E'> E </OPTION>
							<OPTION VALUE='F'> F </OPTION>
							<OPTION VALUE='G'> G </OPTION>
							<OPTION VALUE='H'> H </OPTION>
							<OPTION VALUE='I'> I </OPTION>
							<OPTION VALUE='J'> J </OPTION>
							<OPTION VALUE='K'> K </OPTION>
							<OPTION VALUE='L'> L </OPTION>
							<OPTION VALUE='M'> M </OPTION>
							<OPTION VALUE='N'> N </OPTION>
							<OPTION VALUE='O'> O </OPTION>
							<OPTION VALUE='P'> P </OPTION>
							<OPTION VALUE='Q'> Q </OPTION>
							<OPTION VALUE='R'> R </OPTION>
							<OPTION VALUE='S'> S </OPTION>
							<OPTION VALUE='T'> T </OPTION>
							<OPTION VALUE='U'> U </OPTION>
							<OPTION VALUE='V'> V </OPTION>
							<OPTION VALUE='W'> W </OPTION>			
							<OPTION VALUE='X'> X </OPTION>
							<OPTION VALUE='Y'> Y </OPTION>
							<OPTION VALUE='Z'> Z </OPTION>		
							<OPTION VALUE='all'> all </OPTION>					
						</select>
					</td>");
					
					// retrieve all Names, Nicknames from table 'Type' and Names from table 'Synonym':
				    $type_1 -> retrive_name();
				    $type_1 -> retrive_nickname();
				    $synonym_1 -> retrive_name();
					$n_neuron_total_name = $type_1 -> getName_neuron();
					$n_neuron_total_nickname = $type_1 -> getNickname_neuron();
				    $n_neuron_total_synonym = $synonym_1 -> getName_neuron();
					
					// keep only the names from table 'Type' that have the first letter = $letter_t:
					$n_neuron = 0;
					$name_neuron = array();
					for ($i1=0; $i1<$n_neuron_total_name; $i1++)
					{
						$name_neuron1 = $type_1 -> getName_neuron_array($i1);
						if ($letter_t == 'all')
						{
							$name_neuron[$n_neuron] = $name_neuron1;
							$n_neuron = $n_neuron + 1;						
						}
						else
						{
							if ($name_neuron1[0] == $letter_t)
							{
								$name_neuron[$n_neuron] = $name_neuron1;
								$n_neuron = $n_neuron + 1;
							}
						}
														
                      						
					}
				    sort($name_neuron);	
				    $name_count=$n_neuron;
					
	              // keep only the nicknames from table 'Type' that have the first letter = $letter_t:
		             $nick_neuron = array();
					 $n_neuron1 = 0;
	                 for ($i1=0; $i1<$n_neuron_total_nickname; $i1++)
					{
				//$name_neuron1 = $type_1 -> getName_neuron_array($i1);
					$name_nick_neuron = $type_1 -> getNickname_neuron_array($i1);
			
						if ($letter_t == 'all')
						{
							$nick_neuron[$n_neuron] = $name_nick_neuron;
							$n_neuron = $n_neuron + 1;						
						}
						else
						{
						
							if ($name_nick_neuron[0] == $letter_t)
							{
							    $nick_neuron[$n_neuron1] = $name_nick_neuron;
								$n_neuron1 = $n_neuron1 + 1;
							}
						} 		    							
					}	
					$nickname_count=$n_neuron;		
					
				 // keep only the synonym names from table 'Synonym' that have the first letter = $letter_t:
					$syn_neuron =array();
					$n_neuron2 = 0;
					for ($i1=0; $i1<$n_neuron_total_synonym; $i1++)
					{
						$name_syn_neuron = $synonym_1 -> getName_neuron_array($i1);		
						if ($letter_t == 'all')
						{
							$syn_neuron[$n_neuron] = $name_syn_neuron;
							$n_neuron = $n_neuron + 1;		
						}
						else
                       {						
					   if ($name_syn_neuron[0] == $letter_t)
							{
								$syn_neuron[$n_neuron2] = $name_syn_neuron;
								$n_neuron2 = $n_neuron2 + 1;
							}
                      }
					}
					
			 			
					print ("<td align='center' width='20%' class='table_neuron_page1'>");				
					print ("<select name='neuron1' size='1' cols='10' class='select1' onChange=\"neuron(this, $id)\">");
					
					$temporary -> retrieve_neuron_from_id($id);
					$name_neuron_right = $temporary -> getNeuron();	
					
					//get all the names, nicknames and synonyms that coresspond to a particluar letter
				    $result = array_merge($name_neuron,$nick_neuron,$syn_neuron);  
					$total =0;
					$total = $n_neuron + $n_neuron1 + $n_neuron2;
					sort($result);
					
					if ($name_neuron_right)
					{
						$temp_neuron= htmlspecialchars($name_neuron_right,ENT_QUOTES);	
						echo "<option value='".$temp_neuron."'>".stripslashes($name_neuron_right)."</option>";
						print ("<OPTION VALUE='' disabled></OPTION>");
					}	
					
					
					if ($total === 0)
						print ("<OPTION VALUE=''>-</OPTION>");
					else
					{
						for ($k1=0; $k1<$total; $k1++)
						{
							$temp_neuron= htmlspecialchars($result[$k1],ENT_QUOTES);	
			                echo "<option value='".$temp_neuron."'>".$result[$k1]. "</option>";
						}
						
					}
					print ("</select>");
					print ("</td><td align='center' width='5%'>
								<form action='find_neuron_name.php' method='post' style='display:inline'> 
								<input type='submit' name='plus' value=' + ' class='more_button'>
								</form>
							 </td>");
										
					if ($i > 0)		 
						print ("</td><td align='center' width='5%'>
								<form action='find_neuron_name.php' method='post' style='display:inline'> 
								<input type='submit' name='remove' value=' - ' class='more_button'>
								<input type='hidden' name='id' value='$id'>
								</form>
								</td>");
					else
						print ("</td><td align='center' width='5%'> </td>");
						print ("</td><td align='center' width='40%'>  </td>");
					
}
?>
		</tr>
	</table>
	<br />

	<div align="left" >
	<table width='250px'>
		<tr>
		<td><form action="find_neuron_name.php" method="post" style='display:inline'>	
			<input type='submit' name='clear_all' value='CLEAR ALL' />
		</form></td>
		<td width='40%'><form action='find_neuron_name.php' method='post' style='display:inline'> 
			<input type="submit" name='see_result' value='SEE RESULTS' />
		</form></td>
		</tr>
	</table>
	
	<br /><br /><br />
	
	<?php
		if ($_REQUEST['see_result'])
		{
			
			print ("<table border='0'  class='table_result' id='tab_res' width='100%'>");
			print ("<thead><tr>
						<th align='center' width='20%' class='table_neuron_page1'> <strong>Authors</strong> </th>
                          <th align='center' width='40%' class='table_neuron_page1'> <strong>Title </strong></th></font>			
						  <th align='center' width='10%' class='table_neuron_page1'> <strong>Journal/Book </strong></th></font>
						  <th align='center' width='5%' class='table_neuron_page1'> <strong>Year </strong></th></font>
						  <th align='center' width='5%' class='table_neuron_page1'> <strong>PMID/ISBN </strong></th></font>
						  <th align='center' width='20%' class='table_neuron_page1'> <strong>Types</strong></th></font>
					</tr></thead><tbody>");		  
				
		 $temporary -> retrieve_id();
	     $n_id = $temporary -> getN_id();
   for ($j1=0; $j1<$n_id; $j1++)
   {
		$name_aut_neur[$j1] = $temporary -> getNeuron_array($j1);
		$name_neuron=$name_aut_neur[$j1];
		
		$type_1 -> retrive_name();
		$type_1 -> retrive_nickname();
		$n_total_name = $type_1 -> getName_neuron();	
		$value_from_type = 0;
    for($i2=0; $i2<$n_total_name; $i2++) //If the neuron selected is from field name of table Type
		{
		    if($name_neuron == $type_1 -> getName_neuron_array($i2))
		    {
		    $type_1 -> retrive_id_by_name($name_neuron);
			$id_neuron = $type_1 -> getID_namearray(0);
			$value_from_type = $value_from_type + 1;
		    }
		    
			else if($name_neuron == $type_1 -> getNickname_neuron_array($i2))//If the neuron selected is from field nickname of table Type
		    {
			$type_1 ->  retrive_name_by_nickname1($name_neuron);
			$nickname_id = $type_1 ->getName_neuron_array(0);
			$type_1 -> retrive_id_by_name($nickname_id);
			$id_neuron = $type_1 -> getID_namearray(0);
			$value_from_type= $value_from_type + 1;		
	       }
	   }  
	   
	if($value_from_type == 0)   //If the neuron selected is from field 'name' of table 'Synonym' 
	{
	    $synonym_1 -> retrive_name() ;
	    $n_total_syn =$synonym_1 ->getName_neuron();
		
	    for($i3=0; $i3<$n_total_syn; $i3++)     
		{

		     if($name_neuron == $synonym_1 -> getName_neuron_array($i3))
		     {
		     $synonym_1 -> retrive_id_by_name($name_neuron);
		     $id_synonym = $synonym_1 -> getID_array(0);
		     $synonymtyperel -> retrive_type_id_by_syn_id($id_synonym);
		     $id_neuron= $synonymtyperel -> getID_type_array(0);	 
	         }
	    }
	}

            $articleevidencerel ->setarticle_id_array(NULL,0);
		    $evidencepropertyyperel -> retrive_evidence_id2($id_neuron);
			$n_evidence_id_3 =0;
					
			$n_evidence_id_3 = $evidencepropertyyperel -> getN_evidence_id();
			$n_article_3=0;
					
			for ($i1=0; $i1<$n_evidence_id_3; $i1++)
				{
				$evidence_id_for_articles = $evidencepropertyyperel -> getEvidence_id_array($i1);
				
				// retrieve id_article from ArticleEvidenceRel by using $evidence_id_for_articles
					$articleevidencerel -> retrive_article_id($evidence_id_for_articles);
					$id_article_3 = $articleevidencerel -> getarticle_id_array(0);
					if ($id_article_3 === NULL);
					else
					{
						$id_article_4[$n_article_3] = $id_article_3;
						$n_article_3 = $n_article_3 + 1;
					}
				}
					// To create an unique array for Id_article
				sort($id_article_4);
				$n_article_real = 0;
				$id_proof = NULL;
				for ($i11=0; $i11<$n_article_3; $i11++)
				{
					if ($id_proof == $id_article_4[$i11]);
					else
					{
						$id_article_4_unique[$n_article_real] = $id_article_4[$i11];
						$id_proof = $id_article_4[$i11];
						$n_article_real = $n_article_real + 1;
					}
				}
	
		//------------------------------------------------------------------------------------------------------------------------------------------

           for ($i1=0; $i1<$n_article_real; $i1++)
				{
				$article -> retrive_by_id($id_article_4_unique[$i1]);
				$article_title[$i1] = $article -> getTitle();	
                $articleauthorrel -> retrive_author_position($id_article_4_unique[$i1]);
				$n_author = $articleauthorrel -> getN_author_id();
			
					for ($ii3=0; $ii3<$n_author; $ii3++)
						$auth_pos[$ii3] = $articleauthorrel -> getAuthor_position_array($ii3);
						
						sort ($auth_pos);
						$name_authors1 = NULL;
						for ($ii3=0; $ii3<$n_author; $ii3++)
					     {
					      $articleauthorrel -> retrive_author_id($id_article_4_unique[$i1], $auth_pos[$ii3]);
					      $id_author = $articleauthorrel -> getAuthor_id_array(0);
					      $author -> retrive_by_id($id_author);
					      $name_a[$ii3] = $author -> getName_author_array(0);
					      $name_authors1 = $name_authors1.", ".$name_a[$ii3];
			              }
			              $name_authors1[0]='';
			              $name_authors2[$i1] =$name_authors1;

			        $title_article_correct = NULL;
			        $art=$article_title[$i1];
			        $article -> retrive_by_id($art_id[$i1]);
				    $pmid[$i1] = $article -> getPmid_isbn();
					$article_title[$i1] = $article -> getTitle();	
                    $vol[$i1] = $article -> getPublication();	
                    $yea[$i1] = $article -> getYear();	
					$years=substr($yea[$i1], 0, 4);
					
					if (strlen($pmid[$i]) > 10 )
					{	
					$link2 = "<a href='$link_isbn$pmid[$i]' target='_blank'>";	
					}
					else
					{
					$value_link ='PMID: '.$pmid[$i];
					$link2 = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$value_link' target='_blank'>";										
					}					
				
				
					print ("<tr>
							<td align='left' width='20%' class='table_neuron_page4'>$name_authors2[$i1]</td>
							<td align='left' width='40%' class='table_neuron_page4'>$article_title[$i1]</td>
							<td align='left' width='10%' class='table_neuron_page4'>$vol[$i1] </td>
							<td align='left' width='5%' class='table_neuron_page4'>$years </td>
							<td align='left' width='5%' class='table_neuron_page4'>$link2 <font class='font13'>$pmid[$i1]</font> </a></td>");
					print("<td align='left' width='20%' class='table_neuron_page4'>");
			
$a= "SELECT `Article`.`id` AS `Article_id`, `pmid_isbn`, `Type`.* FROM `Article` INNER JOIN `ArticleEvidenceRel` ON (`ArticleEvidenceRel`.`Article_id` = `Article`.`id`) INNER JOIN `EvidenceFragmentRel` ON (`ArticleEvidenceRel`.`Evidence_id` = `EvidenceFragmentRel`.`Evidence_id`) INNER JOIN `FragmentTypeRel` ON (`EvidenceFragmentRel`.`Fragment_id` = `FragmentTypeRel`.`Fragment_id`) INNER JOIN `Type` ON `Type`.`id` = `FragmentTypeRel`.`Type_id` WHERE(`pmid_isbn` = '$pmid[$i1]')";
$Type_name = mysqli_query($GLOBALS['conn'],$a);
				if (!$Type_name) {
					die("<p>Error in listing tables:" . mysqli_error($GLOBALS['conn']) . "</p>");
				}
				$f=0;
				$o=1;
				$t_n=array();
		while($rows=mysqli_fetch_array($Type_name, MYSQL_ASSOC))
		{
			$ty_name=$rows['name'];
			$ty_nick=$rows['nickname'];
			$ty_status =$rows['status'];
			$ty_id = $rows['id'];
			$x=0;
			for($v=0;$v<sizeof($t_n);$v++)
			{
				if($t_n[$v]!=$ty_name)
				{
					$x=0;
					continue;
				}
				else 
				{
					$x=1;
					break;
				}
					
			}
				if($x==1)
				{
					continue;
				}
					if($ty_status!='frozen')
					{
						print("$o)&nbsp;<a href='neuron_page.php?id=$ty_id' target='_blank' title='".$ty_name."'>$ty_nick</a><br/>");
						$o=$o+1;
					}
			$t_n[$f]=$ty_name;
			
			$f=$f+1;
		}			
			if($o==1)
			{
				print("(to be determined)");
			}	
			
				print ("</td></tr>");
			}//END $i
	
		}//END $j1
	
	print("</tbody></table>");
		}
	?>
	<br /><br />
	</div>
</div>
</body>
</html>

