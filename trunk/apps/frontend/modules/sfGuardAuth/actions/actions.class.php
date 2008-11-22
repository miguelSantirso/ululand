<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 * Acciones de gestión de usuarios. Extiende a la clase correspondiente del plugin "sfGuardAuth"
 *
 * @package    ululand
 * @subpackage sfGuardAuth
 * @author     Pncil.com <http://pncil.com>
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
	/**
	 * Acción que extiende la acción signin del plugin "sfGuardAuth". Actualiza el idioma del interfaz del sistema cuando el usuario inicia sesión
	 *
	 */
	public function executeSignin()
	{	
		if($this->getUser()->isAuthenticated())
			$this->getUser()->setCulture($this->getUser()->getProfile()->getCulture());
			
		parent::executeSignin();
	}
	
	/**
	 * Habilita el registro de nuevos usuarios
	 *
	 */
	public function executeRegister()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// Si el usuario est� identificado
			if( $this->getUser()->isAuthenticated() )
			{
				$this->redirect('home/index');
			}

			// Display the form
			return sfView::SUCCESS;
		}
		else // el m�todo de la petici�n es GET. Es necesario procesar el formulario
		{
			// no hace falta comprobar errores porque eso ya se hace mediante los m�todos
			// validate autom�ticos. Ver validate\register.yml
				
			// TODO HA IDO BIEN. CREAR LA CUENTA
			$user = new sfGuardUser();
			$user->setUsername($this->getRequestParameter('username'));
			$user->setPassword($this->getRequestParameter('password'));
			$user->setIsActive(true);
			$user->save();
			
			
			
			// CREAR EL PERFIL DEL NUEVO USUARIO
			$profile = new sfGuardUserProfile();
			$profile->setUserId($user->getId());
			$languages = $this->getRequest()->getLanguages();
			$preferredLanguage = $languages[0];
			if($preferredLanguage == 'es' || $preferredLanguage == 'es_ES')
				$profile->setCulture('es');
			else
				$profile->setCulture('en');
			$profile->setUsername($this->getRequestParameter('screenname'));
			$profile->save();
			
			
			// CREAR EL AVATAR DEL NUEVO USUARIO
			$newAvatar = new Avatar();
			$newAvatar->setProfile($profile);
			$newAvatar->save();
			
			// Iniciar automaticamente la sesión para el usuario que se acaba de registrar
			$this->getContext()->getUser()->signIn($user, true);
			
			// test: crear usuario de foro
			
			
			// @todo mensaje no internacionalizado
			$this->setFlash('success', 'Registro completado con éxito');
			
			$this->redirect('@homepage');
		}
	}
	
	/**
	 * Maneja los posibles errores en el proceso de registro
	 *
	 */
	public function handleErrorRegister()
	{
		// @todo mensaje no internacionalizado
		$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
		return sfView::SUCCESS;
	}
}
