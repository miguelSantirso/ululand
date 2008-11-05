<?php

/**
 * Validador que comprueba si un nombre de usuario está ya registrado en el sistema
 *
 * @package ululand
 */
class sfGuardUsernameTakenValidator extends sfValidator
{
	/**
	 * Inicializa el validador
	 *
	 */
	public function initialize($context, $parameters = null)
	{
		// initialize parent
		parent::initialize($context);
		$this->getParameterHolder()->add($parameters);
		return true;
	}
	
	/**
	 * Ejecuta el validador
	 * 
	 */
	public function execute(&$value, &$error)
	{
		$desiredUsername = $value;

		$c = new Criteria();
		$c->add(sfGuardUserPeer::USERNAME, $desiredUsername);

		$records = sfGuardUserPeer::doSelect($c);

		if(count($records) == 0){
			return true;
		}else{
			$error = $this->getParameter("msg");
			return false;
		}
	}
}