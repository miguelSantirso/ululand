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
			$this->playerProfile = $this->sf_guard_user_profile->getPlayerProfile(true);
				
			$this->forward404Unless($this->sf_guard_user_profile);
			$this->forward404Unless($this->playerProfile);

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
			$playerProfile = $sf_guard_user_profile->getPlayerProfile();
			$this->forward404Unless($playerProfile);

			$playerProfile->setDescription($this->getRequestParameter('description'));
				
			$playerProfile->save();
				
			$this->sf_guard_user_profile = $sf_guard_user_profile;
			$this->playerProfile = $playerProfile;
			
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
		$this->playerProfile = $this->sf_guard_user_profile->getPlayerProfile(true);
			
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
		$this->playerProfile = $this->userProfile->getPlayerProfile(true);	
		
		$c = new Criteria();
		$c->add(AvatarPiecePeer::IN_USE, true);
		$this->avatarPieces = $this->userProfile->getAvatarPiecesRelatedByOwnerId($c);
		
		$this->avatarPiecesCatalogue = $this->userProfile->getAvatarPiecesRelatedByOwnerId();
	}
	
	/**
	 * Acción que pone una pieza de avatar en el avatar del usuario.
	 *
	 */
	public function executeSetAvatarPiece()
	{
		if(!$this->getRequestParameter('id')) { $this->owner = $this->getUser()->getProfile(); return sfView::SUCCESS; } 
		
		$tmp = split('_', $this->getRequestParameter('id', ''));
  		$avatarPieceId = $tmp[1];
  		
  		$avatarPiece = AvatarPiecePeer::retrieveByPK($avatarPieceId);
  		if(is_null($avatarPiece)) return sfView::ERROR;
  		
  		$owner = $avatarPiece->getsfGuardUserProfileRelatedByOwnerId();
  		if(is_null($owner)) return sfView::ERROR;
  		
  		$avatar = $owner->getAvatar();
  		
  		switch($avatarPiece->getType())
  		{
  			case 'head':
  				$avatar->setHeadId($avatarPieceId);
  				break;
  			case 'body':
  				$avatar->setBodyId($avatarPieceId);
  				break;
  			case 'arm':
  				$avatar->setArmsId($avatarPieceId);
  				break;
  			case 'leg':
  				$avatar->setLegsId($avatarPieceId);
  				break;
  		}
  		$avatar->save();
  		
  		$this->avatar = $avatar;
  		$this->owner  = $owner;
	}
	
}
