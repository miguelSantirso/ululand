<?php
	
	if(!isset($objects))
	{
		$objects = TagPeer::getTaggedWith($tagsString, array('model' => 'CodePiece', 'nb_common_tags' => 1));
	}

	if(!isset($title))
	{
		$title = __('Related Recipes');
	}
	
?>

			<h3 class="header"><?php echo $title; ?></h3>
			<ul class="tags">
			<?php foreach($objects as $object) : ?>
				<li><?php echo linkToRecipe($object); ?></li>
			<?php endforeach; ?>
			</ul>
