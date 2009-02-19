<?php
/**
 * Contiene la clase apiCommonActions 
 * 
 * @package ululand
 */

/**
 * Acciones comunes para toda la aplicación api
 * 
 * @package ululand
 * @author <pncil.com>
 *
 */
class apiCommonActions extends sfActions
{
	/**
	 * Retorna el juego que ha realizado la petición a la api.
	 * Si la llamada a la api no se originó en un juego, retorna null
	 *
	 * @return Game Juego que inició la petición a la api. null si la petición no la inició un juego
	 */
	protected function getActiveGame()
	{
		// Comprobar que se ha recibido la id de la sesión como parámetro
		$this->checkRequiredParameters( array('apiSessionId') );
		
		$this->getGameForApiKey($this->getRequestParameter('apiSessionId'));
	}
	
	/**
	 * Retorna el juego asociado a cierta apiKey
	 *
	 * @param string $apiKey clave única que identifica una sesión con la api
	 */
	protected function getGameForApiKey($apiKey)
	{	
		// Obtener la sesión de la api
		$c = new Criteria();
		$c->add(ApiSessionPeer::SESSION_ID, $apiKey);
		$apiSession = ApiSessionPeer::doSelectOne($c);
		
		// Comprobar que la sesión exista.
		if(!$apiSession)
		{
			return null;
		}
		
		// retornamos el juego que inició la sesión con la api o null si no es un juego.
		return GamePeer::retrieveByUuid($apiSession->getClientUuid());
	}

	/**
	 * Retorna el usuario que está ejecutando el juego.
	 *
	 * @return sfGuardUserProfile Usuario que está ejecutando el juego
	 */
	protected function getActiveUser()
	{
		// Comprobar que se ha recibido la id de la sesión como parámetro
		$this->checkRequiredParameters( array('apiSessionId') );
		
		// Obtener la sesión de la api
		$c = new Criteria();
		$c->add(ApiSessionPeer::SESSION_ID, $this->getRequestParameter('apiSessionId'));
		$apiSession = ApiSessionPeer::doSelectOne($c);
		
		// Comprobar que la sesión exista.
		if(!$apiSession)
		{
			return null;
		}

		// retornamos el avatar que inició la sesión con la api.
		return sfGuardUserProfilePeer::retrieveByUuid($apiSession->getUserUuid());
	}	
	
	/**
	 * returnApi - take data and do magic to return data as an API
	 *
	 * @return string
	 * @author Mark Ng
	 **/
	protected function returnApi($data)
	{
		$apiType = $this->getRequestParameter('apiType', 'json');
		
		// do some magic with the data here
		$outputData = null;
		if ($data instanceof BaseObject)
		{
			$outputData = $data->toArray();
		}
		elseif(is_array($data))
		{
			/*$outputData = array();
			 foreach ($data as $key => $object)
			 {
				if ($object instanceof BaseObject)
				{
				$outputData[] = $object->toArray();
				}
				}*/
			$outputData = $data;
		}
		elseif($data instanceof sfPropelPager)
		{
			foreach ($data->getResults() as $key => $object)
			{
				if ($object instanceof BaseObject)
				{
					$outputData[] = $object->toArray();
				}
			}
		}
		else
		{
			throw new Exception('unable to translate data to API');
		}

		switch ($apiType)
		{
			case 'json':
				// do json encoding and return here
				$this->returnType  = 'Content-Type: application/json';
				$this->returnValue = json_encode($outputData);
				break;

			case 'rest':
				// return a 404
				$this->forward404();
				break;

			case 'yaml':
				// do yaml encoding and return here
				$yaml = new sfYaml();
				$this->returnType = 'Content-Type: text/yaml';
				$this->returnValue = $yaml->dump($outputData);
				break;

			default:
				// return a 404
				$this->forward404();
				break;
		}

		$this->getUser()->setFlash('responseData', $this->returnValue);
		$this->getUser()->setFlash('responseType', $this->returnType);
		$this->forward('output', 'response');
	}

	/**
	 * Comprueba que se han pasado todos los parámetros indicados en el array $requiredParameters.
	 * Si falta alguno, lanza el error avisando de que falta ese parámetro.
	 *
	 * @param array $requiredParameters array con los strings que representan a cada parámetro.
	 */
	protected function checkRequiredParameters($requiredParameters)
	{
		foreach ($requiredParameters as $requiredParameter)
		{
			if ( is_null($this->getRequestParameter($requiredParameter)) )
			{
				$this->getUser()->setFlash('api_error_code', 2);
				$errorMessage = "ERROR: This API function requires '".$requiredParameter."' as a parameter.";
				$this->getUser()->setFlash('api_error_message', $errorMessage);
				$this->logMessage($errorMessage, "err");
				$this->forward('output', 'error');
			}
		}
	}

	/**
	 * Comprueba si la operación está permitida para la sesión activa, teniendo en cuenta los 
	 * privilegios exigidos y el avatar al que hace referencia la operación.
	 *
	 * @param integer $requiredPrivileges Privilegios exigidos {0|1|2}
	 * @param string $userUuid Uuid del usuario que se modificará en la operación. Si se da el valor '-1' a este parámetro, se interpretará que no se modifica ningún usuario
	 * @param string $apiSessionId Opcional. apiKey de la operación con la api. 
	 */
	protected function breakIfNotAllowed($requiredPrivileges, $userUuid, $apiSessionId = null)
	{
		// Si los privilegios exigidos son mayores que 2 retornamos ya que eso quiere decir que no hay restricciones de seguridad
		if($requiredPrivileges >= 2)
		{
			return;			
		}
		
		// Si no se ha pasado una apiKey como parámetro, se buscará automáticamente
		if(is_null($apiSessionId))
		{
			// Comprobar que se ha recibido la id de la sesión como parámetro
			$this->checkRequiredParameters( array('apiSessionId') );
			
			$apiSessionId = $this->getRequestParameter('apiSessionId');
		}
		
		// Obtener la información de la sesión de la api
		$c = new Criteria();
		$c->add(ApiSessionPeer::SESSION_ID, $apiSessionId);
		$apiSession = ApiSessionPeer::doSelectOne($c);
			
		// Comprobar que la sesión exista.
		if(!$apiSession)
		{
			$this->getUser()->setFlash('api_error_code', 1);
			// Si no existe la sesión, lo más probable es que sea porque ha caducado
			$this->getUser()->setFlash('api_error_message', "ERROR: Your api session has expired. Please, reload the page.");

			$this->forward('output', 'error');
		}

		// Tomar los privilegios de la sesión activa
		$sessionPrivileges = $apiSession->getPrivilegesLevel();

		// Comprobar que la sesión dispone de un nivel de privilegios superior o igual al exigido
		if($sessionPrivileges > $requiredPrivileges)
		{
			$this->getUser()->setFlash('api_error_code', 0);
			$this->getUser()->setFlash('api_error_message', "ERROR: Access denied. This operation requires a privileges level of ".$requiredPrivileges.". You have privileges level ".$apiSession->getPrivilegesLevel());

			$this->forward('output', 'error');
		}

		// Caso especial de privilegios de tipo 1
		// Hay que comprobar que el usuario al que se está accediendo sea el que inició la operación
		if($sessionPrivileges == 1)
		{
			if($userUuid != -1 && $apiSession->getUserUuid() != $userUuid)
			{
				$this->getUser()->setFlash('api_error_code', 0);
				$this->getUser()->setFlash('api_error_message', "ERROR: Access denied. You don't have permission to modify that user.");

				$this->forward('output', 'error');
			}
		}
	}
}