<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Google Analytics Tracking -->  
<?php include_once("analytics.php") ?>
<meta http-equiv="Content-Type" content="text/html" />

<?php 
  /* set json data to load */
  $matrix_type = "probabilities_of_synapses";
  $database = "synaptome";
  // Create connection
  if(is_null($conn2)){
	$conn2 = mysqli_connect($servername, $username, $password, $database);   
  }
  if(!$conn2)
  {
    die("Connection failed: " . mysqli_connect_error());
  }

  $cond_id = 1;
  // find condition based on parameters
  if (isset($_REQUEST['param_1']) && isset($_REQUEST['param_2']) && isset($_REQUEST['param_3']) && isset($_REQUEST['param_4']) && isset($_REQUEST['param_5'])) {
	$species = $_REQUEST['param_1'];
	$sex = $_REQUEST['param_2'];
	$age = $_REQUEST['param_3'];
	$temp = $_REQUEST['param_4'];
	$rec_mode = $_REQUEST['param_5'];
	$query = "SELECT id FROM conditions WHERE species='$species' AND sex='$sex' AND age='$age' AND temp='$temp' AND rec_mode='$rec_mode'";
	$rs = mysqli_query($conn2,$query);
	//echo "<br><br><br><br><br><br>".$query;
	while(list($cond_num) = mysqli_fetch_row($rs))
	{
		$cond_id = $cond_num;
	}
  }

  $model_value = 'g';
  if (isset($_REQUEST['value_selection'])) {
	$model_value = $_REQUEST['value_selection'];
  }

  $session_matrix_cache_file = "synap_model/gen_json/json_files/cond".$cond_id."_".$model_value.".json";
  $_SESSION[$matrix_type] = file_get_contents($session_matrix_cache_file);
  $jsonStr = $_SESSION[$matrix_type]; 
?>
<?php 
  include_once("synap_prob/hco_header_1.php");
  include_once("synap_prob/synap_prob_params.php");
?>

<link rel="stylesheet" type="text/css" media="screen" href="synap_prob/css/main_nbyn.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui.jqgrid_morph.css" />
<style type="text/css">
a.right_menu_link {
	color:#000462;
}
a.right_menu_link:hover{
	color:#9536c2;
}
a.right_menu_link:link {
	color: #000462;
}
a.right_menu_link:visited {
	color: #000462;
}
a.right_menu_link2 {
	color:#000993
}
</style>

<!-- ************* Start of Matrix Section ************* -->

<script type="text/javascript">
$(function(){
	$('#super_check').change(function() {
		var bgColorArray = ["","","#770000","#C08181","#FFFF99","#FF6103","#FFCC33","#336633",""];
		var fontColorArray = ["","","#FFFFFF","#FFFFFF","#000099","#000099","#000099","#FFFFFF",""];
		if ($("#super_check").is(':checked')) {
           $("#nGrid").jqGrid('showCol',["Supertype"]);
		}
		else{
			$("#nGrid").jqGrid('hideCol',["Supertype"]);
		}
		var $i=0;
		$(".jqg-second-row-header").children().each(function()
		{
			$(this).css("background",bgColorArray[$i]);
			$(this).css("color",fontColorArray[$i]);
			$i++;	
		});
	});
	var dataStr = <?php echo $jsonStr?>;
		var rotateFunction = function (grid, headerHeight) {
    	  // we use grid as context (if one have more as one table on the page)
    	 	var trHead = $("thead:first tr", grid.hdiv),
            cm = grid.getGridParam("colModel"),
            iCol, cmi, headDiv
        headerHeight = $("thead:first tr th").height();
        for (iCol = 0; iCol < cm.length; iCol++) 
        {
            cmi = cm[iCol];
            // prevent text cutting based on the current column width
            headDiv = $("th:eq(" + iCol + ") div", trHead);
            headDiv.width(headerHeight)
           .addClass("rotate")
           .css("left",3);
        }
        /*trHead = $("thead:second tr", grid.hdiv)
        headerHeight = $("thead:second tr th").height();
        for (iCol = 0; iCol < cm.length; iCol++) 
        {
            cmi = cm[iCol];
            // prevent text cutting based on the current column width
            headDiv = $("th:eq(" + iCol + ") div", trHead);
            headDiv.width(headerHeight)
           .addClass("rotate")
           .css("left",3);
        }*/
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
	var table = "<?php if(isset($_REQUEST['table_result'])){echo $_REQUEST['table_result'];}?>";
	var head_col_width = 50;
	//alert(table);
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
                var rowHight = $($rows[i]).height(); 
                var rowHightFrozen = $(this).height();
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
        //resizeSpanHeight = 'height: ' + headerRow.height() + 'px !important; cursor: col-resize;';
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
    colNames:['','<div id="frmCntr_2">From</div><div id="toCntr_2" class="rotate">To</div>',
    <?php
      for ($i = 0; $i < count($neurons_with_links); $i++) {
        echo '"'.$neurons_with_links[$i].'"';
        if ($i != count($neurons_with_links)-1) {
          echo ", ";
        }
      }
    ?>
    ],
    colModel :[
	  {name:'type', index:'type', width:50,sortable:false,frozen:true,cellattr: function (rowId, tv, rawObject, cm, rdata) {
          return 'id=\'type' + rowId + "\'" + ' style="height:75px;"';  
      }, frozen:true},
      {name:'Neuron_Type_2', index:'Neuron_Type_2', width:200,sortable:false,frozen:true,
      cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
          return 'style="height:75px;"';
       }
   	  },
      //{name:'Supertype', index:'supertype', width:300,sortable:false,hidden: true},
          //,searchoptions: {sopt: ['bw','bn','cn','in','ni','ew','en','nc']}},
      <?php
        for ($i = 0; $i < count($neuron_IDs); $i++) {
          $neuron = str_replace(' ', '_', $neuron_IDs[$i]);
          echo "{name:'".$neuron."', index:'".$neuron."', width:head_col_width,search:false,sortable:false}";
          if ($i != count($neuron_IDs)-1) {
            echo ", ";
          }
        }
      ?>      
 	], 
    //multiselect: true,
   /* pager: '#pager',*/
    rowNum:122,
    rowList:[122],
   /*  sortname: 'invid',
    sortorder: 'desc',*/
    viewrecords: true, 
    gridview: true,
    jsonReader : {
      page: "page",
      total: "total",
      records: "records",
      root:"rows",
      repeatitems: true,
      onSelectRow: function() {
    	     return false;
    	},
      cell:"cell",
      id: "invid"
   },
    //caption: 'Morphology Matrix',
    scrollerbar:true,
    shrinkToFit:false,
    height:"440",
    //width:"60%",
    width:"1050",
    gridComplete: function () {
    	var gridName = "nGrid"; // Access the grid Name
    	Merger(gridName,"type");
    	 $grid.jqGrid('setFrozenColumns');
    	 rotateFunction($grid,235); 
    	 fixPositionsOfFrozenDivs.call($grid[0]);    	
		}
    });
	jQuery("#nGrid").jqGrid('setGroupHeaders', { useColSpanStyle: true, 
		groupHeaders:[ 
		{startColumnName: 'Type', numberOfColumns: 2, titleText: '<b>Neuron Type<b>'},
		{startColumnName: 'Granule', numberOfColumns: 18, titleText: '<b><a id="dg_subregion" href="parcel_page.php?subregion=DG&type=subregion" onClick="OpenInNewTab(this);">DG</a><b>', ID: 'test',
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
            return ' style="background: rgb(119, 0, 0) !important;"';
       }},
		{startColumnName: 'CA3_Pyramidal', numberOfColumns: 25, titleText: '<b><a id="ca3_subregion" href="parcel_page.php?subregion=CA3&type=subregion" onClick="OpenInNewTab(this);">CA3</a></b>'},
		{startColumnName: 'CA2_Pyramidal', numberOfColumns: 5, titleText: '<b><a id="ca2_subregion" href="parcel_page.php?subregion=CA2&type=subregion" onClick="OpenInNewTab(this);">CA2</a></b>'},
		{startColumnName: 'CA1_Pyramidal', numberOfColumns: 40, titleText: '<b><a id="ca1_subregion" href="parcel_page.php?subregion=CA1&type=subregion" onClick="OpenInNewTab(this);">CA1</a></b>'},
		{startColumnName: 'SUB_EC-Proj_Pyramidal', numberOfColumns: 3, titleText: '<b><a id="sub_subregion" href="parcel_page.php?subregion=SUB&type=subregion" onClick="OpenInNewTab(this);">SUB</a></b>'},
		{startColumnName: 'LI-II_Multipolar-Pyramidal', numberOfColumns: 31, titleText: '<b><a id="ec_subregion" href="parcel_page.php?subregion=EC&type=subregion" onClick="OpenInNewTab(this);">EC</a></b>'}
		] 
	});
  <?php include('synap_prob/nbyn_css_mods.php'); ?>
  
	if(checkVersion()=="9")
	{
		$("#jqgh_nGrid_Granule").addClass("rotateIE9");
	}
	else
	{
		$("#jqgh_nGrid_Granule").addClass("rotate");
    }
	
  <?php
    /*
    for ($i = 0; $i < count($neuron_IDs); $i++) {
      $neuron = str_replace(' ', '_', $neuron_IDs[$i]); //replace spaces
      echo "$('#jqgh_nGrid_".$neuron."').addClass('header_adjust');";
      echo "$('#jqgh_nGrid_".$neuron."').css('height','30');";
    }
    */
  ?>
	
	var bgColorArray = ["","","#770000","#C08181","#FFFF99","#FF6103","#FFCC33","#336633",""];
	var fontColorArray = ["","","#FFFFFF","#FFFFFF","#000099","#000099","#000099","#FFFFFF",""];
	var $i=0;
	$(".jqg-second-row-header").children().each(function()
	{
		$(this).css("background",bgColorArray[$i]);
		$(this).css("color",fontColorArray[$i]);
		$i++;	
	});

var cm = $("#nGrid").jqGrid('getGridParam', 'colModel');
	
 $("#nGrid").mouseover(function(e) {

	var count = $("#nGrid").jqGrid('getGridParam', 'records') + 1;
    var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
        rowId = $tr.attr('id');
    
   	if (rowId) {
        var ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
		$row = "#"+rowId+" td"; 
		$($row).addClass('highlighted_top');
	}
});
$("#nGrid").mouseout(function(e) {
	var count = $("#nGrid").jqGrid('getGridParam', 'records') + 1;
    var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
        rowId = $tr.attr('id'), ci;
   	if (rowId) {
        ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
        $row = "#"+rowId+" td";  
		$($row).removeClass('highlighted_top');
	}
}); 
});

</script>

<!-- ************* End of Matrix Section ************* -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Synaptic Physiology</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>		

<div class='title_area' style='width:1500px !important'>
<form name="main_matrix_selection" method="post" action=""> 
  <table><tr><td><font class="font1">Browse synaptic parameters</font></td><td>&nbsp;&nbsp;</td><td><font class="font3"><center>Model Parameters:</font></td><td></td><td><font class="font3"><center>Species:</center></font></td><td><font class="font3"><center>Sex:</center></font></td><td><font class="font3"><center>Age:</center></font></td><td><font class="font3"><center>Temperature:</center></font></td><td><font class="font3"><center>Recording Mode (-60 mV):</center></font></td><td><font class="font3"><center>Submit:</center></font></td></tr>
  	<tr><td></td><td>&nbsp;&nbsp;</td><td><center>
<?php
$current_value = '';
if (isset($_REQUEST['value_selection'])) {
	$current_value = $_REQUEST['value_selection'];
}
if ($current_value == '' || $current_value == 'g') {$sel1='selected';}
else if ($current_value == 'tau_d') {$sel2='selected';}
else if ($current_value == 'tau_r') {$sel3='selected';}
else if ($current_value == 'tau_f') {$sel4='selected';}
else if ($current_value == 'u') {$sel5='selected';}
echo "<select name='value_selection' size='1'>;";
echo "<option value='g' $sel1>G</option>";
echo "<option value='tau_d' $sel2>𝛕<sub>D</sub></option>";
echo "<option value='tau_r' $sel3>𝛕<sub>R</sub></option>";
echo "<option value='tau_f' $sel4>𝛕<sub>F</sub></option>";
echo "<option value='u' $sel5>U</option>";
echo "</select></center>";
echo "</td><td><font class='font3'><center>Conditions:</center></font></td><td><center>";
if (isset($_REQUEST['param_1'])) {
	$param1_value = $_REQUEST['param_1'];
}
if ($param1_value == '' || $param1_value == 'Rat') {$sel1='selected';}
else if ($param1_value == 'Mouse') {$sel2='selected';}
echo "<select name='param_1' size='1'>";
echo "<option value='Rat' $sel1>Rat</option>";
echo "<option value='Mouse' $sel2>Mouse</option>";
echo "</select></center></td><td><center>";
if (isset($_REQUEST['param_2'])) {
	$param2_value = $_REQUEST['param_2'];
}
if ($param2_value == '' || $param2_value == 'Male') {$sel1='selected';}
else if ($param2_value == 'Female') {$sel2='selected';}
echo "<select name='param_2' size='1' onChange=''>";
echo "<option value='Male' $sel1>Male</option>";
echo "<option value='Female' $sel2>Female</option>";
echo "</select></center></td><td><center>";
if (isset($_REQUEST['param_3'])) {
	$param3_value = $_REQUEST['param_3'];
}
if ($param3_value == '' || $param3_value == 'P14') {$sel1='selected';}
else if ($param3_value == 'P56') {$sel2='selected';}
echo "<select name='param_3' size='1' onChange=''>";
echo "<option value='P14' $sel1>P14</option>";
echo "<option value='P56' $sel2>P56</option>";
echo "</select></center></td><td><center>";
if (isset($_REQUEST['param_4'])) {
	$param4_value = $_REQUEST['param_4'];
}
if ($param4_value == '' || $param4_value == 'T22') {$sel1='selected';}
else if ($param4_value == 'T32') {$sel2='selected';}
echo "<select name='param_4' size='1' onChange=''>";
echo "<option value='T22' $sel1>22 Celcius</option>";
echo "<option value='T32' $sel2>32 Celcius</option>";
echo "</select></center></td><td><center>";
if (isset($_REQUEST['param_5'])) {
	$param5_value = $_REQUEST['param_5'];
}
if ($param5_value == '' || $param5_value == 'Vh=-60') {$sel1='selected';}
else if ($param5_value == 'Vss=-60') {$sel2='selected';}
echo "<select name='param_5' size='1' onChange=''>";
echo "<option value='Vh=-60' $sel1>Voltage-clamp</option>";
echo "<option value='Vss=-60' $sel2>Current-clamp</option>";
echo "</select></center></td><td>";
echo "<input type='submit' value='Update' style='height:20px;' />";
?>
</td></tr>
</form>
</table>
</div>

<div class='table_position' style='position:relative;top:7em;'>
<table border="0" cellspacing="0" cellpadding="0" class="tabellauno">
	<tr>
		<td>
			<table id="nGrid"></table>
		</td>
  <?php echo file_get_contents('synap_model/footer_1.php');?>
  <tr height="20">
        <td style="float:right"><!--a href='synap_prob/data/nops_values.csv'--><img id='csvCN' src='synap_prob/media/ExportCSV.png' width='30px' border='0'/><!--/a--></td><td><span style='float:left'><font class='font5'>&nbsp;To be added later</font></span></td> 
      </tr> 
	<?php echo file_get_contents('synap_model/footer_2.php');?>
  </tr>
</table>
</div>
</body>
</html>