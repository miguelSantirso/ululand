<?php

/**
 * game actions.
 *
 * @package    ululand
 * @subpackage game
 * @author     pncil.com <http://pncil.com>
 */
class gameActions extends autogameActions
{
	public function executeAddGame()
	{
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			// Display the form
			return sfView::SUCCESS;
		}
		else // El método es POST. Es necesario procesar la información del formulario.
		{
			$game = new Game();
			$gameRelease = new GameRelease();
			
			// INFORMACIÓN DEL JUEGO
			
			$game->setName($this->getRequestParameter('name'));
			$game->setDescription($this->getRequestParameter('description'));
			$game->setInstructions($this->getRequestParameter('instructions'));
			$game->setTags($this->getRequestParameter('tags'));
	
			$game->save();
			
			if($this->getRequest()->getFileSize('thumbnail_path'))
				$this->updateThumbnail($game);
	      
			$game->save();
			
			// INFORMACIÓN DE LA VERSIÓN DEL JUEGO

			$gameRelease->setGame($game);
			$gameRelease->setName('autoRelease');
			$gameRelease->setDescription("game release added automatically for game {$game->getName()}");
			$gameRelease->setIsPublic(true);

			if($this->getRequest()->getFileSize('game_path'))
			$this->updateGameFile($gameRelease);
	
			$gameRelease->save();
	
			// Establecer esta versión como la activa para el juego
			
			$game->setActiveReleaseId($gameRelease->getId());
			$game->save();
			
			return $this->redirect('game/edit?id='.$game->getId());
		}		
	}
	
	/**
	 * @todo Esta función está repetida. Aparece también en el actions de game en developers
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
	
	/**
	 * @todo Esta función está repetida. Aparece también en el actions de gameRelease en developers
	 */
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
