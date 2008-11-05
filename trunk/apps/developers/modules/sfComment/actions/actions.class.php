<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfPropelActAsCommentableBehaviorPlugin/modules/sfComment/lib/BasesfCommentActions.class.php');

/**
 * Acciones que extienden a las del plugin "sfPropelActAsCommentableBehaviorPlugin". Habilita la eliminación de comentarios
 * 
 * @package    ululand
 * @subpackage sfComment 
 * @author     Pncil.com <http://pncil.com>
 */
class sfCommentActions extends BasesfCommentActions
{
	/**
	 * Acción que habilita la opción de eliminar comentarios 
	 *
	 */
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
