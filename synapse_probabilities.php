<?php
  include ("permission_check.php");
?>
<!--
	Reference: javascript menu, http://www.javascriptkit.com/javatutors/dombos4.shtml
-->
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
<link rel="stylesheet" href="synap_prob/synaptome.css" type="text/css" />
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
  if (isset($_GET['tab'])) {
    $matrix_tab = $_GET['tab'];
    if ($matrix_tab=='review_evidence') {
      echo "<style></style>";
      echo "<link rel='stylesheet' href='synap_prob/review_evidence.css' type='text/css' />";
    }    
    if ($matrix_tab=='n_by_m' || $matrix_tab=='a_d_l' || $matrix_tab=='s_d' || $matrix_tab=='p_s') {
      echo "<style></style>";
      echo "<link rel='stylesheet' href='synap_prob/n_by_m.css' type='text/css' />";
    }    
  }
  else {
    echo "<style></style>";
    echo "<link rel='stylesheet' href='synap_prob/n_by_m.css' type='text/css' />";
  }
?>

<script type="text/javascript">
function go(){
location=
document.main_matrix_selection.matrix_selection.
options[document.main_matrix_selection.matrix_selection.selectedIndex].value
}
</script>
</head>

<body>

<!-- COPY IN ALL PAGES -->
<?php 
  include ("function/title.php");
  include ("function/menu_main.php");
?>  

<div class='title_area'>
  <span style='position:relative;float:left;'><font class="font1">Browse synaptic connections matrix</font>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<form name="main_matrix_selection">	
<span class='top_matrix_menu'>	
<select name="matrix_selection" size="1" onChange="go()">
<option value="#">Select Data</option>
<option value="?tab=a_d_l">Dendritic and Axonal Lengths</option>
<option value="?tab=s_d">Somatic Distances</option>
<option value="?tab=p_s">Synapse Probabilities</option>
</select></span>

<?php
if (isset($_GET['tab'])) {
  if ($matrix_tab=='a_d_l') {
    echo "<span class='data_selection'>Dendritic and Axonal Lengths</span>";
  }    
  if ($matrix_tab=='s_d') {
    echo "<span class='data_selection'>Somatic Distances of Dendrites and Axons</span>";
  }
  if ($matrix_tab=='p_s') {
    echo "<span class='data_selection'>Probabilities of Synapses</span>";
  }            
}
else {
  echo "<span class='data_selection'>Dendritic and axonal lengths</span>";
}
?>
</form>
</div>

<div class="table_position">
<table border="0" cellspacing="0" cellpadding="0" class='body_table' style='z-index: 0;'>
  <tr>
    <td width="950">
      <div id="matrix_1">
        <?php 
          if (isset($_GET['tab'])) {
            if ($matrix_tab=='mstr_50_rows') {
              include ("synap_prob/master_50_rows.php");
            }
            else if ($matrix_tab=='mstr_all_rows') {
              include ("synap_prob/master_all_rows.php");
            } 
            else if ($matrix_tab=='review_evidence') {
              include ("synap_prob/review_evidence.php");
            } 
            else if ($matrix_tab=='papers') {
              include ("synap_prob/papers.php");
            }            
            else if ($matrix_tab=='n_by_m') {
              include ("synap_prob/n_by_m_7.php");
            }  
            else if ($matrix_tab=='a_d_l') {
              include ("synap_prob/n_by_k.php");
            }
            else if ($matrix_tab=='s_d') {
              include ("synap_prob/n_by_k.php");
            }
            else if ($matrix_tab=='p_s') {
              include ("synap_prob/p_s.php");
            }                      
          }
          else {
            include ("synap_prob/n_by_k.php");
          }
        ?>
      </div>
    </td>
    <!-- LEGEND -->
    <td width="170" style="vertical-align:top;padding: 5px;">    
    	
    </td>
  </tr>
</table>
</div>
</body>
</html>