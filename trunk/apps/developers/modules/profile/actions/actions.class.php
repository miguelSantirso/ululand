<?php

/**
 * profile actions.
 *
 * @package    ululand_dev
 * @subpackage profile
 * @author     Pncil.com
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class profileActions extends sfActions
{
	public function executeIndex()
	{
		return $this->forward('profile', 'list');
	}

	/**
	 * Lista todos los perfiles
	 *
	 */
	public function executeList()
	{
		$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
		}
		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
		}
	}

	/**
	 * Muestra la información de un perfil
	 *
	 */
	public function executeShow()
	{
		if($this->getRequestParameter('id'))
		{
			$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk($this->getRequestParameter('id'));
			$this->redirect('profile/show?username='.$sf_guard_user_profile->getUsername());
		}
		else if($this->getRequestParameter('username'))
		{
			$c = new Criteria();
			$c->add(sfGuardUserProfilePeer::USERNAME, $this->getRequestParameter('username'));
			$this->sf_guard_user_profile = sfGuardUserProfilePeer::doSelectOne($c);
		}
		
		$this->developerProfile = $this->sf_guard_user_profile->getDeveloperProfile(true);
		
		$this->forward404Unless($this->sf_guard_user_profile);
		$this->developerProfile->incrementCounter(); // Una visita más
		
		$this->getResponse()->setTitle(sprintf(ulToolkit::__('%s\'s profile. Flash game developers at developers.ululand.com'), 
			$this->developerProfile->getsfGuardUserProfile()));
	}
	
	public function executePreview()
	{
		$this->username = $this->getRequestParameter('username');
		$this->description = $this->getRequestParameter('description');
	}
  
	/**
	 * Muestra el formulario de edición de un perfil
	 *
	 */
	public function executeEdit()
	{	
		if($this->getRequestParameter('id'))
		{
			$this->sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk($this->getRequestParameter('id'));
			if($this->sf_guard_user_profile->getUsername())
				$this->redirect('profile/edit?username='.$this->sf_guard_user_profile->getUsername());
		}
		else if($this->getRequestParameter('username'))
		{
			$c = new Criteria();
			$c->add(sfGuardUserProfilePeer::USERNAME, $this->getRequestParameter('username'));
			$this->sf_guard_user_profile = sfGuardUserProfilePeer::doSelectOne($c);
		}
		
		// Comprobar que el usuario está editando su propio perfil y no otro
		if($this->sf_guard_user_profile != $this->getUser()->getProfile())
		{
			// @todo Mensaje no internacionalizado
			$this->setFlash('error', 'No tienes permisos para editar ese perfil');
			$this->forward('profile', 'list');
		}

		// Obtener el perfil de desarrollador a editar (en caso de no existir, se fuerza su creación)
		$this->developerProfile = $this->sf_guard_user_profile->getDeveloperProfile(true);
		
		$this->forward404Unless($this->sf_guard_user_profile);
	}

	/**
	 * Actualiza un perfil según los datos recibidos como parámetros
	 *
	 * @return unknown
	 */
	public function executeUpdate()
	{
		if($this->getRequest()->getMethod() == sfRequest::POST)
		{
			// Obtener el id del perfil a editar
			$profileId = $this->getRequestParameter('id');
	
			// Comprobar que el usuario está editando su propio perfil y no otro
			if($this->getUser()->isAuthenticated() && $profileId != $this->getUser()->getProfile()->getId())
			{
				// @todo Mensaje no internacionalizado
				$this->setFlash('warning', 'No tienes permisos para editar ese perfil');
				$this->forward('profile', 'list');
			}
			
			// Obtener el objeto del perfil de usuario a editar
			$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk($this->getRequestParameter('id'));
			$this->forward404Unless($sf_guard_user_profile);
	
			$sf_guard_user_profile->setUsername($this->getRequestParameter('username'));
			$sf_guard_user_profile->setCulture($this->getRequestParameter('culture'));
	
			$sf_guard_user_profile->save();
			
			// Obtener el objeto del perfil de usuario a editar
			$developerProfile = $sf_guard_user_profile->getDeveloperProfile();
			$this->forward404Unless($developerProfile);
	
			$developerProfile->setUrl($this->processUrl($this->getRequestParameter('url')));
			$developerProfile->setIsFree($this->getRequestParameter('is_free'));
			$developerProfile->setTags($this->getRequestParameter('tags_string'));
			$developerProfile->setDescription($this->getRequestParameter('description'));
			
			$developerProfile->save();
	
			
			$this->getUser()->setCulture($this->getRequestParameter('culture'));
		}
		
		return $this->redirect('profile/show?username='.$sf_guard_user_profile->getUsername());
	}
	
	protected function processUrl($url)
	{
		if(strncasecmp($url, 'http', 4) == 0)
		{
			return $url;
		}
		else
		{
			return 'http://'.$url;
		}
	}

}
