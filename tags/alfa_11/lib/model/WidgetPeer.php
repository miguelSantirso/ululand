<?php

/**
 * Subclass for performing query and update operations on the 'widget' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WidgetPeer extends BaseWidgetPeer
{
	public static function retrieveByName($name)
	{
		$c = new Criteria();
		$c->add(WidgetPeer::NAME, $name);
		
		return WidgetPeer::doSelectOne($c);
	}

	/**
	 * Genera una clave de la api para un widget
	 *
	 * @return Una api key �nica
	 */
	public static function generateApiKey()
	{
		$apiKey = 'w'; // La api key empieza por w para indicar que es un widget
		
		do
		{
		    $apiKey .= WidgetPeer::generateRandomString(12);
		    
		    $c = new Criteria();
		    $c->add(WidgetPeer::API_KEY, $apiKey);
		    $result = WidgetPeer::doSelectOne($c);
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
