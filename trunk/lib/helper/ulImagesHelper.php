<?php

	function gravatar_tag($email, $size = 80, $options = array())
	{
		$grav_url = "http://www.gravatar.com/avatar/".md5($email).'?s='.$size;
		return image_tag($grav_url, $options);
	}

	/**
	 * Retorna el código html de una imagen del thumbnail de un juego
	 *
	 * @param Game $game juego del que se desea imprimir su thumbnail
	 * @param Array $options opciones que se pasarán a la función image_tag de symfony
	 * @return string código html de una imagen del thumbnail de un juego
	 */
	function gameThumbnail_tag($game, $options = array())
	{
		$imageUrl = '/' . $game->getUploadDirName() . '/' . 'thumb_' . $game->getThumbnailPath();
		return image_tag($imageUrl, $options);
	}
	
	/**
	 * Retorna el código html de una imagen del thumbnail de un grupo
	 *
	 * @param Group $group grupo del que se desea imprimir su thumbnail
	 * @param Array $options opciones que se pasarán a la función image_tag de symfony
	 * @return string código html de una imagen del thumbnail de un grupo
	 */
	function groupThumbnail_tag($group, $options = array())
	{
		$imageUrl = '/' . $group->getUploadDirName() . '/' . 'thumb_' . $group->getThumbnailPath();
		return image_tag($imageUrl, $options);
	}
	