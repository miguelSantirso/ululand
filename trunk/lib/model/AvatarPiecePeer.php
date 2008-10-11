<?php

/**
 * Subclass for performing query and update operations on the 'avatarpiece' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AvatarPiecePeer extends BaseAvatarPiecePeer
{
	/**
	 * Retorna la pieza de avatar según el uuid indicado
	 *
	 * @param string $uuid uuid de la pieza de avatar
	 */
	public static function retrieveByUuid($uuid)
	{
		$c = new Criteria();
		$c->add(AvatarPiecePeer::UUID, $uuid);
		
		return AvatarPiecePeer::doSelectOne($c);
	}
}
