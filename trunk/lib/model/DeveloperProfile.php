<?php

/**
 * Subclass for representing a row from the 'developer_profile' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DeveloperProfile extends BaseDeveloperProfile
{
	public function __toString()
	{
		$this->getsfGuardUserProfile()->__toString();		
	}
	
	/**
	 * Retorna el número de juegos enviados al sistema
	 *
	 */
	public function getNbGames()
	{
		$c = new Criteria();
		$c->add(GamePeer::CREATED_BY, $this->getsfGuardUserProfile()->getsfGuardUser()->getId());
		return GamePeer::doCount($c);
	}
	
	/**
	 * Retorna el número de recetas enviadas al Cookbook de código flash
	 *
	 */
	public function getNbRecipes()
	{
		$c = new Criteria();
		$c->add(CodePiecePeer::CREATED_BY, $this->getsfGuardUserProfile()->getsfGuardUser()->getId());
		return CodePiecePeer::doCount($c);
	}
	
	/**
	 * Retorna el número de ofertas de colaboración enviadas
	 *
	 */
	public function getNbCollaborations()
	{
		$c = new Criteria();
		$c->add(CollaborationOfferPeer::CREATED_BY, $this->getsfGuardUserProfile()->getsfGuardUser()->getId());
		return CollaborationOfferPeer::doCount($c);
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
	 * Retorna una cadena con todos los tags del objeto separados por comas.
	 *
	 * @todo Buscar la forma de que esta función esté en el ámbito del plugin en lugar de en el de cada clase
	 * @return Cadena con todos los tags del objeto separados por comas.
	 */
	public function getTagsString()
	{
		$tags = $this->getTags();
		$tagsString = "";
		foreach($tags as $tag)
		{
			$tagsString .= $tag; 
			$tagsString .= ", ";
		}
		
		return trim($tagsString, " ,");
	}
	
	public function getLinkedTagsString()
	{
		$tags = $this->getTags();
		$tagsString = "";
		foreach($tags as $tag)
		{
			$tagsString .= link_to($tag, 'profile/list?tag='.$tag);
			$tagsString .= ', ';
		}
		
		return trim($tagsString, " ,");
	}
}

sfPropelBehavior::add('DeveloperProfile', array('sfPropelActAsTaggableBehavior'));
sfPropelBehavior::add('DeveloperProfile', array('sfPropelActAsCountableBehavior'));
sfPropelBehavior::add('DeveloperProfile', array('sfPropelActAsCommentableBehavior'));