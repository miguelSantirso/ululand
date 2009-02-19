<?php
/**
 * Contiene la clase avatarPieceActions
 *
 * @package    ululand
 * @subpackage avatarPiece
 */

// Requerimos la clase apiCommonActions que nos proporciona las acciones b�sicas de la api al heredar de ella.
require_once dirname(__FILE__).'/../../../lib/apiCommonActions.class.php';

/**
 * Acciones del módulo avatarPiece en la aplicación API. Contiene las acciones de la api que se refieren a información de las piezas de avatar
 *
 * @package    ululand
 * @subpackage avatarPiece
 * @author     <pncil.com>
 */
class avatarPieceActions extends apiCommonActions
{
	/**
	 * Retorna la pieza de avatar indicado
	 * Requiere como parámetro 'pieceUuid' que indica el uuid de la pieza
	 *
	 */
	public function executeGet()
	{
		// Comprobar que se nos han pasado todos los parámetros necesarios
		$this->checkRequiredParameters( array("pieceUuid") );
		
		// Obtener el perfil de usuario y el de jugador
		$piece = AvatarPiecePeer::retrieveByUuid($this->getRequestParameter('pieceUuid'));

		$this->returnApi($piece, $this->apiType);
	}
	
	/**
	 * Añade una nueva pieza. Se establecerá el creador y el propietario al jugador activo, salvo que se indique otra cosa
	 * Requiere como parámetros:
	 *  - 'image' -- Imagen asociada a la pieza
	 *  - 'name' -- Nombre que el usuario le ha dado a la pieza
	 *  - 'price' -- Coste de la pieza
	 *  - 'type' -- Tipo de la pieza
	 *
	 * Además, admite como par�metros:
	 *  - 'userUuid' -- Uuid del usuario que ha creado la pieza y que será, también, el propietario de la misma.
	 *  - 'description' -- Descripción de la pieza
	 *
	 */
	public function executeAdd()
	{
		// Comprobar que se han recibido los parámetros requeridos
		$this->checkRequiredParameters( array('image', 'name', 'price', 'type') );
		
		// Comprobamos si nos especifican el avatar al que se debe asignar esta pieza
		if($this->getRequestParameter('userUuid'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		}
		else
		{
			// No nos especifican nada, trabajaremos con el usuario que ha lanzado la petici�n
			$user = $this->getActiveUser();
		}
		
		// Comprobar que se tienen permisos para actuar sobre el usuario a modificar
		$this->breakIfNotAllowed(1, $user->getUuid());
		
		// Obtener los par�metros recibidos
		$name  = $this->getRequestParameter('name');
		$price = $this->getRequestParameter('price');
		$type  = $this->getRequestParameter('type');
		$image = $this->getRequestParameter('image'); // La recibimos codificado en base 64
		$description = $this->getRequestParameter('description', 'Pieza sin describir');
		
		// Crear el objeto y popularlo con los valores adecuados
		$newPiece = new AvatarPiece();
		$newPiece->setAuthorId($user->getId());
		$newPiece->setOwnerId($user->getId());
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
		
		// Guardar la url de la imagen reci�n guardada
		$newPiece->setUrl($newPiece->getId().'.png');
		$newPiece->save();
		
		$this->getUser()->setFlash('responseData', "Pieza de nombre ".$name ." añadida correctamente.");
		$this->getUser()->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}

	/**
	 * Edita una pieza.
	 * Requiere como parámetros:
	 *  - 'pieceId' -- Id de la pieza a modificar
	 *
	 * Además, admite como parámetros:
	 *  - 'ownerUuid' -- ApiKey del avatar que ha creado la pieza y que será, también, el propietario de la misma.
	 *  - 'description' -- Descripci�n de la pieza
	 *  - 'image' -- Imagen asociada a la pieza
	 *  - 'name' -- Nombre que el usuario le ha dado a la pieza
	 *  - 'price' -- Coste de la pieza
	 *  - 'type' -- Tipo de la pieza
	 *
	 */
	public function executeEdit()
	{
		// Comprobar que se han recibido los parámetros requeridos
		$this->checkRequiredParameters( array('pieceUuid') );
		
		// Obtener la pieza a modificar
		$piece = AvatarPiecePeer::retrieveByUuid($this->getRequestParameter('pieceUuid'));
		
		// Obtener el avatar propietario de la pieza
		if($this->getRequestParameter('ownerUuid'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$owner = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('ownerUuid'));
		}
		else
		{
			// No nos especifican nada, trabajaremos con el usuario que ha lanzado la petici�n
			$owner = sfGuardUserProfilePeer::retrieveByPK($piece->getOwnerId());
		}
		
		// Comprobar que se tienen permisos para actuar sobre el avatar a modificar
		$this->breakIfNotAllowed(1, $owner->getUuid());
		
		// Obtener el resto de parámetros
		$newName    = $this->getRequestParameter('name');
		$newPrice   = $this->getRequestParameter('price');
		$newType    = $this->getRequestParameter('type');
		$newImage   = $this->getRequestParameter('image'); // La recibimos codificado en base 64
		$newDescription = $this->getRequestParameter('description', 'Pieza sin describir');
		
		// Modificar el objeto en los casos en que sea necesario
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

			// Guardar la url de la imagen reci�n guardada
			$piece->setUrl($piece->getId().'.png');
		}
		
		// Guardar los cambios
		$piece->save();
		
		$this->getUser()->setFlash('responseData', "Pieza de nombre ".$newName." actualizada correctamente.");
		$this->getUser()->setFlash('responseType', "Content-Type: plain/text");
		$this->forward('output', 'response');
	}
	
	/**
	 * Retorna todas las piezas poseídas por cierto usuario. Si no se especifica ningún usuario, se tratará de averiguar automaticamente a través de la sesión con la api
	 * Admite como parámetros:
	 *  - 'userUuid'     -- Uuid del usuario del que se desean obtener sus piezas de avatar
	 *  - 'filterByType' -- Permite filtrar los resultados segín el tipo
	 *  - 'filterInUse'  -- Si vale 'true' se retornarán solo las piezas marcadas como en uso. 
	 * 
	 * Retorna un array con el siguiente formato:
	 * 
	 *  array('userUuid' => <uuid del propietario>,
	 *  'pieces' => array('id'    => <id de la pieza>,
	 *       'name'        => <nombre de la pieza>,
	 *       'description' => <descripción del gamestat>,
	 *       'type'        => <tipo de la pieza>,
	 *       'creator'     => <creador de la pieza>,
	 *       'url'         => <url de la pieza>,
	 *       'price'       => <precio de la pieza>,
	 *       'inUse'       => <indica si la pieza está en uso; solo debería haber una por cada tipo>
	 * )
	 * 
	 */
	public function executeGetByOwner()
	{	
		// Comprobamos si nos especifican el avatar al que se debe asignar esta pieza
		if($this->getRequestParameter('userUuid'))
		{
			// Obtener el avatar cuyo apikey es el recibido
			$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		}
		else
		{
			// No nos especifican nada, trabajaremos con el usuario que ha lanzado la petición
			$user = $this->getActiveUser();
		}

		$filterByType = $this->getRequestParameter('filterByType');
		$filterInUse  = $this->getRequestParameter('filterInUse', false);
		
		$c = new Criteria();
		$c->add(AvatarPiecePeer::OWNER_ID, $user->getId());
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
										'creator' => $piece->getsfGuardUserProfileRelatedByAuthorId()->getUsername(),
										'url'     => $piece->getUrl(),
										'price'   => $piece->getPrice(),
										'inUse'   => $piece->getInUse() ) );
		}
		
		$this->returnApi( array('userUuid' => $user->getUuid(), 'pieces' => $result) );
	}
}
