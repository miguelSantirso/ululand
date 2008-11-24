<?php

class ulUser extends sfGuardSecurityUser
{
	public function signIn($user, $remember = false, $con = null)
	{
		$this->getAttributeHolder()->remove('daysToValidateEmail');
		
		parent::signIn($user, $remember, $con);
		
		if(!$this->getProfile()->getIsApproved())
		{
			// No ha sido aprobado, calcular cuantos días quedan de margen (si es que queda alguno)
			$daysSinceCreation = floor( (strtotime("now") - strtotime($this->getGuardUser()->getCreatedAt())) / (60*60*24) );
			$remainingDays = sfConfig::get('app_register_daystovalidate') - $daysSinceCreation; 
			// Guardar los dias de margen restantes en una variable de sesión
			$this->setAttribute('daysToValidateEmail', $remainingDays);
		}
		
		if(isset($remainingDays) && $remainingDays <= 0)
		{
			$this->signOut();
			$this->context->getController()->redirect("sfGuardAuth/approveEmail?userEmail={$user}");
		}
	}

	public function signOut()
	{
		parent::signOut();
		
		$this->getAttributeHolder()->clear();
	}
}