<?php

/**
 * Subclass for performing query and update operations on the 'friendship' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FriendshipPeer extends BaseFriendshipPeer
{
	public static function getFriendshipBetween($idPlayerA, $idPlayerB)
	{
		$c = new Criteria();
		
		$criterionA = $c->getNewCriterion(FriendshipPeer::PLAYER_PROFILE_ID_A, $idPlayerA);
		$criterionA->addAnd($c->getNewCriterion(FriendshipPeer::PLAYER_PROFILE_ID_B, $idPlayerB));
		
		$criterionB = $c->getNewCriterion(FriendshipPeer::PLAYER_PROFILE_ID_B, $idPlayerA);
		$criterionB->addAnd($c->getNewCriterion(FriendshipPeer::PLAYER_PROFILE_ID_A, $idPlayerB));
		
		$criterionA->addOr($criterionB);
		$c->add($criterionA);
		
		$friendship = FriendshipPeer::doSelectOne($c);
		if (!$friendship) return "NO_FRIENDS";
		if ($friendship->getIsConfirmed()) return "FRIENDS";
		if (!$friendship->getIsConfirmed() && $friendship->getPlayerProfileIdB() == $idPlayerB) return "PENDINGA";
		else return "PENDINGB";
	}
}
