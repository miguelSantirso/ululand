<?php

/**
 * Subclass for representing a row from the 'avatarpiece' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AvatarPiece extends BaseAvatarPiece
{
	/**
	 * getUpload: Función necesaria para realizar las operaciones de subida de los gráficos de las piezas de avatar
	 *
	 * @return
	 **/
	public function getUpload()
	{
		return $this->upload;
	}

	/**
	 * setUpload: Función necesaria para realizar las operaciones de subida de los gráficos de las piezas de avatar
	 *
	 **/
	public function setUpload($v)
	{
		if ($v !== null && !is_string($v))
		{
			$v = (string) $v;
		}
		if ($this->upload != $v)
		{
			$this->upload = $v;
			$this->setUrl($v);
			$this->save();
		}
	}

	 
	public function __toString()
	{
		return $this->name;
	}
}
