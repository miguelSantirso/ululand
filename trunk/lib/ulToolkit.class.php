<?php

class ulToolkit
{
	public static function stripText($text)
	{
		$text = strtolower($text);
		
		// Reemplazar caracteres especiales de español
		// @todo: esto no funciona, no se por qué.
		$specialChars = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$goodChars    = array('a', 'e', 'i', 'o', 'u', 'n');
		$text = str_replace($specialChars, $goodChars, $text);
				
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
