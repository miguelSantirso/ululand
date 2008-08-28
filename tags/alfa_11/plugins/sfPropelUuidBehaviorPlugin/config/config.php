<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @package  sfPropelUuidBehaviorPlugin
 * @author   Tristan Rivoallan <tristan@rivoallan.net>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 */

sfPropelBehavior::registerHooks('sfPropelUuidBehavior', array(
  ':save:pre'      => array('sfPropelUuidBehavior', 'preSave'),
));

sfPropelBehavior::registerMethods('sfPropelUuidBehavior', array(
  'getUuid'      => array('sfPropelUuidBehavior', 'getUuid'),
  'setUuid'      => array('sfPropelUuidBehavior', 'setUuid'),
));