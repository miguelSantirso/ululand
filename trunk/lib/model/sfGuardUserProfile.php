<?php

/**
 * Subclass for representing a row from the 'sf_guard_user_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class sfGuardUserProfile extends BasesfGuardUserProfile
{
	public function __toString()
	{
		if($this->isFilledIn())
		{
			return $this->getUsername();
		}
		else
		{
			return __("Registered User")." #".$this->getId();
		}
	}
	
	public function isFilledIn()
	{
		return $this->getUsername();
	}
	
	/**
	 * Retorna true si el usuario tiene cuenta de desarrollador 
	 *
	 * @return unknown
	 */
	public function isDeveloper()
	{
			return count($this->getDeveloperProfiles()) > 0;
	}
	
	/**
	 * Retorna true si el usuario tiene cuenta de jugador
	 *
	 * @return unknown
	 */
	public function isPlayer()
	{
			return count($this->getPlayerProfiles()) > 0;
	}
		
	/**
	 * Retorna el perfil de desarrollador asociado al perfil de usuario o null si no existe.
	 *
	 * @param boolean $forceCreation Si vale true, crea un perfil de desarrollador en caso de no existir.
	 * @return El perfil de desarrollador asociado al perfil de usuario o null si no existe.
	 */
	public function getDeveloperProfile($forceCreation = false)
	{
		// Obtener el perfil del desarrollador
		$developerProfiles = $this->getDeveloperProfiles();
		$developerProfile =  $developerProfiles ? $developerProfiles[0] : null;
		
		if($developerProfile || !$forceCreation)
		{
			return $developerProfile;						
		}
		else // No existe y se ha pedido que sea creado en ese caso
		{
			// Crear el nuevo perfil de desarrollador
			$developerProfile = new DeveloperProfile();
			$developerProfile->setsfGuardUserProfile($this);
			$developerProfile->save();
			
			// Retornar el nuevo perfil de desarrollador
			return $developerProfile;
		}
	}
	
     /* Retorna el perfil de jugador asociado al perfil de usuario o null si no existe.
	 *
	 * @param boolean $forceCreation Si vale true, crea un perfil de jugador en caso de no existir.
	 * @return El perfil de jugador asociado al perfil de usuario o null si no existe.
	 */
	public function getPlayerProfile($forceCreation = false)
	{
		// Obtener el perfil del desarrollador
		$playerProfiles = $this->getPlayerProfiles();
		$playerProfile =  $playerProfiles ? $playerProfiles[0] : null;
		
		if($playerProfile || !$forceCreation)
		{
			return $playerProfile;						
		}
		else // No existe y se ha pedido que sea creado en ese caso
		{
			// Crear el nuevo perfil de jugador
			$playerProfile = new PlayerProfile();
			$playerProfile->setsfGuardUserProfile($this);
			$playerProfile->save();
			
			// Retornar el nuevo perfil de jugador
			return $playerProfile;
		}
	}

	public function setGender($value)
	{
		parent::setGender(sfGuardUserProfilePeer::getGenderFromValue($value));
	}
	public function getGender()
	{
		return sfGuardUserProfilePeer::getGenderFromIndex(parent::getGender());
	}
}

sfPropelBehavior::add('sfGuardUserProfile', array('sfPropelUuidBehavior'));