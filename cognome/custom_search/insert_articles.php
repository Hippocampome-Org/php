<?php include ("../permission_check.php"); ?>
<?php
/*
	Reference: https://www.alibabacloud.com/blog/how-to-work-with-blob-in-mysql-database-hosted-on-alibaba-cloud_594270
*/

$dir = "/var/www/html/cognome_articles_renamed/core_collection/txt_ver_rnm/";

// open connection
$articles_conn = mysqli_connect($cog_servername, $cog_username, $cog_password, "cognome");
if (mysqli_connect_errno()) { 
	echo mysqli_error($articles_conn);
	exit();
}

// reset table
$sql = "TRUNCATE TABLE article_text;";
if (!mysqli_query($articles_conn, $sql)) {
	echo mysqli_error($articles_conn);
}

function insert_article($articles_conn, $filename, $dir) {
	// insert article text into db
	$article_text = mysqli_real_escape_string($articles_conn, file_get_contents($dir.$filename));
	$article_id = ltrim($filename, "0");
	$article_id = str_replace(".txt", "", "$article_id");

	$sql= "INSERT INTO article_text (article_id, article_text) VALUES ('$article_id','$article_text')";

	if (!mysqli_query($articles_conn,$sql)) {
		echo mysqli_error($articles_conn);
	}
}

// process directory
$articles = array();
if ($handle = opendir($dir)) {
    while ($file = readdir($handle)) {
    	if ($file != "." && $file != "..") {
    		//echo "$file"."<br>";
    		array_push($articles, $file);
    	}
    }
}
closedir($handle);
sort($articles);

foreach ($articles as $filename) {
	insert_article($articles_conn, $filename, $dir);
}

// example article text
$show_example = true;
if ($show_example) {
	include('secret_key.php');
	$max_text_size = 1000000000;
	$sql = "SELECT SUBSTRING(article_text,1,".$max_text_size.") FROM article_text WHERE article_id = 8;";
	$result = $cog_conn->query($sql);
	if ($result->num_rows > 0) {       
	  while($row = $result->fetch_assoc()) {  
	  	echo $row["SUBSTRING(article_text,1,".$max_text_size.")"];
	  }
	}
}

echo "<br><br><center>Processing completed.</center>";

// close connection
mysqli_close($articles_conn);

?>