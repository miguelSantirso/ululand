<?php

/**
 * Subclass for performing query and update operations on the 'apisession' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ApiSessionPeer extends BaseApiSessionPeer
{
	public static function createNew($clientUuid, $userUuid, $privilegesLevel)
	{
		$newApiSession = new ApiSession();
		$newApiSession->setSessionId(ApiSessionPeer::generateRandomString(12));
		$newApiSession->setClientUuid($clientUuid);
		$newApiSession->setUserUuid($userUuid);
		$newApiSession->setPrivilegesLevel($privilegesLevel);
		
		$newApiSession->save();
		
		return $newApiSession;
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
	    $string = '' ; 
	
	    while ($i < $length)
	    { 
	        $num = rand() % 35; 
	        $tmp = substr($chars, $num, 1); 
	        $string = $string . $tmp; 
	        $i++; 
	    } 
	
	    return $string;
	}
}
