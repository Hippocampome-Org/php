<html>
<head>
</head>
<body>
	<?php 
		/*$article_url = $_REQUEST['article_url'];
		echo file_get_contents($article_url); */
		//http://google.com/search?q=A+synaptic+model+of+memoy%3A+long-term+potentiation+in+the+hippocampus&oq=A+synaptic+model+of+memory%3A+long-term+potentiation+in+the+hippocampus
		//http://google.com/search?igu=1&q=A+synaptic+model+of+memoy%3A+long-term+potentiation+in+the+hippocampus&oq=A+synaptic+model+of+memory%3A+long-term+potentiation+in+the+hippocampus
		//https://scholar.google.com/scholar?hl=en&as_sdt=0%2C47&q=A+synaptic+model+of+memory%3A+long-term+potentiation+in+the+hippocampus&btnG=
		$article_url = $_REQUEST['article_url'];
		$article_url2 = str_replace(" ", "+", $article_url);
		$site = file_get_contents("http://google.com/search?igu=1&q=".$article_url2);
		//echo "http://google.com/search?igu=1&q=".$article_url2;
		$site2 = str_replace("href=\"/url?q=", "target='blank' href=\"https://www.google.com/url?q=", $site);
		//preg_match('/url\?q\=(.*)&sa.*/', $site, $site_regex_results);
		//preg_replace('/(.*)[&]sa[a-zA-Z=&1-9]+/', '$0 --> $1', $site);
		//$site2 = str_replace("/url?q=", "https://www.google.com/url?q=", $site);
		//preg_replace('/(.*)&sa[a-zA-Z=&1-9]+/', '$0 --> $1', $site);
		//http://localhost/url?q=https://www.nature.com/articles/361031a0&sa=U&ved=2ahUKEwj1-I7zyMnrAhXlgXIEHY6xBsUQFjABegQIAxAB&usg=AOvVaw0ra3wA5lXVH6VK4ccA3tbW
		//https://www.nature.com/articles/361031a0
		//preg_match('/url\?q\=(.*)&sa[a-zA-Z=&1-9]+/', $site, $site_regex_results);
		/*preg_match('/(http.*)/', $site, $site_regex_results);
		foreach ($site_regex_results as $result) {
			echo $result;
		}
		echo sizeof($site_regex_results);*/
		//echo $site_regex_results[1];
		echo $site2;
	?>
	<!--iframe height="100%" width="100%" src="http://google.com/search?igu=1&q=A+synaptic+model+of+memoy%3A+long-term+potentiation+in+the+hippocampus&oq=A+synaptic+model+of+memory%3A+long-term+potentiation+in+the+hippocampus"></iframe-->
</body>
</html>