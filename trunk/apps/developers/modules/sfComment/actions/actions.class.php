<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfPropelActAsCommentableBehaviorPlugin/modules/sfComment/lib/BasesfCommentActions.class.php');

/**
 * sfPropelActAsCommentableBehaviorPlugin actions. Feel free to override this
 * class in your dedicated app module.
 * 
 * @package    developers
 * @subpackage sfComment 
 * @author     Miguel Santirso
 */
class sfCommentActions extends BasesfCommentActions
{
	public function executeRemove()
	{
		$commentId = $this->getRequestParameter('id');
		if (!$commentId)
		{
			return sfView::NONE;
		}
			
		$comment = sfCommentPeer::retrieveByPK($commentId);
		$comment->delete();

		return sfView::SUCCESS;
	}
}
