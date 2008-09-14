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
		
			
		$this->filterByUsername = isset($this->filterByUsername) ? $this->filterByUsername : $this->getRequestParameter('filterByUsername');
		if($this->filterByUsername)
		{
			$c->addJoin(CollaborationOfferPeer::CREATED_BY, sfGuardUserPeer::ID);
			$c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
			$c->add(sfGuardUserProfilePeer::USERNAME, $this->filterByUsername);
		}
		$this->orderDescendingBy = isset($this->orderDescendingBy) ? $this->orderDescendingBy : $this->getRequestParameter('orderDescendingBy');
		if($this->orderDescendingBy)
		{
			$c->addDescendingOrderByColumn($this->orderDescendingBy);
		}
		$this->orderAscendingBy = isset($this->orderAscendingBy) ? $this->orderAscendingBy : $this->getRequestParameter('orderAscendingBy');
		if($this->orderAscendingBy)
		{
			$c->addAscendingOrderByColumn($this->orderAscendingBy);
		}
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->collaborationsPager = $pager;
	}
	
	public function executeRelatedByTags()
	{
		$c = new Criteria();
		
		if($this->tagsString)
		{
			$c = TagPeer::getTaggedWithCriteria('CollaborationOffer', $this->tagsString, null, array('nb_common_tags' => 1));			
		}
				
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		
		$this->objects = CollaborationOfferPeer::doSelect($c);
	}
}
