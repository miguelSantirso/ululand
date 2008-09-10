<?php

/**
 * Subclass for representing a row from the 'game' table.
 *
 *
 *
 * @package lib.model
 */
class Game extends BaseGame
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
	
	public function getNbComments()
	{
		return count($this->getComments());
	}
	
	public function getThumbnailUrl()
	{
		return "/".sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_game')."/".$this->getName()."/".$this->getThumbnailPath();
	}
	
	/**
	 * Retorna una cadena con todos los tags del objeto separados por comas.
	 *
	 * @todo Buscar la forma de que esta función esté en el ámbito del plugin en lugar de en el de cada clase
	 * @return Cadena con todos los tags del objeto separados por comas.
	 */
	public function getTagsString()
	{
		$tags = $this->getTags();
		$tagsString = "";
		foreach($tags as $tag)
		{
			$tagsString .= $tag; 
			$tagsString .= ", ";
		}
		
		return trim($tagsString, " ,");
	}
	
	public function getLinkedTagsString()
	{
		$tags = $this->getTags();
		$tagsString = "";
		foreach($tags as $tag)
		{
			$tagsString .= link_to($tag, 'game/list?tag='.$tag);
			$tagsString .= ', ';
		}
		
		return trim($tagsString, " ,");
	}

	/**
	 * Modificación de la función automática setTitle para que se establezca el campo stripped_title cuando corresponda.
	 * Esto es necesario para el funcionamiento de los permalinks
	 *
	 * @param unknown_type $v
	 */
	public function setTitle($v)
	{
		parent::setTitle($v);
		
		//if(!$this->getStrippedTitle())
		// @todo habría que hacer que el título no se modifique cuando el juego esté ya publicado
		$this->setStrippedTitle(ulToolkit::stripText($v));
	}
}

sfPropelBehavior::add('Game', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('Game', array('sfPropelActAsCountableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsTaggableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsRatableBehavior' => array('max_rating' => 5)));
sfPropelBehavior::add('Game', array('sfPropelUuidBehavior'));