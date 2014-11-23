<?php
session_start();
$perm = $_SESSION['perm'];
if ($perm == NULL)
	header("Location:error1.html");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
include ("access_db.php");
include ("getMarkers.php");
require_once('class/class.type.php');
require_once('class/class.property.php');
require_once('class/class.evidencepropertyyperel.php');
require_once('class/class.temporary_result_neurons.php');
	
$width1='25%';
$width2='2%';

$research ="";
$table_result ="";
if(isset($_REQUEST['research']))
	$research = $_REQUEST['research'];
if(isset($_REQUEST['table_result']))
	$table_result = $_REQUEST['table_result'];

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include ("function/icon.html"); ?>
<title>Molecular Markers Matrix</title>
<script type="text/javascript" src="style/resolution.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui.jqgrid.css" />
<style>
.ui-jqgrid tr.jqgrow td
{
	height:18px !important;
}
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
   /*left:8px;*/
   top:25px;
   left:3px;
   font-size:12px;
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
   top:25px;
   left:3px; 
   font-size:12px;
   font-weight:bold;
   padding:0px;
   font:Verdana;
}
</style>
<script language="javascript">
function OpenInNewTab(aEle)
{
	var win = window.open(aEle.href,'_self');
	win.focus();
}
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
<script src="jqGrid-4/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="jqGrid-4/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="jqGrid-4/js/jquery.jqGrid.src.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	var dataStr = <?php echo json_encode($responce)?>;
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
	var table = "<?php echo $table_result?>";
	
	$("#nGrid").jqGrid({
		datatype: "jsonstring",
		datastr: dataStr,
	    /* url:'getMarkers.php',
	    datatype: 'json', */
	    mtype: 'GET',
	    /* ajaxGridOptions :{
			contentType : "application/json"
	        }, */
	    postData: {
	        researchVar: research,
	        table_result : table
	    },
    colNames:['','Neuron Type','<a href="neuron_by_marker.php?marker=5HT-3" onClick="OpenInNewTab(this);">5HT-3</a>','<a href="neuron_by_marker.php?marker=alpha-actinin-2" onClick="OpenInNewTab(this);">&prop;-act2</a>','<a href="neuron_by_marker.php?marker=AChE" onClick="OpenInNewTab(this);">AChE</a>','<a href="neuron_by_marker.php?marker=CB" onClick="OpenInNewTab(this);">CB</a>','<a href="neuron_by_marker.php?marker=CB1" onClick="OpenInNewTab(this);">CB1</a>','<a href="neuron_by_marker.php?marker=CCK" onClick="OpenInNewTab(this);">CCK</a>','<a href="neuron_by_marker.php?marker=CGRP" onClick="OpenInNewTab(this);">CGRP</a>','<a href="neuron_by_marker.php?marker=ChAT" onClick="OpenInNewTab(this);">ChAT</a>','<a href="neuron_by_marker.php?marker=CoupTF II" onClick="OpenInNewTab(this);">CoupTF II</a>','<a href="neuron_by_marker.php?marker=CR" onClick="OpenInNewTab(this);">CR</a>','<a href="neuron_by_marker.php?marker=DYN" onClick="OpenInNewTab(this);">DYN</a>','<a href="neuron_by_marker.php?marker=DYN" onClick="OpenInNewTab(this);">EAAT3</a>','<a href="neuron_by_marker.php?marker=ENK" onClick="OpenInNewTab(this);">ENK</a>','<a href="neuron_by_marker.php?marker=Gaba-a-alpha" onClick="OpenInNewTab(this);">GABAa &prop;</a>','<a href="neuron_by_marker.php?marker=GAT-1" onClick="OpenInNewTab(this);">GAT-1</a>','<a href="neuron_by_marker.php?marker=Gly T2" onClick="OpenInNewTab(this);">Gly T2</a>','<a href="neuron_by_marker.php?marker=mGLuR1a" onClick="OpenInNewTab(this);">mGLuR1a</a>','<a href="neuron_by_marker.php?marker=mGluR2/3" onClick="OpenInNewTab(this);">mGluR2/3</a>','<a href="neuron_by_marker.php?marker=mGLuR7a" onClick="OpenInNewTab(this);">mGLuR7a</a>','<a href="neuron_by_marker.php?marker=mGluR8a" onClick="OpenInNewTab(this);">mGluR8a</a>','<a href="neuron_by_marker.php?marker=MOR" onClick="OpenInNewTab(this);">MOR</a>','<a href="neuron_by_marker.php?marker=Mus2R" onClick="OpenInNewTab(this);">Mus2R</a>','<a href="neuron_by_marker.php?marker=NG" onClick="OpenInNewTab(this);">NG</a>','<a href="neuron_by_marker.php?marker=NKB" onClick="OpenInNewTab(this);">NKB</a>','<a href="neuron_by_marker.php?marker=nNos" onClick="OpenInNewTab(this);">nNos</a>','<a href="neuron_by_marker.php?marker=NPY" onClick="OpenInNewTab(this);">NPY</a>','<a href="neuron_by_marker.php?marker=PPTA" onClick="OpenInNewTab(this);">PPTA</a>','<a href="neuron_by_marker.php?marker=PPTB" onClick="OpenInNewTab(this);">PPTB</a>','<a href="neuron_by_marker.php?marker=PV" onClick="OpenInNewTab(this);">PV</a>','<a href="neuron_by_marker.php?marker=RLN" onClick="OpenInNewTab(this);">RLN</a>','<a href="neuron_by_marker.php?marker=SOM" onClick="OpenInNewTab(this);">SOM</a>','<a href="neuron_by_marker.php?marker=Sub P Rec" onClick="OpenInNewTab(this);">Sub P Rec</a>','<a href="neuron_by_marker.php?marker=vAChT" onClick="OpenInNewTab(this);">vAChT</a>','<a href="neuron_by_marker.php?marker=vGluT2" onClick="OpenInNewTab(this);">vGluT2</a>','<a href="neuron_by_marker.php?marker=vGluT3" onClick="OpenInNewTab(this);">vGlu T3<a/>','<a href="neuron_by_marker.php?marker=VIAAT" onClick="OpenInNewTab(this);">VIAAT</a>','<a href="neuron_by_marker.php?marker=VIP" onClick="OpenInNewTab(this);">VIP</a>'],
              /* ,'SMi','SG','H','SLM','SR','SL','SP','SO','SLM','SR','SP','SO','SLM','SR','SP','SO','SM','SP','PL','I','II','III','IV','V','VI']*/
    colModel :[
	  {name:'type', index:'type', width:50,sortable:false,cellattr: function (rowId, tv, rawObject, cm, rdata) {
          return 'id=\'type' + rowId + "\'";   
      } },
      {name:'Neuron type', index:'nickname', width:175,sortable:false},
          //,searchoptions: {sopt: ['bw','bn','cn','in','ni','ew','en','nc']}},
      {name:'5HT-3', index:'5HT-3', width:15,height:130,search:false,sortable:false},
      {name:'act2', index:'act2', width:15,height:130,search:false,sortable:false},
      {name:'ache', index:'ache', width:15,height:150,search:false,sortable:false},
      {name:'CB', index:'CB', width:15,height:150,search:false,sortable:false},
      {name:'CB1', index:'CB1', width:15,height:150,search:false,sortable:false},
      {name:'CCK', index:'CCK', width:15,height:150,search:false,sortable:false},
      {name:'CGRP', index:'CGRP', width:15,height:150,search:false,sortable:false},
      {name:'ChAT', index:'ChAT', width:15,height:150,search:false,sortable:false},
      {name:'CoupTFII', index:'CoupTFII', width:15,height:150,search:false,sortable:false},
      {name:'CR', index:'CR', width:15,height:150,search:false,sortable:false},
      {name:'DYN', index:'DYN', width:15,height:150,search:false,sortable:false},
      {name:'EAAT3', index:'EAAT3', width:15,height:150,search:false,sortable:false},
      {name:'ENK', index:'ENK', width:15,height:150,search:false,sortable:false},
      {name:'GABAa', index:'GABAa', width:15,height:150,search:false,sortable:false},
      {name:'GAT-1', index:'GAT-1', width:15,height:150,search:false,sortable:false},
      {name:'GlyT2', index:'GlyT2', width:15,height:150,search:false,sortable:false},
      {name:'mGLuR1a', index:'mGLuR1a', width:15,height:150,search:false,sortable:false},
      {name:'mGluR23', index:'mGluR23', width:15,height:150,search:false,sortable:false},
      {name:'mGLuR7a', index:'mGLuR7a', width:15,height:150,search:false,sortable:false},
      {name:'mGluR8a', index:'mGluR8a', width:15,height:150,search:false,sortable:false},
      {name:'MOR', index:'MOR', width:15,height:150,search:false,sortable:false},
      {name:'Mus2R', index:'Mus2R', width:15,height:150,search:false,sortable:false},
      {name:'NG', index:'NG', width:15,height:150,search:false,sortable:false},	
      {name:'NKB', index:'NKB', width:15,height:150,search:false,sortable:false},
      {name:'nNos', index:'nNos', width:15,height:150,search:false,sortable:false},
      {name:'NPY', index:'NPY', width:15,height:150,search:false,sortable:false},
      {name:'PPTA', index:'PPTA', width:15,height:150,search:false,sortable:false},
      {name:'PPTB', index:'PPTB', width:15,height:150,search:false,sortable:false},
      {name:'PV', index:'PV', width:15,height:150,search:false,sortable:false},
      {name:'RLN', index:'RLN', width:15,height:150,search:false,sortable:false},
      {name:'SOM', index:'SOM', width:15,height:150,search:false,sortable:false},
      {name:'SubPRec', index:'SubPRec', width:15,height:150,search:false,sortable:false},
      {name:'vAChT', index:'vAChT', width:15,height:150,search:false,sortable:false},
      {name:'vGluT2', index:'vGluT2', width:15,height:150,search:false,sortable:false},
      {name:'vGluT3', index:'vGluT3', width:15,height:150,search:false,sortable:false},
      {name:'VIAAT', index:'VIAAT', width:15,height:150,search:false,sortable:false},
      {name:'VIP', index:'VIP', width:28,height:150,search:false,sortable:false}
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
    //caption: 'Marker Matrix',
    scrollerbar:true,
    //height:"2340", //full height
    height:"440", //page height
    width:"80%",
    gridComplete: function () {
    	var gridName = "nGrid"; // Access the grid Name
    	Merger(gridName,"type");
		} 
    });
	if(checkVersion()=="9")
	{
		$("#jqgh_nGrid_5HT-3").addClass("rotateIE9");
		$("#jqgh_nGrid_act2").addClass("rotateIE9");
		$("#jqgh_nGrid_ache").addClass("rotateIE9");
		$("#jqgh_nGrid_CB").addClass("rotateIE9");
		$("#jqgh_nGrid_CB1").addClass("rotateIE9");
		$("#jqgh_nGrid_CCK").addClass("rotateIE9");
		$("#jqgh_nGrid_CGRP").addClass("rotateIE9");
		$("#jqgh_nGrid_ChAT").addClass("rotateIE9");
		$("#jqgh_nGrid_CoupTFII").addClass("rotateIE9");
		$("#jqgh_nGrid_CR").addClass("rotateIE9");
		$("#jqgh_nGrid_DYN").addClass("rotateIE9");
		$("#jqgh_nGrid_EAAT3").addClass("rotateIE9");
		$("#jqgh_nGrid_ENK").addClass("rotateIE9");
		$("#jqgh_nGrid_GABAa").addClass("rotateIE9");
		$("#jqgh_nGrid_GAT-1").addClass("rotateIE9");
		$("#jqgh_nGrid_GlyT2").addClass("rotateIE9");
		$("#jqgh_nGrid_mGLuR1a").addClass("rotateIE9");
		$("#jqgh_nGrid_mGluR23").addClass("rotateIE9");
		$("#jqgh_nGrid_mGLuR7a").addClass("rotateIE9");
		$("#jqgh_nGrid_mGluR8a").addClass("rotateIE9");
		$("#jqgh_nGrid_MOR").addClass("rotateIE9");
		$("#jqgh_nGrid_Mus2R").addClass("rotateIE9");
		$("#jqgh_nGrid_NG").addClass("rotateIE9");
		$("#jqgh_nGrid_NKB").addClass("rotateIE9");
		$("#jqgh_nGrid_nNos").addClass("rotateIE9");
		$("#jqgh_nGrid_NPY").addClass("rotateIE9");
		$("#jqgh_nGrid_PPTA").addClass("rotateIE9");
		$("#jqgh_nGrid_PPTB").addClass("rotateIE9");
		$("#jqgh_nGrid_PV").addClass("rotateIE9");
		$("#jqgh_nGrid_RLN").addClass("rotateIE9");
		$("#jqgh_nGrid_SOM").addClass("rotateIE9");
		$("#jqgh_nGrid_SubPRec").addClass("rotateIE9");
		$("#jqgh_nGrid_vAChT").addClass("rotateIE9");
		$("#jqgh_nGrid_vGluT2").addClass("rotateIE9");
		$("#jqgh_nGrid_vGluT3").addClass("rotateIE9");
		$("#jqgh_nGrid_VIAAT").addClass("rotateIE9");
		$("#jqgh_nGrid_VIP").addClass("rotateIE9");
	}
	else
	{
		$("#jqgh_nGrid_5HT-3").addClass("rotate");
		$("#jqgh_nGrid_act2").addClass("rotate");
		$("#jqgh_nGrid_ache").addClass("rotate");
		$("#jqgh_nGrid_CB").addClass("rotate");
		$("#jqgh_nGrid_CB1").addClass("rotate");
		$("#jqgh_nGrid_CCK").addClass("rotate");
		$("#jqgh_nGrid_CGRP").addClass("rotate");
		$("#jqgh_nGrid_ChAT").addClass("rotate");
		$("#jqgh_nGrid_CoupTFII").addClass("rotate");
		$("#jqgh_nGrid_CR").addClass("rotate");
		$("#jqgh_nGrid_DYN").addClass("rotate");
		$("#jqgh_nGrid_EAAT3").addClass("rotate");
		$("#jqgh_nGrid_ENK").addClass("rotate");
		$("#jqgh_nGrid_GABAa").addClass("rotate");
		$("#jqgh_nGrid_GAT-1").addClass("rotate");
		$("#jqgh_nGrid_GlyT2").addClass("rotate");
		$("#jqgh_nGrid_mGLuR1a").addClass("rotate");
		$("#jqgh_nGrid_mGluR23").addClass("rotate");
		$("#jqgh_nGrid_mGLuR7a").addClass("rotate");
		$("#jqgh_nGrid_mGluR8a").addClass("rotate");
		$("#jqgh_nGrid_MOR").addClass("rotate");
		$("#jqgh_nGrid_Mus2R").addClass("rotate");
		$("#jqgh_nGrid_NG").addClass("rotate");
		$("#jqgh_nGrid_NKB").addClass("rotate");
		$("#jqgh_nGrid_nNos").addClass("rotate");
		$("#jqgh_nGrid_NPY").addClass("rotate");
		$("#jqgh_nGrid_PPTA").addClass("rotate");
		$("#jqgh_nGrid_PPTB").addClass("rotate");
		$("#jqgh_nGrid_PV").addClass("rotate");
		$("#jqgh_nGrid_RLN").addClass("rotate");
		$("#jqgh_nGrid_SOM").addClass("rotate");
		$("#jqgh_nGrid_SubPRec").addClass("rotate");
		$("#jqgh_nGrid_vAChT").addClass("rotate");
		$("#jqgh_nGrid_vGluT2").addClass("rotate");
		$("#jqgh_nGrid_vGluT3").addClass("rotate");
		$("#jqgh_nGrid_VIAAT").addClass("rotate");
		$("#jqgh_nGrid_VIP").addClass("rotate");

    }

	$("#nGrid_5HT-3").css("height","80");
	$("#nGrid_act2").css("height","80");
	

var cm = $("#nGrid").jqGrid('getGridParam', 'colModel');
	
/* 	
	$("#nGrid").mouseover(function(e) {

	var count = $("#nGrid").jqGrid('getGridParam', 'records') + 1;
    var $td = $(e.target).closest('td'), $tr = $td.closest('tr.jqgrow'),
        rowId = $tr.attr('id');
    
   	if (rowId) {
        var ci = $.jgrid.getCellIndex($td[0]); // works mostly as $td[0].cellIndex
		$row = "#"+rowId+" td"; 
		$($row).addClass('highlighted_top');

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
			$($row).removeClass('highlighted_top');
			for(var i=0;i<count;i++)
			{
				$colSelected = "tr#"+i+" td:eq("+ci+")";
				$($colSelected).removeClass('highlighted');
			} 
		}
	});  */
});
</script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
	include ("function/title.php");
	include ("function/menu_main.php");
?>	

<div class='title_area'>
	<font class="font1">Browse molecular markers matrix</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php 
			if ($research){
				$full_search_string = $_SESSION['full_search_string'];
				if ($number_type == 1)
					print ("<font class='font3'> $number_type Result  [$full_search_string]</font>");
				else
					print ("<font class='font3'> $number_type Results  [$full_search_string]</font>");
			}
	?>
</div>

<!-- Submenu no tabs
<div class='sub_menu'>
	<?php
		if ($research);
		else
		{
	?>
			<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" align="left">
					<font class='font1'><em>Matrix:</em></font> &nbsp; &nbsp; 
					<a href='morphology.php'><font class="font7">Morphology</font></a> <font class="font7_A">|</font> 
					<font class="font7_B"> Markers</font> <font class="font7_A">|</font> 
					<a href='ephys.php'><font class="font7">Electrophysiology</font> </a><font class="font7_A">|</font> 
					<a href='connectivity.php'><font class="font7"> Connectivity</font></a>
					</font>	
				</td>
			</tr>
			</table>
	<?php
		}
	?>		
</div>
 -->
<!-- ------------------------ -->

<div class="table_position">
<table border="0" cellspacing="0" cellpadding="0" class="tabellauno">
	<tr>
 		<td>
			<table id="nGrid"></table>
			<div id="pager"></div>
		</td>
	</tr>

	<tr>
		<td>
		
		</td>
	</tr>

</table>			
<table width="100%" border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr>
    <td>
		<font class='font5'><strong>Legend:</strong> </font>&nbsp; &nbsp;
		<img src='images/positive.png' width="13px" border="0"/> <font class='font5'>Positive </font> &nbsp; &nbsp; 
		<img src='images/negative.png' width="13px" border="0"/> <font class='font5'>Negative </font>&nbsp; &nbsp; 
		<img src="images/positive-negative-subtypes.png" width="13px" border="0"/> <font class='font5'>Positive-Negative (subtypes) </font> &nbsp; &nbsp; 
		<img src="images/positive-negative-species.png" width="13px" border="0"/> <font class='font5'>Positive-Negative (species/protocol differences) </font> &nbsp; &nbsp; 
		<img src="images/positive-negative-conflicting.png" width="13px" border="0"/> <font class='font5'>Positive-Negative (conflicting data) </font> &nbsp; &nbsp; 
		<img src="images/unknown.png" width="13px" border="0"/> <font class='font5'>No Information Available </font> &nbsp; &nbsp; 
		<img src="images/searching.png" width="13px" border="0"/> <font class='font5'>Search ongoing </font> &nbsp; &nbsp;
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#339900" size="2"> +/green: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Excitatory</font>
		&nbsp; &nbsp; 
		<font face="Verdana, Arial, Helvetica, sans-serif" color="#CC0000" size="2"> -/red: </font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Inhibitory</font>
		<br />
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<font class='font5'>Pale versions of the colors in the matrix indicate interpretations of neuronal property information that have not yet been fully verified.</font>
	</td>
  </tr>
</table>
</div>
</body>
</html>
