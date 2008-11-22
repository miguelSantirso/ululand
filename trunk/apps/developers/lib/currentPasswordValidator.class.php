<?php

class currentPasswordValidator extends sfValidator
{
	public function initialize($context, $parameters = null)
	{
		// initialize parent
		parent::initialize($context);

		// set defaults
		$this->setParameter('password_error', ulToolkit::__('Wrong Password'));

		$this->getParameterHolder()->add($parameters);

		return true;
	}

	/**
	 * Valida los datos introducidos en el formulario de login y, en caso de ser correctos, inicia la sesi�n del usuario
	 *
	 */
	public function execute(&$value, &$error)
	{
		// Obtener los parámetros que necesitamos.
		$current_password = $value;
		
		$error = $this->getParameter('password_error');

		return $this->getContext()->getUser()->checkPassword($current_password);
	}
}
