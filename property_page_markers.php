<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("access_db.php");
include ("function/quote_manipulation.php");
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
require_once('class/class.attachment.php');

function create_temp_table ($name_temporary_table)
{	
	$drop_table ="DROP TABLE $name_temporary_table";
	$query = mysql_query($drop_table);
	
	$creatable=	"CREATE TABLE IF NOT EXISTS $name_temporary_table (
				   id int(4) NOT NULL AUTO_INCREMENT,
				   id_fragment varchar(10),
				   id_original varchar(10),
				   quote text(2000),
				   authors varchar(600),
				   title varchar(300),
				   publication varchar(100),
				   year varchar(15),
				   PMID varchar(25),
				   pages varchar(20),
				   page_location varchar(100),
				   id_markerdata varchar(10),
				   id_evidence1 varchar(20),
				   id_evidence2 varchar(20),
				   show1 varchar(5),
				   type varchar(20),
				   type_marker varchar (70),
				   color varchar (100),		
				   pmcid varchar (50),	
				   NIHMSID varchar (50),
				   doi varchar (100),
				   citation varchar(7), 
				   show2 varchar(4),  
				   show_button varchar(4),
				   volume varchar (20),
				   issue varchar (20),
           		   secondary_pmid varchar(50),
				   PRIMARY KEY (id));";
	$query = mysql_query($creatable);	
}


function insert_temporary($table, $id_fragment, $id_original, $quote, $authors, $title, $publication, $year, $PMID, $pages, $page_location, $id_markerdata, $id_evidence1, $id_evidence2, $type, $type_marker, $ccolor, $pmcid, $NIHMSID, $doi, $citation, $volume, $issue, $secondary_pmid)
{
		$quote = mysql_real_escape_string($quote);
	$query_i = "INSERT INTO $table
	  (id,
	   id_fragment,
	   id_original,
	   quote,
	   authors,
	   title,
	   publication,
	   year,
	   PMID,
	   pages,
	   page_location,
	   id_markerdata,
	   id_evidence1,
	   id_evidence2,
	   show1,
	   type,
	   type_marker,
	   color,
	   pmcid,
	   NIHMSID,
	   doi,
	   citation,
	   show2,
	   show_button,
	   volume,
     issue,
     secondary_pmid)
	VALUES
	  (NULL,
	   '$id_fragment',
	   '$id_original',
	   '$quote',
	   '$authors',
	   '$title',
	   '$publication',
	   '$year',
	   '$PMID',
	   '$pages',
	   '$page_location',
	   '$id_markerdata',
	   '$id_evidence1',
	   '$id_evidence2',
	   '0',
	   '$type',
	   '$type_marker',
	   '$ccolor',
	   '$pmcid',
	   '$NIHMSID',
	   '$doi',
	   '$citation',
	   '1',
	   '0',
	   '$volume',
	   '$issue',
     '$secondary_pmid'
	   )";
	$rs2 = mysql_query($query_i);
}


// STM
function header_row($title, $value) {
                $html = "
                <tr>
                <td width='15%'></td>	
                <td align='left' width='70%' class='table_neuron_page2'>				
                $title: $value
                </td>	
                <td width='15%'></td>
                </tr>";
                return $html;
              }

$page = $_REQUEST['page'];
if ($page)
{
	$id_neuron = $_REQUEST['id_neuron'];
	$val_property = $_REQUEST['val_property'];
	$color = $_REQUEST['color'];


	if ($val_property == 'Sub_P_Rec')
		$val_property = 'Sub P Rec';
	if ($val_property == 'GABAa_alfa')
		$val_property = 'Gaba-a-alpha';	
	if ($val_property == 'a-act2')
		$val_property = 'alpha-actinin-2';	
	if ($val_property == 'GAT_1')
		$val_property = 'GAT-1';	
 	if ($val_property == 'mGluR2_3')
		$val_property = 'mGluR2/3';	  		

	$_SESSION['id_neuron'] = $id_neuron;
	$_SESSION['val_property'] = $val_property;	
	$_SESSION['colore'] = $color;
	
	if ($color == 'positive-negative-weak_positive')
		$color_table = 'pos_neg_weak';
	else
		$color_table = $color;	
	
	
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$ip_address = str_replace('.', '_', $ip_address);
	
	$color_temporary_table = str_replace('-', '', $color_table);	
	
	$time_t = time();
	
	$val_property_temp = str_replace('-', '', $val_property_temp);
	
	
	$name_temporary_table ='temp_'.$ip_address.'_'.$id_neuron.$val_property_temp.$color_temporary_table.'__'.$time_t;
	$_SESSION['name_temporary_table'] = $name_temporary_table;
	create_temp_table ($name_temporary_table);

	// default order by:
	$order_by = "year";
	$type_order = 'DESC';
	$_SESSION['order_by'] = $order_by;
	$_SESSION['type_order'] = $type_order;
	
	$name_show_only = 'all';
	$sub_show_only = NULL;
}
else
{
	$color=$_SESSION['colore'];	

	$order_ok = $_REQUEST['order_ok'];
	if ($order_ok == 'GO')             // Was clicked the Order By options
	{
		$order_by = $_REQUEST['order'];
		$_SESSION['order_by'] = $order_by;
		
		if ($order_by == 'year')
			$type_order = 'DESC';
		else
			$type_order = 'ASC';

		$_SESSION['type_order'] = $type_order;

		$sub_show_only = $_REQUEST['sub_show_only'];		
		$_SESSION['sub_show_only'] = $sub_show_only;			
	}

	$flag = $_REQUEST['flag'];
	
	$id_neuron = $_SESSION['id_neuron'];
	$val_property = $_SESSION['val_property'];
	$sub_show_only = $_SESSION['sub_show_only'];

	
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$id_change = $_REQUEST['id_change'];

	// update the show1 variable in the temporary table:	
	if ($flag == 'on')
		$query = "UPDATE $name_temporary_table SET show1 = '1' WHERE id = '$id_change' ";	
	else
		$query = "UPDATE $name_temporary_table SET show1 = '0' WHERE id = '$id_change' ";
	
	$rs2 = mysql_query($query);			
}

// SHOW ALL -----------------------------------------------------------------------------------
$see_all = $_REQUEST['see_all']; 
if ($see_all == 'Open All Evidence')
{
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];
	
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$query = "UPDATE $name_temporary_table SET show_button =  '1'";
	$rs2 = mysql_query($query);		
}

if ($see_all == 'Close All Evidence')
{
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];
	
	$name_temporary_table = $_SESSION['name_temporary_table'];
	$query = "UPDATE $name_temporary_table SET show_button =  '0'";
	$rs2 = mysql_query($query);		
}

// Change the show coloums in the temporary table: ------------------------------------------------
if ($_REQUEST['show_1']) //  ==> ON
{
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];

	$name_temporary_table = $_SESSION['name_temporary_table'];
	$title_paper = $_REQUEST['title'];
				
	$query = "UPDATE $name_temporary_table SET show_button =  '1' WHERE title = '$title_paper'";
	$rs2 = mysql_query($query);	
}

if ($_REQUEST['show_0']) //  ==> OFF
{
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];

	$name_temporary_table = $_SESSION['name_temporary_table'];
	$title_paper = $_REQUEST['title'];
	$query = "UPDATE $name_temporary_table SET show_button =  '0' WHERE title = '$title_paper'";
	$rs2 = mysql_query($query);	
}
// -------------------------------------------------------------------------------------------------


$type = new type($class_type);
$type -> retrive_by_id($id_neuron);


$property = new property($class_property);

$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);

$evidencemarkerdatarel = new evidencemarkerdatarel($class_evidencemarkerdatarel);

$markerdata = new markerdata($class_markerdata);

$evidenceevidencerel = new evidenceevidencerel($class_evidenceevidencerel);

$evidencefragmentrel = new evidencefragmentrel($class_evidencefragmentrel);

$fragment = new fragment($class_fragment);

$articleevidencerel = new articleevidencerel($class_articleevidencerel);

$article = new article($class_article);

$articleauthorrel = new articleauthorrel($class_articleauthorrel);

$author = new author($class_author);

$attachment_obj = new attachment($class_attachment);


// SHOW ONLY --------------------------------------------------------------
// ------------------------------------------------------------------------
$name_show_only_var = $_REQUEST['name_show_only_var'];

if ($name_show_only_var)
{
	$color = $_REQUEST['color'];

	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];

	$name_show_only = $_REQUEST['name_show_only'];
	$_SESSION['name_show_only'] = $name_show_only;
	
	$page_in = $_REQUEST['start'];
	$page_end = $_REQUEST['stop'];
	$name_temporary_table = $_SESSION['name_temporary_table'];
	
	$sub_show_only = $_REQUEST['sub_show_only'];
	$_SESSION['sub_show_only'] = $sub_show_only;	
	

	// Option: All:
	if ($name_show_only == 'all')
	{
		$sub_show_only = 'all';
		$_SESSION['sub_show_only'] = $sub_show_only;
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
		$rs2 = mysql_query($query);	
	}
	
	// Option: Articles / books:
	if ($name_show_only == 'article_book')
	{
		$name_show_only_article = 'all';
		$sub_show_only = 'article';
		$_SESSION['sub_show_only'] = $sub_show_only;
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
		$rs2 = mysql_query($query);			
	}

	// Option: Publication:
	if ($name_show_only == 'name_journal')
	{
		$name_show_only_journal = 'all';
		$sub_show_only = 'name_journal';
		$_SESSION['sub_show_only'] = $sub_show_only;
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
		$rs2 = mysql_query($query);			
	}

	// Option: Authors:
	if ($name_show_only == 'authors')
	{
		$name_show_only_authors = 'all';
		$sub_show_only = 'authors';
		$_SESSION['sub_show_only'] = $sub_show_only;
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
		$rs2 = mysql_query($query);			
	}

	// Option: Morphology:
	if ($name_show_only == 'morphology')
	{
		$name_show_only_morphology = 'both';
		$sub_show_only = 'morphology';
		$_SESSION['sub_show_only'] = $sub_show_only;
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
		$rs2 = mysql_query($query);			
	}
} // end if $name_show_only_var




// ARTICLE - BOOK OPTION
$name_show_only_article_var = $_REQUEST['name_show_only_article_var'];
if ($name_show_only_article_var)
{
	$color = $_REQUEST['color'];
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];

	$sub_show_only = $_SESSION['sub_show_only'];
		
	$name_show_only_article = $_REQUEST['name_show_only_article'];
	$_SESSION['name_show_only_article'] = $name_show_only_article;

	$name_show_only = $_SESSION['name_show_only'];
	$page_in = $_REQUEST['start'];
	$page_end = $_REQUEST['stop'];
	$name_temporary_table = $_SESSION['name_temporary_table'];

	$query = "UPDATE $name_temporary_table SET show_only =  '1'";
	$rs2 = mysql_query($query);	
	
	$query ="SELECT id, PMID FROM $name_temporary_table";
	$rs = mysql_query($query);					
	while(list($id, $pmid) = mysql_fetch_row($rs))	
	{	
		if ($name_show_only_article == 'article')
		{
			if (strlen($pmid) > 10)
				$query = "UPDATE $name_temporary_table SET show2 =  '0' WHERE id = '$id'";
		}
		else if ($name_show_only_article == 'book')
		{
			if (strlen($pmid) < 10)
				$query = "UPDATE $name_temporary_table SET show2 =  '0' WHERE id = '$id'";
		}	
		else
			$query = "UPDATE $name_temporary_table SET show2 =  '1' WHERE id = '$id'";
				
		$rs2 = mysql_query($query);	
	}
} // end if $name_show_only_article


// JUORNAL OPTION
$name_show_only_journal_var = $_REQUEST['name_show_only_journal_var'];
if ($name_show_only_journal_var)
{
	$color = $_REQUEST['color'];
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];

	$sub_show_only = $_SESSION['sub_show_only'];
				
	$name_show_only_journal = $_REQUEST['name_show_only_journal'];
	$_SESSION['name_show_only_journal'] = $name_show_only_journal;

	$name_show_only = $_SESSION['name_show_only'];
	$page_in = $_REQUEST['start'];
	$page_end = $_REQUEST['stop'];
	$name_temporary_table = $_SESSION['name_temporary_table'];

	$query = "UPDATE $name_temporary_table SET show2 =  '1'";
	$rs2 = mysql_query($query);	
		
	if ($name_show_only_journal == 'all')
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
	else
		$query = "UPDATE $name_temporary_table SET show2 =  '0' WHERE publication != '$name_show_only_journal'";
	
	$rs2 = mysql_query($query);	

} // end if $name_show_only_journal
	
// AUTHORS OPTION
$name_show_only_authors_var  = $_REQUEST['name_show_only_authors_var'];
if ($name_show_only_authors_var)
{
	$color = $_REQUEST['color'];
	$order_by = $_SESSION['order_by'];
	$type_order = $_SESSION['type_order'];

	$sub_show_only = $_SESSION['sub_show_only'];
			
	$name_show_only_authors = $_REQUEST['name_show_only_authors'];
	$_SESSION['name_show_only_authors'] = $name_show_only_authors;

	$name_show_only = $_SESSION['name_show_only'];
	$page_in = $_REQUEST['start'];
	$page_end = $_REQUEST['stop'];
	$name_temporary_table = $_SESSION['name_temporary_table'];


	if ($name_show_only_authors == 'all')
	{
		$query = "UPDATE $name_temporary_table SET show2 =  '1'";
		$rs2 = mysql_query($query);		
	}
	else
	{
		$query = "UPDATE $name_temporary_table SET show2 =  '0'";
		$rs2 = mysql_query($query);	
				
		$query ="SELECT id FROM $name_temporary_table WHERE authors LIKE '%$name_show_only_authors%'";
		$rs = mysql_query($query);					
		while(list($id) = mysql_fetch_row($rs))		
		{
			$query = "UPDATE $name_temporary_table SET show2 =  '1' WHERE id = '$id'";
			$rs2 = mysql_query($query);
		}	
	}

} // end if $name_show_only_authors	

//---------------------------------------------------------------------------
//---------------------------------------------------------------------------

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
// Javascript function *****************************************************************************************************
function show_only(link, color)
{
	var name=link[link.selectedIndex].value;
	var destination_page = "property_page_markers.php";

	location.href = destination_page+"?name_show_only="+name+"&name_show_only_var=1&color="+color;
}

function show_only_article(link, color)
{
	var name=link[link.selectedIndex].value;
	var destination_page = "property_page_markers.php";
	
	location.href = destination_page+"?name_show_only_article="+name+"&name_show_only_article_var=1&color="+color;
}

function show_only_publication(link, color)
{
	var name=link[link.selectedIndex].value;
	var destination_page = "property_page_markers.php";

	location.href = destination_page+"?name_show_only_journal="+name+"&name_show_only_journal_var=1&color="+color;
}

function show_only_authors(link, color)
{
	var name=link[link.selectedIndex].value;
	var destination_page = "property_page_markers.php";
	
	location.href = destination_page+"?name_show_only_authors="+name+"&name_show_only_authors_var=1&color="+color;
}

</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Evidence Page</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>	

<div class='title_area'>
	<font class="font1">Molecular markers evidence page</font>
</div>

<!-- 
<div align="center" class="title_3">
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%">
			<font size='5' color="#990000" face="Verdana, Arial, Helvetica, sans-serif">Evidence Page</font>
		</td>
	</tr>
	</table>
</div>
-->

<br><br /><br><br />
<!-- ---------------------- -->

<table width="85%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr height="40">
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
					&nbsp; 
					<?php			
						 $id=$type->getId();
								 $name=$type->getName();
					print("<a href='neuron_page.php?id=$id'>$name</a>");
					 ?>
				</td>				
			</tr>
			<tr>
				<td width="20%" align="right">&nbsp;</td>
				<td align="left" width="80%" class="table_neuron_page2">&nbsp;&nbsp;<strong>Hippocampome Neuron ID: <?php echo $id?></strong></td>
			</tr>	
			<tr>
				<td width="20%" align="right">
				</td>
				<td align="left" width="80%" class="table_neuron_page2">
				<?php
// STM added
              $type_id = $type -> getId();

              $subject = $val_property;
              $predicate = 'has expression';
              $expression_values = explode('-', $_REQUEST['color']);
              $object = $expression_values[0];
              $property -> retrive_ID(1, $subject, $predicate, $object);
              $property_id = $property -> getProperty_id(0);
              $conflict_note = $evidencepropertyyperel -> retrieve_conflict_note($property_id, $type_id);
              if ($conflict_note)
                $conflict_note = "-- $conflict_note";
              //print("CONFLICT NOTE:" . $conflict_note);

					 if ($val_property == 'Gaba-a-alpha')
             print ("&nbsp <strong>GABAa &alpha; ($color) $conflict_note</strong>"); 
					 else if ($val_property == 'alpha-actinin-2')
             print ("&nbsp <strong>&alpha;-act2 ($color) $conflict_note</strong>"); 						
					 else				
             print ("&nbsp <strong>$val_property ($color) $conflict_note</strong>");
				?>

				</td>				
			</tr>								
		</table>
    <table width="80%" border="0" cellspacing="2" cellpadding="5" padding-top="5"> 
      <tr>
        <td class="table_neuron_page2" padding="5">
          All experiments were conducted on rats with an immunohistochemical staining protocol, unless otherwise specified. 
        </td>
     </tr>
<tr>
<td class="table_neuron_page2" padding="5">
      All of the evidence provided on Hippocampome.org are quotes from scientific texts.  
			However, because quoted passages may be difficult to understand in isolation, contextual information and expanded abbreviations set in square brackets have been added for clarity.
</td>
</tr>
    </table>
		<br />		

		<?php
		// There are two different or more 	
		if ($color == 'positive-negative')
		{
			$number_marker = 2;
			$color_1[0] = "positive";
			$color_1[1] = "negative";
		}
		else if ($color == 'positive-weak_positive')
		{
			$number_marker = 2;
			$color_1[0] = "positive";
			$color_1[1] = "weak_positive";
		}		
		else if ($color == 'negative-weak_positive')
		{
			$number_marker = 2;
			$color_1[0] = "negative";
			$color_1[1] = "weak_positive";
		}			
		else if ($color == 'negative-unknown')
		{
			$number_marker = 2;
			$color_1[0] = "negative";
			$color_1[1] = "unknown";
		}		
		else if ($color == 'positive-unknown')
		{
			$number_marker = 2;
			$color_1[0] = "positive";
			$color_1[1] = "unknown";
		}	
		else if ($color == 'weak_positive-unknown')
		{
			$number_marker = 2;
			$color_1[0] = "weak_positive";
			$color_1[1] = "unknown";
		}		
		else if ($color == 'positive-negative-weak_positive')
		{
			$number_marker = 3;
			$color_1[0] = "positive";
			$color_1[1] = "negative";
			$color_1[2] = "weak_positive";			
		}	
		else if ($color == 'positive-negative-unknown')
		{
			$number_marker = 3;
			$color_1[0] = "positive";
			$color_1[1] = "negative";
			$color_1[2] = "unknown";
		}		
		else if ($color == 'positive-negative-weak_positive-unknown')
		{
			$number_marker = 4;
			$color_1[0] = "positive";
			$color_1[1] = "negative";
			$color_1[2] = "weak_positive";	
			$color_1[3] = "unknown";		
		}			
		else if ($color == 'positive-weak_positive-unknown')
		{
			$number_marker = 3;
			$color_1[0] = "positive";
			$color_1[1] = "weak_positive";	
			$color_1[2] = "unknown";		
		}		
		else if ($color == 'negative-weak_positive-unknown')
		{
			$number_marker = 3;
			$color_1[0] = "negative";
			$color_1[1] = "weak_positive";	
			$color_1[2] = "unknown";		
		}			
		else
		{
			$number_marker = 1;
			$color_1[0] = $color;
		}	
		// for on number of marker (number of $color) ++++
		
		for ($m2=0; $m2<$number_marker; $m2++)
		{
			// Retrieve Id_property from Property By using Val_property (object) AND Color (predicate)
			$property -> retrive_ID(2, $val_property, NULL, $color_1[$m2]);
			$id_property = $property -> getProperty_id(0);
			

			// Retrieve the ID EVIDENCE from EvidencePropertyTypeRel by using ID TYPE and ID PROPERTY:
			$evidencepropertyyperel -> retrive_evidence_id($id_property, $id_neuron);
			$n_id_evidence = $evidencepropertyyperel -> getN_evidence_id();
			
			$n_tot_marker = 0;
			$old_id_marker = 0;
			
			for ($i=0; $i<$n_id_evidence; $i++)
			{
				$id_evidence[$i] = $evidencepropertyyperel -> getEvidence_id_array($i);

        	// STM getting the linking PMID
        	$id_secondary_article = $evidencepropertyyperel -> retrive_article_id($id_property, $id_neuron, $id_evidence[$i]);
        	if ($id_secondary_article) {
			$article -> retrive_by_id($id_secondary_article);
          	$secondary_pmid = $article -> getPmid_isbn();
          	} else {
          	$secondary_pmid = NULL;
        	}
			
			// Retrieve EVIDENCE2_ID from EvidenceEvidenceRel by using EVIDENCE1_ID:
			$evidenceevidencerel -> retrive_evidence2_id($id_evidence[$i]);
		
			$n_evidence2 = $evidenceevidencerel -> getN_evidence2();
					
			for ($i1=0; $i1<$n_evidence2; $i1++)
			{	
				$id_evidence2[$i1] = $evidenceevidencerel -> getEvidence2_id_array($i1);
						
				// Retrieve Fragment_id from Fragment by using Evidence_id =  $id_evidence2[$i1]
				$evidencefragmentrel -> retrive_fragment_id($id_evidence2[$i1]);
				$n_fragment_id = $evidencefragmentrel -> getN_Fragment_id();
	
				$evidencefragmentrel -> retrive_fragment_id_1($id_evidence2[$i1]);
				$fragment_id_1 = $evidencefragmentrel -> getFragment_id();

				$fragment -> retrive_by_id($fragment_id_1);
				$quote = $fragment -> getQuote();
				$quote = quote_replaceIDwithName($quote);
				$original_id = $fragment -> getOriginal_id();
				$type = $fragment -> getType();
				$page_location = $fragment -> getPage_location();				
																
				// retrive information in Article table:
				$articleevidencerel -> retrive_article_id($id_evidence2[$i1]);				
				$id_article = $articleevidencerel -> getarticle_id_array(0);		
		
				$article -> retrive_by_id($id_article);
				$title = preg_replace("/\'/","\'",$article -> getTitle());			
				$publication = preg_replace("/\'/","\'",$article -> getPublication());
				$year = preg_replace("/\'/","\'",$article -> getYear());
				$pmid_isbn = preg_replace("/\'/","\'",$article -> getPmid_isbn()); 
				$first_page = preg_replace("/\'/","\'",$article -> getFirst_page()); 
				$last_page = preg_replace("/\'/","\'",$article -> getLast_page()); 
				$pmcid = preg_replace("/\'/","\'",$article -> getPmcid()); 
				$nihmsid = preg_replace("/\'/","\'",$article -> getNihmsid()); 
				$doi = $article -> getDoi(); 
				$open_access = preg_replace("/\'/","\'",$article -> getOpen_access()); 
				$citation = preg_replace("/\'/","\'",$article -> getLast_page()); 
				$volume = preg_replace("/\'/","\'",$article -> getVolume()); 
				$issue = preg_replace("/\'/","\'",$article -> getIssue()); 
	
				$pages = $first_page." - ".$last_page;								
								
				// retrive the Author Position from ArticleAuthorRel ++++++++++++++++++++++++++++++++++++++++++
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
					
				$name_authors[0] = ' ';
				$name_authors[1] = ' ';	
					
				$name_authors = ltrim($name_authors);
				$name_authors = preg_replace("/\'/","\'",$name_authors);
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($page)
				{
				// Insert the data in the temporary table ********************************************************************************
				insert_temporary($name_temporary_table, $fragment_id_1, $original_id, $quote, $name_authors, $title, $publication, $year, $pmid_isbn, $pages, $page_location, $id_markerdata, $id_evidence[$i], $id_evidence2[$i1], $type, '0', $color_1[$m2], $pmcid, $nihmsid, $doi, $citation, $volume, $issue, $secondary_pmid);	
				}							
								
					// SHOW ONLY TYPE = DATA:			
				$query = "UPDATE $name_temporary_table SET show1 = '1' WHERE type = 'data' ";							
				$rs = mysql_query($query);								
				}
			}
		
			// Retrieve MARKERDATA ID from EvidenceMarkerdataRel by using ID EVIDENCE: *****************************
			$query = "SELECT id_evidence1 FROM $name_temporary_table";
			$rs = mysql_query($query);
			while(list($id_evidence1) = mysql_fetch_row($rs))
			{
				$evidencemarkerdatarel -> retrive_Markerdata_id($id_evidence1);
				$id_markerdata1 = $evidencemarkerdatarel -> getMarkerdata_id_array(0);
	
				$query1 = "UPDATE $name_temporary_table SET id_markerdata = '$id_markerdata1' WHERE $id_evidence1 = '$id_evidence1' ";							
				$rs1 = mysql_query($query1);					
			}	
			// ****************************************************************************************************
		}

		$query = "SELECT show1 FROM $name_temporary_table";
		$rs = mysql_query($query);
		$n_show1=0;
		while(list($show1) = mysql_fetch_row($rs))
		{
			if ($show1 == 1)
				$n_show1 = $n_show1 + 1;
		}			
	?>
		<!-- ORDER BY: _______________________________________________________________________________________________________ -->
		<table width="80%" border="0" cellspacing="2" cellpadding="0">
			<tr>		
				<?php 
					// -----------------------------------------------------------------------------------------
					if ($n_show1 != 1)
					{
				?>			
					<td width="10%">
						<font class="font2">Order by:</font>
					</td>
					<td width="20%">				
					<form action="property_page_markers.php" method="POST" style="display:inline">
						<select name='order' size='1' cols='10' class='select1'>
						
						<?php
							if ($order_by)
							{	
								if ($order_by == 'year')
									print ("<OPTION VALUE='$order_by'>Date</OPTION>");
								if ($order_by == 'publication')
									print ("<OPTION VALUE='$order_by'>Journal / Book</OPTION>");
								if ($order_by == 'authors')
									print ("<OPTION VALUE='$order_by'>Authors</OPTION>");							
							}							
						?>
						<OPTION VALUE='-'>-</OPTION>
						<OPTION VALUE='year'>Date</OPTION>
						<OPTION VALUE='publication'>Journal / Book</OPTION>
						<OPTION VALUE='authors'>First Authors</OPTION>
						</select>
				
						</td>
						<td width="10%">
							<input type="submit" name='order_ok' value="GO"  />
							<input type="hidden" name='color' value='<?php print $color ?>'  />
							<input type="hidden" name='sub_show_only' value='<?php print $sub_show_only ?>'  />
							
 						</form>	
						</td>
				<?php
					}
					// ---------------------------------------------------------------------------------------------
					else
					{
						print ("<td width='40%'></td>");
					}
				?>

				<td width="10%">
				</td>
				<td width="50%" align="center">
					<form action="property_page_markers.php" method="post" style="display:inline">
					<input type="submit" name='see_all' value="Open All Evidence">
					<input type="submit" name='see_all' value="Close All Evidence">
					<?php print ("<input type='hidden' name='name_show_only' value='$name_show_only'>"); ?>
					</form>				
				</td>						
			</tr>
		</table>

		<br />	
	<?php		
	if ($n_show1 < 2);
	else
	{
	?>
		<!-- TABLE SHOW ONLY *******************************************************************************************************************
		************************************************************************************************************************************* -->				
		<table width="80%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td width="15%" align="left">
				<font class="font2">Show Only:</font> 
			</td>
			<td width="45%" align="left">
			<?php 
				print ("<select name='order' size='1' cols='10' class='select1' onChange=\"show_only(this, '$color')\">");
					
				if ($name_show_only)
				{
					if ($name_show_only == 'all')
						$name_show_only1 = 'All';
					if ($name_show_only == 'article_book')
						$name_show_only1 = 'Articles / Books';								
					if ($name_show_only == 'name_journal')
						$name_show_only1 = 'Name of Publication';
					if ($name_show_only == 'authors')
						$name_show_only1 = 'Authors';
					if ($name_show_only == 'morphology')
						$name_show_only1 = 'Morphology';
																												
					print ("<OPTION VALUE='$name_show_only1'>$name_show_only1</OPTION>");
					print ("<OPTION VALUE='all'>----</OPTION>");
				}
			?>	
				<OPTION VALUE='all'>All</OPTION>
				<OPTION VALUE='article_book'>Articles / Books</OPTION>
				<OPTION VALUE='name_journal'>Name of Publication</OPTION>
				<OPTION VALUE='authors'>Authors</OPTION>
				</select>					
			</td>	
			<td width="40%" align="left">
			<?php 
				// ARTICLE - BOOK: ++++++++++++++++++++++++

				if ($sub_show_only == 'article')
				{
					// retrieve the number of article or number of book:
					$query = "SELECT DISTINCT title, PMID FROM $name_temporary_table WHERE show1 = '1'";	
					$rs = mysql_query($query);
					$number_of_articles_1 = 0;
					$number_of_books_1 = 0;
					while(list($title, $pmid) = mysql_fetch_row($rs))		
					{	
						if (strlen($pmid) > 10)
							$number_of_books_1 = $number_of_books_1 + 1;
						if (strlen($pmid) < 10)
							$number_of_articles_1 = $number_of_articles_1 + 1;							
					}
					
				
					if ($name_show_only_article == 'article')
					{
						print ("<select name='order' size='1' cols='10' class='select1' onChange=\"show_only_article(this, '$color')\">");
						print ("<OPTION VALUE='article'>Article(s) ($number_of_articles_1)</OPTION>");
						print ("<OPTION VALUE='all'>All</OPTION>");
						print ("<OPTION VALUE='book'>Book(s) ($number_of_books_1)</OPTION>");
						print ("</select>");							
					}
					else if ($name_show_only_article == 'book')
					{
						print ("<select name='order' size='1' cols='10' class='select1' onChange=\"show_only_article(this, '$color')\">");
						print ("<OPTION VALUE='book'>Book(s) ($number_of_books_1)</OPTION>");
						print ("<OPTION VALUE='all'>All</OPTION>");
						print ("<OPTION VALUE='article'>Article(s) ($number_of_articles_1)</OPTION>");
						print ("</select>");
					}
					else
					{
						print ("<select name='order' size='1' cols='10' class='select1' onChange=\"show_only_article(this, '$color')\">");
						print ("<OPTION VALUE='all'>All</OPTION>");
						print ("<OPTION VALUE='book'>Book(s) ($number_of_books_1)</OPTION>");
						print ("<OPTION VALUE='article'>Article(s) ($number_of_articles_1)</OPTION>");
						print ("</select>");
					}							
				}						
			
				// PUBLICATION: ++++++++++++++++++++++++
				if ($sub_show_only == 'name_journal')
				{						
					print ("<select name='order' size='1' cols='10' class='select1' onChange=\"show_only_publication(this, '$color')\">");
					
					if ( ($name_show_only_journal != 'all') &&  ($name_show_only_journal != NULL) )
						print ("<OPTION VALUE='$name_show_only_journal'>$name_show_only_journal</OPTION>");
					
					print ("<OPTION VALUE='all'>All</OPTION>");
					
					// retrieve the name of journal from temporary table:
					$query ="SELECT DISTINCT publication FROM $name_temporary_table WHERE show1 = '1'";
					$rs = mysql_query($query);					
					while(list($pub) = mysql_fetch_row($rs))	
					{	
						// retrieve the number of articles for this publication:
						$query1 ="SELECT DISTINCT title FROM $name_temporary_table WHERE publication = '$pub'";
						$rs1 = mysql_query($query1);
						$n_pub1=0;					
						while(list($id) = mysql_fetch_row($rs1))							
							$n_pub1 = $n_pub1 + 1;
					
						if ($pub == $name_show_only_journal);
						else
							print ("<OPTION VALUE='$pub'>$pub ($n_pub1)</OPTION>");		
					}
					print ("</select>");				
				}
				
				// AUTHORS: ++++++++++++++++++++++++
				$aut1 = NULL;
				if ($sub_show_only == 'authors')
				{
					// retrieve the name of authors from temporary table:
					$query ="SELECT DISTINCT authors FROM $name_temporary_table WHERE show1 = '1'";
					$rs = mysql_query($query);				
					
					while(list($aut) = mysql_fetch_row($rs))
					{
						$aut1=$aut1.", ".$aut;
					}					
					$aut1=str_replace(', ', '*', $aut1);
					$single_aut=explode('*', $aut1);

					sort($single_aut);
					$single_aut2=array_unique($single_aut);

					// Remove the blank from array:
					$ni=0;
					for ($i1=0; $i1<count($single_aut2); $i1++)
					{		 
						if ($single_aut2[$i1] == NULL);
						else
						{
							$single_aut3[$ni] = $single_aut2[$i1];
							$ni = $ni + 1;
						}
					}							

					print ("<select name='order' size='1' cols='10' class='select1' onChange=\"show_only_authors(this, '$color')\">");
					
					if ( ($name_show_only_authors != 'all') &&  ($name_show_only_authors != NULL) )
					{
						print ("<OPTION VALUE='$name_show_only_authors'>$name_show_only_authors</OPTION>");
						print ("<OPTION VALUE='all'>---</OPTION>");
					}
					print ("<OPTION VALUE='all'> ALL </OPTION>");
					
					for ($i1=0; $i1<count($single_aut3); $i1++)
					{
					
						// retrieve the number of articles for this publication:
						$query1 ="SELECT DISTINCT title FROM $name_temporary_table WHERE authors LIKE '%$single_aut3[$i1]%'";
						$rs1 = mysql_query($query1);
						$n_auth1=0;					
						while(list($id) = mysql_fetch_row($rs1))	
							$n_auth1 = $n_auth1 + 1;	

						print ("<OPTION VALUE='$single_aut3[$i1]'>$single_aut3[$i1] ($n_auth1)</OPTION>");
					}
					print ("</select>");				
				}						
			?>	
			</td>							
		</tr>
		</table>
		<!-- END TABLE SHOW ONLY ***************************************************************************************************************
		************************************************************************************************************************************* -->	
	<?php
	}
	?>

		<br />

	<?php		
		// Select only DOI, to have the exact number of articles and to show only one time the name of article.
		$query = "SELECT DISTINCT authors, title, publication, year, PMID, pages, pmcid, NIHMSID, doi, citation, show2, show_button, volume, issue FROM $name_temporary_table ORDER BY $order_by $type_order ";				
		$rs = mysql_query($query);	
		$number_of_article = 0;		
		while(list($authors, $title, $publication, $year, $PMID, $pages, $pmcid, $NIHMSID, $doi, $citation, $show2, $show_button, $volume, $issue, $secondary_pmid) = mysql_fetch_row($rs))		
		{
			$DOI[$number_of_article]=$doi;
			
			$authors1[$number_of_article]=$authors;
			$title1[$number_of_article]=$title;
			$publication1[$number_of_article]=$publication;
			$year1[$number_of_article]=$year;
			$PMID1[$number_of_article]=$PMID;
			$pages1[$number_of_article]=$pages;		
			$pmcid1[$number_of_article]=$pmcid;
			$NIHMSID1[$number_of_article]=$NIHMSID;
			$citation1[$number_of_article]=$citation;	
			$show_2[$number_of_article]=$show2;		
			$show_button1[$number_of_article]=$show_button;	
			$volume1[$number_of_article]=$volume;
			$issue1[$number_of_article]=$issue;	
			$number_of_article = $number_of_article + 1;
		}
	
		for ($t3=0; $t3<$number_of_article ; $t3++)
		{	
			if ($show_2[$t3] == 1)
			{				
				if (strlen($PMID1[$t3]) < 10)
				{
					$color_back = '#D5B1B1';
					$value_link ='PMID: '.$PMID1[$t3];
					$link2 = "<a href='http://www.ncbi.nlm.nih.gov/pubmed?term=$value_link' target='_blank'>";								
					$string_pmid = "<strong>PMID: </strong>".$link2;					
				
				}	
				else
				{
					$color_back = '#98B1B5';
					$link2 = "<a href='$link_isbn$PMID1[$t3]' target='_blank'>";
					$string_pmid = "<strong>ISBN: </strong>".$link2;										
				}
					
				print ("<table width='80%' border='0' cellspacing='2' cellpadding='5'>");
				print ("<tr><td width='10%'></td>");
				
				// Buttons RED or GREEN to show the quotes: -----------------------------------------------------------------
				print ("<td width='5%' class='table_neuron_page2' align='center' valign='center'>");	
				if ($show_button1[$t3] == 0)
				{
					print ("<form action='property_page_markers.php' method='post' style='display:inline'>");
					print ("<input type='submit' name='show_1' value=' ' class='show1' title='Show Evidence' alt='Show Evidence'>");
					print ("<input type='hidden' name='title' value='$title1[$t3]'>");
					print ("<input type='hidden' name='name_show_only' value='$name_show_only'>");
					print ("</form>");
				}
				if ($show_button1[$t3] == 1)
				{
					print ("<form action='property_page_markers.php' method='post' style='display:inline' title='Close Evidence' alt='Close Evidence'>");
					print ("<input type='submit' name='show_0' value=' ' class='show0'>");
					print ("<input type='hidden' name='title' value='$title1[$t3]'>");
					print ("<input type='hidden' name='name_show_only' value='$name_show_only'>");				
					print ("</form>");
				}										
				print ("</td>");	
									
				if ($issue1[$t3] != NULL)
					$issue_tot = "($issue1[$t3]),";
				else
					$issue_tot = "";									

				if ($DOI[$t3] != NULL)
					$doi_tot = "DOI: $DOI[$t3]";
				else
					$doi_tot = "";	
													
				print ("						
					<td align='left' width='85%' class='table_neuron_page2'>				
						<font color='#000000'><strong>$title1[$t3] </strong></font> <br>
						$authors1[$t3] <br>
						$publication1[$t3], $year1[$t3], $volume1[$t3] $issue_tot pages: $pages1[$t3]<br>
						$string_pmid<font class='font13'>  $PMID1[$t3]</font></a>; $doi_tot <br>
					</td>	
				</tr>	
				</table>");																																	
				print ("<br>");
		
				
				$query = "SELECT DISTINCT id, id_fragment, id_original, quote, page_location, id_markerdata, show1, type, type_marker, color, id_evidence1, id_evidence2, secondary_pmid, PMID FROM $name_temporary_table WHERE title = '$title1[$t3]' ";				
				$rs = mysql_query($query);											
				while(list($aa, $id_fragment, $id_original, $quote,  $page_location, $id_markerdata, $show1, $type, $type_marker, $color_see, $id_evidence1, $id_evidence2, $secondary_pmid, $PMID) = mysql_fetch_row($rs))		
				{
					if (($show1 == 1) && ($show_button1[$t3] == 1))
					{
            // STM markerdata was not being loaded
          $evidencemarkerdatarel -> retrive_Markerdata_id($id_evidence1);
          $id_markerdata = $evidencemarkerdatarel -> getMarkerdata_id_array(0);
						$markerdata -> retrive_info($id_markerdata);

						$expression = $markerdata -> getExpression();	
            $expression = preg_replace('/[\[\]"]/', '', $expression);
						$animal = $markerdata -> getAnimal();	
            $animal = preg_replace('/[\[\]"]/', '', $animal);
						$protocol = $markerdata -> getProtocol();	
            $protocol = preg_replace('/[\[\]"]/', '', $protocol);
							
						if ($id_fragment_compare == $id_fragment);
						else	
						{		

							// retrieve the attachament from "fragment" with original_id *****************************
					//		$fragment -> retrive_attachment_by_original_id($id_original);
					//		$attachment = $fragment -> getAttachment();
					//		$attachment_type = $fragment -> getAttachment_type();

							// retrieve the attachament from "attachment" with original_id and cell-id(id_neuron)*****************************
							$attachment_obj -> retrive_attachment_by_original_id($id_original, $id_neuron);
							$attachment = $attachment_obj -> getName();
							$attachment_type = $attachment_obj -> getType();
									
							
							// change PFD in JPG:
							$link_figure="";
							$attachment_jpg = str_replace('jpg', 'jpeg', $attachment);
					//	echo "$attachment_jpg";
							if($attachment_type=="marker_figure"||$attachment_type=="marker_table"){
								$link_figure = "attachment/marker/".$attachment_jpg;
					//			echo "marker:-".$link_figure;
							}
							
							if($attachment_type=="morph_figure"||$attachment_type=="morph_table"){
								$link_figure = "attachment/morph/".$attachment_jpg;
						//		echo "morph:-".$link_figure;
							}
							
							if($attachment_type=="ephys_figure"||$attachment_type=="ephys_table"){
								$link_figure = "attachment/ephys/".$attachment_jpg;
								//echo "ephys:-".$link_figure;
							}			
							
							
							//$link_figure = "figure/".$attachment_jpg;
							
							$attachment_pdf = str_replace('jpg', 'pdf', $attachment);
							$link_figure_pdf = "figure_pdf/".$attachment_pdf;
							// **************************************************************************************							
              // STM Formatting header

              $header_html = header_row("EXPRESSION", $expression);
              if ($animal != 'rat')
                $header_html = $header_html . header_row("ANIMAL", $animal);
              if ($protocol != 'immunohistochemistry')
                $header_html = $header_html . header_row("PROTOCOL", $protocol);

              print ("<table width='80%' border='0' cellspacing='2' cellpadding='5'>");
              print $header_html;
              print ("
                <tr>
                <td width='15%'></td>	
                <td align='left' width='70%' class='table_neuron_page2'>				
                Page location: <span title='$id_fragment (original: ".$id_original.")'>$page_location</span>
                </td>	
                <td width='15%'>");
																		
							print ("</td></tr>");					
							print ("
							<tr>
								<td width='15%'></td>	
								<td align='left' width='70%' class='table_neuron_page2'>				
								$quote
								</td>	
								<td width='15%' class='table_neuron_page2' align='center'>");
										
								if ($attachment_type=="marker_figure"||$attachment_type=="marker_table")
								{
									print ("<a href='$link_figure' target='_blank'>");
									print ("<img src='$link_figure' border='0' width='80%'>");
									print ("</a>");
								}	
								else;								
	
							print ("</td></tr>");					

                // STM added for linking PMID
                if ($secondary_pmid and $secondary_pmid != $PMID) {
                print ("
                  <tr>
                  <td width='15%'></td>	
                  <td align='left' width='70%' class='table_neuron_page2'>				
                  Linked through: <a href=http://www.ncbi.nlm.nih.gov/pubmed/$secondary_pmid>PMID $secondary_pmid</a>
                  </td>	
                  <td width='15%'>");
              }
							print ("</table>");
							print ("<br>");	

							$id_fragment_compare = $id_fragment;
						} // END IF	($id_fragment_compare == $id_fragment)
					
					}// end IF show1
					
				} // end WHILE
				
				print ("<br>");	

			} // end show2		
		} // end FOR $t3
		?>	
		</td>
	</tr>
</table>		
    <div height="10" width="80%"/>
</body>
</html>
