<?php

/**
 * Subclass for representing a row from the 'widget' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Widget extends BaseWidget
{
	protected $upload;
	
	/**
	 * getUpload: Función necesaria para subir widgets
	 *
	 * @return string $this->upload Cadena
	 **/
	public function getUpload()
	{
		return $this->upload;
	}

	/**
	 * setUpload: Función necesaria para subir widgets
	 * Se recibe la dirección del widget
	 * Se comprueba que cumple los requísitos y se guarda
	 *
	 * @param string $v Cadena dirección del widget
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

	public function getWidgetUrl()
	{
		return "/".sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_widget')."/".$this->getName()."/".$this->getUrl();
	}

	/**
	 * Sobreescribe la función save de la clase padre.
	 * Simplemente añade un api_key en caso de que no exista y llama a la función de la clase padre
	 *
	 * @param unknown_type $con
	 */
	public function save(PropelPDO $con = null)
	{	
		if(!$this->getApiKey())
		{
			$this->setApiKey(WidgetPeer::generateApiKey());
		}
		
		parent::save($con);
	}
}
