<?php

	/**
	 * Retorna el código html de un enlace al perfil del usuario pasado como parámetro
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al perfil pasado como parámetro
	 */
	function linkToProfile($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $sfGuardUserProfile : $customText;
		return link_to($linkText, "profile/show?username=".$sfGuardUserProfile->getUsername(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al perfil del usuario pasado como parámetro
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al perfil pasado como parámetro
	 */
	function linkToCommentProfile($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('comment this profile') : $customText;
		return link_to($linkText, "profile/show?username=".$sfGuardUserProfile->getUsername()."#postComment", $options);
	}
	
	/**
	 * Retorna el código html de un enlace al menú de edición del perfil del usuario pasado como parámetro
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al perfil pasado como parámetro
	 */
	function linkToEditProfile($sfGuardUserProfile, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? __('edit') : $customText;
		return link_to($linkText, "profile/edit?username=".$sfGuardUserProfile->getUsername(), $options);
	}
	
		/**
	 * Retorna el código html de un enlace al perfil del usuario pasado como parámetro, incluyendo el gravatar
	 *
	 * @param sfGuardUserProfile $sfGuardUserProfile Perfil al que se desea enlazar
	 * @param int $size tamaño del gravatar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace al perfil pasado como parámetro
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
	 * Retorna el código html de un enlace a la oferta de colaboración pasada como parámetro
	 *
	 * @param CollaborationOffer $collaborationOffer Oferta de colaboración a la que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace a la oferta de colaboración pasada como parámetro
	 */
	function linkToCollaborationOffer($collaborationOffer, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $collaborationOffer->getTitle() : $customText;
		return link_to($linkText, "collaboration/show?stripped_title=".$collaborationOffer->getStrippedTitle(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace a la oferta de colaboración pasada como parámetro
	 *
	 * @param CollaborationOffer $collaborationOffer Oferta de colaboración a la que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace a la oferta de colaboración pasada como parámetro
	 */
	function linkToEditCollaborationOffer($collaborationOffer, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $collaborationOffer->getTitle() : $customText;
		return link_to($linkText, "collaboration/edit?stripped_title=".$collaborationOffer->getStrippedTitle(), $options);
	}
	
	
	/**
	 * Retorna el código html de un enlace a la receta pasada como parámetro
	 *
	 * @param CodePiece $recipe Receta a la que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace a la oferta de colaboración pasada como parámetro
	 */
	function linkToRecipe($recipe, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $recipe->getTitle() : $customText;
		return link_to($linkText, "recipe/show?stripped_title=".$recipe->getStrippedTitle(), $options);
	}
	
	/**
	 * Retorna el código html de un enlace al menú de edición de la receta pasada como parámetro
	 *
	 * @param CodePiece $recipe Receta a la que se desea enlazar
	 * @param array $options opciones que se añadirán al link_to
	 * @param string $customText Texto personalizado para el enlace
	 * @return string código html del enlace a la oferta de colaboración pasada como parámetro
	 */
	function linkToEditRecipe($recipe, $options = array(), $customText = "")
	{
		$linkText = $customText == "" ? $recipe->getTitle() : $customText;
		return link_to($linkText, "recipe/edit?stripped_title=".$recipe->getStrippedTitle(), $options);
	}