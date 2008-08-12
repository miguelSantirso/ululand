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
		$linkText = $customText == "" ? $sfGuardUserProfile->getUsername() : $customText;
		return link_to($linkText, "profile/show?username=".$sfGuardUserProfile->getUsername(), $options);
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
		$linkText = $customText == "" ? $sfGuardUserProfile->getUsername() : $customText;
		$grav_url = "http://www.gravatar.com/avatar/".md5($sfGuardUserProfile->getSfGuardUser()->getUsername()).'?s='.$size;
		
	    return link_to(image_tag($grav_url, array('style' => 'border: 0; float: left;')) . '&nbsp;' . $sfGuardUserProfile->getUsername(), 
	    		"profile/show?username=".$sfGuardUserProfile->getUsername(), 
	    		$options);
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
		return link_to($linkText, "collaboration/show?id=".$collaborationOffer->getId(), $options);
	}