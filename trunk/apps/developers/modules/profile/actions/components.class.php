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
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->profilesPager = $pager;
	}
}
