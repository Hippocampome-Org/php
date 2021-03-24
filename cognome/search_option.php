<?php
  function search_option($conn, $sql, $prop_name, $row_name, $tbl_name, $all_switch) {
    echo "<span style='display: inline-block;'>&nbsp;".$prop_name.":
    <select name='".$row_name."' size='1' class='select-css'>";
    $sql = "SELECT ".$row_name." FROM ".$tbl_name;
    $result = $conn->query($sql); 
    $d_i=0;
    $selection_received=$_POST[$row_name];  
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        $d_i=$d_i+1;
        $selection='';
        if ($selection_received == $d_i) {
          $selection=" selected='selected'";
        }      
        echo "<option value=".$d_i." ".$selection.">".$row[$row_name]."</option>";
      }
      $all_value = $d_i+1;
      if ($all_switch == 'all_on' & ($selection_received == $all_value | $selection_received == '')) {
        echo "<option value=".$all_value."  selected='selected'>all</option>";  
      }    
    }  
    else { echo "0 results"; }   
    echo "</select></span></span>";
  }
?>