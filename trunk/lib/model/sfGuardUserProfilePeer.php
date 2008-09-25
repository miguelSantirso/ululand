<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
	public static function retrieveByUsername($username)
	{
		$c = new Criteria();
		$c->add(sfGuardUserProfilePeer::USERNAME, $username);
		return sfGuardUserProfilePeer::doSelectOne($c);
	}
	
	/**
	 * Retorna un usuario identificado por su uuid 
	 *
	 * @param varchar(36) $uuid
	 * 
	 * @return usuario cuyo uuid es el pasado como parámetro
	 */
	public static function retrieveByUuid($uuid)
	{
		$c = new Criteria();
		$c->add(sfGuardUserProfilePeer::UUID, $uuid);

		return sfGuardUserProfilePeer::doSelectOne($c);
	}
}
