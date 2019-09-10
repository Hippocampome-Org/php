<script type="text/javascript">
$(function(){
// new entry
jQuery("#list4").jqGrid({
  datatype: "local",
  height: 800,
    colNames:['all', 'excluded', 'exclusion_reason', 'note', 'selected_for_mining', 'mapped', 'pipeline', 'mapped_not_in_covariates', 'premined', 'pmid_first_new_paper', 'hco', 'hco_paper_new_to_me', 'excluded_in_hco', 'pipeline_in_hco', 'mapped_in_hco', 'mapped_old_list', 'pipeline_old_list'],  
    colModel:[
      {name:'all',index:'all', width:50},
      {name:'excluded',index:'excluded', width:70},
      {name:'exclusion_reason',index:'exclusion_reason', width:100},
      {name:'note',index:'note', width:100},
      {name:'selected_for_mining',index:'selected_for_mining', width:120},
      {name:'mapped',index:'mapped', width:80},
      {name:'pipeline',index:'pipeline', width:80},
      {name:'mapped_not_in_covariates',index:'mapped_not_in_covariates', width:150},
      {name:'premined',index:'premined', width:50},
      {name:'pmid_first_new_paper',index:'pmid_first_new_paper', width:150},
      {name:'hco',index:'hco', width:50},
      {name:'hco_paper_new_to_me',index:'hco_paper_new_to_me', width:150},
      {name:'excluded_in_hco',index:'excluded_in_hco', width:100},
      {name:'pipeline_in_hco',index:'pipeline_in_hco', width:100},
      {name:'mapped_in_hco',index:'mapped_in_hco', width:100},
      {name:'mapped_old_list',index:'mapped_old_list', width:100},
      {name:'pipeline_old_list',index:'pipeline_old_list', width:100}
    ],      
    scrollerbar:true,
    shrinkToFit:false,
    height:'440',
    width:'1050',  
});
var mydata; 
<?php
  $sql = "SELECT * FROM natemsut_synaptome.papers;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
    echo "mydata = [
      {all:'".$row['all']."',excluded:'".$row['excluded']."',exclusion_reason:'".$row['exclusion_reason']."',note:'".$row['note']."',selected_for_mining:'".$row['selected_for_mining']."',mapped:'".$row['mapped']."',pipeline:'".$row['pipeline']."',mapped_not_in_covariates:'".$row['mapped_not_in_covariates']."',premined:'".$row['premined']."',pmid_first_new_paper:'".$row['pmid_first_new_paper']."',hco:'".$row['hco']."',hco_paper_new_to_me:'".$row['hco_paper_new_to_me']."',excluded_in_hco:'".$row['excluded_in_hco']."',pipeline_in_hco:'".$row['pipeline_in_hco']."',mapped_in_hco:'".$row['mapped_in_hco']."',mapped_old_list:'".$row['mapped_old_list']."',pipeline_old_list:'".$row['pipeline_old_list']."'}
      ];
      for(var i=0;i<=mydata.length;i++) {
        jQuery('#list4').jqGrid('addRowData',i+1,mydata);
      }";
    }
  }
?>
});
</script> 
<table id="list4"></table>
