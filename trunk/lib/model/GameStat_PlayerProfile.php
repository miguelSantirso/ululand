<?php

/**
 * Subclass for representing a row from the 'gamestat_player_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GameStat_PlayerProfile extends BaseGameStat_PlayerProfile
{
	/**
	 * Modifica el valor del gamestat si es mejor, de acuerdo con el tipo
	 *
	 * @param integer $value
	 * @param string $type tipo de gamestat
	 * @return integer nuevo valor de la estadística
	 */
	public function setValueIfBetter($value, $type)
	{
		// Guardar el valor actual de la estadística
		$oldValue = $this->getValue();
		
		// Actuar en función del tipo de gamestat
		switch($type)
		{
			case 'max': // cuanto mayor, mejor 
				if($value > $oldValue)
				{
					$this->setValue($value);
				}
				break;

			case 'min': // cuanto menor, mejor
				if($value < $oldValue)
				{
					$this->setValue($value);
				}
				break;
			case 'add': // sumar al valor anterior
				$this->setValue($oldValue + $value);
				break;
			default: // sustituir
				$this->setValue($value);
				break;
		}
		$this->save();
		return $this->getValue();
	}
}
