<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/frontendCommonActions.class.php';

/**
 * home actions.
 *
 * @package    PFC
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homeActions extends frontendCommonActions
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
  	if($this->authenticated)
  	{
  		$this->avatar = AvatarPeer::retrieveByPK($this->getUser()->getAttribute('avatarId'));

  		if(!$this->avatar)
  		{
  			$this->getUser()->signOut();
  			$this->redirect('home');
  		}
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
  * Acci�n que desconecta la cuenta activa.
  * Almacena en la sesi�n que el usuario ya no est� autentificado y borra las posibles cookies que se 
  * hubieran almacenado.
  *
  * @return void
  */
  public function executeLogout()
  {
  	// Llamamos a nuestro m�todo signOut, definido en frontend/lib/myUser.class.php 
  	$this->getUser()->signOut();
  	
    $this->setFlash('success', 'Sesi&oacute;n cerrada con &eacute;xito.');
    $this->redirect('home/Welcome');
  }

  /**
  * Acci�n que ejecuta el inicio de sesi�n.
  * Esta acci�n es la encargada tanto de mostrar el formulario de login como de procesarlo
  * @todo En caso de errores lleva de vuelta a home/Welcome. Lo m�s correcto ser�a que volviera a home/Login
  * 
  * @return void
  */  
  public function executeLogin()
  {
  		// Si el m�todo de la petici�n es GET, quiere decir que NO se deben procesar los datos del formulario de login
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			$this->sfContext = $this->getContext();
			
			// Si el usuario ya est� identificado
			if( $this->getUser()->isAuthenticated() )
			{
				// Guardar el mensaje en una variable de tipo flash
				$this->setFlash('warning', 'La sesi&oacute;n ya estaba iniciada.');
				// y redireccionar a la pantalla de bienvenida (que ya mostrar� el mensaje correctamente)
				$this->redirect('home/Welcome');
			}
			// Display the form
			return sfView::SUCCESS;
		}
		else // El m�todo es POST. Es necesario procesar la informaci�n del formulario.
		{
			// La comprobaci�n de los datos introducidos por el usuario se realiza en el validador.
			
			// Si se ha llegado hasta aqu� es que todo ha ido bien:
			$this->setFlash('success', 'Sesi&oacute;n iniciada con &eacute;xito.');
			
			$this->getUser()->setCulture("es");
			// Redirigir a la p�gina de la que se hab�a llegado.
			return $this->redirect($this->getRequestParameter('referer', '@homepage'));
		}
  }
  
  /**
   * Funci�n que se ocupa de gestionar los posibles errores de validaci�n del formulario de login.
   * Lo �nico que hace es redirigir a la p�gina de donde se ven�a para que el usuario pueda corregir
   * los errores que haya cometido al rellenar el formulario.
   * Adem�s, llama manualmente a la funci�n preExecute para preparar todo lo necesario para mostrar el layout
   *
   * @return void
   **/
  public function handleErrorLogin()
  {
  	$this->sfContext = $this->getContext();
  	$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
    $this->preExecute(); // Es necesario llamarlo a mano para que ejecute todo el c�digo previo 
    return sfView::SUCCESS;
  }
  	
  /**
  * Acci�n que ejecuta el registro de una nueva cuenta.
  * Esta acci�n es la encargada tanto de mostrar el formulario de registro como de procesarlo y crear la nueva cuenta.
  *
  * @return void
  */
  public function executeRegister()
  {
  	// Si el m�todo de la petici�n es POST, quiere decir que NO se deben procesar los datos del formulario de registro
	if ($this->getRequest()->getMethod() != sfRequest::POST)
	{
		$this->sfContext = $this->getContext();
		
		// Si el usuario est� identificado
		if( $this->getUser()->isAuthenticated() )
		{
			// Almacenamos, de forma temporal, el mensaje de error y redirigimos a la portada
			$this->setFlash('warning', 'Ya est&aacute;s registrado y con la sesi&oacute;n iniciada.');
			$this->redirect('home/Welcome');
		}
		
		//$this->warnings = "<strong>nibiru</strong> est&aacute; en fase Alfa.<br/>Esto quiere decir que solo lo podemos usar los que estamos implicados en el desarrollo de la aplicaci&oacute;n.<br/>El registro est&aacute; cerrado, lo sentimos.";
		
		// Display the form
		return sfView::SUCCESS;
	}
	else // el m�todo de la petici�n es GET. Es necesario procesar el formulario
	{
		// no hace falta comprobar errores porque eso ya se hace mediante los m�todos
		// validate autom�ticos. Ver validate\register.yml
		 
		// TODO HA IDO BIEN. CREAR LA CUENTA
		$this->accountEmail = $this->getRequestParameter('email');
		
		// Crear un nuevo objeto Account
		$this->newAccount = new Account();
		
		// Generar el salt y encriptamos todo
		$salt = $this->generateSalt();
		
		// Modificar adecuadamente el objeto
		$this->newAccount->setEmail($this->getRequestParameter('email'));
		$this->newAccount->setSalt($salt); // Es importante cargar el salt antes de llamar a setPassword
		$this->newAccount->setPassword( $this->getRequestParameter('password') );
		$this->newAccount->setSessionId(rand());
		
		// Grabarlo en la base de datos
		$this->newAccount->save();
		
		$this->newAvatar = new Avatar();
		$this->newAvatar->setName("Elige un nombre");
		$this->newAvatar->setAccount($this->newAccount);
		$this->newAvatar->save();

		$this->getUser()->signIn($this->newAccount);
		
		///////////////////////////////////////////
		$this->sendApprovalEmail($this->newAccount);
		///////////////////////////////////////////
		
    	$this->setFlash('success', 'Cuenta creada con &eacute;xito. Bienvenido a Ululand.<br/>Ahora debes personalizar tu aspecto en la tienda de ropa. <a href="/index.php">Pulsa aqu&iacute; cuando termines</a>.</p>');
		$this->redirect('home/EditAvatar');
	}
  }

  /**
   * Funci�n que se ocupa de gestionar los posibles errores de validaci�n del formulario de registro.
   * Lo �nico que hace es redirigir a la p�gina de donde se ven�a para que el usuario pueda corregir
   * los errores que haya cometido al rellenar el formulario.
   * Adem�s, inicializa las variables $authenticated y $level para su uso posterior en el layout.
   *
   * @return void
   **/
  public function handleErrorRegister()
  {
  	$this->sfContext = $this->getContext();
  	$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
    $this->preExecute(); // Es necesario llamarlo a mano para que ejecute todo el c�digo previo 
  	$this->authenticated = $this->getUser()->isAuthenticated(); 
  	$this->level = $this->getUser()->getAttribute("levelAccount");
    return sfView::SUCCESS;
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

  /**
  * Comprueba que {@email} tiene un formato correcto
  *	
  * @param string $email Email a comprobar
  * @return bool Cierto si el email tiene un formato v�lido. Falso en otro caso.
  */
  private function checkEmail($email)
  { 
    if( (preg_match('/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/', $email)) || 
      (preg_match('/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/',$email)) )
    { 
      return true;
    }
    return false;
  }

  /**
  * Funci�n privada que genera un salt aleatoriamente
  * La longitud del salt viene dada por la definici�n de configuraci�n 'app_saltlength' que viene especificada
  * en /apps/frontend/config/app.yml
  *
  * @return string Cadena aleatoria y �nica de longitud definida por app_saltlength
  */
  private function generateSalt()
  {
    return substr( md5(uniqid(rand(), true)), 0, sfConfig::get('app_saltlength') );
  }
  
  /**
  * Funci�n privada que encripta una cadena de texto aplic�ndole un salt. Se utiliza el algoritmo sha1
  *
  * @param string $plainText Cadena de texto que se desea encriptar
  * @param string $salt salt que se aplicar� al texto antes de encriptarlo.
  * @return string Cadena aleatoria y �nica de longitud definida por app_saltlength
  */
  private function generateHash($plainText, $salt)
  {
      return sha1($salt . $plainText);
  }

  protected function sendApprovalEmail($account)
  {
  	$this->getRequest()->setParameter('email', $account->getEmail());
  	$this->getRequest()->setParameter('approvalLink', $account->getApprovalUrl());
  	
  	$this->sendEmail('mail', 'sendEmailApprovalLink');
  }
}
