<?php 
	
	use_helper('Tags'); 

	if(!isset($title))
	{
		$title = __('Popular tags');
	}
	
	if(!isset($listStyle))
	{
		$listStyle = "xSmall tags";
	}
?>

			<?php if($title != "") : ?><h3 class="header"><?php echo $title; ?></h3><?php endif; ?>
			<?php $tags = TagPeer::getPopulars(null, array('model' => 'CodePiece')); ?>
			<?php echo tag_cloud($tags, 'recipe/list?tag=%s', array('class' => $listStyle)); ?>