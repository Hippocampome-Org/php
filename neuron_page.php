<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
	
include ("access_db.php");
include ("function/neuron_page_text_file.php");
include ("function/name_ephys_for_evidence.php");
include ("function/get_abbreviation_definition_box.php");
include ("function/stm_lib.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.synonym.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.epdata.php');
require_once('class/class.synonymtyperel.php');
require_once('class/class.fragmenttyperel.php');
require_once('class/class.fragment.php');
require_once('class/class.evidencefragmentrel.php');
require_once('class/class.typetyperel.php');

require_once('class/class.article.php');
require_once('class/class.author.php');
require_once('class/class.articleevidencerel.php');
require_once('class/class.articleauthorrel.php');

function show_ephys($var)
{
	if($var == 'Vrest')
	{	
		$name_show = 'V<small><sub>rest</small></sub>';
		$flag = 2;
		$units = 'mV';
		$num_decimals = 1;
	}
	if($var == 'Rin')
	{	
		$name_show = 'R<small><sub>in</small></sub>';
		$flag = 2;
		$units = 'M&Omega;';
		$num_decimals = 1;
	}
	if($var == 'tm')
	{	
		$name_show = '&tau;<small><sub>m</small></sub>';
		$flag = 1;
		$units = 'ms';
		$num_decimals = 1;
	}
	if($var == 'Vthresh')
	{	
		$name_show = 'V<small><sub>thresh</small></sub>';
		$flag = 2;
		$units = 'mV';
		$num_decimals = 1;
	}	
	if($var == 'fast_AHP')
	{	
    //		$name_show = 'Fast AHP<small><sub>ampl</small></sub>';
		$name_show = 'Fast AHP';
		$flag = 2;
		$units = 'mV';
		$num_decimals = 1;
	}	
	if($var == 'AP_ampl')
	{	
		$name_show = 'AP<small><sub>ampl</small></sub>';
		$flag = 1;
		$units = 'mV';
		$num_decimals = 1;
	}		
	if($var == 'AP_width')
	{	
		$name_show = 'AP<small><sub>width</small></sub>';
		$flag = 1;
		$units = 'ms';
		$num_decimals = 2;
	}		
	if($var == 'max_fr')
	{	
		$name_show = 'Max F.R.';
		$flag = 1;
		$units = 'Hz';
		$num_decimals = 1;
	}		
	if($var == 'slow_AHP')
	{	
		$name_show = 'Slow AHP';
		$flag = 1;
		$units = 'mV';
		$num_decimals = 2;
	}
	if($var == 'sag_ratio')
	{	
		$name_show = 'Sag ratio';
		$flag = 1;
		$units = '';
		$num_decimals = 2;
	}

	$res[0] = $name_show;    //name showed
	$res[1] = $flag;
	$res[2] = $units;
	$res[3] = $num_decimals;

	return($res);
}

$id = $_REQUEST['id'];
	
$type = new type($class_type);
$type -> retrive_by_id($id);

$synonym = new synonym($class_synonym);

$property = new property($class_property);

$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);

$epdataevidencerel = new epdataevidencerel($class_epdataevidencerel);

$epdata = new epdata($class_epdata);

$synonymtyperel = new synonymtyperel('SynonymTypeRel');

$fragmenttyperel = new fragmenttyperel();

$fragment = new fragment($class_fragment);

$evidencefragmentrel = new evidencefragmentrel($class_evidencefragmentrel);

$typetyperel = new typetyperel();

$articleevidencerel = new articleevidencerel($class_articleevidencerel);

$article = new article($class_article);

$articleauthorrel = new articleauthorrel($class_articleauthorrel);

$author = new author($class_author);


if ($text_file_creation)
{
	$name_file = neuron_page_text_file($id, $type, $synonymtyperel, $synonym, $evidencepropertyyperel, $property, $epdataevidencerel, $epdata, $class_type);
	print ("<script type=\"text/javascript\">");
	echo("window.open('$name_file','', 'menubar=yes, width=900, height=700' );");
	print ("</script>");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ("function/icon.html"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Neuron page</title>
<script src="lightbox/js/jquery-1.7.2.min.js"></script>
<script src="lightbox/js/lightbox.js"></script>
<link href="lightbox/css/lightbox.css" rel="stylesheet"/>

<script src="jquery-ui-1.10.2.custom/js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="jquery-ui-1.10.2.custom/css/smoothness/jquery-ui-1.10.2.custom.min.css" />
<script src="jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js"></script>
 <link rel="stylesheet" href="/resources/demos/style.css" />
  
  <script>
  $(function(){
	  
	 $( "#list_acc" ).accordion({collapsible:true,active:null,heightStyle: "content",autoHeight:false});
    $( "#accordion" ).accordion({collapsible:true,heightStyle: "content",event: "click hoverintent"});
    });

  $.event.special.hoverintent = {
		    setup: function() {
		      $( this ).bind( "mouseover", jQuery.event.special.hoverintent.handler );
		    },
		    teardown: function() {
		      $( this ).unbind( "mouseover", jQuery.event.special.hoverintent.handler );
		    },
		    handler: function( event ) {
		      var currentX, currentY, timeout,
		        args = arguments,
		        target = $( event.target ),
		        previousX = event.pageX,
		        previousY = event.pageY;
		 
		      function track( event ) {
		        currentX = event.pageX;
		        currentY = event.pageY;
		      };
		 
		      function clear() {
		        target
		          .unbind( "mousemove", track )
		          .unbind( "mouseout", clear );
		        clearTimeout( timeout );
		      }
		 
		      function handler() {
		        var prop,
		          orig = event;
		 
		        if ( ( Math.abs( previousX - currentX ) +
		            Math.abs( previousY - currentY ) ) < 7 ) {
		          clear();
		 
		          event = $.Event( "hoverintent" );
		          for ( prop in orig ) {
		            if ( !( prop in event ) ) {
		              event[ prop ] = orig[ prop ];
		            }
		          }
		          // Prevent accessing the original event since the new event
		          // is fired asynchronously and the old event is no longer
		          // usable (#6028)
		          delete event.originalEvent;
		 
		          target.trigger( event );
		        } else {
		          previousX = currentX;
		          previousY = currentY;
		          timeout = setTimeout( handler, 200 );
		        }
		      }
		 
		      timeout = setTimeout( handler, 200 );
		      target.bind({
		        mousemove: track,
		        mouseout: clear
		      });
		    }
		  };
  </script>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php include ("function/title.php"); ?>

		
<div align="center" class="title_3">
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%">
			<font size='4' color="#990000" face="Verdana, Arial, Helvetica, sans-serif"><?php print $type->getSubregion(); print " "; print $type->getNickname(); ?> </font>
		</td>
	</tr>
	</table>
</div>


<!-- ---------------------- -->

<div align="center">
<table width="85%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="150">
    <td></td>
  </tr>
  <tr>
    <td align="center">
		<!-- ****************  BODY **************** -->		
		<table width="80%" border="0" cellspacing="2" cellpadding="0">
			<tr>
				<td width="20%" align="right">
					<form action="neuron_page.php" method="post" style='display:inline'>
				<!--	<input type="submit" name='text_file_creation' value=' TEXT FILE ' /> -->
					<input type="hidden" name='id' value='<?php print $id; ?>' />
					</form>
				</td>
				<td align="left" width="80%">
				</td>				
			</tr>		
		</table>		
		
		<br />
		
		<!-- TABLE NAME -->		
		<table width="80%" border="0" cellspacing="2" cellpadding="0">
			<tr>
				<td width="20%" align="right" class="table_neuron_page1">
					Name
				</td>
				<td align="left" width="80%" class="table_neuron_page1">
				</td>				
			</tr>
			<tr>
				<td width="20%" align="right">
				</td>
				<td align="left" width="80%" class="table_neuron_page2">
					&nbsp; <?php print $type->getName(); ?> 
				</td>				
			</tr>			
		</table>
		
		<br />
		
		<!-- TABLE SYNONYM -->
		<table width="80%" border="0" cellspacing="2" cellpadding="0">
			<tr>
				<td width="20%" align="right" class="table_neuron_page1">
					Synonym(s)
				</td>
				<td align="left" width="80%" class="table_neuron_page1">
				</td>				
			</tr>			
			<?php			
				// Retrive the Synonim_id from synonymtyperel by ID type:
				$synonymtyperel -> retrive_synonym_id($id);
				$n_syn = $synonymtyperel -> getN_synonym();
				
				for ($i1=0; $i1<$n_syn; $i1++)
				{
					$Synonym_id = $synonymtyperel -> getSynonym_id($i1);
					
					$synonym -> retrive_by_id($Synonym_id);
					$syn = $synonym -> getName();					
					print ("				
					<tr>
						<td width='20%' align='right'>
						</td>
						<td align='left' width='80%' class='table_neuron_page2'>
							 $syn
						</td>					
					</tr>			
					");								
				} 
			?>
		</table>		
		
		<br />	

		<!-- LIST of articles -->
			<table width="80%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="20%" align="center" class="table_neuron_page3">
					List of articles
				</td>
					</tr>
					</table>
					<table width='80%' border='0' cellspacing='2' cellpadding='0'>
					<tr>
					<td width='20%' align='right'>
						</td>
				<td align="left" width="80%" class="table_neuron_page1">
				<div id="list_acc" align="left"><em class="for_accordion"><font size='1.5' align="left"><b>Click here to view the list</b></font></em>
				<?php
				// retrieve all evidence_id from EvidencePropertyTypeRel by using type_id
				$evidencepropertyyperel -> retrive_evidence_id2($id);
				$n_evidence_id_3 = $evidencepropertyyperel -> getN_evidence_id();
				
				$n_article_3=0;
				for ($i1=0; $i1<$n_evidence_id_3; $i1++)
				{
					$evidence_id_for_articles = $evidencepropertyyperel -> getEvidence_id_array($i1);
				
					// retrieve id_article from ArticleEvidenceRel by using $evidence_id_for_articles
					$articleevidencerel -> retrive_article_id($evidence_id_for_articles);
					$id_article_3 = $articleevidencerel -> getarticle_id_array(0);

					if ($id_article_3 == NULL);
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
				for ($i1=0; $i1<$n_article_3; $i1++)
				{
					if ($id_proof == $id_article_4[$i1]);
					else
					{
						$id_article_4_unique[$n_article_real] = $id_article_4[$i1];
						$id_proof = $id_article_4[$i1];
						$n_article_real = $n_article_real + 1;
					}
				}
				
				
				$art_id=array();
				$auth_first_name_final=array();
				$h=0;
				for($i4=0;$i4<$n_article_real;$i4++)
				{
				$auth_query="SELECT DISTINCT b.Author_id AS auth_id FROM ArticleAuthorRel AS b WHERE b.Article_id='$id_article_4_unique[$i4]' ORDER BY b.author_pos";
				$query_results=mysql_query($auth_query);
				$g=0;
				$u=0;
				$auth=array();
				$auth_first_name=array();
				while($erows = mysql_fetch_array($query_results, MYSQL_ASSOC))
				{
				$auth[$g]=$erows['auth_id'];
				$fetch_auth_name="SELECT DISTINCT c.name AS name_auth FROM Author c WHERE c.id='$auth[$g]'";
				$resss=mysql_query($fetch_auth_name);
				while($drows = mysql_fetch_array($resss, MYSQL_ASSOC))
				{
				$auth_first_name[$u]=$drows['name_auth'];
				//asort($auth_first_name);
				$u++;
				}
					$g++;
				}
				$auth_first_name_final[$i4]=$auth_first_name[0];
					$art_id[$i4]=$id_article_4_unique[$i4];
				
				}
				
				array_multisort($auth_first_name_final,$art_id);
				
				
				
				for ($i1=0; $i1<$n_article_real; $i1++)
				{
					$article -> retrive_by_id($art_id[$i1]);
					$article_title[$i1] = $article -> getTitle();			
				}
				
				//sort ($article_title);
				print("<div id='accordion' align='left' class='table_neuron_page2'>");
				for($i1=0; $i1<$n_article_real; $i1++)
				{
					$title_article_correct = NULL;
					$art=$article_title[$i1];
				
				
					
					$t="SELECT a.id,a.publication AS pub,a.volume AS vol,a.pmid_isbn AS pmid,a.issue AS iss,a.first_page AS first,a.last_page AS last,a.year AS yea,a.doi AS doi FROM Article AS a WHERE a.title='$article_title[$i1]'";
					$r=mysql_query($t);
					$l=0;
					while($row = mysql_fetch_array($r, MYSQL_ASSOC))
					{
				
						$publi=$row['pub'];
						$pm=$row['pmid'];
						$is=$row['iss'];
						$fir=$row['first'];
						$las=$row['last'];
						$ye=$row['yea'];
						$volu=$row['vol'];
						$article_id=$row['id'];
						$doi_list=$row['doi'];
						$l++;
					}
					$article_author_rel="SELECT DISTINCT b.Author_id AS auth_id FROM ArticleAuthorRel AS b WHERE b.Article_id='$article_id' ORDER BY b.author_pos";
					$results=mysql_query($article_author_rel);		
					
					$g=0;
					$auths=array();
					$auth_name=array();
					while($rows = mysql_fetch_array($results, MYSQL_ASSOC))
					{
						$auths[$g]=$rows['auth_id'];
						$fetch_auth="SELECT DISTINCT c.name AS name_auth FROM Author c WHERE c.id='$auths[$g]'";
						$ress=mysql_query($fetch_auth);
						$u=0;
						while($arows = mysql_fetch_array($ress, MYSQL_ASSOC))
						{
							$auth_name[$g]=$arows['name_auth'];
							$u++;
						}	
						$g++;
					}
					$years=substr($ye, 0, 4);
					print("<em class='for_accordion'><font size='0.5' color='#000066'>$auth_name[0] &nbsp;($years) <b>$publi</b></font></em>");
					
					if (strlen($pm) > 10 )
					{
						$linking = "<a href='$link_isbn$pm' target='_blank'>";
						$pmid_string = "<strong>ISBN: </strong>".$linking;
					}
					else
					{
						$link_value ='PMID: '.$pm;
						$linking = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$link_value' target='_blank'>";
						$pmid_string = "<strong>PMID: </strong>".$linking;
					}
					print("
					<div class='table_neuron_page2'> <font color='#000000'><strong>$article_title[$i1]</strong></font><br/>");
					for($v=0;$v<sizeof($auth_name);$v++)
					{
						if($v==sizeof($auth_name)-1)
						{
							$f_auth=substr($auth_name[$v],0,1);
							print(" <a href='find_author.php?name_author=$auth_name[$v]&first_author=$f_auth&new=1&see_result=1' target='_blank'><font class='font13'> $auth_name[$v]</font></a>.<br/>");
							/*<a href='property_page_markers.php?id_neuron=$id&val_property=$part&page=markers&color=positive' target='_blank' class='$font_col'>
							$part
							</a>*/
						}
						else
						{
							$f_auth=substr($auth_name[$v],0,1);
							print(" <a href='find_author.php?name_author=$auth_name[$v]&first_author=$f_auth&new=1&see_result=1' target='_blank'><font class='font13'> $auth_name[$v]</font></a>,");
						}

					}		
					if ($is != NULL)
						$is_tot = "($is)";
					else
						$is_tot = "";
					
					if ($doi_list != NULL)
						$doi_total = "DOI: $doi_list";
					else
						$doi_total = "";

					if($volu!=null && $is_tot!=null)
					{		
					
					if($doi_total!=null)
					{		
						print("	
							$publi,
					 	$ye, $volu $is_tot,
					
						Pages: $fir - $las <br/>
						$pmid_string <font class='font13'>$pm</font></a>; $doi_total  <br/>
						</div>");
					}
					else 
					{
						print("
								$publi,
								$ye, $volu $is_tot,
									
								Pages: $fir - $las <br/>
								$pmid_string <font class='font13'>$pm</font></a><br/>
								</div>");
					}
					}
					elseif ($volu!=null && $is_tot==null){
						if($doi_total!="")
						{	
							print("
							$publi,
							$ye, $volu,
			
							Pages: $fir - $las <br/>
							$pmid_string <font class='font13'>$pm</font></a>; $doi_total  <br/>
							</div>");
						}
						else 
						{
							print("
									$publi,
									$ye, $volu,
										
									Pages: $fir - $las <br/>
									$pmid_string <font class='font13'>$pm</font></a><br/>
									</div>");
						}
						
						
						}
						elseif ($volu==null && $is_tot!=null)
						{
							if($doi_total!="")
							{
								print("
									$publi,
									$ye, $is_tot,
										
									Pages: $fir - $las <br/>
									$pmid_string <font class='font13'>$pm</font></a>; $doi_total  <br/>
									</div>");
							}
							else
							{
								print("
										$publi,
										$ye, $is_tot,
								
										Pages: $fir - $las <br/>
										$pmid_string <font class='font13'>$pm</font></a><br/>
										</div>");
							}
						}
						else
						{
							if($doi_total!=null)
							{
							print("
									$publi,
									$ye,
									Pages: $fir - $las <br/>
									$pmid_string <font class='font13'>$pm</font></a>; $doi_total  <br/>
									</div>");
							}
							else
							{
								print("
										$publi,
										$ye,
											
										Pages: $fir - $las <br/>
										$pmid_string <font class='font13'>$pm</font></a><br/>
										</div>");
							}
						}
						
				}
				?>
				</div>
				</div>	
				</td>
				</tr>						
		</table>
		<br />

		<!-- TABLE Morphology -->
		<table width="80%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="20%" align="center" class="table_neuron_page3">
					Morphology
				</td>			
			</tr>			
		</table>

				<?php

		// retrive propertytyperel.property_id By type.id 
		$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id);
	
		$n = $evidencepropertyyperel -> getN_Property_id();
		$q=0;
		for ($i5=0; $i5<$n; $i5++)
		{
			$property_id[$i5] = $evidencepropertyyperel -> getProperty_id_array($i5);		
		}

    // STM Alternative implementation of morphology table
        
    // HTML components
    function morphology_sub_table_head($title) {
      $html ="<table width='80%' border='0' cellspacing='2' cellpadding='0'>
				<tr>
					<td width='20%' align='right' class='table_neuron_page1'>
						$title
					</td>
					<td align='left' width='80%' class='table_neuron_page1'>
					</td>				
				</tr>";
      return $html;
    }
    
    function parcel_row($parcel, $part) {
      global $id;
      $parcel_for_url = str_replace(':', '_', $parcel);
      $color_table = array("axons" => "red", "dendrites" => "blue", "somata" => "somata");
      $color = $color_table[$part];
      $html = "<tr>
        <td width='20%' align='right'>
        </td>
        <td align='left' width='80%' class='table_neuron_page2'>
        <a href='property_page_morphology.php?id_neuron=$id&val_property=$parcel_for_url&color=$color&page=1' target='_blank'>
        <font class='font4'> $parcel </font>
        </a> 
        </td>					
        </tr>";
        return $html;
    }
    
    function morphology_sub_table_foot(){
      $html = "</table>";
      return $html;
    }

    // useful functions

    // needed queries
    // object REGEXP ':' in query below is to select only parcels
    $morphology_properties_query =
      "SELECT DISTINCT t.name, t.subregion, t.nickname, p.subject, p.predicate, p.object, eptr.Type_id, eptr.Property_id
      FROM EvidencePropertyTypeRel eptr
      JOIN (Property p, Type t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
      WHERE predicate = 'in' AND object REGEXP ':'";

    $one_type_query = $morphology_properties_query . " AND eptr.Type_id = '$id'";
    $axon_query = $one_type_query . " AND subject = 'axons'";
    $dendrite_query = $one_type_query . " AND subject = 'dendrites'";
    $soma_query = $one_type_query . " AND subject = 'somata'";

    // get the lists
    $result = mysql_query($soma_query);
    $soma_parcels = result_set_to_array($result, 'object');

    $result = mysql_query($axon_query);
    $axon_parcels = result_set_to_array($result, 'object');

    $result = mysql_query($dendrite_query);
    $dendrite_parcels = result_set_to_array($result, 'object');

    // print it out
    print morphology_sub_table_head("Soma");
    foreach($soma_parcels as $parcel) { print parcel_row($parcel, "somata"); }
    print morphology_sub_table_foot();

    print morphology_sub_table_head("Axons");
    foreach($axon_parcels as $parcel) { print parcel_row($parcel, "axons"); }
    print morphology_sub_table_foot();

    print morphology_sub_table_head("Dendrites");
    foreach($dendrite_parcels as $parcel) { print parcel_row($parcel, "dendrites"); }
    print morphology_sub_table_foot();

?>

		<br />	

		<?php
			// TABLE FIGURE ********************************************************************************************************************************
		
			// retrieve the name of figure: --------------------------------------------------
			$fragmenttyperel -> retrive_fragment_id_priority_uno($id);
			$id_fragment = $fragmenttyperel -> getFragment_id();
			
			$fragment ->  retrive_by_id($id_fragment);
			
			$attachment = $fragment -> getAttachment();
			$attachment_type = $fragment -> getAttachment_type();
	
			// change PFD in JPG:
			$attachment_jpg = str_replace('jpg', 'jpeg', $attachment);
			$link_figure = "figure/".$attachment_jpg;	
			// -------------------------------------------------------------------------------		
		
			// Citation figure: ***************************************************************
			$fragment -> retrive_by_id($id_fragment);
			$citation = $fragment -> getQuote();

			//$original_id = $fragment -> getOriginal_id();

			// retrieve article_id from ArticleEvidenceRel by using Evidence_id
			$articleevidencerel -> retrive_article_id($id_fragment);
			$id_article = $articleevidencerel -> getArticle_id_array(0);

			// retrieve all information from article table by using article_id
			$article -> retrive_by_id($id_article) ; 
			$title = $article -> getTitle();
			$pmid_isbn = $article -> getPmid_isbn(); 
			$issue = $article -> getIssue();
			$doi = $article -> getDoi(); 
			$publication = $article -> getPublication();
			$year = $article -> getYear();
			$first_page = $article -> getFirst_page(); 
			$last_page = $article -> getLast_page(); 
			$pmcid = $article -> getPmcid(); 
			$nihmsid = $article -> getNihmsid(); 
			$open_access = $article -> getOpen_access(); 
			$citation_count = $article -> getLast_page(); 
			$volume = $article -> getVolume();
			
			// retrive the Author Position from ArticleAuthorRel
			$articleauthorrel -> retrive_author_position($id_article);
			$n_author = $articleauthorrel -> getN_author_id();
			
			for ($ii3=0; $ii3<$n_author; $ii3++)
				$auth_pos[$ii3] = $articleauthorrel -> getAuthor_position_array($ii3);
				
			if ($auth_pos)	
				sort ($auth_pos);
			
			$name_authors = NULL;
			$name_authors_representative=NULL;
			for ($ii3=0; $ii3<$n_author; $ii3++)
			{
				$articleauthorrel -> retrive_author_id($id_article, $auth_pos[$ii3]);
				$id_author = $articleauthorrel -> getAuthor_id_array(0);
				
				$author -> retrive_by_id($id_author);
				$name_a = $author -> getName_author_array(0);
				//$name_b=trim($name_a);
				$f_auth1=substr($name_a,0,1);
				$name_b="<a href='find_author.php?name_author=$name_a&first_author=$f_auth1&new=1&see_result=1' target='_blank'>$name_a</a>";
				if($name_authors_representative!=null)
				{
					$name_authors_representative = $name_authors_representative.', '.$name_b;
				}
				else 
				{
					$name_authors_representative=$name_b;
				}
		
				$name_authors = $name_authors.', '.$name_a;
			}
			$name_authors[0] = '';
			$name_auhors_representative[0]= '';
			$name_auhors_representative=trim($name_auhors_representative);
			$name_authors = trim($name_authors);				

			$pages= $first_page." - ".$last_page;

			// ********************************************************************************

			
			if ($attachment_jpg != NULL)
			{
			?>
				<table width="80%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20%" align="center" class="table_neuron_page3">
							Representative figure
						</td>			
					</tr>	
				</table>
				<table width="80%" border="0" cellspacing="0" cellpadding="0">
					<?php
						// TABLE OF THE ARTICLES: ************************************************************************************************
						
						if (strlen($pmid_isbn) > 10 )
						{									
							$link2 = "<a href='$link_isbn$pmid_isbn' target='_blank'>";
							$string_pmid = "<strong>ISBN: </strong>".$link2;	
						}
						else
						{
							$value_link ='PMID: '.$pmid_isbn;
							$link2 = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$value_link' target='_blank'>";								
							$string_pmid = "<strong>PMID: </strong>".$link2;			
						}
						
						if ($issue != NULL)
							$issue_tot = "($issue),";
						else
							$issue_tot = "";
							
						if ($doi != NULL)
							$doi_tot = "DOI: $doi";
						else
							$doi_tot = "";							
						
						print ("
						<tr>
							<td width='20%' align='right'>
							</td>
							<td align='left' width='80%' class='table_neuron_page2'>
								<font color='#000000'><strong>$title</strong></font> <br>
								$name_authors_representative <br>
								$publication, $year, $volume $issue_tot pages: $pages <br>
								$string_pmid <font class='font13'>$pmid_isbn</font></a>; $doi_tot
							</td>
						</tr>
						");					

					?>
				</table>
				<table>
					<tr>
						<td width="20%" align="center">
							<br />
		
							<?php								
								if ($attachment_type == 'figure')
								{
									print ("<a href='$link_figure' rel='lightbox' title='$citation'>");
									print ("<img src='$link_figure' border='2' width='30%'>");
									print ("</a>");
								
									print ("<br>");
									print ("<em>$citation</em>");
								}	
								else;							
							?>
						</td>			
					</tr>			
							
				</table>
		
					<br />	<br />
							
			<?php
			}
			
			?>				
							
		
		<!-- TABLE Molecular markers: -->
		<table width="80%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="20%" align="center" class="table_neuron_page3">
					Molecular markers
				</td>			
			</tr>			
		</table>	
	
			<!-- Positive sub-table -->
			<table width="80%" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td width="20%" align="right" class="table_neuron_page1">
						Positive
					</td>
					<td align="left" width="80%" class="table_neuron_page1">
					</td>				
				</tr>	
				<?php
				// retrive information for POSITIVE AND WEAK-POSITIVE in property table.
				for ($i=0; $i<$n; $i++)
				{
					$property -> retrive_by_id($property_id[$i]);
					$val = $property -> getVal();
					if ($val == 'positive')
					{
						$part = $property -> getPart();

						// retrieve UNVETTED:
						$evidencepropertyyperel -> retrive_unvetted($id, $property_id[$i]);
						$unvetted = $evidencepropertyyperel -> getUnvetted();
						
						if ($unvetted == 1)
							$font_col = 'font4_unvetted';
						else
							$font_col = 'font4';
						
						print ("
							<tr>
								<td width='20%' align='right'>
								</td>
								<td align='left' width='80%' class='table_neuron_page2'>
								<a href='property_page_markers.php?id_neuron=$id&val_property=$part&page=markers&color=positive' target='_blank' class='$font_col'>
								$part 
								</a>	
								</td>					
							</tr>							
						");										
					}

					else;
				}	
				for ($i=0; $i<$n; $i++)
				{
					$property -> retrive_by_id($property_id[$i]);
					$val = $property -> getVal();
					
					// retrieve UNVETTED:
					$evidencepropertyyperel -> retrive_unvetted($id, $property_id[$i]);
					$unvetted = $evidencepropertyyperel -> getUnvetted();
					
					if ($unvetted == 1)
						$font_col = 'font4_unvetted';
					else
						$font_col = 'font4';
												
					if ($val == 'weak_positive')
					{
						$part = $property -> getPart();
						print ("
							<tr>
								<td width='20%' align='right'>
								</td>
								<td align='left' width='80%' class='table_neuron_page2'>
								<a href='property_page_markers.php?id_neuron=$id&val_property=$part&page=markers&color=weak_positive' target='_blank' class='$font_col'>
								$part (Weak Positive)
								</a>
								</td>					
							</tr>							
						");										
					}
					else;
				}								
				?>
			</table>	
	
			<!-- Negative sub-table -->
			<table width="80%" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td width="20%" align="right" class="table_neuron_page1">
						Negative
					</td>
					<td align="left" width="80%" class="table_neuron_page1">
					</td>				
				</tr>	
				<?php
				// retrive information for NEGATIVE in property table.
				for ($i=0; $i<$n; $i++)
				{
					$property -> retrive_by_id($property_id[$i]);
					$val = $property -> getVal();
					if ($val == 'negative')
					{
						$part = $property -> getPart();
						
					// retrieve UNVETTED:
					$evidencepropertyyperel -> retrive_unvetted($id, $property_id[$i]);
					$unvetted = $evidencepropertyyperel -> getUnvetted();
					
					if ($unvetted == 1)
						$font_col = 'font4_unvetted';
					else
						$font_col = 'font4';
												
						print ("
							<tr>
								<td width='20%' align='right'>
								</td>
								<td align='left' width='80%' class='table_neuron_page2'>
								<a href='property_page_markers.php?id_neuron=$id&val_property=$part&page=markers&color=negative' target='_blank' class='$font_col'>
								$part
								</a>
								</td>					
							</tr>							
						");										
					}
					else;
				}				
				?>
				</table>	
	
		<br />
		
		
		<!-- TABLE Electrophysiological properties: ******************************************************************************************************************** -->
		<table width="80%" border="0" cellspacing="2" cellpadding="0">
			<tr>
				<td width="20%" align="center" class="table_neuron_page3">
					Electrophysiological properties
				</td>			
			</tr>			
		</table>		

		<table width="80%" border="0" cellspacing="2" cellpadding="0">
		<?php		
      $abbreviations = array();
			for ($i=0; $i<$n; $i++)
			{
				$property -> retrive_by_id($property_id[$i]);
				$predicate = $property -> getRel();
		
				if ($predicate != 'is between');
				else
				{
					$subject = $property -> getPart();

					// Keep only property_id related by id_type;
					// and retrieve id_evidence by these id:
					$evidencepropertyyperel -> retrive_evidence_id($property_id[$i], $id);
					$nn = $evidencepropertyyperel ->getN_evidence_id();	
						
					if ($nn == 0);
					else 
					{
						$evidence_id = $evidencepropertyyperel -> getEvidence_id_array(0);
						
						// Retrieve Epdata from EpdataEvidenceRel by using Evidence ID: 
						$epdataevidencerel -> retrive_Epdata($evidence_id);
						
						$epdata_id = $epdataevidencerel -> getEpdata_id();
            			$epdataevidencerel -> setEpdata_id(NULL);
						
						if ($epdata_id == NULL);
						else
						{
							$complete_name = real_name_ephys_evidence($subject);
							$res=show_ephys($subject);

							$epdata -> retrive_all_information($epdata_id);
							$value1 = $epdata -> getValue1();
							if($value1)
								$value1 = number_format($value1,$res[3]);
							$value2 = $epdata -> getValue2();
							if($value2)
								$value2 = number_format($value2,$res[3]);
							$error = $epdata -> getError();
							$n_measurement = $epdata -> getN();
							$istim =  $epdata -> getIstim();	
							$time =  $epdata -> getTime();	
							$std_sem =  $epdata -> getStd_sem();
              array_push($abbreviations, $std_sem);  // will read these out at end to print abbreviations
							
							// -------------------------------------------------------------------------------------
							
							// BEGIN CLR modifications...
								
								// both value1 and value2: 
								if ($value1 && $value2 && !$istim)
								{
								  if ($res[2] != '')
    									$meas="[$value1, $value2] $res[2]";
									else
									    $meas="[$value1, $value2]";
								}
								// no value2, but has value1 and error:
								if ($value1 && $error && !$istim)
								{
									// original code, pre-Vrest minus sign kludge
									if ($res[2] != '')
									    $meas="$value1 &plusmn; $error $res[2]";
									else
									    $meas="$value1 &plusmn; $error";
									
									// start of Vrest minus sign kludge
									//if ($res[0] == 'V<small><sub>rest</small></sub>')
									//	$meas=" -$value1 &plusmn; $error $res[2] ";
									//else
									//	$meas=" $value1 &plusmn; $error $res[2] ";
									// end of Vrest minus sign kludge
								}
								// no value2, but has value1 and error:
								if ($value1 && !$value2 && !$error && !$istim)
								{
								  if ($res[2] != '')
										$meas="$value1 $res[2]";
									else
									  $meas="$value1";
								}		
										
								// istim field
								if (($istim) and ($istim != "unknown"))
								{
									
									if ($value2)
									{
										$mean_value = ($value1 + $value2) / 2;
										$range = "[$value1 - $value2]";
									}
									else
									{
										$mean_value = "$value1";	
										$range = "";
									}
									if ($error)
										$error_value = "&plusmn; $error";
									else
									  $error_value = "";
									
									if ($time)
										$time_val = ", $time ms";	
									else 
									  $time_val = "";
									//if ($res[2])
										//$res_2_1 = $res[2];
										
									//if ($istim)
										//$istim_show =" $istim";	
										
									if ($istim)
											$istim_show =", $istim pA";  //										$istim_show =", ".$istim;			
								  else
									    $istim_show ="";
				
									
									if ($res[2] != '')
    									$meas="$mean_value $range $error_value $res[2]$istim_show$time_val";
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
								
																
								if ($error)
								{
									if ($std_sem == 'std')
										$std_sem_value = ", Mean &plusmn; SD";
									else if ($std_sem == 'sem')	
										$std_sem_value = ", Mean &plusmn; SEM";
									else
										$std_sem_value ='';
										
									$n_error = 1;	
								}
								else
									$std_sem_value ='';
								
								if ($n_measurement)
									$N = "(n=$n_measurement)";
								else 	 						// R 2C (n=1)
								  $N = "(n=1)";	// R 2C (n=1)	
							
							// ... END CLR modifications
							
							// -------------------------------------------------------------------------------------

							$id_ephys2 = $epdata_id;						
						}					
					}	

					// retrieve UNVETTED:
					$evidencepropertyyperel -> retrive_unvetted($id, $property_id[$i]);
					$unvetted = $evidencepropertyyperel -> getUnvetted();

					if ($unvetted == 1)
						$font_col = 'font4_unvetted';
					else
						$font_col = 'font4';

					if ($meas)
					{
						print ("
							<tr>
								<td width='20%' align='right'>
								</td>
								<td align='left' width='80%' class='table_neuron_page2'>
							");
						  if ($res[0]=='Sag ratio')
						    print ("<strong>$complete_name:</strong> ");
						  else
						    print ("<strong>$complete_name ($res[0]):</strong> ");
						  print ("
								<a href='property_page_ephys.php?id_ephys=$epdata_id&id_neuron=$id&ep=$subject' target='_blank' class='$font_col'>
								$meas $N$std_sem_value 
								</a>
								</td>					
							</tr>							
						");								
            $meas = NULL;
					}
				}		
			}

      // Abbreviations Box
      $abbreviations = array_unique($abbreviations);
      if ($abbreviations) {  // checks for non-null vals
        $definitions = get_abbreviation_definitions($abbreviations);
        $definition_str = implode('; ', $definitions);
				print ("
				<tr>
					<td width='20%' align='right'>
					</td>
					<td align='left' width='80%' class='table_neuron_page2'>
						<br>
            $definition_str
					</td>					
				</tr>							
				");	
			}

		?>
		</table>	

		<br />
		
		<!-- TABLE Notes: -->
		<?php
			$type -> retrive_notes($id);
			$notes = $type -> getNotes();
		
			if ($notes)
			{
		?>
			<table width="80%" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td width="100%" align="center" class="table_neuron_page3">
						Notes
					</td>			
				</tr>			
			</table>	
		
			<table width="80%" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td align='left' width='20%'>	 
					</td>							
					<td align='left' width='80%' class='table_neuron_page2'>
					<?php print $notes; ?>
					</td>		
				</tr>		
			</table>
		<?php
			}
		?>	

		<br />
		
		
		<!-- TABLE Potential postsynaptic connections: -->
		<?php

      // STM Potential Pre-Post List

      // components of html
      function connection_table_head($title) {
        $html = "<table width='80%' border='0' cellspacing='2' cellpadding='0'>
          <tr>
          <td width='100%' align='center' class='table_neuron_page3'>
          $title
          </td>			
          </tr>			
          </table>		

          <table width='80%' border='0' cellspacing='2' cellpadding='0'>
          <tr>
          <td width='20%' align='left'>
          </td>	
          <td width='800%' align='left'>
          <font color='#009900' face='Verdana, Arial, Helvetica, sans-serif' size='2'>Excitatory </font> or  
          <font color='#CC0000' face='Verdana, Arial, Helvetica, sans-serif' size='2'>Inhibitory </font>
          </td>		
          </tr>			
          </table>

          <table width='80%' border='0' cellspacing='2' cellpadding='0'>";
        return $html;
      }

      function get_excit_inhib_font_class($name) {
        if (strpos($name, '(+)')) {
          $font_class = 'font10';
        } else { // is (-)
          $font_class = 'font11';
        }
        return $font_class;
      }

      function name_row($record) {
        $name = to_name($record);
        $id = $record["id"];
        $font_class = get_excit_inhib_font_class($name);
        $html =
          "<tr>
            <td width='20%' align='right'/>
            <td align='left' width='80%' class='table_neuron_page2'>
              <a href='neuron_page.php?id=$id' target='_blank' class='$font_class'>
                $name
              </a>
            </td>					
          </tr>";					
        return $html;
      }

      function name_row_none($name_none) { // the list of targets or sources is empty
        $html =
          "<tr>
            <td width='20%' align='right'/>
            <td align='left' width='80%' class='table_neuron_page2'>
                $name_none
              </a>
            </td>					
          </tr>";					
        return $html;
      }

      function connection_table_foot() {
        $html= "</table>
          </br>";
        return $html;
      }

      // to build the base set of connections access queries defined in morphology section

      // queries to access TypeTypeRel and modify the connections
      $explicit_target_and_source_base_query =
        "SELECT
        t1.id as t1_id, t1.subregion as t1_subregion, t1.nickname as t1_nickname,
        t2.id as t2_id, t2.subregion as t2_subregion, t2.nickname as t2_nickname
        FROM TypeTypeRel ttr
        JOIN (Type t1, Type t2) ON ttr.Type1_id = t1.id AND ttr.Type2_id = t2.id";
      $explicit_target_query = $explicit_target_and_source_base_query . " WHERE Type1_id = '$id' AND connection_status = 'positive'";
      $explicit_nontarget_query = $explicit_target_and_source_base_query . " WHERE Type1_id = '$id' AND connection_status = 'negative'";
      $explicit_source_query = $explicit_target_and_source_base_query . " WHERE Type2_id = '$id' AND connection_status = 'positive'";
      $explicit_nonsource_query = $explicit_target_and_source_base_query . " WHERE Type2_id = '$id' AND connection_status = 'negative'";

      // potential targets of output
      $result = mysql_query($axon_query);
      $axon_parcels = result_set_to_array($result, 'object');
      //print "<br><br>AXON PARCELS<br>"; print_r($axon_parcels);

      $possible_targets = filter_types_by_morph_property('dendrites', $axon_parcels);
      //print "<br><br>POSSIBLE TARGETS:<br>"; print_r($possible_targets);

      $result = mysql_query($explicit_target_query);
      $explicit_targets = result_set_to_array($result, "t2_id");
      //print "<br><br>EXPLICIT TARGETS:<br>"; print_r($explicit_targets);

	  if (count($explicit_targets) >= 1) {
			$list_explicit_targets = array_unique($explicit_targets);
			$list_explicit_targets = get_sorted_records($list_explicit_targets);
	  }
	  
      $result = mysql_query($explicit_nontarget_query);
      $explicit_nontargets = result_set_to_array($result, "t2_id");
      //print "<br><br>EXPLICIT NONTARGETS:<br>"; print_r($explicit_nontargets);	  
	  
	  if (count($explicit_nontargets) >= 1) {
			$list_explicit_nontargets = array_unique($explicit_nontargets);
			$list_explicit_nontargets = get_sorted_records($list_explicit_nontargets);
	  }
	  
      $list_potential_targets = array_diff(array_diff($possible_targets, $explicit_nontargets), $explicit_targets);
      $list_potential_targets = array_unique($list_potential_targets);
      $list_potential_targets = get_sorted_records($list_potential_targets);
/*
      $net_targets = array_merge(array_diff($possible_targets, $explicit_nontargets), $explicit_targets);
      //print "<br><br>NET TARGETS:<br>"; print_r($net_targets);

      $net_targets = array_unique($net_targets);
      $net_targets = get_sorted_records($net_targets);
      //sort($net_targets);
*/

      // potential sources of input
      $result = mysql_query($dendrite_query);
      $dendrite_parcels = result_set_to_array($result, 'object');
      //print "<br><br>DENDRITE PARCELS<br>"; print_r($dendrite_parcels);
      
      $possible_sources = filter_types_by_morph_property('axons', $dendrite_parcels);
      //print "<br><br>POSSIBLE SOURCES:<br>"; print_r($possible_sources);
      
      $result = mysql_query($explicit_source_query);
      $explicit_sources = result_set_to_array($result, "t1_id");
      //print "<br><br>EXPLICIT SOURCES:<br>"; print_r($explicit_sources);
      
      if (count($explicit_sources) >= 1) {
      	$list_explicit_sources = array_unique($explicit_sources);
      	$list_explicit_sources = get_sorted_records($list_explicit_sources);
      }
       
      $result = mysql_query($explicit_nonsource_query);
      $explicit_nonsources = result_set_to_array($result, "t1_id");
      //print "<br><br>EXPLICIT NONSOURCES:<br>"; print_r($explicit_nonsources);
      
      if (count($explicit_nonsources) >= 1) {
      	$list_explicit_nonsources = array_unique($explicit_nonsources);
      	$list_explicit_nonsources = get_sorted_records($list_explicit_nonsources);
      }
       
      $list_potential_sources = array_diff(array_diff($possible_sources, $explicit_nonsources), $explicit_sources);
      $list_potential_sources = array_unique($list_potential_sources);
      $list_potential_sources = get_sorted_records($list_potential_sources);
      /*
       $net_sources = array_merge(array_diff($possible_sources, $explicit_nonsources), $explicit_sources);
      //print "<br><br>NET SOURCES:<br>"; print_r($list_potential_sources);
      
      $net_sources = array_unique($net_sources);
      $net_sources = get_sorted_records($net_sources);
      */
      
      // potential sources of input
      $result = mysql_query($dendrite_query);
      $dendrite_parcels = result_set_to_array($result, 'object');
      //print "<br><br>DENDRITE PARCELS<br>"; print_r($dendrite_parcels);

      $possible_sources = filter_types_by_morph_property('axons', $dendrite_parcels);
      //print "<br><br>POSSIBLE SOURCES:<br>"; print_r($possible_sources);

      $result = mysql_query($explicit_source_query);
      $explicit_sources = result_set_to_array($result, "t1_id");
      //print "<br><br>EXPLICIT SOURCES:<br>"; print_r($explicit_sources);

	  if (count($explicit_sources) >= 1) {
			$list_explicit_sources = array_unique($explicit_sources);
			$list_explicit_sources = get_sorted_records($list_explicit_sources);
	  }
	  
      $result = mysql_query($explicit_nonsource_query);
      $explicit_nonsources = result_set_to_array($result, "t1_id");
      //print "<br><br>EXPLICIT NONSOURCES:<br>"; print_r($explicit_nonsources);

	  if (count($explicit_nonsources) >= 1) {
			$list_explicit_nonsources = array_unique($explicit_nonsources);
			$list_explicit_nonsources = get_sorted_records($list_explicit_nonsources);
	  }
	  
      $list_potential_sources = array_diff(array_diff($possible_sources, $explicit_nonsources), $explicit_sources);
      $list_potential_sources = array_unique($list_potential_sources);
      $list_potential_sources = get_sorted_records($list_potential_sources);
/*
      $net_sources = array_merge(array_diff($possible_sources, $explicit_nonsources), $explicit_sources);
      //print "<br><br>NET SOURCES:<br>"; print_r($list_potential_sources);

      $net_sources = array_unique($net_sources);
      $net_sources = get_sorted_records($net_sources);
*/
      
// Start R 2C connectivity changes
      // print it out
      print connection_table_head("Known targets of output");
	  if (count($list_explicit_targets) < 1) // the list of targets or sources is empty
			print name_row_none("none known");
	  else
			foreach($list_explicit_targets as $target) { print name_row($target); }
	  print connection_table_foot();

      print connection_table_head("Potential targets of output");
	  if (count($list_potential_targets) < 1) // the list of targets or sources is empty
			print name_row_none("none known");
	  else
			foreach($list_potential_targets as $target) { print name_row($target); }
	  //foreach($net_targets as $target) { print name_row($target); }
	  print connection_table_foot();

      print connection_table_head("Potential targets of output known to be avoided");
	  if (count($list_explicit_nontargets) < 1) // the list of targets or sources is empty
			print name_row_none("none known");
	  else
			foreach($list_explicit_nontargets as $target) { print name_row($target); }
	  print connection_table_foot();

      print connection_table_head("Known sources of input");
	  if (count($list_explicit_sources) < 1) // the list of targets or sources is empty
			print name_row_none("none known");
	  else
			foreach($list_explicit_sources as $source) { print name_row($source); }
	  print connection_table_foot();

      print connection_table_head("Potential sources of input");
	  if (count($list_potential_sources) < 1) // the list of targets or sources is empty
			print name_row_none("none known");
	  else
			foreach($list_potential_sources as $source) { print name_row($source); }
	  //foreach($net_sources as $source) { print name_row($source); }
	  print connection_table_foot();
	
      print connection_table_head("Potential sources of input known to be avoided");
	  if (count($list_explicit_nonsources) < 1) // the list of targets or sources is empty
			print name_row_none("none known");
	  else
			foreach($list_explicit_nonsources as $source) { print name_row($source); }
	  print connection_table_foot();

// End R 2C connectivity changes
	
		?>
		</table>	

			<br />	<br /> <br />	<br />		

		</td>
	</tr>
</table>		
</div>		

</body>
</html>
