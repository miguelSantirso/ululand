<?php

class myUser extends ulUser
{
	public function __toString()
	{
		return $this->getGuardUser()->getProfile()->__toString();
	}
	
	public function getId() 
	{
		return $this->getGuardUser()->getId();
	}
}
