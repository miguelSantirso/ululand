<?php

/**
 * Subclass for representing a row from the 'developer_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DeveloperProfile extends BaseDeveloperProfile
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
		
		return $tagsString;
	}
	
	public function getLinkedTagsString()
	{
		$tags = $this->getTags();
		$tagsString = "";
		foreach($tags as $tag)
		{
			$tagsString .= link_to($tag, 'profile/list?tag='.$tag);
			$tagsString .= ' ';
		}
		
		return $tagsString;
	}
}

sfPropelBehavior::add('DeveloperProfile', array('sfPropelActAsTaggableBehavior'));