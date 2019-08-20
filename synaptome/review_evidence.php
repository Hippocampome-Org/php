<table class='main_table'>
<tr><th>eID</th><th><center>Review Evidence</center></th></tr>
<tr><td></td><td class="modalities_checkboxes" style="font-size: 18px;"><input type="checkbox" name="amp_check">Amplitude</input>&nbsp&nbsp<input type="checkbox" name="rise_check">Rise</input>&nbsp&nbsp<input type="checkbox" name="decay_check">Decay</input>&nbsp&nbsp<input type="checkbox" name="failure_check">Failure</input>&nbsp&nbsp<input type="checkbox" name="stp_check">STP</input>&nbsp&nbsp<input type="checkbox" name="ltp_check">LTP</input>&nbsp&nbsp<input type="checkbox" name="quantal_check">Quantal</input>&nbsp&nbsp<input type="checkbox" name="ec_check">Electrical Coupling</input>&nbsp<input type="button" name="amp_check" value="unfold all" style="position:absolute;right:7px;"></input></td></tr>
<?php
$eIDs = array();
$eIDs[0] = 1;
$eIDs[1] = 2;
$eIDs[2] = 3;
$tbl_name = 'evidence';
$col_id=0;
$unfolded = '';
$value_rows = array('ConRatios','CellRatios','Notes','GGRecAgo','ExtracellSol','IntracellSol','dSec','HoldPotentSSMP','ErevCalculated','ErevAuthors','Interpretation','Assumptions','Automation','Automation','Covariates','Morphology','Morphology','Markers','Markers','CellEphys','CellEphys','FiringPatterns','FiringPatterns','Connectivity','DataLocation','Data','Amplitude','Kinetics','ST_Plasticity','LT_Plasticity','MicroscopyCType','ePhysCType','Confidence','ActiveRange','PMID','eID');
$value_desc = array('Connectivity Ratios','Cell Type Ratios & Signals Motifs','Notes','GABA or Glutamate receptors (ant)agonists','Extracellular Solution','Intracellular Solution','Recorded Signal Type','Holding Potential or Steady State Membrane Potential (mV)','Calculated Reversal Potential (mV)','Experimental Reversal Potential (mV)','Interpretation','Mapping Assumptions','Presynaptic Search Query','Postsynaptic Search Query','Reference IDs','Presynaptic','Postsynaptic','Presynaptic','Postsynaptic','Presynaptic','Postsynaptic','Presynaptic','Postsynaptic','Reference IDs','Data Location','Reference IDs','Amplitude','Kinetics','Short-term Plasticity','Long-term Plasticity','Based on Microscopy Evidence Synapses are','Based on Electrophysiology Evidence Synapses are','Connections List','Active Range','Pubmed ID','Evidence ID');

function value_section($row,$description) {
	if ($row != '') {
		echo $description."<br>";
		echo $row."<br>";
	}
}

for ($i = 0; $i < sizeof($eIDs); $i++) {
	echo "<tr><td>".$eIDs[$i]."</td><td>";
	$sql = "SELECT * FROM ".$tbl_name." WHERE eID = ".$eIDs[$i];
	$result = $conn->query($sql); 
	if ($i == 0) {
		$unfolded = 'checked';
	}
	else {
		$unfolded = '';
	}
	if ($result->num_rows > 0) { 
		$row = $result->fetch_assoc();
		echo "<div class='wrap-collabsible collabsible'><input id='collapsible".$col_id."' class='toggle collabsible' type='checkbox' ".$unfolded."><label for='collapsible".$col_id."' class='lbl-toggle'>Experiment Description</label><div class='collapsible-content'><div class='content-inner'>";
		echo $row['Description']."<br>";
		$col_id++;
		echo "</div></div></input></div>";
		echo "<div class='wrap-collabsible collabsible'><input id='collapsible".$col_id."' class='toggle collabsible' type='checkbox' ".$unfolded."><label for='collapsible".$col_id."' class='lbl-toggle'>Extracted Values</label><div class='collapsible-content'><div class='content-inner'>";			
		for ($vi=0; $vi<sizeof($value_rows); $vi++) {
			value_section($row[$value_rows[$vi]],$value_desc[$vi]);
		}
	  	$col_id++;		
		echo "</div></div></input></div>";
	  while($row = $result->fetch_assoc()) { 
	  	
	  }
	}
	echo "</td></tr>";
}
?>
</table>