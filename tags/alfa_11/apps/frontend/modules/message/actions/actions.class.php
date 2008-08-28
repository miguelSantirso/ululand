<?php

/**
 * message actions.
 *
 * @package    PFC
 * @subpackage message
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class messageActions extends sfActions
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
	 * A�ade un nuevo mensaje. Esta funci�n est� pensada para ser llamada a trav�s de AJAX
	 *
	 * @return unknown
	 */
	public function executeAdd()
	{
		if ($this->getRequest()->getMethod() == sfRequest::POST)
		{
			$messageText = $this->getRequestParameter('body');
			if (!$messageText)
			{
				return sfView::NONE;
			}

			$recipient = $this->getRequestParameter('recipient_id');
			$sender = $this->getUser()->getAttribute('avatarId');
			
			// create answer
			$this->message = new Message();
			$this->message->setText($messageText);
			$this->message->setIdRecipient($recipient);
			$this->message->setIdSender($sender);
			$this->message->save();

			return sfView::SUCCESS;
		}

		$this->forward404();
	}
	
	/**
	 * Elimina un mensaje dado su ID. Esta función está pensada para ser llamada a través de AJAX
	 *
	 * @return unknown
	 */
	public function executeDelete()
	{
		$messageId = $this->getRequestParameter('id');
		if (!$messageId)
		{
			return sfView::NONE;
		}
			
		$message = MessagePeer::retrieveByPK($messageId);
		$message->delete();

		return sfView::SUCCESS;
	}
}
