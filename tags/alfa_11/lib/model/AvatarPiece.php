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
	 * getUpload: Funci�n necesaria para realizar las operaciones de subida de los gr�ficos de las piezas de avatar
	 *
	 * @return
	 **/
	public function getUpload()
	{
		return $this->upload;
	}

	/**
	 * setUpload: Funci�n necesaria para realizar las operaciones de subida de los gr�ficos de las piezas de avatar
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
