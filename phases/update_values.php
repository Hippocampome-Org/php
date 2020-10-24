<?php
	$species=array();
	$age=array();
	$sex=array();
	$method=array();
	$behavior=array();

	if (isset($_REQUEST['species_check1']) && $_REQUEST['species_check1']=="checked") {
		array_push($species, "rats");
	}
	if (isset($_REQUEST['species_check2']) && $_REQUEST['species_check2']=="checked") {
		array_push($species, "mice");
	}
	if (isset($_REQUEST['age_check1']) && $_REQUEST['age_check1']=="checked") {
		array_push($age, "adult");
	}
	if (isset($_REQUEST['age_check2']) && $_REQUEST['age_check2']=="checked") {
		array_push($age, "young adult");
	}
	if (isset($_REQUEST['age_check3']) && $_REQUEST['age_check3']=="checked") {
		array_push($age, "not reported");
	}
	if (isset($_REQUEST['sex_check1']) && $_REQUEST['sex_check1']=="checked") {
		array_push($sex, "male");
	}
	if (isset($_REQUEST['sex_check2']) && $_REQUEST['sex_check2']=="checked") {
		array_push($sex, "female");
	}
	if (isset($_REQUEST['sex_check3']) && $_REQUEST['sex_check3']=="checked") {
		array_push($sex, "unknown sex");
	}
	if (isset($_REQUEST['method_check1']) && $_REQUEST['method_check1']=="checked") {
		array_push($method, "sharp pipette");
	}
	if (isset($_REQUEST['method_check2']) && $_REQUEST['method_check2']=="checked") {
		array_push($method, "whole-cell patch clamp");
	}
	if (isset($_REQUEST['method_check3']) && $_REQUEST['method_check3']=="checked") {
		array_push($method, "juxtacellular");
	}
	if (isset($_REQUEST['method_check4']) && $_REQUEST['method_check4']=="checked") {
		array_push($method, "optotagging");
	}
	if (isset($_REQUEST['method_check5']) && $_REQUEST['method_check5']=="checked") {
		array_push($method, "silicon probe");
	}
	if (isset($_REQUEST['method_check6']) && $_REQUEST['method_check6']=="checked") {
		array_push($method, "tetrode");
	}
	if (isset($_REQUEST['behavior_check1']) && $_REQUEST['behavior_check1']=="checked") {
		array_push($behavior, "freely moving");
	}
	if (isset($_REQUEST['behavior_check2']) && $_REQUEST['behavior_check2']=="checked") {
		array_push($behavior, "head-fixed awake");
	}
	if (isset($_REQUEST['behavior_check3']) && $_REQUEST['behavior_check3']=="checked") {
		array_push($behavior, "REM sleep");
	}
	if (isset($_REQUEST['behavior_check4']) && $_REQUEST['behavior_check4']=="checked") {
		array_push($behavior, "urethane");
	}
	if (isset($_REQUEST['behavior_check5']) && $_REQUEST['behavior_check5']=="checked") {
		array_push($behavior, "urethane plus ketamine + xylazine");
	}
	if (isset($_REQUEST['behavior_check6']) && $_REQUEST['behavior_check6']=="checked") {
		array_push($behavior, "ketamine + xylazine");
	}
	if (isset($_REQUEST['behavior_check7']) && $_REQUEST['behavior_check7']=="checked") {
		array_push($behavior, "ketamine + xylazine plus acepromazine");
	}

	// combine conditions
	function report_condition($condition, $conditions, $cond_name) {
		$entry = "";

		for ($i = 0; $i < count($condition); $i++) {
			if (count($condition)==1) {
				$entry = $entry." AND $cond_name = \"".$condition[$i]."\"";
			}
			else if ($i==0) {
				$entry = " AND ($cond_name = \"".$condition[$i]."\"".$entry;
			}
			else if ($i==(count($condition)-1)) {
				$entry = $entry." OR $cond_name = \"".$condition[$i]."\")";
			}
			else {
				$entry = $entry." OR $cond_name = \"".$condition[$i]."\"";
			}
		}

		return $conditions.$entry;
	}

	$conditions = report_condition($species, $conditions, "species");
	$conditions = report_condition($age, $conditions, "age");
	$conditions = report_condition($sex, $conditions, "sex");
	$conditions = report_condition($method, $conditions, "method");
	$conditions = report_condition($behavior, $conditions, "behavior");

	//echo "<br><br><br><br><br><br><br>".$conditions;

?>