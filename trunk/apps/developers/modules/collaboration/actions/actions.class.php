<?php

/**
 * collaborations actions.
 *
 * @package    ululand
 * @subpackage collaborations
 * @author     Pncil.com
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class collaborationActions extends sfActions
{
  public function executeIndex()
  {
  }

  public function executeList()
  {	
		$tag = $this->getRequestParameter('tag');
		if($tag)
		{
			$this->tag = $tag;
		}
		$search = $this->getRequestParameter('search');
		if($search)
		{
			$this->search = $search;
		}
		$filterByUsername = $this->getRequestParameter('filterByUsername');
		if($filterByUsername)
		{
			$this->userFiltered = sfGuardUserProfilePeer::retrieveByUsername($filterByUsername);
		}
  }

  public function executeShow()
  {
  	if($this->getRequestParameter('id'))
	{
		$collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));
		$this->redirect('collaboration/show?stripped_title='.$collaboration_offer->getStrippedTitle());
	}
	else if($this->getRequestParameter('stripped_title'))
	{
		$c = new Criteria();
		$c->add(CollaborationOfferPeer::STRIPPED_TITLE, $this->getRequestParameter('stripped_title'));
		$this->collaboration_offer = CollaborationOfferPeer::doSelectOne($c);
	}
	
    $this->forward404Unless($this->collaboration_offer);
    $this->collaboration_offer->incrementCounter(); // Una visita más
    
    $this->getResponse()->setTitle($this->collaboration_offer->getTitle() . " - " . ulToolkit::__('Collaboration Offers for flash game developers at developers.ululand.com'));
  }

  public function executePreview()
  {
  	$this->title = $this->getRequestParameter('title');
  	$this->description = $this->getRequestParameter('description');
  }
  
  public function executeCreate()
  {
    $this->collaboration_offer = new CollaborationOffer();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    if($this->getRequestParameter('id'))
	{
		$collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));
		$this->redirect('collaboration/edit?stripped_title='.$collaboration_offer->getTitle());
	}
	else if($this->getRequestParameter('stripped_title'))
	{
		$c = new Criteria();
		$c->add(CollaborationOfferPeer::STRIPPED_TITLE, $this->getRequestParameter('stripped_title'));
		$this->collaboration_offer = CollaborationOfferPeer::doSelectOne($c);
	}
	
    $this->forward404Unless($this->collaboration_offer);

    if($this->getUser()->getId() != $this->collaboration_offer->getCreatedBy())
    {
    	$this->setFlash('warning', 'You don\'t have permission to edit this collaboration offer!');
    	$this->redirect('collaboration/show?id='.$this->getRequestParameter('id'));
    }
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $collaboration_offer = new CollaborationOffer();
    }
    else
    {
      $collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($collaboration_offer);
    }

    $collaboration_offer->setTitle($this->getRequestParameter('title'));
    $collaboration_offer->setDescription($this->getRequestParameter('description'));
    $collaboration_offer->setTags($this->getRequestParameter('tags_string'));

    $collaboration_offer->save();

    return $this->redirect('collaboration/show?id='.$collaboration_offer->getId());
  }
  
  public function handleErrorUpdate()
  {
		// @todo mensaje no internacionalizado
		$this->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
		
		if($this->getRequestParameter('id'))
		{
			$redirectTo = 'edit?id='.$this->getRequestParameter('id');
		}
		else
		{
			$redirectTo = 'create';
		}
		return $this->forward('collaboration', $redirectTo);
  }

  public function executeDelete()
  {
    $collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($collaboration_offer);

    $collaboration_offer->delete();

    return $this->redirect('collaboration/list');
  }
}
