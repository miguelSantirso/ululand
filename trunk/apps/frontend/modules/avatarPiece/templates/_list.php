		<?php use_helper('Date', 'PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($avatarPiecesPager, 'avatarPiece/list'); ?></div>
		
		<?php $avatarPieces = $avatarPiecesPager->getResults(); ?>
		<?php sfPropelActAsTaggableBehavior::preloadTags($avatarPieces); ?>
		
		<?php if(count($avatarPieces) != 0){ ?>
		<ul class="full">
			<?php foreach ($avatarPieces as $avatarPiece): ?>
				<li>
					<?php echo $avatarPiece->getName(); ?>
					(<?php echo link_to('edit', "avatarPiece/edit?id={$avatarPiece->getId()}") ?>)
				</li>
			<?php endforeach; ?>
		</ul>
		<?php } else echo __("There are no avatar pieces yet"); ?>
	
		<div class="center"><?php echo pager_navigation($avatarPiecesPager, 'avatarPiece/list'); ?></div>