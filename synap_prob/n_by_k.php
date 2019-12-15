<!--
  reference: https://www.tek-tips.com/viewthread.cfm?qid=983313
-->
<?php
  include('synap_prob/change_colors.php');
  include('synap_prob/browser_check.php');
  include('e_i_check.php');
  $getBrowser = getBrowser();
  $css_vertical = $getBrowser['css_vertical'];
  $first_cell_vert = $getBrowser['first_cell_vert'];
  $first_cell_horiz = $getBrowser['first_cell_horiz'];
  /* $groups_text = "<table class='nbyk_cell1_a'><tr style='border:0px;'><td class='nbyk_cell1_b ".$first_cell_horiz."' style='border:0px;'><div class='".$first_cell_horiz."'>neuron type</div></td><td class='".$first_cell_vert." nbyk_cell1_c' style='border:0px;'><div class='".$first_cell_vert." nbyk_cell1_d'>parcel</div></td></tr></table>";  */
  //$groups_text = "<table><tr style='border:0px;'><td style='border:0px;'><div>neuron type</div></td><td style='border:0px;'><div>parcel</div></td></tr></table>";
  $groups_text = "<div class='".$first_cell_vert." nbyk_cell1_d main_table_header' style='width:247px !important;z-index:10000 !important;border:0px solid !important;font-size:16px;'><div style='position:relative;bottom:30px;'>parcel</div></div><div class='nbyk_cell1_d main_table_header' style='position:relative;width:247px !important;z-index:1000 !important;height:45px;font-size:16px;'>&nbsp;&nbsp;&nbsp;<div style='position:relative;left:60px;'>neuron type</div></div>";
  $parcel_group = array($groups_text, "DG:SMo:D", "DG:SMo:A", "DG:SMi:D", "DG:SMi:A", "DG:SG:D", "DG:SG:A", "DG:H:D", "DG:H:A", "DG:All:D", "DG:All:A", "CA3:SP:D", "CA3:SP:A", "CA3:SL:D", "CA3:SL:A", "CA3:SR:D", "CA3:SR:A", "CA3:SLM:D", "CA3:SLM:A", "CA3:SO:D", "CA3:SO:A", "CA3:All:D", "CA3:All:A", "CA2:All:D", "CA2:All:A", "CA2:SO:D", "CA2:SO:A", "CA2:SP:D", "CA2:SP:A", "CA2:SR:D", "CA2:SR:A", "CA2:SLM:D", "CA2:SLM:A", "CA1:SLM:D", "CA1:SLM:A", "CA1:SR:D", "CA1:SR:A", "CA1:SP:D", "CA1:SP:A", "CA1:SO:D", "CA1:SO:A", "CA1:All:D", "CA1:All:A", "Sub:SM:D", "Sub:SM:A", "Sub:SP:D", "Sub:SP:A", "Sub:PL:D", "Sub:PL:A", "Sub:All:D", "Sub:All:A", "EC:I:D", "EC:I:A", "EC:II:D", "EC:II:A", "EC:III:D", "EC:III:A", "EC:IV:D", "EC:IV:A", "EC:V:D", "EC:V:A", "EC:VI:D", "EC:VI:A", "EC:All:D", "EC:All:A");
  $parcel_region = array();
  $parcel_layers = array();
  $parcel_a_d = array();
  $vert_parcel_group = array("DG", "CA3", "CA2", "CA1", "Sub", "EC");
  $vert_red_lines = array(7,19,31,39,47);

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
        $neuron_group[$nt_tot] = $neuron_type_unsorted[$ng_i];
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

  for ($i = 0; $i < count($parcel_group); $i++) {
    $parcel_delim = explode(':', $parcel_group[$i]);
    array_push($parcel_region, $parcel_delim[0]);
    array_push($parcel_layers, $parcel_delim[1]);
    array_push($parcel_a_d, $parcel_delim[2]);
  }

  include('change_html.php');

  echo "
  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'></script>
  <script type='text/javascript'>
    $(document).ready(function() {
    $('table.fixed_table tbody').scroll(function(e) { //detect a scroll event on the tbody
      /*
      Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
      of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain       it's relative position at the left of the table.    
      */
      $('table.fixed_table thead').css('left', -$('table.fixed_table tbody').scrollLeft()); //fix the thead relative to the body scrolling
      $('table.fixed_table thead td:nth-child(1)').css('left', $('table.fixed_table tbody').scrollLeft()); //fix the first cell of the header
      $('table.fixed_table tbody td:nth-child(1)').css('left', $('table.fixed_table tbody').scrollLeft()); //fix the first column of tdbody
      $('table.fixed_table thead td:nth-child(2)').css('left', $('table.fixed_table tbody').scrollLeft()); //fix the first cell of the header
      $('table.fixed_table tbody td:nth-child(2)').css('left', $('table.fixed_table tbody').scrollLeft()); //fix the first column of tdbody      
      });
    });
  </script>";

  // generate matrix   

  echo "<table class='fixed_table main_table";
  if ($_GET['tab'] == 'a_d_l') {
    echo " fixed_table2";
  }
  echo "'>";
  for ($i=0;$i<14;$i++) {
    $all_totals='';
    for ($j=0;$j<count($parcel_group)+1;$j++) {
      $i_adj = $i-2;
      $j_adj = $j-1;
      // manual rules for organizing data (through row swaps) by green: Excitatory, red: Inhibitory
      if ($i_adj==45) {$i_adj=54;}
      else if ($i_adj==54) {$i_adj=45;}
      if ($i_adj==46) {$i_adj=55;}
      else if ($i_adj==55) {$i_adj=46;}
      if ($i_adj==47) {$i_adj=56;}
      else if ($i_adj==56) {$i_adj=47;}
      // manual rules for organizing column order as listed on the morphology page
      if ($j_adj==11) {$j_adj=17;}
      else if ($j_adj==17) {$j_adj=11;}
      if ($j_adj==13) {$j_adj=15;}
      else if ($j_adj==15) {$j_adj=13;} 
      //if ($j_adj==21) {$j_adj=25;}
      //else if ($j_adj==25) {$j_adj=21;}     

      $output_data = false;
      if ($j%2==0) {
        $output_data = true;
      }
      if ($i==0) {
        if ($j==0) {
          echo "<thead><tr class='main_table_header'>";         
          echo "<td style='border-bottom:0px !important;z-index:1000 !important;width:247px;height:25px;border:0px !important;' class='nbyk_cell1_d main_table_header no_t_b_border'>";
        }
        else if ($j==1) {
          echo "<td style='border-bottom:0px;width:247px;height:7px;border:0px !important;' class='nbyk_cell1_d main_table_header no_t_b_border'>";
        }
        else if ($output_data && $parcel_layers[$j_adj]!='All') {
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

        if ($j<2||$output_data) {
          echo "<center>";

          switch($j) {
            case 4;
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
            case 46;
            echo "SUB";
            break;
            case 56;
            echo "EC";
            break;                   
          }

          echo "</center></font></td>";
        }
      }
      else if ($i==1) {
        if ($j==0) {
          echo "<tr class='main_table_header'>";          
          echo "<td class='main_table_header no_t_b_border'></td>";
        }        
        else if ($j==1) {
          echo "<td style='border:0px solid' class='no_t_b_border'>".$parcel_group[$j_adj]."</td>";
          //echo "<td></td>";
        }
        else if ($output_data && $parcel_layers[$j_adj]!='All') {
          echo "<td class='".$css_vertical." verticle_n_by_k main_matrix_text' style='";
          if ($j_adj == $vert_red_lines[0] || $j_adj == $vert_red_lines[1] || $j_adj ==  $vert_red_lines[2] || $j_adj ==  $vert_red_lines[3] || $j_adj ==  $vert_red_lines[4]) {
            echo "border-right:4px solid #810004;";
          }
          echo "border-bottom:0px solid white'><div class='".$css_vertical." verticle_n_by_k main_matrix_text'>".$parcel_layers[$j_adj]."</div></td>";
        }
      }
      else {
        if ($j==0) {
          echo "<tr id='main_table_row_".$i_adj."'";
          if ($i_adj == 18 || $i_adj == 40 || $i_adj == 54 || $i_adj == 85 || $i_adj == 88) {
            echo " class='red_border2'";
          }
          echo "><td class='main_matrix_text main_table_cell";
          if ($i_adj == 18 || $i_adj == 40 || $i_adj == 54 || $i_adj == 85 || $i_adj == 88) {
            echo " red_border2";
          }
          else {
            echo " no_t_b_border";
          }
          echo "' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\"";
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
            case 54;
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
          echo "<td class='main_matrix_text row_first_cell";
          if ($i_adj == 18 || $i_adj == 40 || $i_adj == 54 || $i_adj == 85 || $i_adj == 88) {
            echo " red_border' style='border-top: .09em solid #ff5757 !important;'";
          }
          echo "' id='first_cell_".$i_adj."' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\">".e_i_check($parcel_region[$i_adj], $neuron_group[$i_adj])."</td>";
        }
        else if ($output_data && $parcel_layers[$j_adj]!='All') {
          echo "<td class='main_matrix_text main_table_cell";
          if ($i_adj == 18 || $i_adj == 40 || $i_adj == 54 || $i_adj == 85 || $i_adj == 88) {
            echo " red_border";
          }
          echo "' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\"";
          if ($j_adj == $vert_red_lines[0] || $j_adj == $vert_red_lines[1] || $j_adj ==  $vert_red_lines[2] || $j_adj ==  $vert_red_lines[3] || $j_adj ==  $vert_red_lines[4]) {
            echo " style='border-right:4px solid #810004;'";
          }
          echo ">";
          
          for ($adi=0;$adi<2;$adi++) {
            if ($adi==0) {
              $j_adj2=$j_adj;
              echo "&nbsp;";
            }
            if ($adi==1) {
              $j_adj2=$j_adj+1;
              echo "<hr class='hr_sub_cell'>";
              echo "&nbsp;";
            }
            // detect appropriate matrix data to populate
            if (isset($_GET['tab']) && $_GET['tab'] == 's_d') {  
              $sql = "SELECT CAST(STD(mean_path_length) AS DECIMAL(10,2)) AS std_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd, CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(MIN(mean_path_length) AS DECIMAL(10,2)) AS min_sd, CAST(MAX(mean_path_length) AS DECIMAL(10,2)) AS max_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj2]."' AND mean_path_length!='';";
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
              $sql = "SELECT CAST(STD(total_length) AS DECIMAL(10,2)) AS std_tl, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg_trunk, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj2]."' AND total_length!='';";
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
            echo "&nbsp;";
          }
          
          if ($j<2||$output_data) {
            echo "</td>";
          }
        }
        else if ($output_data && $parcel_layers[$j_adj]=='All') {
          //find current parcel
          $sql = "SELECT DISTINCT(subregion) AS subreg FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."'";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $current_parcel=$row['subreg'];

          for ($adi=0;$adi<2;$adi++) {
            if ($adi==0) {
              $j_adj2=$j_adj;
              $a_or_d='Dendrite: ';
              //$prcl = '_________'.$parcel_region[$j_adj].'_________\\n';
              $prcl = '';
              $nl="\\n";
            }
            else {
              $j_adj2=$j_adj+1;
              $a_or_d='Axon: ';
              $prcl = '';
              $nl="";
            }
            if (isset($_GET['tab']) && $_GET['tab'] == 's_d' && $current_parcel == $parcel_region[$j_adj]) {  
              $sql = "SELECT CAST(AVG(mean_path_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(mean_path_length) AS DECIMAL(10,2)) AS count_sd FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj2]."' AND mean_path_length!='';";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) { 
                $row = $result->fetch_assoc();
                $all_totals = $all_totals.$prcl.$a_or_d.'\\nAverage Somatic Distance: '.$row['avg'].'\\nValues Count: '.$row['count_sd'].'\\nStandard Deviation: '.$row['std'].$nl;
              }
            }
            else if ($current_parcel == $parcel_region[$j_adj]) {
              $sql = "SELECT CAST(AVG(total_length) AS DECIMAL(10,2)) AS avg, CAST(STD(total_length) AS DECIMAL(10,2)) AS std, CAST(COUNT(total_length) AS DECIMAL(10,2)) AS count_tl FROM neurite_quantified WHERE neurite_quantified.hippocampome_neuronal_class='".$neuron_group[$i_adj]."' AND neurite_quantified.neurite='".$parcel_group[$j_adj2]."' AND total_length!='';";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) { 
                $row = $result->fetch_assoc();
                $all_totals = $all_totals.$prcl.$a_or_d.'\\nAverage Total Length: '.$row['avg'].' \\nValues Count: '.$row['count_tl'].'\\nStandard Deviation: '.$row['std'].$nl;
              }
            }
          }
          $new_inner_html = e_i_check($parcel_region[$i_adj], $neuron_group[$i_adj]);
          change_html("first_cell_".$i_adj, "<a title='".$all_totals."'>".$new_inner_html."</a>", false);
          $all_totals=$all_totals;
        }
      }       
    }     
    echo "</tr>";     
    if ($i == 1) {echo "</thead>";}
  }  
    echo "
  </table>";

  echo "
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face='Verdana, Arial, Helvetica, sans-serif' color='#339900' size='2'> +/green: </font> <font face='Verdana, Arial, Helvetica, sans-serif' size='2'> Excitatory</font>
  &nbsp; &nbsp; 
  <font face='Verdana, Arial, Helvetica, sans-serif' color='#CC0000' size='2'> -/red: </font> <font face='Verdana, Arial, Helvetica, sans-serif' size='2'> Inhibitory&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='http://www.hippocampome.org/phpdev/synap_prob/dal/synapse_probabilities.html'>Realtime loading preview</a></font>
  <br />";  
?>
