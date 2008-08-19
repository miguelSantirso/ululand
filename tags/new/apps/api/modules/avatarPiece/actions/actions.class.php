<?php

// Requerimos la clase apiCommonActions que nos proporciona las acciones bï¿½sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * avatarPiece actions.
 *
 * @package    PFC
 * @subpackage avatarPiece
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class avatarPieceActions extends apiCommonActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
	}

	/**
	 * Añade una nueva pieza. Se establecerá el creador y el propietario al avatar activo, salvo que se indique otra cosa
	 * Requiere como parÃ¡metros:
	 *  - 'image' -- Imagen asociada a la pieza
	 *  - 'name' -- Nombre que el usuario le ha dado a la pieza
	 *  - 'price' -- Coste de la pieza
	 *  - 'type' -- Tipo de la pieza
	 *
	 * Además, admite como parámetros:
	 *  - 'avatarApiKey' -- ApiKey del avatar que ha creado la pieza y que será, también, el propietario de la misma.
	 *  - 'description' -- Descripción de la pieza
	 *
	 */
	public function executeAdd()
	{
		// Comprobar que se han recibido los parÃ¡metros requeridos
		$this->checkRequiredParameters( array('image', 'name', 'price', 'type') );
		
		// Comprobamos si nos especifican el avatar al que se debe asignar esta pieza
		if($this->getRequestParameter('avatarApiKey'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		}
		else
		{
			// No nos especifican nada, trabajaremos con el usuario que ha lanzado la petición
			$avatar = $this->getActiveAvatar();
		}
		
		// Comprobar que se tienen permisos para actuar sobre el avatar a modificar
		$this->breakIfNotAllowed(1, $avatar->getApiKey());
		
		// Obtener los parámetros recibidos
		$name  = $this->getRequestParameter('name');
		$price = $this->getRequestParameter('price');
		$type  = $this->getRequestParameter('type');
		$image = $this->getRequestParameter('image'); // La recibimos codificado en base 64
		$description = $this->getRequestParameter('description', 'Pieza sin describir');
		
		// Crear el objeto y popularlo con los valores adecuados
		$newPiece = new AvatarPiece();
		$newPiece->setAuthorId($avatar->getId());
		$newPiece->setOwnerId($avatar->getId());
		$newPiece->setName($name);
		$newPiece->setPrice($price);
		$newPiece->setType($type);
		$newPiece->setDescription($description);
		// Guardar el nuevo objeto
		$newPiece->save();
		
		// Procesar la imagen recibida
		$imageFile = base64_decode($image);
		$imageUrl  = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_dir_avatarPiece').'/'.$newPiece->getId().'.png';
		file_put_contents($imageUrl, $imageFile);
		
		// Guardar la url de la imagen recién guardada
		$newPiece->setUrl($newPiece->getId().'.png');
		$newPiece->save();
		
		$this->setFlash('responseData', "Pieza de nombre ".$name ." añadida correctamente.");
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}

	/**
	 * Edita una nueva pieza. Se establecerá el creador y el propietario al avatar activo, salvo que se indique otra cosa
	 * Requiere como parÃ¡metros:
	 *  - 'pieceId' -- Id de la pieza a modificar
	 *
	 * Además, admite como parámetros:
	 *  - 'ownerApiKey' -- ApiKey del avatar que ha creado la pieza y que será, también, el propietario de la misma.
	 *  - 'creatorApiKey' -- ApiKey del avatar que ha creado la pieza y que será, también, el propietario de la misma.
	 *  - 'description' -- Descripción de la pieza
	 *  - 'image' -- Imagen asociada a la pieza
	 *  - 'name' -- Nombre que el usuario le ha dado a la pieza
	 *  - 'price' -- Coste de la pieza
	 *  - 'type' -- Tipo de la pieza
	 *
	 */
	public function executeEdit()
	{
		// Comprobar que se han recibido los parÃ¡metros requeridos
		$this->checkRequiredParameters( array('pieceId') );
		
		// Obtener la pieza a modificar
		$piece = AvatarPiecePeer::retrieveByPK($this->getRequestParameter('pieceId'));
		
		// Obtener el avatar propietario de la pieza
		if($this->getRequestParameter('ownerApiKey'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$owner = AvatarPeer::retrieveByApiKey($this->getRequestParameter('ownerApiKey'));
		}
		else
		{
			// No nos especifican nada, trabajaremos con el usuario que ha lanzado la petición
			$owner = $this->getActiveAvatar();
		}
		
		// Comprobar que se tienen permisos para actuar sobre el avatar a modificar
		$this->breakIfNotAllowed(1, $owner->getApiKey());
		
		// Obtener el resto de parámetros
		$newAuthor = AvatarPeer::retrieveByApiKey($this->getRequestParameter('creatorApiKey'));
		$newName    = $this->getRequestParameter('name');
		$newPrice   = $this->getRequestParameter('price');
		$newType    = $this->getRequestParameter('type');
		$newImage   = $this->getRequestParameter('image'); // La recibimos codificado en base 64
		$newDescription = $this->getRequestParameter('description', 'Pieza sin describir');
		
		// Modificar el objeto en los casos en que sea necesario
		$piece->setOwnerId($owner->getId());
		if($newAuthor) $piece->setAuthorId($newAuthor->getId());
		if($newName)   $piece->setName($newName);
		if($newPrice)  $piece->setPrice($newPrice);
		if($newType)   $piece->setType($newType);
		if($newDescription) $piece->setDescription($newDescription);
		
		if($newImage)
		{
			// Procesar la imagen recibida
			$imageFile = base64_decode($newImage);
			$imageUrl  = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_dir_avatarPiece').'/'.$piece->getId().'.png';
			file_put_contents($imageUrl, $imageFile);

			// Guardar la url de la imagen recién guardada
			$piece->setUrl($piece->getId().'.png');
		}
		
		// Guardar los cambios
		$piece->save();
		
		$this->setFlash('responseData', "Pieza de nombre ".$newName." actualizada correctamente.");
		$this->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
	
	/**
	 * Retorna todas las piezas poseídas por cierto avatar. Si no se especifica ningún avatar, se tratará de averiguar automáticamente a través de la sesión con la api
	 * Admite como parÃ¡metros:
	 *  - 'avatarApiKey' -- ApiKey del juego del que se desea obtener un gamestat
	 *  - 'filterByType' -- Permite filtrar los resultados según el tipo
	 *  - 'filterInUse' -- Si vale 'true' se retornarán solo las piezas marcadas como en uso. 
	 * 
	 * Retorna un array con el siguiente formato:
	 *  array('uniqid' => <id único del usuario en el chat>,
	 *  'avatarName' => <nombre del avatar>,
	 *  'gamestatName' => <nombre del gamestat>,
	 *  'gamestatValue' => <valor del gamestat>)
	 * 
	 */
	public function executeGetByOwner()
	{	
		// Comprobamos si nos especifican el avatar al que se debe asignar esta pieza
		if($this->getRequestParameter('avatarApiKey'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$avatar = AvatarPeer::retrieveByApiKey($this->getRequestParameter('avatarApiKey'));
		}
		else
		{
			// No nos especifican nada, trabajaremos con el usuario que ha lanzado la petición
			$avatar = $this->getActiveAvatar();
		}

		$filterByType = $this->getRequestParameter('filterByType');
		$filterInUse  = $this->getRequestParameter('filterInUse', false);
		
		$c = new Criteria();
		$c->add(AvatarPiecePeer::OWNER_ID, $avatar->getId());
		if($filterByType)
			$c->add(AvatarPiecePeer::TYPE, $filterByType);
		if($filterInUse)
			$c->add(AvatarPiecePeer::IN_USE, true);
			
		$pieces = AvatarPiecePeer::doSelect($c);
		
		$result = array();
		foreach($pieces as $piece)
		{
			array_push( $result, array( 'id'      => $piece->getId(),
										'name'    => $piece->getName(),
										'description' => $piece->getDescription(), 
										'type'    => $piece->getType(),
										'creator' => $piece->getAvatarRelatedByAuthorId()->getName(),
										'url'     => $piece->getUrl(),
										'price'   => $piece->getPrice(),
										'inUse'   => $piece->getInUse() ) );
		}
		
		$this->returnApi( array('avatarApiKey' => $avatar->getApiKey(), 'pieces' => $result) );
	}
}
