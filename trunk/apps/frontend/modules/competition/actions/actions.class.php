<?php

/**
 * competition actions.
 *
 * @package    ululand
 * @subpackage competition
 * @author     Pncil.com <http://pncil.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class competitionActions extends sfActions
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
