<?php

$query = "SELECT permission FROM user WHERE id = '2'";
$rs = mysql_query($query);
while(list($permission) = mysql_fetch_row($rs)) {
	if ($permission == 0) {
		$permission1 = $permission;
		$_SESSION['perm'] = 0;
	}
	else{
		$_SESSION['perm'] = 1;
	}
}
$perm = $_SESSION['perm'];
if ($perm == 1 && $_SESSION['flag']== NULL){
	header("Location:error1.html");}
else {}
?>