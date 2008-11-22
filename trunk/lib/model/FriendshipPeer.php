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
	const NO_FRIENDS  = 'noFriends';
	const FRIENDS     = 'friends';
	const PENDING_A   = 'pendingA';
	const PENDING_B   = 'pendingB';
	
	/**
	 * Retorna el estado de la amistad entre dos jugadores
	 *
	 * @param int $idPlayerA identificador del jugador A
	 * @param int $idPlayerB identificador del jugador B
	 * @return unknown
	 */
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
		if (!$friendship) return FriendshipPeer::NO_FRIENDS;
		if ($friendship->getIsConfirmed()) return FriendshipPeer::FRIENDS;
		if (!$friendship->getIsConfirmed() && $friendship->getPlayerProfileIdB() == $idPlayerB) return FriendshipPeer::PENDING_A;
		else return FriendshipPeer::PENDING_B;
	}
}
