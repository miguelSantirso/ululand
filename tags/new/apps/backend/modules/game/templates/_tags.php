<?php
	if($type == "filter")
	{
		echo input_tag('filters[tags]', isset($filters['tags']) ? $filters['tags'] : '');
	}
	else
	{
		$tags = $game->getTags();
		$tagsString = '';
		foreach ($tags as $tag)
		{
			$tagsString .= $tag.', ';
		}

		echo input_tag('game[tags]', $tagsString);
	}
?>