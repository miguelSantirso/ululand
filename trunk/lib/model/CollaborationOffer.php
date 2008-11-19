<?php

/**
 * Subclass for representing a row from the 'collaboration_offer' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CollaborationOffer extends BaseCollaborationOffer
{
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
			$tagsString .= link_to($tag, 'collaboration/list?tag='.$tag);
			$tagsString .= ', ';
		}
		
		return trim($tagsString, " ,");
	}

	/**
	 * Modificación de la función automática setTitle para que se establezca el campo stripped_title cuando valga null.
	 * Esto es necesario para el funcionamiento de los permalinks
	 *
	 * @param unknown_type $v
	 */
	public function setTitle($v)
	{
		parent::setTitle($v);
		
		if(!$this->getStrippedTitle())
			$this->setStrippedTitle(ulToolkit::stripText($v));
	}
}

sfPropelBehavior::add('CollaborationOffer', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('CollaborationOffer', array('sfPropelActAsCountableBehavior'));
sfPropelBehavior::add('CollaborationOffer', array('sfPropelActAsCommentableBehavior') );
sfPropelBehavior::add('CollaborationOffer', array('sfPropelActAsTaggableBehavior'));