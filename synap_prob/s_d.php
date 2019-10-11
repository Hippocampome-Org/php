<!--
  reference: https://www.tek-tips.com/viewthread.cfm?qid=983313
-->
<?php
  include('synap_prob/change_colors.php');
  include('synap_prob/browser_check.php');
  $getBrowser = getBrowser();
  $css_vertical = $getBrowser['css_vertical'];
  $first_cell_vert = $getBrowser['first_cell_vert'];
  $first_cell_horiz = $getBrowser['first_cell_horiz'];  
  $parcel_group = array();
  $groups_text = "<table class='nbyk_cell1_a'><tr style='border:0px;'><td class='nbyk_cell1_b ".$first_cell_horiz."' style='border:0px;'><div class='".$first_cell_horiz."'>neuron type</div></td><td class='".$first_cell_vert." nbyk_cell1_c' style='border:0px;'><div class='".$first_cell_vert." nbyk_cell1_d'>parcel</div></td></table>";
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
          echo "<td class='".$css_vertical." verticle_n_by_k main_matrix_text'><div class='".$css_vertical." verticle_n_by_k main_matrix_text'>".$parcel_group[$j]."</div></td>";
        }
      }
      else if ($j==0) {
        echo "<td class='main_matrix_text row_first_cell' id='first_cell_".$i."'>".$neuron_group[$i]."</td>";
      }
      else {
        echo "<td class='main_matrix_text main_table_cell' onClick=\"changerowcolor(".$i.")\" onmouseover=\"changebordercolor(".$i.")\">";
        $sql = "SELECT CAST(STD(mean_path_length) AS DECIMAL(10,2)) AS std_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(MIN(mean_path_length) AS DECIMAL(10,2)) AS min_sd, CAST(MAX(mean_path_length) AS DECIMAL(10,2)) AS max_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i]."' AND neurite_quantified.neurite='".$parcel_group[$j]."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) {
            $avg_trunk = $row['avg_trunk'];
            if ($avg_trunk != '' && $avg_trunk != 0) {
              echo "<a href='#' title='Mean: ".$row['avg']."\nCount of Recorded Values: ".$row['count_sd']."\nStandard Deviation: ".$row['std_sd']."\nMinimum Value: ".$row['min_sd']."\nMaximum Value: ".$row['max_sd']."'>".$avg_trunk."</a>";
            }
            else {
              /*echo 'N/A';*/
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
