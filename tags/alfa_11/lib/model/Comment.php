<?php

require_once dirname(__FILE__).'/../../plugins/sfTextilePlugin/lib/sfTextile.class.php';

/**
 * Subclass for representing a row from the 'comment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Comment extends BaseComment
{
	public function getAuthor()
	{
		return $this->getAvatar();
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
