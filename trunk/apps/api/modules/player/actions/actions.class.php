<?php
/**
 * Contiene la clase playerActions
 *
 * @package    ululand
 * @subpackage player
 */

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * Acciones del módulo player en la aplicación API. Contiene las acciones de la api que se refieren a información de los jugadores
 *
 * @package    ululand
 * @subpackage player
 * @author     Pncil.com <http://pncil.com>
 */
class playerActions extends apiCommonActions
{
	/**
	 * Retorna el usuario indicado
	 * Requiere como parámetro 'userUuid' que indica el uuid del usuario
	 *
	 */
	public function executeGet()
	{
		// Comprobar que se nos han pasado todos los parámetros necesarios
		$this->checkRequiredParameters( array("userUuid") );
		
		// Obtener el perfil de usuario y el de jugador
		$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		$player = $user->getPlayerProfile(true);
		
		$response = array('userUuid'     => $user->getUuid(),
						  'username'     => $user->getUsername(),
						  'description'  => $player->getDescription(),
						  'totalCredits' => $player->getTotalCredits(),
						  'spentCredits' => $player->getSpentCredits());
		
		$this->returnApi($response, $this->apiType);
	}
	
	/**
	 * Retorna los créditos disponibles del jugador
	 * Requiere como parámetro 'userUuid'
	 *
	 */
	public function executeGetAvailableCredits()
	{
		// Comprobar que se nos han pasado todos los parámetros necesarios
		$this->checkRequiredParameters( array("userUuid") );

		$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		$player = $user->getPlayerProfile(true);

		$this->returnApi(array("userUuid" => $user->getUuid(), "availableCredits" => $player->getAvailableCredits()), $this->apiType);
	}
	
	
	/* *
	 * Suma cierta cantidad de créditos al avatar indicado.
	 * Requiere como parámetros:
	 *  - 'avatarId' que indica el id del avatar
	 *  - 'amount' cantidad de créditos a añadir
	 *
	 */
	/*
	public function executeAddCredits()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey", "amount") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('avatarApiKey'));

		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		
		$avatar->addCredits($this->getRequestParameter('amount'));
		
		$this->getUser()->setFlash('responseData', "Se han añadido " .  $amount . " créditos al avatar " . $avatar);
		$this->getUser()->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
	*/
	
	/**
	 * Resta cierta cantidad de créditos al jugador indicado.
	 * Requiere como parámetros:
	 *  - 'userUuid' que indica el uuid del avatar
	 *  - 'amount' cantidad de créditos a restar
	 *
	 */
	public function executeSubstractCredits()
	{
		// Comprobar que se nos han pasado todos los parámetros necesarios
		$this->checkRequiredParameters( array("userUuid", "amount") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('userUuid'));

		$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		$player = $user->getPlayerProfile(true);
		
		$player->substractCredits($this->getRequestParameter('amount'));		
		
		$this->getUser()->setFlash('responseData', "Se han restado " .  $this->getRequestParameter('amount') . " créditos al jugador " . $player);
		$this->getUser()->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
}
