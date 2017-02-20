<?php
/*
Author: Amar Gawade
Created: 01/30/2017

*/
include ("permission_check.php");
require_once("SearchEngine/ParenthesisParser.php");
require_once("SearchEngine/NeuronConnection.php");
require_once('SearchEngine/Parser.php');
require_once('SearchEngine/MorphologyPage.php');
require_once('SearchEngine/Term.php');
require_once('SearchEngine/QueryUtil.php');
require_once('SearchEngine/page.php');
require_once("access_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php include ("function/icon.html"); ?>
	<title>Search Engine</title>
	<script type="text/javascript" src="style/resolution.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<script src="DataTables-1.9.4/media/js/jquery.js" type="text/javascript"></script>
	<script src="DataTables-1.9.4/media/js/jquery.dataTables.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="DataTables-1.9.4/media/css/demo_table_jui.css"/>
	<link rel="stylesheet" type="text/css" href="DataTables-1.9.4/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css"/>
</head>
<body>
	<?php 
		include ("function/title.php");
		include ("function/menu_main.php");
	?>	
	<div class='title_area'>
		<font class="font1">Search Engine</font>
	<form action="search_engine_custom.php" method="post" style="display:inline">
			<table border="0" cellspacing="3" cellpadding="0" class='table_search'>
				<td width="30%" align="center" class='table_neuron_page1'>
					<strong>Search Query String</strong>				
				</td>
				<td width="70%">
					<textarea name='query_str' rows='5' cols='100'><?php if($_REQUEST['query_str']) print($_REQUEST['query_str']); ?></textarea>
				</td>
			</tr>
			<tr>			
				<td width="30%" >
					
				</td>
				<td width="70%" align='right'>
					<input type="submit" name='search_engine' value='SEE RESULTS' />
				</td>			
			</table>		
	</form>
<?php
/**
 * User: Gas10
 */
if($_REQUEST['search_engine']){
	$qeueryString = trim($_REQUEST['query_str']);
	#$qeueryString="Connection:(Presynaptic:(Morphology:(Soma:DG:??1? AND Dendrites:DG:22?? AND Axons:DG:001?) AND Neurotransmitter:Inhibitory), Postsynaptic:(Morphology:DG:2201 AND Name:\"Granule\"))";
	#echo "query<br>".$qeueryString;
	$test=new Parser();
	$test->setSearchQuery($qeueryString);
	#$test->parseQuery();
	#print("<pre>".print_r($test->parseQuery(),true)."</pre>");
	#print("<pre>".print_r($test->findConnection(array(1000),array(1002,1009)),true)."</pre>");
	$matchingConn=$test->parseQuery();
	if(count($matchingConn)==0){
		print('No Matching Connection Found');
	}
	else{
		print('<table border="0" cellspacing="3" cellpadding="0" class="table_result">');
		print('<tr><td align="center" width="5%" class="table_neuron_page3" > Index </td>');
		print("<td align='center' width='40%' class='table_neuron_page3'> Source Neuron </td>");
		print ("<td align='center' width='40%' class='table_neuron_page3'> Destination Neuron </td><td align='center' width='15%'></tr>");
		for($i=0;$i<count($matchingConn);$i++){
			print('<tr><td align="center" width="5%" class="table_neuron_page4">'.($i+1).'</td>');
			print("<td align='center' width='40%' class='table_neuron_page4'>
				<a href='neuron_page.php?id=".$matchingConn[$i]->getSourceId()."'>
				<font class='font13'>".$matchingConn[$i]->getSourceName() . "</font>
				</a></td>");
			print ("<td align='center' width='40%' class='table_neuron_page4'> 
				<a href='neuron_page.php?id=".$matchingConn[$i]->getDestinationId()."'>
				<font class='font13'>".$matchingConn[$i]->getDestinationName() . "</font>
				</a></td>
				<td align='center' width='15%'></tr>");
		}
		print("</table>");
	}
}
?>
</div>
</body>
</html>