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
  if ($css_vertical=='vertical') {
    $css_vertical='vertical2';
    $first_cell_vert='vertical_fc2';
    $first_cell_horiz='horizontal_fc2';
  }
  else if ($css_vertical=='verticalIE') {
    $css_vertical='verticalIE2';
    $first_cell_vert='vertical_fcIE2';
    $first_cell_horiz='horizontal_fcIE2';
  } 
  else if ($css_vertical=='verticalSafari') {
    $css_vertical='verticalSafari2';
    $first_cell_vert='vertical_fcSafari2';
    $first_cell_horiz='horizontal_fcSafari2';
  } 
  $cacheFile = "cache/p_s.json";
  $session_variable = "p_s";
if (file_exists($cacheFile)) {
    session_start();
    $_SESSION[$session_variable] = file_get_contents($cacheFile);
    $data               = json_decode($_SESSION[$session_variable]);
    $result = $data->result;
    echo $result;
} else {

  $pre_neuron_group = array();
  $post_neuron_group = array();
  //$parcel_counts = array(18,22,5,20,3,17,5,5);
  $parcel_horiz_pos = array(20,46,52,93,96,127);
  $parcel_horiz_pos2 = array(10,33,49,72,94,111);
  $parcel_vert_pos = array(2,20,44,49,89,92);
  $parcel_counts = array(18,24,5,40,3,31);  
  $parcel_group = array("DG", "CA3", "CA2", "CA1", "SUB", "EC", "MEC", "LEC");
  $final_result = array();
  global $parcel_counts;
  global $parcel_group;
  $pre_post_text = "<table class='nbyk_cell1_a'><tr style='border:0px;'><td class='nbyk_cell1_b ".$first_cell_horiz."' style='border:0px;'><div class='".$first_cell_horiz."'>presynaptic neuron</td><td class='".$first_cell_vert." nbyk_cell1_c' style='border:0px;'><div class='".$first_cell_vert." nbym_cell1_d'>postsynaptic neuron</div></td></table>";

  function collect_neuron_names($sql, $conn, $col, $cp) {        
    $neuron_group = array();
    $neuron_layers = array();
    $neuron_group_unsorted = array();
    global $parcel_counts;
    global $parcel_group;
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) {
        $neuron = $row[$col];
        $layers = $row['layers'];
        $layer_delim = explode(" ", $neuron);
        $layer = $layer_delim[0];
        if ($neuron != '') {
          array_push($neuron_group_unsorted, $neuron);
          array_push($neuron_layers, $layer);
        }
      }
    }

    for ($i = 0; $i < sizeof($parcel_group); $i++) {  
    //for ($i = 0; $i < 1; $i++) {  
      for ($j = 0; $j < sizeof($neuron_group_unsorted); $j++) {
        if ($neuron_layers[$j] == $parcel_group[$i]) {
          if (!in_array($neuron_group_unsorted[$j], $neuron_group)) {
            array_push($neuron_group, $neuron_group_unsorted[$j]);
          }
        }
      }
    }

    return $neuron_group;
  }

  // collect post neuron names
  $col = "target_name";
  $sql = "SELECT DISTINCT ".$col.", layers FROM potential_synapses;";
  $pre_post_push = true;
  $post_neuron_group = collect_neuron_names($sql, $conn, $col, true);  

  // collect pre neuron names
  $col = "source_name";
  $sql = "SELECT DISTINCT ".$col.", layers FROM potential_synapses;";
  $pre_post_push = false;
  $pre_neuron_group = collect_neuron_names($sql, $conn, $col, false);  

  // construct matrix
  array_push($final_result, "<table class='main_table'>");
  $old_c=0;
  for ($i=0;$i<count($pre_neuron_group)+2;$i++) {
    for ($j=0;$j<count($post_neuron_group)+2;$j++) {
      $i_adj = $i-2;
      $j_adj = $j-2;
      if ($i==0) {
        if ($j==0) {
          array_push($final_result, "<tr class='main_table_header' id='main_table_header'>");
          array_push($final_result, "<td style='border-bottom:0px !important; border-right:0px !important'></td>"); 
        }
        else if ($j==1) {
          array_push($final_result, "<td style='border-bottom:0px !important; border-left:0px !important'>");
        }
        else {
          array_push($final_result, "<td style='border-left:2px white;border-right:2px white;padding:5px;'");
          if ($j==0 || $j == 1) {
            array_push($final_result, ">");
          }
          else if ($j > 1 && $j < $parcel_horiz_pos[0]) {
            array_push($final_result, " class='dg_area'><font style='font-size:14px;color:white;'>");
          }
          else if ($j < $parcel_horiz_pos[1]) {
            array_push($final_result, " class='ca3_area'><font style='font-size:14px;color:white;'>");
          }
          else if ($j < $parcel_horiz_pos[2]) {
            array_push($final_result, " class='ca2_area'><font style='font-size:14px;color:#000993;'>");
          }
          else if ($j < $parcel_horiz_pos[3]) {
            array_push($final_result, " class='ca1_area'><font style='font-size:14px;color:#000993;'>");
          }
          else if ($j < $parcel_horiz_pos[4]) {
            array_push($final_result, " class='sub_area'><font style='font-size:14px;color:#000993;'>");
          }
          else if ($j < $parcel_horiz_pos[5]) {
            array_push($final_result, " class='ec_area'><font style='font-size:14px;color:white;'>");
          }
          else {
            array_push($final_result, ">");
          }
          array_push($final_result, "<center>");

          switch($j){
            case $parcel_horiz_pos2[0];
            array_push($final_result, "DG</center></font>");
            break;
            case $parcel_horiz_pos2[1];
            array_push($final_result, "CA3</center></font>");
            break;
            case $parcel_horiz_pos2[2];
            array_push($final_result, "CA2</center></font>");
            break;
            case $parcel_horiz_pos2[3];
            array_push($final_result, "CA1</center></font>");
            break;
            case $parcel_horiz_pos2[4];
            array_push($final_result, "SUB</center></font>");
            break;
            case $parcel_horiz_pos2[5];
            array_push($final_result, "EC</center></font>");
            break;                   
          }

          array_push($final_result, "</td>");
        }
      }
      else if ($i==1) {
        if ($j==0) {
          array_push($final_result, "<tr class='main_table_header' id='main_table_header'>");
          array_push($final_result, "<td style='border-top:0px !important;border-right:0px !important;'></td>");
        }
        else if ($j==1) {
          array_push($final_result, "<td style='border-top:0px !important;border-left:0px !important;'>".$pre_post_text."</td>");
        }
        else {
          array_push($final_result, "<td class='".$css_vertical." verticle_n_by_n main_matrix_text'");
          if ($j == $parcel_horiz_pos[0]-1 || $j == $parcel_horiz_pos[1]-1 || $j == $parcel_horiz_pos[2]-1 || $j == $parcel_horiz_pos[3]-1 || $j == $parcel_horiz_pos[4]-1) {
            array_push($final_result, " style='border-right:4px solid #810004;'");
          }
          array_push($final_result, "><div class='".$css_vertical." verticle_n_by_n main_matrix_text'>".$post_neuron_group[$j_adj]."</div></td>");
        }
      }
      else {
        if ($j==0) {
          array_push($final_result, "<tr id='main_table_row_".$i_adj."'");
          if ($i == $parcel_vert_pos[1] || $i == $parcel_vert_pos[2] || $i == $parcel_vert_pos[3] || $i == $parcel_vert_pos[4] || $i == $parcel_vert_pos[5]) {
            array_push($final_result, " class='red_border2'");
          }
          array_push($final_result, "><td class='main_matrix_text main_table_cell");
          if ($i == $parcel_vert_pos[1] || $i == $parcel_vert_pos[2] || $i == $parcel_vert_pos[3] || $i == $parcel_vert_pos[4] || $i == $parcel_vert_pos[5]) {
            array_push($final_result, " red_border2");
          }
          else {
            array_push($final_result, " no_t_b_border");
          }
          array_push($final_result, "' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\">");          
          switch($i){
            case $parcel_vert_pos[0];
            array_push($final_result, "<font class='dg_area2'>");
            array_push($final_result, "DG(".$parcel_counts[0].")");
            array_push($final_result, "</font>");
            break;
            case $parcel_vert_pos[1];
            array_push($final_result, "<font class='ca3_area2'>");
            array_push($final_result, "CA3(".$parcel_counts[1].")");
            array_push($final_result, "</font>");
            break;
            case $parcel_vert_pos[2];
            array_push($final_result, "<font class='ca2_area2'>");
            array_push($final_result, "CA2(".$parcel_counts[2].")");
            array_push($final_result, "</font>");
            break;
            case $parcel_vert_pos[3];
            array_push($final_result, "<font class='ca1_area2'>");
            array_push($final_result, "CA1(".$parcel_counts[3].")");
            array_push($final_result, "</font>");
            break;
            case $parcel_vert_pos[4];
            array_push($final_result, "<font class='sub_area2'>");
            array_push($final_result, "SUB(".$parcel_counts[4].")");
            array_push($final_result, "</font>");
            break;
            case $parcel_vert_pos[5];
            array_push($final_result, "<font class='ec_area2'>");
            array_push($final_result, "EC(".$parcel_counts[5].")");
            array_push($final_result, "</font>");
            break;                   
          }
          array_push($final_result, "</td>");
        }
        else if ($j==1) {
          array_push($final_result, "<td class='main_matrix_text row_first_cell");
          if ($i == $parcel_vert_pos[1] || $i == $parcel_vert_pos[2] || $i == $parcel_vert_pos[3] || $i == $parcel_vert_pos[4] || $i == $parcel_vert_pos[5]) {
            array_push($final_result, " red_border' style='border-top: .09em solid #ff5757 !important;'");
          }
          array_push($final_result, " id='first_cell_".$i_adj."' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\">".$pre_neuron_group[$i_adj]."</td>");
        }
        else {
          array_push($final_result, "<td class='main_matrix_text main_table_cell");
          if ($i == $parcel_vert_pos[1] || $i == $parcel_vert_pos[2] || $i == $parcel_vert_pos[3] || $i == $parcel_vert_pos[4] || $i == $parcel_vert_pos[5]) {
            array_push($final_result, " red_border");
          }
          array_push($final_result, "' onClick=\"changerowcolor(".$i_adj.")\" onmouseover=\"changebordercolor(".$i_adj.")\"");
          if ($j == $parcel_horiz_pos[0]-1 || $j == $parcel_horiz_pos[1]-1 || $j == $parcel_horiz_pos[2]-1 || $j == $parcel_horiz_pos[3]-1 || $j == $parcel_horiz_pos[4]-1) {
            array_push($final_result, " style='border-right:4px solid #810004;");
          }
          if ($i == $parcel_vert_pos[1] || $i == $parcel_vert_pos[2] || $i == $parcel_vert_pos[3] || $i == $parcel_vert_pos[4] || $i == $parcel_vert_pos[5]) {          
            array_push($final_result, "border-top: .09em solid #ff5757 !important;'");
          }
          array_push($final_result, "'>");
          $sql = "SELECT CAST(AVG(potential_synapses) AS DECIMAL(5,5)) AS ps_avg FROM potential_synapses WHERE potential_synapses.source_name='".$pre_neuron_group[$i_adj]."' AND potential_synapses.target_name='".$post_neuron_group[$j_adj]."' AND potential_synapses.potential_synapses!='';";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
              $ps_avg = $row['ps_avg'];
              if ($ps_avg != '' && $ps_avg != 0) {
              array_push($final_result, "<a href='#' title='Variance Will Be\nAdded Later Here'>".$ps_avg."</a>");            
              }
            }
          }        
          array_push($final_result, "</td>");
        }
      }
    }    
    array_push($final_result, "</tr>");
  }
  array_push($final_result, "</table>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='http://www.hippocampome.org/phpdev/synap_prob/dal/synapse_probabilities.html'>Realtime loading preview</a>");
   $jsonObject->result = implode("", $final_result);
   echo $jsonObject->result;
   $_SESSION[$session_variable] = json_encode($jsonObject);
   $fp  = fopen($cacheFile, 'x+');
   fwrite($fp, $_SESSION[$session_variable]);
   fclose($fp);
}
?>
