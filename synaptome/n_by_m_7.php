<!--
  reference: https://www.tek-tips.com/viewthread.cfm?qid=983313
-->
<script language="javascript">
var selected_row=0;
function changerowcolor(rowID, numRows, curRow)
{
var onerow=document.getElementById(rowID);
var row_color_change='';
for (i = 1;i < numRows; i++) {
  row_color_change = 'main_table_row_'+i;
  if (i == curRow) {
    document.getElementById(row_color_change).style.backgroundImage='';    
    document.getElementById(row_color_change).style.backgroundColor='#ffeb94';
    selected_row=i;
  }
  else {
    document.getElementById(row_color_change).style.backgroundImage='';    
    document.getElementById(row_color_change).style.backgroundColor='#FFFFFF';
  }
}
}
function changebordercolor(rowID, numRows, curRow)
{
var onerow=document.getElementById(rowID);
var row_color_change='';
/*for (var j; j < onerow.length; i++) {
  onerow[j].style.backgroundColor = red;
}*/
for (i = 1;i < numRows; i++) {
  row_color_change = 'main_table_row_'+i;
  if (i == curRow & i != selected_row) {
    document.getElementById(row_color_change).style.backgroundImage='linear-gradient(white 0%, white 94%, lightgreen 100%)'; 
    document.getElementById(row_color_change).style.backgroundImage='-moz-linear-gradient(white 0%, white 94%, lightgreen 100%)'; 
    document.getElementById(row_color_change).style.backgroundImage='-webkit-linear-gradient(white 0%, white 94%, lightgreen 100%)';
    document.getElementById(row_color_change).style.backgroundImage='-ms-linear-gradient(white 0%, white 94%, lightgreen 100%)';        
  }
  else if (i != selected_row) {
    document.getElementById(row_color_change).style.backgroundImage='';    
    document.getElementById(row_color_change).style.backgroundColor='white';
  }
  /*else {
    document.getElementsByClassName(row_color_change).style.backgroundColor='#FFFFFF';
  }*/
}
}
</script>
<!-- table id="nGrid"></table -->
<?php
  $post_neuron_group = array();
  $pre_post_text = "<img src='images/pre_post_2.gif' class='pre_post_transforms'>";
  $sql = "SELECT tuid, postsynaptic_neuron FROM natemsut_synaptome.postsynaptic_neurons";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { 
    array_push($post_neuron_group, $pre_post_text);
    while($row = $result->fetch_assoc()) { 
      $neuron = $row['postsynaptic_neuron'];
      array_push($post_neuron_group, $neuron);
    }
  }
  $pre_neuron_group = array();
  $sql = "SELECT presynaptic_neuron FROM natemsut_synaptome.presynaptic_neurons;";
  $result = $conn->query($sql);
  $i=0;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
      array_push($pre_neuron_group, $row['presynaptic_neuron']);
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
          echo "<td class='vertical main_matrix_text'><div class='vertical main_matrix_text'>".$post_neuron_group[$j]."</div></td>";
        }
      }
      else if ($j==0) {
        echo "<td class='main_matrix_text' id='first_cell_".$i."'>".$pre_neuron_group[$i]."</td>";
      }
      else {
        echo "<td class='main_matrix_text main_table_cell' onClick=\"changerowcolor('main_table_row_".$i."',".sizeof($pre_neuron_group).", ".$i.")\" onmouseover=\"changebordercolor('main_table_row_".$i."',".sizeof($pre_neuron_group).", ".$i.")\">0.0</td>";
      }
    }    
    echo "</tr>";
  }
  echo "</table>";

?>
<div id="pager"></div>
