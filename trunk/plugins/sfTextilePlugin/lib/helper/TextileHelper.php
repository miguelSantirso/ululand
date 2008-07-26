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
   * Convert Textile text to HTML
   *
   * @param   string  $text
   * @return  string
   * @see     sfTextile::doConvert()
   */
  function convert_textile_text($text)
  {
    return sfTextile::doConvert($text);
  }

  /**
   * Convert Textile file content to HTML
   *
   * @param   string  $file
   * @return  string
   * @see     sfTextile::doConvertFile()
   */
  function convert_textile_file($file)
  {
    return sfTextile::doConvertFile($file);
  }

  /**
   * Converts Textile text to HTML and prints returned data
   *
   * @param   string  $text
   * @return  void
   * @see     convert_textile_text()
   * @see     sfTextile::doConvert()
   */
  function include_textile_text($text)
  {
    echo convert_textile_text($text);
  }

  /**
   * Converts Textile file content to HTML and prints returned data
   *
   * @param   string  $file
   * @return  string
   * @see     convert_textile_file()
   * @see     sfTextile::doConvertFile()
   */
  function include_textile_file($file)
  {
    echo convert_textile_file($file);
  }