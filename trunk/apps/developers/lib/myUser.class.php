<?php

class myUser extends sfGuardSecurityUser
{
	public function __toString()
	{
		return $this->getGuardUser()->getUsername();
	}
	
	public function getId() 
	{
		return $this->getGuardUser()->getId();
	}
}
