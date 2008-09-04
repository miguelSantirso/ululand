<?php

/**
 * Subclass for performing query and update operations on the 'game' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GamePeer extends BaseGamePeer
{
	/**
	 * Retorna un juego identificado por su apikey 
	 *
	 * @param varchar(13) $apikey
	 * @return juego cuyo apikey es el pasado como parámetro
	 */
	public static function retrieveByApiKey($apikey)
	{
		$c = new Criteria();
		$c->add(GamePeer::API_KEY, $apikey);

		return GamePeer::doSelectOne($c);
	}
	
	/**
	 * Genera una clave de la api para un widget
	 *
	 * @return Una api key �nica
	 */
	public static function generateApiKey()
	{
		$apiKey = 'g'; // La api key empieza por g para indicar que es un juego
		
		do
		{
		    $apiKey .= GamePeer::generateRandomString(12);
		    
		    $c = new Criteria();
		    $c->add(GamePeer::API_KEY, $apiKey);
		    $result = GamePeer::doSelectOne($c);
		} while($result);
		
		return $apiKey;
	}
	
	/**
	 * Genera una cadena aleatoria de la longitud indicada
	 *
	 * @param integer $length longitud deseada de la cadena a generar
	 * @return cadena aleatoria de la longitud indicada
	 */
	protected static function generateRandomString($length)
	{
	    $chars = "abcdefghijklmnopqrstuvwxyz0123456789"; 
	    srand((double)microtime()*1000000); 
	    $i = 0;
	
	    $string = "";
	    while ($i <= $length)
	    { 
	        $num = rand() % 35; 
	        $tmp = substr($chars, $num, 1); 
	        $string = $string . $tmp; 
	        $i++; 
	    } 
	
	    return $string;
	}
}
