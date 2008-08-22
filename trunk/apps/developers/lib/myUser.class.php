<?php

class myUser extends sfGuardSecurityUser
{
	public function __toString()
	{
		return $this->getGuardUser()->getProfile();
	}
	
	public function getId() 
	{
		return $this->getGuardUser()->getId();
	}
}
