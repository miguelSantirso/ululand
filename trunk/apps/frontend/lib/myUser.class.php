<?php

class myUser extends sfBasicSecurityUser
{
	public static function getConnectedAvatarId()
	{
		return sfContext::getInstance()->getUser()->getAttribute('avatarId');
	}
	
	public function signIn($account, $rememberPassword = false)
	{
		$this->getAttributeHolder()->clear();
		
		// Comprobar si el email ha sido aprobado
		if(!$account->getIsApproved())
		{
			// No ha sido aprobado, calcular cuantos días quedan de margen (si es que queda alguno)
			$daysSinceCreation = floor( (strtotime("now") - strtotime($account->getCreatedAt())) / (60*60*24) );
			$remainingDays = sfConfig::get('app_register_daystovalidate') - $daysSinceCreation; 
			// Guardar los dias de margen restantes en una variable de sesión
			$this->setAttribute('remainingDaysToApproveEmail', $remainingDays);
			
			// Si es negativo (le ha pasado el plazo) no logueamos. 
			if($remainingDays <= 0)
			{
				$this->setAttribute("email", $account->getEmail());
				return;
			}

		}
		
		$this->setAuthenticated(true);
		// Almacenar en dos variables de sesi�n el nivel de la cuenta (privilegios) y el email
		if($account->getAccountLevel() == 0)
		{
			$this->addCredential('moderator');
		}
		$this->setAttribute("levelAccount", $account->getAccountLevel());
		$this->setAttribute("email", $account->getEmail());
		$this->setAttribute("avatarId", $account->getAvatar()->getId());
		$this->setAttribute("avatarApiKey", $account->getAvatar()->getApiKey());
	
		// Enviamos las cookies que permitan recordar la contrase�a
		if ( $rememberPassword )
		{
			$this->getContext()->getResponse()->setCookie('sessionId',$account->getSessionId(),time()+60*60*24*15);
			$this->getContext()->getResponse()->setCookie('accountEmail',$account->getEmail(),time()+60*60*24*15);
		}
	}

	public function signOut()
	{
		$this->attributeHolder->clear();
	  	$this->setAuthenticated(false);
	  	
	  	// TODO quiz�s habr�a que comprobar si realmente existen las cookies antes de escribir estas.
	  	//Borramos las cookies
	  	$this->getContext()->getResponse()->setCookie('sessionId', -1); 
		$this->getContext()->getResponse()->setCookie('accountEmail', ".");
	}

	public function getId()
	{
		return AccountPeer::retrieveByUsername($this->getAttribute('email'))->getId();
	}
	
	public function getUsername()
	{
		return $this->getAttribute('email');		
	}

	
	public function __toString()
	{
		return $this->getUsername();
	}
}
