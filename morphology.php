<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");

include ("access_db.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.temporary_result_neurons.php');
// FUNCTIONS -------------------------------------------------------------------------------
// Check the UNVETTED color: ***************************************************************************
function check_unvetted1($id, $id_property, $evidencepropertyyperel)
{

	$evidencepropertyyperel -> retrive_unvetted($id, $id_property);
	$unvetted1 = $evidencepropertyyperel -> getUnvetted();
	return ($unvetted1);
}
// *****************************************************************************************************
function check_color($variable, $unvetted)
{
	if ($variable == 'red')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/axons_present_unvetted.png' border='0'/>";
		else
			$link[0] = "<img src='images/morphology/axons_present.png' border='0'/>";
		
		$link[1] = $variable;
	
	}
	if ($variable == 'blue')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/dendrites_present_unvetted.png' border='0'/>";	
		else	
			$link[0] = "<img src='images/morphology/dendrites_present.png' border='0'/>";	
		
		$link[1] = $variable;
	}
	if ($variable == 'violet')
	{
		if ($unvetted == 1)
			$link[0] = "<img src='images/morphology/somata_present_unvetted.png' border='0'/>";
		else	
			$link[0] = "<img src='images/morphology/somata_present.png' border='0'/>";
		$link[1] = $variable;
	}
	if ($variable == NULL)
	{
		$link[0] = "<img src='images/blank_morphology.png' border='0'/>";
		$link[1] = $variable;
	}	
	
	return ($link);
}
function check_axon_dendrite($variable, $hippo_axon, $hippo_dendrite)
{
	if (($hippo_axon[$variable] == 1) && ($hippo_dendrite[$variable] == 1))
		$result = 'violet';
	if (($hippo_axon[$variable] == 1) && ($hippo_dendrite[$variable] == 0))
		$result = 'red';
	if (($hippo_axon[$variable] == 0) && ($hippo_dendrite[$variable] == 1))
		$result = 'blue';

	return ($result);
}	
// ------------------------------------------------------------------------------------------
$color_selected ='#EBF283';
$type = new type($class_type);
$research = $_REQUEST['research'];
if ($research) // From page of search; retrieve the id from search_table (temporary) -----------------------
{
	$table_result = $_REQUEST['table_result'];

	$temporary_result_neurons = new temporary_result_neurons();
	$temporary_result_neurons -> setName_table($table_result);

	$temporary_result_neurons -> retrieve_id_array();
	$n_id_res = $temporary_result_neurons -> getN_id();

	$number_type = 0;
	for ($i2=0; $i2<$n_id_res; $i2++)
	{
		$id2 = 	$temporary_result_neurons -> getID_array($i2);
		
		if (strpos($id2, '0_') == 1);
		else
		{
			$type -> retrive_by_id($id2);
			$status = $type -> getStatus();
			
			if ($status == 'active')
			{
				$id_search[$number_type] = $id2;
				$position_search[$number_type] = $type -> getPosition();
				$number_type = $number_type + 1;
			}		
		}	
	} // END $i2
	array_multisort($position_search, $id_search);
	// sort($id_search);								
}
else // not from search page --------------
{
	$type -> retrive_id();
	$number_type = $type->getNumber_type();
}
// -------------------------------------------------------------------------------------------------------------
$property = new property($class_property);
$evidencepropertyyperel = new evidencepropertyyperel($class_evidence_property_type_rel);
$hippo_select = $_SESSION['hippo_select'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.highlighted{
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
</style>
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" />
<script language="javascript">

function ctr(select_nick_name2, color, select_nick_name_check)
{
	if (document.getElementById(select_nick_name_check).checked == false)
	{	
		document.getElementById(select_nick_name2).bgColor = "#FFFFFF";
		
	}
	else if (document.getElementById(select_nick_name_check).checked == true)
		document.getElementById(select_nick_name2).bgColor = "#EBF283";	
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
<script src="jqGrid/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="jqGrid/js/jquery.jqGrid.src.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
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
	var table = "<?php echo $_REQUEST['table_result']?>";
	//alert(table);
	$("#nGrid").jqGrid({
    url:'getMorphology.php',
    datatype: 'json',
    mtype: 'GET',
    ajaxGridOptions :{
		contentType : "application/json"
        },
    postData: {
        researchVar: research,
        table_result : table
    },
    colNames:['','Neuron Type','SMo','SMi','SG','H','SLM','SR','SL','SP','SO','SLM','SR','SP','SO','SLM','SR','SP','SO','SM','SP','PL','I','II','III','IV','V','VI'],
    colModel :[
	  {name:'type', index:'type', width:50,sortable:false,cellattr: function (rowId, tv, rawObject, cm, rdata) {
          return 'id=\'type' + rowId + "\'";   
      } },
      {name:'Neuron type', index:'nickname', width:200,sortable:false},
          //,searchoptions: {sopt: ['bw','bn','cn','in','ni','ew','en','nc']}},
      {name:'SMo', index:'DG_SMo', width:15,search:false,sortable:false},
      {name:'SMi', index:'DG_SMi', width:15,height:150,search:false,sortable:false},
      {name:'SG', index:'DG_SG', width:15,height:150,search:false,sortable:false},
      {name:'H', index:'DG_H', width:18,height:150,search:false,sortable:false, 
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
          return 'style="border-right:medium solid #C08181;"';
       }
      },
      {name:'SLM', index:'CA3_SLM', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
             return 'style="border-left:medium solid #770000;"';
       }},
      {name:'SR', index:'CA3_SR', width:15,height:150,search:false,sortable:false},
      {name:'SL', index:'CA3_SL', width:15,height:150,search:false,sortable:false},
      {name:'SP', index:'CA3_SP', width:15,height:150,search:false,sortable:false},
      {name:'SO', index:'CA3_SO', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
             return 'style="border-right:medium solid #C08181;"';
       }},
      {name:'2_SLM', index:'CA2_SLM', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
             return 'style="border-left:medium solid #770000;"';
       }},
      {name:'2_SR', index:'CA2_SR', width:15,height:150,search:false,sortable:false},
      {name:'2_SP', index:'CA2_SP', width:15,height:150,search:false,sortable:false},
      {name:'2_SO', index:'CA2_SO', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
             return 'style="border-right:medium solid #C08181;"';
       }},
      {name:'1_SLM', index:'CA1_SLM', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
             return 'style="border-left:medium solid #770000;"';
       }},
      {name:'1_SR', index:'CA1_SR', width:15,height:150,search:false,sortable:false},
      {name:'1_SP', index:'CA1_SP', width:15,height:150,search:false,sortable:false},
      {name:'1_SO', index:'CA1_SO', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
                return 'style="border-right:medium solid #C08181;"';
       }},
      {name:'SUB_SM', index:'SUB_SM', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
                return 'style="border-left:medium solid #770000;"';
       }},
      {name:'SUB_SP', index:'SUB_SP', width:15,height:150,search:false,sortable:false},
      {name:'SUB_PL', index:'SUB_PL', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
                   return 'style="border-right:medium solid #C08181;"';
       }},
      {name:'I', index:'EC_I', width:18,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
                   return 'style="border-left:medium solid #770000;"';
       }},
      {name:'II', index:'EC_II', width:15,height:150,search:false,sortable:false},
      {name:'III', index:'EC_III', width:15,height:150,search:false,sortable:false},
      {name:'IV', index:'EC_IV', width:15,height:150,search:false,sortable:false},
      {name:'V', index:'EC_V', width:15,height:150,search:false,sortable:false},
      {name:'VI', index:'EC_VI', width:28,height:150,search:false,sortable:false}
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
    height:"250",
    width:"60%",
    gridComplete: function () {
    	var gridName = "nGrid"; // Access the grid Name
    	Merger(gridName,"type");
		}
    });
	jQuery("#nGrid").jqGrid('setGroupHeaders', { useColSpanStyle: true, 
		groupHeaders:[ 
		/* {startColumnName: 'Type', numberOfColumns: 2, titleText: '<b>Neuron Type<b>'}, */
		{startColumnName: 'SMo', numberOfColumns: 4, titleText: '<b>DG(18)<b>'},
		{startColumnName: 'SLM', numberOfColumns: 5, titleText: '<b>CA3(25)</b>'},
		{startColumnName: '2_SLM', numberOfColumns: 4, titleText: '<b>CA2(5)</b>'},
		{startColumnName: '1_SLM', numberOfColumns: 4, titleText: '<b>CA1(40)</b>'},
		{startColumnName: 'SUB_SM', numberOfColumns: 3, titleText: '<b>SUB(3)</b>'},
		{startColumnName: 'I', numberOfColumns: 6, titleText: '<b>EC(31)</b>'}
		] 
	});
	//jQuery("#nGrid").jqGrid('navGrid','#pager',{search:true,edit:false,add:false,del:false});
	if(checkVersion()=="9")
	{
		$("#jqgh_nGrid_SMo").addClass("rotateIE9");
		$("#jqgh_nGrid_SMi").addClass("rotateIE9");
		$("#jqgh_nGrid_SG").addClass("rotateIE9");
		$("#jqgh_nGrid_H").addClass("rotateIE9");
		$("#jqgh_nGrid_SLM").addClass("rotateIE9");
		$("#jqgh_nGrid_SR").addClass("rotateIE9");
		$("#jqgh_nGrid_SL").addClass("rotateIE9");
		$("#jqgh_nGrid_SP").addClass("rotateIE9");
		$("#jqgh_nGrid_SO").addClass("rotateIE9");
		$("#jqgh_nGrid_2_SLM").addClass("rotateIE9");
		$("#jqgh_nGrid_2_SR").addClass("rotateIE9");
		$("#jqgh_nGrid_2_SP").addClass("rotateIE9");
		$("#jqgh_nGrid_2_SO").addClass("rotateIE9");
		$("#jqgh_nGrid_1_SLM").addClass("rotateIE9");
		$("#jqgh_nGrid_1_SR").addClass("rotateIE9");
		$("#jqgh_nGrid_1_SP").addClass("rotateIE9");
		$("#jqgh_nGrid_1_SO").addClass("rotateIE9");
		$("#jqgh_nGrid_SUB_SM").addClass("rotateIE9");
		$("#jqgh_nGrid_SUB_SP").addClass("rotateIE9");
		$("#jqgh_nGrid_SUB_PL").addClass("rotateIE9");
		$("#jqgh_nGrid_I").addClass("rotateIE9");
		$("#jqgh_nGrid_II").addClass("rotateIE9");
		$("#jqgh_nGrid_III").addClass("rotateIE9");
		$("#jqgh_nGrid_IV").addClass("rotateIE9");
		$("#jqgh_nGrid_V").addClass("rotateIE9");
		$("#jqgh_nGrid_VI").addClass("rotateIE9");
	}
	else
	{
		$("#jqgh_nGrid_SMo").addClass("rotate");
		$("#jqgh_nGrid_SMi").addClass("rotate");
		$("#jqgh_nGrid_SG").addClass("rotate");
		$("#jqgh_nGrid_H").addClass("rotate");
		$("#jqgh_nGrid_SLM").addClass("rotate");
		$("#jqgh_nGrid_SR").addClass("rotate");
		$("#jqgh_nGrid_SL").addClass("rotate");
		$("#jqgh_nGrid_SP").addClass("rotate");
		$("#jqgh_nGrid_SO").addClass("rotate");
		$("#jqgh_nGrid_2_SLM").addClass("rotate");
		$("#jqgh_nGrid_2_SR").addClass("rotate");
		$("#jqgh_nGrid_2_SP").addClass("rotate");
		$("#jqgh_nGrid_2_SO").addClass("rotate");
		$("#jqgh_nGrid_1_SLM").addClass("rotate");
		$("#jqgh_nGrid_1_SR").addClass("rotate");
		$("#jqgh_nGrid_1_SP").addClass("rotate");
		$("#jqgh_nGrid_1_SO").addClass("rotate");
		$("#jqgh_nGrid_SUB_SM").addClass("rotate");
		$("#jqgh_nGrid_SUB_SP").addClass("rotate");
		$("#jqgh_nGrid_SUB_PL").addClass("rotate");
		$("#jqgh_nGrid_I").addClass("rotate");
		$("#jqgh_nGrid_II").addClass("rotate");
		$("#jqgh_nGrid_III").addClass("rotate");
		$("#jqgh_nGrid_IV").addClass("rotate");
		$("#jqgh_nGrid_V").addClass("rotate");
		$("#jqgh_nGrid_VI").addClass("rotate");
    }
	
	$("#jqgh_nGrid_SMo").css("height","25");
	$("#jqgh_nGrid_SMo").css("top","12");
	$("#jqgh_nGrid_SMi").css("height","25");
	$("#jqgh_nGrid_SMi").css("top","12");
	$("#jqgh_nGrid_SG").css("height","25");
	$("#jqgh_nGrid_SG").css("top","12");
	$("#jqgh_nGrid_H").css("height","25");
	$("#jqgh_nGrid_H").css("top","12");
	$("#jqgh_nGrid_SLM").css("height","25");
	$("#jqgh_nGrid_SLM").css("top","12");
	
	
	$("#jqgh_nGrid_SR").css("height","25");
	$("#jqgh_nGrid_SR").css("top","12");
	
	$("#jqgh_nGrid_SL").css("height","25");
	$("#jqgh_nGrid_SL").css("top","12");
	
	$("#jqgh_nGrid_SP").css("height","25");
	$("#jqgh_nGrid_SP").css("top","12");
	
	$("#jqgh_nGrid_SO").css("height","25");
	$("#jqgh_nGrid_SO").css("top","12");
	
	$("#jqgh_nGrid_2_SLM").css("height","25");
	$("#jqgh_nGrid_2_SLM").css("top","12");
	
	$("#jqgh_nGrid_2_SR").css("height","25");
	$("#jqgh_nGrid_2_SR").css("top","12");
	
	$("#jqgh_nGrid_2_SP").css("height","25");
	$("#jqgh_nGrid_2_SP").css("top","12");
	
	$("#jqgh_nGrid_2_SO").css("height","25");
	$("#jqgh_nGrid_2_SO").css("top","12");
	
	$("#jqgh_nGrid_1_SLM").css("height","25");
	$("#jqgh_nGrid_1_SLM").css("top","12");
	
	$("#jqgh_nGrid_1_SR").css("height","25");
	$("#jqgh_nGrid_1_SR").css("top","12");
	
	$("#jqgh_nGrid_1_SP").css("height","25");
	$("#jqgh_nGrid_1_SP").css("top","12");
	
	$("#jqgh_nGrid_1_SO").css("height","25");
	$("#jqgh_nGrid_1_SO").css("top","12");
	
	$("#jqgh_nGrid_SUB_SM").css("height","25");
	$("#jqgh_nGrid_SUB_SM").css("top","12");
	
	$("#jqgh_nGrid_SUB_SP").css("height","25");
	$("#jqgh_nGrid_SUB_SP").css("top","12");
	
	$("#jqgh_nGrid_SUB_PL").css("height","25");
	$("#jqgh_nGrid_SUB_PL").css("top","12");
	
	$("#jqgh_nGrid_I").css("height","25");
	$("#jqgh_nGrid_I").css("top","12");
	
	$("#jqgh_nGrid_II").css("height","25");
	$("#jqgh_nGrid_II").css("top","12");
	
	$("#jqgh_nGrid_III").css("height","25");
	$("#jqgh_nGrid_III").css("top","12");
	
	$("#jqgh_nGrid_IV").css("height","25");
	$("#jqgh_nGrid_IV").css("top","12");
	
	$("#jqgh_nGrid_V").css("height","25");
	$("#jqgh_nGrid_V").css("top","12");
	
	$("#jqgh_nGrid_VI").css("height","25");
	$("#jqgh_nGrid_VI").css("top","12");
	
	var bgColorArray = ["","", "#770000","#C08181","#FFFF99","#FF6103","#FFCC33","#336633"];
	var fontColorArray = ["","","#FFFFFF","#FFFFFF","#000099","#000099","#000099","#FFFFFF"];
	var $i=0;
	$(".jqg-second-row-header").children().each(function()
		{
				$(this).css("background",bgColorArray[$i]);
				$(this).css("color",fontColorArray[$i]);
				$i++;	
		});

var cm = $("#nGrid").jqGrid('getGridParam', 'colModel');
	
	$("#nGrid").mouseover(function(e) {

		var count = $("#nGrid").jqGrid('getGridParam', 'records');
	    var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
	        rowId = $tr.attr('id');
        
       	if (rowId) {
	        var ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
			$row = "#"+rowId+" td"; 
			$($row).addClass('highlighted');

			for(var i=0;i<count;i++)
			{
				$colSelected = "tr#"+i+" td:eq("+ci+")";
			    $($colSelected).addClass('highlighted');
			}
		}
	});
	$("#nGrid").mouseout(function(e) {
		var count = $("#nGrid").jqGrid('getGridParam', 'records') + 1;
	    var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
	        rowId = $tr.attr('id'), ci;
       	if (rowId) {
	        ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
	        $row = "#"+rowId+" td";  
			$($row).removeClass('highlighted');
			for(var i=0;i<count;i++)
			{
				$colSelected = "tr#"+i+" td:eq("+ci+")";
				$($colSelected).removeClass('highlighted');
			} 
		}
	});
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Morphology Matrix</title>
<script type="text/javascript" src="style/resolution.js"></script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>		

<div class='title_area'>
	<font class="font1">Browse morphology matrix</font>
</div>

<!-- Submenu tabs
<div class='sub_menu'>
	<div class="clr-page-tabs clr-subnav-tabs">		
		<ul class="ui-tabs">
			<li class="title">Browse:</li>
			<li class="active"><a href="morphology.php">Morphology</a></li>
			<li><a href="markers.php">Molecular markers</a></li>
			<li><a href="ephys.php">Electrophysiology</a></li>
			<li><a href="connectivity.php">Connectivity</a></li>
		</ul>
	</div>
</div>
 -->
<!-- ------------------------ -->

<div class='table_position'>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr>
    <td>
		<!-- ****************  BODY **************** -->
		<?php 
			if ($research){
				$full_search_string = $_SESSION['full_search_string'];
				if ($number_type == 1)
					print ("<font class='font3'> $number_type Result  [$full_search_string]</font>");
				else
					print ("<font class='font3'> $number_type Results  [$full_search_string]</font>");
			}
		?>
		<br />
		<font class='font5'><strong>Legend:</strong> </font>&nbsp; &nbsp;
		<img src="images/morphology/axons_present.png" width="10px" border="0"/> <font class='font5'>Axon present </font> &nbsp; &nbsp; 
		<img src="images/morphology/dendrites_present.png" width="10px" border="0"/> <font class='font5'>Dendrite present </font>&nbsp; &nbsp; 
		<img src="images/morphology/somata_present.png" width="10px" border="0"/> <font class='font5'>Axon & Dendrite present </font> &nbsp; &nbsp; 
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#339900" size="2"> +/green: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Excitatory</font>
		&nbsp; &nbsp; 
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#CC0000" size="2"> -/red: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Inhibitory</font>
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>Pale versions of the colors in the matrix indicate interpretations of neuronal property information that have not yet been fully verified.</font>
		<br />
		
<table border="0" cellspacing="0" cellpadding="0" class="tabellauno">
	<!--  <tr>
 		<td>
		  		<table border="0" cellspacing="1" cellpadding="0" class='table_10'>
				  <tr>
					<td width="26.5%" align="center">
					</td>
					<td width="8%" align="center" bgcolor="#770000">
						<font class='font_table_index2'>DG</font>
					</td>
					<td width="10%" align="center" bgcolor="#C08181">
						<font class='font_table_index2'>CA3</font>
					</td>
					<td width="8%" align="center" bgcolor="#FFFF99">
						<font class='font_table_index'>CA2</font>
					</td>
					<td width="8%" align="center" bgcolor="#FF6103">
						<font class='font_table_index'>CA1</font>
					</td>
					<td width="6%" align="center" bgcolor="#FFCC33">
						<font class='font_table_index'>SUB</font>
					</td>
					<td width="12%" align="center" bgcolor="#336633">
						<font class='font_table_index2'>EC</font>			
					</td>					
				  </tr>
				</table>
		</td>
	</tr>-->

	<tr>
		<td>
		
			<!-- <table border="1" cellspacing="0" cellpadding="0" class='table_11'>
			  <tr height="50px">
				<td width="26.3%" align="center" colspan="3">	
					<font class='font1'>Neuron Type	</font>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SMo.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SMi.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SG.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/H.png" width="10px" border='0'/>
				</td>
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SLM.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SR.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SL.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/SO.png" width="10px" border='0'/>
				</td>			
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SLM.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SR.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/SO.png" width="10px" border='0'/>
				</td>			
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SLM.png" width="10px" border='0'/>
				</td>			
				<td width="2%" align="center" >	
					<img src="images/name/SR.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/SO.png" width="10px" border='0'/>
				</td>			
	
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/SM.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/SP.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" class='td_border_color1'>	
					<img src="images/name/PL.png" width="10px" border='0'/>
				</td>	
				
				<td width="2%" align="center" class='td_border_color2'>	
					<img src="images/name/I.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/II.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" >	
					<img src="images/name/III.png" width="10px" border='0'/>
				</td>	
				<td width="2%" align="center" >	
					<img src="images/name/IV.png" width="10px" border='0'/>
				</td>				
				<td width="2%" align="center" >	
					<img src="images/name/V.png" width="10px" border='0'/>
				</td>
				<td width="2%" align="center" >	
					<img src="images/name/VI.png" width="10px" border='0'/>
				</td>
			  </tr>
			</table>  -->
			<!-- table for the JqGrid -->
			<table id="nGrid"></table>
			<div id="pager"></div>
		</td>
	</tr>

	<tr>
		<td>
		<!--  <div class="divinterno"> 
		
		
		<form name="nomeform">
		
		<?php

		// calculate the first number for each zone, only in case of reseach ------------------------------------------------
		/* $n_DG = 0;	
		$n_CA3 = 0;
		$n_CA2 = 0;
		$n_CA1 = 0;		
		$n_SUB = 0;			
		$n_EC = 0;			
		if ($research) 
		{				
			for($W1=0; $W1<$number_type; $W1++)
			{
				if ($id_search[$W1] < 1999)
				{
					//$type -> retrive_by_id($id_search[$W1]);
					//$DG_position[$n_DG] = $type->getPosition();
					// $DG_position[$n_DG]=$id_search[$W1];
					$DG_position[$n_DG] = $id_search[$W1];					
					$n_DG = $n_DG + 1;	
				}	
				if ( ($id_search[$W1] >= 2000) && ($id_search[$W1] < 2999) )
				{
					$CA3_position[$n_CA3]=$id_search[$W1];
					$n_CA3 = $n_CA3 + 1;	
				}	
				if ( ($id_search[$W1] >= 3000) && ($id_search[$W1] < 3999) )
				{
					$CA2_position[$n_CA2]=$id_search[$W1];
					$n_CA2 = $n_CA2 + 1;	
				}				
				if ( ($id_search[$W1] >= 4000) && ($id_search[$W1] < 4999) )
				{
					$CA1_position[$n_CA1]=$id_search[$W1];
					$n_CA1 = $n_CA1 + 1;	
				}				
				if ( ($id_search[$W1] >= 5000) && ($id_search[$W1] < 5999) )
				{
					$SUB_position[$n_SUB]=$id_search[$W1];
					$n_SUB = $n_SUB + 1;	
				}				
				if ( ($id_search[$W1] >= 6000) && ($id_search[$W1] < 6999) )
				{
					$EC_position[$n_EC]=$id_search[$W1];
					$n_EC = $n_EC + 1;	
				}				
			}
			
			if ($n_DG != 0)
			{
				sort($DG_position);	
				$first_DG = $DG_position[0];
			}
			if ($n_CA3 != 0)
			{			
				sort($CA3_position);	
				$first_CA3 = $CA3_position[0];	
			}
			if ($n_CA2 != 0)
			{
				sort($CA2_position);	
				$first_CA2 = $CA2_position[0];				
			}
			if ($n_CA1 != 0)
			{
				sort($CA1_position);	
				$first_CA1 = $CA1_position[0];			
			}			
			if ($n_SUB != 0)
			{
				sort($SUB_position);	
				$first_SUB = $SUB_position[0];		
			}						
			if ($n_EC != 0)
			{
				sort($EC_position);	
				$first_EC = $EC_position[0];		
			}						
		}
		// ------------------------------------------------------------------------------------------------------------------


		print ("<table border='1' cellspacing='0' cellpadding='0' class='tabelladue'>");
		// Retrive the NICKNAME in table TYPE 		
		for ($i=0; $i<$number_type; $i++) //$number_type
		{
			// ARRAY Creation for axon, dendrite and total: +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			$hippo = array("DG_SMo"=>NULL,"DG_SMi"=>NULL,"DG_SG"=>NULL,"DG_H"=>NULL,
							"CA3_SLM" =>NULL, "CA3_SR" =>NULL, "CA3_SL" =>NULL, "CA3_SP" =>NULL, "CA3_SO" =>NULL,		
							"CA2_SLM" =>NULL, "CA2_SR" =>NULL, "CA2_SP" =>NULL, "CA2_SO" =>NULL,	
							"CA1_SLM" =>NULL, "CA1_SR" =>NULL, "CA1_SP" =>NULL, "CA1_SO" =>NULL,
							"SUB_SM" =>NULL, "SUB_SP" =>NULL, "SUB_PL" =>NULL,
							"EC_I" =>NULL, "EC_II" =>NULL, "EC_III" =>NULL, "EC_IV" =>NULL, "EC_V" =>NULL, "EC_VI" =>NULL );
			
			$hippo_axon = array("DG_SMo"=>0,"DG_SMi"=>0,"DG_SG"=>0,"DG_H"=>0,
							"CA3_SLM" =>0, "CA3_SR" =>0, "CA3_SL" =>0, "CA3_SP" =>0, "CA3_SO" =>0,		
							"CA2_SLM" =>0, "CA2_SR" =>0, "CA2_SP" =>0, "CA2_SO" =>0,	
							"CA1_SLM" =>0, "CA1_SR" =>0, "CA1_SP" =>0, "CA1_SO" =>0,
							"SUB_SM" =>0, "SUB_SP" =>0, "SUB_PL" =>0,
							"EC_I" =>0, "EC_II" =>0, "EC_III" =>0, "EC_IV" =>0, "EC_V" =>0, "EC_VI" =>0 );
			
			$hippo_dendrite = array("DG_SMo"=>0,"DG_SMi"=>0,"DG_SG"=>0,"DG_H"=>0,
							"CA3_SLM" =>0, "CA3_SR" =>0, "CA3_SL" =>0, "CA3_SP" =>0, "CA3_SO" =>0,		
							"CA2_SLM" =>0, "CA2_SR" =>0, "CA2_SP" =>0, "CA2_SO" =>0,	
							"CA1_SLM" =>0, "CA1_SR" =>0, "CA1_SP" =>0, "CA1_SO" =>0,
							"SUB_SM" =>0, "SUB_SP" =>0, "SUB_PL" =>0,
							"EC_I" =>0, "EC_II" =>0, "EC_III" =>0, "EC_IV" =>0, "EC_V" =>0, "EC_VI" =>0 );

			$hippo_id_property = array("DG_SMo"=>0,"DG_SMi"=>0,"DG_SG"=>0,"DG_H"=>0,
							"CA3_SLM" =>0, "CA3_SR" =>0, "CA3_SL" =>0, "CA3_SP" =>0, "CA3_SO" =>0,		
							"CA2_SLM" =>0, "CA2_SR" =>0, "CA2_SP" =>0, "CA2_SO" =>0,	
							"CA1_SLM" =>0, "CA1_SR" =>0, "CA1_SP" =>0, "CA1_SO" =>0,
							"SUB_SM" =>0, "SUB_SP" =>0, "SUB_PL" =>0,
							"EC_I" =>0, "EC_II" =>0, "EC_III" =>0, "EC_IV" =>0, "EC_V" =>0, "EC_VI" =>0 );
		
			// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++				
																
			$n_DG = 0;	
			if ($research) 
				$id = $id_search[$i];
			else
				$id = $type->getID_array($i);
						
			$type -> retrive_by_id($id);
			$nickname = $type->getNickname();
			$position = $type->getPosition();
								
			// retrive propertytyperel.property_id By type.id 
			$evidencepropertyyperel -> retrive_Property_id_by_Type_id($id);
		
			$n_property_id = $evidencepropertyyperel -> getN_Property_id();
			$q=0;
			for ($i5=0; $i5<$n_property_id; $i5++)
			{
				$Property_id = $evidencepropertyyperel -> getProperty_id_array($i5);

				$property -> retrive_by_id($Property_id);

				$rel = $property->getRel();
				$part1 = $property->getPart();

				if (($rel == 'in') && ($part1 != 'somata'))
				{
					$id_p[$q] = $property->getID();
					$val[$q] = $property->getVal();
					$part[$q] = $property->getPart();
					$q = $q+1;
				}	
			}

			for ($ii=0; $ii<$q; $ii++)
			{	
				$val_array=explode(':', $val[$ii]);
				
				// DG +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'DG')
				{					
					$ttype = "DG_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;	
						
					$hippo_id_property[$ttype] =$id_p[$ii]; 
				}
				
				// CA3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'CA3')
				{
					$ttype = "CA3_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];
				}			
				// CA2 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'CA2')
				{
					$ttype = "CA2_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}			
				// CA1 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'CA1')
				{
					$ttype = "CA1_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}					
				// SUB +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'SUB')
				{
					$ttype = "SUB_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}				
				// EC +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if ($val_array[0] == 'EC')
				{
					$ttype = "EC_".$val_array[1];
					if ($part[$ii] == 'axons')
						$hippo_axon[$ttype] = 1;
					if ($part[$ii] == 'dendrites')
						$hippo_dendrite[$ttype] = 1;
						
					$hippo_id_property[$ttype] =$id_p[$ii];	
				}							
			}

			// DG ---------------------------------------------------------------------
			$hippo[DG_SMo]=check_axon_dendrite('DG_SMo',$hippo_axon, $hippo_dendrite);
			$hippo[DG_SMi]=check_axon_dendrite('DG_SMi',$hippo_axon, $hippo_dendrite);
			$hippo[DG_SG]=check_axon_dendrite('DG_SG',$hippo_axon, $hippo_dendrite);			
			$hippo[DG_H]=check_axon_dendrite('DG_H',$hippo_axon, $hippo_dendrite);	
			// CA3 ---------------------------------------------------------------------
			$hippo[CA3_SLM]=check_axon_dendrite('CA3_SLM',$hippo_axon, $hippo_dendrite);
			$hippo[CA3_SR]=check_axon_dendrite('CA3_SR',$hippo_axon, $hippo_dendrite);
			$hippo[CA3_SL]=check_axon_dendrite('CA3_SL',$hippo_axon, $hippo_dendrite);			
			$hippo[CA3_SP]=check_axon_dendrite('CA3_SP',$hippo_axon, $hippo_dendrite);						
			$hippo[CA3_SO]=check_axon_dendrite('CA3_SO',$hippo_axon, $hippo_dendrite);	
			// CA2 ---------------------------------------------------------------------
			$hippo[CA2_SLM]=check_axon_dendrite('CA2_SLM',$hippo_axon, $hippo_dendrite);
			$hippo[CA2_SR]=check_axon_dendrite('CA2_SR',$hippo_axon, $hippo_dendrite);		
			$hippo[CA2_SP]=check_axon_dendrite('CA2_SP',$hippo_axon, $hippo_dendrite);						
			$hippo[CA2_SO]=check_axon_dendrite('CA2_SO',$hippo_axon, $hippo_dendrite);				
			// CA1 ---------------------------------------------------------------------
			$hippo[CA1_SLM]=check_axon_dendrite('CA1_SLM',$hippo_axon, $hippo_dendrite);
			$hippo[CA1_SR]=check_axon_dendrite('CA1_SR',$hippo_axon, $hippo_dendrite);		
			$hippo[CA1_SP]=check_axon_dendrite('CA1_SP',$hippo_axon, $hippo_dendrite);						
			$hippo[CA1_SO]=check_axon_dendrite('CA1_SO',$hippo_axon, $hippo_dendrite);	
			// SUB ---------------------------------------------------------------------
			$hippo[SUB_SM]=check_axon_dendrite('SUB_SM',$hippo_axon, $hippo_dendrite);
			$hippo[SUB_SP]=check_axon_dendrite('SUB_SP',$hippo_axon, $hippo_dendrite);		
			$hippo[SUB_PL]=check_axon_dendrite('SUB_PL',$hippo_axon, $hippo_dendrite);						
			// EC ---------------------------------------------------------------------
			$hippo[EC_I]=check_axon_dendrite('EC_I',$hippo_axon, $hippo_dendrite);
			$hippo[EC_II]=check_axon_dendrite('EC_II',$hippo_axon, $hippo_dendrite);
			$hippo[EC_III]=check_axon_dendrite('EC_III',$hippo_axon, $hippo_dendrite);
			$hippo[EC_IV]=check_axon_dendrite('EC_IV',$hippo_axon, $hippo_dendrite);
			$hippo[EC_V]=check_axon_dendrite('EC_V',$hippo_axon, $hippo_dendrite);
			$hippo[EC_VI]=check_axon_dendrite('EC_VI',$hippo_axon, $hippo_dendrite);

			if (!$research)
			{		
				if ( ($position == 201) || ($position == 301) || ($position == 401) || ($position == 501) || ($position == 601))    		
				{										
					print ("<tr height='4px'><td colspan='35' bgcolor='#FF0000'></td></tr>");
				}
			}
			else
			{
				if ( ($id == $first_CA3) || ($id == $first_CA2) || ($id == $first_CA1) || ($id == $first_SUB) || ($id == $first_EC))
				{
				 	print ("<tr height='4px'><td colspan='35' bgcolor='#FF0000'></td></tr>");
				}
			}

				$select_nick_name2 = str_replace(':', '_', $nickname);
				$select_nick_name_check  = $select_nick_name2."_check";
				
				print ("<tr id='$select_nick_name2'>");

				if ($position < 200)
				{
					$bkcolor='#770000';
				}
				else if ($position < 300)
				{
					$bkcolor='#C08181';
				}
				else if ($position < 400)
				{
					$bkcolor='#FFFF99';
				}	
				else if ($position < 500)
				{
					$bkcolor='#FF6103';
				}	
				else if ($position < 600)
				{
					$bkcolor='#FFCC33';
				}				
				else if ($position < 700)
				{
					$bkcolor='#336633';
				}											
				else
				{
					$bkcolor='#FFFFFF';	
				}

				print ("<td width='3%' align='center' class='cella_1'>");
		
				if ($research) 
				{
					if ($id == $first_DG)
							print ("<font class='font2' color='#770000'><strong>DG</strong></font> ");
//					if ($id == $DG_position[1])
//						print ("<font class='font2' color='#770000'>($n_DG)</font> ");									
					if ($id == $first_CA3)
						print ("<font class='font2' color='#C08181'> <strong>CA3</strong> </font> ");
//					if ($id == $CA3_position[1])
//						print ("<font class='font2' color='#770000'>($n_CA3)</font> ");													
					if ($id == $first_CA2)
						print ("<font class='font2' color='#FFCC00'> <strong>CA2</strong> </font> ");
//					if ($id == $CA2_position[1])
//						print ("<font class='font2' color='#770000'>($n_CA2)</font> ");											
					if ($id == $first_CA1)
						print ("<font class='font2' color='#FF6103'> <strong>CA1</strong> </font> ");
//					if ($id == $CA1_position[1])
//						print ("<font class='font2' color='#770000'>($n_CA1)</font> ");													
					if ($id == $first_SUB)
						print ("<font class='font2' color='#FFCC33'> <strong>SUB</strong> </font> ");
//					if ($id == $SUB_position[1])
//						print ("<font class='font2' color='#770000'>($n_SUB)</font> ");											
					if ($id == $first_EC)
						print ("<font class='font2' color='#336633'> <strong>EC</strong> </font> ");
//					if ($id == $EC_position[1])
//						print ("<font class='font2' color='#770000'>($n_EC)</font> ");															
				}
				else
				{
					if ($position == 101)
						print ("<font class='font2' color='#770000'> <strong>DG</strong> </font> ");				
					if ($position == 102)
						print ("<font class='font2' color='#770000'> (18) </font> ");				
					if ($position == 201)
						print ("<font class='font2' color='#C08181'> <strong>CA3</strong> </font> ");		
					if ($position == 202)
						print ("<font class='font2' color='#C08181'> (25) </font> ");				
					if ($position == 301)
						print ("<font class='font2' color='#FFCC00'> <strong>CA2</strong> </font> ");			
					if ($position == 302)
						print ("<font class='font2' color='#FFCC00'> (5) </font> ");				
					if ($position == 401)
						print ("<font class='font2' color='#FF6103'> <strong>CA1</strong> </font> ");		
					if ($position == 402)
						print ("<font class='font2' color='#FF6103'> (40) </font> ");				
					if ($position == 501)
						print ("<font class='font2' color='#FFCC33'> <strong>SUB</strong> </font> ");				
					if ($position == 502)
						print ("<font class='font2' color='#FFCC33'> (3) </font> ");				
					if ($position == 601)
						print ("<font class='font2' color='#336633'> <strong>EC</strong> </font> ");	
					if ($position == 602)
						print ("<font class='font2' color='#336633'> (31) </font> ");				
				}	
					
					
				print ("</td>");

				print ("<td width='3%' align='center'  bgcolor='$bkcolor'>");
				print ("<input type='checkbox' name='$select_nick_name2' value='$select_nick_name2' onClick=\"ctr('$select_nick_name2', '$bkcolor', '$select_nick_name_check')\" id='$select_nick_name_check' />");
				print ("</td>");


				print ("<td width='20%' align='right'>");
			
					print ("<a href='neuron_page.php?id=$id' class='font_cell'>");
					
					if (strpos($nickname, '(+)') == TRUE)
						print ("<font color='#339900'>$nickname</font>");
					if (strpos($nickname, '(-)') == TRUE)
						print ("<font color='#CC0000'>$nickname</font>");
					
					print ("</a>");
				print ("</td>");


				// DG ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					$select_morp_DG_SMo = $select_morp.$i;
					print ("<td width='2%' align='center' id='$select_morp_DG_SMo'>");	
					
						$unvetted_DG_SMo = check_unvetted1($id, $hippo_id_property[DG_SMo], $evidencepropertyyperel);						
						$color = check_color($hippo[DG_SMo], $unvetted_DG_SMo);
						
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_SMo&color=$color[1]&page=1'>");
						print ($color[0]);	
						print ("</a>");
					}
					print ("</td>");


					print ("<td width='2%' align='center' id='$select_morp1'>");
						
						$unvetted_DG_SMi = check_unvetted1($id, $hippo_id_property[DG_SMi], $evidencepropertyyperel);
						$color = check_color($hippo[DG_SMi], $unvetted_DG_SMi);
						
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_SMi&color=$color[1]&page=1'>");
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_DG_SG = check_unvetted1($id, $hippo_id_property[DG_SG], $evidencepropertyyperel);
						$color = check_color($hippo[DG_SG], $unvetted_DG_SG);
						
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_SG&color=$color[1]&page=1'>");
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_DG_H = check_unvetted1($id, $hippo_id_property[DG_H], $evidencepropertyyperel);
						$color = check_color($hippo[DG_H], $unvetted_DG_H);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=DG_H&color=$color[1]&page=1'>");
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");								
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				
				// CA3 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_CA3_SLM = check_unvetted1($id, $hippo_id_property[CA3_SLM], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SLM], $unvetted_CA3_SLM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SLM&color=$color[1]&page=1'>");	
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_CA3_SR = check_unvetted1($id, $hippo_id_property[CA3_SR], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SR], $unvetted_CA3_SR);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SR&color=$color[1]&page=1'>");		
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_CA3_SL = check_unvetted1($id, $hippo_id_property[CA3_SL], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SL], $unvetted_CA3_SL);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SL&color=$color[1]&page=1'>");		
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");
					

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA3_SP = check_unvetted1($id, $hippo_id_property[CA3_SP], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SP], $unvetted_CA3_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SP&color=$color[1]&page=1'>");		
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");		
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_CA3_SO = check_unvetted1($id, $hippo_id_property[CA3_SO], $evidencepropertyyperel);
						$color = check_color($hippo[CA3_SO], $unvetted_CA3_SO);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA3_SO&color=$color[1]&page=1'>");		
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");												
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++				
				
				// CA2 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_CA2_SLM = check_unvetted1($id, $hippo_id_property[CA2_SLM], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SLM], $unvetted_CA2_SLM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SLM&color=$color[1]&page=1'>");	
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA2_SR = check_unvetted1($id, $hippo_id_property[CA2_SR], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SR], $unvetted_CA2_SR);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SR&color=$color[1]&page=1'>");		
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");
						

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA2_SP = check_unvetted1($id, $hippo_id_property[CA2_SP], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SP], $unvetted_CA2_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SP&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");		
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_CA2_SO = check_unvetted1($id, $hippo_id_property[CA2_SO], $evidencepropertyyperel);
						$color = check_color($hippo[CA2_SO], $unvetted_CA2_SO);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA2_SO&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}							
					print ("</td>");												
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					
				
				// CA1 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_CA1_SLM = check_unvetted1($id, $hippo_id_property[CA1_SLM], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SLM], $unvetted_CA1_SLM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SLM&color=$color[1]&page=1'>");		
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_CA1_SR = check_unvetted1($id, $hippo_id_property[CA1_SR], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SR], $unvetted_CA1_SR);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SR&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
						

					print ("<td width='2%' align='center'>");
						
						$unvetted_CA1_SP = check_unvetted1($id, $hippo_id_property[CA1_SP], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SP], $unvetted_CA1_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SP&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");		
					

					print ("<td width='2%' align='center' class='td_border_color1'>");
							
						$unvetted_CA1_SO = check_unvetted1($id, $hippo_id_property[CA1_SO], $evidencepropertyyperel);
						$color = check_color($hippo[CA1_SO], $unvetted_CA1_SO);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=CA1_SO&color=$color[1]&page=1'>");				
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");																			
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					
				
				// SUB ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_SUB_SM = check_unvetted1($id, $hippo_id_property[SUB_SM], $evidencepropertyyperel);
						$color = check_color($hippo[SUB_SM], $unvetted_SUB_SM);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=SUB_SM&color=$color[1]&page=1'>");				
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_SUB_SP = check_unvetted1($id, $hippo_id_property[SUB_SP], $evidencepropertyyperel);
						$color = check_color($hippo[SUB_SP], $unvetted_SUB_SP);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=SUB_SP&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
						

					print ("<td width='2%' align='center' class='td_border_color1'>");
						
						$unvetted_SUB_PL = check_unvetted1($id, $hippo_id_property[SUB_PL], $evidencepropertyyperel);	
						$color = check_color($hippo[SUB_PL], $unvetted_SUB_PL);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=SUB_PL&color=$color[1]&page=1'>");				
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");																				
				// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					
				
				// EC ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

					print ("<td width='2%' align='center' class='td_border_color2'>");
						
						$unvetted_EC_I = check_unvetted1($id, $hippo_id_property[EC_I], $evidencepropertyyperel);	
						$color = check_color($hippo[EC_I], $unvetted_EC_I);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_I&color=$color[1]&page=1'>");				
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_II = check_unvetted1($id, $hippo_id_property[EC_II], $evidencepropertyyperel);
						$color = check_color($hippo[EC_II], $unvetted_EC_II);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_II&color=$color[1]&page=1'>");				
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
					

					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_III = check_unvetted1($id, $hippo_id_property[EC_III], $evidencepropertyyperel);
						$color = check_color($hippo[EC_III], $unvetted_EC_III);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_III&color=$color[1]&page=1'>");					
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_IV = check_unvetted1($id, $hippo_id_property[EC_IV], $evidencepropertyyperel);
						$color = check_color($hippo[EC_IV], $unvetted_EC_IV);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_IV&color=$color[1]&page=1'>");				
						print ($color[0]);	
						print ("</a>");
					}		
					print ("</td>");


					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_V = check_unvetted1($id, $hippo_id_property[EC_V], $evidencepropertyyperel);
						$color = check_color($hippo[EC_V], $unvetted_EC_V);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_V&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}	
					print ("</td>");
					

					print ("<td width='2%' align='center'>");
						
						$unvetted_EC_VI = check_unvetted1($id, $hippo_id_property[EC_VI], $evidencepropertyyperel);
						$color = check_color($hippo[EC_VI], $unvetted_EC_VI);
					if ($color[1] == NULL)
						print ($color[0]);	
					else	
					{
						print ("<a href='property_page_morphology.php?id_neuron=$id&val_property=EC_VI&color=$color[1]&page=1'>");			
						print ($color[0]);	
						print ("</a>");
					}			
					print ("</td>");																			
					// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
				print ("</tr>");
		}
		
		print ("</table>"); */
		?>
		
		</form>
		
		
		
		</div> -->
		</td>
	</tr>

	</table>		
		
		
	</td>
  </tr>
</table>
</div>
</body>
</html>
