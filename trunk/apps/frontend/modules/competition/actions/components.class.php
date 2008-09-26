<?php

/**
 * group actions for components.
 *
 * @package    ululand
 * @subpackage competition
 * @author     Pncil.com
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class competitionComponents extends sfComponents
{
	public function executeList()
	{
		$pager = new sfPropelPager('Competition', sfConfig::get('app_pager_profile'));
		$c = new Criteria();

		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->add(CompetitionPeer::NAME, '%'.$search.'%', Criteria::LIKE);
		}
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		$this->username = isset($this->username) ? $this->username : $this->getRequestParameter('username');
		if($this->username)
		{
			$c->addJoin(CompetitionPeer::ID, Competition_PlayerProfilePeer::COMPETITION_ID);
			$c->addJoin(Competition_PlayerProfilePeer::PLAYER_PROFILE_ID, PlayerProfilePeer::ID);
			$c->addJoin(PlayerProfilePeer::USER_PROFILE_ID, sfGuardUserProfilePeer::ID);
			$c->add(sfGuardUserProfilePeer::USERNAME, $this->username);

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

		$this->competitionsPager = $pager;
	}
	
	/**
	 * Componente que lista los miembros de una competición
	 * Admite los siguientes filtros booleanos: onlyOwners, excludeOwners, pending, showAll, edit
	 * Filtros string para ordenar: orderDescendingBy, orderAscendingBy
	 */
	public function executeListMembers()
	{
		if (!$this->competition)
		{
			throw new sfException("No existe el grupo");
		}
		
		$c = new Criteria();
		$this->onlyOwners = isset($this->onlyOwners) ? $this->onlyOwners : $this->getRequestParameter('onlyOwners');
		if($this->onlyOwners)
		{
			$c->add(Competition_PlayerProfilePeer::IS_OWNER, true);
		}
	
		$this->excludeOwners = isset($this->excludeOwners) ? $this->excludeOwners : $this->getRequestParameter('excludeOwners');
		if($this->excludeOwners)
		{
			$c->add(Competition_PlayerProfilePeer::IS_OWNER, false);
		}
		
		$this->pending = isset($this->pending) ? $this->pending : $this->getRequestParameter('pending');
		if($this->pending)
		{
			$c->add(Competition_PlayerProfilePeer::IS_CONFIRMED, false);
		}
		else if (!$this->showAll)
		{
			$c->add(Competition_PlayerProfilePeer::IS_CONFIRMED, true);
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
		
		$this->edit = isset($this->edit) ? $this->edit : $this->getRequestParameter('edit');
		$this->members = $this->competition->getMembers($c);
		
	}

}
