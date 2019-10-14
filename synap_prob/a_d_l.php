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
  $groups_text = "<table class='nbyk_cell1_a'><tr style='border:0px;'><td class='nbyk_cell1_b ".$first_cell_horiz."' style='border:0px;'><div class='".$first_cell_horiz."'>neuron type</div></td><td class='".$first_cell_vert." nbyk_cell1_c' style='border:0px;'><div class='".$first_cell_vert." nbyk_cell1_d'>parcel</div></td></tr></table>";  
  $parcel_group = array($groups_text, "DG:SMo:D", "DG:SMo:A", "DG:SMi:D", "DG:SMi:A", "DG:SG:D", "DG:SG:A", "DG:H:D", "DG:H:A", "DG:All:D", "DG:All:A", "CA3:SP:D", "CA3:SP:A", "CA3:SL:D", "CA3:SL:A", "CA3:SR:D", "CA3:SR:A", "CA3:SLM:D", "CA3:SLM:A", "CA3:SO:D", "CA3:SO:A", "CA3:All:D", "CA3:All:A", "CA2:All:D", "CA2:All:A", "CA2:SO:D", "CA2:SO:A", "CA2:SP:D", "CA2:SP:A", "CA2:SR:D", "CA2:SR:A", "CA2:SLM:D", "CA2:SLM:A", "CA1:SLM:D", "CA1:SLM:A", "CA1:SR:D", "CA1:SR:A", "CA1:SP:D", "CA1:SP:A", "CA1:SO:D", "CA1:SO:A", "CA1:All:D", "CA1:All:A", "Sub:SM:D", "Sub:SM:A", "Sub:SP:D", "Sub:SP:A", "Sub:PL:D", "Sub:PL:A", "Sub:All:D", "Sub:All:A", "EC:I:D", "EC:I:A", "EC:II:D", "EC:II:A", "EC:III:D", "EC:III:A", "EC:IV:D", "EC:IV:A", "EC:V:D", "EC:V:A", "EC:VI:D", "EC:VI:A", "EC:All:D", "EC:All:A");

  // Collect parcel names
  /*$sql = "SELECT DISTINCT neurite FROM neurite_quantified;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { 
    array_push($parcel_group, $groups_text);
    while($row = $result->fetch_assoc()) { 
      $parcel_section=$row['neurite'];
      if ($parcel_section != '') {
        array_push($parcel_group, $parcel_section);
      }
    }
  }*/
  // Collect neuron types
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

  // generate matrix
  echo "<table class='main_table'>";  
  for ($i=0;$i<count($neuron_group);$i++) {
  //for ($i=0;$i<30;$i++) {
    for ($j=0;$j<count($parcel_group);$j++) {
      if ($i==0) {
        if ($j==0) {
          echo "<tr class='main_table_header'><td style='border-bottom:0px'>";
        }
        else {
          echo "<td style='border-left:2px white;border-right:2px white;padding:5px;'";
          if ($j > 0 && $j < 11) {
            echo " class='dg_area'><font style='font-size:14px;color:white;'>";
          }
          else if ($j < 23) {
            echo " class='ca3_area'><font style='font-size:14px;color:white;'>";
          }
          else if ($j < 33) {
            echo " class='ca2_area'><font style='font-size:14px;color:#000993;'>";
          }
          else if ($j < 43) {
            echo " class='ca1_area'><font style='font-size:14px;color:#000993;'>";
          }
          else if ($j < 51) {
            echo " class='sub_area'><font style='font-size:14px;color:#000993;'>";
          }
          else if ($j < 65) {
            echo " class='ec_area'><font style='font-size:14px;color:white;'>";
          }       
        }

        echo "<center>";

        switch($j){
          case 6;
          echo "DG";
          break;
          case 16;
          echo "CA3";
          break;
          case 28;
          echo "CA2";
          break;
          case 38;
          echo "CA1";
          break;
          case 47;
          echo "SUB";
          break;
          case 57;
          echo "EC";
          break;                                                  
        }

        echo "</center></font>";

        if ($j==65) {
          //echo "<td></tr></table></td>";
          echo "</td>";
        }
        else {
          echo "</td>";
        } 
      }
      else if ($i==1) {
        if ($j==0) {
          echo "<tr class='main_table_header'>";
          echo "<td style='border-top:0px'>".$parcel_group[$j]."</td>";
        }
        else {
          echo "<td class='".$css_vertical." verticle_n_by_k main_matrix_text' ";
          if ($j == 10 || $j == 22 || $j == 32 || $j == 42 || $j == 50 || $j == 65) {
            echo " style='border-right:4px solid #810004;'";
          }
          echo "><div class='".$css_vertical." verticle_n_by_k main_matrix_text'>".$parcel_group[$j]."</div></td>";
          /*echo "</tr></table></td>";*/
        }
      }
      else {
        if ($j==0) {
          echo "<tr id='main_table_row_".$i."'>";
          echo "<td class='main_matrix_text row_first_cell' id='first_cell_".$i."'>".$neuron_group[$i]."</td>";
        }
        else {
          echo "<td class='main_matrix_text main_table_cell' onClick=\"changerowcolor(".$i.")\" onmouseover=\"changebordercolor(".$i.")\"";
          if ($j == 10 || $j == 22 || $j == 32 || $j == 42 || $j == 50) {
            echo " style='border-right:4px solid #810004;'";
          }
          echo ">";
          $sql = "SELECT CAST(STD(total_length) AS DECIMAL(10,2)) AS std_tl, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i]."' AND neurite_quantified.neurite='".$parcel_group[$j]."';";
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
    }    
    echo "</tr>";
  }
  echo "</table>";

?>
