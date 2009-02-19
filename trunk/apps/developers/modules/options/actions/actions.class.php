<?php

/**
 * options actions.
 *
 * @package    ululand
 * @subpackage options
 * @author     Pncil.com <http://pncil.com>
 */
class optionsActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{

	}

	/**
	 * Acción correspondiente a la pantalla de edición de un perfil
	 *
	 */
	public function executeEditProfile()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			$this->sf_guard_user_profile = $this->getUser()->getProfile();

			// Obtener el perfil de jugador a editar (en caso de no existir, se fuerza su creación)
			$this->developerProfile = $this->sf_guard_user_profile->getDeveloperProfile(true);
				
			$this->forward404Unless($this->sf_guard_user_profile);
			$this->forward404Unless($this->developerProfile);

			// Display the form
			return sfView::SUCCESS;
		}
		else // El mï¿½todo es POST. Es necesario procesar la informaciï¿½n del formulario.
		{
			// Obtener el id del perfil a editar
			$profileId = $this->getRequestParameter('id');

			// Comprobar que el usuario está editando su propio perfil y no otro
			if($profileId != $this->getUser()->getProfile()->getId())
			{
				// @todo Mensaje no internacionalizado
				$this->getUser()->setFlash('warning', 'No tienes permisos para editar ese perfil');
				$this->forward('profile', 'list');
			}
				
			// Obtener el objeto del perfil de usuario a editar
			$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk($this->getRequestParameter('id'));
			$this->forward404Unless($sf_guard_user_profile);

			$sf_guard_user_profile->setUsername($this->getRequestParameter('username'));
			$sf_guard_user_profile->setFirstName($this->getRequestParameter('first_name'));
			$sf_guard_user_profile->setLastName($this->getRequestParameter('last_name'));
			$sf_guard_user_profile->setGender($this->getRequestParameter('gender'));

			$sf_guard_user_profile->save();
				
			// Obtener el objeto del perfil de usuario a editar
			$developerProfile = $sf_guard_user_profile->getDeveloperProfile();
			$this->forward404Unless($developerProfile);

			$developerProfile->setUrl(ulToolkit::processUrl($this->getRequestParameter('url')));
			$developerProfile->setIsFree($this->getRequestParameter('is_free'));
			$developerProfile->setTags($this->getRequestParameter('tags_string'));
			$developerProfile->setDescription($this->getRequestParameter('description'));
				
			$developerProfile->save();
				
			$this->sf_guard_user_profile = $sf_guard_user_profile;
			$this->developerProfile = $developerProfile;
			
			$this->getUser()->setFlash('success', ulToolkit::__('Your profile has been successfully updated!'), false);
			$this->redirect('@options');
		}
	}

	/**
	 * Maneja los posibles errores en el formulario de edición de un perfil 
	 *
	 */
	public function handleErrorEditProfile()
	{
		$this->sf_guard_user_profile = $this->getUser()->getProfile();

		// Obtener el perfil de jugador a editar (en caso de no existir, se fuerza su creación)
		$this->developerProfile = $this->sf_guard_user_profile->getDeveloperProfile(true);
			
		return sfView::SUCCESS;		
	}
	
	/**
	 * Acción correspondiente a la pantalla de edición de la contraseña
	 *
	 */
	public function executeEditPassword()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// Display the form
			return sfView::SUCCESS;
		}
		else // El método es POST. Es necesario procesar la información del formulario.
		{				
			// Obtener el objeto del usuario a editar
			$sf_guard_user = sfGuardUserPeer::retrieveByPk($this->getUser()->getId());
			$this->forward404Unless($sf_guard_user);

			$sf_guard_user->setPassword($this->getRequestParameter('password'));

			$sf_guard_user->save();
			
			$this->getUser()->setFlash('success', ulToolkit::__('Your password has been successfully updated!'), false);
			$this->redirect('@options');
		}
	}

	/**
	 * Maneja los posibles errores producidos en el formulario de edición de contraseña
	 *
	 */
	public function handleErrorEditPassword()
	{
		return sfView::SUCCESS;		
	}
	
	/**
	 * Acción correspondiente a la pantalla de edición de la configuración general
	 *
	 */
	public function executeEditSettings()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			$this->sf_guard_user_profile = $this->getUser()->getProfile();

			$this->forward404Unless($this->sf_guard_user_profile);

			// Display the form
			return sfView::SUCCESS;
		}
		else // El mï¿½todo es POST. Es necesario procesar la informaciï¿½n del formulario.
		{
			// Obtener el id del perfil a editar
			$profileId = $this->getRequestParameter('id');

			// Comprobar que el usuario está editando su propio perfil y no otro
			if($profileId != $this->getUser()->getProfile()->getId())
			{
				// @todo Mensaje no internacionalizado
				$this->getUser()->setFlash('warning', 'No tienes permisos para editar ese perfil');
				$this->forward('profile', 'list');
			}
			
			// Obtener el objeto del usuario a editar
			$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk($profileId);
			$this->forward404Unless($sf_guard_user_profile);

			$sf_guard_user_profile->setCulture($this->getRequestParameter('culture'));

			$sf_guard_user_profile->save();
			
			$this->getUser()->setCulture($sf_guard_user_profile->getCulture());
			
			$this->getUser()->setFlash('success', ulToolkit::__('The interface settings have been succesfully updated!'), false);
			$this->redirect('@options');
		}
	}

	/**
	 * Acción correspondiente a la pantalla de edición del avatar
	 *
	 */
	public function executeEditAvatar()
	{
		$this->userProfile   = $this->getUser()->getProfile();
		$this->developerProfile = $this->userProfile->getDeveloperProfile(true);	
		
		$c = new Criteria();
		$c->add(AvatarPiecePeer::IN_USE, true);
		$this->avatarPieces = $this->userProfile->getAvatarPiecesRelatedByOwnerId($c);
		
		$this->avatarPiecesCatalogue = $this->userProfile->getAvatarPiecesRelatedByOwnerId();
	}
	
}
