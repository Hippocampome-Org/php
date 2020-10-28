<?php
session_start();
include("permission_check.php");
?>
<!--
  reference: https://stackoverflow.com/questions/1291152/simple-way-to-calculate-median-with-mysql
  -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="style/resolution.js"></script>
<link rel="stylesheet" href="function/menu_support_files/menu_main_style.css" type="text/css" />
<script src="jqGrid-4/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="jqGrid-4/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="jqGrid-4/js/jquery.jqGrid.src.js" type="text/javascript"></script>
<script src="jquery-ui-1.10.2.custom/js/jquery.jqGrid.src-custom.js" type="text/javascript"></script>
<?php
require_once("load_matrix_session_phases.php");
$jsonStr = $_SESSION['Phases'];
$color_selected ='#EBF283';
$research = $_REQUEST['research'];
$hippo_select = $_SESSION['hippo_select'];

$conditions = "";
include("phases/update_values.php");
if (isset($_GET['page']) && $_GET['page']=="main_page") {
  include("phases/gen_json/generate_json.php");
}
?>

<?php 
  /* set json data to load */
  $matrix_type = "phases";
  if (isset($_GET['page']) && $_GET['page']=="main_page") {
    $jsonStr = $json_output_string;
  }
  else {
    $session_matrix_cache_file = "phases/gen_json/json_files/phases.json";
    $_SESSION[$matrix_type] = file_get_contents($session_matrix_cache_file);
    $jsonStr = $_SESSION[$matrix_type]; 
  }
?>

<style>

.highlighted{
	border-right: solid 1px Chartreuse !important;
	border-left: solid 1px Chartreuse !important;
	border-bottom:solid 1px Chartreuse !important; 
}
.highlighted_top{
	border: solid 1px Chartreuse !important;
}
.rotate 
{
    -webkit-transform: rotate(-90deg);    /* Safari 3.1+, Chrome */
    -moz-transform: rotate(-90deg);    /* Firefox 3.5+ */
    -o-transform: rotate(-90deg); /* Opera starting with 10.50 */
    /* Internet Explorer: */
    /*filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3); /* IE6, IE7 */
   /*-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)" /* IE8 */
   -ms-transform: rotate(-90deg);
   left:8px;
   font-size:11px;
   font-weight:bold;
   padding:0px;
   font:Verdana;
}
.rotateIE9 
{
    -webkit-transform: rotate(-90deg);    /* Safari 3.1+, Chrome */
    -moz-transform: rotate(-90deg);    /* Firefox 3.5+ */
    -o-transform: rotate(-90deg); /* Opera starting with 10.50 */
    /* Internet Explorer: */
   /* filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3); /* IE6, IE7 */
   /*-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)" /* IE8 */
   -ms-transform: rotate(-90deg);
   left:8px;
   font-size:11px;
   font-weight:bold;
   padding:0px;
   font:Verdana;
}
#nGrid_H,#nGrid_SO,#nGrid_2_SO,#nGrid_1_SO,#nGrid_SUB_PL
{
	border-right:medium solid #C08181;
	width:auto !important;
}
#nGrid_SLM,#nGrid_2_SLM,#nGrid_1_SLM,#nGrid_SUB_SM,#nGrid_I
{
	border-left:medium solid #770000;
	width:auto !important;
}
.ui-jqgrid {
    font-size: 11px !important;
}
</style>
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui.jqgrid_morph.css" />
<script language="javascript">
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

	var dataStr = <?php echo $jsonStr; ?>;
	function Merger(gridName,cellName){
		var mya = $("#" + gridName + "").getDataIDs();	
		var rowCount = mya.length;
		//alert(mya.length);
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
					$("#" + gridName + "").setCell(mya[j], cellName);
					$("tr#"+j+" td#type"+j).css("border-bottom","none");
					if(rowSpanCount > 1) // For the first row Don't delete the cell and its contents
					{ 
						$("tr#"+j+" td#type"+j).css("border-bottom","none");
					}
					else
					{
						firstElement = j;
					}
					//$("#" + cellName + "" + mya[i] + "").attr("rowSpan",rowSpanCount);
					rowSpanCount++;	
                } 
                else 
                {
					/* if(rowSpanCount > 1) // Condition to check if there is a single row and no rowspan is needed
					{
                		//$("tr#"+j+" td#type"+j).remove();
                		//$("#" + cellName + "" + mya[i] + "").attr("rowSpan",rowSpanCount);
                		$("tr#"+j).css("border-bottom", "2px red");
					}
					else */
					/* { */
						$("tr#"+j).css("border-bottom", "2px red");
					/* } */
                    countRows = rowSpanCount;
                	rowSpanCount = 1;
                	break;
                }
			}
			//$("tr#"+firstElement).css("border-bottom", "2px red");
		} 
	}
	
	var research = "<?php echo $research?>";
	var table = "<?php if(isset($_REQUEST['table_result'])){echo $_REQUEST['table_result'];}?>";
	//alert(table);
  console.log(dataStr);
	$("#nGrid").jqGrid({
	datatype: "jsonstring",
	datastr: dataStr,
    //mtype: 'GET',
   /*  ajaxGridOptions :{
		contentType : "application/json"
        }, */
    //jsonReader: { repeatitems: false },
    /* \: {
        researchVar: research,
        table_result : table
    } */
    colNames:['','Neuron Type','<a title=\'Phase-locking values with respect to the theta rhythm with a peak at zero degrees and calibrated to CA1 SP.\'>Theta (deg)</a>','<a title=\'Ratio of the firing rate during sharp wave ripples to the firing rate outside of SWR.\'>SWR ratio</a>','<a title=\'Miscellaneous secondary rhythm measurements.\'>Other</a>']
    ,colModel :[
	   {name:'type', index:'type', width:50,sortable:false, cellattr: function (rowId, tv, rawObject, cm, rdata) {
          return 'id=\'type' + rowId + "\'";   
      } },
      {name:'NeuronType', index:'nickname', width:175,sortable:false},
      {name:'Theta', index:'theta', width:75,search:false,sortable:false},
      {name:'SWR ratio', index:'SWRratio', width:75,search:false,sortable:false},
      {name:'Other', index:'other', width:75,search:false,sortable:false,title:'test'}
	], 
   
    rowNum:122,
    rowList:[122],
  
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
    scrollerbar:false,
    height:"450",
    width:"900",
    shrinkToFit: true,
    gridComplete: function () {
    	var gridName = "nGrid"; // p the grid Name
    	Merger(gridName,"type");
      HideShowColumns();
		}
    });

  
 /* if(checkVersion()=="9")
  {
    var myGrid = $('#nGrid');
    var colModelVal = $("#nGrid").jqGrid('getGridParam','colModel');
    var colModelName = "";
    for(var i=11;i<=53;i++)
    {
      colModelName = "#jqgh_nGrid_"+colModelVal[i].name;
      $(colModelName).addClass("rotateIE9");
    } 
  }
  else
  {
    var myGrid = $('#nGrid');
    var colModelVal = $("#nGrid").jqGrid('getGridParam','colModel');
    var colModelName = "";
    var htmlAttri =  "top: 105px !important";
    for(var i=11;i<=53;i++)
    {
      colModelName = "#jqgh_nGrid_"+colModelVal[i].name;
      $(colModelName).addClass("rotate");
    }
  }*/
  $("#nGrid_CB").css("height","80");
	var bgColorArray = ["","","","#770000","#C08181","#FFFF99","#FF6103","#FFCC33","#336633"];
	var fontColorArray = ["","","","#FFFFFF","#FFFFFF","#000099","#000099","#000099","#FFFFFF"];
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

		/* for(var i=0;i<count;i++)
		{
			$colSelected = "tr#"+i+" td:eq("+ci+")";
			$($colSelected).addClass('highlighted');
			
		}  */
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
		/* for(var i=0;i<count;i++)
		{
			$colSelected = "tr#"+i+" td:eq("+ci+")";
			$($colSelected).removeClass('highlighted');
		}  */
	}
}); 
});

function HideShowColumns ()
{

  var customWidth = screen.availWidth-300;
  var myGrid = $("#nGrid");
    $(document).ready(function() {
    myGrid.jqGrid('setGridParam', {scrollerbar: true});
    myGrid.jqGrid('setColProp', 'type', {frozen: true });
    myGrid.jqGrid('setColProp', 'NeuronType', {frozen: true })
    myGrid.jqGrid('setFrozenColumns');
    myGrid.jqGrid('setGridParam', {shrinkToFit: false});
  
  //myGrid.jqGrid('setGridParam', {autowidth: true});
});
  $("#checkbox1").click(function() {
  
      myGrid.jqGrid('destroyFrozenColumns')
      myGrid.jqGrid('showCol', ["theta"]);
      myGrid.jqGrid('showCol', ["SWRratio"]);
      myGrid.jqGrid('showCol', ["other"]);
      myGrid.setGridWidth("900",true);
      //myGrid.jqGrid('setGridParam', {autowidth: true});
      myGrid.jqGrid('setGridParam', {shrinkToFit: true});
      myGrid.jqGrid('setGridParam', {scrollerbar: true});
     
    }
  );

}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Phases</title>
<script type="text/javascript" src="style/resolution.js"></script>
<script type = "text/javascript">
  function unselect_all() {
    window.location = "phases.php?page=main_page";
  }
  function select_all() {
    //window.location = "phases.php?selectall=true";
    window.location = "phases.php?species_check1=checked&age_check1=checked&sex_check1=checked&method_check1=checked&behavior_check1=checked&species_check2=checked&age_check2=checked&sex_check2=checked&method_check2=checked&behavior_check2=checked&age_check3=checked&sex_check3=checked&method_check3=checked&behavior_check3=checked&method_check4=checked&behavior_check4=checked&method_check5=checked&behavior_check5=checked&method_check6=checked&behavior_check6=checked&behavior_check7=checked&behavior_check8=checked&page=main_page&row_select=";
  }  
  function select_preferred() {
    neuron_number = <?php echo count($neuron_ids) ?>;
    for (let i = 1; i < (neuron_number+1); i++) {
      // check for highlight
      if (document.getElementById(i).className.includes("ui-state-highlight")) {
        document.getElementById('row_select').value=i;
      }
    }
    <?php
      for ($i=0;$i<count($checkbox_group);$i++) {
        echo "document.getElementById('".$checkbox_group[$i]."').value=\"checked\";\n";
        $_GET['".$checkbox_group[$i]."']="checked";
      }
    ?>
  }
  function subform() {
    <?php if (isset($_GET['select_check2']) && $_GET['select_check2']=="checked") {
      echo "select_preferred();";
    }?>
    document.getElementById('supertypeForm').submit();
  }
</script>
<?php
  if (!isset($_GET['page'])) {
    echo "<script>select_all();</script>";
  }
  if (isset($_GET['select_check3']) && $_GET['select_check3']=="checked") {
    echo "<script>unselect_all();</script>";
  }
  else if (isset($_GET['select_check1']) && $_GET['select_check1']=="checked") {
    echo "<script>select_all();</script>";
  }

  function is_checked($checkbox) {
    if (isset($_GET[$checkbox]) && $_GET[$checkbox]=="checked") {
      if (isset($_GET['select_check3']) && $_GET['select_check3']=="checked") {
        // return nothing
      }
      else {
        echo "checked";
      }
    }
    else if (isset($_GET['select_check1']) && $_GET['select_check1']=="checked" && $checkbox != "select_check2" && $checkbox != "select_check3") {
      if (isset($_GET['select_check3']) && $_GET['select_check3']=="checked") {
        // return nothing
      }
      else {      
        echo "checked"; 
      }
    }
    else if ($_GET['page']==null && $checkbox != "select_check1" && $checkbox != "select_check2" && $checkbox != "select_check3") {
      echo "checked"; 
    }
    else if (isset($_GET['selectall']) && $_GET['selectall']=="true" && $checkbox != "select_check1" && $checkbox != "select_check2" && $checkbox != "select_check3") {
      echo "checked"; 
    }
  }
?>

</head>

<body>
<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>		

<div class='title_area'>
  <form id='supertypeForm'>
    <font id= "title" class="font1">&nbsp;<span style="font-size:13px">&nbsp;</span>Browse Phases Matrix</font>
    <br>
    <table style='width:1000px;font-family:arial;font-size:18px'>
    <tr><td style="width:150px">&nbsp;&nbsp;<u>Animal</u></td><td style="width:200px">&nbsp;&nbsp;<u>Age</u></td><td style="width:150px">&nbsp;&nbsp;<u>Sex</u></td><td style="width:250px">&nbsp;&nbsp;<u>Method</u></td><td style="width:450px">&nbsp;&nbsp;<u>Behavior</u></td></tr>
    <tr><td><input type="checkbox" name="species_check1" value="checked" id="species_check1" <?php is_checked("species_check1") ?>><span>rats</span></td><td><input type="checkbox" name="age_check1" value="checked" id="age_check1" <?php is_checked("age_check1") ?>><span>adult</span></td><td><input type="checkbox" name="sex_check1" value="checked" id="sex_check1" <?php is_checked("sex_check1") ?>><span>male</span></td><td><input type="checkbox" name="method_check1" value="checked" id="method_check1" <?php is_checked("method_check1") ?>><span>sharp pipette</span></td><td><input type="checkbox" name="behavior_check1" value="checked" id="behavior_check1" <?php is_checked("behavior_check1") ?>><span>freely moving</span></td></tr>
    <tr><td><input type="checkbox" name="species_check2" value="checked" id="species_check2" <?php is_checked("species_check2") ?>><span>mice</span></td><td><input type="checkbox" name="age_check2" value="checked" id="age_check2" <?php is_checked("age_check2") ?>><span>young adult</span></td><td><input type="checkbox" name="sex_check2" value="checked" id="sex_check2" <?php is_checked("sex_check2") ?>><span>female</span></td><td><input type="checkbox" name="method_check2" value="checked" id="method_check2" <?php is_checked("method_check2") ?>><span>whole-cell patch clamp</span></td><td><input type="checkbox" name="behavior_check2" value="checked" id="behavior_check2" <?php is_checked("behavior_check2") ?>><span>head-fixed awake</span></td></tr>
    <tr><td></td><td><input type="checkbox" name="age_check3" value="checked" id="age_check3" <?php is_checked("age_check3") ?>><span>not reported</span></td><td><input type="checkbox" name="sex_check3" value="checked" id="sex_check3" <?php is_checked("sex_check3") ?>><span>unknown sex</span></td><td><input type="checkbox" name="method_check3" value="checked" id="method_check3" <?php is_checked("method_check3") ?>><span>juxtacellular</span></td><td><input type="checkbox" name="behavior_check3" value="checked" id="behavior_check3" <?php is_checked("behavior_check3") ?>><span>REM sleep</span></td></tr>
    <tr><td></td><td></td><td></td><td><input type="checkbox" name="method_check4" value="checked" id="method_check4" <?php is_checked("method_check4") ?>><span>optotagging</span></td><td><input type="checkbox" name="behavior_check4" value="checked" id="behavior_check4" <?php is_checked("behavior_check4") ?>><span>urethane</span></td></tr>
    <tr><td></td><td></td><td></td><td><input type="checkbox" name="method_check5" value="checked" id="method_check5" <?php is_checked("method_check5") ?>><span>silicon probe</span></td><td><input type="checkbox" name="behavior_check5" value="checked" id="behavior_check5" <?php is_checked("behavior_check5") ?>><span>urethane plus ketamine + xylazine</span></td></tr>
    <tr><td></td><td></td><td></td><td><input type="checkbox" name="method_check6" value="checked" id="method_check6" <?php is_checked("method_check6") ?>><span>tetrode</span></td><td><input type="checkbox" name="behavior_check6" value="checked" id="behavior_check6" <?php is_checked("behavior_check6") ?>><span>ketamine + xylazine</span></td></tr>
    <tr><td><input type="checkbox" name="select_check1" value="checked" id="select_check1" <?php is_checked("select_check1") ?>><span>select all</span></td><td><input type="checkbox" name="select_check2" value="checked" id="select_check2" onclick="javascript:select_preferred()"><span>
      <a title="Show the preferred conditions for the values in a selected row.
Select a row, click this checkbox, then click update." style="text-decoration: none">
    &nbsp;&nbsp;&nbsp;select most<center>preferred conditions</a></span></center></td><td></td><td></td><td><input type="checkbox" name="behavior_check7" value="checked" id="behavior_check7" <?php is_checked("behavior_check7") ?>><span>ketamine + xylazine plus acepromazine</span></td></tr>
    <tr><td><input type="checkbox" name="select_check3" value="checked" id="select_check3" <?php is_checked("select_check3") ?>><span>deselect all</span></td><td></td><td></td><td></td><td><input type="checkbox" name="behavior_check8" value="checked" id="behavior_check8" <?php is_checked("behavior_check8") ?>><span>head-fixed running</span></td></tr>
    </table>
    <span style='width:1000px'><input type='button' value='update' onclick='javascript:subform()' style='position:relative;left:410px' /></span>
    <input type="hidden" name="page" id="page" value="main_page" />
    <input type="hidden" name="row_select" id="row_select" value="<?php if(isset($_GET['row_select'])) {echo $_GET['row_select'];} ?>" />
  </form>
</div>

<div class='table_position' style='position:relative;top:375px;'>
<table border="0" cellspacing="0" cellpadding="0" class="tabellauno">
	<tr>
		<td>
			<table id="nGrid"></table>
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>  
  <tr>
    <td>
		  <font class='font5'><strong>Legend:</strong> </font>&nbsp; &nbsp;
    </td>
	   <!-- &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; -->
		<td><font face="Verdana, Arial, Helvetica, sans-serif" color="#339900" size="2"> +/green: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Excitatory</font></td>
		&nbsp; &nbsp; 
		<td><font face="Verdana, Arial, Helvetica, sans-serif" color="#CC0000" size="2"> -/red: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Inhibitory</font></td>
     <tr></tr>
      <tr>
        <td></td>
        <td>
    </td>
		<tr>
		</tr>
	
</table>
</div>
<?php
  /*
    Update checkbox selection based on preferred conditions.
  */
  if (isset($_GET['row_select']) && $_GET['row_select'] != "") {
    sleep(2);
    $selected_conditions = array();
    $selected_indices = array();
    $i_r = $_GET['row_select'] - 1;//$_GET['row_select'];
    $selected_string = "";

    //echo "<script>\nsetTimeout(() => {\n";
    echo "<script>";

    // collect conditions
    for ($i = 0; $i < count($best_ranks_theta); $i++) {
      array_push($selected_conditions, $best_ranks_theta[$i_r][$i]);
      if ($best_ranks_theta[$i_r][$i] == "male and female") {
        array_push($selected_conditions, "male");
        array_push($selected_conditions, "female");
      }
      if ($best_ranks_theta[$i_r][$i] == "REM sleep") {
        array_push($selected_conditions, "REM"); 
      }
      //echo $best_ranks_theta[$i_r][$i]."<br>\n";
    }
    for ($i = 0; $i < count($best_ranks_swr); $i++) {
      array_push($selected_conditions, $best_ranks_swr[$i_r][$i]);
      if ($best_ranks_swr[$i_r][$i] == "male and female") {
        array_push($selected_conditions, "male");
        array_push($selected_conditions, "female");
      }
      if ($best_ranks_swr[$i_r][$i] == "REM sleep") {
        array_push($selected_conditions, "REM"); 
      }
      //echo $best_ranks_swr[$i_r][$i]."<br>\n";
    }

    // check boxes
    $first_found = false;
    for ($i = 0; $i < count($selected_conditions); $i++) {
      for ($j = 0; $j < count($checkbox_values); $j++) {
        if ($selected_conditions[$i] == $checkbox_values[$j]) {
          //echo "document.getElementById(\"".$checkbox_group[$j]."\").value=\"checked\";\n";
          //array_push($selected_indices, $j);
          if ($first_found == false) {
            $selected_string = $selected_string.$checkbox_group[$j]."=checked";
            $first_found = true;
          }
          else {
            $selected_string = $selected_string."&".$checkbox_group[$j]."=checked";
          }
        }
      }
    }
    $redirect_page = "phases.php?".$selected_string."&page=main_page";
    echo "window.location = \"$redirect_page\"";

    // uncheck boxes
    /*for ($i = 0; $i < count($checkbox_values); $i++) {
      if (!in_array($i, $selected_indices)) {
        echo "document.getElementById(\"".$checkbox_group[$i]."\").value=\"\";\n";
      }
    }*/

    //echo "}, 4000);\n</script>\n";
    echo "</script>\n";
  }
?>
</body>
</html>
<?php
mysqli_close($GLOBALS['conn']);
echo "<script>console.log('Is conn set ? ".mysqli_ping($GLOBALS['conn'])."');</script>";
?>