<?php

/**
 * Subclass for representing a row from the 'gamerelease' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GameRelease extends BaseGameRelease
{
}
sfPropelBehavior::add('Game', array('sfPropelActAsSignableBehavior' => array()));