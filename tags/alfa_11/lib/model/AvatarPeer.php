<?php

/**
 * Subclass for performing query and update operations on the 'avatar' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AvatarPeer extends BaseAvatarPeer
{
	static protected $GENDER_INTEGERS = array('male', 'female');
	static protected $GENDER_VALUES = null;
	
	public static function getGenderFromIndex($index)
	{
		return self::$GENDER_INTEGERS[$index];
	}
	
	public static function getGenderFromValue($value)
	{
		if(!self::$GENDER_VALUES)
		{
			self::$GENDER_VALUES = array_flip(self::$GENDER_INTEGERS);
		}
		
		$valueLower = strtolower($value);
		
		if(!isset(self::$GENDER_VALUES[$valueLower]))
		{
			throw new PropelException(sprintf('Gender cannot take "%s" as a value', $valueLower));
		}
		
		return self::$GENDER_VALUES[$valueLower];
	}

	/**
	 * Retorna el avatar identificado por su apikey 
	 *
	 * @param varchar(13) $apikey
	 * @return avatar cuyo apikey es el pasado como parámetro
	 */
	public static function retrieveByApiKey($apikey)
	{
		$c = new Criteria();
		$c->add(AvatarPeer::API_KEY, $apikey);
		
		return AvatarPeer::doSelectOne($c);
	}

	/**
	 * Genera una clave de la api para un avatar
	 *
	 * @return Una api key �nica
	 */
	public static function generateApiKey()
	{
		$apiKey = 'a'; // La api key empieza por a para indicar que es un juego
		
		do
		{
		    $apiKey .= AvatarPeer::generateRandomString(12);
		    
		    $c = new Criteria();
		    $c->add(AvatarPeer::API_KEY, $apiKey);
		    $result = AvatarPeer::doSelectOne($c);
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
