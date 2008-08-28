<?php

/**
 * Subclass for representing a row from the 'message' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Message extends BaseMessage
{
	public function getRecipient()
	{
		return $this->getAvatarRelatedByIdRecipient();
	}
	
	public function getSender()
	{
		return $this->getAvatarRelatedByIdSender();	
	}
	
	/**
	 * Procesa el texto del comentario y lo retorna con formato, seg�n las reglas de Textile
	 *
	 * @return Comentario formateado seg�n Textile
	 */
	public function getFormattedText()
	{
		return sfTextile::doConvert($this->getText());
	}
}
