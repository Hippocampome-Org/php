<?php
  // Collect dimension names
  $dim_tbl=array(
    1=>"details",
    2=>"implementations",
    3=>"theory_category",
    4=>"keywords",
    5=>"regions",
    6=>"network_scales");
  $dim_col=array(
    1=>"detail_level",
    2=>"level",
    3=>"category",
    4=>"keyword",
    5=>"region",
    6=>"scale");
  for($i=1;$i<(sizeof($dim_tbl)+1);$i++) {
    $sql = "SELECT ".$dim_col[$i]." FROM ".$dim_tbl[$i];
    $result = $conn->query($sql);
    $j=1;
    if ($result->num_rows > 0) {       
      while($row = $result->fetch_assoc()) { 
        $dim_name[$i][$j]=$row[$dim_col[$i]];
        $j++;
      }
    } 
  }
?>