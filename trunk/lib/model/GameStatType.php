<?php

/**
 * Subclass for representing a row from the 'gamestattype' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GameStatType extends BaseGameStatType
{
	/**
	 * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->getName();
	}
}
