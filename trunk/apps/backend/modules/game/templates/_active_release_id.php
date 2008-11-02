<?php
if($type == 'edit')
{
	if(isset($game))
	{
		$activeRelease = $game->getActiveRelease();
		echo select_tag('game[active_release_id]', objects_for_select(
			$game->getGameReleases(), 
			'getId', 
			'getName',
			$activeRelease ? $activeRelease->getId() : null,
			array('include_blank' => true) )); 
	}
	else
	{
		echo ulToolkit::__("No releases for this game yet.");
	}
}

?>