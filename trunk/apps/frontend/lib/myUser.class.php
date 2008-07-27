<?php

class myUser extends sfGuardSecurityUser
{
	public static function getConnectedAvatarId()
	{
		return sfContext::getInstance()->getUser()->getAttribute('avatarId');
	}

}
