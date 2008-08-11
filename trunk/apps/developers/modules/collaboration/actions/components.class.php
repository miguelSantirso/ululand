<?php

/**
 * collaborations actions for components.
 *
 * @package    ululand
 * @subpackage collaboration
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class collaborationComponents extends sfComponents
{
	public function executeList()
	{
		$pager = new sfPropelPager('CollaborationOffer', sfConfig::get('app_pager_collaboration'));
		$c = new Criteria();
		$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
			$c = TagPeer::getTaggedWithCriteria('CollaborationOffer', $tag);
		}
		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->add(CollaborationOfferPeer::TITLE, '%'.$search.'%', Criteria::LIKE);
		}
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->collaborationsPager = $pager;
	}
}
