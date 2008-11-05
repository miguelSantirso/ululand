<?php

/**
 * home actions.
 *
 * @package    ululand
 * @subpackage home
 * @author     Pncil.com <http://pncil.com>
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
	
	/**
	 * Acción correspondiente a la pantalla que muestra las últimas noticias relacionadas.
	 *
	 */
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
	
	/**
	 * Acción que se ejecuta cuando se intenta acceder a un módulo configurado como "disabled" (deshabilitado)
	 *
	 */
	public function executeDisabled()
	{
		
	}
}
