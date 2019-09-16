<?php
  // Collect dimension names
  $dim_tbl=array(
    1=>"details",
    2=>"implementations",
    3=>"theory_category",
    4=>"keywords");
  $dim_col=array(
    1=>"detail_level",
    2=>"level",
    3=>"category",
    4=>"keyword");
  $dim_desc=array(
    1=>"The detail level dimension provides the type of simulation model used in the work. The level of biological abstractness of the model can be infered from its
    core equations, without extensions to its complexity. The model included in the work at the lowest level is annotated as this property's value.",
    2=>"The level of implementation dimension describes the completeness of the implementation of the model in the literature. This explains what level of implementation the simulation model is currently at in the literature.<a href='inclusion_criteria.php' style='text-decoration: none;'><img src='info.gif' title='inclusion critera description' style='height:20px;width:20px;float:right;position:relative;'></a>",
    3=>"The theory category dimension describes which theories were found to be included in the literature. The term 'category' is used to explicitly differentiate this property from the theory 'competition' property.",
    4=>"The keyword dimension is used for annotating keywords that are useful to track for various research areas.");  
  for($i=1;$i<(sizeof($dim_tbl)+1);$i++) {
    echo "<tr><th><u>Dimension: ".$dim_tbl[$i]."</u></th><th><u>Type: ".$dim_col[$i]."</u></th>";
    echo "<tr><td>Dimension Explanation:</td><td>".$dim_desc[$i]."</td></tr>";
    echo "<tr><td><center><u>ID</u></center></td><td><center><u>Description</u></center></td></tr>";
    $sql = "SELECT ".$dim_col[$i]." FROM ".$dim_tbl[$i];
    $result = $conn->query($sql);
    $j=1;
    if ($result->num_rows > 0) {       
      while($row = $result->fetch_assoc()) { 
        $dim_name[$i][$j]=$row[$dim_col[$i]];
        echo "<tr><td style='min-width:13em;'><center>".$j."</center></td><td style='min-width:10em;'>".$row[$dim_col[$i]]."</td></tr>";
        $j++;
      }
    } 
  }
?>