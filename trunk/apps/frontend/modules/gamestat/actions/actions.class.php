<?php

/**
 * gamestat actions.
 *
 * @package    ululand
 * @subpackage gamestat
 * @author     Pncil.com <http://pncil.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gamestatActions extends sfActions
{
	public function executeShow()
	{
		$this->gamestat = GameStatPeer::retrieveByPK($this->getRequestParameter('id'));
		
		$this->forward404Unless($this->gamestat);
	}
}
