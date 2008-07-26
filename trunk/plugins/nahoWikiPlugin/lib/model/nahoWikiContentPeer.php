<?php

/**
 * Subclass for performing query and update operations on the 'sf_simple_wiki_content' table.
 *
 * 
 *
 * @package plugins.nahoWikiPlugin.lib.model
 */

require_once sfConfig::get('sf_plugins_dir') . '/nahoWikiPlugin/lib/model/plugin/PluginnahoWikiContentPeer.php';
require_once sfConfig::get('sf_plugins_dir') . '/sfTextilePlugin/lib/sfTextile.class.php';
class nahoWikiContentPeer extends PluginnahoWikiContentPeer
{
  public static function doConvert($content)
  {
    // Return converted $content from Wiki-syntax to XHTML
    // Default behaviour is : return sfMarkdown::doConvert($content)
    return sfTextile::doConvert($content);
  }
}
