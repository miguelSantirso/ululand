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
	 * Retorna la información del avatar que pertenece al usuario indicado
	 * Requiere como parámetro 'userUuid' que indica el uuid del usuario cuyo avatar se está pidiendo
	 *
	 * Retorna un array con el siguiente formato:
	 * 
	 *  array('userUuid' => <uuid del propietario>,
	 * 		  'avatarUuid' => <uuid del avatar>,
	 *  'pieces' => array('id'    => <id de la pieza>,
	 *       'name'        => <nombre de la pieza>,
	 *       'description' => <descripción del gamestat>,
	 *       'type'        => <tipo de la pieza>,
	 *       'creator'     => <nombre del creador de la pieza>,
	 *       'creatorUuid' => <uuid del de la pieza>,
	 *       'url'         => <url de la pieza>,
	 *       'price'       => <precio de la pieza>,
	 *       'inUse'       => <indica si la pieza está en uso; solo debería haber una por cada tipo>
	 * )
	 */
	public function executeGetByUserUuid()
	{
		// Comprobar que se nos han pasado todos los parámetros necesarios
		$this->checkRequiredParameters( array("userUuid") );
		
		// Obtener el perfil de usuario y el de jugador
		$user = sfGuardUserProfilePeer::retrieveByUuid($this->getRequestParameter('userUuid'));
		
		$avatars = $user->getAvatars();
		$avatar = $avatars[0];
		
		$pieces = array();
		$pieces[] = $avatar->getAvatarPieceRelatedByHeadId();
		$pieces[] = $avatar->getAvatarPieceRelatedByBodyId();
		$pieces[] = $avatar->getAvatarPieceRelatedByArmsId();
		$pieces[] = $avatar->getAvatarPieceRelatedByLegsId();
		
		$piecesResponse = array();
		foreach($pieces as $piece)
		{
			array_push($piecesResponse, array('id'    => $piece->getId(),
										'name'         => $piece->getName(),
										'description'  => $piece->getDescription(), 
										'type'         => $piece->getType(),
										'creator'      => $piece->getsfGuardUserProfileRelatedByAuthorId()->getUsername(),
										'creatorUuid'  => $piece->getsfGuardUserProfileRelatedByAuthorId()->getUuid(),
										'url'          => $piece->getUrl(),
										'price'        => $piece->getPrice(),
										'inUse'        => $piece->getInUse() ) );
		}
		
		$response = array(
			'userUuid'   => $user->getUuid(),
			'avatarUuid' => $avatar->getUuid(),
			'pieces'     => $piecesResponse
		);
		
		$this->returnApi( $response );
	}
}
