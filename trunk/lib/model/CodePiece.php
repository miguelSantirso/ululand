<?php

/**
 * Subclass for representing a row from the 'code_piece' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CodePiece extends BaseCodePiece
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
			$tagsString .= link_to($tag, 'recipe/list?tag='.$tag);
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
	
	/**
	 * Modificación de la función automática setSource para que se guarde siempre el html_source siempre al mismo tiempo
	 *
	 * @param unknown_type $v
	 */
	public function setSource($v)
	{
		parent::setSource($v);
		
		$this->setHtmlSource(ulGeshiToolkit::transformToHtml($v));
	}
}

sfPropelBehavior::add('CodePiece', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('CodePiece', array('sfPropelActAsCountableBehavior'));
sfPropelBehavior::add('CodePiece', array('sfPropelActAsCommentableBehavior') );
sfPropelBehavior::add('CodePiece', array('sfPropelActAsTaggableBehavior'));
sfPropelBehavior::add('CodePiece', array('sfPropelActAsRatableBehavior' => array('max_rating' => 5))); // Max rating value for a recipe
sfPropelBehavior::add('CodePiece', array('sfPropelUuidBehavior'));
