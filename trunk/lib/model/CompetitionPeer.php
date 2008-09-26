<?php

/**
 * Subclass for performing query and update operations on the 'competition' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CompetitionPeer extends BaseCompetitionPeer
{
	const PENDING = 'pending';
	const OWNER = 'owner';
	const MEMBER = 'member';
	const NOT_MEMBER = 'notMember';
}
