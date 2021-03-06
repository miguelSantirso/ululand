<?php

/**
 * Subclass for representing a row from the 'avatar' table.
 *
 *
 *
 * @package lib.model
 */
class Avatar extends BaseAvatar
{
	/**
	 * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->name;
	}

	public function setProfile($v)
	{
		$this->setsfGuardUserProfile($v);		
	}
	public function getProfile()
	{
		$this->getsfGuardUserProfile();		
	}
	

}
sfPropelBehavior::add('Avatar', array('sfPropelUuidBehavior'));