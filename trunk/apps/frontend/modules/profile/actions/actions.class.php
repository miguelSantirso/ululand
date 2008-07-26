<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/frontendCommonActions.class.php';

/**
 * profile actions.
 *
 * @package    PFC
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class profileActions extends frontendCommonActions
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
		//$this->profiles = AvatarPeer::doSelect(new Criteria());

		$pager = new sfPropelPager('Avatar', sfConfig::get('app_pager_profile'));
		$c = new Criteria();
		$c->addDescendingOrderByColumn(AvatarPeer::NAME);
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->profilesPager = $pager;
	}

	public function executeShow()
	{
		// Obtener el avatar del perfil
		$this->profile = AvatarPeer::retrieveByPk($this->getRequestParameter('id'));
		$this->forward404Unless($this->profile);
		
		// Comprobamos si el usuario est� viendo su propio perfil
		$this->ownProfile = ($this->profile->getId() == $this->getUser()->getAttribute('avatarId'));

		// Obtenemos la hipot�tica relaci�n de amistad entre el avatar del usuario y el avatar del perfil
		$this->friendship = FriendshipPeer::getFriendshipBetween($this->profile->getId(), $this->getUser()->getAttribute('avatarId'));

		// Obtenemos los amigos y las peticiones de amigo sin confirmar
		$this->friends = $this->profile->getFriends();
		$this->notConfirmedFriends = $this->profile->getNotConfirmedFriends();
	}
	
	/**
	 * Acciones r�pidas para interactuar con el avatar seleccionado.
	 * Esto es lo que aparece cuando se pulsa en el bot�n + de los avatares
	 * 
	 */
	public function executeQuickActions()
	{
		$this->profile = AvatarPeer::retrieveByPK($this->getRequestParameter('id'));
		
		// Comprobamos si el usuario est� viendo su propio perfil
		$this->ownProfile = ($this->profile->getId() == $this->getUser()->getAttribute('avatarId'));

		// Obtenemos la hipot�tica relaci�n de amistad entre el avatar del usuario y el avatar del perfil
		$this->friendship = FriendshipPeer::getFriendshipBetween($this->profile->getId(), $this->getUser()->getAttribute('avatarId'));
		
	}
	
	/**
	 * Acción que añade una relación de amistad
	 *
	 */
	public function executeAddFriend()
	{
		// Obtener los ids de los dos avatares
		$this->avatarAId = $this->getUser()->getAttribute("avatarId");
		$this->avatarBId = $this->getRequestParameter('id');
		 
		try
		{
			// Establecer la nueva relación
			FriendshipPeer::addFriendship($this->avatarAId, $this->avatarBId);
		}
		catch (Exception $e)
		{
			$this->setFlash("error", "Error al crear la relaci&oacute;n de amistad: ".$e->getMessage(), false);
			// Volvemos a la página anterior
			$this->redirect("profile/show?id=".$this->avatarBId);
		}
		 
		$this->setFlash("success", "Se ha enviado o confirmado la petici&oacute;n de amistad.", false);
		// Volvemos a la página anterior
		if($this->getRequestParameter('redirectToProfile'))
		{
			$this->redirect("profile/show?id=".$this->getRequestParameter('redirectToProfile'));
		}
		else
		{
			$this->redirect("profile/show?id=".$this->avatarBId);			
		}
	}
}
