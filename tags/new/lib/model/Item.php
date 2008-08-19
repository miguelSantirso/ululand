<?php

/**
 * Subclass for representing a row from the 'item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Item extends BaseItem
{
	protected $upload; 
    protected $open;
    protected $itype;
      
    /**
     * getUpload: Función necesaria para la realización del cambio de contraseña de un usuario por parte del administrador. 
     *
     * @return string $this->password Cadena
     **/
    public function getUpload()
    {
    	return $this->upload;
    }

    /**
     * setPassword: Función necesaria para la realización del cambio de contraseña de un usuario por parte del administrador. 
     * Se recibe la nueva contraseña introducida por el administrador. 
     * Se comprueba que cumple los requísitos, se encripta y se guarda en la base de datos. 
     *
     * @param string $v Cadena nueva contraseña introducida por el administrador 
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
      * getUpload: Función necesaria para la realización del cambio de contraseña de un usuario por parte del administrador. 
      *
      * @return string $this->password Cadena
      **/
     public function getOpen()
     {
     	return $this->open;
     }

     /**
      * setPassword: Función necesaria para la realización del cambio de contraseña de un usuario por parte del administrador. 
      * Se recibe la nueva contraseña introducida por el administrador. 
      * Se comprueba que cumple los requísitos, se encripta y se guarda en la base de datos. 
      *
      * @param string $v Cadena nueva contraseña introducida por el administrador 
      * @return void
      **/
     public function setOpen($v)
     {
     	if ($v !== null && !is_string($v))
     	{
     		$v = (string) $v;
     	}
     	if ($this->open !== $v)
     	{
     		$this->open = $v;
     	}
     }
      
     /**
      * getType: Función necesaria para la realización del cambio de contraseña de un usuario por parte del administrador. 
      *
      * @return string $this->password Cadena
      **/
     public function getItype()
     {
     	$c = new Criteria();
     	$c->add( ItemTypePeer::ID, $this->id_itemtype );
     	$type = ItemTypePeer::doSelect( $c );
     	if(count($type) != 0)
     	{
     		$this->itype = $type[0]->getName();
     	}
     	return $this->itype;
     }

     /**
      * setPassword: Función necesaria para la realización del cambio de contraseña de un usuario por parte del administrador. 
      * Se recibe la nueva contraseña introducida por el administrador. 
      * Se comprueba que cumple los requísitos, se encripta y se guarda en la base de datos. 
      *
      * @param string $v Cadena nueva contraseña introducida por el administrador 
      * @return void
      **/
     public function setItype($v)
     {
     	if ($v !== null && !is_string($v))
     	{
     		$v = (string) $v;
     	}
     	if ($this->itype !== $v)
     	{
     		$this->itype = $v;
     	}
     }

     /**
      * getImageHref: Retorna el enlace completo a la imagen asociada al ítem.
      *
      * @return string Cadena que contiene un enlace absoluto a la imagen asociada al ítem.
      */
     public function getImageHref()
     {
     	$imageHref = "null";
     	if ($this->url != "")
     	{
     		$imageHref = "http://".$_SERVER["SERVER_NAME"]."/".sfConfig::get('sf_upload_dir_name')."/".sfConfig::get('app_dir_asset')."/".$this->url;
     	}
     		
     	return $imageHref;
     }
	
	public function setGender($value)
	{
		parent::setGender(ItemPeer::getGenderFromValue($value));
	}

	public function getGender()
	{
		return ItemPeer::getGenderFromIndex(parent::getGender());
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
}
