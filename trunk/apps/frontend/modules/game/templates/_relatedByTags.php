<?php
	
	if(!isset($objects))
	{
		$objects = TagPeer::getTaggedWith($tagsString, array('model' => 'Game', 'nb_common_tags' => 1));
	}

	if(!isset($title))
	{
		$title = __('Related Games');
	}
	
?>

			<h3 class="header"><?php echo $title; ?></h3>
			<ul class="tags">
			<?php foreach($objects as $object) : ?>
				<li><?php echo linkToGame($object); ?></li>
			<?php endforeach; ?>
			</ul>
