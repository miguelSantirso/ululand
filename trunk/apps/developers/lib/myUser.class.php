<?php

class myUser extends sfGuardSecurityUser
{
	public function __toString()
	{
		return $this->getProfile();
	}
	
	public function getId() 
	{
		return $this->getGuardUser()->getId();
	}
}
