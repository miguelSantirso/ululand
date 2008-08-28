<?php

/**
 * Subclass for representing a row from the 'code_piece_language' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CodePieceLanguage extends BaseCodePieceLanguage
{
	public function __toString()
	{
		return $this->getName();
	}
}
