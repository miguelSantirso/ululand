<?php

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
		
		// Obtener la sesión de la api
		$c = new Criteria();
		$c->add(ApiSessionPeer::SESSION_ID, $this->getRequestParameter('apiSessionId'));
		$apiSession = ApiSessionPeer::doSelectOne($c);
		
		// Comprobar que la sesión exista.
		if(!$apiSession)
		{
			return null;
		}
		
		// retornamos el juego que inició la sesión con la api o null si no es un juego.
		return GamePeer::retrieveByApiKey($apiSession->getApiKey());
	}
	
	/**
	 * Retorna el avatar que est� ejecutando el juego.
	 *
	 * @return Avatar Avatar que est� ejecutando el juego
	 */
	protected function getActiveAvatar()
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
		return AvatarPeer::retrieveByApiKey($apiSession->getAvatarApiKey());
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

		$this->setFlash('responseData', $this->returnValue);
		$this->setFlash('responseType', $this->returnType);
		$this->forward('output', 'response');
	}

	/**
	 * Comprueba que se han pasado todos los par�metros indicados en el array $requiredParameters.
	 * Si falta alguno, lanza el error avisando de que falta ese par�metro.
	 *
	 * @param array $requiredParameters array con los strings que representan a cada par�metro.
	 */
	protected function checkRequiredParameters($requiredParameters)
	{
		foreach ($requiredParameters as $requiredParameter)
		{
			if ( is_null($this->getRequestParameter($requiredParameter)) )
			{
				$this->setFlash('api_error_code', 2);
				$this->setFlash('api_error_message', "ERROR: This API function requires '".$requiredParameter."' as a parameter.");

				$this->forward('output', 'error');
			}
		}
	}

	/**
	 * Comprueba si la operación está permitida para la sesión activa, teniendo en cuenta los 
	 * privilegios exigidos y el avatar al que hace referencia la operación.
	 *
	 * @param integer $requiredPrivileges Privilegios exigidos {0|1|2}
	 * @param integer $avatarApiKey ApiKey del avatar que se modificará en la operación. Si se da el valor '-1' a este parámetro, se interpretará que no se modifica ningún avatar 
	 */
	protected function breakIfNotAllowed($requiredPrivileges, $avatarApiKey)
	{
		// Si los privilegios exigidos son mayores que 2 retornamos ya que eso quiere decir que no hay restricciones de seguridad
		if($requiredPrivileges >= 2)
		{
			return;			
		}
			
		// Comprobar que se ha recibido la id de la sesión como parámetro
		$this->checkRequiredParameters( array('apiSessionId') );

		// Obtener la información de la sesión de la api
		$c = new Criteria();
		$c->add(ApiSessionPeer::SESSION_ID, $this->getRequestParameter('apiSessionId') );
		$apiSession = ApiSessionPeer::doSelectOne($c);
			
		// Comprobar que la sesión exista.
		if(!$apiSession)
		{
			$this->setFlash('api_error_code', 1);
			// Si no existe la sesión, lo más probable es que sea porque ha caducado
			$this->setFlash('api_error_message', "ERROR: Your api session has expired. Please, reload the page.");

			$this->forward('output', 'error');
		}

		// Tomar los privilegios de la sesión activa
		$sessionPrivileges = $apiSession->getPrivilegesLevel();

		// Comprobar que la sesión dispone de un nivel de privilegios superior o igual al exigido
		if($sessionPrivileges > $requiredPrivileges)
		{
			$this->setFlash('api_error_code', 0);
			$this->setFlash('api_error_message', "ERROR: Access denied. This operation requires a privileges level of ".$requiredPrivileges.". You have privileges level ".$apiSession->getPrivilegesLevel());

			$this->forward('output', 'error');
		}

		// Caso especial de privilegios de tipo 1
		// Hay que comprobar que el avatar al que se está accediendo sea el que inició la operación
		if($sessionPrivileges == 1)
		{
			if($avatarApiKey != -1 && $apiSession->getAvatarApiKey() != $avatarApiKey)
			{
				$this->setFlash('api_error_code', 0);
				$this->setFlash('api_error_message', "ERROR: Access denied. You don't have permission to modify that avatar.");

				$this->forward('output', 'error');
			}
		}
	}
}