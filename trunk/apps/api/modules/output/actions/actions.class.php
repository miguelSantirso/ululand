<?php
/**
 * Contiene la clase outputActions
 *
 * @package    ululand
 * @subpackage output
 */

/**
 * Acciones del módulo output en la aplicación API. Este módulo se encarga de responder a todas las peticiones a la API, después de que sean procesadas por el módulo receptor correspondiente.
 *
 * @package    ululand
 * @subpackage output
 * @author     <pncil.com>
 */
class outputActions extends sfActions
{

	/**
	 * Acción de error. Esta acción se ejecuta cuando la API retorna un error.
	 *
	 */
	public function executeError()
	{
		$this->error_code    = $this->getUser()->getFlash('api_error_code', 0);
		$this->error_message = $this->getUser()->getFlash('api_error_message', "Unknown error");
		
		header('Content-Type: text/plain');
	}

	/**
	 * Retorna la respuesta cuando una función de la API tiene éxito.
	 * Recibe la respuesta y el tipo de la misma a través de las variables flash 'responseType' y 'responseData'
	 *
	 */
	public function executeResponse()
	{
		$this->contentType  = $this->getUser()->getFlash('responseType', 'Content-Type: text/plain');
		$this->responseData = $this->getUser()->getFlash('responseData');

		header($this->contentType);
		return sfView::SUCCESS;
	}
}
