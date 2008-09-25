<?php

	/**
	 * Retorna el código html de un enlace al perfil del usuario pasado como par�metro
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace al perfil pasado como par�metro
	 */
	function linkToProfile($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $sfGuardUserProfile : $customText;
		return link_to($linkText, "profile/show?username=".$sfGuardUserProfile->getUsername(), $options);
	}
	
	/**
	 * Retorna el c�digo html de un enlace al perfil del usuario pasado como par�metro
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace al perfil pasado como par�metro
	 */
	function linkToCommentProfile($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('comment this profile') : $customText;
		return link_to($linkText, "profile/show?username=".$sfGuardUserProfile->getUsername()."#postComment", $options);
	}
	
	/**
	 * Retorna el c�digo html de un enlace al men� de edici�n del perfil del usuario pasado como par�metro
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace al perfil pasado como par�metro
	 */
	function linkToEditProfile($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('edit') : $customText;
		return link_to($linkText, "profile/edit?username=".$sfGuardUserProfile->getUsername(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al perfil del usuario pasado como par�metro, incluyendo el gravatar
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param int $size tama�o del gravatar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace al perfil pasado como par�metro
	 */
	function linkToProfileWithGravatar($sfGuardUserProfile, $size = 80, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $sfGuardUserProfile : $customText;
		$grav_url = "http://www.gravatar.com/avatar/".md5($sfGuardUserProfile->getSfGuardUser()->getUsername()).'?s='.$size;
		$imageTag = image_tag($grav_url, array('alt' => $sfGuardUserProfile, 'title' => $sfGuardUserProfile));
		$linkText = '<span class="gravatar">'.$imageTag.'</span>'.$linkText;
		
		return '<span class="linkToProfileWithGravatar">'.linkToProfile($sfGuardUserProfile, $options, $linkText ).'</span>';
	}
	
	
	/**
	 * Retorna el c�digo html de un enlace a la oferta de colaboraci�n pasada como par�metro
	 *
	 * @param CollaborationOffer $collaborationOffer Oferta de colaboraci�n a la que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace a la oferta de colaboraci�n pasada como par�metro
	 */
	function linkToCollaborationOffer($collaborationOffer, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $collaborationOffer->getTitle() : $customText;
		return link_to($linkText, "collaboration/show?stripped_title=".$collaborationOffer->getStrippedTitle(), $options);
	}
	
	function linkToCollaborationOffersByUser($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? sprintf(__('list %s\'s collaboration offers'), $sfGuardUserProfile->getUsername()) : $customText;
		return link_to($linkText, "collaboration/list?filterByUsername=".$sfGuardUserProfile->getUsername(), $options);
	}
	
	/**
	 * Retorna el c�digo html de un enlace a la oferta de colaboraci�n pasada como par�metro
	 *
	 * @param CollaborationOffer $collaborationOffer Oferta de colaboraci�n a la que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace a la oferta de colaboraci�n pasada como par�metro
	 */
	function linkToEditCollaborationOffer($collaborationOffer, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $collaborationOffer->getTitle() : $customText;
		return link_to($linkText, "collaboration/edit?stripped_title=".$collaborationOffer->getStrippedTitle(), $options);
	}
	
	/**
	 * Retorna el c�digo html de un enlace a la receta pasada como par�metro
	 *
	 * @param CodePiece $recipe Receta a la que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace a la oferta de colaboraci�n pasada como par�metro
	 */
	function linkToRecipe($recipe, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $recipe->getTitle() : $customText;
		return link_to($linkText, "recipe/show?stripped_title=".$recipe->getStrippedTitle(), $options);
	}
	
	function linkToRecipesByUser($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? sprintf(__('list %s\'s recipes'), $sfGuardUserProfile->getUsername()) : $customText;
		return link_to($linkText, "recipe/list?filterByUsername=".$sfGuardUserProfile->getUsername(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al men� de edici�n de la receta pasada como par�metro
	 *
	 * @param CodePiece $recipe Receta a la que se desea enlazar
	 * @param array $options opciones que se a�adir�n al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string c�digo html del enlace a la oferta de colaboraci�n pasada como par�metro
	 */
	function linkToEditRecipe($recipe, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $recipe->getTitle() : $customText;
		return link_to($linkText, "recipe/edit?stripped_title=".$recipe->getStrippedTitle(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al grupo pasado como parámetro
	 *
	 * @param Group $group Grupo al que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al grupo pasado como parámetro
	 */
	function linkToGroup($group, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $group->getName() : $customText;
		return link_to($linkText, "group/show?id=".$group->getId(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al grupo pasado como parámetro, incluyendo el thumbnail
	 *
	 * @param Group $group Grupo al que se desea enlazar
	 * @param int $size Tamaño del thumbnail
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al grupo pasado como parámetro
	 */
	function linkToGroupWithThumbnail($group, $size = 100, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $group->getName() : $customText;
		$imageTag = groupThumbnail_tag($group, array('alt' => $group, 'title' => $group, 'width' => $size));
		$linkText = '<span class="gravatar">'.$imageTag.'</span>'.$linkText;
		
		return '<span class="linkToProfileWithGravatar">'.linkToGroup($group, $options, $linkText ).'</span>';
	}
	
	/**
	 * Retorna el código html de un enlace al juego pasado como parámetro
	 *
	 * @param Game $game Juego al que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al grupo pasado como parámetro
	 */
	function linkToGame($game, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $game->getName() : $customText;
		return link_to($linkText, "game/show?stripped_name=".$game->getStrippedName(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al juego pasado como parámetro, incluyendo el thumbnail
	 *
	 * @param Game $game Juego al que se desea enlazar
	 * @param int $size Tamaño del thumbnail
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al grupo pasado como parámetro
	 */
	function linkToGameWithThumbnail($game, $size = 100, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $game->getName() : $customText;
		$imageTag = gameThumbnail_tag($game, array('alt' => $game, 'title' => $game, 'width' => $size));
		$linkText = '<span class="gravatar">'.$imageTag.'</span>'.$linkText;
		
		return '<span class="linkToProfileWithGravatar">'.linkToGame($game, $options, $linkText ).'</span>';
	}
	
	
	/**
	 * Retorna el código html de un enlace al menú de edición del juego pasado como parámetro
	 *
	 * @param Game $game Juego al que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al grupo pasado como parámetro
	 */
	function linkToEditGame($game, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('edit') : $customText;
		return link_to($linkText, "game/edit?stripped_name=".$game->getStrippedName(), $options);
	}
	
	function linkToGamesByUser($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? sprintf(__('list %s\'s games'), $sfGuardUserProfile->getUsername()) : $customText;
		return link_to($linkText, "game/list?filterByUsername=".$sfGuardUserProfile->getUsername(), $options);
	}

	/**
	 * Retorna un enlace a la release pasada como parámetro
	 *
	 * @param GameRelease $gameRelease
	 * @param array $options
	 * @param string $customText
	 * @return string
	 */
	function linkToGameRelease($gameRelease, $options = array(), $customText = "")
	{
		$linkText = "";
		if($customText == "" && !$gameRelease->getIsPublic())
			$linkText = image_tag('lock.png', array('title' => __('This version is private'), 'alt' => __('This version is private')));
		
		$linkText .= $customText == "" ? $gameRelease->getName() : $customText;
		$game = $gameRelease->getGame();
		return link_to($linkText, "gameRelease/show?game_stripped_name=".$game->getStrippedName()."&release_stripped_name=".$gameRelease->getStrippedName(), $options);
	}
	
	/**
	 * Retorna un enlace a la pantalla de edición de la release pasada como parámetro
	 *
	 * @param GameRelease $gameRelease
	 * @param array $options
	 * @param string $customText
	 * @return string
	 */
	function linkToEditGameRelease($gameRelease, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('edit') : $customText;
		$game = $gameRelease->getGame();
		return link_to($linkText, "gameRelease/edit?game_stripped_name=".$game->getStrippedName()."&release_stripped_name=".$gameRelease->getStrippedName(), $options);
	}
	
	/**
	 * Retorna un enlace a la pantalla de creación de una release del juego pasado como parámetro
	 *
	 * @param Game $game del que se creará la nueva release
	 * @param array $options
	 * @param string $customText
	 * @return string
	 */
	function linkToCreateGameRelease($game, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('upload new version') : $customText;
		return link_to($linkText, "gameRelease/create?game_stripped_name=".$game->getStrippedName(), $options);
	}