<?php

/**
 * competition actions.
 *
 * @package    ululand
 * @subpackage competition
 * @author     Pncil.com <http://pncil.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class competitionActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    return $this->forward('competition', 'list');
  }
  
  public function executeList()
  {
  	$search = $this->getRequestParameter('search');
  	if($search)
  	{
  		$this->search = $search;
  	}
  	$username = $this->getRequestParameter('username');
  	if($username)
  	{
  		$this->username = $username;
  	}
  }
  
  public function executeShow()
  {  	
    $this->competition = CompetitionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->competition);
    
    $this->competition->incrementCounter(); // Una visita más
  }
  
  public function executeEdit()
  {
  	// Obtener el id de la competición a editar
  	if($this->getRequestParameter('id'))
  	{
  		$this->competitionId = $this->getRequestParameter('id');
  	}
  	else
  	{
  		// Obtener el jugador del perfil
	    $this->profile = PlayerProfilePeer::retrieveByPk($this->getUser()->getPlayerProfile()->getId());
 	    $this->forward404Unless($this->profile);
  		
  		// Crear un nuevo objeto Group
	 	$this->newCompetition = new Competition();
		        
	 	        
		// Modificar adecuadamente el objeto
		$this->newCompetition->setName("Name");
		$this->newCompetition->setDescription("Description");
		$this->newCompetition->setCreatedBy($this->profile->getId());
	 	        
		// Grabarlo en la base de datos
		$this->newCompetition->save();
		
		$this->competitionId = $this->newCompetition->GetId();
 	        
	    // Crear un nuevo objeto PlayerProfile_Group
 	    $this->newCompetition_PlayerProfile = new Competition_PlayerProfile();
	        
	        
	    // Modificar adecuadamente el objeto
	    $this->newCompetition_PlayerProfile->setPlayerProfileId($this->profile->getId());
 	    $this->newCompetition_PlayerProfile->setCompetitionId($this->competitionId);
	    $this->newCompetition_PlayerProfile->setIsOwner(true);
	    $this->newCompetition_PlayerProfile->setIsConfirmed(true);
	        
	    // Grabarlo en la base de datos
	    $this->newCompetition_PlayerProfile->save();
		
		$this->redirect('competition/edit?id='.$this->competitionId);
  	}
  	
   	// Obtener el objeto de la competición a editar
	$this->competition = CompetitionPeer::retrieveByPk($this->competitionId);
	$this->forward404Unless($this->competition);
  	
	// Comprobar que el usuario está editando su propio perfil y no otro
	if($this->competition->getStatus($this->getUser()->getPlayerProfile()) != CompetitionPeer::OWNER)
	{
		$this->setFlash('error', 'No tienes permisos para editar esta competición');
		$this->redirect('competition/list');
	}
  }
  
  public function executeUpdate()
  {
  	if($this->getRequest()->getMethod() == sfRequest::POST)
  	{
  		// Obtener el id del perfil a editar
  		$competitionId = $this->getRequestParameter('id');
  		// Obtener el objeto del perfil de usuario a editar
  		$competition = CompetitionPeer::retrieveByPk($competitionId);
  		$this->forward404Unless($competition);
  		
  		// Comprobar que el usuario está editando su propio perfil y no otro
  		if($competition->getStatus($this->getUser()->getPlayerProfile()) != CompetitionPeer::OWNER)
  		{
  			// @todo Mensaje no internacionalizado
  			$this->setFlash('warning', 'No tienes permisos para editar esta competición');
  			$this->forward('competition', 'list');
  		}
  		

  		$competition->setName($this->getRequestParameter('name'));
  		$competition->setDescription($this->getRequestParameter('description'));
  		$competition->save();
  	}

  	return $this->redirect('competition/show?id='.$competitionId);
  }
  
  public function executePreview()
  {
  	$this->name = $this->getRequestParameter('name');
  	$this->description = $this->getRequestParameter('description');
  }
  
  public function executeUnion()
  {
  	// Obtener el jugador del perfil
	$this->profile = PlayerProfilePeer::retrieveByPk($this->getUser()->getPlayerProfile()->getId());
	$this->forward404Unless($this->profile);
	
  	// Obtener la competición al que se quiere unir
  	$this->competition = CompetitionPeer::retrieveByPk($this->getRequestParameter('competition'));
    $this->forward404Unless($this->competition);
    
    // Crear un nuevo objeto Competition_PlayerProfile
	$this->newCompetition_PlayerProfile = new Competition_PlayerProfile();
		
		
	// Modificar adecuadamente el objeto
	$this->newCompetition_PlayerProfile->setPlayerProfileId($this->profile->GetId());
	$this->newCompetition_PlayerProfile->setCompetitionId($this->competition->GetId());
	$this->newCompetition_PlayerProfile->setIsOwner(false);
	$this->newCompetition_PlayerProfile->setIsConfirmed(false);
		
	// Grabarlo en la base de datos
	$this->newCompetition_PlayerProfile->save();
  	
  	return $this->redirect('competition/show?id='.$this->competition->getId());
  }
  
  public function executeAccept()
  {
  	// Obtener el jugador 
	$player = $this->getRequestParameter('player');
	
  	// Obtener la competición
  	$competition = $this->getRequestParameter('competition');
  	
  	$c = new Criteria();
  	$c->add(PlayerProfilePeer::ID, $player);
  	$c->add(CompetitionPeer::ID, $competition);
  	
  	$this->players_competitions = Competition_PlayerProfilePeer::doSelectJoinAll($c);
  	
  	foreach ($this->players_competitions as $this->player_competition):
  	
  	// Aceptar al jugador en la competición
    $this->player_competition->setIsConfirmed(true);
    $this->player_competition->save();
    
    endforeach;
  	
  	return $this->redirect('competition/edit?id='.$competition);
  }
  
  public function executeReject()
  {
  	// Obtener el jugador
	$player = $this->getRequestParameter('player');
	
  	// Obtener el grupo
  	$competition = $this->getRequestParameter('competition');
  	
  	$c = new Criteria();
  	$c->add(PlayerProfilePeer::ID, $player);
  	$c->add(CompetitionPeer::ID, $competition);
  	
  	$this->players_competitions = Competition_PlayerProfilePeer::doSelectJoinAll($c);
  	
  	
  	foreach ($this->players_competitions as $this->player_competition):
  	
  	// Eliminar la petici�n
    $this->player_competition->delete();
    
    endforeach;
  	
  	return $this->redirect('competition/edit?id='.$competition);
  }
  
}
