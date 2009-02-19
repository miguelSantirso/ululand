<?php

/**
 * game actions.
 *
 * @package    ululand
 * @subpackage game
 * @author     pncil.com <http://pncil.com>
 */
class gameActions extends sfActions
{
	/**
	 * Acción correspondiente al índice del módulo
	 * 
	 */
	public function executeIndex()
	{
		return $this->forward('game', 'list');
	}

	/**
	 * Acción que redirecciona a la lista de los juegos creados por el desarrollador que haya iniciado sesión.
	 * Si el usuario no es un desrrollador autentificado, redirige al index
	 *
	 */
	public function executeMyGames()
	{
		if($this->getUser()->isAuthenticated())
		{
			$this->getRequest()->setParameter('filterByUsername', $this->getUser()->getProfile()->getUsername());
			$this->forward('game', 'list');
		}
		else
		{
			$this->redirect('game');
		}
	}
	
	/**
	 * Acción correspondiente a la pantalla que lista juegos
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
			$this->userProfile = sfGuardUserProfilePeer::retrieveByUsername($filterByUsername);
		}
	}

	/**
	 * Acción correspondiente a la pantalla de visualización de un juego
	 *
	 */
	public function executeShow()
	{
		if($this->getRequestParameter('id'))
		{
			$game = GamePeer::retrieveByPk($this->getRequestParameter('id'));
			$this->redirect('game/show?stripped_name='.$game->getStrippedName());
		}
		else if($this->getRequestParameter('stripped_name'))
		{
			$c = new Criteria();
			$c->add(GamePeer::STRIPPED_NAME, $this->getRequestParameter('stripped_name'));
			$this->game = GamePeer::doSelectOne($c);
		}

		$this->forward404Unless($this->game);
		
		$this->getResponse()->setTitle(sprintf(ulToolkit::__('%s by %s. Create flash games at developers.ululand.com.'), 
			$this->game->getName(), 
			$this->game->getsfGuardUser()->getProfile()));
	}

	/**
	 * Acción que permite la previsualización de un juego antes de guardarlo
	 *
	 */
	public function executePreview()
	{
		$this->name = $this->getRequestParameter('name');
		$this->description = sfMarkdown::doConvert($this->getRequestParameter('description'));
		$this->instructions = sfMarkdown::doConvert($this->getRequestParameter('instructions'));
	}

	/**
	 * Acción correspondiente a la pantalla de creación de un juego 
	 *
	 */
	public function executeCreate()
	{
		$this->game = new Game();

		$this->setTemplate('edit');
	}

	/**
	 * Acción correspondiente a la pantalla de edición de un juego
	 *
	 */
	public function executeEdit()
	{
		if($this->getRequestParameter('id'))
		{
			$game = GamePeer::retrieveByPk($this->getRequestParameter('id'));
			$this->redirect('game/edit?stripped_name='.$game->getStrippedName());
		}
		else if($this->getRequestParameter('stripped_name'))
		{
			$c = new Criteria();
			$c->add(GamePeer::STRIPPED_NAME, $this->getRequestParameter('stripped_name'));
			$this->game = GamePeer::doSelectOne($c);
		}

		$this->forward404Unless($this->game);

		if($this->getUser()->getId() != $this->game->getCreatedBy())
		{
			$this->getUser()->setFlash('warning', 'You don\'t have permission to edit this game!');
			$this->redirect('game/show?id='.$this->game->getId());
		}
		
	}

	/**
	 * Acción que ejecuta la actualización de los datos de un juego.
	 * Al terminar redirecciona a la pantalla de visualización del juego
	 *
	 */
	public function executeUpdate()
	{
		if (!$this->getRequestParameter('id'))
		{
			$game = new Game();
		}
		else
		{
			$game = GamePeer::retrieveByPk($this->getRequestParameter('id'));
			$this->forward404Unless($game);
		}

		$game->setName($this->getRequestParameter('name'));
		$game->setDescription($this->getRequestParameter('description'));
		$game->setInstructions($this->getRequestParameter('instructions'));
		$game->setTags($this->getRequestParameter('tags_string'));

		$game->save();
		
		if($this->getRequest()->getFileSize('thumbnail_path'))
			$this->updateThumbnail($game);
      
		$game->save();

		return $this->redirect('game/show?id='.$game->getId());
	}

	/**
	 * Acción que elimina un juego.
	 * Al terminar redirecciona a la lista de juegos
	 *
	 */
	public function executeDelete()
	{
		$game = GamePeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($game);

		$game->delete();

		return $this->redirect('game/list');
	}

	/**
	 * Acción que actualiza la versión activa de un juego.
	 *
	 */
	public function executeUpdateActiveRelease()
	{
		// Obtener el juego y la versión del juego que se desean asociar
		$game = GamePeer::retrieveByPk($this->getRequestParameter('id'));
		$this->forward404Unless($game);
		$gameRelease = GameReleasePeer::retrieveByPk($this->getRequestParameter('activeReleaseId'));
		
		// Comprobar que, efectivamente, la versión pertenece al juego
		if(!is_null($gameRelease) && $gameRelease->getGameId() != $game->getId())
		{
			// la release no pertenece al juego. Error:
			$this->getUser()->setFlash('error', $gameRelease . ' is not a version of ' . $game);
			return $this->redirect('game/show?id='.$game->getId());
		}
		
		$game->setActiveReleaseId($gameRelease ? $gameRelease->getId() : null );
		$game->save();
		
		if($gameRelease && !$gameRelease->getIsPublic())
		{
			$this->getUser()->setFlash('warning', 'The privacity of this version of the game has been changed automatically to <strong>public</strong>');
			$gameRelease->setIsPublic(true);
			$gameRelease->save();
		}
		
		return $this->redirect('game/show?id='.$game->getId());
	}
	
	/**
	 * Función privada que actualiza la vista en miniatura del icono del juego pasado como parámetro.
	 * La imagen desde la que se generará el icono debe haber sido enviada previamente a través del formulario correspondiente con nombre "thumbnail_path"
	 *
	 * @param Game $game Juego al que se desea actualizar su icono
	 */
	private function updateThumbnail($game)
	{
		$currentThumbnail = sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_game')."/{$game->getStrippedName()}/".$game->getThumbnailPath();

		if (is_file($currentThumbnail))
		{
			unlink($currentThumbnail);
		}
		$fileName = "{$game->getStrippedName()}";
		$ext = $this->getRequest()->getFileExtension('thumbnail_path');
		$thumbnailPath = $this->getRequest()->getFileName('thumbnail_path');
      	$this->getRequest()->moveFile('thumbnail_path', sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_game')."/{$game->getStrippedName()}/".$fileName.$ext);
      	$game->setThumbnailPath($fileName.$ext);
	}

}
