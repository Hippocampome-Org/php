<?php
$perm = $_SESSION['perm'];
if ($perm == NULL) {
	$query = "SELECT permission FROM user WHERE id = '2'";
	$rs = mysql_query($query);
	while (list($permission) = mysql_fetch_row($rs)) {
		if ($permission == 1) {
			$permission1 = $permission;
			$anonymous = 1;
		}
		else {
			$anonymous = 0;
		}
	}
	if ($anonymous == 0) {
		header("Location:error1.html");
	}
}
?>