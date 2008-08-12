<?php

/**
 * collaborations actions.
 *
 * @package    ululand
 * @subpackage collaborations
 * @author     Your name here
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
  }

  public function executeShow()
  {
    $this->collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->collaboration_offer);
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
    $this->collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));
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
		$this->getRequest()->setError("title", 'Prueba de error');
		if($this->getRequestParameter('id'))
		{
			$redirectTo = 'collaboration/edit?id='.$this->getRequestParameter('id');
		}
		else
		{
			$redirectTo = 'collaboration/create';
		}
		return $this->redirect($redirectTo);
  }

}
