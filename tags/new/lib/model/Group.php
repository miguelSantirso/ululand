<?php

/**
 * Subclass for representing a row from the 'grupo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Group extends BaseGroup
{
	 /** __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->name;
	}
	
	public function getAvatars()
	{
		// Obtener todas las relaciones de avatar con este grupo
		$avatarships = Group::getAvatar_Groups();

		$avatars = Array();
		$owner = Array();
		foreach($avatarships as $avatarship) // Para cada relaci�n
		{
					if(!$avatarship->getIsOwner() && $avatarship->getIsApproved()) $avatars[] = $avatarship->getAvatar();
		}
		return $avatars;
	}
	
	public function getOwners()
	{
		// Obtener todas las relaciones de avatar con este grupo
		$ownerships = Group::getAvatar_Groups();

		$owners = Array();
		foreach($ownerships as $ownership) // Para cada relaci�n
		{
					if($ownership->getIsOwner() && $ownership->getIsApproved()) $owners[] = $ownership->getAvatar();
		}
		return $owners;
	}
	
    public function getPeticiones()
	{
		// Obtener todas las peticiones a este grupo
		$avatarships = Group::getAvatar_Groups();

		$avatars = Array();
		$owner = Array();
		foreach($avatarships as $avatarship) // Para cada relaci�n
		{
					if(!$avatarship->getIsApproved()) $avatars[] = $avatarship->getAvatar();
		}
		return $avatars;
	}
}
