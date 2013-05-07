<?php
session_start();

$link_isbn = 'http://openlibrary.org/search?q=';

include ("name_table.php");
// MySQL database connection: *********************************************************************************
$database = mysql_connect('localhost', 'hdb', '');
$var=mysql_select_db('hippocampome');   // Name of MySQL database (my_tumor)
//**************************************************************************************************************
?>
