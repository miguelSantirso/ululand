<?php


/**
 * profile actions.
 *
 * @package    PFC
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class profileActions extends sfActions
{

	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('profile', 'list');
	}

	public function executeList()
	{
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
		
		$this->playerProfile = $this->sf_guard_user_profile->getPlayerProfile(true);
		// Obtenemos la hipotï¿½tica relaciï¿½n de amistad entre el avatar del usuario y el avatar del perfil
		$this->friendship = FriendshipPeer::getFriendshipBetween($this->playerProfile->getId(), $this->getUser()->getPlayerProfile()->getId());
		$this->playerProfile->incrementCounter(); // Una visita m�s
		
		$this->forward404Unless($this->sf_guard_user_profile);
		
	}
	
	
	public function executePreview()
	{
		$this->username = $this->getRequestParameter('username');
		$this->description = $this->getRequestParameter('description');
	}
	
	/* Muestra el formulario de edición de un perfil
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

		// Obtener el perfil de jugador a editar (en caso de no existir, se fuerza su creación)
		$this->playerProfile = $this->sf_guard_user_profile->getPlayerProfile(true);
		
		$this->forward404Unless($this->sf_guard_user_profile);
	}
	
	/* Actualiza un perfil según los datos recibidos como parámetros
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
			if($profileId != $this->getUser()->getProfile()->getId())
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
			$playerProfile = $sf_guard_user_profile->getPlayerProfile();
			$this->forward404Unless($playerProfile);
	
			$playerProfile->setDescription($this->getRequestParameter('description'));
			
			$playerProfile->save();
	
			
			$this->getUser()->setCulture($this->getRequestParameter('culture'));
		}
		
		return $this->redirect('profile/show?username='.$sf_guard_user_profile->getUsername());
	}
	
/**
	 * AcciÃ³n que aÃ±ade una relaciÃ³n de amistad
	 *
	 */
	public function executeAddFriend()
	{
		// Obtener los ids de los dos jugadores
		$this->playerAId = $this->getUser()->getPlayerProfile()->getId();
		
		$this->playerBId = $this->getRequestParameter('id');
		
		// Crear un nuevo objeto Friendship
 	    $this->newFriendship = new Friendship();
	        
	    // Modificar adecuadamente el objeto
	    $this->newFriendship->setPlayerProfileIdA($this->playerAId);
 	    $this->newFriendship->setPlayerProfileIdB($this->playerBId);
	    $this->newFriendship->setIsConfirmed(false);
	    
	    // Grabarlo en la base de datos
	    $this->newFriendship->save();
	    
	    // Obtener el objeto del perfil de usuario
		$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk(PlayerProfilePeer::retrieveByPk($this->playerBId)->getUserProfileId());
	    
	    $this->redirect('profile/show?username='.$sf_guard_user_profile->getUsername());
	}
	
/**
	 * AcciÃ³n que acepta una relaciÃ³n de amistad
	 *
	 */
	public function executeAcceptFriend()
	{
		// Obtener los ids de los dos jugadores
		$this->playerBId = $this->getUser()->getPlayerProfile()->getId();
		
		$this->playerAId = $this->getRequestParameter('id');
		
		$c = new Criteria();
	  	$c->add(FriendshipPeer::PLAYER_PROFILE_ID_A, $this->playerAId);
	  	$c->add(FriendshipPeer::PLAYER_PROFILE_ID_B, $this->playerBId);
	  	
	  	$this->friendships = FriendshipPeer::doSelect($c);
	  	
	  	foreach ($this->friendships as $this->friendship):
	  	
	  	// Aceptar la relación de amistad
	    $this->friendship->setIsConfirmed(true);
	    $this->friendship->save();
	    
	    endforeach;
	  	
	  	// Obtener el objeto del perfil de usuario
		$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk(PlayerProfilePeer::retrieveByPk($this->playerBId)->getUserProfileId());
	    
	    $this->redirect('profile/show?username='.$sf_guard_user_profile->getUsername());
	}
	
/**
	 * AcciÃ³n que rechaza una relaciÃ³n de amistad
	 *
	 */
	public function executeRejectFriend()
	{
		// Obtener los ids de los dos jugadores
		$this->playerBId = $this->getUser()->getPlayerProfile()->getId();
		
		$this->playerAId = $this->getRequestParameter('id');
		
		$c = new Criteria();
	  	$c->add(FriendshipPeer::PLAYER_PROFILE_ID_A, $this->playerAId);
	  	$c->add(FriendshipPeer::PLAYER_PROFILE_ID_B, $this->playerBId);
	  	
	  	$this->friendships = FriendshipPeer::doSelect($c);
	  	
	  	foreach ($this->friendships as $this->friendship):
	  	
	  	// Eliminar la relación de amistad
	    $this->friendship->delete();
	    
	    endforeach;
	  	
	  	// Obtener el objeto del perfil de usuario
		$sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk(PlayerProfilePeer::retrieveByPk($this->playerBId)->getUserProfileId());
	    
	    $this->redirect('profile/show?username='.$sf_guard_user_profile->getUsername());
	}
	
}
