<?php

/**
 * Subclass for representing a row from the 'gamestat' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GameStat extends BaseGameStat
{
	/**
	 * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->name." (".$this->getGame().")";
	}
	
	/**
	 * A�ade un valor de una estad�stica de partida para un jugador
	 *
	 * @param integer $value Valor de la estad�stica de partida
	 * @param integer $playerId Identificador del jugador
	 */
	public function addGameStatValueForPlayer($value, $playerId)
	{
		$newValue = new GameStat_PlayerProfile();
		$newValue->setPlayerProfileId($playerId);
		$newValue->setGamestat($this);
		$newValue->setValue($value);
			
		$newValue->save();
	}
	
	public function getOrderedValues($limit = 0, $startDate = null, $endDate = null)
	{
		$c = new Criteria();
		$c->add(GameStat_PlayerProfilePeer::GAMESTAT_ID, $this->getId());
		if($limit > 0)
			$c->setLimit($limit);
		$c = GameStat::addOrderToCriteria($c, $this->getGameStatType());
		if (!is_null($startDate)) 
			$c->add(Gamestat_PlayerProfilePeer::CREATED_AT, $startDate, Criteria::GREATER_EQUAL);
		if (!is_null($endDate)) 
			$c->add(Gamestat_PlayerProfilePeer::CREATED_AT, $endDate, Criteria::LESS_EQUAL);
		return Gamestat_PlayerProfilePeer::doSelect($c);
	}
	
	/**
	 * Retorna la mejor estad�stica de un jugador
	 *
	 * @param PlayerProfile $playerProfile
	 * @param String $startDate
	 * @param String $endDate
	 * @return GameStat_PlayerProfile
	 */
	public function getBestValueForPlayer($playerProfile, $startDate = null, $endDate = null)
	{
		$c = new Criteria();
		$c->add(PlayerProfilePeer::ID, $playerProfile->getId());
		if (!is_null($startDate)) 
			$c->add(Gamestat_PlayerProfilePeer::CREATED_AT, $startDate, Criteria::GREATER_EQUAL);
		if (!is_null($endDate)) 
			$c->add(Gamestat_PlayerProfilePeer::CREATED_AT, $endDate, Criteria::LESS_EQUAL);
		$c = GameStat::addOrderToCriteria($c, $this->getGameStatType());
		
		return GameStat_PlayerProfilePeer::doSelectOne($c);
	}

	/**
	 * Retorna el criteria modificado para que ordene los valores adecuadamente
	 *
	 * @param Criteria $c criteria a modificar
	 * @param GameStatType $gamestatType
	 * @return Criteria
	 */
	public static function addOrderToCriteria($c = null, $gamestatType)
	{
		switch ($gamestatType)
		{
			case 'max':
				$c->addDescendingOrderByColumn(GameStat_PlayerProfilePeer::VALUE);
				break;
			case 'min':
				$c->addAscendingOrderByColumn(GameStat_PlayerProfilePeer::VALUE);
				break;
			case 'add':
				$c->addDescendingOrderByColumn(GameStat_PlayerProfilePeer::VALUE);
				break;
			default:
				$c->addDescendingOrderByColumn(GameStat_PlayerProfilePeer::VALUE);
				break;
		}
		return $c;
	}
}
