<?php


/**
 * game actions.
 *
 * @package    ululand
 * @subpackage game
 * @author     Pncil.com <http://pncil.com>
 */
class gameActions extends sfActions
{
  
  /**
   * Acción correspondiente al índice del módulo
   *
   */
  public function executeIndex()
  {
  }

  /**
   * Acción correspondiente a la pantalla que lista todos los juegos
   *
   */
  public function executeList()
  {
    	$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
		}
  		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
		}
  }

  /**
   * Acción correspondiente a la pantalla de un juego
   *
   */
  public function executeShow()
  {
  	if($this->getRequestParameter('id'))
  	{
  		$game = GamePeer::retrieveByPk($this->getRequestParameter('id'));
  		$this->redirect('game/show?stripped_name='.$game->getStrippedName());
  	}
  	else if($this->getRequestParameter('stripped_name'))
  	{
  		$c = new Criteria();
  		$c->add(GamePeer::STRIPPED_NAME, $this->getRequestParameter('stripped_name'));
  		$this->game = GamePeer::doSelectOne($c);
  	}

  	$this->forward404Unless($this->game);

  	// Aumentar en uno las partidas jugadas del juego
  	$this->game->incrementCounter();

  	// Cargar los gamestats del juego para mostrarlos en el template
  	$this->gamestats = $this->game->getGameStats();
  }

  /**
   * Acción que permite la inserción de un juego desde páginas externas
   *
   */
  public function executeEmbed()
  {
		if($this->getRequestParameter('g'))
		{
			$c = new Criteria();
			$c->add(GamePeer::UUID, $this->getRequestParameter('g'));
			$this->game = GamePeer::doSelectOne($c);
		}

		$this->forward404Unless($this->game);
		$this->game->incrementCounter(); // Una visita más

		$this->getResponse()->setContentType('application/x-javascript');
  }
}
