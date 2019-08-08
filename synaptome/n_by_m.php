<script type="text/javascript">
$(function(){
var rotateFunction = function (grid, headerHeight) {
  // we use grid as context (if one have more as one table on the page)
  var trHead = $("thead:first tr", grid.hdiv),
      cm = grid.getGridParam("colModel") ,
      ieVer = $.browser.version.substr(0, 3),
      iCol, cmi, headDiv,
      isSafariAndNotChrome = (($.browser.webkit || $.browser.safari) &&
                             !(/(chrome)[ \/]([\w.]+)/i.test(navigator.userAgent))); 


  headerHeight = $("thead:first tr th").height();
  for (iCol = 0; iCol < cm.length; iCol++) {
    cmi = cm[iCol];
    // prevent text cutting based on the current column width
    headDiv = $("th:eq(" + iCol + ") div", trHead);
    if (!$.browser.msie || ieVer === "9.0" || document.documentMode >= 9) {
        headDiv.width(headerHeight)
               .addClass("rotate")
               .css("left",3);
               /* .css("bottom", isSafariAndNotChrome? 0: 7)
               .css("left", ($.browser.webkit || $.browser.safari)?
                            (cmi.width - headerHeight)/2:
                            (cmi.width - headerHeight)/2 + 2); */
    }
    else {
        // Internet Explorer 6.0-8.0 or Internet Explorer 9.0 in compatibility mode
        headDiv.width(headerHeight).addClass("rotateOldIE");
        if (ieVer === "8.0" || document.documentMode === 8) { // documentMode is important to test for IE compatibility mode
          headDiv.width(headerHeight)
            .addClass("rotate")
            .css("left",3);
        } else {
            headDiv.css("left", 3);
        }
        headDiv.parent().css("zoom",1);
    } 
  }
}  
/*
fixPositionsOfFrozenDivs = function () {
    var $rows;
    if (typeof this.grid.fbDiv !== "undefined") {
        $rows = $('>div>table.ui-jqgrid-btable>tbody>tr', this.grid.bDiv);
        $('>table.ui-jqgrid-btable>tbody>tr', this.grid.fbDiv).each(function (i) {
            var rowHight = $($rows[i]).height(), rowHightFrozen = $(this).height();
            if ($(this).hasClass("jqgrow")) {
                $(this).height(rowHight);
                rowHightFrozen = $(this).height();
                if (rowHight !== rowHightFrozen) {
                    $(this).height(rowHight + (rowHight - rowHightFrozen));
                }
            }
        });
        $(this.grid.fbDiv).height(this.grid.bDiv.clientHeight);
        $(this.grid.fbDiv).css($(this.grid.bDiv).position());
    }
    if (typeof this.grid.fhDiv !== "undefined") {
        $rows = $('>div>table.ui-jqgrid-htable>thead>tr', this.grid.hDiv);
        $('>table.ui-jqgrid-htable>thead>tr', this.grid.fhDiv).each(function (i) {
            var rowHight = $($rows[i]).height(), rowHightFrozen = $(this).height();
            $(this).height(rowHight);
            rowHightFrozen = $(this).height();
            if (rowHight !== rowHightFrozen) {
                $(this).height(rowHight + (rowHight - rowHightFrozen));
            }
        });
        $(this.grid.fhDiv).height(this.grid.hDiv.clientHeight);
        $(this.grid.fhDiv).css($(this.grid.hDiv).position());
    }
    $( "#frmCntr" ).remove();
    $( "#toCntr" ).remove();
}
*/
$grid = jQuery("#list4")
// new entry
$grid.jqGrid({
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
/*
  gridComplete: function () {
   rotateFunction($grid,235); 
  } 
  */
/*
   var gridName = "list4"; // Access the grid Name
   Merger(gridName,"type");
   $grid.jqGrid('setFrozenColumns');
   */
/*var gridName = "nGrid"; // Access the grid Name*/
/*fixPositionsOfFrozenDivs.call($grid[0]);*/
/*jQuery("#list4").colModel.addClass("rotate");*/
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
