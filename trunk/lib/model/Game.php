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
	
	public function getNbRatings()
	{
		$ratingDetails = $this->getRatingDetails();
		$ratingsCount = 0;
		foreach($ratingDetails as $ratingDetail)
		{
			$ratingsCount += $ratingDetail;
		}
		return $ratingsCount;
	}
	
	public function setThumbnailPath($v)
	{
		parent::setThumbnailPath($v); 
 		$this->generateThumbnail($v);
	}
	
	public function generateThumbnail($value)
	{
		$uploadDir = $this->getUploadDir();
		$thumbnail = new sfThumbnail(150, 150, true, false);
		$thumbnail->loadFile($uploadDir.'/'.$this->getThumbnailPath());
		$thumbnail->save($uploadDir.'/'.'thumb_'.$this->getThumbnailPath(), 'image/png');
	}
	
	public function getActiveRelease()
	{
		return GameReleasePeer::retrieveByPK( $this->getActiveReleaseId() );		
	}
	
	public function isPublished()
	{
		return !is_null($this->getActiveRelease());
	}
	
	public function hasDeveloper()
	{
		return !is_null($this->getsfGuardUser()->getProfile()->getDeveloperProfile(false));
	}
	
	/**
	 * Retorna la anchura en píxeles de la versión activa del juego
	 *
	 * @return Anchura en píxeles de la versión activa del juego o null si el juego no tiene versión activa asociada
	 */
	public function getWidth()
	{
		if(is_null($this->getActiveRelease())) return null;
		
		return $this->getActiveRelease()->getWidth();
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

	public function getUploadDir()
	{
		return sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_game')."/".$this->getStrippedName();
	}
	public function getUploadDirName()
	{
		return sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_game')."/".$this->getStrippedName();
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
	
}

sfPropelBehavior::add('Game', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('Game', array('sfPropelActAsCountableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsTaggableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsRatableBehavior' => array('max_rating' => 5)));
sfPropelBehavior::add('Game', array('sfPropelUuidBehavior'));