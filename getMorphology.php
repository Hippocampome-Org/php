<?php
  include ("permission_check.php");
  //$research = $_REQUEST['research'];
  // Define all the necessary classes needed for the application
  require_once('class/class.type.php');
  require_once('class/class.property.php');
  require_once('class/class.evidencepropertyyperel.php');
  require_once('class/class.temporary_result_neurons.php');

$research = $_REQUEST['research'];
$table = $_REQUEST['table_result'];
/* if(isset($research))
	echo "Research variable Set !";
 */
// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel) // $id = type_id,$id_property = propert_idy,
{

	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************

//*******************************Changes to handle somata evidence**************************************
function check_color_somata($id,$type, $unvetted,$val,$part){
	$soma_location_check_somata="SELECT DISTINCT p.subject, p.object
      FROM EvidencePropertyTypeRel eptr
      JOIN (Property p, Type t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
      WHERE predicate = 'in' AND object REGEXP ':'AND eptr.Type_id = '$id' AND subject = 'somata';";
	
	$soma_location_check_axons="SELECT DISTINCT p.subject, p.object
      FROM EvidencePropertyTypeRel eptr
      JOIN (Property p, Type t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
      WHERE predicate = 'in' AND object REGEXP ':'AND eptr.Type_id = '$id' AND subject = 'axons';";
	
	$soma_location_check_dendrites="SELECT DISTINCT p.subject, p.object
      FROM EvidencePropertyTypeRel eptr
      JOIN (Property p, Type t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
      WHERE predicate = 'in' AND object REGEXP ':'AND eptr.Type_id = '$id' AND subject = 'dendrites';";
	
	$result_somata = mysql_query($soma_location_check_somata);
	$result_axons = mysql_query($soma_location_check_axons);
	$result_dendrites = mysql_query($soma_location_check_dendrites);
	$axons_dendrites_check=0;
	
	while(list($subject,$object) = mysql_fetch_row($result_axons)){
		if($subject=='axons' && $object==$val){
			$axons_dendrites_check=1;
			break;
		}
	}
	
	while(list($subject,$object) = mysql_fetch_row($result_dendrites)){
		if($subject=='dendrites' && $object==$val){
			$axons_dendrites_check=1;
			break;
		}
	}
	
	$flag=0;
//	if($axons_dendrites_check!=1){
		while(list($subject,$object) = mysql_fetch_row($result_somata)){
			if($subject=='somata' && $object==$val){
				
				$flag=1;
				break;
			}
		}
//	}
	
	 if ($type == 'somata'){
			if($flag==1)
				$link[0] = "<img src='images/morphology/neuron_soma.png' border='0'/>";
//	$link[1]='somata';
		}
	
	return ($link);
}


function check_color($id,$type, $unvetted,$val,$part) //$type --> whether axons/dendrites or both
{
	$soma_location_check="SELECT DISTINCT p.subject, p.object
      FROM EvidencePropertyTypeRel eptr
      JOIN (Property p, Type t) ON (eptr.Property_id = p.id AND eptr.Type_id = t.id)
      WHERE predicate = 'in' AND object REGEXP ':'AND eptr.Type_id = '$id' AND subject = 'somata';";
	
	$result = mysql_query($soma_location_check);
	$flag=0;
	while(list($subject,$object) = mysql_fetch_row($result)){
		if($subject=='somata' && $object==$val){
			$flag=1;
			break;
		}
	}
	if ($type == 'axons')
	{
		if ($unvetted == 1){
			$link[0] = "<img src='images/morphology/axons_present_unvetted.png' border='0'/>";
		}
		else{
			if($flag==1){
				$link[0] = "<img src='images/morphology/axons_present_soma.png' border='0'/>";
				
			}
			else{
				$link[0] = "<img src='images/morphology/axons_present.png' border='0'/>";
			}
		}
		 $link[1] = 'red';
	}
	else if ($type == 'dendrites')
	{
		if ($unvetted == 1){
			$link[0] = "<img src='images/morphology/dendrites_present_unvetted.png' border='0'/>";
		}
		else{
			if($flag==1){
				$link[0] = "<img src='images/morphology/dendrites_present_soma.png' border='0'/>";
			}
			else{
				$link[0] = "<img src='images/morphology/dendrites_present.png' border='0'/>";
			}
		}
		$link[1] = 'blue';
	}
	else if ($type == 'both')
	{
		//echo "Should come here";
		if ($unvetted == 1){
			$link[0] = "<img src='images/morphology/somata_present_unvetted.png' border='0'/>";
		}
		else{
			if($flag==1)
				$link[0] = "<img src='images/morphology/somata_present_soma.png' border='0'/>";
				
		else
			$link[0] = "<img src='images/morphology/somata_present.png' border='0'/>";
		}
		$link[1] = 'violet';
	}
	return ($link);
}
// check for link
/*  
 * $id - Type id
 * $img - img path
 * $key - DG_Smo For Type SMo 0f DG
 * $color - red/blue or violet 
 * */
function getUrlForLink($id,$img,$key,$color1) 
{
	$url = '';
	if($color1!=''){
		if($img!='')
		{
			$url ='<a href="property_page_morphology.php?id_neuron='.$id.'&val_property='.$key.'&color='.$color1.'&page=1" target="_blank">'.$img.'</a>';	
		}
	}
	else{
	if($img!='')
		{
			$url =$img;	
		}
	}
	return ($url);	
}
if(!isset($_GET['page'])) $page=1;
else $page = $_GET['page'];
//page=1&rows=5&sidx=1&sord=asc
// get how many rows we want to have into the grid - rowNum parameter in the grid
if(!isset($_GET['rows'])) $limit=122;
else $limit = $_GET['rows'];

// get index row - i.e. user click to sort. At first time sortname parameter -
// after that the index from colModel
if(!isset($_GET['sidx'])) $sidx=1;
else $sidx = $_GET['sidx'];

// sorting order - at first time sortorder
if(!isset($_GET['sord'])) $sord="asc";
else $sord = $_GET['sord'];

// if we not pass at first time index use the first column for the index or what you want
if(!$sidx) $sidx =1;

$type = new type($class_type);
//$research = 0;
/* if(isset($research)
	$research = $_GET['researchVar']; */
if (isset($research)) // From page of search; retrieve the id from search_table (temporary) -----------------------
{
	$table_result = $_REQUEST['table_result'];
	$temporary_result_neurons = new temporary_result_neurons();
	$temporary_result_neurons -> setName_table($table_result);
	
	$temporary_result_neurons -> retrieve_id_array();
	$n_id_res = $temporary_result_neurons -> getN_id();
	$number_type = 0;
	for ($i2=0; $i2<$n_id_res; $i2++)
	{
		$id2 = 	$temporary_result_neurons -> getID_array($i2); // Retrieve  each ID corresponding to the id Array

		if (strpos($id2, '0_') == 1);
		else
		{
			$type -> retrive_by_id($id2); // For each Id  retrieve the type characteristics
			$status = $type -> getStatus(); // Retrieve the status for each id
				
			if ($status == 'active')
			{
				$id_search[$number_type] = $id2;
				$position_search[$number_type] = $type -> getPosition();
				$number_type = $number_type + 1;
			}
		}
	} // END $i2

	array_multisort($position_search, $id_search);
	// sort($id_search);
}
else // not from search page --------------
{
		if($_GET['_search']=='false') // Condition to check ifthe 
		{
			$type -> retrive_id();
			$number_type = $type->getNumber_type();
		}
		else{
			//Retrieve types by Search conditions

			//echo "Search ".$_GET['_search'];
			/* echo "Search Field : ".$_GET['searchField']; // – the name of the field defined in colModel
			echo "Search String : ".$_GET['searchString']; // – the string typed in the search field
			echo "Search Operator : ".$_GET['searchOper']; //– the operator choosen in the search field (ex. equal, greater than, …) */
				
		}
}

$property = new property($class_property);

$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);

//$hippo_select = $_SESSION['hippo_select'];
$count = $number_type;
//echo "The number of elements are ".$count." and the limit is ".$limit;
if($count <= $limit)
	$limit = $count;

// calculate the total pages for the query
if( $count > 0 && $limit > 0) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}

// if for some reasons the requested page is greater than the total
// set the requested page to total page
if ($page > $total_pages) 
	$page=$total_pages;

// calculate the starting position of the rows
$start = $limit*$page - $limit;

// if for some reasons start position is negative set it to 0
// typical case is that the user type 0 for the requested page
if($start <0) 
	$start = 0;

$n_DG = 0;
$n_CA3 = 0;
$n_CA2 = 0;
$n_CA1 = 0;
$n_SUB = 0;
$n_EC = 0;

//header("Content-type: application/json;charset=utf-8");
$responce = (object) array('page' => 1, 'total' => $total_pages, 'records' =>$count, 'rows' => "");

//$responce->page = $page;
//$responce->total = $total_pages;
$responce->records = $count; 

if($research!="1")
{
	//$type -> retieve_ordered_List($start,$limit);
	$type -> retrive_id();
	$number_type = $type->getNumber_type();
}
$neuron = array("DG"=>'DG(18)',"CA3"=>'CA3(25)',"CA3c"=>'CA3(25)',"CA2"=>'CA2(5)',"CA1"=>'CA1(40)',"SUB"=>'SUB(3)',"EC"=>'EC(31)');
$neuronColor = array("DG"=>'#770000',"CA3"=>'#C08181',"CA3c"=>'#C08181',"CA2"=>'#FFCC00',"CA1"=>'#FF6103',"SUB"=>'#FFCC33',"EC"=>'#336633');
for ($i=0; $i<$number_type; $i++) //$number_type // Here he determines the number of active neuron types to print each row in the data table
{

	// Array to store each neuron property
	$hippo = array("DG:SMo"=>'',"DG:SMi"=>'',"DG:SG"=>'',"DG:H"=>'',
			"CA3:SLM" =>'', "CA3:SR" =>'', "CA3:SL" =>'', "CA3:SP" =>'', "CA3:SO" =>'',
			"CA2:SLM" =>'', "CA2:SR" =>'', "CA2:SP" =>'', "CA2:SO" =>'',
			"CA1:SLM" =>'', "CA1:SR" =>'', "CA1:SP" =>'', "CA1:SO" =>'',
			"SUB:SM" =>'', "SUB:SP" =>'', "SUB:PL" =>'',
			"EC:I" =>'', "EC:II" =>'', "EC:III" =>'', "EC:IV" =>'', "EC:V" =>'', "EC:VI" =>'' );
	
	// Color array for each property depending on Axon,Dendrite or both being present
	$hippo_color = array("DG:SMo"=>'',"DG:SMi"=>'',"DG:SG"=>'',"DG:H"=>'',
			"CA3:SLM" =>'', "CA3:SR" =>'', "CA3:SL" =>'', "CA3:SP" =>'', "CA3:SO" =>'',
			"CA2:SLM" =>'', "CA2:SR" =>'', "CA2:SP" =>'', "CA2:SO" =>'',
			"CA1:SLM" =>'', "CA1:SR" =>'', "CA1:SP" =>'', "CA1:SO" =>'',
			"SUB:SM" =>'', "SUB:SP" =>'', "SUB:PL" =>'',
			"EC:I" =>'', "EC:II" =>'', "EC:III" =>'', "EC:IV" =>'', "EC:V" =>'', "EC:VI" =>'' );
	
		if(isset($id_search))
			$id = $id_search[$i];	
		else
	 		$id = $type->getID_array($i);
	 
	 $type -> retrive_by_id($id); // Retrieve id
	 $nickname = $type->getNickname(); // Retrieve nick name
	 $position = $type->getPosition(); // Retrieve the position
	 $subregion = $type -> getSubregion(); // Retrieve the sub region
	 $excit_inhib =$type-> getExcit_Inhib();//Retrieve the Excit or Inhib
	
	$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id); // Retrieve properties for each Type id
	
	$n_property_id = $evidencepropertyyperel -> getN_Property_id(); // retrieve a count of the total number of property ids
	
	$q=0;
	for ($i5=0; $i5<$n_property_id; $i5++) // For Each Property id he derieves by using an Index
	{
		$Property_id = $evidencepropertyyperel -> getProperty_id_array($i5); // Retrieve the property to the corresponding index passed
		$property -> retrive_by_id($Property_id); // For a property id derieved as above,retrieve its corresponding properties
		$rel = $property->getRel(); // Retrieve Predicate (from the property table)
		$part1 = $property->getPart(); // Retrieve Subject (from the property table)
	
		if (($rel == 'in'))
	//	if (($rel == 'in') && ($part1 != 'somata')) // Why are we eliminating Somata in ?
		{
			$id_p[$q] = $property->getID();
			$val[$q] = $property->getVal();  // Get the Object
			$part[$q] = $property->getPart();  // Get the Subject
			$q = $q+1;
		}
	}
	for ($ii=0; $ii<$q; $ii++) // For all the preperties derieved check the required conditions
	{
		if($part[$ii]!='somata')
		{		
			$val_array=explode(':', $val[$ii]); // Check the object from the property index
			// DG +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			if(count($val_array) > 1) // To check if the explode has returned both the postfix value and the prefix value
			{
				$unvetted = check_unvetted1($id, $id_p[$ii], $evidencepropertyyperel); // Checks if a particular property is vetted or unvetted
				$neuronType = ''; // Whether neuron present is Axon,Dendrite or Both
		//		if($hippo[$val[$ii]]!='') // Check if for a particular property , the associated value 
				if($hippo_color[$val[$ii]]!='')
				{
					$neuronType ='both';
					/* $img = check_color('both', $unvetted);
					$hippo[$val[$ii]] = $img[0]; */
				}
				else{
					if ($part[$ii] == 'axons')
						$neuronType ='axons';
						//$hippo[$val[$ii]] ='<img src=images/morphology/axons_present.png>';
					else
						$neuronType ='dendrites';
						//$hippo[$val[$ii]] ='<img src=images/morphology/dendrites_present.png>';
				}
				 $img = check_color($id,$neuronType, $unvetted,$val[$ii],$part[$ii]);
				 $hippo[$val[$ii]] = $img[0];
				 $hippo_color[$val[$ii]] = $img[1]; 
			} 
		}
		if($part[$ii]=='somata'){	
			$val_array=explode(':', $val[$ii]);
			if(count($val_array) > 1) // To check if the explode has returned both the postfix value and the prefix value
			{
				$unvetted = check_unvetted1($id, $id_p[$ii], $evidencepropertyyperel); // Checks if a particular property is vetted or unvetted
				$neuronType ='somata';
				$img_somata = check_color_somata($id,$neuronType, $unvetted,$val[$ii],$part[$ii]);
				if($img_somata!=''){
				 	$hippo[$val[$ii]] = $img_somata[0];
//		 $hippo_color[$val[$ii]] = $img_somata[1];		
				} 
			}
		}
	}
//	if (strpos($nickname, '(+)') == TRUE)
	if ($excit_inhib == 'e')
		$fontColor='#339900';
//	if (strpos($nickname, '(-)') == TRUE)
	if ($excit_inhib == 'i')
		$fontColor='#CC0000';
	
	$responce->rows[$i]['cell']=array('<span style="color:'.$neuronColor[$subregion].'"><strong>'.$neuron[$subregion].'</strong></span>','<a href="neuron_page.php?id='.$id.'" target="blank" title="'.$type->getName().'"><font color="'.$fontColor.'">'.$nickname.'</font></a>',
			getUrlForLink($id,$hippo['DG:SMo'],'DG_SMo',$hippo_color['DG:SMo']),
			getUrlForLink($id,$hippo['DG:SMi'],'DG_SMi',$hippo_color['DG:SMi']),
			getUrlForLink($id,$hippo['DG:SG'],'DG_SG',$hippo_color['DG:SG']),
			getUrlForLink($id,$hippo['DG:H'],'DG_H',$hippo_color['DG:H']),
			getUrlForLink($id,$hippo['CA3:SLM'],'CA3_SLM',$hippo_color['CA3:SLM']),
			getUrlForLink($id,$hippo['CA3:SR'],'CA3_SR',$hippo_color['CA3:SR']),
			getUrlForLink($id,$hippo['CA3:SL'],'CA3_SL',$hippo_color['CA3:SL']),
			getUrlForLink($id,$hippo['CA3:SP'],'CA3_SP',$hippo_color['CA3:SP']),
			getUrlForLink($id,$hippo['CA3:SO'],'CA3_SO',$hippo_color['CA3:SO']),
			getUrlForLink($id,$hippo['CA2:SLM'],'CA2_SLM',$hippo_color['CA2:SLM']),
			getUrlForLink($id,$hippo['CA2:SR'],'CA2_SR',$hippo_color['CA2:SR']),
			getUrlForLink($id,$hippo['CA2:SP'],'CA2_SP',$hippo_color['CA2:SP']),
			getUrlForLink($id,$hippo['CA2:SO'],'CA2_SO',$hippo_color['CA2:SO']),
			getUrlForLink($id,$hippo['CA1:SLM'],'CA1_SLM',$hippo_color['CA1:SLM']),
			getUrlForLink($id,$hippo['CA1:SR'],'CA1_SR',$hippo_color['CA1:SR']),
			getUrlForLink($id,$hippo['CA1:SP'],'CA1_SP',$hippo_color['CA1:SP']),
			getUrlForLink($id,$hippo['CA1:SO'],'CA1_SO',$hippo_color['CA1:SO']),
			getUrlForLink($id,$hippo['SUB:SM'],'SUB_SM',$hippo_color['SUB:SM']),
			getUrlForLink($id,$hippo['SUB:SP'],'SUB_SP',$hippo_color['SUB:SP']),
			getUrlForLink($id,$hippo['SUB:PL'],'SUB_PL',$hippo_color['SUB:PL']),
			getUrlForLink($id,$hippo['EC:I'],'EC_I',$hippo_color['EC:I']),
			getUrlForLink($id,$hippo['EC:II'],'EC_II',$hippo_color['EC:II']),
			getUrlForLink($id,$hippo['EC:III'],'EC_III',$hippo_color['EC:III']),
			getUrlForLink($id,$hippo['EC:IV'],'EC_IV',$hippo_color['EC:IV']),
			getUrlForLink($id,$hippo['EC:V'],'EC_V',$hippo_color['EC:V']),
			getUrlForLink($id,$hippo['EC:VI'],'EC_VI',$hippo_color['EC:VI']),
			);
}
?>
