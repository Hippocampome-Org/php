<!--
  reference: https://www.tek-tips.com/viewthread.cfm?qid=983313
-->
<?php
  include('synap_prob/change_colors.php');
  $parcel_group = array();
  $groups_text = "<table class='nbyk_cell1_a'><tr style='border:0px;'><td class='nbyk_cell1_b' style='border:0px;'>neuron type</td><td class='vertical nbyk_cell1_c' style='border:0px;'><div class='vertical nbyk_cell1_d'>parcel</div></td></table>";
  $sql = "SELECT DISTINCT neurite FROM neurite_quantified;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { 
    array_push($parcel_group, $groups_text);
    while($row = $result->fetch_assoc()) { 
      $parcel_section=$row['neurite'];
      if ($parcel_section != '') {
        array_push($parcel_group, $parcel_section);
      }
    }
  }
  $neuron_group = array();
  $sql = "SELECT DISTINCT hippocampome_neuronal_class FROM neurite_quantified;";
  $result = $conn->query($sql);
  $i=0;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
      $neuron_type = $row['hippocampome_neuronal_class'];
      if ($neuron_type != '') {
        array_push($neuron_group, $neuron_type);
      }
    }
  }
  echo "<table class='main_table'>";  
  for ($i=0;$i<count($neuron_group);$i++) {
    if ($i==0) {
            echo "<tr class='main_table_header' id='main_table_header'>";  
            }  
    else {
      echo "<tr id='main_table_row_".$i."'>";
    }
    for ($j=0;$j<count($parcel_group);$j++) {
      if ($i==0) {
        if ($j==0) {
          echo "<td>".$parcel_group[$j]."</td>";
        }
        else {
          echo "<td class='vertical verticle_n_by_k main_matrix_text'><div class='vertical verticle_n_by_k main_matrix_text'>".$parcel_group[$j]."</div></td>";
        }
      }
      else if ($j==0) {
        echo "<td class='main_matrix_text row_first_cell' id='first_cell_".$i."'>".$neuron_group[$i]."</td>";
      }
      else {
        echo "<td class='main_matrix_text main_table_cell' onClick=\"changerowcolor(".$i.")\" onmouseover=\"changebordercolor(".$i.")\">";
        $sql = "SELECT STD(total_length) AS std_tl, AVG(total_length) AS avg, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg_trunk, COUNT(total_length) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i]."' AND neurite_quantified.neurite='".$parcel_group[$j]."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) {
            $avg_trunk = $row['avg_trunk'];
            if ($avg_trunk != '' && $avg_trunk != 0) {
              echo "<a href='#' title='Mean: ".$row['avg']."\nCount of Recorded Values: ".$row['count_tl']."\nStandard Deviation: ".$row['std_tl']."'>".$avg_trunk."</a>";
            }
            else {
              /*echo 'N/A';*/
            }
          }
          /*if ($collected_vals != null && count($collected_vals)>0) {
            echo array_sum($collected_vals)/count($collected_vals);
          }*/
        }
        echo "</td>";
      }
    }    
    echo "</tr>";
  }
  echo "</table>";

?>
