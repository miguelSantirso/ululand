<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 * Acciones de gestión de usuarios comunes a todas las aplicaciones. Extiende a la clase correspondiente del plugin "sfGuardAuth"
 *
 * @package    ululand
 * @subpackage sfGuardAuth
 * @author     Pncil.com <http://pncil.com>
 */
class ulsfGuardAuthActions extends BasesfGuardAuthActions
{
	/**
	 * Acción que extiende la acción signin del plugin "sfGuardAuth". Actualiza el idioma del interfaz del sistema cuando el usuario inicia sesión
	 *
	 */
	public function executeSignin()
	{
		if($this->getUser()->isAuthenticated())
		$this->getUser()->setCulture($this->getUser()->getProfile()->getCulture());
		
		$this->getUser()->setAttribute('referer', sfContext::getInstance()->getRequest()->getReferer());
		
		parent::executeSignin();
	}

	/**
	 * Habilita el registro de nuevos usuarios
	 *
	 */
	public function executeRegister()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// Si el usuario está identificado
			if( $this->getUser()->isAuthenticated() )
			{
				$this->redirect('@homepage');
			}

			// Display the form
			return sfView::SUCCESS;
		}
		else // el método de la petición es GET. Es necesario procesar el formulario
		{
			// no hace falta comprobar errores porque eso ya se hace mediante los m�todos
			// validate automáticos. Ver validate\register.yml

			// TODO HA IDO BIEN. CREAR LA CUENTA
			$user = new sfGuardUser();
			$user->setUsername($this->getRequestParameter('username'));
			$user->setPassword($this->getRequestParameter('password'));
			$user->setIsActive(true);
			$user->save();
				

			// CREAR EL PERFIL DEL NUEVO USUARIO
			$profile = new sfGuardUserProfile();
			$profile->setUserId($user->getId());
			$languages = $this->getRequest()->getLanguages();
			$preferredLanguage = $languages[0];
			if($preferredLanguage == 'es' || $preferredLanguage == 'es_ES')
				$profile->setCulture('es');
			else
				$profile->setCulture('en');

			$profile->setUsername($this->getRequestParameter('screenname'));
			$profile->save();
			
			// CREAR EL AVATAR DEL NUEVO USUARIO
			$newAvatar = new Avatar();
			$newAvatar->setProfile($profile);
			
			// crear las piezas iniciales del avatar
			$basicPieces = array("head", "body", "arm", "leg");
			foreach($basicPieces as $basicPiece)
			{
				$piece = new AvatarPiece();
				$piece->setName("Basic {$basicPiece}");
				$piece->setDescription("Basic {$basicPiece}. You can edit this piece to customize your look");
				$piece->setAuthorId($profile->getId());
				$piece->setOwnerId($profile->getId());
				$piece->setUrl("/basics/{$basicPiece}.png");
				$piece->setPrice(0);
				$piece->setType($basicPiece);
				$piece->save();
				
				if($basicPiece == "head") { $newAvatar->setHeadId($piece->getId()); }
				else if($basicPiece == "body") { $newAvatar->setBodyId($piece->getId()); }
				else if($basicPiece == "arm") { $newAvatar->setArmsId($piece->getId()); }
				else if($basicPiece == "leg") { $newAvatar->setLegsId($piece->getId()); }
			}
			
			$newAvatar->save();
			
			// Iniciar automaticamente la sesión para el usuario que se acaba de registrar
			$this->getContext()->getUser()->signIn($user, true);
			
			// Enviar correo de bienvenida
			$this->sendApprovalEmail($profile);
			
			$this->getUser()->setFlash('success', ulToolkit::__('Welcome to ululand! You are our latest registered user (and we love you)'));
			
			$this->redirect('@homepage');
		}
	}

	/**
	 * Maneja los posibles errores en el proceso de registro
	 *
	 */
	public function handleErrorRegister()
	{
		// @todo mensaje no internacionalizado
		$this->getUser()->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
		return sfView::SUCCESS;
	}

	/**
	 * Acción que se ejecuta inmediatamente después de validar el correo electrónico
	 *
	 */
	public function executeEmailApproved()
	{
		$this->getUser()->getAttributeHolder()->remove('daysToValidateEmail');
		$this->getUser()->setFlash('success', ulToolkit::__('Your email has been successfully verified. Thanks!'));
		 
		$this->redirect('@homepage');
	}

	/**
	 * Pantalla que muestra las explicaciones de como validar el email
	 *
	 */
	public function executeApproveEmail()
	{
		$recognisedEmailProviders = array('gmail.com', 'hotmail.com', 'msn.com', 'me.com', 'mac.com', 'yahoo.com');
		if($this->getUser()->isAuthenticated())
		{
			$this->userEmail = $this->getUser()->getUsername();
		}
		else
		{
			$this->userEmail = $this->getRequest()->getParameter('userEmail');
		}
		
		$splittedEmail = split("@", $this->userEmail);
		if(array_search($splittedEmail[1], $recognisedEmailProviders) !== false)
			$this->emailProvider = $splittedEmail[1];
		
		return sfView::SUCCESS;
	}

	/**
	 * Acción que reenvía el email de aprobación y muestra el aviso del resultado
	 *
	 */
	public function executeResendApprovalEmail()
	{
		$this->userEmail = $this->getRequest()->getParameter('userEmail');
		$sfGuardUserProfile = sfGuardUserPeer::retrieveByUsername($this->userEmail)->getProfile();
		if($sfGuardUserProfile && !$sfGuardUserProfile->getIsApproved())
		{
			$this->sendApprovalEmail($sfGuardUserProfile);
			$this->getUser()->setFlash('success', sprintf(ulToolkit::__('Confirmation email successfully delivered to %s'), $this->userEmail));
			$this->setTemplate('approveEmail');
		}
		else
		{
			if($sfGuardUserProfile)
			{
				$this->errorMessage = __("You kiddin'? Your email account is already validated. You don't need the confirmation email!");
			}
			else
			{
				$this->errorMessage = __("Wops... Something really weird has just happened. Sorry!");
			}
			return sfView::ERROR;
		}
	}

	protected function sendApprovalEmail($sfGuardUserProfile)
	{
		$this->getRequest()->setParameter('email', $sfGuardUserProfile->getSfGuardUser()->getUsername());
		$this->getRequest()->setParameter('approvalLink', $sfGuardUserProfile->getApprovalUrl());
		 
		$this->sendEmail('mail', 'sendEmailApprovalLink');
	}
}
