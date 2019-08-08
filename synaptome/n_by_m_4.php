<script type="text/javascript">
jQuery(document).ready(function() {
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_markers.php',
    success: function() {}
  }); 
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_ephys.php',
    success: function() {}
  }); 
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_morphology.php',
    success: function() {}
  });
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_connectivity.php',
    success: function() {}
  });
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_firing.php',
    success: function() {}
  });
  $.ajax({
    type: 'GET',
    cache: false,
    contentType: 'application/json; charset=utf-8',
    url: 'load_matrix_session_firing_parameter.php',
    success: function() {}
  });
  $('div#menu_main_button_new_clr').css('display','block');
});
</script>
<!-- Code for generating csv file from the matrices-->
<script>
$(document).ready(function(){
    $("#csvKN").click(function(){
          generateMatrix("KN","Know Connections Matrix.csv");
    });
    $("#csvPE").click(function(){
          generateMatrix("PE","Potential Excitatory Connections Matrix.csv");
    });
    $("#csvPI").click(function(){
          generateMatrix("PI","Potential Inhibitory Connections Matrix.csv");
    });
    $("#csvCN").click(function(){
          generateMatrix("CN","Netlist.csv");
    });
  function generateMatrix(matrixName,fileName){
    var BLACK="rgb(0, 0, 0)"
    var GRAY="rgb(170, 170, 170)"
     var trs=[];
      var tds=[]
      var link=[];
      var neuronId=[];
      var neuronName=[];
      var id;
      var knownConnection=[];
      var index=0;
      for(var row=1;row<=122;row++){
        trs = $("#"+row);
        tds = trs.find("td");
        var name=$(tds[1]).text().trim();
        link = $(tds[1]).find("a");
        var id=$(link).attr("href").trim();
        var id_val=id.substring(id.lastIndexOf('=')+1,id.length);
        neuronName[row-1]=name;
        neuronId[row-1]=id_val;
      }

      for(var row=1;row<=122;row++){
        trs = $("#"+row);
        tds = trs.find("td");
        for(var column=2;column<124;column++){
            link = $(tds[column]).find("div");
            if(link.length!=0){
              var image=$(link[0]).find("img");
              var img=$(image[0]).attr("src").trim();
              var img_name=img.substring(img.lastIndexOf('/')+1,img.length);
              var column_back_colour=$(link[0]).css('background-color');
              if((matrixName=="CN" || matrixName=="KN") &&img_name=="known_connection.png"){
                  knownConnection[index++]=neuronName[row-1]+","+neuronName[column-2];
              }
              else if((matrixName=="CN" || matrixName=="PE") && column_back_colour==BLACK){
                    knownConnection[index++]=neuronName[row-1]+","+neuronName[column-2];
              }
              else if((matrixName=="CN" || matrixName=="PI") && column_back_colour==GRAY){
                  knownConnection[index++]=neuronName[row-1]+","+neuronName[column-2];
              }
            }
        }
    }
    var csvContent = "data:text/csv;charset=utf-8,";
    csvContent +="From (pre-synaptic type),To (post-synaptic type)\n";
    knownConnection.forEach(function(infoArray, index){
       var dataString = infoArray;
       csvContent += index < knownConnection.length ? dataString+ "\n" : dataString;

    }); 
    var encodedUri = encodeURI(csvContent);
    var linkDownload = document.createElement("a");
    linkDownload.setAttribute("href", encodedUri);
    linkDownload.setAttribute("download", fileName);
    document.body.appendChild(linkDownload); 
    linkDownload.click(); 
  }

});
</script>

<?php
  include ("function/stm_lib.php");
  require_once('class/class.type.php');
  require_once('class/class.property.php');
  require_once('class/class.evidencepropertyyperel.php');
  require_once('class/class.temporary_result_neurons.php'); 
  require_once('class/class.utils.php');
  
  $connectivityHeader = new utils();
  $connectivityHeader->setHeader("Type");
  $connheaderStr = $connectivityHeader->getHeaderStr();
  
  
  $type = new type($class_type);
  
  $research = $_REQUEST['research'];
  
  if(isset($research))
  {
    include ('getConnectivity.php');
    $jsonStr = json_encode($responce);

  }
  else
    $jsonStr = $_SESSION['connectivity'];
?>

<script>

function OpenInNewTab(aEle)
{
  //alert(aEle.href);
  var win = window.open(aEle.href,'_blank');
  win.focus();
}
function getIEVersion() {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.test(ua) != null)
            rv = parseFloat( RegExp.$1 );
    }
    return rv;
}


function checkVersion() {
    var ver = getIEVersion();
  //alert("Version : "+ver);
    /*if ( ver != -1 ) {
        if (ver <= 9.0) {
            // do something
        }
    }*/
    return ver;
}
checkVersion();
</script>

<?php
if ($_SESSION['perm'] == NULL)
{
  $_SESSION['perm'] = 1;
?>
  <script>
  window.onload = function() 
  { 
    if (!window.location.search) 
    { 
      setTimeout("window.location+='?refreshed';", 0);
    } 
  } 
  </script>
<?php
}
?>

<script type="text/javascript">
$(function(){
  var dataStr = <?php echo $jsonStr?>;;
  //alert(dataStr.Unknowncount);
  var innerHTML_knowncount = dataStr.knowncount;
  var innerHTML_Unknowncount = dataStr.Unknowncount;
  var Potential_Excitatory_Non_PCL = dataStr.black;
  var Potential_Inhibitory_Non_PCL= dataStr.gray;
  //count of each connection
  document.getElementById("id_knowncount").innerHTML=innerHTML_knowncount;
  document.getElementById("id_Unknowncount").innerHTML=innerHTML_Unknowncount;
  document.getElementById("Potential_Excitatory_Non_PCL").innerHTML=Potential_Excitatory_Non_PCL;
  document.getElementById("Potential_Inhibitory_Non_PCL").innerHTML=Potential_Inhibitory_Non_PCL;
  //document.getElementById("Potential_Inhibitory_PCL_Only").innerHTML=Potential_Inhibitory_PCL_Only;

   var rotateFunction = function (grid, headerHeight) {
   // we use grid as context (if one have more as one table on the page)
    var trHead = $("thead:first tr", grid.hdiv),
        cm = grid.getGridParam("colModel") ,
        ieVer = $.browser.version.substr(0, 3),
        iCol, cmi, headDiv,
        isSafariAndNotChrome = (($.browser.webkit || $.browser.safari) &&
                               !(/(chrome)[ \/]([\w.]+)/i.test(navigator.userAgent))); 

    
    headerHeight = $("thead:first tr th").height();
   for (iCol = 0; iCol < cm.length; iCol++) 
    {
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
  
  function Merger(gridName,cellName){
    var mya = $("#" + gridName + "").getDataIDs();  
    var rowCount = mya.length;
    var rowSpanCount = 1;
    var countRows = 0;
    var lastRowDelete =0;
    var firstElement = 0;

    for(var i=0;i<=rowCount;i=i+countRows)
    { 
      var before = $("#" + gridName + "").jqGrid('getRowData', mya[i]); // Fetch me the data for the first row
      for (j = i+1; j <=rowCount; j++) 
      {
        var end = $("#" + gridName + "").jqGrid('getRowData', mya[j]); // Fetch me the data for the next row
        if (before[cellName] == end[cellName]) // If the previous row and the next row data are the same
        {
          $("#" + gridName + "").setCell(mya[j], cellName,'&nbsp;');
          $("tr#"+j+" td#type"+j).css("border-bottom","none");
          if(rowSpanCount > 1) // For the first row Don't delete the cell and its contents
          { 
            $("tr#"+j+" td#type"+j).css("border-bottom","none");
          }
          else
          {
            firstElement = j;
          }
          rowSpanCount++; 
                } 
                else 
                {
          $("tr#"+j).css("border-bottom", "2px red");
          countRows = rowSpanCount;
                  rowSpanCount = 1;
                  break;
                }
      }
    } 
  }
  var research = "<?php echo $research?>";
  var table = "<?php echo $_REQUEST['table_result']?>";
  $grid = $("#nGrid"),
    resizeColumnHeader = function () {
        var rowHight, resizeSpanHeight,
            // get the header row which contains
            headerRow = $(this).closest("div.ui-jqgrid-view")
                .find("table.ui-jqgrid-htable>thead>tr.ui-jqgrid-labels");

        // reset column height
        headerRow.find("span.ui-jqgrid-resize").each(function () {
            this.style.height = '';
        });

        // increase the height of the resizing span
        resizeSpanHeight = 'height: ' + headerRow.height() + 'px !important; cursor: col-resize;';
        headerRow.find("span.ui-jqgrid-resize").each(function () {
            this.style.cssText = resizeSpanHeight;
        });

        // set position of the dive with the column header text to the middle
        rowHight = headerRow.height();
        headerRow.find("div.ui-jqgrid-sortable").each(function () {
            var ts = $(this);
            ts.css('top', (rowHight - ts.outerHeight()) + 'px');
        });
    },
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
    },
    fixGboxHeight = function () {
        var gviewHeight = $("#gview_" + $.jgrid.jqID(this.id)).outerHeight(),
            pagerHeight = $(this.p.pager).outerHeight();

        $("#gbox_" + $.jgrid.jqID(this.id)).height(gviewHeight + pagerHeight);
        gviewHeight = $("#gview_" + $.jgrid.jqID(this.id)).outerHeight();
        pagerHeight = $(this.p.pager).outerHeight();
        $("#gbox_" + $.jgrid.jqID(this.id)).height(gviewHeight + pagerHeight);
    };

    $grid.jqGrid({
    datatype: "jsonstring",
    datastr: dataStr,
    <?php
      //$col_names_text = "'type',"."'presynaptic_neuron',";
      //$col_names_text = "'presynaptic_neuron',";
      //$col_names_text = "'<div id=\"frmCntr\">FROM</div><div id=\"toCntr\" class=\"rotate\">TO</div>',";
      $col_names_text = "'<img src=\"images/pre_post.gif\" style=\"top:14px;right:32px;position:relative;height:200px;width:200px;\">',";
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
    rowNum:122,
    rowList:[122],
    viewrecords: true, 
    gridview: true,
    jsonReader : {
      /* page: "page",
      total: "total",
      records: "records",
      root:"rows", */
      repeatitems: true,
      onSelectRow: function() {
           return false;
      },
      cell:"cell",
      id: "invid"
   },
  scrollerbar:true,
    shrinkToFit:false,
    height:'440',
    width:'1050',
    gridComplete: function () {
       var gridName = "nGrid"; // Access the grid Name
       $grid.jqGrid('setFrozenColumns');
       rotateFunction($grid,435); 
       fixPositionsOfFrozenDivs.call($grid[0]);
      } 
    });

  //,cellattr:function(){return 'class=\"rotate\";'}
  //Merger(gridName,"type");
  //$("#nGrid").triggerHandler("jqGridAfterGridComplete");
  
  //RotateCheckboxColumnHeaders("#nGrid",235);
  //rotateFunction("#nGrid");
  
  var cm = $grid.jqGrid('getGridParam', 'colModel');
  
  
   $grid.mouseover(function(e) {

    var count = $("#nGrid").jqGrid('getGridParam', 'records') + 1;
      var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
          rowId = $tr.attr('id');
      
      if (rowId) {
          var ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
      $row = "#"+rowId+" td"; 
      $($row).addClass('highlighted_top');

      /* for(var i=0;i<count;i++)
      {
        $colSelected = "tr#"+i+" td:eq("+ci+")";
        $($colSelected).addClass('highlighted');
        
      }  */
    }
    });
    
    $grid.mouseout(function(e) {
      var count = $("#nGrid").jqGrid('getGridParam', 'records') + 1;
        var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
            rowId = $tr.attr('id'), ci;
        if (rowId) {
          ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
            $row = "#"+rowId+" td";  
        $($row).removeClass('highlighted_top');
        /* for(var i=0;i<count;i++)
        {
          $colSelected = "tr#"+i+" td:eq("+ci+")";
          $($colSelected).removeClass('highlighted');
        }  */
      }
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
