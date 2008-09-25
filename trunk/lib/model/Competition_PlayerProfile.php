<?php

/**
 * Subclass for representing a row from the 'competition_player_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Competition_PlayerProfile extends BaseCompetition_PlayerProfile
{
}
sfPropelBehavior::add('Competition_PlayerProfile', array('sfPropelActAsSignableBehavior' => array()));