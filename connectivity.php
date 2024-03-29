<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="style/resolution.js"></script>
<link rel="stylesheet" href="function/menu_support_files/menu_main_style.css" type="text/css" />
<script src="jqGrid-4/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="jqGrid-4/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="jqGrid-4/js/jquery.jqGrid.src.js" type="text/javascript"></script>

<script>
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
      for(var row=1;row<=125;row++){
        trs = $("#"+row);
        tds = trs.find("td");
        var name=$(tds[1]).text().trim();
        link = $(tds[1]).find("a");
        var id=$(link).attr("href").trim();
        var id_val=id.substring(id.lastIndexOf('=')+1,id.length);
        neuronName[row-1]=name;
        neuronId[row-1]=id_val;
      }

      for(var row=1;row<=125;row++){
        trs = $("#"+row);
        tds = trs.find("td");
        for(var column=2;column<127;column++){
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
//	session_start();
//	$perm = $_SESSION['perm'];
//	if ($perm == NULL)
//		header("Location:error1.html");
	
?>
<?php
//	include ("access_db.php");
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


	
	/* if ($research) { // From page of search; retrieve the id from search_table (temporary) -----------------------	
		$table_result = $_REQUEST['table_result'];
	
		$temporary_result_neurons = new temporary_result_neurons();
		$temporary_result_neurons -> setName_table($table_result);
	
		$temporary_result_neurons -> retrieve_id_array();
		$n_id_res = $temporary_result_neurons -> getN_id();
	
		$number_type = 0;
		for ($i2=0; $i2<$n_id_res; $i2++) {
			$id2 = 	$temporary_result_neurons -> getID_array($i2);
	
			if (strpos($id2, '0_') == 1);
			else {
				$type -> retrive_by_id($id2);
				$status = $type -> getStatus();
					
				if ($status == 'active') {
					$id_search[$number_type] = $id2;
					$position_search[$number_type] = $type -> getPosition();
					$number_type = $number_type + 1;
				}
			}
		} // END $i2
	
		array_multisort($position_search, $id_search);
		// sort($id_search);		
	}
	else {// not from search page --------------	
		$type -> retrive_id();
		$number_type = $type->getNumber_type();
	}
	
	 */
?>


	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php include ("function/icon.html"); ?>
	<title>Connectivity Matrix</title>
	<script type="text/javascript" src="style/resolution.js"></script>
	<link href="Fixed-Header-Table-master/css/fixedHeaderTable_defaultTheme.css" rel="stylesheet" media="screen" />
	<link href="Fixed-Header-Table-master/css/CLR_theme.css" rel="stylesheet" media="screen" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="Fixed-Header-Table-master/jquery.fixedheadertable.js"></script>
	<script src="Fixed-Header-Table-master/table_defns.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui.jqgrid.css" />
<style>
<?php if(isset($research)){?>
<?php }?>
.ui-jqgrid .ui-jqgrid-htable th div.nGrid_Neuron_type{
text-align:center !important;
margin-bottom:0px !important;
}
.ui-jqgrid .ui-jqgrid-htable th {height:22px;padding: 0px 2px;}
.ui-jqgrid .ui-jqgrid-htable th div {overflow: hidden; position:relative; height:235px; 
text-align:left;
margin-bottom:5px;}
#frmCntr
{	top:200px; 
	left:80px;
	position:absolute;
}
#toCntr
{
	top:10px; 
	left:290px;
	position:absolute;
}
#jqgh_nGrid_Neuron_type{ 
text-align:centre !important;
margin-bottom:0px !important;}

#nGrid_dg_non_ivy_ngf_0331,#nGrid_ca3_oriens_oriens_00003,#nGrid_ca2_sp_sr_0302,#nGrid_ca2_sp_sr_0302,#nGrid_ca1_oriens_oriens_0003,#nGrid_sub_pyramidal_ca1_331p
{
	width:auto !important;
	border-right:solid medium red !important;
}

.ui-jqgrid tr.jqgrow td 
{
	height:20px !important;
	padding:0px !important;
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
    -moz-transform: rotate(-90deg);       /* Firefox 3.5+ */
    -o-transform: rotate(-90deg);         /* Opera starting with 10.50+ */
    -ms-transform: rotate(-90deg);        /* IE9 */
     transform: rotate(-90deg);        /* CSS3 */
}
.rotateOldIE
{
	filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);       /* IE6, IE7 */
    -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)"; /* IE8 */
    zoom: 1;
}
p {
  margin: 0em;
}
</style>
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
<script src="jqGrid-4/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="jqGrid-4/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="jqGrid-4/js/jquery.jqGrid.src.js" type="text/javascript"></script>

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
    colNames:[<?php echo $connheaderStr?>], 
	colModel :[
	  {name:'type', index:'type', width:50,sortable:false,frozen:true,cellattr: function (rowId, tv, rawObject, cm, rdata) {
          return 'id=\'type' + rowId + "\'";   
      },frozen:true},
      {name:'Neuron_type', index:'nickname', width:200,sortable:false,frozen:true},
          //,searchoptions: {sopt: ['bw','bn','cn','in','ni','ew','en','nc']}},
      {name:'dg_granule_2201p', index:'dg_granule_2201p', width:20,height:130,search:false,sortable:false},
      {name:'dg_semilunar_granule_2311p', index:'dg_semilunar_granule_2311p', width:20,height:130,search:false,sortable:false},
      {name:'dg_quad_mc_2323', index:'dg_quad_mc_2323', width:20,height:150,search:false,sortable:false},
      {name:'dg_hillar_granule_2203', index:'dg_hillar_granule_2203', width:20,height:150,search:false,sortable:false},
      {name:'dg_mossy_0103', index:'dg_mossy_0103', width:20,height:150,search:false,sortable:false},
      {name:'dg_total_molecular_3303', index:'dg_total_molecular_3303', width:20,height:150,search:false,sortable:false},
      {name:'dg_molax_3302', index:'dg_molax_3302', width:20,height:150,search:false,sortable:false},
      {name:'dg_outer_molecular_3222', index:'dg_outer_molecular_3222', width:20,height:150,search:false,sortable:false},
      {name:'dg_neurogliaform_3000p', index:'dg_neurogliaform_3000p', width:20,height:150,search:false,sortable:false},
      {name:'dg_mopp_3000p', index:'dg_mopp_3000p', width:20,height:150,search:false,sortable:false},
      {name:'dg_aspiny_hillar_2333', index:'dg_aspiny_hillar_2333', width:20,height:150,search:false,sortable:false},
      {name:'dg_hicap_2322', index:'dg_hicap_2322', width:20,height:150,search:false,sortable:false},
      {name:'dg_axo_axonic_2233', index:'dg_axo_axonic_2233', width:20,height:150,search:false,sortable:false},
      {name:'dg_basket_pv_2232', index:'dg_basket_pv_2232', width:20,height:150,search:false,sortable:false},
      {name:'dg_basket_cck_2332', index:'dg_basket_cck_2332', width:20,height:150,search:false,sortable:false},
      {name:'dg_hillar_proj_1333', index:'dg_hillar_proj_1333', width:20,height:150,search:false,sortable:false},
      {name:'dg_hipp_1002', index:'dg_hipp_1002', width:20,height:150,search:false,sortable:false},
      {name:'dg_non_ivy_ngf_0331', index:'dg_non_ivy_ngf_0331', width:20,height:150,search:false,sortable:false,
    	  cellattr: function(rowId, tv, rawObject, cm, rdata) 
          {
             return 'style="border-right:medium solid red;"';
          }},
      {name:'ca3_pyramidal_a_b_23223p', index:'ca3_pyramidal_a_b_23223p', width:20,height:130,search:false,sortable:false,formatoptions:{baseLinkUrl:'https://goodle.com', addParam: '&action=edit'}},
      {name:'ca3_pyramidal_c_03223p', index:'ca3_pyramidal_c_03223p', width:20,height:130,search:false,sortable:false},
      {name:'ca3_ca3_granule_22100', index:'ca3_ca3_granule_22100', width:20,height:150,search:false,sortable:false},
      {name:'ca3_radiatum_giant_22010', index:'ca3_radiatum_giant_22010', width:20,height:150,search:false,sortable:false},
      {name:'ca3_lm_r_33200', index:'ca3_lm_r_33200', width:20,height:150,search:false,sortable:false},
      {name:'ca3_basket_pv_22232', index:'ca3_Basket_pv_22232', width:20,height:150,search:false,sortable:false},
      {name:'ca3_basket_cck_22232', index:'ca3_basket_cck_22232', width:20,height:150,search:false,sortable:false},
      {name:'ca3_axo_axonic_22232', index:'ca3_axo_axonic_22232', width:20,height:150,search:false,sortable:false},
      {name:'ca3_quad_o_lm_12222', index:'ca3_quad_o_lm_12222', width:20,height:150,search:false,sortable:false},
      {name:'ca3_r_lm_12000', index:'ca3_r_lm_12000', width:20,height:150,search:false,sortable:false},
      {name:'ca3_o_lm_11003', index:'ca3_o_lm_11003', width:20,height:150,search:false,sortable:false},
      {name:'ca3_interneuron_spec_03333p', index:'ca3_interneuron_spec_03333p', width:20,height:150,search:false,sortable:false},
      {name:'ca3_bistratified_03333', index:'ca3_bistratified_03333', width:20,height:150,search:false,sortable:false},
      {name:'ca3_ivy_03333', index:'ca3_ivy_03333', width:20,height:150,search:false,sortable:false},
      {name:'ca3_mossy_fiber_assoc_03330p', index:'ca3_mossy_fiber_assoc_03330p', width:20,height:150,search:false,sortable:false},
      {name:'ca3_lucidum_oriens_03311', index:'ca3_lucidum_oriens_03311', width:20,height:150,search:false,sortable:false},
      {name:'ca3_lucidum_03300', index:'ca3_lucidum_03300', width:20,height:150,search:false,sortable:false},
      {name:'ca3_radiatum_03000', index:'ca3_radiatum_03000', width:20,height:150,search:false,sortable:false},
      {name:'ca3_mossy_fiber_oriens_02332p', index:'ca3_mossy_fiber_oriens_02332p', width:20,height:130,search:false,sortable:false},
      {name:'ca3_lucidum_pyramidale_02310', index:'ca3_lucidum_pyramidale_02310', width:20,height:130,search:false,sortable:false},
      {name:'ca3_spiny_lucidum_01320p', index:'ca3_spiny_lucidum_01320p', width:20,height:150,search:false,sortable:false},
      {name:'ca3_trilaminar_01113p', index:'ca3_trilaminar_01113p', width:20,height:150,search:false,sortable:false},
      {name:'ca3_interneuron_spec_2_01113', index:'ca3_interneuron_spec_2_01113', width:20,height:150,search:false,sortable:false},
      {name:'ca3_axo_axonic_00012', index:'ca3_axo_axonic_00012', width:20,height:150,search:false,sortable:false},
      {name:'ca3_oriens_oriens_00003', index:'ca3_oriens_oriens_00003', width:20,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
             return 'style="border-right:medium solid red;"';
       }},
      {name:'ca2_pyramidal_2333p', index:'ca2_pyramidal_2333p', width:20,height:150,search:false,sortable:false},
      {name:'ca2_basket_wide_2232p', index:'ca2_basket_wide_2232p', width:20,height:150,search:false,sortable:false},
      {name:'ca2_basket_2232', index:'ca2_basket_2232', width:20,height:150,search:false,sortable:false},
      {name:'ca2_bistratified_0313p', index:'ca2_bistratified_0313p', width:20,height:150,search:false,sortable:false},
      {name:'ca2_sp_sr_0302', index:'ca2_sp_sr_0302', width:20,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
          return 'style="border-right:medium solid red;"';
       }
      },
      {name:'ca1_pyramidal_2223p', index:'ca1_pyramidal_2223p', width:20,height:130,search:false,sortable:false,formatoptions:{baseLinkUrl:'https://goodle.com', addParam: '&action=edit'}},
      {name:'ca1_superficial_pyramidal_2223p', index:'ca1_superficial_pyramidal_2223p', width:20,height:130,search:false,sortable:false},
      {name:'ca1_deep_pyramidal_2223p', index:'ca1_deep_pyramidal_2223p', width:20,height:130,search:false,sortable:false},
      {name:'ca1_cajal_retzius_3000', index:'ca1_cajal_retzius_3000', width:20,height:130,search:false,sortable:false},
      {name:'ca1_radiatum_giant_2201', index:'ca1_radiatum_giant_2201', width:20,height:130,search:false,sortable:false},
      {name:'ca1_quadrilaminar_3333', index:'ca1_quadrilaminar_3333', width:20,height:150,search:false,sortable:false},
      {name:'ca1_rlm_proj_3300', index:'ca1_rlm_proj_3300', width:20,height:150,search:false,sortable:false},
      {name:'ca1_rlm_3300', index:'ca1_rlm_3300', width:20,height:150,search:false,sortable:false},
      {name:'ca1_perforant_path_3222', index:'ca1_perforant_path_3222', width:20,height:150,search:false,sortable:false},
      {name:'ca1_perforant_path_proj_3200p', index:'ca1_perforant_path_proj_3200p', width:20,height:150,search:false,sortable:false},
      {name:'ca1_neurogliaform_proj_3000p', index:'ca1_neurogliaform_proj_3000p', width:20,height:150,search:false,sortable:false},
      {name:'ca1_neurogliaform_3000', index:'ca1_neurogliaform_3000', width:20,height:150,search:false,sortable:false},
      {name:'ca1_rpo_2333', index:'ca1_rpo_2333', width:20,height:150,search:false,sortable:false},
      {name:'ca1_schaffer_collateral_2311', index:'ca1_schaffer_collateral_2311', width:20,height:150,search:false,sortable:false},
      {name:'ca1_interneuron_spec_5_2300', index:'ca1_interneuron_spec_5_2300', width:20,height:150,search:false,sortable:false},
      {name:'ca1_oriens_alveus_2233', index:'ca1_oriens_alveus_2233', width:20,height:150,search:false,sortable:false},
      {name:'ca1_basket_pv_2232', index:'ca1_basket_pv_2232', width:20,height:150,search:false,sortable:false},
      {name:'ca1_basket_cck_2232', index:'ca1_basket_cck_2232', width:20,height:150,search:false,sortable:false},
      {name:'ca1_axo_axonic_2232', index:'ca1_axo_axonic_2232', width:20,height:150,search:false,sortable:false},
      {name:'ca1_interneuron_spec_4_2223', index:'ca1_interneuron_spec_4_2223', width:20,height:150,search:false,sortable:false},
      {name:'ca1_interneuron_spec_2_2100', index:'ca1_interneuron_spec_2_2100', width:20,height:150,search:false,sortable:false},
      {name:'ca1_interneuron_spec_3_2003', index:'ca1_interneuron_spec_3_2003', width:20,height:130,search:false,sortable:false,formatoptions:{baseLinkUrl:'https://goodle.com', addParam: '&action=edit'}},
      {name:'ca1_lm_r_1300', index:'ca1_lm_r_1300', width:20,height:130,search:false,sortable:false},
      {name:'ca1_p_lm_1202', index:'ca1_p_lm_1202', width:20,height:150,search:false,sortable:false},
      {name:'ca1_back_proj_1133p', index:'ca1_back_proj_1133p', width:20,height:150,search:false,sortable:false},
      {name:'ca1_oriens_bistratified_1113p', index:'ca1_oriens_bistratified_1113p', width:20,height:150,search:false,sortable:false},
      {name:'ca1_sr_o_lm_1102', index:'ca1_sr_o_lm_1102', width:20,height:150,search:false,sortable:false},
      {name:'ca1_so_o_lm_1003', index:'ca1_so_o_lm_1003', width:20,height:150,search:false,sortable:false},
      {name:'ca1_o_lm_1002', index:'ca1_o_lm_1002', width:20,height:150,search:false,sortable:false},
      {name:'ca1_bistratified_0333', index:'ca1_bistratified_0333', width:20,height:150,search:false,sortable:false},
      {name:'ca1_ivy_0333', index:'ca1_ivy_0333', width:20,height:150,search:false,sortable:false},
      {name:'ca1_schaffer_coll_assoc_0322', index:'ca1_schaffer_coll_assoc_0322', width:20,height:150,search:false,sortable:false},
      {name:'ca1_c_bistratified_0302', index:'ca1_c_bistratified_0302', width:20,height:150,search:false,sortable:false},
      {name:'ca1_or_proj_031_p', index:'ca1_or_proj_031_p', width:20,height:150,search:false,sortable:false},
      {name:'ca1_radiatum_0300', index:'ca1_radiatum_0300', width:20,height:150,search:false,sortable:false},
      {name:'ca1_is_0221', index:'ca1_is_0221', width:20,height:150,search:false,sortable:false},
      {name:'ca1_is_1c_0203', index:'ca1_is_1c_0203', width:20,height:150,search:false,sortable:false},
      {name:'ca1_trilaminar_0113p', index:'ca1_trilaminar_0113p', width:20,height:150,search:false,sortable:false},
      {name:'ca1_oriens_bistratified_0103', index:'ca1_oriens_bistratified_0103', width:20,height:150,search:false,sortable:false},
      {name:'ca1_interneuron_spec_6_0102', index:'ca1_interneuron_spec_6_0102', width:20,height:130,search:false,sortable:false},
      {name:'ca1_basket_horiz_0012', index:'ca1_basket_horiz_0012', width:20,height:130,search:false,sortable:false},
      {name:'ca1_axo_axonic_horiz_0012', index:'ca1_axo_axonic_horiz_0012', width:20,height:150,search:false,sortable:false},
      {name:'ca1_oriens_oriens_0003', index:'ca1_oriens_oriens_0003', width:20,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
         return 'style="border-right:medium solid red;"';
       }
       },
      {name:'sub_pyramidal_EC_331p', index:'sub_pyramidal_EC_331p', width:20,height:130,search:false,sortable:false},
      {name:'sub_axo_axonic_210', index:'sub_axo_axonic_210', width:20,height:150,search:false,sortable:false},
      {name:'sub_pyramidal_ca1_331p', index:'sub_pyramidal_ca1_331p', width:20,height:150,search:false,sortable:false,
       cellattr: function(rowId, tv, rawObject, cm, rdata) 
       {
         return 'style="border-right:medium solid red;"';
       }
      },
	  {name:'ec_pyramidal_II_333000p', index:'ec_pyramidal_II_333000p', width:20,height:130,search:false,sortable:false,formatoptions:{baseLinkUrl:'https://goodle.com', addParam: '&action=edit'}},
      {name:'ec_bipolar_V_331131p', index:'ec_bipolar_V_331131p', width:20,height:130,search:false,sortable:false},
      {name:'ec_stellate_II_331111p', index:'ec_stellate_II_331111p', width:20,height:150,search:false,sortable:false},
      {name:'ec_fan_II_331000p', index:'ec_fan_II_331000p', width:20,height:150,search:false,sortable:false},
      {name:'ec_medial_pyramidal_III_313300', index:'ec_medial_pyramidal_III_313300', width:20,height:130,search:false,sortable:false,formatoptions:{baseLinkUrl:'https://goodle.com', addParam: '&action=edit'}},
      {name:'ec_lateral_pyramidal_III_233310', index:'ec_lateral_pyramidal_III_233310', width:20,height:130,search:false,sortable:false},
      {name:'ec_pyramidal_II_233111', index:'ec_pyramidal_II_233111', width:20,height:150,search:false,sortable:false},
      {name:'ec_multiform_II_231000', index:'ec_multiform_II_231000', width:20,height:150,search:false,sortable:false},
      {name:'ec_multiform_III_IV_V_223331', index:'ec_multiform_III_IV_V_223331', width:20,height:150,search:false,sortable:false},
      {name:'ec_pyramidal_III_223200p', index:'ec_pyramidal_III_223200p', width:20,height:150,search:false,sortable:false},
      {name:'ec_small_pyramidal_III_223111p', index:'ec_small_pyramidal_III_223111p', width:20,height:150,search:false,sortable:false},
      {name:'ec_stellate_III_223000', index:'ec_stellate_III_223000', width:20,height:150,search:false,sortable:false},
      {name:'ec_oblique_pyramidal_II_221100', index:'ec_oblique_pyramidal_II_221100', width:20,height:150,search:false,sortable:false},
      {name:'ec_horizontal_V_220233p', index:'ec_horizontal_V_220233p', width:20,height:150,search:false,sortable:false},
      {name:'ec_small_pyramidal_V_220033', index:'ec_small_pyramidal_V_220033', width:20,height:150,search:false,sortable:false},
      {name:'ec_pyramidal_V_213330', index:'ec_pyramidal_V_213330', width:20,height:150,search:false,sortable:false},
      {name:'ec_bipolar_III_133100', index:'ec_bipolar_III_133100', width:20,height:150,search:false,sortable:false},
      {name:'ec_lateral_multipolar_III_113330', index:'ec_lateral_multipolar_III_113330', width:20,height:150,search:false,sortable:false},
      {name:'ec_multipolar_III_003310', index:'ec_multipolar_III_003310', width:20,height:150,search:false,sortable:false},
      {name:'ec_multipolar_V_001331', index:'ec_multipolar_V_001331', width:20,height:150,search:false,sortable:false},
      {name:'ec_multipolar_VI_001331', index:'ec_multipolar_VI_001331', width:20,height:150,search:false,sortable:false},
      {name:'ec_multipolar_V_000333p', index:'ec_multipolar_V_000333p', width:20,height:150,search:false,sortable:false},
      {name:'ec_pyramidal_VI_000023', index:'ec_pyramidal_VI_000023', width:20,height:130,search:false,sortable:false,formatoptions:{baseLinkUrl:'https://goodle.com', addParam: '&action=edit'}},
      {name:'ec_superficial_inhib_III_333000', index:'ec_superficial_inhib_III_333000', width:20,height:130,search:false,sortable:false},
      {name:'ec_multipolar_inhib_III_233000', index:'ec_multipolar_inhib_III_233000', width:20,height:150,search:false,sortable:false},
      {name:'ec_basket_II_230000', index:'ec_basket_II_230000', width:20,height:150,search:false,sortable:false},
      {name:'ec_polymorphic_III_113220', index:'ec_polymorphic_III_113220', width:20,height:150,search:false,sortable:false},
      {name:'ec_basket_II_031000', index:'ec_basket_II_031000', width:20,height:150,search:false,sortable:false},
      {name:'ec_axo_axonic_II_030000', index:'ec_axo_axonic_II_030000', width:20,height:150,search:false,sortable:false},
      {name:'ec_pyramidal_like_III_023300', index:'ec_pyramidal_like_III_023300', width:20,height:150,search:false,sortable:false},
      {name:'ec_multiform_III_023000', index:'ec_multiform_III_023000', width:20,height:150,search:false,sortable:false} 
     ], 
    rowNum:125,
    rowList:[125],
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
    	 Merger(gridName,"type");
    	 $grid.jqGrid('setFrozenColumns');
    	 rotateFunction($grid,235); 
    	 fixPositionsOfFrozenDivs.call($grid[0]);
    	} 
    });

	
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
	<font class="font1">Browse connectivity matrix</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
<div class="table_position">
<table border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr>
    <td width="950">
		<table id="nGrid"></table>
		<div id="pager"></div>
	</td>
	<!-- LEGEND -->
	<td width="170" style="vertical-align:top">
	
		<table border="0" cellspacing="5">
			<tr height="50" style='vertical-align:top'>
				<td colspan="2" style="text-align:center"><font class='font5'>View the entire matrix as a <a href='images/connectivity/Connectivity_Matrix.jpg' target='_blank'>.jpg image</a></font></td>				
			</tr>
			<tr height="100" style='vertical-align:top'>
				<td colspan="2" style="text-align:center">
					<script src="https://www.java.com/js/deployJava.js"></script>
    				<script>
    					var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    					if (isChrome) {
    						document.write("<font class='font5'>View the <a href=\"connectivity/applications/connectivity_map.jnlp\">Potential Connectivity Map</a> (Java)");
    						document.write("<br><br>(If trouble launching, view <a href=\"Help_ConnectivityJava.php\" target=\"_blank\">help</a>)</font>");
    					}
    					else {
    						document.write("<font class='font5'>View the Potential Connectivity Map (JAVA)");
        					
					        // use JavaScript to get location of JNLP file relative to HTML page
					        var dir = location.href.substring(0, location.href.lastIndexOf('/')+1);
					        var url = dir + "connectivity/applications/connectivity_map.jnlp";
					        deployJava.createWebStartLaunchButton(url, '1.7.0');
					        document.write("<br><br>If trouble launching, view <a href=\"Help_ConnectivityJava.php\" target=\"_blank\">help</a></font>");
    					}
				    </script>				    
			    </td>					
			</tr>
			<tr height="50">
        <td colspan="2" style="text-align:center"><font class='font7'>Download</font></td>
      </tr>
      <tr height="20">
        <td style="text-align:center"><a href="data/Netlist.csv"><img id="csvCN" src='images/ExportCSV.png' width="30px" border="0"/></a></td>
        <td><font class='font5'>Netlist</font></td>
        <td></font></td> 
        <!--td align="right"><font class='font5'><p id="cle2"></p></font></td-->
      </tr>
     
			<tr height="50">
				<td colspan="2" style="text-align:center"><font class='font7'>Legend</font></td>
			</tr>
			<tr height="20">
				<!-- <td width="10"><img src='images/connectivity/excitatory.png' width="13px" border="0"/></td>  -->
				<td bgcolor=#000000></td>
				<td><font class='font5'>Potential Excitatory Connections</font></td>
				<td align="right"><font class='font5'><p id="Potential_Excitatory_Non_PCL"></p></font></td>
				<!--td align="right"><font class='font5'><p id="cle3"></p></font></td-->
			</tr>
			<tr height="20">
				<!-- <td><img src='images/connectivity/inhibitory.png' width="13px" border="0"/></td>  -->
				<td bgcolor=#AAAAAA></td>
				<td><font class='font5'>Potential Inhibitory Connections</font></td>
				<td align="right"><font class='font5'><p id="Potential_Inhibitory_Non_PCL"></p></font></td> 
				<!--td align="right"><font class='font5'><p id="cle5"></p></font></td-->
			</tr>
			<!--
			<tr>
				< ! -- <td><img src='images/connectivity/PCL_only.png' width="13px" border="0"/></td>  -- >
				<td bgcolor=#FF8C00></td>
				<td><font class='font5'>Potential Inhibitory PCL-Only Connection</font></td>
				<td align="right"><font class='font5'><p id="PCL_Only"></p>0</font></td>
			</tr>
			-->
			<!--
			<tr height="20"></tr>
				<tr>
					<td><img src='images/connectivity/AIS_targeting.png' width="13px" border="0"/></td>
					<td><font class='font5'>PCL AIS Connection</font></td>
				</tr>
				<tr> 	
					<td><img src='images/connectivity/perisomatic_targeting.png' width="13px" border="0"/></td>
					<td><font class='font5'>PCL Perisomatic Connection</font></td>
				</tr>  
			-->
			<tr height="20">
				<td style="text-align:center"><img src='images/connectivity/known_connection.png' width="20px" border="0"/></td>
				<td><font class='font5'>Known Connections</font></td>
				<td align="right"><font class='font5'><p id="id_knowncount"></p></font></td>
				<!--td align="right"><font class='font5'><p id="cle"></p></font></td-->
			</tr>
			<tr height="20">
				<td style="text-align:center"><img src='images/connectivity/known_nonconnection.png' width="20px" border="0"/></td>
				<td><font class='font5'>Refuted Connections</font></td>
				<td align="right"><font class='font5'><p id="id_Unknowncount"></p></font></td> 
				<!--td align="right"><font class='font5'><p id="cle2"></p></font></td-->
			</tr>
      
       
			<!--  
			<tr height="20"></tr>
			<tr>			
				<td><font class='font5'>PCL:</font></td>
				<td><font class='font5'>Principal Cell Layer</font></td>
			</tr>
		 	-->
			<!--  
				<tr>
					<td><font class='font5'>AIS:</font></td>
					<td><font class='font5'>Axon Intial Segment</font></td>
				</tr>
		 	-->
		</table>
	</td>
	
  </tr>
</table>
</div>
</body>
</html>
