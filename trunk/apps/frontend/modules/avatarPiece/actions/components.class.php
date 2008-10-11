<?php

/**
 * avatarPiece actions for components
 *
 * @package    ululand
 * @subpackage avatarPiece
 * @author     Pncil.com <http://pncil.com>
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class avatarPieceComponents extends sfComponents
{
	public function executeList()
	{
		$pager = new sfPropelPager('AvatarPiece');
		$c = new Criteria();

		$this->limit = isset($this->limit) ? $this->limit : $this->getRequestParameter('limit');
		if($this->limit)
		{
			$c->setLimit($this->limit);
		}
		
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

		$this->avatarPiecesPager = $pager;
	}

}
