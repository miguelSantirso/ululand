<?php

/**
 * Subclass for representing a row from the 'gamereleasestatus' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GameReleaseStatus extends BaseGameReleaseStatus
{
	public function __toString()
	{
		return $this->name;
	}
}
