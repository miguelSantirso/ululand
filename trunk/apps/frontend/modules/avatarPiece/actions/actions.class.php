<?php

/**
 * avatarPiece actions.
 *
 * @package    ululand
 * @subpackage avatarPiece
 * @author     Pncil.com <http://pncil.com>
 */
class avatarPieceActions extends sfActions
{
  /**
   * Acción correspondiente al índice del módulo avatarPiece
   *
   */
  public function executeIndex()
  {
    return $this->forward('avatarPiece', 'list');
  }

  
  /**
   * Acción correspondiente a la pantalla que lista las piezas de avatar
   *
   */
  public function executeList()
  {
  }

  /**
   * Acción correspondiente a la pantalla que muestra una pieza de avatar
   *
   */
  public function executeShow()
  {
    $this->avatar_piece = AvatarPiecePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->avatar_piece);
  }
  
  /**
   * Acción correspondiente a la pantalla de creación de una pieza de avatar
   *
   */
  public function executeCreate()
  {
  	$this->pieceType = $this->getRequestParameter('pieceType');
  	
  	if(is_null($this->pieceType))
  		$this->setTemplate('selectPieceType');
  	else
    	$this->setTemplate('edit');
  }

  /**
   * Acción correspondiente a la pantalla de edición de una pieza de avatar
   *
   */
  public function executeEdit()
  {
    $this->avatar_piece = AvatarPiecePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->avatar_piece);
  }

  /**
   * Elimina una pieza de avatar
   *
   */
  public function executeDelete()
  {
    $avatar_piece = AvatarPiecePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($avatar_piece);

    $avatar_piece->delete();

    return $this->redirect('avatarPiece/list');
  }
}
