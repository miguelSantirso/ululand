<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones básicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * avatar actions.
 *
 * @package    PFC
 * @subpackage avatar
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class avatarActions extends apiCommonActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
	}

	/**
	 * Retorna el avatar indicado
	 * Requiere como par�metro 'avatarId' que indica el id del avatar
	 *
	 */
	public function executeGet()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey") );
		
		// Obtener el avatar
		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		$this->returnApi($avatar, $this->apiType);
	}

	/**
	 * Modifica el nombre del avatar indicado
	 * Requiere como par�metros:
	 * 'avatarId' que indica el id del avatar y
	 * 'avatarName' que indica el nuevo nombre que se le dar� al avatar
	 * 
	 * Requiere nivel de acceso 1 como mínimo (acceso al avatar activo)
	 *
	 */
	public function executeSetName()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey", "avatarName") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('avatarApiKey'));
		
		// Obtener el avatar
		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		
		// Modificamos el nombre
		// TODO: Aqu� seguramente se deber�a validar el nombre para comprobar que no es nada raro
		$avatar->setName($this->getRequestParameter('avatarName'));
		$avatar->save();

		$this->setFlash('responseData', "Name changed to ".$avatar->getName()." for avatar whose id is ".$avatar->getId());
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
	
	/**
	 * Modifica el sexo del avatar indicado
	 * Requiere como par�metros:
	 * 'avatarId' que indica el id del avatar y
	 * 'avatarGender' que indica el nuevo sexo que se le dar� al avatar
	 * 
	 * Requiere nivel de acceso 1 como mínimo (acceso al avatar activo)
	 * 
	 */
	public function executeSetGender()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey", "avatarGender") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('avatarApiKey'));
		
		// Obtener el avatar
		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));

		// Modificamos el género
		$newGender = strtolower($this->getRequestParameter('avatarGender'));
		if($newGender == 'male' || $newGender == 'female')
		{
			$avatar->setGender( $newGender );
			$avatar->save();

			$this->setFlash('responseData', "Gender changed to ".$avatar->getGender()." for avatar whose id is ".$avatar->getId());
			$this->setFlash('responseType', "Content-Type: plain/text");
			$this->forward('output', 'response');
		}
		else
		{
			$this->setFlash('api_error_code', 3);
			$this->setFlash('api_error_message', "Unexpected value for 'avatarGender'. You passed ".$newGender." and the only possible vaules are 'male' or 'female'.");

			$this->forward('output', 'error');
		}
	}
	
	/**
	 * Retorna toda la información acerca de los ítems pertenecientes a un avatar indicado.
	 * Requiere como parámetro 'avatarId' que indica el id del avatar
	 * Opcionalmente puede recibir el parámetro 'filterActive', que hará que la función retorne únicamente los items en uso.
	 *
	 */
	public function executeGetItems()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey") );

		$i = 0;
		// Obtener los datos de la base de datos
		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		$avatarItems = $avatar->getAvatar_ItemsJoinItem();

		$filterActive = $this->getRequestParameter('filterActive');
		foreach($avatarItems as $avatarItem)
		{
			if(!($filterActive=="true") || $avatarItem->getActive())
			{
				$item = $avatarItem->getItem();

				$result[$i]["Id"] = $item->getId();
				$result[$i]["Name"] = $item->getName();
				$result[$i]["Description"] = $item->getDescription();
				$result[$i]["Url"] = $item->getImageHref();
				$result[$i]["Type"] = $item->getItemType()->getName();
				$result[$i]["Active"] = $avatarItem->getActive();

				$i++;
			}
		}

		$finalResult["avatarApiKey"] = $this->getRequestParameter('avatarApiKey');
		if($i > 0)
		$finalResult["avatarItems"] = $result;
		else
		$finalResult["avatarItems"] = Array();

		$this->returnApi($finalResult, $this->apiType);
	}
	
	/**
	 * Añade o modifica un ítem del avatar indicado
	 * Requiere como parámetros:
	 *  - 'avatarApiKey' que indica el apikey del avatar
	 *  - 'itemId' que indica el id del ítem
	 * Admite como parámetros:
	 *  - 'active' (opcional, falso por defecto) indica si el ítem se debe añadir como activo. IMPORTANTE: En este caso, se desactivará, si lo hay, el �tem activo de la categor�a que sea.
	 *
	 */
	public function executeSetItem()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey", "itemId") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('avatarApiKey'));
		
		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		$avatarId = $avatar->getId();
		$itemId   = $this->getRequestParameter('itemId');
		$active = ($this->getRequestParameter('active') ? $active = $this->getRequestParameter('active') : false);

		// Lo primero, a�adir el objeto en caso de que el avatar no lo tenga todav�a.
		$c = new Criteria();
		$c->add(Avatar_ItemPeer::ID_AVATAR, $avatarId);
		$c->add(Avatar_ItemPeer::ID_ITEM, $itemId);
		$auxItem = Avatar_ItemPeer::doSelectOne($c);
		if(!$auxItem) // El avatar a�n no tiene este objeto, hay que a�adirlo
		{
			$auxItem = new Avatar_Item();
			$auxItem->setIdAvatar($avatarId);
			$auxItem->setIdItem($itemId);
			$auxItem->setActive(false);
			$auxItem->save();
		}

		if($active)
		{
			// Obtener toda la informaci�n del objeto a a�adir
			$c = new Criteria();
			$c->add(ItemPeer::ID, $itemId);
			$item = ItemPeer::doSelectOne($c);

			// Comprobar si existe alg�n �tem activo del mismo tipo (para desactivarlo si hace falta)
			$c = new Criteria();
			$c->addJoin(Avatar_ItemPeer::ID_ITEM, ItemPeer::ID);
			$c->addJoin(ItemPeer::ID_ITEMTYPE, ItemTypePeer::ID);
			$c->add(Avatar_ItemPeer::ID_AVATAR, $avatarId);
			$c->add(Avatar_ItemPeer::ACTIVE, true);
			$c->add(ItemTypePeer::ID, $item->getIdItemType());
			$currentActiveItem = Avatar_ItemPeer::doSelectOne($c);

			if($currentActiveItem != $auxItem) // Si existe, se desactiva
			{
				if($currentActiveItem)
				{
					$currentActiveItem->setActive(false);
					$currentActiveItem->save();
				}

				// Finalmente, activamos el nuevo �tem
				$auxItem->setActive(true);
				$auxItem->save();
			}
		}

		$this->setFlash('responseData', "Item ".$auxItem->getItem()->getName()." added".($auxItem->getActive() ? " and activated ":" ")."for avatar whose name is ".$avatar->getName());
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
	
	/**
	 * Retorna los créditos disponibles del avatar
	 * Requiere como parámetro 'avatarApiKey'
	 *
	 */
	public function executeGetAvailableCredits()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey") );

		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));

		$this->returnApi(array("avatarApiKey" => $avatar->getApiKey(), "avatarAvailableCredits" => $avatar->getAvailableCredits()), $this->apiType);
	}

	/**
	 * Suma cierta cantidad de créditos al avatar indicado.
	 * Requiere como parámetros:
	 *  - 'avatarId' que indica el id del avatar
	 *  - 'amount' cantidad de créditos a añadir
	 *
	 */
	public function executeAddCredits()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey", "amount") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('avatarApiKey'));

		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		
		$avatar->addCredits($this->getRequestParameter('amount'));
		
		$this->setFlash('responseData', "Se han añadido " .  $amount . " créditos al avatar " . $avatar);
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}

	/**
	 * Resta cierta cantidad de créditos al avatar indicado.
	 * Requiere como parámetros:
	 *  - 'avatarApiKey' que indica el Api Key del avatar
	 *  - 'amount' cantidad de créditos a restar
	 *
	 */
	public function executeSubstractCredits()
	{
		// Comprobar que se nos han pasado todos los par�metros necesarios
		$this->checkRequiredParameters( array("avatarApiKey", "amount") );

		// Exigimos un mínimo de privilegios 1 para modificar la información del avatar pasado como parámetro.
		$this->breakIfNotAllowed(1, $this->getRequestParameter('avatarApiKey'));

		$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		
		$avatar->substractCredits($this->getRequestParameter('amount'));		
		
		$this->setFlash('responseData', "Se han restado " .  $this->getRequestParameter('amount') . " créditos al avatar " . $avatar);
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
}
