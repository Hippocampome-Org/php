<script type="text/javascript">
  $(function(){
    var rotateFunction = function (grid, headerHeight) {
      // we use grid as context (if one have more as one table on the page)
      var trHead = $("thead:first tr", grid.hdiv),
      /*cm = grid.getGridParam("colModel") ,*/
      ieVer = $.browser.version.substr(0, 3),
      iCol, cmi, headDiv,
      isSafariAndNotChrome = (($.browser.webkit || $.browser.safari) &&
       !(/(chrome)[ \/]([\w.]+)/i.test(navigator.userAgent))); 

      headerHeight = $("thead:first tr th").height();
      //
      headDiv = $("th div", trHead);
      if (!$.browser.msie || ieVer === "9.0" || document.documentMode >= 9) {
        headDiv.width(headerHeight)
        /*headDiv.addClass("rotate")
        .css("left",3);*/
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
    $grid = $("#nGrid"),
    $grid.jqGrid({
      datatype: "jsonstring",
      <?php
      $col_names_text = "'<img src=\"images/pre_post.gif\" style=\"top:14px;right:30px;position:relative;height:200px;width:200px;\">',";
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
      $col_model_text."   {name:'type', index:'type', width:400,sortable:false,frozen:true,cellattr: function (rowId, tv, rawObject, cm, rdata) {
        return 'id=\'type' + rowId + \"\'\";   
      },frozen:true},";
      for ($i=0;$i<count($col_names_group);$i++) {
        if ($i==0) {
          $col_model_text=$col_model_text."{name:'".$col_names_group[$i]."',index:'".$col_names_group[$i]."',width:200,height:400,search:false,sortable:false},";
        }
        else {
          $col_model_text=$col_model_text."{name:'".$col_names_group[$i]."',index:'".$col_names_group[$i]."',width:20,height:400,search:false,sortable:false},";
        }
      }
      echo "colModel:[".$col_model_text."],";
      ?> 
      jsonReader : {
        repeatitems: true,
        cell:"cell",
        id: "invid"
      },
      scrollerbar:true,
      shrinkToFit:false,
      height:'440',
      width:'1050',
      gridComplete: function () {
       var gridName = "nGrid"; // Access the grid Name
       rotateFunction($grid,435); 
     } 
   });

    var cm = $grid.jqGrid('getGridParam', 'colModel');  
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
          jQuery('#nGrid').jqGrid('addRowData',i+1,mydata);
        ";
        $i++;
      }
    }
    ?>
  });
</script> 
<table id="nGrid"></table>
<div id="pager"></div>
