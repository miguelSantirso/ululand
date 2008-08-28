<?php

class accountLoginValidator extends sfValidator
{
	public function initialize($context, $parameters = null)
	{
		// initialize parent
		parent::initialize($context);

		// set defaults
		$this->setParameter('login_error', 'Invalid input');

		$this->getParameterHolder()->add($parameters);

		return true;
	}

	/**
	 * Valida los datos introducidos en el formulario de login y, en caso de ser correctos, inicia la sesión del usuario
	 *
	 */
	public function execute(&$value, &$error)
	{
		// Obtener el resto de parámetros que necesitamos.
		$password_param = $this->getParameter('password');
		$password = $this->getContext()->getRequest()->getParameter($password_param);
		$rememberPassword = $this->getContext()->getRequest()->getParameter('recpassword[1]');

		$email = $value;
/*
		$c = new Criteria();
		$c->add(AccountPeer::EMAIL, $email);
		$account = AccountPeer::doSelectOne($c);
*/
		// Si existe la cuenta
		if($account = AccountPeer::getAuthenticatedAccount($email, $password))
		{
			$this->getContext()->getUser()->signIn($account, $rememberPassword);
			return true;
		}

		$error = $this->getParameter('login_error');
		return false;
	}
}
