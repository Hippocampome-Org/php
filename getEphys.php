<?php
session_start();
include ("access_db.php"); // data base access
include ("function/ephys_unit_table.php"); // Include unit table
include ("function/ephys_num_decimals_table.php"); // Include num decimals table

$perm = $_SESSION['perm'];
if ($perm == '')
	header("Location:error1.html");

$research = $_REQUEST['research'];

// Define all the necessary classes needed for the application
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.epdata.php');
require_once('class/class.temporary_result_neurons.php');

function getUrlForLink($id,$img,$key,$color1)
{
	$url = '';
	if($img!='')
	{
		$url ='<a href="property_page_morphology.php?id_neuron='.$id.'&val_property='.$key.'&color='.$color1.'&page=markers" target="_blank">'.$img.'</a>';
	}
	return ($url);
}

function print_ephys_value_and_hover($param_str, $i, $number_type, $id_ephys2, $id_type, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2) {
	include ("function/ephys_unit_table.php");
	include ("function/ephys_num_decimals_table.php");

	$num_decimals = $ephys_num_decimals_table[$param_str];
	$units = $ephys_unit_table[$param_str];
	if ($units == 'MOhm')
		$units = 'M&Omega;';

	
	if ($unvetted_ephys2[$param_str] == 1)
		$color_unvetted = 'font4_unvetted';
	else
		$color_unvetted = 'font4';

	if ($ephys2[$param_str] != NULL)
		$formatted_value = number_format($ephys2[$param_str], $num_decimals, ".", "");
	else
		$formatted_value = NULL;

	if ($weighted_std_ephys2[$param_str] == 0);
	else
		$weighted_std_ephys2[$param_str] = number_format($weighted_std_ephys2[$param_str], $num_decimals,".","");


	if ($param_str == 'sag_ratio')
		$span_class_str = 'link_right';
	else
		$span_class_str = 'link_left';

	if ($number_type - $i <= 4)
		$span_class_str = $span_class_str . '_bottom';
	
	$outputStr ='';
	if($formatted_value!='')
	{
		$outputStr = '<span class="'.$span_class_str.'"><a href="property_page_ephys.php?id_ephys='.$id_ephys2[$param_str].'&id_neuron='.$id_type.'&ep='.$param_str.'" target="_blank" class="'.$color_unvetted.'">'.$formatted_value;
	
	//$print_str = $formatted_value . ' &plusmn; ' . $weighted_std_ephys2[$param_str] . ' ' . $units;
		$print_str = ' &plusmn; ' . $weighted_std_ephys2[$param_str] . ' ' . $units;
	
		$outputStr.='<span> '.$print_str.'&#013;Sources : '.$nn_ephys2[$param_str].' &#013;';
		$outputStr.='Total cells : '.$tot_n1_ephys2[$param_str].'&#013;';
		$outputStr.='</span></a></span>';
	}
	return $outputStr;
}

// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel) // $id = type_id,$id_property = propert_id,
{
	//echo " Type id: ".$id." Property Id : ".$id_property;
	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************

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
$research = $_GET['researchVar'];
if ($research=="1") // From page of search; retrieve the id from search_table (temporary) -----------------------
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

$epdataevidencerel = new epdataevidencerel($class_epdataevidencerel);

$epdata = new epdata($class_epdata);

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

header("Content-type: application/json;charset=utf-8");

$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;

if($research!="1")
{
	//$type -> retieve_ordered_List($start,$limit);
	$type -> retrive_id();
	$number_type = $type->getNumber_type();
}
$neuron = array("DG"=>'DG(18)',"CA3"=>'CA3(25)',"CA2"=>'CA2(5)',"CA1"=>'CA1(40)',"SUB"=>'SUB(3)',"EC"=>'EC(31)');
$neuronColor = array("DG"=>'#770000',"CA3"=>'#C08181',"CA2"=>'#FFCC00',"CA1"=>'#FF6103',"SUB"=>'#FFCC33',"EC"=>'#336633');
$ephys = array("0"=>"Vrest", "1"=>"Rin","2"=>"tm","3"=>"Vthresh", "4"=>"fast_AHP",
		"5" =>"AP_ampl", "6" =>"AP_width", "7" =>"max_fr", "8" =>"slow_AHP", "9" =>"sag_ratio");
for ($i=0; $i<$number_type; $i++) //$number_type // Here he determines the number of active neuron types to print each row in the data table
{

		if(isset($id_search))
		{
			$id = $id_search[$i];	
		}
		else
	 		$id = $type->getID_array($i);
	 
		$ephys2 = array("Vrest"=>NULL, "Rin"=>NULL,"tm"=>NULL, "Vthresh"=>NULL, "fast_AHP"=>NULL,
				"AP_ampl" =>NULL, "AP_width" =>NULL, "max_fr" =>NULL, "solw_AHP" =>NULL, "sag_ratio" =>NULL);
		$id_ephys2 = array("Vrest"=>NULL, "Rin"=>NULL,"tm"=>NULL, "Vthresh"=>NULL, "fast_AHP"=>NULL,
				"AP_ampl" =>NULL, "AP_width" =>NULL, "max_fr" =>NULL, "solw_AHP" =>NULL, "sag_ratio" =>NULL);
		
		$unvetted_ephys2 = array("Vrest"=>NULL, "Rin"=>NULL,"tm"=>NULL, "Vthresh"=>NULL, "fast_AHP"=>NULL,
				"AP_ampl" =>NULL, "AP_width" =>NULL, "max_fr" =>NULL, "solw_AHP" =>NULL, "sag_ratio" =>NULL);
		
	 	$type -> retrive_by_id($id); // Retrieve id
	 	$nickname = $type->getNickname(); // Retrieve nick name
	 	$position = $type->getPosition(); // Retrieve the position
	 	$subregion = $type -> getSubregion(); // Retrieve the sub region
	
		$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id); // Retrieve distinct Property ids for each type id
		$n_property = $evidencepropertyyperel -> getN_Property_id(); // Count of the number of properties for a given type id
	
		$q=0;
		for ($i1=0; $i1<count($ephys); $i1++) // check for each name Eg. Vrest,Rin,tm etc..
		{
			$name_epys= $ephys[$i1]; // retrieve each property for the corresponding index value
		
			$property ->  retrive_ID(3, $name_epys, NULL, NULL); // Retrieve Id for a particular name_ephys
			$n_id_property = $property -> getNumber_type(); // Retrive the count of property ids
		
			for ($ii2=0; $ii2<$n_id_property; $ii2++)
			{
				$tot_value = 0;
				$tot_n = 0;
				$tot_n_squared = 0;
				$weighted_sum = 0;
				$final_value = 0;
				$n_Value = 0;
				
				$evidence_id = NULL;
				$property_id = $property -> getProperty_id($ii2); // Get property id corresponding to a particular index
				
				// Keep only property_id related by id_type;
				// and retrieve id_evidence by these id:
				$evidencepropertyyperel -> retrive_evidence_id($property_id, $id); // Retrive evidence ids for a particular property
				$nn = $evidencepropertyyperel ->getN_evidence_id(); // get count of all evidences for a particular property id
				
				if ($nn == 0);
				else {  // there are more VALUE1:
				for ($t1=0; $t1<$nn; $t1++) {
				$evidence_id = $evidencepropertyyperel -> getEvidence_id_array($t1); // At each index of the array get the Evidence id array
				$epdataevidencerel -> retrive_Epdata($evidence_id);	// For each evidence id retrive the EpdataId
				$epdata_id = $epdataevidencerel -> getEpdata_id();
				$epdata -> retrive_all_information($epdata_id); // Retrieve all information for a given epdata
					
				$value1 = $epdata -> getValue1(); // Retrieve value 1 for a give epdata id
				$value2 = $epdata -> getValue2(); // Retrieve value 2 for a give epdata id
				if($value2)	// if value 2 is set
				{
					$final_value = ($value1 + $value2) / 2; // final value for that particular evidence id is the mean
					$final_value_array[$t1] = $final_value;
				}
				else
				{
					$final_value = $value1;  //else final value for that evidence is value 1
					$final_value_array[$t1] = $value1;
				}
				$n_measurement = $epdata -> getN();
				if (!$n_measurement) // if n_measurement is not set
					$n_measurement = 1; // n_measurement is 1
				
				$n_array[$t1] = $n_measurement;
				
				$tot_value = $tot_value + $final_value; // Total value is calculated as the sum of all evidences
				$tot_n = $tot_n + $n_measurement; // Total of all n values for evidences for a given property
				$tot_n_squared = $tot_n_squared + pow($n_measurement,2); // Total of all (n*n) values for evidences for a given property
				$weighted_sum = $weighted_sum + ($final_value * $n_measurement); // Product of Final value and n of all evidences associated to a property
			
			}
		
			// calculate weighted mean
			if ($tot_n != 0)
				$mean_value = $weighted_sum / $tot_n; // Calculate the mean for each property
			else
				$mean_value = -999999; // print a value to indicate an error; div by 0 
		
			// calculated weighted variance
			if ($nn == 1)
				$weighted_var = 0;
			else {
			$weighted_var_sum = 0;
			for ($y2=0; $y2<$nn; $y2++)
				$weighted_var_sum = $weighted_var_sum + ($n_array[$y2] * pow($final_value_array[$y2] - $mean_value, 2)); // calculate weighted variable sum
		
			$weighted_var = $weighted_var_sum / $tot_n;
			}
		
			$weighted_std = sqrt($weighted_var);
		
				$ephys2[$name_epys] = $mean_value; // Store the mean value for each header name
				$id_ephys2[$name_epys] = $epdata_id; // Store the epdata id for each epdata
				$nn_ephys2[$name_epys] = $nn; // Store the n measurement for each header name
				$tot_n1_ephys2[$name_epys] = $tot_n; // Store the total for each header name
				$weighted_std_ephys2[$name_epys] = $weighted_std; // Store the weighted standard deviation 
			}
		
				// Check the UNVETTED color: ***************************************************************************
				$evidencepropertyyperel -> retrive_unvetted($id_type, $property_id); // For a particular type and property id check if vetted or unvetted
				$unvetted = $evidencepropertyyperel -> getUnvetted();
				$unvetted_ephys2[$name_epys]=$unvetted;
		
				$property_id_ephys2[$name_epys] =  $property_id;
			}
		}
		
		if (strpos($nickname, '(+)') == TRUE)
			$fontColor='#339900';
		if (strpos($nickname, '(-)') == TRUE)
			$fontColor='#CC0000';
		
	   $responce->rows[$i]['cell']=array('<span style="color:'.$neuronColor[$subregion].'"><strong>'.$neuron[$subregion].'</strong></span>','<a href="neuron_page.php?id='.$id.'" target="blank"><font color="'.$fontColor.'">'.$nickname.'</font></a>',
			print_ephys_value_and_hover('Vrest', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('Rin', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('tm', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('Vthresh', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('fast_AHP', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('AP_ampl', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('AP_width', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('max_fr', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('slow_AHP', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2),
	  		print_ephys_value_and_hover('sag_ratio', $i, $number_type, $id_ephys2, $id, $unvetted_ephys2, $ephys2, $nn_ephys2, $tot_n1_ephys2, $weighted_std_ephys2)
	  		); 
}
echo json_encode($responce);
?>