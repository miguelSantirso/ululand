<?php

/**
 * widget components.
 *
 * @package    PFC
 * @subpackage widget
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
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
  	if($this->widget)
  	{
	    // Iniciar la sesión de la api
	    $newApiSession = ApiSessionPeer::createNew($this->widget->getApiKey(), 
	    				$this->getUser()->getAttribute("avatarApiKey"),
	    				$this->widget->getPrivilegesLevel());    // Iniciar la sesión de la api
	    
	    // Añadimos el apiSessionId al principio de los flashVars para pasárselo al objeto flash.
	    $this->flashVars = 'apiSessionId='.$newApiSession->getSessionId().'&'.$this->flashVars;
  	}
  	
  }
}
