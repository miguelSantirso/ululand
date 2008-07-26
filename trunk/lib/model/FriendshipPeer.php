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
	public static function areFriends($idAvatarA, $idAvatarB)
	{
		$friendship = FriendshipPeer::getFriendshipBetween($idAvatarA, $idAvatarB);
		
		if($friendship && $friendship->getStatus() == Friendship::STATUS_CONFIRMED)
			return true;
		else
			return false;
	}
	
	public static function getFriendshipBetween($idAvatarA, $idAvatarB)
	{
		$c = new Criteria();
		
		$criterionA = $c->getNewCriterion(FriendshipPeer::ID_AVATAR_A, $idAvatarA);
		$criterionA->addAnd($c->getNewCriterion(FriendshipPeer::ID_AVATAR_B, $idAvatarB));
		
		$criterionB = $c->getNewCriterion(FriendshipPeer::ID_AVATAR_B, $idAvatarA);
		$criterionB->addAnd($c->getNewCriterion(FriendshipPeer::ID_AVATAR_A, $idAvatarB));
		
		$criterionA->addOr($criterionB);
		$c->add($criterionA);
		
		$friendship = FriendshipPeer::doSelectOne($c);

		return $friendship;
	}
	
	/**
	 * Realiza las operaciones necesarias para indicar que el avatar cuyo id es $idAvatarA, ha agregado
	 * como amigo al avatar de id $idAvatarB
	 * 
	 * @param integer $idAvatarA Id del avatar que realiza la petición de amigo
	 * @param integer $idAvatarB Id del avatar objetivo de la petición de amigo
	 */
	public static function addFriendship($idAvatarA, $idAvatarB)
	{
		if($idAvatarA == $idAvatarB)
		{
			throw new PropelException(sprintf('You cannot add yourself as a friend'));
			return;			
		}
		
		// Realizamos una búsqueda de todas las amistades del avatar A
		$c = new Criteria();
		$criterion = $c->getNewCriterion( FriendshipPeer::ID_AVATAR_A, $idAvatarA );
		$criterion->addOr($c->getNewCriterion( FriendshipPeer::ID_AVATAR_B, $idAvatarA ));
		$c->add($criterion);
		$friendships = FriendshipPeer::doSelect($c);
		
		// Variable auxiliar que indica si la relación entre los dos avatares ya existe
		$frienshipFound = false;

		// Recoremos los resultados de la búsqueda
		foreach($friendships as $friendship )
		{
			if($friendship->getIdAvatarA() == $idAvatarA)
			{
				// La relación existe, confirmamos la amistad por parte del avatar A
				if($friendship->getIdAvatarB() == $idAvatarB)
				{
					$frienshipFound = true;
					$friendship->setAConfirmed(true);
					$friendship->save();
				}
			}
			else if($friendship->getIdAvatarB() == $idAvatarA)
			{
				// La relación existe, confirmamos la amistad por parte del avatar B
				if($friendship->getIdAvatarA() == $idAvatarB)
				{
					$frienshipFound = true;
					$friendship->setBConfirmed(true);
					$friendship->save();
				}
			}
		}
		
		// La relación no existe. Creamos la nueva relación de amistad y confirmamos por parte del avatar A
		if(!$frienshipFound)
		{
			$friendship = new Friendship();
			$friendship->setIdAvatarA( $idAvatarA );
			$friendship->setAConfirmed(true);
			$friendship->setIdAvatarB( $idAvatarB );
			$friendship->save();
		}
	}
}
