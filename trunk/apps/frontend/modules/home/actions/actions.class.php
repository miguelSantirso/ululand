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
  
  /**
   * Acción que se ejecuta inmediatamente despu�s de validar el correo electr�nico
   *
   */
  public function executeEmailApproved()
  {
  	$this->getUser()->getAttributeHolder()->remove('remainingDaysToApproveEmail');
  	$this->setFlash('warning', '');
  	$this->setFlash('success', 'Tu email ha sido validado correctamente. Muchas gracias ;)');
  	
  	$this->redirect('@homepage');
  }
  
  /**
   * Pantalla que muestra las explicaciones de como validar el email
   *
   */
  public function executeApproveEmail()
  {
  	if($this->getUser()->isAuthenticated())
  	{
  		$this->userEmail = $this->getUser()->getAttribute('email');
  	}
  	else
  	{
  		$this->userEmail = $this->getRequest()->getParameter('userEmail');
  	}
  	return sfView::SUCCESS;
  }
  
  
  /**
   * Acción que reenvía el email de aprobación y muestra el aviso del resultado
   *
   */
  public function executeResendApprovalEmail()
  {
  	$this->userEmail = $this->getRequest()->getParameter('userEmail');
  	$userAccount = AccountPeer::retrieveByUsername($this->userEmail);
  	if($userAccount && !$userAccount->getIsApproved())
  	{
  		$this->sendApprovalEmail($userAccount);
  	}
  	else
  	{
  		if($userAccount)
  		{
  			$this->errorMessage = "Tu cuenta ya est&aacute; aprobada. No necesitas que te reenviemos el correo de confirmaci&oacute;n";
  		}
  		else
  		{
  			$this->errorMessage = "El correo electr&oacute;nico al que se intenta enviar el email no est&aacute; registrado en <strong>ulu</strong>land"; 
  		}
  		return sfView::ERROR;
  	}
  }


  protected function sendApprovalEmail($account)
  {
  	$this->getRequest()->setParameter('email', $account->getEmail());
  	$this->getRequest()->setParameter('approvalLink', $account->getApprovalUrl());
  	
  	$this->sendEmail('mail', 'sendEmailApprovalLink');
  }
}
