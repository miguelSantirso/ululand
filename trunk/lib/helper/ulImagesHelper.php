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
		return image_tag(ulToolkit::getBaseUrl().'/'.$imageUrl, $options);
	}
	
		/**
	 * Retorna el código html de la imagen de una pieza de avatar
	 *
	 * @param AvatarPiece $avatarPiece Pieza de avatar de la que se desea obtener su imagen
	 * @param Array $options opciones que se pasarán a la función image_tag de symfony
	 * @return string código html de una imagen de una pieza de avatar
	 */
	function avatarPiece_tag($avatarPiece, $options = array())
	{
		$sf_upload_dir = sfConfig::get('sf_upload_dir_name');
		$app_dir_AvatarPiece = sfConfig::get('app_dir_avatarPiece');
		$imageUrl = "/{$sf_upload_dir}/{$app_dir_AvatarPiece}/{$avatarPiece->getUrl()}";
		
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
	
	/**
	 * Retorna el código html de una imagen del thumbnail de una competici�n
	 *
	 * @param Competition $competition Competici�n de la que se desea imprimir su thumbnail
	 * @param Array $options opciones que se pasarán a la función image_tag de symfony
	 * @return string código html de una imagen del thumbnail de una competici�n
	 */
	function competitionThumbnail_tag($competition, $options = array())
	{
		$imageUrl = '/' . $competition->getUploadDirName() . '/' . 'thumb_' . $competition->getThumbnailPath();
		return image_tag($imageUrl, $options);
	}
	