<script type="text/javascript">
$(function(){
// new entry
jQuery("#master_header").jqGrid({
  datatype: "local",
  height: 0,
    colNames:['Potential Connections', 'Validation', 'Experiment IDs'],  
    colModel:[
      {name:'suid',index:'suid', width:411},
      {name:'presynaptic_neuron',index:'presynaptic_neuron', width:386},
      {name:'tuid',index:'tuid', width:463}
    ]    
});
jQuery("#list4").jqGrid({
  datatype: "local",
  height: 800,
    colNames:['suid', 'presynaptic_neuron', 'tuid', 'postsynaptic_neuron', 'layers', 'microscopyctype', 'ephysctype', 'connectivity_refids', 'proper', 'fuzzy_high', 'fuzzy_low', 'amplitude', 'kinetics', 'st_plasticity', 'lt_plasticity'],  
    colModel:[
      {name:'suid',index:'suid', width:50},
      {name:'presynaptic_neuron',index:'presynaptic_neuron', width:120},
      {name:'tuid',index:'tuid', width:50},
      {name:'postsynaptic_neuron',index:'postsynaptic_neuron', width:120},
      {name:'layers',index:'layers', width:50},
      {name:'microscopyctype',index:'microscopyctype', width:100},
      {name:'ephysctype',index:'ephysctype', width:100},
      {name:'connectivity_refids',index:'connectivity_refids', width:120},
      {name:'proper',index:'proper', width:50},
      {name:'fuzzy_high',index:'fuzzy_high', width:80},
      {name:'fuzzy_low',index:'fuzzy_low', width:80},
      {name:'amplitude',index:'amplitude', width:80},
      {name:'kinetics',index:'kinetics', width:80},
      {name:'st_plasticity',index:'st_plasticity', width:60},
      {name:'lt_plasticity',index:'lt_plasticity', width:60}
    ]    
});
var mydata;
<?php
  $sql = "SELECT * FROM natemsut_synaptome.master LIMIT 50;";
  $result = $conn->query($sql);
  $i=0;
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) { 
    echo "mydata = [
      {suid:".$row['suid'].",presynaptic_neuron:'".$row['presynaptic_neuron']."',tuid:".$row['tuid'].",postsynaptic_neuron:'".$row['postsynaptic_neuron']."',layers:'".$row['layers']."',microscopyctype:'".$row['microscopyctype']."',ephysctype:'".$row['ephysctype']."',connectivity_refids:'".$row['connectivity_refids']."',proper:'".$row['proper']."',fuzzy_high:'".$row['fuzzy_high']."',fuzzy_low:'".$row['fuzzy_low']."',amplitude:'".$row['amplitude']."',kinetics:'".$row['kinetics']."',st_plasticity:'".$row['st_plasticity']."',lt_plasticity:'".$row['lt_plasticity']."'}
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
<table id="master_header"></table>
<table id="list4"></table>
