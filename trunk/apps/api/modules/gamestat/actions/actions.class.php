<?php
/**
 * Contiene la clase gamestatActions
 *
 * @package    ululand
 * @subpackage gamestat
 */

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * Acciones del módulo gamestat en la aplicación API. Contiene las acciones de la api que se refieren a información de las piezas de avatar
 *
 * @package    ululand
 * @subpackage gamestat
 * @author     <pncil.com>
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
	 *  - 'gameUuid' -- Uuid del juego del que se desea obtener un gamestat
	 *  - 'userUuid' -- Uuid del usuario del que se desea obtener un gamestat
	 *  - 'gamestatName' -- Nombre del gamestat que se desea obtener
	 * 
	 * Retorna un array con el siguiente formato:
	 *  array('gameName' => <Nombre del juego>,
	 *  'username' => <nombre del usuario>,
	 *  'gamestatName' => <nombre del gamestat>,
	 *  'gamestatValue' => <valor del gamestat>)
	 * 
	 */
	public function executeGetValue()
	{
		// Comprobar que se nos han pasado todos los parámetros necesarios
		$this->checkRequiredParameters( array("gameUuid", "userUuid", "gamestatName") );

		// Obtener el juego con la uuid recibida
		$game = GamePeer::retrieveByUuid($this->getRequestParameter('gameUuid'));

		// Comprobar que existe el juego
		if(!$game)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'gameUuid'. There is not a game whose uuid is ".$this->getRequestParameter('gameUuid'));
			$this->forward('output', 'error');
		}
		
		// Obtener el usuario con la uuid recibida
		$user = sfGuardUserProfile::retrieveByUuid($this->getRequestParameter('userUuid'));

		// Comprobar que el usuario existe
		if(!$user)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'userUuid'. There is not a user whose uuid is ".$this->getRequestParameter('userUuid'));
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
		$result = $gamestat->getBestValueForPlayer($user->getPlayerProfile());

		$this->returnApi( array(
					'gameName' => $game->getName(),
					'username' => $user->getUsername(),
					'gamestatName' => $gamestat->getName(),
					'gamestatValue' => $result ? $result->getValue() : 0 )); // Retornamos cero si el avatar no tiene ningún gamestat
	}

	/**
	 * Añade un valor de un gamestat desde un juego que implementa la API de mochiads
	 *
	 */
	public function executeSetValueFromMochiads()
	{
		// Comprobar que mochiads nos envía todos los parámetros que necesitamos
		$this->checkRequiredParameters( array('userID', 'sessionID', 'boardID', 'score', 'title') );
		
		$apiKey = $this->getRequestParameter('sessionID');
		$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userID'));

		// Comprobar que el avatar existe
		if(!$user)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'userID'. There is not a user whose uuid is ".$this->getRequestParameter('userID'));
			$this->forward('output', 'error');
		}
		
		// Comprobar que se dispone de suficientes privilegios como para realizar la operación
		$this->breakIfNotAllowed(1, $user->getUuid(), $apiKey);
		
		// Obtenemos el juego que inició la petición
		$game = $this->getGameForApiKey($apiKey);
		
		if(!$game)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'apiSessionId'. This session was not started by a game, and that is required to use this function.");
			$this->forward('output', 'error');
		}
		
		// Comprobamos si ya se ha creado el gamestat. Si no, lo creamos
		$c = new Criteria();
		$c->add(GameStatPeer::GAME_ID, $game->getId());
		$c->add(GameStatPeer::STRIPPED_NAME, ulToolkit::stripText($this->getRequestParameter('title')));
		$gamestat = GameStatPeer::doSelectOne($c);
		
		// Es necesario crear el gamestat por primera vez
		if(!$gamestat)
		{	
			$gamestat = new GameStat();
			$gamestat->setUuid($this->getRequestParameter('boardID'));
			$gamestat->setName($this->getRequestParameter('title'));
			$gamestat->setDescription($this->getRequestParameter('description'));
			$gamestat->setScoreLabel($this->getRequestParameter('scoreLabel'));
			$gamestat->setGameStatType($this->getRequestParameter('sortOrder') == 'asc' ? GameStatPeer::MIN_GAMESTATTYPE : GameStatPeer::MAX_GAMESTATTYPE);
			$gamestat->setGame($game);
			
			$gamestat->save();
		}
		
		// Finalmente, enviamos el nuevo valor
		$gamestat->addGameStatValueForPlayer($this->getRequestParameter('score'), $user->getPlayerProfile()->getId());
		
		$this->setFlash('responseData', "GameStat ".$gamestat->getName()." of game ".$game->getName()." has been processed for user ".$user->getUsername());
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
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
		
		if($this->getRequestParameter('userUuid'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		}
		else
		{
			$user = $this->getActiveUser();
		}
		
		// Comprobar que el usuario existe
		if(!$user)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'userUuid'. There is not a user whose uuid is ".$this->getRequestParameter('userUuid'));
			$this->forward('output', 'error');
		}
		
		// Comprobar que se dispone de suficientes privilegios como para realizar la operación
		$this->breakIfNotAllowed(1, $user->getUuid());
		
		// Obtenemos el juego que inició la petición
		$game = $this->getActiveGame();
		
		if(!$game)
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'apiSessionId'. This session was not started by a game, and that is required to use this function.");
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
		$gamestat->addGameStatValueForPlayer($this->getRequestParameter('value'), $user->getPlayerProfile()->getId());
		
		$this->setFlash('responseData', "GameStat ".$gamestat->getName()." of game ".$game->getName()." has been processed for user ".$user->getUsername());
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
}
