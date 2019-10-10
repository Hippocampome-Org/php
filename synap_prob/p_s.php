<!--
  reference: https://www.tek-tips.com/viewthread.cfm?qid=983313
-->
<?php
  include('synap_prob/change_colors.php');
  $post_neuron_group = array();
  $pre_post_text = "<table class='nbym_cell1_a'><tr style='border:0px;'><td class='nbym_cell1_b' style='border:0px;'>presynaptic neuron</td><td class='vertical nbym_cell1_c' style='border:0px;'><div class='vertical nbym_cell1_d'>postsynaptic neuron</div></td></table>";
  $sql = "SELECT DISTINCT target_name FROM hippocampome.potential_synapses;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { 
    array_push($post_neuron_group, $pre_post_text);
    while($row = $result->fetch_assoc()) { 
      $postneuron=$row['target_name'];
      if ($postneuron != '') {
        array_push($post_neuron_group, $postneuron);
      }
    }
  }
  $pre_neuron_group = array();
  $sql = "SELECT DISTINCT source_name FROM hippocampome.potential_synapses;";
  $result = $conn->query($sql);
  $i=0;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
      $preneuron = $row['source_name'];
      if ($preneuron != '') {
        array_push($pre_neuron_group, $preneuron);
      }
    }
  }
  echo "<table class='main_table'>";  
  for ($i=0;$i<count($pre_neuron_group);$i++) {
    if ($i==0) {
            echo "<tr class='main_table_header' id='main_table_header'>";  
            }  
    else {
      echo "<tr id='main_table_row_".$i."'>";
    }
    for ($j=0;$j<count($post_neuron_group);$j++) {
      if ($i==0) {
        if ($j==0) {
          echo "<td>".$post_neuron_group[$j]."</td>";
        }
        else {
          echo "<td class='vertical verticle_n_by_n main_matrix_text'><div class='vertical verticle_n_by_n main_matrix_text'>".$post_neuron_group[$j]."</div></td>";
        }
      }
      else if ($j==0) {
        echo "<td class='main_matrix_text' id='first_cell_".$i."'>".$pre_neuron_group[$i]."</td>";
      }
      else {
        echo "<td class='main_matrix_text main_table_cell' onClick=\"changerowcolor(".$i.")\" onmouseover=\"changebordercolor(".$i.")\">";
        $sql = "SELECT CAST(AVG(potential_synapses) AS DECIMAL(5,5)) AS p_s_avg FROM hippocampome.potential_synapses WHERE potential_synapses.source_name='".$pre_neuron_group[$i]."' AND potential_synapses.target_name='".$post_neuron_group[$j]."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) {
            $p_s_avg = $row['p_s_avg'];
            if ($p_s_avg != '' && $p_s_avg != 0) {
            echo $p_s_avg;            
            }
            else {
              echo 'N/A';
            }
          }
        }        
        echo "</td>";
      }
    }    
    echo "</tr>";
  }
  echo "</table>";

?>
