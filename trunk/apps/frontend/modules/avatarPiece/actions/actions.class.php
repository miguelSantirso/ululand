<?php

/**
 * avatarPiece actions.
 *
 * @package    ululand
 * @subpackage avatarPiece
 * @author     Pncil.com <http://pncil.com>
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class avatarPieceActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('avatarPiece', 'list');
  }

  public function executeList()
  {
  }

  public function executeShow()
  {
    $this->avatar_piece = AvatarPiecePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->avatar_piece);
  }
  
  public function executeCreate()
  {
  	$this->pieceType = $this->getRequestParameter('pieceType');
  	
  	if(is_null($this->pieceType))
  		$this->setTemplate('selectPieceType');
  	else
    	$this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->avatar_piece = AvatarPiecePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->avatar_piece);
  }

  public function executeDelete()
  {
    $avatar_piece = AvatarPiecePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($avatar_piece);

    $avatar_piece->delete();

    return $this->redirect('avatarPiece/list');
  }
}
