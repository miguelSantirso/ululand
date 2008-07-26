<?php

/**
 * sfTextilePlugin - A Symfony Plugin for parsing and dealing with Textile syntax
 *
 * This file is part of the sfTextilePlugin package.
 * (c) 2007 Manuel Dalla Lana <manuel@sonsof.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP versions 5
 *
 * @category        Plugins
 * @package         sfTextile
 * @author          Manuel Dalla Lana <manuel@sonsof.net>
 * @copyright       2007 The Authors
 * @license         http://www.symfony-project.com/content/license.html
 * @version         SVN: $Id$
 */


/**
 * @see sfTextileException
 */
require_once 'sfTextileException.class.php';

/**
 * @see Textile
 */
require_once sfConfig::get('sf_textile_parser_lib');

/**
 * sfTextile is the core class of sfTextile plugin.
 *
 * TextilePHP are developed by Jim Riggs.
 * See http://jimandlissa.com/project/textilephp for more details and documentation.
 *
 * @category        Plugins
 * @package         sfTextile
 * @author          Manuel Dalla Lana <manuel@sonsof.net>
 * @copyright       2007 The Authors
 * @license         http://www.symfony-project.com/content/license.html
 */
class sfTextile extends Textile
{
  /**
   * Class constructor
   *
   * @return  void
   */
  /*public function __construct()
  {
    // call parent constructor
    parent::$class();
  }*/

  /**
   * Class destructor
   *
   * @return  void
   */
  public function __destruct()
  {
  }

  /**
   * Convert text to HTML
   *
   * This function converts given markdown text to HTML.
   *
   * @param   string  $text
   * @return  string
   */
  public function convert($text)
  {
    // parse, convert and return
    return $this->TextileThis($text);
  }

  /**
   * Convert file to HTML
   *
   * This function converts the content of given file to HTML.
   * The file, obviously, should contain only Textile text.
   *
   * @param   string  $file
   * @return  string
   * @throws  sfTextileException if $file isn't readable
   */
  public function convertFile($file)
  {
    // check whether file is readable
    if (!is_readable($file))
    {
      throw new sfTextileException("Unable to read file '$file'");
    }

    $text = file_get_contents($file);

    // convert
    return $this->TextileThis($text);
  }

  /**
   * Returns a Textile Parser instance
   *
   * @return  mixed   Textile parser instance
   */
  public static function getParserInstance()
  {
    static $parser;
    static $class = __CLASS__;

    // get parser instance
    if (!($parser instanceof $class))
    {
      $parser = new $class;
    }

    return $parser;
  }

  /**
   * Convert text to HTML
   *
   * This function converts given textile text to HTML.
   * It's just a convenient static shortcut for sfTextile::convert()
   *
   * @param   string  $text
   * @return  string
   * @see     sfTextile::convert()
   * @static
   */
  public static function doConvert($text)
  {
    $parser = self::getParserInstance();

    // parse, convert and return
    return $parser->TextileThis($text);
  }

  /**
   * Convert file to HTML
   *
   * This function converts the content of given file to HTML.
   * The file, obviously, should contain only Textile text.
   * It's just a convenient static shortcut for sfTextile::convertFile()
   *
   * @param   string  $file
   * @return  string
   * @throws  sfTextileException if $file isn't readable
   * @see     sfTextile::convertFile()
   * @static
   */
  public static function doConvertFile($file)
  {
    $parser = self::getParserInstance();

    // convert
    return $parser->convertFile($file);
  }
}