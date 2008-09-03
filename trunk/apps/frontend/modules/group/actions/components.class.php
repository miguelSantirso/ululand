<?php

/**
 * group actions for components.
 *
 * @package    ululand
 * @subpackage group
 * @author     Pncil.com
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class groupComponents extends sfComponents
{
	public function executeList()
	{
		$pager = new sfPropelPager('Group', sfConfig::get('app_pager_profile'));
		$c = new Criteria();

		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->add(GroupPeer::NAME, '%'.$search.'%', Criteria::LIKE);
		}
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		$this->player = isset($this->player) ? $this->player : $this->getRequestParameter('player');
		if($this->player)
		{
			$c->addJoin(GroupPeer::ID, PlayerProfile_GroupPeer::GRUPO_ID);
			$c->addJoin(PlayerProfile_GroupPeer::PLAYER_PROFILE_ID, PlayerProfilePeer::ID);
			$c->addJoin(PlayerProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
			$c->add(sfGuardUserProfilePeer::USERNAME, $this->player);

		}
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->groupsPager = $pager;
	}

}
