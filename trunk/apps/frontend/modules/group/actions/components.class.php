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
		$this->username = isset($this->username) ? $this->username : $this->getRequestParameter('username');
		if($this->username)
		{
			$c->addJoin(GroupPeer::ID, PlayerProfile_GroupPeer::GRUPO_ID);
			$c->addJoin(PlayerProfile_GroupPeer::PLAYER_PROFILE_ID, PlayerProfilePeer::ID);
			$c->addJoin(PlayerProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
			$c->add(sfGuardUserProfilePeer::USERNAME, $this->username);

		}
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->groupsPager = $pager;
	}
	
	/**
	 * Componente que lista los miembros de un grupo
	 * Admite los siguientes filtros booleanos: onlyOwners, excludeOwners, pending, showAll
	 * Filtros string para ordenar: orderDescendingBy, orderAscendingBy
	 */
	public function executeListMembers()
	{
		if (!$this->group)
		{
			throw new sfException("No existe el grupo");
		}
		
		$c = new Criteria();
		$this->onlyOwners = isset($this->onlyOwners) ? $this->onlyOwners : $this->getRequestParameter('onlyOwners');
		if($this->onlyOwners)
		{
			$c->add(PlayerProfile_GroupPeer::IS_OWNER, true);
		}
	
		$this->excludeOwners = isset($this->excludeOwners) ? $this->excludeOwners : $this->getRequestParameter('excludeOwners');
		if($this->excludeOwners)
		{
			$c->add(PlayerProfile_GroupPeer::IS_OWNER, false);
		}
		
		$this->pending = isset($this->pending) ? $this->pending : $this->getRequestParameter('pending');
		if($this->pending)
		{
			$c->add(PlayerProfile_GroupPeer::IS_APPROVED, false);
		}
		else if (!$this->showAll)
		{
			$c->add(PlayerProfile_GroupPeer::IS_APPROVED, true);
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
		
		$this->members = $this->group->getMembers($c);
		
	}

}
