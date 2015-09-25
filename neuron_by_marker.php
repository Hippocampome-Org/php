<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$parameter=$_GET['marker'];
//&prop;-act2 ; GABAa &prop
if($parameter=="alpha-actinin-2")
	$title = "&prop;-act2";
else if($parameter=="Gaba-a-alpha")
	$title= "GABAa &prop;1";
else
	$title = $parameter;

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
function markers_search($evidencepropertyyperel, $property_1, $type,$predicate,$parameter)
{
	
	$new_type_id_nan = array();
	$n_tot = 0;
	
	$new_type_id = NULL;
	$type_id = NULL;
	$property_1 -> retrive_ID(2, $parameter, NULL, $predicate); // Retrieve  property IDs for subject and respective predicates
	$n_property_id = $property_1 -> getNumber_type(); // Count the number of Property IDs for a given subject and predicate
	
	for ($i0=0; $i0<$n_property_id; $i0++) // For Each Property Id
	{
		$property_id = $property_1 -> getProperty_id($i0); // retrieve the  property Id
		// retrieve the Type_id from EvidencePropertyTypeRel by using property_id:
		$evidencepropertyyperel -> retrive_Type_id_by_Property_id($property_id); // retrieve the neuron types from evidencepropertytype rel
		$n_type_id = $evidencepropertyyperel -> getN_Type_id(); // Get a count of the number of neuron type Ids
		for ($i1=0; $i1<$n_type_id; $i1++) // For each Type Id
		{
			if ($predicate == 'positive' || $predicate =='negative')
				$type_id[$n_tot] = $evidencepropertyyperel -> getType_id_array($i1);	// Get the total type ids for positive
			else
			{
				$type_r = $evidencepropertyyperel -> getType_id_array($i1); // get the type Id for unknown
				$type_id[$n_tot] = "10_".$type_r; // Append 10_
			}					
		  $n_tot = $n_tot + 1;
		} // END $i1
	} // END $i0
		// Now, the program must remove the doubble or more type_id:	
		if ($type_id != NULL)
			$new_type_id=array_unique($type_id); // Get unique Type Ids
	
	return $new_type_id;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Neurons</title>
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
	<div class="table_position_search_page">
<?php 
$n_result_tot = 0;
$id_t = Array();
$pos_Array = Array();
$pos_intr_Array = Array();
$neg_Array = Array();
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
			$pos_intr_Array = markers_search($evidencepropertyyperel, $property_1, $type,'positive',$parameter);
			$neg_Array = markers_search($evidencepropertyyperel, $property_1, $type,'negative',$parameter);
			if(!empty($pos_intr_Array)) asort($pos_intr_Array);
			if(!empty($neg_Array)) asort($neg_Array);
			if((!empty($pos_intr_Array)) && (!empty($neg_Array))) {
				$marker_id = array_intersect($neg_Array,$pos_intr_Array);
			}
		}
	}
	elseif($k == 'positive' || $k == 'negative') {
		if(!empty($evidencepropertyyperel)){
			$pos_intr_Array = markers_search($evidencepropertyyperel, $property_1, $type,'positive',$parameter);
			$neg_Array = markers_search($evidencepropertyyperel, $property_1, $type,'negative',$parameter);
			if((!empty($pos_intr_Array)) && (!empty($neg_Array))) {
				$mixed_type = array_intersect($pos_intr_Array,$neg_Array);
			}
			if($k == 'positive' && !empty($pos_intr_Array)) $marker_id = array_diff($pos_intr_Array, $mixed_type);
			if($k == 'negative' && !empty($neg_Array)) $marker_id = array_diff($neg_Array, $mixed_type);
		}
	}
	else {
		$marker_id = markers_search($evidencepropertyyperel, $property_1, $type,$k,$parameter);
	}
	
	if(count($marker_id) > 0)
	{
?>
		<table border="0" cellspacing="3" cellpadding="0" class='table_result'>
			<tr>
				<td align="center" width="5%">&nbsp;</td>
				<td align="center" width="10%">&nbsp;</td>
				<td align="center" width='30%' class="table_neuron_page3"><?php echo $predicateArr[$k] ?></td>
				<td align="right" width="55%">&nbsp;</td>
			</tr>
<?php
	
		foreach ($marker_id as $idToConsider)
		{
			$id = $idToConsider;
			
			if (strpos($id, '0_') == 1)
				$id = str_replace('10_', '',$id);
		 
			$type -> retrieve_by_id($id);
			$status = $type -> getStatus();
		
			if ($status == 'active')
			{
				if($k=='positive')
				{
					$pos_Array[$id] = $id;
					$pos_intr_Array[] = $id;
				}
				else if($k=='negative')
				{
					$neg_Array[] = $id;			
				}
				
				$id_t = $id;
				$name_type = $type -> getNickname();
				//$subregion_type = $type -> getSubregion();
				$position_type = $type -> getPosition();
				$n_result_tot = $n_result_tot + 1;
				
				if($k=='mixed')
				{
					$evidencepropertyyperel -> retrive_unvetted($id,$objArr['positive']);
					$unvetted = $evidencepropertyyperel -> getUnvetted();
					$evidencepropertyyperel -> retrieve_conflict_note($objArr['positive'], $id);
					$conflict_note = $evidencepropertyyperel -> getConflict_note();
				
					if ($unvetted == 1)
						$font_col = 'font4_unvetted';
					else
						$font_col = 'font4';
					
					$mixed_conflict = $conflict_note;
					
					if (!$mixed_conflict)
						$mixed_conflict = 'not yet determined';
				}
		
?>			<tr>
				<td align='center' width='5%'>&nbsp;</td>
				<td align='center' width='10%' class='table_neuron_page4'><?php print $n_result_tot?></td>
				<td align='center' width='30%' class='table_neuron_page4'><a href='neuron_page.php?id=<?php echo $id_t ?>'><?php if($k!='mixed') {?><font class='font13'><?php } else {?><font class='<?php echo $font_col?>'><?php } echo $subregion_type." ".$name_type; if($k=='mixed'){ echo " (".$mixed_conflict.")"; } ?></font></a></td>
				<td align='right' width='55%'>&nbsp;</td>
			</tr>
<?php			}
		}
?>
		</table><br /> 
<?php }
	  else 
	  {
?>
	  	<div><font class="font3"><?php echo "No ".$k." Type found " ?></font></div><br/>
<?php }
	}?>
	</table>
	</div>
</body>