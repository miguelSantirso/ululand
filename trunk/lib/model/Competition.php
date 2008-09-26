<?php

/**
 * Subclass for representing a row from the 'competition' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Competition extends BaseCompetition
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
	
	/**
	 * Devuelve los miembros de un competición
	 *
	 * @param Criteria $c criteria que se añadirá al select
	 * @return Array array de jugadores de acuerdo al criteria pasado como parámetro
	 */
	public function getMembers($c = null)
	{	
		if (!$c) $c = new Criteria();
		$c->add(Competition_PlayerProfilePeer::COMPETITION_ID, $this->getId());
		$c->addJoin(PlayerProfilePeer::ID, Competition_PlayerProfilePeer::PLAYER_PROFILE_ID);
		$c->addJoin(PlayerProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
		
		return PlayerProfilePeer::doSelect($c);
	}
	
	public function getStatus($player)
	{
		$c = new Criteria();
		$c->add(Competition_PlayerProfilePeer::PLAYER_PROFILE_ID, $player->getId());
		$c->add(Competition_PlayerProfilePeer::COMPETITION_ID, $this->getId());
		$relationship = Competition_PlayerProfilePeer::doSelectOne($c);
		$status = CompetitionPeer::NOT_MEMBER;
		if ($relationship)
		{
			if ($relationship->getIsConfirmed())
			{
				if ($relationship->getIsOwner()) $status = CompetitionPeer::OWNER;
				else $status = CompetitionPeer::MEMBER;
			}
			else $status = CompetitionPeer::PENDING;
		}
		return $status;
	}
	
/**
	 * Devuelve los miembros de un competición ordenados según su puntuación
	 *
	 * @param Criteria $c criteria que se añadirá al select
	 * @return Array array de jugadores de acuerdo al criteria pasado como parámetro
	 */
	public function getOrderedValues($c = null)
	{	
		if (!$c) $c = new Criteria();
		$c->add(Competition_PlayerProfilePeer::COMPETITION_ID, $this->getId());
		$c->addJoin(PlayerProfilePeer::ID, Competition_PlayerProfilePeer::PLAYER_PROFILE_ID);
		$c->addJoin(PlayerProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
		$c->addJoin(PlayerProfilePeer::ID, GameStat_PlayerProfilePeer::PLAYER_PROFILE_ID);
		$c->add(GameStatPeer::ID, $this->getGamestatId());
		
		$c->add(GameStat_PlayerProfilePeer::GAMESTAT_ID, $this->getGamestatId());
		$c = GameStat::addOrderToCriteria($c, $this->getGameStat()->getGameStatType());
		
		$c->addAnd($c->getNewCriterion(Gamestat_PlayerProfilePeer::CREATED_AT, $this->getStartsAt(), Criteria::GREATER_THAN)); 
		$c->addAnd($c->getNewCriterion(Gamestat_PlayerProfilePeer::CREATED_AT, $this->getFinishesAt(), Criteria::LESS_THAN));
		$gamestat_players = Gamestat_PlayerProfilePeer::doSelect($c);
		$array = array();
		for( $i=0; $i<count($gamestat_players); $i++)
		{
			$var = true;
			for( $j=$i-1; $j>=0; $j--)
			{
				if ($gamestat_players[$i]->getPlayerProfileId() == $gamestat_players[$j]->getPlayerProfileId())
					$var = false;
			}
			if ($var) $array[] = $gamestat_players[$i];
		}
		return $array;
		
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
		return sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_competitionIcons');
	}
	public function getUploadDirName()
	{
		return sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_competitionIcons');
	}
}
sfPropelBehavior::add('Competition', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('Competition', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Competition', array('sfPropelActAsCountableBehavior'));