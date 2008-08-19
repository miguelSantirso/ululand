<?php

/**
 * Subclass for representing a row from the 'friendship' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Friendship extends BaseFriendship
{
	const STATUS_REJECTED = 'friendship.status.rejected';
	const STATUS_A_CONFIRMED = 'friendship.status.aConfirmed';
	const STATUS_B_CONFIRMED = 'friendship.status.bConfirmed';
	const STATUS_CONFIRMED = 'friendship.status.confirmed';
	
	public function getAvatarA()
	{
		$c = new Criteria();
		$c->add( AvatarPeer::ID, $this->getIdAvatarA() );
		return AvatarPeer::doSelectOne( $c );
	}
	
	public function getAvatarB()
	{
		$c = new Criteria();
		$c->add( AvatarPeer::ID, $this->getIdAvatarB() );
		return AvatarPeer::doSelectOne( $c );
	}
	
	
	/**
	 * Retorna el estado de una amistad
	 *
	 * @return string Estado de una amistad: STATUS_REJECTED | STATUS_A_CONFIRMED | STATUS_B_CONFIRMED | STATUS_CONFIRMED
	 */
	public function getStatus()
	{
		switch ($this->getAConfirmed() + $this->getBConfirmed())
		{
			case 0:
				return Friendship::STATUS_REJECTED;
				break;
			case 1:
				if($this->getAConfirmed())
				{
					return Friendship::STATUS_A_CONFIRMED;
				}
				else
				{
					return Friendship::STATUS_B_CONFIRMED;
				}
				break;
			case 2:
				return Friendship::STATUS_CONFIRMED;
				break;
		}
	}
}
