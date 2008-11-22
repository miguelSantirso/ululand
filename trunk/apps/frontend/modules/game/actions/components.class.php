<?php

/**
 * game components.
 *
 * @package    ululand
 * @subpackage game
 * @author     Pncil.com <http://pncil.com>
 */
class gameComponents extends sfComponents
{

	/**
	 * Lógica del componente "list" que lista o filtra juegos almacenados en el sistema 
	 *
	 */
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

	/**
	 * Lógica del componente "relatedByTags"
	 *
	 */
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
	
	/**
	 * Lógica del componente "release"
	 *
	 */
	public function executeRelease()
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
			 
			// Añadimos el userUuid al principio de los flashVars para pasárselo al cliente flash.
	    	$this->flashVars = 'userUuid='.$this->getUser()->getProfile()->getUuid().'&'.$this->flashVars;
	    
			// Añadimos el sessionId al principio de los flashVars para pasárselo al objeto flash.
			$this->flashVars = 'apiSessionId='.$newApiSession->getSessionId().'&'.$this->flashVars;
			
			// Añadimos la ruta a la API al principio de los flashVars para pasárselo al cliente flash.
	    	$this->flashVars = 'apiUrl='.ulToolkit::getBaseUrl().'/api.php/'.'&'.$this->flashVars;
		}
	}
	
	public function executeReleaseEmbed()
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
			 
			// Añadimos el userUuid al principio de los flashVars para pasárselo al cliente flash.
	    	$this->flashVars = 'userUuid='.$this->getUser()->getProfile()->getUuid().'&'.$this->flashVars;
	    
			// Añadimos el sessionId al principio de los flashVars para pasárselo al objeto flash.
			$this->flashVars = 'apiSessionId='.$newApiSession->getSessionId().'&'.$this->flashVars;
			
			// Añadimos la ruta a la API al principio de los flashVars para pasárselo al cliente flash.
	    	$this->flashVars = 'apiUrl='.ulToolkit::getBaseUrl().'/api.php/'.'&'.$this->flashVars;
		}
	}
	
}
