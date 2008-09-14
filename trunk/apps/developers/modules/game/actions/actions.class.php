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
	
	/*
	 * RELEASES
	 * 
	 * @todo: ¿mover quizás a un módulo release?
	 */
	
	public function executeShowRelease()
	{
		$needRedirect = false;
		if($this->getRequestParameter('game_id'))
		{
			$this->game = GamePeer::retrieveByPk($this->getRequestParameter('game_id'));
			$needRedirect = true;
		}
		else if($this->getRequestParameter('game_stripped_name'))
		{
			$c = new Criteria();
			$c->add(GamePeer::STRIPPED_NAME, $this->getRequestParameter('game_stripped_name'));
			$this->game = GamePeer::doSelectOne($c);
		}
		if($this->getRequestParameter('release_id'))
		{
			$this->gameRelease = GameReleasePeer::retrieveByPk($this->getRequestParameter('release_id'));
			$needRedirect = true;
		}
		else if($this->getRequestParameter('release_stripped_name'))
		{
			$c = new Criteria();
			$c->add(GameReleasePeer::STRIPPED_NAME, $this->getRequestParameter('release_stripped_name'));
			$c->add(GameReleasePeer::GAME_ID, $this->game->getId());
			$this->gameRelease = GameReleasePeer::doSelectOne($c);
		}
		
		$this->forward404Unless($this->game && $this->gameRelease);
		
		if($needRedirect)
		{
			$this->redirect('game/showRelease?game_stripped_name='.$this->game->getStrippedName().'&release_stripped_name='.$this->gameRelease->getStrippedName());
		}

	}
	
	public function executeEditRelease()
	{
		$needRedirect = false;
		if($this->getRequestParameter('game_id'))
		{
			$this->game = GamePeer::retrieveByPk($this->getRequestParameter('game_id'));
			$needRedirect = true;
		}
		else if($this->getRequestParameter('game_stripped_name'))
		{
			$c = new Criteria();
			$c->add(GamePeer::STRIPPED_NAME, $this->getRequestParameter('game_stripped_name'));
			$this->game = GamePeer::doSelectOne($c);
		}
		if($this->getRequestParameter('release_id'))
		{
			$this->gameRelease = GameReleasePeer::retrieveByPk($this->getRequestParameter('release_id'));
			$needRedirect = true;
		}
		else if($this->getRequestParameter('release_stripped_name'))
		{
			$c = new Criteria();
			$c->add(GameReleasePeer::STRIPPED_NAME, $this->getRequestParameter('release_stripped_name'));
			$c->add(GameReleasePeer::GAME_ID, $this->game->getId());
			$this->gameRelease = GameReleasePeer::doSelectOne($c);
		}
		
		$this->forward404Unless($this->game && $this->gameRelease);
		
		if($needRedirect)
		{
			$this->redirect('game/showRelease?game_stripped_name='.$this->game->getStrippedName().'&release_stripped_name='.$this->gameRelease->getStrippedName());
		}

		if($this->getUser()->getId() != $this->gameRelease->getCreatedBy())
		{
			$this->setFlash('warning', 'You don\'t have permission to edit this game release!');
			$this->redirect('gameRelease/show?id='.$this->gameRelease->getId());
		}
	}
/*
	public function executeUpdateRelease()
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
