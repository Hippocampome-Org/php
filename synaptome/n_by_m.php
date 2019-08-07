<script type="text/javascript">
$(function(){
// new entry
jQuery("#list4").jqGrid({
  datatype: "local",
  height: 800,
  <?php
    $col_names_text = "'presynaptic_neuron',";
    $col_model_text = "";
    $col_names_group = array();
    array_push($col_names_group, 'presynaptic_neuron');
    $sql = "SELECT tuid, postsynaptic_neuron FROM natemsut_synaptome.postsynaptic_neurons";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
      while($row = $result->fetch_assoc()) { 
        $neuron = $row['postsynaptic_neuron'];
        $col_names_text = $col_names_text."'".$neuron."',";
        array_push($col_names_group, $neuron);
      }
    }
    echo "colNames:[".$col_names_text."],";
    for ($i=0;$i<count($col_names_group);$i++) {
      $col_model_text=$col_model_text."{name:'".$col_names_group[$i]."',index:'".$col_names_group[$i]."',width:200},";
    }
    echo "colModel:[".$col_model_text."],";
  ?> 
});
var mydata = [];
<?php
  $sql = "SELECT presynaptic_neuron FROM natemsut_synaptome.presynaptic_neurons;";
  $result = $conn->query($sql);
  $i=0;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
    echo "mydata = [
      {presynaptic_neuron:'".$row['presynaptic_neuron']."'}
      ];
      for(var i=0;i<=mydata.length;i++)
        jQuery('#list4').jqGrid('addRowData',i+1,mydata);
      ";
      $i++;
    }
  }
?>
});
</script> 
<table id="list4"></table>
