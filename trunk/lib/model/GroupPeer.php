<?php

/**
 * Subclass for performing query and update operations on the 'grupo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GroupPeer extends BaseGroupPeer
{
	const PENDING = 'pending';
	const OWNER = 'owner';
	const MEMBER = 'member';
	const NOT_MEMBER = 'notMember';
}
