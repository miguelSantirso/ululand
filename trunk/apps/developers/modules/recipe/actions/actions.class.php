<?php

/**
 * recipe actions.
 *
 * @package    ululand
 * @subpackage recipe
 * @author     Pncil.com <http://pncil.com>
 */
class recipeActions extends sfActions
{
	/**
	 * Acción correspondiente al índice del módulo recipe
	 */
	public function executeIndex()
	{
		return $this->redirect('recipe/list');
	}

	/**
	 * Acción correspondiente a la pantalla que lista todas las recetas de código
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
	 * Acción correspondiente a la pantalla que muestra una receta de código
	 *
	 */
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
		$this->code_piece->incrementCounter(); // Una visita más

		$this->getResponse()->setTitle(sprintf(ulToolkit::__('%s. Flash code recipes at developers.ululand.com'),
			$this->code_piece->getTitle()));
	}

	/**
	 * Acción que permite la previsualización de las recetas de código desde la pantalla de edición de las mismas
	 *
	 */
	public function executePreview()
	{
		$this->title = $this->getRequestParameter('title');
		//$this->source = sfMarkdown::doConvert($this->getRequestParameter('source'));
		$this->source = ulGeshiToolkit::transformToHtml($this->getRequestParameter('source'));
	}

	/**
	 * Acción correspondiente a la pantalla que se inserta en páginas externas al sistema
	 *
	 */
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

	/**
	 * Acción correspondiente a la pantalla de creación de una receta de código
	 *
	 */
	public function executeCreate()
	{
		$this->code_piece = new CodePiece();

		$this->setTemplate('edit');
	}

	/**
	 * Acción correspondiente a la pantalla de edición de una receta de código
	 *
	 */
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
			$this->getUser()->setFlash('warning', 'You don\'t have permission to edit this recipe!');
			$this->redirect('recipe/show?id='.$this->getRequestParameter('id'));
		}
	}

	/**
	 * Acción que actualiza los datos de una receta de código
	 *
	 */
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

	/**
	 * Acción que maneja posibles errores al actualizar los datos de una receta de código
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

		return $this->forward('recipe', $redirectTo);
	}

	/**
	 * Acción que elimina una receta de código.
	 *
	 */
	public function executeDelete()
	{
		$code_piece = CodePiecePeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($code_piece);

		$code_piece->delete();

		return $this->redirect('recipe/list');
	}

}
