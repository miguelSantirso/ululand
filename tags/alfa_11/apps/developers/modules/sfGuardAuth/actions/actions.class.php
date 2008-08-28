<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 * sfGuardAuth actions.
 *
 * @package    ululand_dev
 * @subpackage sfGuardAuth
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
	public function executeSignin()
	{	
		if($this->getUser()->isAuthenticated())
			$this->getUser()->setCulture($this->getUser()->getProfile()->getCulture());
			
		parent::executeSignin();
	}
	
	public function executeRegister()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// Si el usuario est� identificado
			if( $this->getUser()->isAuthenticated() )
			{
				$this->redirect('home/index');
			}

			// Display the form
			return sfView::SUCCESS;
		}
		else // el m�todo de la petici�n es GET. Es necesario procesar el formulario
		{
			// no hace falta comprobar errores porque eso ya se hace mediante los m�todos
			// validate autom�ticos. Ver validate\register.yml
				
			// TODO HA IDO BIEN. CREAR LA CUENTA
			$user = new sfGuardUser();
			$user->setUsername($this->getRequestParameter('username'));
			$user->setPassword($this->getRequestParameter('password'));
			$user->setIsActive(true);
			$user->save();
			
			$profile = new sfGuardUserProfile();
			$profile->setUserId($user->getId());
			$languages = $this->getRequest()->getLanguages();
			$preferredLanguage = $languages[0];
			if($preferredLanguage == 'es' || $preferredLanguage == 'es_ES')
				$profile->setCulture('es');
			else
				$profile->setCulture('en');
			
			$profile->save();

			$this->getContext()->getUser()->signIn($user, true);
			
			// @todo mensaje no internacionalizado
			$this->setFlash('success', 'Registro completado con éxito');
			
			$this->redirect('profile/edit?id='.$profile->getId());
		}
	}
	
	public function handleErrorRegister()
	{
		// @todo mensaje no internacionalizado
		$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
		return sfView::SUCCESS;
	}
}
