<?php

class ulToolkit
{
	public static function stripText($text)
	{
		$text = strtolower($text);
		
		// @todo: falla. Añade una a antes de cada carácter raro
	 	// change non-latin characters to nearest latin equivalent
		$search = array ('/[áàâäÂÄ]/i','/[éèêëÊË]/i','/[íîïÎÏ]/i','/[óôöÔÖ]/i','/[úûùüÛÜ]/i','/[ñ]/i','/[ç]/i');
		$replace = array ('a','e','i','o','u','n','c');
		$text = preg_replace($search, $replace, $text);
				
		// strip all non word chars
		$text = ereg_replace('[^A-Za-z0-9]', ' ', $text); // este es más restrictivo
		//$text = preg_replace('/\W/', ' ', $text);

		// replace all white space sections with a dash
		$text = preg_replace('/\ +/', '-', $text);

		// trim dashes
		$text = preg_replace('/\-$/', '', $text);
		$text = preg_replace('/^\-/', '', $text);

		return $text;
	}
}
