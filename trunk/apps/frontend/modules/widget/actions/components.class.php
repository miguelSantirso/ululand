<?php

/**
 * widget components.
 *
 * @package    ululand
 * @subpackage widget
 * @author     Pncil.com <http://pncil.com>
 */
class widgetComponents extends sfComponents
{
	
  /**
   * Executes widget component
   *
   */
  public function executeWidget()
  {
  	// Cargar el widget
  	$this->widget = WidgetPeer::RetrieveByName($this->widgetName);
  	if($this->widget && $this->getUser()->isAuthenticated())
  	{
	    // Iniciar la sesión de la api
	    $newApiSession = ApiSessionPeer::createNew($this->widget->getApiKey(), 
	    				$this->getUser()->getProfile()->getUuid(),
	    				$this->widget->getPrivilegesLevel());    // Iniciar la sesión de la api

	    // Añadimos el userUuid al principio de los flashVars para pasárselo al objeto flash.
	    $this->flashVars = 'userUuid='.$this->getUser()->getProfile()->getUuid().'&'.$this->flashVars;
	    
	    // Añadimos el apiSessionId al principio de los flashVars para pasárselo al objeto flash.
	    $this->flashVars = 'apiSessionId='.$newApiSession->getSessionId().'&'.$this->flashVars;
  	}
  	
  }
}
