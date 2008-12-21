<?php
/* 
 * This file is part of the isicsSitemapXMLPlugin package.
 * 
 * Copyright (C) 2007-2008 ISICS.fr <contact@isics.fr>
 * 
 * isicsSitemapXMLPlugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * isicsSitemapXMLPlugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with isicsSitemapXMLPlugin.  If not, see <http://www.gnu.org/licenses/>.
 */

class BaseisicsSitemapXMLActions extends sfActions
{
  
  /**
   * Define this function to add default urls
   *
   */
  protected function addDefaultUrls()
  {
  }
  
  /**
   * Display sitemap XML (see: www.sitemap.org)
   *
   */
  public function executeIndex()
  {
    $this->urls = array();
    
    // Adding defaults urls
    foreach (sfConfig::get('app_isicsSitemapXML_default_urls', array()) as $url)
    {
      $lastmod    = array_key_exists('lastmod', $url) ? $url['lastmod'] : null;
      $changefreq = array_key_exists('changefreq', $url) ? $url['changefreq'] : null;
      $priority   = array_key_exists('priority', $url) ? $url['priority'] : null;
      
      $this->urls[] = new sitemapURL($url['loc'], $lastmod, $changefreq, $priority);
    }
    $this->addDefaultUrls();    
    
    // Adding modules urls
    foreach (sfConfig::get('app_isicsSitemapXML_modules', array()) as $module)
    {
      // Looking for class in app module
      if (file_exists($path = sfConfig::get('sf_app_module_dir') . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . $module . 'SitemapGenerator.class.php'))
      {
        require_once($path);
      }
      // Looking for class in plugins modules
      else
      {
        $files = glob(sfConfig::get('sf_plugins_dir') . DIRECTORY_SEPARATOR . '*' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . $module . 'SitemapGenerator.class.php');
        if (!empty($files))
        {
          foreach ($files as $file)
          {
            require_once($file);
          }
        }
        // Class not found
        else
        {
          continue;
        }
      }
      
      $this->urls = array_merge($this->urls, call_user_func(array($module . 'SitemapGenerator', 'generate')));
    }
  }
  
}