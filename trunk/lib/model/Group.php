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
	
	/**
	 * Devuelve los miembros de un grupo
	 *
	 * @param Criteria $c criteria que se añadirá al select
	 * @return Array array de jugadores de acuerdo al criteria pasado como parámetro
	 */
	public function getMembers($c = null)
	{	
		if (!$c) $c = new Criteria();
		$c->add(PlayerProfile_GroupPeer::GRUPO_ID, $this->getId());
		$c->addJoin(PlayerProfilePeer::ID, PlayerProfile_GroupPeer::PLAYER_PROFILE_ID);
		$c->addJoin(PlayerProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
		
		return PlayerProfilePeer::doSelect($c);
	}
	
	public function getStatus($player)
	{
		$c = new Criteria();
		$c->add(PlayerProfile_GroupPeer::PLAYER_PROFILE_ID, $player->getId());
		$c->add(PlayerProfile_GroupPeer::GRUPO_ID, $this->getId());
		$relationship = PlayerProfile_GroupPeer::doSelectOne($c);
		$status = GroupPeer::NOT_MEMBER;
		if ($relationship)
		{
			if ($relationship->getIsApproved())
			{
				if ($relationship->getIsOwner()) $status = GroupPeer::OWNER;
				else $status = GroupPeer::MEMBER;
			}
			else $status = GroupPeer::PENDING;
		}
		return $status;
	}
}

sfPropelBehavior::add('Group', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Group', array('sfPropelActAsCountableBehavior'));