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
    return $this->forward('recipe', 'list');
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
    $this->code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->code_piece);
    $this->code_piece->incrementCounter(); // Una visita más
  }
  
  public function executePreview()
  {
  	$this->title = $this->getRequestParameter('title');
  	$this->source = $this->getRequestParameter('source');
  }
  
  public function executeCreate()
  {
    $this->code_piece = new CodePiece();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->code_piece);
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
