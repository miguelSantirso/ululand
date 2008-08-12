<?php
	
	$objects = TagPeer::getTaggedWith($tagsString, array('model' => 'DeveloperProfile', 'nb_common_tags' => 1));

	if(!isset($title))
	{
		$title = __('Related Developers');
	}
	
?>

			<h3 class="header"><?php echo $title; ?></h3>
			<ul class="tags">
			<?php foreach($objects as $object) : ?>
				<li><?php echo linkToProfileWithGravatar($object->getsfGuardUserProfile(), 18); ?></li>
			<?php endforeach; ?>
			</ul>
