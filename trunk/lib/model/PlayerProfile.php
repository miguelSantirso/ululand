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
		return $this->getsfGuardUserProfile()->__toString();		
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
	 * Retorna el número de amigos del jugador
	 *
	 * @return integer número de amigos del jugador
	 */
	public function getNbFriends()
	{
		$c = new Criteria();
		$c->add(FriendshipPeer::IS_CONFIRMED, true);
		return count($this->getFriends($c));		
	}
	
	/**
	 * Retorna el número de grupos a los que pertenece el jugador
	 *
	 * @return Integer número de grupos a los que pertenece el jugador
	 */
	public function getNbGroups()
	{
		$c = new Criteria();
		$c->add(PlayerProfile_GroupPeer::PLAYER_PROFILE_ID, $this->getId());
		
		return PlayerProfile_GroupPeer::doCount($c);
	}
	
	/**
	 * Retorna el número de grupos a los que pertenece el jugador
	 *
	 * @return Integer número de grupos a los que pertenece el jugador
	 */
	public function getNbCompetitions()
	{
		$c = new Criteria();
		$c->add(Competition_PlayerProfilePeer::PLAYER_PROFILE_ID, $this->getId());
		
		return Competition_PlayerProfilePeer::doCount($c);
	}
		
	/**
	 * Retorna el número de comentarios en el perfil
	 *
	 */
	public function getNbCommentsInProfile()
	{
		return count($this->getComments());
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
		//echo $this->getTotalCredits();
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
		//@todo: ¿lanzar un error aquí?
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