<?php
/**
 * Clase que añade todas las urls de este módulo al sitemap.xml
 *
 */
class profileSitemapGenerator implements sitemapGenerator
{
	public static function generate()
	{
		$urls = array();

		$c = new Criteria();
		$players = PlayerProfilePeer::doSelect($c);

		foreach ($players as $player)
		{
			$urls[] = new sitemapURL('@user_show?username=' . $player->getsfGuardUserProfile()->getUsername());
		}

		return $urls;
	}
}