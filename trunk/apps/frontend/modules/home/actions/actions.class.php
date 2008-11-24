<?php


/**
 * home actions.
 *
 * @package    ululand
 * @subpackage home
 * @author     Pncil.com <http://pncil.com>
 */
class homeActions extends sfActions
{
	
  public function executeIndex()
  {
    return $this->forward('home', 'welcome');
  }

  /**
  * Acción que ejecuta la pantalla de bienvenida.
  *
  */ 
  public function executeWelcome()
  {
  }

  /**
   * Acción que se ejecuta cuando se intenta acceder a un módulo configurado como deshabilitado
   *
   */
  public function executeDisabled()
  {
  	
  }
  
}
