<?php

/**
 * collaborations actions for components.
 *
 * @package    ululand
 * @subpackage recipe
 * @author     Pncil.com
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class recipeComponents extends sfComponents
{
	public function executeList()
	{	
		$pager = new sfPropelPager('CodePiece', sfConfig::get('app_pager_recipe'));
		$c = new Criteria();
		$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
			$c = TagPeer::getTaggedWithCriteria('CodePiece', $tag);
		}
		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
			$c->add(CodePiecePeer::TITLE, '%'.$search.'%', Criteria::LIKE);
		}
		
		$this->filterByUsername = isset($this->filterByUsername) ? $this->filterByUsername : $this->getRequestParameter('filterByUsername');
		if($this->filterByUsername)
		{
			$c->addJoin(CodePiecePeer::CREATED_BY, sfGuardUserPeer::ID);
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

		$this->recipesPager = $pager;
	}
	
	public function executeRelatedByTags()
	{
		$c = new Criteria();
		
		if($this->tagsString)
		{
			$c = TagPeer::getTaggedWithCriteria('CodePiece', $this->tagsString, null, array('nb_common_tags' => 1));			
		}
				
		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		
		$this->objects = CodePiecePeer::doSelect($c);
	}
}
