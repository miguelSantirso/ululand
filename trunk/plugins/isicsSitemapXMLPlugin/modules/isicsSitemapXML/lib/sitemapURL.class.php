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

class sitemapURL
{

  protected $loc        = null;
  protected $lastmod    = null;
  protected $changefreq = null;
  protected $priority   = null;
  
  public function __construct($loc, $lastmod = null, $changefreq = null, $priority = null)
  {
    $this->loc = $loc;
    if ($lastmod !== null)
    {
      $this->lastmod = $lastmod;
    }
    if ($changefreq !== null)
    {
      $this->changefreq = $changefreq;
    }
    if ($priority !== null)
    {
      $this->priority = (float) $priority;
    }
  }
  
  public function getChangefreq()
  {
    return $this->changefreq;
  }
  
  public function getLastmod()
  {
    return $this->lastmod;
  }
  
  public function getLoc()
  {
    return $this->loc;
  }
  
  public function getPriority()
  {
    return $this->priority;
  }
  
  public function setChangefreq($changefreq)
  {
    $this->changefreq = $changefreq;
  }
  
  public function setLastmod($lastmod)
  {
    $this->lastmod = $lastmod;
  }
  
  public function setLoc($loc)
  {
    $this->loc = $loc;
  }
  
  public function setPriority($priority)
  {
    $this->priority = $priority;
  }
  
}