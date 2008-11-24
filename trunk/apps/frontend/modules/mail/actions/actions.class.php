<?php

/**
 * mail actions.
 *
 * @package    PFC
 * @subpackage mail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mailActions extends sfActions
{

  public function executeSendEmailApprovalLink()
  {
		$mail = new sfEmail();

		// definition of the required parameters
		$mail->setFrom('no-reply@ululand.com', 'El cartero amable de Ululand.');
		$mail->setSubject(ulToolkit::__('Email account validation'));
		$mail->addAddress($this->getRequestParameter('email'));
		
		$mail->addEmbeddedImage(sfConfig::get('sf_web_dir').'/images/header_logo.gif', 'CID1', 'Ululand Logo', 'base64', 'image/gif');
		
		$this->mail = $mail;
		$this->approvalLink = $this->getRequestParameter('approvalLink');
  }
}
