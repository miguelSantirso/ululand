<?php

/**
 * item actions.
 *
 * @package    PFC
 * @subpackage item
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class itemActions extends autoitemActions
{
	
	/**
	 * Acción necesaria para que se borre la imagen asociada al ítem al realizar la acción delete personalizada
	 *
	 */
	public function executeCustomDelete()
	{
		$c = new Criteria();
		$c->add( ItemPeer::ID, $this->getRequestParameter('id') );
		$item = ItemPeer::doSelect( $c );
		$url = $item[0]->getUrl();
		unlink($item->getImageHref());
		$this->executeDelete();
	}
}
