<?php

/**
 * Subclass for representing a row from the 'gamerelease' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GameRelease extends BaseGameRelease
{

	public function __toString()
	{
		return $this->getName();		
	}
	
	/**
	 * Retorna el strippedName del juego asociado. 
	 *
	 * @return string stripped_name del juego asociado a esta release
	 */
	public function getGameStrippedName()
	{
		return $this->getGame()->getStrippedName();		
	}
	
	public function getUploadDir()
	{
		return sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_game')."/".$this->getGameStrippedName();
	}
	public function getUploadDirName()
	{
		return sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_game')."/".$this->getGameStrippedName();
	}
	public function getCompleteUrl()
	{
		return '/' . $this->getUploadDirName() . '/' . $this->getGamePath();
	}
	
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
	
	public function setGamePath($v)
	{
		parent::setGamePath($v);
		
		$this->setSwfDimensions();
	}
	
	public function setSwfDimensions()
	{
		$gamePath = $this->getUploadDir() . '/' . $this->getGamePath();
		$imageSize = getimagesize($gamePath);
		
		if($imageSize)
		{
			$this->setWidth($imageSize[0]);
			$this->setHeight($imageSize[1]);
		}
		else
		{
			throw new sfException("It has been imposible to retrieve the dimensions of the swf file ".$gamePath);
		}
	}
}
sfPropelBehavior::add('GameRelease', array('sfPropelActAsSignableBehavior' => array()));