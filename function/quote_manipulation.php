<?php

function quote_replaceIDwithName($theQuote)
{
	// find all <% cell ID %>
	preg_match_all('/\<% ([^<>]+) %\>/', $theQuote, $matches, PREG_PATTERN_ORDER);	
		
	$u = 0;	
	foreach ($matches[1] as $match) {
		$idArray[] = $match;
		
		$fetch_query="SELECT subregion, nickname FROM Type WHERE id=$match";
		$query_result = mysql_query($fetch_query);

		while($subs_and_nicks = mysql_fetch_array($query_result, MYSQL_ASSOC)) {
			//$subs[$u] = $subs_and_nicks['subregion'];
			//$nicks[$u] = $subs_and_nicks['nickname'];
			$printable_subs_and_nicks[$u] = '{' . $subs_and_nicks['subregion'] . ' ' . $subs_and_nicks['nickname'] . '}';
			$u++;
		}		
	}
	
	if (!empty($printable_subs_and_nicks)) {
		// replace <% cell ID %> with {cell type name} by using regular expression search
		$newQuote = preg_replace_callback('/\<% [^<>]+ %\>/', function($matches) use (&$printable_subs_and_nicks) {
			return array_shift($printable_subs_and_nicks);
		}, $theQuote);
	}
	else {
		preg_match('/\<% ([^<>]+) %\>/', $theQuote, $matches);
		$newQuote = preg_replace('/\<% [^<>]+ %\>/', '{ <B>!! cell ID ' . $matches[1] . ' not found !!</B> }', $theQuote);
	}
	
	return ($newQuote);
}
?>
