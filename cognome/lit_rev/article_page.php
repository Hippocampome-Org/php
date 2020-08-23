<html>
<head>
</head>
<body>
	<?php 
		$article_url = $_REQUEST['article_url'];
		echo file_get_contents($article_url); 
	?>
</body>
</html>