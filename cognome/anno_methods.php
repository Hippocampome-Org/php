<?php include ("permission_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Hippocampus Region Models and Theories</title>
  <link rel="stylesheet" type="text/css" href="main.css">
  <?php include('set_theme.php'); ?>
  <?php include('function/hc_header.php'); ?>
  <script type="text/javascript">
    function toggle_vis(elem_name) {
     var elem = document.getElementById(elem_name);
     if (elem.style.display === "none") {
      elem.style.display = "block";
    } else {
      elem.style.display = "none";
    }
  }
  </script>
</head>
<body>
  <?php include("function/hc_body.php"); ?>   
  <br>
  <br>
    <!-- start of header -->
    <?php echo file_get_contents('header.html'); ?>
    <div style="width:90%;position:relative;left:5%;"> 
    <script type='text/javascript'>
      document.getElementById('header_title').innerHTML="<a href='anno_methods.php' style='text-decoration: none;color:black !important'><span class='title_section'>Annotation Methods</span></a>";
      document.getElementById('fix_title').style='width:90%;position:relative;left:5%;';
    </script>
    <!-- end of header -->

<?php

function sec_start($sec_desc, $sec_name, $check) {
	$sec_start = "<div class='wrap-collabsible' id='art_select'><input id='collapsible_$sec_name' class='toggle' type='checkbox' ";
	if ($check == "checked") {
		$sec_start = $sec_start."checked";
	}
	$sec_start = $sec_start."><label for='collapsible_$sec_name' class='lbl-toggle'>$sec_desc</label><div class='collapsible-content'><div class='content-inner' style='font-size:22px;'><p><table border=1>";

	return $sec_start;
}
$sec_end = "</table></p></div><a style='font-size:10px'><hr></a></div></div><br>";

if (isset($_REQUEST['disp']) && $_REQUEST['disp']=="subject") {
echo sec_start("Subject Dimension:", "subj_dim", "checked");
echo "
Subjects annotated must be connected to an acceptable simulation that includes hippocampal-activity. Specifically, articles that include multiple simulations with some that don't include hippocampal content will have the non-hippocampal associated simulations not annotated with subjects they include.
<br><br>
The subjects annotated are what are interpreted as the focus of the article. Some subjects can be mentioned in a short amount of writing in the article but if they are not a focus of the experimentation in the article then they are not annotated. One type of evidence that applies toward the choice of annotating a subject is text that supports a recognition of the subject as being a purpose of investigation in the simulation experiment. Another source of evidence is clear and explicit descriptions of the subject being included in the experimental design. A balance between evidence representing that the subject was a study purpose and explicit description(s) that were made of the subject being included in the simulation should be used to justify an annotation.
<br><br>
Subjects that were not described as a focus of the study and/or are not explicitly described to a reasonable level as being included in the experimental design are not included as subject annotations. This will exclude subject annotations with weak or circumstantial evidence as being included, and this is intentional. The objective of the annotation method is to be based on clear evidence with
minimal ambiguity.
<br><br>
Requirement: The subject can include a cognitive/behavioral function or other neural activity.
";
echo $sec_end;

include("anno_methods_subj.php");
}

if (isset($_REQUEST['disp']) && $_REQUEST['disp']=="detail") {
echo sec_start("Level of Detail Dimension:", "det_dim", "checked");
echo "
The detail level dimension provides the type of simulation model used in the work. The level of biological abstractness of the model can be inferred from its core equations, without extensions to its complexity. The model included in the work at the lowest level is annotated as this property's value.
<br><br>
Requirement: individual spike times modeled. More specifically, the computational work must simulate the occurrence of spikes with the time of each spike captured on an individual spike basis.
<br><br>
The precision of timing should be at time steps of 2ms or less. The times step does not need to be explicitly stated in an article for it to be accepted, it can be assumed to be 1ms, but if it is stated than this rule applies.
";
echo $sec_end;
}

if (isset($_REQUEST['disp']) && $_REQUEST['disp']=="scale") {
echo sec_start("Simulation Scale Dimension:", "scl_dim", "checked");
echo "
Requirement: At least 10 neurons. The neurons must be spiking. Of these minimum number of neurons, each spike time must be recorded and not only an average reported of multiple spikes. The neurons must have at least some connections, and must be more than no connections. 
<br><br>
Only neurons that are fully modeled, e.g., no signal generators, etc., are counted in the scale of the network. Neurons that are outside of the hippocampus region but in the hippocampus-included simulation are counted. Any neurons in a simulation where the simulation does not include the hippocampus are excluded from the count. The total neurons in individual simulations are counted, not the sum count of neuron across multiple simulations. For example, two simulations with 400 neurons each would be annotated as a scale of 400 neurons total, not 800 neurons. A minimum acceptable number of neurons needs to be explicitly described in the article. Network scales are not assumed or guessed.
<br><br>
The circuit/network simulated must be based in biology. An artificial neural network does not count toward the presence of a circuit/network simulation. An original simulation must be performed, not only described as methods. In other words, not only do computational methods need to be described, but a simulation must have been performed with them.
<br><br>
Q: Is there a minimum spiking amount needed for each neuron?
<br>
A: A requirement is that the simulation in general needs to produce some spiking. However, if a neuron has a neuron model is capable of spiking, but it didn't spike in a simulation, it still counts as a neuron with an acceptable neuron model. For example, if a certain neuron only receives inhibitory input for the purposes of the simulation, and that causes no spiking, as long as other neurons in the simulation perform spiking, that neuron that didn't spike still counts as an acceptable neuron because its neuron model would model spiking if relevant input was provided by that.
";
echo $sec_end;
}

if (isset($_REQUEST['disp']) && $_REQUEST['disp']=="impl") {
echo sec_start("Level of Implementation Dimension:", "impl_dim", "checked");
echo "
<u>Fully implemented:</u> the research reports having constructed and successfully run a simulation with the model
<br><u>Partially implemented:</u> some approaches, techniques, or formulas are described that can be used in a future model. A model has not been reported to have been run in a simulation.
<br><u>Not implemented:</u> No specific approaches, techniques, or formulas are described for use in a model. A model has not been reported to have been run in a simulation. A general type or category of model has been included in the article’s writing.
<br>
<br><u>All methods available:</u> all information needed to recreate the model is available directly through descriptions included in the article.
<br><u>Some methods available:</u> some methods are included in the articles writing but key elements are missing that are needed for reproduction. Those elements are one of the following: formulas used to represent neurons, biophysical parameters to represent the region under study, formulas used to generate network-level activity of neurons.
<br><u>Not implemented:</u> a significant lack of methods are explicitly described in the literature which would be used to recreate the model described.
";
echo $sec_end;
}

if (isset($_REQUEST['disp']) && $_REQUEST['disp']=="region") {
echo sec_start("Anatomical Region Dimension:", "reg_dim", "checked");
echo "
The region dimension is an annotation of which anatomical brain regions or subregions were included in simulation(s) in the article's research. Regions that were described but not simulated are not included in this annotation.
<br><br>
If an article states the simulation is possibly relevant to more than one subregion (e.g., could potentially apply to CA1 or CA3) than both subregions are annotated.
<br><br>
It is acceptable to include signal generators or other non-fully modeled neurons as evidence of region modeling, as long as specific text in the article describes that the region was included in the simulation. For example, if input from the perforant path was modeled as entorhinal cortex (EC) signals created through a signal generator that didn't fully model neurons and no other EC neurons were included, than it is acceptable to annotate EC as a part of the simulation.
<br><br>
Requirement: no minimum number of neurons is needed in each region.
";
echo $sec_end;
}

if (isset($_REQUEST['disp']) && $_REQUEST['disp']=="theories") {
echo sec_start("Theories Dimension:", "thy_dim", "checked");
echo "
The theory category dimension describes which theories were found to be included in the literature.
<br><br>
Requirement: no requirement.
";
echo $sec_end;
}

	?>
</body>
</html>