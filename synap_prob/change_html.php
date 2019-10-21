<?php
	function change_html($id, $text, $append) {
		if ($append) {
			echo "<script>
			var existing_html=document.getElementById(\"".$id."\").innerHTML;
			document.getElementById(\"".$id."\").innerHTML = existing_html+'".$text."'
			</script>";
		}
		else {
			echo "<script>document.getElementById(\"".$id."\").innerHTML = \"".$text."\";</script>";
		}
	}
?>