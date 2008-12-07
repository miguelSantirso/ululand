<?php


/**
 * profile actions for components.
 *
 * @package    ululand
 * @subpackage profile
 * @author     pncil.com <http://pncil.com>
 */
class profileComponents extends sfComponents
{
	/**
	 * Ejecuta la lógica del componente "list" del módulo "profile"
	 *
	 */
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
			$pager->setMaxRecordLimit($this->limit);
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

		$this->profilesPager = $pager;
	}
	
/**
	 * Componente que lista los amigos de un jugador
	 * Admite los siguientes filtros booleanos: onlyFriends, pending
	 */
	public function executeListFriends()
	{
		if (!$this->playerProfile)
		{
			throw new sfException("No existe el jugador");
		}
		
		$c = new Criteria();
		$this->onlyFriends = isset($this->onlyFriends) ? $this->onlyFriends : $this->getRequestParameter('onlyFriends');
		if($this->onlyFriends)
		{
			$c->add(FriendshipPeer::IS_CONFIRMED, true);
		}
		
		$this->pending = isset($this->pending) ? $this->pending : $this->getRequestParameter('pending');
		if($this->pending)
		{
			$c->add(FriendshipPeer::IS_CONFIRMED, false);
		}
		
		$this->friends = $this->playerProfile->getFriends($c);
		
	}

}
