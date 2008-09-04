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
	protected $upload;
	protected $uploadThumbnail;

	/**
	 * getUpload: Función necesaria para subir juegos flash
	 *
	 * @return string $this->upload Cadena
	 **/
	public function getUpload()
	{
		return $this->upload;
	}

	/**
	 * setUpload: Función necesaria para subir juegos flash
	 * Se recibe la dirección del juego
	 * Se comprueba que cumple los requísitos y se guarda
	 *
	 * @param string $v Cadena dirección del juego
	 * @return void
	 **/
	public function setUpload($v)
	{
		if ($v !== null && !is_string($v))
		{
			$v = (string) $v;
		}
		if ($this->upload !== $v)
		{
			$this->upload = $v;
			$this->setUrl($v);
			$this->save();

		}
	}
	
	/**
	 * getUploadThumbnail: Funci�n necesaria para subir los iconos de los juegos
	 *
	 * @return string $this->uploadThumbnail Cadena
	 **/
	public function getUploadThumbnail()
	{
		return $this->uploadThumbnail;
	}

	/**
	 * setUploadThumbnail: Funci�n necesaria para subir los iconos de los juegos
	 * Se recibe la direcci�n del icono
	 * Se comprueba que cumple los requisitos y se guarda
	 *
	 * @param string $v Cadena direcci�n del icono
	 * @return void
	 **/
	public function setUploadThumbnail($v)
	{
		if ($v !== null && !is_string($v))
		{
			$v = (string) $v;
		}
		if ($this->upload !== $v)
		{
			$this->uploadThumbnail = $v;
			$this->setThumbnailPath($v);
			$this->save();
		}
	}
	
	public function getNbComments()
	{
		return count($this->getComments());
	}
	
	public function getGameUrl()
	{
		return "/".sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_game')."/".$this->getName()."/".$this->getUrl();
	}
	
	public function getThumbnailUrl()
	{
		return "/".sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_game')."/".$this->getName()."/".$this->getThumbnailPath();
	}
	
	/**
	 * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->name;
	}

	/**
	 * Sobreescribe la función save de la clase padre.
	 * Simplemente añade un api_key en caso de que no exista y llama a la función de la clase padre
	 *
	 * @param unknown_type $con
	 */
	public function save($con = null)
	{	
		if(!$this->getApiKey())
		{
			$this->setApiKey(GamePeer::generateApiKey());
		}
		parent::save($con);
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

}

sfPropelBehavior::add('Game', array('sfPropelActAsSignableBehavior' => array()));
sfPropelBehavior::add('Game', array('sfPropelActAsCountableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('Game', array('sfPropelActAsTaggableBehavior'));
sfPropelBehavior::add(
  'Game', 
  array('sfPropelActAsRatableBehavior' =>
        array('max_rating'      => 5              // Max rating value for an Article
              )));