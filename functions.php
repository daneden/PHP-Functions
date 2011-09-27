<?php

function clean($str) { /* sanatize strings for databases & security */
  $str = @trim($str);
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

/* turning new lines into paragraph tags */
/* USAGE: echo nl2p($string); */
function nl2p($string, $line_breaks = true, $xml = true) {
    // Remove existing HTML formatting to avoid double-wrapping things
    $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);
    
    // It is conceivable that people might still want single line-breaks
    // without breaking into a new paragraph.
    if ($line_breaks == true)
        return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '<br'.($xml == true ? ' /' : '').'>'), trim($string)).'</p>';
    else 
        return '<p>'.preg_replace("/([\n]{1,})/i", "</p>\n<p>", trim($string)).'</p>';
}

function genPassword($length = 8) { /* generate an 8-character random password/string */
    $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";
    $validCharNumber = strlen($validCharacters);
 
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
 
    return $result;
}

/* turns urls to hyperlinks */
/* USAGE: echo urls_to_links('http://daneden.me'); outputs <a href="http://daneden.me">http://daneden.me</a> */
function urls_to_links($str) { /* Credit for this function goes to @coleydotco */
    $pattern = '/((?:http|https)(?::\\/{2}[\\w]+)(?:[\\/|\\.]?)(?:[^\\s"]*))/is';
    $replace = '<a target="blank" href="$1">$1</a>';
    return preg_replace($pattern, $replace, $str);
}

?>