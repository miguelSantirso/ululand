<?php

/**
 * group actions.
 *
 * @package    PFC
 * @subpackage group
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class groupActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	return $this->forward('group', 'list');
  }
  
  public function executeCreate()
  {
  // Si el m�todo de la petici�n es POST, quiere decir que NO se deben procesar los datos del formulario de registro
	if ($this->getRequest()->getMethod() != sfRequest::POST)
	{
		$this->sfContext = $this->getContext();
		
		// Display the form
		return sfView::SUCCESS;
	}
	else // el m�todo de la petici�n es GET. Es necesario procesar el formulario
	{
		// no hace falta comprobar errores porque eso ya se hace mediante los m�todos
		// validate autom�ticos. Ver validate\group.yml
		 
		// TODO HA IDO BIEN. CREAR EL GRUPO
		$this->name = $this->getRequestParameter('namegroup');
		$this->description = $this->getRequestParameter('description');
		
		// Crear un nuevo objeto Group
		$this->newGroup = new Group();
		
		
		// Modificar adecuadamente el objeto
		$this->newGroup->setName($this->name);
		$this->newGroup->setDescription($this->description);
		
		// Grabarlo en la base de datos
		$this->newGroup->save();
		
		// Obtener el avatar del perfil
		$this->profile = PlayerProfilePeer::retrieveByPk($this->getUser()->getProfile()->getId());
		$this->forward404Unless($this->profile);
		
		// Obtener el grupo del perfil
		$groupid = $this->newGroup->GetId();
		
		// Crear un nuevo objeto Avatar_Group
		$this->newPlayerProfile_Group = new PlayerProfile_Group();
		
		
		// Modificar adecuadamente el objeto
		$this->newPlayerProfile_Group->setPlayerProfileId($this->profile->getId());
		$this->newPlayerProfile_Group->setGrupoId($groupid);
		$this->newPlayerProfile_Group->setIsOwner(true);
		$this->newPlayerProfile_Group->setIsApproved(true);
		
		// Grabarlo en la base de datos
		$this->newPlayerProfile_Group->save();
		
		
    	$this->setFlash('success', 'Grupo creado con &eacute;xito.');
		$this->redirect('group/listall');
	}
  }
  
  /**
   * Funci�n que se ocupa de gestionar los posibles errores de validaci�n del formulario de creación de un grupo.
   * Lo �nico que hace es redirigir a la p�gina de donde se ven�a para que el usuario pueda corregir
   * los errores que haya cometido al rellenar el formulario.
   *
   * @return void
   **/
  public function handleErrorCreate()
  {
  	$this->sfContext = $this->getContext();
  	$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario para crear el grupo.', false);
    $this->preExecute(); // Es necesario llamarlo a mano para que ejecute todo el c�digo previo 
    return sfView::SUCCESS;
  }
  
  public function executeListall()
  {
  	$pager = new sfPropelPager('Group', sfConfig::get('app_pager_profile'));
	$c = new Criteria();
	$c->addDescendingOrderByColumn(GroupPeer::NAME);
	$pager->setCriteria($c);
	$pager->setPage($this->getRequestParameter('page', 1));
	$pager->init();
	
	$this->groupsPager = $pager;		
  }
  
  public function executeList()
  {
  	// Obtener el avatar del perfil
	$this->profile = PlayerProfilePeer::retrieveByPk($this->getUser()->getProfile()->getId());
	$this->forward404Unless($this->profile);
	
  	// Obtenemos los grupos del avatar
    $this->groups = $this->profile->getGroups();	
  }
  
  public function executeShow()
  {
  	// Obtener el avatar del perfil
	$this->profile = PlayerProfilePeer::retrieveByPk($this->getUser()->getProfile()->getId());
	$this->forward404Unless($this->profile);
  	
    $this->group = GroupPeer::retrieveByPk($this->getRequestParameter('group'));
    $this->forward404Unless($this->group);
    
    $this->description = $this->group->getDescription();
    
    // Obtenemos los avatares y las peticiones del grupo
    $this->avatars = $this->group->getPlayerProfiles();
    $this->owners = $this->group->getOwners();
    $this->requests = $this->group->getRequests();
    $this->members = $this->group->getMembers();
    
  }
  
  public function executeUnion()
  {
  	// Obtener el avatar del perfil
	$this->profile = PlayerProfilePeer::retrieveByPk($this->getUser()->getProfile()->getId());
	$this->forward404Unless($this->profile);
	
  	// Obtener el grupo al que se quiere unir
  	$this->group = GroupPeer::retrieveByPk($this->getRequestParameter('group'));
    $this->forward404Unless($this->group);
    
    // Crear un nuevo objeto Avatar_Group
	$this->newPlayerProfile_Group = new PlayerProfile_Group();
		
		
	// Modificar adecuadamente el objeto
	$this->newPlayerProfile_Group->setPlayerProfileId($this->profile->GetId());
	$this->newPlayerProfile_Group->setGrupoId($this->group->GetId());
	$this->newPlayerProfile_Group->setIsOwner(false);
	$this->newPlayerProfile_Group->setIsApproved(false);
		
	// Grabarlo en la base de datos
	$this->newPlayerProfile_Group->save();
  	
  	return $this->forward('group', 'list');
  }
  
  public function executeAccept()
  {
  	// Obtener el jugador 
	$player = $this->getRequestParameter('player');
	
  	// Obtener el grupo
  	$group = $this->getRequestParameter('group');
  	
  	$c = new Criteria();
  	$c->add(PlayerProfilePeer::ID, $player);
  	$c->add(GroupPeer::ID, $group);
  	
  	$this->players_groups = PlayerProfile_GroupPeer::doSelectJoinAll($c);
  	
  	foreach ($this->players_groups as $this->player_group):
  	
  	// Aceptar al avatar en el grupo
    $this->player_group->setIsApproved(true);
    $this->player_group->save();
    
    endforeach;
  	
  	return $this->forward('group', 'list');
  }
  
  public function executeReject()
  {
  	// Obtener el avatar 
	$player = $this->getRequestParameter('player');
	
  	// Obtener el grupo
  	$group = $this->getRequestParameter('group');
  	
  	$c = new Criteria();
  	$c->add(PlayerProfilePeer::ID, $player);
  	$c->add(GroupPeer::ID, $group);
  	
  	$this->players_groups = PlayerProfile_GroupPeer::doSelectJoinAll($c);
  	
  	
  	foreach ($this->players_groups as $this->player_group):
  	
  	// Eliminar la petici�n
    $this->player_group->delete();
    
    endforeach;
  	
  	return $this->forward('group', 'list');
  }
  
}
