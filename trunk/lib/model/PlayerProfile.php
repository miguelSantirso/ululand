<?php

/**
 * Subclass for representing a row from the 'player_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PlayerProfile extends BasePlayerProfile
{
/**
	 * __toString: Función auxiliar "mágica" que retorna una cadena que representa al objeto.
	 *
	 * @return string Cadena representando al objeto
	 **/
	public function __toString()
	{
		return $this->name;
	}
	
// Retorna una lista con los grupos del jugador
	public function getGroups()
	{
		// Obtener todas las relaciones de grupo en las que participa el jugador
		$groupships = PlayerProfile::getPlayerProfile_Groups();

		$groups = Array();
		foreach($groupships as $groupship) // Para cada relaci�n
		{
					$groups[] = $groupship->getGroup();
		}
		return $groups;
	}
	
/**
	 * Retorna un enlace al perfil del avatar
	 *
	 * @todo ¿esto quizás estaría mejor en un helper?
	 * 
	 * @return enlace al perfil del avatar formateado correctamente
	 */
	public function getProfileLink()
	{
		return (
			'<span class="extensible">' . 
			link_to($this->getName(), 'profile/show?id='.$this->getId(), array('class' => 'profileLink ' . $this->getGender())) . 
			'<img class="more" src="/images/more.gif" onMouseOver="javascript:swapMoreImage(this, 0);" onClick="javascript:swapMoreImage(this, 1); showMoreMenu(\'' . url_for("/profile/quickActions?id=".$this->getId()) . '\');" onMouseOut="javascript:swapMoreImage(this, 2);" />'.
			'</span>'
			);
	}
}
