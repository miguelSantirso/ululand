<?php

/**
 * output actions.
 *
 * @package    PFC
 * @subpackage output
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class outputActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}

	/**
	 * Acci�n de error. Esta acci�n se ejecuta cuando ocurre un error en la api
	 *
	 */
	public function executeError()
	{
		$this->error_code    = $this->getFlash('api_error_code', 0);
		$this->error_message = $this->getFlash('api_error_message', "Unknown error");
		
		header('Content-Type: text/plain');
	}

	/**
	 * Retorna la respuesta cuando una funci�n de la API tiene �xito.
	 * Recibe la respuesta y el tipo de la misma a trav�s de las variables flash 'responseType' y 'responseData'
	 *
	 */
	public function executeResponse()
	{
		$this->contentType  = $this->getFlash('responseType', 'Content-Type: text/plain');
		$this->responseData = $this->getFlash('responseData');

		header($this->contentType);
		return sfView::SUCCESS;
	}
}
