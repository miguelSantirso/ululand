<?php
/**
 * Clase que añade todas las urls de este módulo al sitemap.xml
 *
 */
class gameSitemapGenerator implements sitemapGenerator
{
	public static function generate()
	{
		$urls = array();

		$c = new Criteria();
		$c->addDescendingOrderByColumn(GamePeer::CREATED_AT);

		$games = GamePeer::doSelect($c);

		foreach ($games as $game)
		{
			if($game->isPublished())
				$urls[] = new sitemapURL('@game_show?stripped_name=' . $game->getStrippedName(), $game->getCreatedAt('c'));
		}

		return $urls;
	}
}