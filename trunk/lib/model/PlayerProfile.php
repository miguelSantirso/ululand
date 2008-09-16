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
	public function __toString()
	{
		$this->getsfGuardUserProfile()->__toString();		
	}
	
	/**
	 * Retorna una lista con todos los amigos del jugador
	 *
	 * @return unknown
	 */
	public function getFriends($c = null)
	{	
		// Obtener todas las relaciones de jugador con otro jugador iniciadas por �l mismo
		$friendships = $this->getFriendshipsRelatedByPlayerProfileIdA($c);

		$friends = Array();
		foreach($friendships as $friendship) // Para cada relaci�n
		{
					$friends[] = $friendship->getPlayerProfileRelatedByPlayerProfileIdB();
		}
		
		// Obtener todas las relaciones de jugador con otro jugador iniciadas por otro
		$friendships = $this->getFriendshipsRelatedByPlayerProfileIdB($c);

		foreach($friendships as $friendship) // Para cada relaci�n
		{
					$friends[] = $friendship->getPlayerProfileRelatedByPlayerProfileIdA();
		}
		return $friends;
	}
	
	/**
	 * Retorna una lista con todos los grupos del jugador
	 *
	 * @return unknown
	 */
	public function getGroups()
	{
		// Obtener todas las relaciones de grupo en las que participa el jugador
		$groupships = $this->getPlayerProfile_Groups();

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
	
/**
	 * Retorna los créditos disponibles del avatar
	 *
	 * @return ingeger créditos disponibles del avatar
	 */
	public function getAvailableCredits()
	{
		return $this->getTotalCredits() - $this->getSpentCredits();
	}
	
/**
	 * Añade los créditos pasados como parámetro al número total de créditos. Esta función es la forma adecuada de aumentar los créditos disponibles.
	 *
	 * @param number $amount Cantidad de créditos a añadir.
	 * @return number Nueva cantidad de créditos.
	 */
	public function addCredits($amount)
	{
		$totalCredits = $this->setTotalCredits($this->getTotalCredits() + $amount);
		$this->save();
		return $totalCredits;
	}
	
	/**
	 * Añade los créditos correspondientes al tiempo jugado en segundos.
	 *
	 * @param number $secondsPlayed Número de segundos jugados.
	 * @return number Cantidad total de créditos disponibles después de la operación.
	 */
	public function addCreditsForPlayedTime($secondsPlayed)
	{
		if($secondsPlayed > 0)
		{
			return $this->addCredits($secondsPlayed * 0.03);
		}
		//@todo: �lanzar un error aqu�?
		return $this->getTotalCredits();
	}
	
	/**
	 * Añade los créditos pasados como parámetro al número de créditos gastados. Esta función es la forma adecuada de restar créditos a un avatar.
	 *
	 * @param integer $amount Cantidad de créditos a restar al avatar
	 * @return integer Nuevo número de créditos gastados del avatar.
	 */
	public function substractCredits($amount)
	{
		$spentCredits = $this->setSpentCredits($this->getSpentCredits() + $amount);
		$this->save();
		return $spentCredits;
	}
	
}

sfPropelBehavior::add('PlayerProfile', array('sfPropelActAsCommentableBehavior'));
sfPropelBehavior::add('PlayerProfile', array('sfPropelActAsCountableBehavior'));