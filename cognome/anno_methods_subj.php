<?php

echo "<center><font style='font-size:24px'><u>Subject Entities</u></font></center><span style='font-size:16px;'><br></span>";
echo sec_start("Spatial memory", "spm_dim", "unchecked");
echo "
This subject is annotated when spatial cognition in the form of memory or nagivation is described as a part of an article's simulation methods.
";
echo $sec_end;

echo sec_start("Episodic memory", "epi_dim", "unchecked");
echo "
An annotation is made of this subject when the article specifically states that episodic memory was studied. The presence of spatial memory as a subject does not automatically apply as evidence toward the inclusion of this subject. The article needs to specifically make a point of stating that episodic
memory was a focus of the study for this subject to be annotated. Simply having a sequence of events occur and having the model learn from that is not sufficient evidence of this subject. One reason for that is to help avoid spatial memory annotations automatically causing episodic memory annotations, given that a large amount of spatial memory experimentation can involve remembering sequences. This annotation approach helps make the subjects distinct from each other.
";
echo $sec_end;

echo sec_start("Long-term memory or consolidation", "ltm_dim", "unchecked");
echo "
This subject is annotated when specific descriptions of studying long term memory (LTM) are included in the simulation. Long term potentiation (LTP) or long term depression (LTD) does not automatically represent evidence of LTM. Consolidation is present in an article's study when it is explicitly
described as a part of the experimental methods. Simply transferring a memory between brain subregions does not necessarily represent evidence of consolidation.
";
echo $sec_end;

echo sec_start("Time cells or timekeeping", "tim_dim", "unchecked");
echo "
This subject describes a study of time cells or a specific emphasis on the brain's cognition of time. This subject investigates the mental understanding and recognition of the passage of time in one's life. It is not simply setting time periods on neural activities in an experiment. It instead is the cognitive processes that captures the occurrence of time that a subject perceives.
";
echo $sec_end;

?>