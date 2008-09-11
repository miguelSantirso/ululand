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
	 * Retorna un juego identificado por su uuid 
	 *
	 * @param varchar(36) $uuid
	 * @return juego cuyo uuid es el pasado como parámetro
	 */
	public static function retrieveByUuid($uuid)
	{
		$c = new Criteria();
		$c->add(GamePeer::UUID, $uuid);

		return GamePeer::doSelectOne($c);
	}

}
