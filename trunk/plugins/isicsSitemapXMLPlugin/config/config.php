<?php
/* 
 * This file is part of the isicsSitemapXMLPlugin package.
 * 
 * Copyright 2007-2008 ISICS.fr <contact@isics.fr>
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
 
if (in_array('isicsSitemapXML', sfConfig::get('sf_enabled_modules')) && sfConfig::get('app_isicsSitemapXML_route_register', true))
{
  $r = sfRouting::getInstance();
  $r->prependRoute('isics_sitemap_xml', '/sitemap.xml', array('module' => 'isicsSitemapXML', 'action' => 'index'));
}