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


  // Path to this plugin
  sfConfig::set(  'sf_textile_plugin_dir', sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'sfTextilePlugin');

  // Path to PHP Textile parser library
  // See http://www.michelf.com/projects/php-markdown/
  sfConfig::set(  'sf_textile_parser_lib', sfConfig::get('sf_textile_plugin_dir').DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'classTextile.php');
