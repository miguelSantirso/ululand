<?php
/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @package  sfPropelUuidBehaviorPlugin
 * @author   Tristan Rivoallan <tristan@rivoallan.net>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 */

/**
 * This behavior adds uuid capabilities to any Propel object.
 * 
 * To enable this behavior add this after Propel stub class declaration :
 * 
 * <code>
 *   sfPropelBehavior::add('MyClass', array('sfPropelUuidBehavior'));
 * </code>
 * 
 * @package  sfPropelUuidBehaviorPlugin
 */
class sfPropelUuidBehavior
{
  /**
   * This hook is called before object is saved. It takes care of generating a new UUID if necessary.
   * 
   * @param      BaseObject    $resource
   */
  public function preSave(BaseObject $resource)
  {
    if (!sfPropelUuidBehaviorToolkit::isUuid($resource->getUuid()))
    {
      $resource->setUuid(sfPropelUuidBehaviorToolkit::generateUuid());
    }
  }

  /**
   * Returns resource UUID. Proxy method to real getter.
   * 
   * @param      BaseObject    $resource
   * @return     string
   */
  public function getUuid(BaseObject $resource)
  {
    $getter = self::forgeMethodName($resource, 'get', 'uuid');
    return $resource->$getter();    
  }

  /**
   * Sets resource UUID. Proxy method to real setter.
   * 
   * @param      BaseObject    $resource
   * @param      string        $uuid
   */
  public function setUuid(BaseObject $resource, $uuid)
  {
    $setter = self::forgeMethodName($resource, 'set', 'uuid');
    return $resource->$setter($uuid);    
  }

  /**
   * Returns getter / setter name for requested column.
   * 
   * @param     BaseObject    $resource
   * @param     string        $prefix     Usually 'get' or 'set'
   * @param     string        $column     uuid|version
   */
  private static function forgeMethodName($resource, $prefix, $column)
  {
    $method_name = sprintf('%s%s', $prefix, 
                                   $resource->getPeer()->translateFieldName(self::getColumnConstant(get_class($resource), $column), 
                                                                            BasePeer::TYPE_COLNAME, 
                                                                            BasePeer::TYPE_PHPNAME));

    return $method_name;
  }

  /**
   * Returns constant value for requested column.
   * 
   * @param     string      $resource_class
   * @param     string      $column
   * @return    string
   */
  private static function getColumnConstant($resource_class, $column)
  {
    $conf_directive = sprintf('propel_behavior_sfPropelUuidBehavior_%s_columns', $resource_class);
    $columns = sfConfig::get($conf_directive);

    return $columns[$column];    
  }
  
  public static function checkConfig($parameters, $class)
  {
    if (isset($parameters['columns']))
    {
      if (!is_array($parameters['columns']))
      {
        $msg = sprintf('{%s} "column" parameter must be an array of propel column constants.', __CLASS__);
        throw new sfConfigurationException($msg);
      }
    }
  }
}
