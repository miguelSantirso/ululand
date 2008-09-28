<?php

/**
 * gameRelease actions.
 *
 * @package    ululand
 * @subpackage gameRelease
 * @author     Pncil.com <http://pncil.com>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class gameReleaseActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$this->forward('release', 'list');
	}

	public function executeShow()
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
			if(!$this->game) $this->game = $this->gameRelease->getGame();
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

		if(!$this->gameRelease->getIsPublic())
		{
			if(!$this->getUser()->isAuthenticated() || ($this->getUser()->isAuthenticated() && $this->getUser()->getId() != $this->gameRelease->getCreatedBy()))
			{
				$this->setFlash('error', 'This version of the game is private. You don\'t have permission to see it');
				$this->redirect('game/show?id='.$this->game->getId());
			}
		}
		
		if($needRedirect)
		{
			$this->redirect('gameRelease/show?game_stripped_name='.$this->game->getStrippedName().'&release_stripped_name='.$this->gameRelease->getStrippedName());
		}

	}

	public function executeCreate()
	{
		if($this->getRequestParameter('game_id'))
		{
			$this->game = GamePeer::retrieveByPk($this->getRequestParameter('game_id'));
		}
		else if($this->getRequestParameter('game_stripped_name'))
		{
			$c = new Criteria();
			$c->add(GamePeer::STRIPPED_NAME, $this->getRequestParameter('game_stripped_name'));
			$this->game = GamePeer::doSelectOne($c);
		}
		$this->gameRelease = new GameRelease();

		$this->setTemplate('edit');
	}

	public function executeEdit()
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
			if(!$this->game) $this->game = $this->gameRelease->getGame();
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
			$this->redirect('gameRelease/show?game_stripped_name='.$this->game->getStrippedName().'&release_stripped_name='.$this->gameRelease->getStrippedName());
		}

		if($this->getUser()->getId() != $this->gameRelease->getCreatedBy())
		{
			$this->setFlash('warning', 'You don\'t have permission to edit this game release!');
			$this->redirect('gameRelease/show?id='.$this->gameRelease->getId());
		}
	}

	public function executeUpdate()
	{
		if (!$this->getRequestParameter('gameId'))
		{
			throw new sfException('Missing "gameId" parameter');
		}
		$game = GamePeer::retrieveByPk($this->getRequestParameter('gameId'));
		$this->forward404Unless($game);
			
		if (!$this->getRequestParameter('gameReleaseId'))
		{
			$gameRelease = new GameRelease();
			$gameRelease->setGame($game);
		}
		else
		{
			$gameRelease = GameReleasePeer::retrieveByPk($this->getRequestParameter('gameReleaseId'));
			$this->forward404Unless($gameRelease);
			if(!$game) $game = $gameRelease->getGame();
		}

		$gameRelease->setName($this->getRequestParameter('name'));
		$gameRelease->setDescription($this->getRequestParameter('description'));
		$gameRelease->setGamereleasestatusId($this->getRequestParameter('game_release_status_id'));
		if($game->getActiveReleaseId() == $gameRelease->getId() && !$this->getRequestParameter('is_public', false))
			$this->setFlash('error', 'The privacity of the active version of the game cannot be changed.');
		else
		{
			$gameRelease->setIsPublic($this->getRequestParameter('is_public', false));
			$gameRelease->save();
		}

		if($this->getRequest()->getFileSize('game_path'))
		$this->updateGameFile($gameRelease);

		$gameRelease->save();

		return $this->redirect('gameRelease/show?release_id='.$gameRelease->getId());
	}

	public function executeDelete()
	{
		$gameRelease = GameReleasePeer::retrieveByPk($this->getRequestParameter('id'));

		$this->forward404Unless($gameRelease);
		
		$game = $gameRelease->getGame();
		
		$gameRelease->delete();

		return $this->redirect('game/show?id='.$game->getId());
	}

	private function updateGameFile($gameRelease)
	{
		$game = $gameRelease->getGame();
		
		$currentGameFile = sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_game')."/{$game->getStrippedName()}/".$gameRelease->getGamePath();

		if (is_file($currentGameFile))
		{
			unlink($currentGameFile);
		}
		
		$fileName = "{$game->getStrippedName()}_{$gameRelease->getStrippedName()}";
		$ext = $this->getRequest()->getFileExtension('game_path');
		$gamePath = $this->getRequest()->getFileName('game_path');
      	$this->getRequest()->moveFile('game_path', sfConfig::get('sf_upload_dir')."/".sfConfig::get('app_dir_game')."/{$game->getStrippedName()}/".$fileName.$ext);
      	$gameRelease->setGamePath($fileName.$ext);
	}
}
