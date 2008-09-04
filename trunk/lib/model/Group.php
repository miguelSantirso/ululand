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
	
	public function getPlayerProfiles()
	{
		// Obtener todas las relaciones de jugador con este grupo
		$playerships = Group::getPlayerProfile_Groups();

		$players = Array();
		$owner = Array();
		foreach($playerships as $playership) // Para cada relaci�n
		{
					if(!$playership->getIsOwner() && $playership->getIsApproved()) $players[] = $playership->getPlayerProfile();
		}
		return $players;
	}
	
	public function getOwners()
	{
		// Obtener todas las relaciones de jugador con este grupo
		$ownerships = Group::getPlayerProfile_Groups();

		$owners = Array();
		foreach($ownerships as $ownership) // Para cada relaci�n
		{
					if($ownership->getIsOwner() && $ownership->getIsApproved()) $owners[] = $ownership->getPlayerProfile();
		}
		return $owners;
	}
	
    public function getRequests()
	{
		// Obtener todas las peticiones a este grupo
		$playerships = Group::getPlayerProfile_Groups();

		$players = Array();
		$owner = Array();
		foreach($playerships as $playership) // Para cada relaci�n
		{
					if(!$playership->getIsApproved()) $players[] = $playership->getPlayerProfile();
		}
		return $players;
	}
	
	public function getMembers()
	{	
		// Obtener todas las relaciones de jugador con este grupo
		$c = new Criteria();
		$c->addDescendingOrderByColumn(PlayerProfilePeer::TOTAL_CREDITS);
		$playerships = Group::getPlayerProfile_GroupsJoinPlayerProfile($c);

		$players = Array();
		foreach($playerships as $playership) // Para cada relación
		{
					if($playership->getIsApproved()) $players[] = $playership->getPlayerProfile();
		}
		return $players;
	}
}

sfPropelBehavior::add('Group', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Group', array('sfPropelActAsCountableBehavior'));