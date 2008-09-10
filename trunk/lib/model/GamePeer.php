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

}
