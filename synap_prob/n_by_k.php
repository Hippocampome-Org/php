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
  $vert_parcel_group = array("DG", "CA3", "CA2", "CA1", "Sub", "EC");

  // Collect neuron types and sort them
  $neuron_group = array();
  $neuron_type_unsorted = array();
  $neuron_parcel_unsorted = array();
  $neuron_parcel_counts = array();
  $sql = "SELECT DISTINCT hippocampome_neuronal_class, subregion FROM neurite_quantified;";
  $result = $conn->query($sql);
  $nt_tot = 0;
  $nt_tot_old = 0;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
      $neuron_type = $row['hippocampome_neuronal_class'];
      if ($neuron_type != '') {
        array_push($neuron_type_unsorted, $neuron_type);
        array_push($neuron_parcel_unsorted, $row['subregion']);
      }
    }
  }
  $number_of_parcels = sizeof($vert_parcel_group);
  $neuron_group = array_fill(0, sizeof($neuron_type_unsorted), 0);
  for ($v_i = 0; $v_i < $number_of_parcels; $v_i++) {  
    for ($ng_i = 0; $ng_i < sizeof($neuron_type_unsorted); $ng_i++) {
      if ($neuron_parcel_unsorted[$ng_i] == $vert_parcel_group[$v_i]) {
        //array_push($neuron_group, $neuron_type_unsorted[$ng_i]);
        $neuron_group[$nt_tot] = $neuron_type_unsorted[$ng_i];
        //echo $neuron_type_unsorted[$ng_i]."<br>";
        $nt_tot++;
      }
    }
    if (sizeof($neuron_parcel_counts)==0) {
      array_push($neuron_parcel_counts, $nt_tot);
      $nt_tot_old = $nt_tot;
    }
    else {
      array_push($neuron_parcel_counts, ($nt_tot-$nt_tot_old));
      $nt_tot_old = $nt_tot;
    }
  }

  // generate matrix
  echo "<table class='main_table'>";  
  /*$i = 0;*/
  for ($i=0;$i<count($neuron_group)+2;$i++) {
  //for ($i=0;$i<30;$i++) {
    for ($j=0;$j<count($parcel_group)+1;$j++) {
      $i_adj = $i-2;
      $j_adj = $j-1;
      if ($i==0) {
        if ($j==0) {
          echo "<tr class='main_table_header'><td style='border-bottom:0px !important'>";
        }
        else if ($j==1) {
          echo "<td style='border-bottom:0px'>";
        }
        else {
          echo "<td style='border-left:2px white;border-right:2px white;padding:5px;'";
          if ($j_adj > 0 && $j_adj < 11) {
            echo " class='dg_area'><font style='font-size:14px;color:white;'>";
          }
          else if ($j_adj < 23) {
            echo " class='ca3_area'><font style='font-size:14px;color:white;'>";
          }
          else if ($j_adj < 33) {
            echo " class='ca2_area'><font style='font-size:14px;color:#000993;'>";
          }
          else if ($j_adj < 43) {
            echo " class='ca1_area'><font style='font-size:14px;color:#000993;'>";
          }
          else if ($j_adj < 51) {
            echo " class='sub_area'><font style='font-size:14px;color:#000993;'>";
          }
          else if ($j_adj < 65) {
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
          echo "<td style='border-top:0px !important'></td>";
        }        
        else if ($j==1) {
          echo "<td style='border-top:0px'>".$parcel_group[$j_adj]."</td>";
        }
        else {
          echo "<td class='".$css_vertical." verticle_n_by_k main_matrix_text' ";
          if ($j_adj == 10 || $j_adj == 22 || $j_adj == 32 || $j_adj == 42 || $j_adj == 50 || $j_adj == 65) {
            echo " style='border-right:4px solid #810004;'";
          }
          echo "><div class='".$css_vertical." verticle_n_by_k main_matrix_text'>".$parcel_group[$j_adj]."</div></td>";
          /*echo "</tr></table></td>";*/
        }
      }
      else {
        if ($j==0) {
          echo "<tr id='main_table_row_".$i_adj."'";
          if ($i_adj == 18 || $i_adj == 40 || $i_adj == 45 || $i_adj == 85 || $i_adj == 88) {
            echo " class='red_border'";
          }
          echo "><td class='main_matrix_text main_table_cell";
          echo " no_t_b_border";
          echo "' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\"";
          //if ($i_adj != 18 || $i_adj != 40 || $i_adj != 45 || $i_adj != 85 || $i_adj != 88) {
          //  echo " class='no_t_b_border'";
          //}
          echo ">";          
          switch($i_adj){
            case 0;
            echo "<font class='dg_area2'>";
            echo "DG(".$neuron_parcel_counts[0].")";
            echo "</font>";
            break;
            case 18;
            echo "<font class='ca3_area2'>";
            echo "CA3(".$neuron_parcel_counts[1].")";
            echo "</font>";
            break;
            case 40;
            echo "<font class='ca2_area2'>";
            echo "CA2(".$neuron_parcel_counts[2].")";
            echo "</font>";
            break;
            case 45;
            echo "<font class='ca1_area2'>";
            echo "CA1(".$neuron_parcel_counts[3].")";
            echo "</font>";
            break;
            case 85;
            echo "<font class='sub_area2'>";
            echo "SUB(".$neuron_parcel_counts[4].")";
            echo "</font>";
            break;
            case 88;
            echo "<font class='ec_area2'>";
            echo "EC(".$neuron_parcel_counts[5].")";
            echo "</font>";
            break;                   
          }
          echo "</td>";
        }        
        else if ($j==1) {
          echo "<td class='main_matrix_text row_first_cell' id='first_cell_".$i_adj."' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\">".$neuron_group[$i_adj]."</td>";
        }
        else {
          echo "<td class='main_matrix_text main_table_cell' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\"";
          if ($j_adj == 10 || $j_adj == 22 || $j_adj == 32 || $j_adj == 42 || $j_adj == 50) {
            echo " style='border-right:4px solid #810004;'";
          }
          echo ">";

          // detect appropriate matrix data to populate
          if (isset($_GET['tab']) && $_GET['tab'] == 's_d') {
            $sql = "SELECT CAST(STD(mean_path_length) AS DECIMAL(10,2)) AS std_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(MIN(mean_path_length) AS DECIMAL(10,2)) AS min_sd, CAST(MAX(mean_path_length) AS DECIMAL(10,2)) AS max_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj]."';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
              while($row = $result->fetch_assoc()) {
                $avg_trunk = $row['avg_trunk'];
                if ($avg_trunk != '' && $avg_trunk != 0) {
                  echo "<a href='#' title='Mean: ".$row['avg']."\nCount of Recorded Values: ".$row['count_sd']."\nStandard Deviation: ".$row['std_sd']."\nMinimum Value: ".$row['min_sd']."\nMaximum Value: ".$row['max_sd']."'>".$avg_trunk."</a>";
                }
              }
            }
          }
          else {
            $sql = "SELECT CAST(STD(total_length) AS DECIMAL(10,2)) AS std_tl, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj]."';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
              while($row = $result->fetch_assoc()) {
                $avg_trunk = $row['avg_trunk'];
                if ($avg_trunk != '' && $avg_trunk != 0) {
                  echo "<a href='#' title='Mean: ".$row['avg']."\nCount of Recorded Values: ".$row['count_tl']."\nStandard Deviation: ".$row['std_tl']."'>".$avg_trunk."</a>";
                }
              }
            }
          }
          
          echo "</td>";
        }
      }
    }    
    echo "</tr>";
  }
  echo "</table>";

?>
