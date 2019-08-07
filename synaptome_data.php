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
<link rel="stylesheet" href="synaptome/synaptome.css" type="text/css" />
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

<?php
/*function switch_tabs($tab) {
  if ($tab=='mstr_50_rows') {
    echo "<script>document.getElementById('matrix_1').innerHTML = 'Fred Flinstone';</script>";
  }
  else if ($tab=='mstr_all_rows') {
    echo "<script>document.getElementById('matrix_1').innerHTML = 'Barney Rubble';</script>";
  }
}*/
/*echo '
<script>
function update_tab_1() {  
  document.getElementById(\'matrix_1\').innerHTML = "';
  include ('synaptome/master_50_rows.php');
  echo '"}
</script>
';*/
?> 
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
  include ("function/title.php");
  include ("function/menu_main.php");
?>  

<div class='title_area'>
  <font class="font1">Browse synaptome matrix</font>&nbsp;&nbsp;&nbsp;
  <span class="main_tabs main_tab_1">
    <!--<a href="?tab=mstr_50_rows">mstr_50_rows</a>-->
    <a href="?tab=mstr_50_rows" style="text-decoration: none;">mstr_50_rows</a>
  </span>
  <span class="tab_space">&nbsp;</span>
  <span class="main_tabs main_tab_2">
    <a href="?tab=mstr_all_rows" style="text-decoration: none;">mstr_all_rows</a>
  </span>
  <span class="tab_space">&nbsp;</span>
  <span class="main_tabs main_tab_3">
    <a href="?tab=n_by_m" style="text-decoration: none;">n_by_m</a>
  </span>
  &nbsp;&nbsp;&nbsp;
</div>

<div class="table_position">
<table border="0" cellspacing="0" cellpadding="0" class='body_table'>
  <tr>
    <td width="950">
      <div id="matrix_1">
        <?php 
          if (isset($_GET['tab'])) {
            $matrix_tab = $_GET['tab'];
            if ($matrix_tab=='mstr_50_rows') {
              include ("synaptome/master_50_rows.php");
            }
            else if ($matrix_tab=='mstr_all_rows') {
              include ("synaptome/master_all_rows.php");
            } 
            else if ($matrix_tab=='n_by_m') {
              include ("synaptome/n_by_m.php");
            }                        
          }
          else {
            include ("synaptome/master_50_rows.php");
          }
        ?>
      </div>
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
          <td><font class='font5'>Refuted Connections</font></td>
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