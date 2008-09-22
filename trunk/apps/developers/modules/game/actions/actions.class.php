<?php

/**
 * game actions.
 *
 * @package    ululand_dev
 * @subpackage game
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gameActions extends sfActions
{
	public function executeIndex()
	{
		return $this->forward('game', 'list');
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
			$this->userProfile = sfGuardUserProfilePeer::retrieveByUsername($filterByUsername);
		}
	}

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
	}

	public function executePreview()
	{
		$this->name = $this->getRequestParameter('name');
		$this->description = sfMarkdown::doConvert($this->getRequestParameter('description'));
		$this->instructions = sfMarkdown::doConvert($this->getRequestParameter('instructions'));
	}

	public function executeCreate()
	{
		$this->game = new Game();

		$this->setTemplate('edit');
	}

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
			$this->setFlash('warning', 'You don\'t have permission to edit this game!');
			$this->redirect('game/show?id='.$this->game->getId());
		}
	}

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
			$this->setFlash('error', $gameRelease . ' is not a release of ' . $game);
			return $this->redirect('game/show?id='.$game->getId());
		}
		
		$game->setActiveReleaseId($gameRelease ? $gameRelease->getId() : null );
		$game->save();
		
		return $this->redirect('game/show?id='.$game->getId());
	}
	
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
