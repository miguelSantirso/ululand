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
	 * Añade o modifica un valor de un gamestat para cierto avatar.
	 *
	 * @param integer $avatarId Id del avatar al que pertenece el nuevo valor del gamestat
	 * @param integer $value Nuevo valor del gamestat
	 */
	public function setValueForAvatar($avatarId, $value)
	{
		// Obtener el valor del gamestat para el avatar indicado
		$c = new Criteria();
		$c->add(GameStat_AvatarPeer::AVATAR_ID, $avatarId);
		$c->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());
		$gameStatValue = GameStat_AvatarPeer::doSelectOne($c);
		
		// Comprobamos si el avatar ya tiene un valor para este gamestat 
		if(!$gameStatValue)
		{
			// El avatar no tenía ningún valor, así que creamos uno nuevo
			$newValue = new GameStat_Avatar();
			$newValue->setAvatarId($avatarId);
			$newValue->setGamestat($this);
			$newValue->setValue($value);
			
			$newValue->save();
		}
		else
		{
			// El avatar ya tenía uno, así que lo modificamos solo si procede según el tipo de gamestat
			$gameStatValue->setValueIfBetter($value, $this->getGameStatType());
		}
	}
	
	public function getOrderedValues($limit = 0)
	{
		$c = new Criteria();
		$c->add(GameStat_AvatarPeer::GAMESTAT_ID, $this->getId());
		if($limit > 0)
			$c->setLimit($limit);
		switch ($this->getGameStatType())
		{
			case 'max':
				$c->addDescendingOrderByColumn(GameStat_AvatarPeer::VALUE);
				break;
			case 'min':
				$c->addAscendingOrderByColumn(GameStat_AvatarPeer::VALUE);
				break;
			case 'add':
				$c->addDescendingOrderByColumn(GameStat_AvatarPeer::VALUE);
				break;
			default:
				$c->addDescendingOrderByColumn(GameStat_AvatarPeer::VALUE);
				break;
		}
		return GameStat_AvatarPeer::doSelect($c);
	}
	
	/**
	 * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->name." (".$this->getGame().")";
	}
}
