<?php

/**
 * game components.
 *
 * @package    PFC
 * @subpackage widget
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gameComponents extends sfComponents
{

	public function executeList()
	{
		$pager = new sfPropelPager('Game', sfConfig::get('app_pager_profile'));
		$c = new Criteria();

		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->add(GamePeer::NAME, '%'.$search.'%', Criteria::LIKE);
		}
		$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
			$c = TagPeer::getTaggedWithCriteria('Game', $tag);
		}

		$c->addDescendingOrderByColumn(GamePeer::NAME);
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->gamesPager = $pager;
	}

	public function executeRelatedByTags()
	{
		$c = new Criteria();
		
		if($this->tagsString)
		{
			$c = TagPeer::getTaggedWithCriteria('Game', $this->tagsString, null, array('nb_common_tags' => 1));			
		}
				
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		
		$this->objects = GamePeer::doSelect($c);
	}
	
	public function executeGame()
	{
		// Cargar el juego
		$this->game = GamePeer::retrieveByPK($this->gameId);
		$this->gameRelease = $this->game->getActiveRelease();
		if($this->game && $this->gameRelease && $this->getUser()->isAuthenticated())
		{
			// Iniciar la sesi�n de la api
			$newApiSession = ApiSessionPeer::createNew($this->game->getUuid(), 
				$this->getUser()->getProfile()->getUuid(),
				$this->game->getPrivilegesLevel());    // Iniciar la sesión de la api
			 
			// A�adimos el sessionId al principio de los flashVars para pas�rselo al objeto flash.
			$this->flashVars = 'apiSessionId='.$newApiSession->getSessionId().'&'.$this->flashVars;
		}
	}
}
