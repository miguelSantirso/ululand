<?php

class frontendCommonActions extends sfActions
{
  /**
   * preExecute: Funci�n que se ejecuta justo antes de la ejecuci�n de cualquier otra acci�n.
   * Realiza las operaciones necesarias para el correcto funcionamiento del sistema de autentificaci�n autom�tica.
   * Adem�s, inicializa las variables $authenticated, $level y $username para su uso posterior en el layout.
   *
   * @return void
   **/
  public function preExecute()
  {
	$this->checkIfEmailIsApproved();
  		
  	$this->getResponse()->addJavaScript('/sf/prototype/js/prototype');

    $this->formErrors = $this->getFlash('error', null);
    $this->warnings = $this->getFlash('warning', null);
    $this->successes = $this->getFlash('success', null);
    $this->authenticated = $this->getUser()->isAuthenticated();
    if(!$this->authenticated)
    {
    	// Leemos las cookies
	    $this->mailcookie = $this->getRequest()->getCookie('accountEmail');
		$this->sessioncookie = $this->getRequest()->getCookie('sessionId');
	    
	    $c = new Criteria();
		$c->add( AccountPeer::EMAIL, $this->mailcookie);
		$account = AccountPeer::doSelectOne( $c );
			
		// Comprobar que la cuenta existe
		if( $account )
		{
			// Comprobar que la session y el mail se corresponden
			$realsession = $account->getSessionId();
			if( $this->sessioncookie == $realsession )
			{
				$this->getUser()->signIn($account, true);
				$this->authenticated = true;
			}
		}
    }
    $this->level = $this->getUser()->getAttribute("levelAccount");
    $this->username = $this->getUser()->getAttribute("email");
  }
  
  public function checkIfEmailIsApproved()
  {
    if( !is_null($this->getUser()->getAttribute('remainingDaysToApproveEmail')) )
  	{
  		$remainingDays = $this->getUser()->getAttribute('remainingDaysToApproveEmail');
  		if($remainingDays > 0)
  		{
  			$this->setFlash('warning', 'No has validado tu email a&uacute;n. Te quedan '.$remainingDays.' d&iacute;as para <a href="/index.php/home/ApproveEmail.html">validarlo</a>.');
  		}
  		else
  		{
  			$this->setFlash('warning', 'Debes <a href="/index.php/home/ApproveEmail.html">validar</a> tu email para entrar.');
  			$userEmail = $this->getUser()->getAttribute('email');
  			$this->getUser()->getAttributeHolder()->clear();
  			$this->redirect('home/ApproveEmail?userEmail='.$userEmail);
  		}
  	}
  }
  
  
}