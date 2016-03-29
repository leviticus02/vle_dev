<?php

function links($string) {
	//$postLinks = preg_replace('/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i','<a target=\'_blank\' href=\'$1\'>$1</a>', $string);
	
	$match_href = '|((https?://)?([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i';
	$replace_url = '<a href="$1">$3</a>';
	$postLinks = preg_replace($match_href, $replace_url, $string);
	
	return $postLinks;
}