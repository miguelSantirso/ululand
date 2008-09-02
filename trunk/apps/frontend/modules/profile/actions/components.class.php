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
		$pager = new sfPropelPager('PlayerProfile', sfConfig::get('app_pager_profile'));
		$c = new Criteria();

		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->addJoin(sfGuardUserProfilePeer::ID, PlayerProfilePeer::USER_PROFILE_ID);
			$c->add(sfGuardUserProfilePeer::USERNAME, '%'.$search.'%', Criteria::LIKE);
		}
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->profilesPager = $pager;
	}

}
