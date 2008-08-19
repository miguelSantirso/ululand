<?php
// auto-generated by sfPropelCrud
// date: 2008/02/21 12:09:13
?>
<?php


/**
 * game actions.
 *
 * @package    PFC
 * @subpackage game
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class gameActions extends sfActions
{
  
  public function executeIndex()
  {
    return $this->forward('game', 'list');
  }

  public function executeList()
  {
		$pager = new sfPropelPager('Game', sfConfig::get('app_pager_profile'));
		$c = new Criteria();
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

  public function executeShow()
  {
    $this->game = GamePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->game);
    
    // Aumentar en uno las partidas jugadas del juego
    $this->game->setGameplays($this->game->getGameplays()+1);
    $this->game->save();
    
    // Cargar los gamestats del juego para mostrarlos en el template
    $this->gamestats = $this->game->getGameStats();
    
    $this->avatarApiKey = $this->getUser()->getAttribute('avatarApiKey');
  }

}