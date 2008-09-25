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
/**
	 * Modificación de la función automática setName para que se establezca el campo stripped_name cuando corresponda.
	 * Esto es necesario para el funcionamiento de los permalinks
	 *
	 * @param unknown_type $v
	 */
	public function setName($v)
	{
		parent::setName($v);
		
		//if(!$this->getStrippedTitle())
		// @todo habría que hacer que el título no se modifique cuando el juego esté ya publicado
		$this->setStrippedName(ulToolkit::stripText($v));
	}
}
sfPropelBehavior::add('Competition', array('sfPropelActAsSignableBehavior' => array()));