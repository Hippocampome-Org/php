<?php
session_start();
include ("access_db.php"); // data base access

$perm = $_SESSION['perm'];
if ($perm == '')
	header("Location:error1.html");

//$research = $_REQUEST['research'];

// Define all the necessary classes needed for the application
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.temporary_result_neurons.php');

// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel) // $id = type_id,$id_property = propert_idy,
{

	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************



function check_color($type, $unvetted) //$type --> whether axons/dendrites or both
{
	//echo "Neuron Type : ".$type." for id ".$id."\n";
	if ($type == 'axons')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/axons_present_unvetted.png' border='0'/>";
		else
			$link[0] = "<img src='images/morphology/axons_present.png' border='0'/>";

		 $link[1] = 'red';

	}
	if ($type == 'dendrites')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/dendrites_present_unvetted.png' border='0'/>";
		else
			$link[0] = "<img src='images/morphology/dendrites_present.png' border='0'/>";

		$link[1] = 'blue';
	}
	if ($type == 'both')
	{
		//echo "Should come here";
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/somata_present_unvetted.png' border='0'/>";
		else
			$link[0] = "<img src='images/morphology/somata_present.png' border='0'/>";
		
		$link[1] = 'violet';
	}
	/* if ($variable == NULL)
	{
		$link[0] = "<img src='images/blank_morphology.png' border='0'/>";
		$link[1] = $variable;
	} */
	//echo $link;
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
	if($img!='')
	{
		$url ='<a href="property_page_morphology.php?id_neuron='.$id.'&val_property='.$key.'&color='.$color1.'&page=1" target="_blank">'.$img.'</a>';	
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

$research = $_REQUEST['research'];

$type = new type($class_type);
$type ->retrive_id();

$number_type = $type ->getNumber_type();
$research = $_REQUEST['research'];
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
$responce = (object) array('page' => $page, 'total' => $total_pages, 'records' =>$count, 'rows' => "");

//$responce->page = $page;
//$responce->total = $total_pages;
$responce->records = $count;


$neuron = array("DG"=>'DG(18)',"CA3"=>'CA3(25)',"CA3c"=>'CA3(25)',"CA2"=>'CA2(5)',"CA1"=>'CA1(39)',"SUB"=>'SUB(3)',"EC"=>'EC(31)');
$neuronColor = array("DG"=>'#770000',"CA3"=>'#C08181',"CA3c"=>'#C08181',"CA2"=>'#FFCC00',"CA1"=>'#FF6103',"SUB"=>'#FFCC33',"EC"=>'#336633');

// read in potential connectivity csv file
				$pot_conn_csv = file_get_contents('connectivity_data_files/potential_connectivity_matrix_v1.0alpha.csv', FILE_USE_INCLUDE_PATH);

				$pot_rows = explode("\n", $pot_conn_csv); // Divide the potential connectivity file into an array of potential rows
				$num_pot_rows = count($pot_rows); // Count the number of potential rows
				unset($pot_rows[$num_pot_rows-1]); // Destroy the last row 
				$pot_header = str_getcsv(array_shift($pot_rows));	// pulls out header row from array				
				
				$pot_conn_matrix = array();
				
				foreach ($pot_rows as $this_pot_row) {
					$pot_conn_matrix[] = array_combine($pot_header, str_getcsv($this_pot_row));
				}  
				
				// read in known connectivity csv file
				$known_conn_csv = file_get_contents('connectivity_data_files/known_connectivity_matrix_v1.0alpha.csv', FILE_USE_INCLUDE_PATH);
				
				$known_rows = explode("\n", $known_conn_csv); // Divide the connectivity array into an array of rows
				$num_known_rows = count($known_rows); // Retrieve the count of the number of rows given
				unset($known_rows[$num_known_rows-1]); // Destroy the last row
				
				 
				
				$known_header = str_getcsv(array_shift($known_rows));	// pulls out header row from array
					
				$known_conn_matrix = array();
				foreach ($known_rows as $this_known_row) {
					$known_conn_matrix[] = array_combine($known_header, str_getcsv($this_known_row));
				}			
					
				$num_columns = 0; 
for ($row=0; $row<$number_type; $row++) {
	
	$hippo_nickname = array("0"=>NULL,"1"=>NULL,"2"=>NULL,"3"=>NULL,"4"=>NULL,"5"=>NULL,"6"=>NULL,
			"7"=>NULL,"8"=>NULL,"9"=>NULL,"10"=>NULL,"11"=>NULL,"12"=>NULL,"13"=>NULL,"14"=>NULL,"15"=>NULL,"16"=>NULL,"17"=>NULL,
			"18"=>NULL,"19"=>NULL,"20"=>NULL,"21"=>NULL,"22"=>NULL,"23"=>NULL,"24"=>NULL,"25"=>NULL,"26"=>NULL,"27"=>NULL,"28"=>NULL,
			"29"=>NULL,"30"=>NULL,"31"=>NULL,"32"=>NULL,"33"=>NULL,"34"=>NULL,"35"=>NULL,"36"=>NULL,"37"=>NULL,"38"=>NULL,"39"=>NULL,
			"40"=>NULL,"41"=>NULL,"42"=>NULL,"43"=>NULL,"44"=>NULL,"45"=>NULL,"46"=>NULL,"47"=>NULL,"48"=>NULL,"49"=>NULL,"50"=>NULL,
			"51"=>NULL,"52"=>NULL,"53"=>NULL,"54"=>NULL,"55"=>NULL,"56"=>NULL,"57"=>NULL,"58"=>NULL,"59"=>NULL,"60"=>NULL,"61"=>NULL,
			"62"=>NULL,"63"=>NULL,"64"=>NULL,"65"=>NULL,"66"=>NULL,"67"=>NULL,"68"=>NULL,"69"=>NULL,"70"=>NULL,"71"=>NULL,"72"=>NULL,
			"73"=>NULL,"74"=>NULL,"75"=>NULL,"76"=>NULL,"77"=>NULL,"78"=>NULL,"79"=>NULL,"80"=>NULL,"81"=>NULL,"82"=>NULL,"83"=>NULL,
			"84"=>NULL,"85"=>NULL,"86"=>NULL,"87"=>NULL,"88"=>NULL,"89"=>NULL,"90"=>NULL,"91"=>NULL,"92"=>NULL,"93"=>NULL,"94"=>NULL,
			"95"=>NULL,"96"=>NULL,"97"=>NULL,"98"=>NULL,"99"=>NULL,"100"=>NULL,"101"=>NULL,"102"=>NULL,"103"=>NULL,"104"=>NULL,"105"=>NULL,
			"106"=>NULL,"107"=>NULL,"108"=>NULL,"109"=>NULL,"110"=>NULL,"111"=>NULL,"112"=>NULL,"113"=>NULL,"114"=>NULL,"115"=>NULL,"116"=>NULL,
			"117"=>NULL,"118"=>NULL,"119"=>NULL,"120"=>NULL,"121"=>NULL);
				
					// retrieve the id_type from Type
					if (isset($research))
						$id_type_row = $id_search[$row];
					else
						$id_type_row = $type->getID_array($row);
					
					$type -> retrive_by_id($id_type_row);
					$nickname_type_row = $type->getNickname();
					$name = $type->getName();
					
					$subregion_type_row = $type->getSubregion();
					$position = $type->getPosition(); // Retrieve the position
					$subregion = $type -> getSubregion(); // Retrieve the sub region 
					$excit_inhib =$type-> getExcit_Inhib();
					
					$nickname_type_row = str_replace('_', ' ', $nickname_type_row);
					$subregion_nickname_type_row = $subregion_type_row . ":" . $nickname_type_row;
					$position_row = $type->getPosition();
					
					if (!isset($research)) {
						$rowIdx = $row;
					}
					else {
						$rowIdx = array_search($id_type_row, $known_header) - 1;
						}
						
		//				if (strpos($nickname_type_row, '(+)') == TRUE)
						if ($excit_inhib == 'e')
							$fontColor='#339900';
						if ($excit_inhib == 'i')
							$fontColor='#CC0000';
						
				for ($col=0; $col<$number_type; $col++) {
					$image ="";
						// retrieve the id_type from Type
						if ($research)
							$id_type_col = $id_search[$col];
						else
							$id_type_col = $type->getID_array($col);
						
						$type -> retrive_by_id($id_type_col);
						$nickname_type_col = $type->getNickname();
						$subregion_type_col = $type->getSubregion();
					
						$nickname_type_col = str_replace('_', ' ', $nickname_type_col);
						$subregion_nickname_type = $subregion_type_col . " " . $nickname_type_col;
						$position_col = $type->getPosition();
						
						if (!$research) {
							$colIdx = $col;
							if ( ($position_col == 201) || ($position_col == 301) || ($position_col == 401) || ($position_col == 501) || ($position_col == 601))
							{
								//print ("<td style='width:4px' bgcolor='#FF0000'></td>");
							}
					   }
						else {		
							$colIdx = array_search($id_type_col, $known_header) - 1;
							if ($col !=0 And ( ($id_type_col == $first_CA3) || ($id_type_col == $first_CA2) || ($id_type_col == $first_CA1) || ($id_type_col == $first_SUB) || ($id_type_col == $first_EC)))
							{
								//print ("<td style='width:4px' bgcolor='#FF0000'></td>");
							}
						}
						//echo " Known Conn Matrix ".$known_conn_matrix[$rowIdx][$known_header[$colIdx+1]]."\n";
						if ($known_conn_matrix[$rowIdx][$known_header[$colIdx+1]] == 0)
						{	
							$presynaptic_bg_color = '#FFFFFF';
						}
						else {
							//echo " Potential Connection Matrix ".$pot_conn_matrix[$rowIdx][$pot_header[$colIdx+1]];
							switch ($pot_conn_matrix[$rowIdx][$pot_header[$colIdx+1]]) {
								case -1:
									$presynaptic_bg_color = '#AAAAAA';
									break;
								case 1:
									$presynaptic_bg_color = '#000000';
									break;
								case 4:
									$presynaptic_bg_color = '#FF8C00';
									break;
								default:
									$presynaptic_bg_color = '#FFFFFF';
									break;
							}
						}
						/* echo " Bg Color ".$presynaptic_bg_color."\n\n";
						echo " Row Idx : ".$rowIdx." Column Idx : ".$colIdx."\n";
						
						
						echo " Value for Known Connectivity Matrix : ".$known_conn_matrix[$rowIdx][$known_header[$colIdx+1]]."\n"; */
						
						if ($known_conn_matrix[$rowIdx][$known_header[$colIdx+1]] == 0)
						{
							$image = "<div style='background-color:".$presynaptic_bg_color."; padding:0 2px;'><img src='images/connectivity/known_nonconnection.png' height='20px' width='20px' border='0'/></div>";
						}
						elseif ($known_conn_matrix[$rowIdx][$known_header[$colIdx+1]] == 1)
						{
							$image = "<div style='background-color:".$presynaptic_bg_color."; padding:0 2px;'><img src='images/connectivity/known_connection.png' height='20px' width='20px' border='0'/></div>";
						}
						else if ( ($rowIdx != $colIdx) And ($known_conn_matrix[$rowIdx][$known_header[$colIdx+1]] == -1))
						{
							if($presynaptic_bg_color=="#000000")
								$image = "<div style='background-color:".$presynaptic_bg_color.";width:100%; padding:0 2px;'><img src='images/connectivity/spacer_black.png' height='20px' width='20px' border='0'/></div>";
							else if($presynaptic_bg_color=="#FF8C00")
								$image = "<div style='background-color:".$presynaptic_bg_color.";padding:0 2px;'><img src='images/connectivity/spacer_orange.png' height='20px' width='20px' border='0'/></div>";
							if($presynaptic_bg_color == "#AAAAAA")
								$image = "<div style='background-color:".$presynaptic_bg_color.";padding:0 2px;'><img src='images/connectivity/spacer_gray.png' height='20px' width='20px' border='0'/></div>";
						} 
						// space rows & columns using images on the main diagonal
						elseif ( ($rowIdx == $colIdx) And ($pot_conn_matrix[$rowIdx][$pot_header[$colIdx+1]] == 0) )
						{
							$image = "<div style='background-color:".$presynaptic_bg_color.";padding:0 2px;'><img src='images/connectivity/spacer_white.png' height='20px' width='20px' border='0'/></div>";
							//echo "Image = ".$image;
						}
						elseif ( ($rowIdx == $colIdx) And ($pot_conn_matrix[$rowIdx][$pot_header[$colIdx+1]] == -1) )
						{
							$image = "<div style='background-color:".$presynaptic_bg_color.";padding:0 2px;'><img src='images/connectivity/spacer_gray.png' height='20px' width='20px' border='0'/></div>";
						}
						elseif ( ($rowIdx == $colIdx) And ($pot_conn_matrix[$rowIdx][$pot_header[$colIdx+1]] == 1) )
						{
							$image = "<div style='background-color:".$presynaptic_bg_color.";padding:0 2px;'><img src='images/connectivity/spacer_black.png' height='20px' width='20px' border='0'/></div>";
						}
						elseif ( ($rowIdx == $colIdx) And ($pot_conn_matrix[$rowIdx][$pot_header[$colIdx+1]] == 4) )
						{
							$image = "<div style='background-color:".$presynaptic_bg_color.";padding:0 2px;'><img src='images/connectivity/spacer_orange.png' height='20px' width='20px' border='0'/></div>";
						}
						/* else
						 $image =""; */
						//echo " COLUMN ".$col." IMAGE ".$image;
						$hippo_nickname[$col] = $image;
						//echo " Col ".$col." Image is ".$image."\n\n";
					}
					$responce->rows[$row]['cell']=array('&nbsp;<span style="color:'.$neuronColor[$subregion_type_row].'"><strong>'.$neuron[$subregion_type_row].'</strong></span>','&nbsp;<a href="neuron_page.php?id='.$id_type_row.'" target="blank" title="'.$name.'"><font color="'.$fontColor.'">'.$nickname_type_row.'</font></a>',
					$hippo_nickname['0'],$hippo_nickname['1'],$hippo_nickname['2'],$hippo_nickname['3'],$hippo_nickname['4'],$hippo_nickname['5'],
					$hippo_nickname['6'],$hippo_nickname['7'],$hippo_nickname['8'],$hippo_nickname['9'],$hippo_nickname['10'],$hippo_nickname['11'],
					$hippo_nickname['12'],$hippo_nickname['13'],$hippo_nickname['14'],$hippo_nickname['15'],$hippo_nickname['16'],$hippo_nickname['17'],
					$hippo_nickname['18'],$hippo_nickname['19'],$hippo_nickname['20'],$hippo_nickname['21'],$hippo_nickname['22'],$hippo_nickname['23'],
					$hippo_nickname['24'],$hippo_nickname['25'],$hippo_nickname['26'],$hippo_nickname['27'],$hippo_nickname['28'],$hippo_nickname['29'],
					$hippo_nickname['30'],$hippo_nickname['31'],$hippo_nickname['32'],$hippo_nickname['33'],$hippo_nickname['34'],$hippo_nickname['35'],
					$hippo_nickname['36'],$hippo_nickname['37'],$hippo_nickname['38'],$hippo_nickname['39'],$hippo_nickname['40'],$hippo_nickname['41'],
					$hippo_nickname['42'],$hippo_nickname['43'],$hippo_nickname['44'],$hippo_nickname['45'],$hippo_nickname['46'],
					$hippo_nickname['47'],$hippo_nickname['48'],$hippo_nickname['49'],$hippo_nickname['50'],$hippo_nickname['51'],$hippo_nickname['52'],
					$hippo_nickname['53'],$hippo_nickname['54'],$hippo_nickname['55'],$hippo_nickname['56'],$hippo_nickname['57'],$hippo_nickname['58'],
					$hippo_nickname['59'],$hippo_nickname['60'],$hippo_nickname['61'],$hippo_nickname['62'],$hippo_nickname['63'],$hippo_nickname['64'],
					$hippo_nickname['65'],$hippo_nickname['66'],$hippo_nickname['67'],$hippo_nickname['68'],$hippo_nickname['69'],$hippo_nickname['70'],
					$hippo_nickname['71'],$hippo_nickname['72'],$hippo_nickname['73'],$hippo_nickname['74'],$hippo_nickname['75'],$hippo_nickname['76'],
					$hippo_nickname['77'],$hippo_nickname['78'],$hippo_nickname['79'],$hippo_nickname['80'],$hippo_nickname['81'],$hippo_nickname['82'],
					$hippo_nickname['83'],$hippo_nickname['84'],$hippo_nickname['85'],$hippo_nickname['86'],$hippo_nickname['87'],$hippo_nickname['88'],
					$hippo_nickname['89'],$hippo_nickname['90'],$hippo_nickname['91'],$hippo_nickname['92'],$hippo_nickname['93'],$hippo_nickname['94'],
					$hippo_nickname['95'],$hippo_nickname['96'],$hippo_nickname['97'],$hippo_nickname['98'],$hippo_nickname['99'],$hippo_nickname['100'],
					$hippo_nickname['101'],$hippo_nickname['102'],$hippo_nickname['103'],$hippo_nickname['104'],$hippo_nickname['105'],$hippo_nickname['106'],
					$hippo_nickname['107'],$hippo_nickname['108'],$hippo_nickname['109'],$hippo_nickname['110'],$hippo_nickname['111'],$hippo_nickname['112'],
					$hippo_nickname['113'],$hippo_nickname['114'],$hippo_nickname['115'],$hippo_nickname['116'],$hippo_nickname['117'],$hippo_nickname['118'],
					$hippo_nickname['119'],$hippo_nickname['120'],$hippo_nickname['121'] );
}
?>
