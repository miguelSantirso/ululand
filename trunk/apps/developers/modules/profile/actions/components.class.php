<?php

/**
 * profile actions for components.
 *
 * @package    ululand
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class profileComponents extends sfComponents
{
	public function executeList()
	{
		$pager = new sfPropelPager('DeveloperProfile', sfConfig::get('app_pager_profile'));
		$c = new Criteria();

		$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
			$c = TagPeer::getTaggedWithCriteria('DeveloperProfile', $tag);
		}
		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->addJoin(sfGuardUserProfilePeer::ID, DeveloperProfilePeer::USER_PROFILE_ID);
			$c->add(sfGuardUserProfilePeer::USERNAME, '%'.$search.'%', Criteria::LIKE);
		}
		$this->onlyFree = $this->onlyFree || $this->getRequestParameter('onlyFree');
		if($this->onlyFree)
		{
			$c->add(DeveloperProfilePeer::IS_FREE, true);
		}
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
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
		
		$c->addJoin(DeveloperProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
		$c->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID);
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->profilesPager = $pager;
	}
	
	public function executeRelatedByTags()
	{
		$c = new Criteria();
		
		if($this->tagsString)
		{
			$c = TagPeer::getTaggedWithCriteria('DeveloperProfile', $this->tagsString, null, array('nb_common_tags' => 1));			
		}
		
		if($this->onlyFree)
		{
			$c->add(DeveloperProfilePeer::IS_FREE, true);
		}
		
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		
		$this->objects = DeveloperProfilePeer::doSelect($c);
	}
}
