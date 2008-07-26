<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones bï¿½sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/frontendCommonActions.class.php';

/**
 * group actions.
 *
 * @package    PFC
 * @subpackage group
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class groupActions extends frontendCommonActions
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
  // Si el mï¿½todo de la peticiï¿½n es POST, quiere decir que NO se deben procesar los datos del formulario de registro
	if ($this->getRequest()->getMethod() != sfRequest::POST)
	{
		$this->sfContext = $this->getContext();
		
		// Display the form
		return sfView::SUCCESS;
	}
	else // el mï¿½todo de la peticiï¿½n es GET. Es necesario procesar el formulario
	{
		// no hace falta comprobar errores porque eso ya se hace mediante los mï¿½todos
		// validate automï¿½ticos. Ver validate\group.yml
		 
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
		$this->profile = AvatarPeer::retrieveByPk($this->getUser()->getAttribute('avatarId'));
		$this->forward404Unless($this->profile);
		
		// Obtener el grupo del perfil
		$groupid = $this->newGroup->GetId();
		
		// Crear un nuevo objeto Avatar_Group
		$this->newAvatar_Group = new Avatar_Group();
		
		
		// Modificar adecuadamente el objeto
		$this->newAvatar_Group->setAvatarId($this->profile);
		$this->newAvatar_Group->setGrupoId($groupid);
		$this->newAvatar_Group->setIsOwner(true);
		$this->newAvatar_Group->setIsApproved(true);
		
		// Grabarlo en la base de datos
		$this->newAvatar_Group->save();
		
		
    	$this->setFlash('success', 'Grupo creado con &eacute;xito.');
		$this->redirect('group/listall');
	}
  }
  
  /**
   * Funciï¿½n que se ocupa de gestionar los posibles errores de validaciï¿½n del formulario de creaciÃ³n de un grupo.
   * Lo ï¿½nico que hace es redirigir a la pï¿½gina de donde se venï¿½a para que el usuario pueda corregir
   * los errores que haya cometido al rellenar el formulario.
   *
   * @return void
   **/
  public function handleErrorCreate()
  {
  	$this->sfContext = $this->getContext();
  	$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario para crear el grupo.', false);
    $this->preExecute(); // Es necesario llamarlo a mano para que ejecute todo el cï¿½digo previo 
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
	$this->profile = AvatarPeer::retrieveByPk($this->getUser()->getAttribute('avatarId'));
	$this->forward404Unless($this->profile);
	
  	// Obtenemos los grupos del avatar
    $this->groups = $this->profile->getGroups();	
  }
  
  public function executeShow()
  {
  	// Obtener el avatar del perfil
	$this->profile = AvatarPeer::retrieveByPk($this->getUser()->getAttribute('avatarId'));
	$this->forward404Unless($this->profile);
  	
    $this->group = GroupPeer::retrieveByPk($this->getRequestParameter('group'));
    $this->forward404Unless($this->group);
    
    $this->description = $this->group->getDescription();
    
    // Obtenemos los avatares y las peticiones del grupo
    $this->avatars = $this->group->getAvatars();
    $this->owners = $this->group->getOwners();
    $this->peticiones = $this->group->getPeticiones();
    
  }
  
  public function executeUnion()
  {
  	// Obtener el avatar del perfil
	$this->profile = AvatarPeer::retrieveByPk($this->getUser()->getAttribute('avatarId'));
	$this->forward404Unless($this->profile);
	
  	// Obtener el grupo al que se quiere unir
  	$this->group = GroupPeer::retrieveByPk($this->getRequestParameter('group'));
    $this->forward404Unless($this->group);
    
    // Crear un nuevo objeto Avatar_Group
	$this->newAvatar_Group = new Avatar_Group();
		
		
	// Modificar adecuadamente el objeto
	$this->newAvatar_Group->setAvatarId($this->profile->GetId());
	$this->newAvatar_Group->setGrupoId($this->group->GetId());
	$this->newAvatar_Group->setIsOwner(false);
	$this->newAvatar_Group->setIsApproved(false);
		
	// Grabarlo en la base de datos
	$this->newAvatar_Group->save();
  	
  	return $this->forward('group', 'list');
  }
  
  public function executeAccept()
  {
  	// Obtener el avatar 
	$avatar = $this->getRequestParameter('avatar');
	
  	// Obtener el grupo
  	$group = $this->getRequestParameter('group');
  	
  	$c = new Criteria();
  	$c->add(AvatarPeer::ID, $avatar);
  	$c->add(GroupPeer::ID, $group);
  	
  	$this->avatars_groups = Avatar_GroupPeer::doSelectJoinAll($c);
  	
  	echo count($this->avatars_groups);
  	foreach ($this->avatars_groups as $this->avatar_group):
  	
  	// Aceptar al avatar en el grupo
    $this->avatar_group->setIsApproved(true);
    $this->avatar_group->save();
    
    endforeach;
  	
  	return $this->forward('group', 'list');
  }
  
  public function executeReject()
  {
  	// Obtener el avatar 
	$avatar = $this->getRequestParameter('avatar');
	
  	// Obtener el grupo
  	$group = $this->getRequestParameter('group');
  	
  	$c = new Criteria();
  	$c->add(AvatarPeer::ID, $avatar);
  	$c->add(GroupPeer::ID, $group);
  	
  	$this->avatars_groups = Avatar_GroupPeer::doSelectJoinAll($c);
  	
  	
  	foreach ($this->avatars_groups as $this->avatar_group):
  	
  	// Eliminar la petición
    $this->avatar_group->delete();
    
    endforeach;
  	
  	return $this->forward('group', 'list');
  }
  
}
