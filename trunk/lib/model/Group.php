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
	
	public function setThumbnailPath($v)
	{
		parent::setThumbnailPath($v); 
 		$this->generateThumbnail($v);
	}
	
	protected function generateThumbnail($value)
	{
		$uploadDir = $this->getUploadDir();
		$thumbnail = new sfThumbnail(150, 150, true, false);
		$thumbnail->loadFile($uploadDir.'/'.$this->getThumbnailPath());
		$thumbnail->save($uploadDir.'/'.'thumb_'.$this->getThumbnailPath(), 'image/png');
	}
	
	public function getUploadDir()
	{
		return sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_groupIcons');
	}
	public function getUploadDirName()
	{
		return sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_groupIcons');
	}
	
	/**
	 * ModificaciÃ³n de la funciÃ³n automÃ¡tica setName para que se establezca el campo stripped_name cuando corresponda.
	 * Esto es necesario para el funcionamiento de los permalinks
	 *
	 * @param unknown_type $v
	 */
	public function setName($v)
	{
		parent::setName($v);
		
		//if(!$this->getStrippedTitle())
		// @todo habrÃ­a que hacer que el tÃ­tulo no se modifique cuando el juego estÃ© ya publicado
		$this->setStrippedName(ulToolkit::stripText($v));
	}
}

sfPropelBehavior::add('Group', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Group', array('sfPropelActAsCountableBehavior'));