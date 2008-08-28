<?php

	/**
	 * Retorna el c�digo html de un enlace al perfil del usuario pasado como par�metro
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
	 * Retorna el c�digo html de un enlace al perfil del usuario pasado como par�metro, incluyendo el gravatar
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
	
	/**
	 * Retorna el c�digo html de un enlace al men� de edici�n de la receta pasada como par�metro
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