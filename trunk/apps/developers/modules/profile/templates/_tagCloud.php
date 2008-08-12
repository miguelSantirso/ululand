<?php 
	
	use_helper('Tags'); 

	if(!isset($title))
	{
		$title = __('Popular tags');
	}
?>

			<h3 class="header"><?php echo $title; ?></h3>
			<?php $tags = TagPeer::getPopulars(null, array('model' => 'DeveloperProfile')); ?>
			<?php echo tag_cloud($tags, 'profile/list?tag=%s', array('class' => 'xSmall tags')); ?>