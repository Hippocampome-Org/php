<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$parameter=$_GET['marker'];

//&prop;-act2 ; GABAa &prop
if ($parameter=="alpha-actinin-2")
	$title = "&prop;-act2";
elseif ($parameter=="Gaba-a-alpha")
	$title = "GABAa &prop;1";
else
	$title = $parameter;
if (strpos($parameter,'\\') != false) {
	$parameter = str_replace('\\', '\\\\', $parameter);
}

$predicateArr=array('positive'=>'Types with positive expression','negative'=>'Types with negative expression','mixed'=>'Types with mixed expression','unknown'=>'Types with unknown expression');

//include ("access_db.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.evidenceevidencerel.php');
require_once('class/class.epdataevidencerel.php');
require_once('class/class.epdata.php');
require_once('class/class.typetyperel.php');

include ("function/name_ephys.php");
include ("function/stm_lib.php");

$type = new type($class_type);
$type -> retrive_id();
$number_type = $type->getNumber_type();
$property_1 = new property($class_property);
$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);
$evidenceevidencerel = new evidenceevidencerel($class_evidenceevidencerel);
$epdataevidencerel = new epdataevidencerel($class_epdataevidencerel);
$epdata = new epdata($class_epdata);
$typetyperel = new typetyperel();

$objArr = $property_1->retrievePropertyIdByName($parameter);
// SEARCH Function for MARKERS: ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function markers_search($evidencepropertyyperel, $property_1, $type, $predicate, $parameter) {	
	$n_tot = 0;				// Variable to be used as an index for storing the resultant Type ID
	$new_type_id = NULL;	// Variable to store and return the complete list of Matched and Unmatched IDs
	
	if(($predicate != 'unknown')) {
		// Call the function to search for the appropriate Type Ids
		$evidencepropertyyperel -> retrive_Type_id_by_Subject_override($parameter, $predicate);
	}
	else {// if it unknown
		$evidencepropertyyperel -> retrive_Type_id_by_Subject_Object($parameter, $predicate);
	}
	
	$n_type_id = $evidencepropertyyperel -> getN_Type_id();		// Get the total number of the search result Type IDs
	
	// Get the total number of Type Ids in Type table
	$number_type= $type -> getNumber_type();
	
	// Iterate through the result of the conflict override searched Type Ids
	for ($i1=0; $i1<$n_type_id; $i1++) {
		if(($predicate != 'unknown')) {
			$type_id[$n_tot] = $evidencepropertyyperel -> getType_id_array($i1);
		}
		else {
			$type_r = $evidencepropertyyperel -> getType_id_array($i1);
			$type_id[$n_tot] = "10_".$type_r;
		}
		
		$n_tot = $n_tot + 1;
	}
	
	// Check if Type_id arrary is not null
	if ($type_id != NULL)
		$new_type_id = array_unique($type_id);
	
	if (!empty($new_type_id)) {
		foreach ($new_type_id as $an_id) {
			//$new_type_id['note_key'][$an_id] = $predicate;
			$new_type_conflict_note[$an_id] = $predicate;
		}
	}
	
	return array($new_type_id, $new_type_conflict_note);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
	include ("function/icon.html"); 
	print("<title>" . $title . " expression</title>");
?>
<script type="text/javascript" src="style/resolution.js"></script>
</head>
<!-- COPY IN ALL PAGES -->
<div class='title_area'>
	<font class="font1"><?php echo $title?></font>
</div>
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
	
	?>
<body>
	<div class="table_position_search_page" align='center'>
	<table width="80%" border="0" cellspacing="2" cellpadding="0">
		<tr>
			<td width="80%" align="center" class="table_neuron_page3">Molecular Markers</td>			
		</tr>			
	</table>
<?php 

$n_result_tot = 0;
$id_t = Array();
$pos_Array = Array();
$pos_intr_Array = Array();
$pos_inf_intr_Array = Array();
$neg_Array = Array();
$neg_inf_Array = Array();
$mixed_type = Array();
$name_type = "";
$subregion_type ="";
$position_type = "";
foreach ($predicateArr as $k => $v)
{
	$marker_id = Array();
	$n_result_tot = 0;
	
	if($k=='mixed')
	{
        if(!empty($evidencepropertyyperel)){
        	$pos_neg_all = array();
        	
			list($pos_neg_all[], $conf_notes_subtypes) = markers_search($evidencepropertyyperel, $property_1, $type, 'subtypes', $parameter);
			list($pos_neg_all[], $conf_notes_spse) = markers_search($evidencepropertyyperel, $property_1, $type, 'species/protocol/subcellular expression differences', $parameter);
			list($pos_neg_all[], $conf_notes_unresolved) = markers_search($evidencepropertyyperel, $property_1, $type, 'unresolved', $parameter);
			list($pos_neg_all[], $conf_notes_pni) = markers_search($evidencepropertyyperel, $property_1, $type, 'positive; negative inference', $parameter);
			list($pos_neg_all[], $conf_notes_pin) = markers_search($evidencepropertyyperel, $property_1, $type, 'positive inference; negative', $parameter);
			list($pos_neg_all[], $conf_notes_pini) = markers_search($evidencepropertyyperel, $property_1, $type, 'positive inference; negative inference', $parameter);
			
			
        	$marker_id = array();

			foreach($pos_neg_all as $arr) {
			    if(is_array($arr)) {
			        $marker_id = array_merge($marker_id, $arr);
			    }
			}
		}
	}
	elseif($k == 'positive' || $k == 'negative') {
		if(!empty($evidencepropertyyperel)){
			list($pos_intr_Array, $conf_notes_pos) = markers_search($evidencepropertyyperel, $property_1, $type, 'positive', $parameter);
			list($pos_inf_intr_Array, $conf_notes_pi) = markers_search($evidencepropertyyperel, $property_1, $type, 'positive inference', $parameter);
			list($neg_Array, $conf_notes_neg) = markers_search($evidencepropertyyperel, $property_1, $type, 'negative', $parameter);
			list($neg_inf_Array, $conf_notes_ni) = markers_search($evidencepropertyyperel, $property_1, $type, 'negative inference', $parameter);

			if (!empty($pos_intr_Array) && !empty($pos_inf_intr_Array))
				$pos_combined_array = array_merge($pos_intr_Array, $pos_inf_intr_Array);
			elseif (!empty($pos_intr_Array))
				$pos_combined_array = $pos_intr_Array;
			elseif (!empty($pos_inf_intr_Array))
				$pos_combined_array = $pos_inf_intr_Array;
			
			if (!empty($neg_Array) && !empty($neg_inf_Array))
				$neg_combined_array = array_merge($neg_Array, $neg_inf_Array);
			elseif (!empty($neg_Array))
				$neg_combined_array = $neg_Array;
			elseif (!empty($neg_inf_Array))
				$neg_combined_array = $neg_inf_Array; 
			
			if((!empty($pos_combined_array)) && (!empty($neg_combined_array))) {
				$mixed_type = array_intersect($pos_combined_array, $neg_combined_array);
			}
			if($k == 'positive' && !empty($pos_combined_array)) $marker_id = array_diff($pos_combined_array, $mixed_type);
			if($k == 'negative' && !empty($neg_combined_array)) $marker_id = array_diff($neg_combined_array, $mixed_type);			
		}
	}
	else {
		list($marker_id, $conf_notes_unknown) = markers_search($evidencepropertyyperel, $property_1, $type, $k, $parameter);
	}
	
	if(count($marker_id) > 0)
	{
?>

		<table  border="0" width='80%' border='0' cellspacing='2' cellpadding='0'>
			<tr>				
				<td align="center" width='20%' class='table_neuron_page1'><?php echo $predicateArr[$k] ?></td>
				<td align="left" width="60%" class='table_neuron_page1'>&nbsp;</td>
			</tr>
<?php
		foreach ($marker_id as $idToConsider) {
			$id = $idToConsider;
			
			if (strpos($id, '0_') == 1)
				$id = str_replace('10_', '',$id);
		 
			$type -> retrieve_by_id($id);
			$status = $type -> getStatus();
		
			if ($status == 'active') {
				if($k=='positive') {
					$pos_Array[$id] = $id;
					$pos_intr_Array[] = $id;
				}
				elseif($k=='negative') {
					$neg_Array[] = $id;			
				}
				
				$id_t = $id;
				$name_type = $type -> getNickname();
				$inhib_excit=$type->getExcit_Inhib();
				if ((!empty($conf_notes_pi) && array_key_exists($id_t, $conf_notes_pi)) ||
						(!empty($conf_notes_ni) && array_key_exists($id_t, $conf_notes_ni)))
					$name_type = $name_type . " (inference)";					
				
				//$subregion_type = $type -> getSubregion();
				$position_type = $type -> getPosition();
				$n_result_tot = $n_result_tot + 1;
				
				if($k=='mixed') {
					if ((!empty($conf_notes_subtypes) && array_key_exists($id_t, $conf_notes_subtypes)) ||
							(!empty($conf_notes_spse) && array_key_exists($id_t, $conf_notes_spse)) ||
							(!empty($conf_notes_unresolved) && array_key_exists($id_t, $conf_notes_unresolved))) {
						$evidencepropertyyperel -> retrive_unvetted($id,$objArr['positive']);
						$unvetted = $evidencepropertyyperel -> getUnvetted();
						$evidencepropertyyperel -> retrieve_conflict_note($objArr['positive'], $id);
						$conflict_note = $evidencepropertyyperel -> getConflict_note();
					}
					elseif ((!empty($conf_notes_pin) && array_key_exists($id_t, $conf_notes_pin)) ||							
							(!empty($conf_notes_pini) && array_key_exists($id_t, $conf_notes_pini))) {
						$evidencepropertyyperel -> retrive_unvetted($id,$objArr['positive_inference']);
						$unvetted = $evidencepropertyyperel -> getUnvetted();
						$evidencepropertyyperel -> retrieve_conflict_note($objArr['positive_inference'], $id);
						$conflict_note = $evidencepropertyyperel -> getConflict_note();
					}
					elseif (!empty($conf_notes_pni) && array_key_exists($id_t, $conf_notes_pni)) {
						$evidencepropertyyperel -> retrive_unvetted($id,$objArr['negative_inference']);
						$unvetted = $evidencepropertyyperel -> getUnvetted();
						$evidencepropertyyperel -> retrieve_conflict_note($objArr['negative_inference'], $id);
						$conflict_note = $evidencepropertyyperel -> getConflict_note();
					}
					if ($inhib_excit == 'e') {
					    $font_class = 'font10a';
					} else { 
						$font_class = 'font11';
					}
					$mixed_conflict = $conflict_note;
					
					if (!$mixed_conflict)
						$mixed_conflict = 'not yet determined';
				}
		
?>			<tr>
				<td align='right' width='20%' ></td>
				<td align='left' width='60%' class='table_neuron_page2'> 
					<a href='neuron_page.php?id=<?php echo $id_t ?>'>
						<?php if($inhib_excit == 'e'){?>
						<font class='font10a'>
						<?php } else {?>
						<font class='font11'>
						<?php } 
						echo $subregion_type." ".$name_type; if($k=='mixed')
						{ echo " (".$mixed_conflict.")"; } 
						?>
					</font>
				</a>
			</td>
			</tr>
<?php			}
		}
?>
		</table> 
<?php }
	  else {
?>
	  	<div><font class="font3"><?php echo "No ".$k." type found " ?></font></div><br/>
<?php }
	}?>
	</table>
	</div>
</body>
