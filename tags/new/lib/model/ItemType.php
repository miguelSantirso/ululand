<?php

/**
 * Subclass for representing a row from the 'itemtype' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ItemType extends BaseItemType
{
    /** 
     * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
     *
     * @return string Cadena representando al objeto
     **/ 
	public function __toString()
	{
        return $this->name; 
	}
}
