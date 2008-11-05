<?php

/**
 * widget actions.
 *
 * @package    ululand
 * @subpackage widget
 * @author     Pncil.com <http://pncil.com>
 */
class widgetActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
}
