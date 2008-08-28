<?php

/**
 * comment actions.
 *
 * @package    PFC
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class commentActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('default', 'module');
	}

	/**
	 * Añade un nuevo comentario. Esta función está pensada para ser llamada a través de AJAX
	 *
	 * @return unknown
	 */
	public function executeAdd()
	{
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
			$commentText = $this->getRequestParameter('body');
			if (!$commentText)
			{
				return sfView::NONE;
			}

			$game = GamePeer::retrieveByPk($this->getRequestParameter('game_id'));
			$this->forward404Unless($game);

			// create answer
			$this->comment = new Comment();
			$this->comment->setText($commentText);
			$this->comment->setGame($game);
			$this->comment->setIdAvatar($this->getUser()->getAttribute("avatarId"));
			$this->comment->save();

			return sfView::SUCCESS;
		}

		$this->forward404();
	}

	/**
	 * Elimina un comentario dado su ID. Esta función está pensada para ser llamada a través de AJAX
	 *
	 * @return unknown
	 */
	public function executeDelete()
	{
		$commentId = $this->getRequestParameter('id');
		if (!$commentId)
		{
			return sfView::NONE;
		}
			
		$comment = CommentPeer::retrieveByPK($commentId);
		$comment->delete();

		return sfView::SUCCESS;
	}
}
