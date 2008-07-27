<?php


/**
 * home actions.
 *
 * @package    PFC
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homeActions extends sfActions
{

  /**
  * Acci�n que ejecuta la pantalla de bienvenida.
  * �nicamente se ocupa de obtener los posibles errores que hayan aparecido al rellenar el formulario y
  * los almacena en dos variables para su posterior uso en el layout
  *
  * @return void
  */ 
  public function executeWelcome()
  {
  	if($this->getUser()->isAuthenticated())
  	{
  		$this->avatar = AvatarPeer::retrieveByPK($this->getUser()->getAttribute('avatarId'));

  		/*if(!$this->avatar)
  		{
  			$this->getUser()->signOut();
  			$this->redirect('home');
  		}*/
  	}
  }

  /**
   * Acci�n que se ejecuta inmediatamente despu�s de validar el correo electr�nico
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
   * @return unknown
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
   * Acci�n que reenv�a el email de aprobaci�n y muestra el aviso del resultado
   *
   * @return unknown
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

  
  /**
  * Acci�n que carga y muestra el editor de avatares
  *
  * @return void
  */
  public function executeEditAvatar()
  {
  	$this->avatarApiKey = $this->getUser()->getAttribute("avatarApiKey");
  }

  protected function sendApprovalEmail($account)
  {
  	$this->getRequest()->setParameter('email', $account->getEmail());
  	$this->getRequest()->setParameter('approvalLink', $account->getApprovalUrl());
  	
  	$this->sendEmail('mail', 'sendEmailApprovalLink');
  }
}
