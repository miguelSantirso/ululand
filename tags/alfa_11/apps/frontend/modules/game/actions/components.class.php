<?php

/**
 * game components.
 *
 * @package    PFC
 * @subpackage widget
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gameComponents extends sfComponents
{
	
  /**
   * Executes game component
   *
   */
  public function executeGame()
  {
  	// Cargar el juego
  	$this->game = GamePeer::retrieveByPK($this->gameId);
  	if($this->game)
  	{
	    // Iniciar la sesi�n de la api
	    $newApiSession = ApiSessionPeer::createNew($this->game->getApiKey(), 
	    				$this->getUser()->getAttribute("avatarApiKey"),
	    				$this->game->getPrivilegesLevel());    // Iniciar la sesi�n de la api
	    
	    // A�adimos el sessionId al principio de los flashVars para pas�rselo al objeto flash.
	    $this->flashVars = 'apiSessionId='.$newApiSession->getSessionId().'&'.$this->flashVars;
  	}
  	
  }
}
