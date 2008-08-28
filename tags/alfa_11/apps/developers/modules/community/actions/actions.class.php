<?php

/**
 * community actions.
 *
 * @package    ululand
 * @subpackage community
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
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
