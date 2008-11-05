<?php

/**
 * community actions.
 *
 * @package    ululand
 * @subpackage community
 * @author     pncil.com <http://pncil.com>
 */
class communityActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    
  }
  
  /**
   * Acción correspondiente a la pantalla que muestra las últimas noticias de la comunidad
   *
   */
  public function executeLatestCommunityNews()
  {
  	$feedUrls = array('http://mochiland.com/feed/',
  					'http://feeds.feedburner.com/Actionscriptcom',
  					'http://www.sephiroth.it/weblog/atom.xml',
  					'http://www.flashguru.co.uk/feed');
  	
  	$feeds = array();
  	foreach ($feedUrls as $feedUrl)
  	{
  		array_push($feeds, sfFeedPeer::createFromWeb($feedUrl));
  	}
  	
  	$this->feed = sfFeedPeer::aggregate($feeds, array('limit' => 8));
  }
}
