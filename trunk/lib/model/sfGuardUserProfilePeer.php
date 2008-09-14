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
}
