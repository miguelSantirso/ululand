<?php
// auto-generated by sfPropelCrud
// date: 2008/08/07 20:31:37
?>
<?php

/**
 * collaborations actions for components.
 *
 * @package    ululand
 * @subpackage collaborations
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class collaborationComponents extends sfComponents
{
	public function executeList()
	{
		$this->collaboration_offers = CollaborationOfferPeer::doSelect(new Criteria());
	}
}
