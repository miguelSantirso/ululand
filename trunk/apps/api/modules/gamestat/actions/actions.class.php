<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * avatar actions.
 *
 * @package    PFC
 * @subpackage gamestat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gamestatActions extends apiCommonActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
	}
	
	/**
	 * Retorna el valor de un gamestat para cierto avatar
	 * Requiere como parámetros:
	 *  - 'gameApiKey' -- ApiKey del juego del que se desea obtener un gamestat
	 *  - 'avatarApiKey' -- ApiKey del avatar del que se desea obtener un gamestat
	 *  - 'gamestatName' -- Nombre del gamestat que se desea obtener
	 * 
	 * Retorna un array con el siguiente formato:
	 *  array('gameName' => <Nombre del juego>,
	 *  'avatarName' => <nombre del avatar>,
	 *  'gamestatName' => <nombre del gamestat>,
	 *  'gamestatValue' => <valor del gamestat>)
	 * 
	 */
	public function executeGetValue()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("gameApiKey", "avatarApiKey", "gamestatName") );

		// Obtener el juego con la apikey recibida
		$game = GamePeer::retrieveByApiKey($this->getRequestParameter('gameApiKey'));

		// Comprobar que existe el juego
		if(!$game)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'gameApiKey'. There is not a game whose apikey is ".$this->getRequestParameter('gameApiKey'));
			$this->forward('output', 'error');
		}
		
		// Obtener el avatar con la apikey recibida
		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));

		// Comprobar que el avatar existe
		if(!$avatar)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'avatarApiKey'. There is not an avatar whose apikey is ".$this->getRequestParameter('avatarApiKey'));
			$this->forward('output', 'error');
		}

		// Obtener el gamestat del juego indicado y con el nombre recibido
		$c = new Criteria();
		$c->add(GameStatPeer::NAME, $this->getRequestParameter('gamestatName'));
		$c->add(GameStatPeer::GAME_ID, $game->getId());
		$gamestat = GameStatPeer::doSelectOne($c);
		
		// Comprobar que el gamestat existe
		if(!$gamestat)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'gamestatName'. ".$game->getName()." does not have a gamestat called ".$this->getRequestParameter('gamestatName') );
			$this->forward('output', 'error');
		}

		// Finalmente, obtener el valor del gamestat para el avatar indicado
		$c = new Criteria();
		$c->add(GameStat_AvatarPeer::AVATAR_ID, $avatar->getId());
		$c->add(GameStat_AvatarPeer::GAMESTAT_ID, $gamestat->getId());
		$result = GameStat_AvatarPeer::doSelectOne($c);

		$this->returnApi( array(
					'gameName' => $game->getName(),
					'avatarName' => $avatar->getName(),
					'gamestatName' => $gamestat->getName(),
					'gamestatValue' => $result ? $result->getValue() : 0 )); // Retornamos cero si el avatar no tiene ningún gamestat
	}


	/**
	 * Modifica, o añade, el valor de un gamestat para cierto avatar
	 * Requiere como parámetros:
	 *  - 'avatarApiKey' -- ApiKey del avatar que ha obtenido un nuevo gamestat
	 *  - 'gamestatName' -- Nombre del gamestat a modificar
	 *  - 'value' -- Valor que se dará al gamestat para el avatar indicado
	 *
	 */
	public function executeSetValue()
	{
		// Comprobar que se han recibido los parámetros requeridos
		$this->checkRequiredParameters( array('gamestatName', 'value') );
		
		if($this->getRequestParameter('avatarApiKey'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		}
		else
		{
			$avatar = $this->getActiveAvatar();
		}
		
		// Comprobar que el avatar existe
		if(!$avatar)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'avatarApiKey'. There is not an avatar whose apikey is ".$this->getRequestParameter('avatarApiKey'));
			$this->forward('output', 'error');
		}
		
		// Comprobar que se dispone de suficientes privilegios como para realizar la operación
		$this->breakIfNotAllowed(1, $avatar->getApiKey());
		
		// Obtenemos el juego que inició la petición
		$game = $this->getActiveGame();
		
		if(!$game)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'apiSessionId'. This session was not started by a game, and that is required by this function.");
			$this->forward('output', 'error');
		}
		
		// Obtenemos el gamestat al que se va a añadir o modificar un valor
		$c = new Criteria();
		$c->add(GameStatPeer::GAME_ID, $game->getId());
		$c->add(GameStatPeer::NAME, $this->getRequestParameter('gamestatName'));
		$gamestat = GameStatPeer::doSelectOne($c);
		
		// Comprobar que el gamestat existe
		if(!$gamestat)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'gamestatName'. ".$game->getName()." does not have a gamestat called ".$this->getRequestParameter('gamestatName') );
			$this->forward('output', 'error');
		}
		
		// Finalmente, enviamos el nuevo valor
		$gamestat->setValueForAvatar($avatar->getId(), $this->getRequestParameter('value'));
		
		$this->setFlash('responseData', "GameStat ".$gamestat->getName()." of game ".$game->getName()." has been processed for avatar ".$avatar->getName());
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
}
