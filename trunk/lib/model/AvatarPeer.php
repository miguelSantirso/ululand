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

	/**
	 * Retorna el avatar identificado por su uuid 
	 *
	 * @param varchar $uuid
	 * @return avatar cuyo uuid es el pasado como parámetro
	 */
	public static function retrieveByUuid($uuid)
	{
		$c = new Criteria();
		$c->add(AvatarPeer::UUID, $uuid);
		
		return AvatarPeer::doSelectOne($c);
	}

}
