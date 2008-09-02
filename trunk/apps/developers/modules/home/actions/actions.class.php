<?php

/**
 * home actions.
 *
 * @package    ululand_dev
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homeActions extends sfActions
{
	
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
	}
	
	public function executeLatestNews()
	{
		try
		{
			if($this->getUser()->getCulture() == 'es')
				$this->feed = sfFeedPeer::createFromWeb('http://blog.pncil.com/feed/');
			else
				$this->feed = sfFeedPeer::createFromWeb('http://blog.pncil.com/en/feed/');
		}
		catch (Exception $e) { return sfView::ERROR; }
	}
	
	public function executeDisabled()
	{
		
	}
}
