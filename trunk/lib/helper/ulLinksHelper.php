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
		$linkText = $customText == "" ? $sfGuardUserProfile->getUsername() : $customText;
		return link_to($linkText, "profile/show?username=".$sfGuardUserProfile->getUsername(), $options);
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
		$linkText = $customText == "" ? $sfGuardUserProfile->getUsername() : $customText;
		$grav_url = "http://www.gravatar.com/avatar/".md5($sfGuardUserProfile->getSfGuardUser()->getUsername()).'?s='.$size;
		
	    return link_to(image_tag($grav_url, array('style' => 'border: 0; float: left;')) . '&nbsp;' . $sfGuardUserProfile->getUsername(), 
	    		"profile/show?username=".$sfGuardUserProfile->getUsername(), 
	    		$options);
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
		return link_to($linkText, "collaboration/show?title=".$collaborationOffer->getTitle(), $options);
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
		return link_to($linkText, "collaboration/edit?title=".$collaborationOffer->getTitle(), $options);
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
		return link_to($linkText, "recipe/show?id=".$recipe->getId(), $options);
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
		return link_to($linkText, "recipe/edit?id=".$recipe->getId(), $options);
	}