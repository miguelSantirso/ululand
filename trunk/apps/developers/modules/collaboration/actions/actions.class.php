<?php

/**
 * collaborations actions.
 *
 * @package    ululand
 * @subpackage collaborations
 * @author     pncil.com <http://pncil.com>
 */
class collaborationActions extends sfActions
{
  /**
   * Ejecuta la acción index
   *
   */
  public function executeIndex()
  {
  }

  /**
   * Ejecuta la acción correspondiente a la lista de colaboraciones
   *
   */
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

  /**
   * Ejecuta la acción correspondiente a la visualización de una colaboración
   *
   */
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

  /**
   * Ejecuta la acción que sirve para previsualizar una colaboración
   *
   */
  public function executePreview()
  {
  	$this->title = $this->getRequestParameter('title');
  	$this->description = $this->getRequestParameter('description');
  }
  
  /**
   * Ejecuta la acción correspondiente a la pantalla de creación de una colaboración
   *
   */
  public function executeCreate()
  {
    $this->collaboration_offer = new CollaborationOffer();

    $this->setTemplate('edit');
  }

  /**
   * Ejecuta la acción correspondiente a la pantalla de edición de una colaboración
   *
   */
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
    	$this->getUser()->setFlash('warning', 'You don\'t have permission to edit this collaboration offer!');
    	$this->redirect('collaboration/show?id='.$this->getRequestParameter('id'));
    }
  }

  /**
   * Acción que actualiza o crea una oferta de colaboración.
   * Al terminar redirecciona a la página de visualización de la oferta en cuestión
   * 
   */
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
  
  /**
   * Maneja los posibles errores al actualizar una oferta de colaboración
   *
   */
  public function handleErrorUpdate()
  {
		// @todo mensaje no internacionalizado
		$this->getUser()->setFlash('error', 'Has cometido alg&uacute;n error al rellenar el formulario.', false);
		
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

  /**
   *  Acción que elimina un a oferta de colaboración.
   * Al terminar con éxito redirecciona a la lista de ofertas de colaboración
   *
   */
  public function executeDelete()
  {
    $collaboration_offer = CollaborationOfferPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($collaboration_offer);

    $collaboration_offer->delete();

    return $this->redirect('collaboration/list');
  }
}
