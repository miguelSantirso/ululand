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
	static protected $GENDER_INTEGERS = array('male', 'female');
	static protected $GENDER_VALUES = null;
	
	public static function getGenderFromIndex($index)
	{
		if(is_null($index)) return null;
		
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
