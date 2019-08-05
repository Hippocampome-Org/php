<?php
  include ("permission_check.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<script type="text/javascript" src="style/resolution.js"></script>
<link rel="stylesheet" href="function/menu_support_files/menu_main_style.css" type="text/css" />
<?php include ("function/icon.html"); ?>
<script type="text/javascript" src="style/resolution.js"></script>
<link href="Fixed-Header-Table-master/css/fixedHeaderTable_defaultTheme.css" rel="stylesheet" media="screen" />
<link href="Fixed-Header-Table-master/css/CLR_theme.css" rel="stylesheet" media="screen" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="jqGrid-4/css/ui.jqgrid.css" />
<script src="jqGrid-4/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
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
// new entry
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
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
  include ("function/title.php");
  include ("function/menu_main.php");
?>  

<div class='title_area'>
  <font class="font1">Browse synaptome matrix</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<div class="table_position">
<table border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr>
    <td width="950">
      <table id="list4"></table>
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
                  document.write("<font class='font5'>View the <a href=\"connectivity/applications/connectivity_map.jnlp\">Potential Synaptome Map</a> (Java)");
                  document.write("<br><br>(If trouble launching, view <a href=\"Help_ConnectivityJava.php\" target=\"_blank\">help</a>)</font>");
                }
                else {
                  document.write("<font class='font5'>View the Potential Synaptome Map (JAVA)");
                    
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
          <td style="text-align:center"><a href="#"><img id="csvCN" src='images/ExportCSV.png' width="30px" border="0"/></a></td>
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
        <tr height="20">
          <td style="text-align:center"><img src='images/connectivity/known_connection.png' width="20px" border="0"/></td>
          <td><font class='font5'>Known Connections</font></td>
          <td align="right"><font class='font5'><p id="id_knowncount"></p></font></td>
          <!--td align="right"><font class='font5'><p id="cle"></p></font></td-->
        </tr>
        <tr height="20">
          <td style="text-align:center"><img src='images/connectivity/known_nonconnection.png' width="20px" border="0"/></td>
          <td><font class='font5'>Refuted Connections Testing</font></td>
          <td align="right"><font class='font5'><p id="id_Unknowncount"></p></font></td> 
          <!--td align="right"><font class='font5'><p id="cle2"></p></font></td-->
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
</body>
</html>