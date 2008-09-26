<?php

	function gravatar_tag($email, $size = 80, $options = array())
	{
		$grav_url = "http://www.gravatar.com/avatar/".md5($email).'?s='.$size;
		return image_tag($grav_url, $options);
	}

	/**
	 * Retorna el c贸digo html de una imagen del thumbnail de un juego
	 *
	 * @param Game $game juego del que se desea imprimir su thumbnail
	 * @param Array $options opciones que se pasar谩n a la funci贸n image_tag de symfony
	 * @return string c贸digo html de una imagen del thumbnail de un juego
	 */
	function gameThumbnail_tag($game, $options = array())
	{
		$imageUrl = '/' . $game->getUploadDirName() . '/' . 'thumb_' . $game->getThumbnailPath();
		return image_tag($imageUrl, $options);
	}
	
	/**
	 * Retorna el c贸digo html de una imagen del thumbnail de un grupo
	 *
	 * @param Group $group grupo del que se desea imprimir su thumbnail
	 * @param Array $options opciones que se pasar谩n a la funci贸n image_tag de symfony
	 * @return string c贸digo html de una imagen del thumbnail de un grupo
	 */
	function groupThumbnail_tag($group, $options = array())
	{
		$imageUrl = '/' . $group->getUploadDirName() . '/' . 'thumb_' . $group->getThumbnailPath();
		return image_tag($imageUrl, $options);
	}
	
	/**
	 * Retorna el c贸digo html de una imagen del thumbnail de una competici髇
	 *
	 * @param Competition $competition Competici髇 de la que se desea imprimir su thumbnail
	 * @param Array $options opciones que se pasar谩n a la funci贸n image_tag de symfony
	 * @return string c贸digo html de una imagen del thumbnail de una competici髇
	 */
	function competitionThumbnail_tag($competition, $options = array())
	{
		$imageUrl = '/' . $competition->getUploadDirName() . '/' . 'thumb_' . $competition->getThumbnailPath();
		return image_tag($imageUrl, $options);
	}
	