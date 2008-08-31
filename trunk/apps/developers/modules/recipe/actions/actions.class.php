<?php

/**
 * recipe actions.
 *
 * @package    ululand
 * @subpackage recipe
 * @author     Pncil.com
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class recipeActions extends sfActions
{
  public function executeIndex()
  {
    return $this->redirect('recipe/list');
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
  	if($this->getRequestParameter('id'))
	{
		$code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));
		$this->redirect('recipe/show?stripped_title='.$code_piece->getStrippedTitle());
	}
	else if($this->getRequestParameter('r'))
	{
		$c = new Criteria();
		$c->add(CodePiecePeer::UUID, $this->getRequestParameter('r'));
		$code_piece = CodePiecePeer::doSelectOne($c);
		$this->redirect('recipe/show?stripped_title='.$code_piece->getStrippedTitle());
	}
	else if($this->getRequestParameter('stripped_title'))
	{
		$c = new Criteria();
		$c->add(CodePiecePeer::STRIPPED_TITLE, $this->getRequestParameter('stripped_title'));
		$this->code_piece = CodePiecePeer::doSelectOne($c);
	}
	
    $this->forward404Unless($this->code_piece);
    $this->code_piece->incrementCounter(); // Una visita m�s
  }
  
  public function executePreview()
  {
  	$this->title = $this->getRequestParameter('title');
  	$this->source = ulGeshiToolkit::transformToHtml($this->getRequestParameter('source'));
  }
  
  public function executeEmbed()
  {
  	if($this->getRequestParameter('r'))
	{
		$c = new Criteria();
		$c->add(CodePiecePeer::UUID, $this->getRequestParameter('r'));
		$this->code_piece = CodePiecePeer::doSelectOne($c);
	}
	
    $this->forward404Unless($this->code_piece);
    $this->code_piece->incrementCounter(); // Una visita más
    
    $this->getResponse()->setContentType('application/x-javascript');
  }
  
  public function executeCreate()
  {
    $this->code_piece = new CodePiece();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
  	if($this->getRequestParameter('id'))
	{
		$code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));
		$this->redirect('recipe/show?stripped_title='.$code_piece->getStrippedTitle());
	}
	else if($this->getRequestParameter('stripped_title'))
	{
		$c = new Criteria();
		$c->add(CodePiecePeer::STRIPPED_TITLE, $this->getRequestParameter('stripped_title'));
		$this->code_piece = CodePiecePeer::doSelectOne($c);
	}
	
    $this->forward404Unless($this->code_piece);
    
    if($this->getUser()->getId() != $this->code_piece->getCreatedBy())
    {
    	$this->setFlash('warning', 'You don\'t have permission to edit this recipe!');
    	$this->redirect('recipe/show?id='.$this->getRequestParameter('id'));
    }
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $code_piece = new CodePiece();
    }
    else
    {
      $code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($code_piece);
    }

    $code_piece->setTitle($this->getRequestParameter('title'));
    $code_piece->setTags($this->getRequestParameter('tags_string'));
    $code_piece->setSource($this->getRequestParameter('source'));

    $code_piece->save();

    return $this->redirect('recipe/show?id='.$code_piece->getId());
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
		
		return $this->forward('recipe', $redirectTo);
  }
  
  public function executeDelete()
  {
    $code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($code_piece);

    $code_piece->delete();

    return $this->redirect('recipe/list');
  }
  
}
