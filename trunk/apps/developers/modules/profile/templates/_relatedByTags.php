<?php
	
	if(!isset($objects))
	{
		$objects = TagPeer::getTaggedWith($tagsString, array('model' => 'DeveloperProfile', 'nb_common_tags' => 1));
	}
	
	if(!isset($title))
	{
		$title = __('Related Developers');
	}
	
?>
	<?php if(count($objects) > 0) : ?>
			
			<h3 class="header"><?php echo $title; ?></h3>
			<ul class="tags">
			<?php foreach($objects as $object) : ?>
				<li><?php echo linkToProfileWithGravatar($object->getsfGuardUserProfile(), 18); ?></li>
			<?php endforeach; ?>
			</ul>
			
	<?php endif; ?>
