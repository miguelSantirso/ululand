<?php

class myUser extends sfGuardSecurityUser
{
	public static function getConnectedAvatarId()
	{
		return sfContext::getInstance()->getUser()->getAttribute('avatarId');
	}

	public function __toString()
	{
		return $this->getGuardUser()->getProfile()->__toString();
	}
	
	public function getId() 
	{
		return $this->getGuardUser()->getId();
	}
	
	public function getPlayerProfile()
	{
		if(!is_null($this->getProfile()))
			return $this->getProfile()->getPlayerProfile();
	}
}
