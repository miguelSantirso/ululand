<?php

/**
 * Subclass for performing query and update operations on the 'item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ItemPeer extends BaseItemPeer
{
	static protected $GENDER_INTEGERS = array('male', 'female', 'both');
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
}
