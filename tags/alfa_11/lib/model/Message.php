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
	 * Procesa el texto del comentario y lo retorna con formato, según las reglas de Textile
	 *
	 * @return Comentario formateado según Textile
	 */
	public function getFormattedText()
	{
		return sfTextile::doConvert($this->getText());
	}
}
