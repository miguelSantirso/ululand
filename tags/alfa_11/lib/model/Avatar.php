<?php

/**
 * Subclass for representing a row from the 'avatar' table.
 *
 *
 *
 * @package lib.model
 */
class Avatar extends BaseAvatar
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

	public function setProfile($v)
	{
		$this->setsfGuardUserProfile($v);		
	}
	public function getProfile()
	{
		$this->getsfGuardUserProfile();		
	}
	
	public function setGender($value)
	{
		parent::setGender(AvatarPeer::getGenderFromValue($value));
	}

	public function getGender()
	{
		return AvatarPeer::getGenderFromIndex(parent::getGender());
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
	
	// Retorna una lista con los grupos del avatar
	public function getGroups()
	{
		// Obtener todas las relaciones de grupo en las que participa el avatar
		$groupships = Avatar::getAvatar_Groups();
		//$groupships = array_merge($groupships, Avatar::getAvatar_Groups());

		$groups = Array();
		foreach($groupships as $groupship) // Para cada relaci�n
		{
					$groups[] = $groupship->getGroup();
		}
		return $groups;
	}
	
	/**
	 * Retorna una lista con los amigos del avatar
	 *
	 * @return array con los amigos del avatar
	 */
	public function getFriends()
	{
		// Obtener todas las relaciones de amistad en las que participa el avatar
		$friendships = Avatar::getFriendshipsRelatedByIdAvatarA();
		$friendships = array_merge($friendships, Avatar::getFriendshipsRelatedByIdAvatarB());

		$friends = Array();
		foreach($friendships as $friendship) // Para cada relaci�n
		{
			// Si est� confirmado por las dos partes
			if($friendship->getAConfirmed() && $friendship->getBConfirmed())
			{
				// A�adir solo a los amigo. No queremos agregar al avatar $this
				if($friendship->getIdAvatarA() != $this->getId())
				{
					$friends[] = $friendship->getAvatarA();
				}
				else
				{
					$friends[] = $friendship->getAvatarB();
				}
			}
		}
		return $friends;
	}
	
	/**
	 * Retorna el número de amigos
	 *
	 * @return int Número de amigos del avatar
	 */
	public function getFriendsNumber()
	{
		return count($this->getFriends());
	}
	
	/**
	 * Retorna una lista con los amigos no confirmados del avatar 
	 *
	 * @return array con los amigos del avatar
	 */
	public function getNotConfirmedFriends()
	{
		// Obtener todas las relaciones de amistad en las que participa el avatar
		$friendships = Avatar::getFriendshipsRelatedByIdAvatarA();
		$friendships = array_merge($friendships, Avatar::getFriendshipsRelatedByIdAvatarB());

		$friends = Array();
		foreach($friendships as $friendship)
		{
			// A�adir solo a los amigo. No queremos agregar al avatar $this
			if($friendship->getIdAvatarA() != $this->getId())
			{
				// Las relaciones que nos valen son aquellas que el amigo ha confirmado y $this todav�a no.
				if($friendship->getAConfirmed() && !$friendship->getBConfirmed())
				{
					$friends[] = $friendship->getAvatarA();
				}
			}
			else
			{
				// Las relaciones que nos valen son aquellas que el amigo ha confirmado y $this todav�a no.
				if(!$friendship->getAConfirmed() && $friendship->getBConfirmed())
				{
					$friends[] = $friendship->getAvatarB();
				}
			}
		}
		return $friends;
	}

	
	/**
	 * Retorna los mensajes recibidos por el avatar
	 *
	 * @return array de mensajes recibidos por el avatar
	 */
	public function getReceivedMessages()
	{
		return $this->getMessagesRelatedByIdRecipient();
	}
	
	
	/**
	 * Retorna la cantidad total de mensajes recibidos por el avatar 
	 *
	 * @return número de mensajes recibidos por el usuario
	 */
	public function getReceivedMessagesNumber()
	{
		return count($this->getMessagesRelatedByIdRecipient());
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
	 * Sobreescribe la función save de la clase padre.
	 * Simplemente añade un api_key en caso de que no exista y llama a la función de la clase padre
	 *
	 * @param unknown_type $con
	 */
	public function save($con = null)
	{	
		if(!$this->getApiKey())
		{
			$this->setApiKey(AvatarPeer::generateApiKey());
		}
		parent::save($con);
	}

	/**
	 * Retorna los últimos gamestats obtenidos por el avatar
	 *
	 * @param int $limit número máximo de gamestats que se retornarán, 
	 * @return array de gamestats ordenados inversamente por la fecha de creación y limitados al número pasado como parámetro
	 */
	public function getLatestGamestats($limit = 0)
	{
		$c = new Criteria();
		if($limit > 0)
			$c->setLimit($limit);
		$c->add(GameStat_AvatarPeer::AVATAR_ID, $this->getId());
		$c->addDescendingOrderByColumn(GameStat_AvatarPeer::CREATED_AT);
		
		return Gamestat_AvatarPeer::doSelect($c);
	}
}
