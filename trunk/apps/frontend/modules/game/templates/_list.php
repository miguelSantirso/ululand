		<?php use_helper('PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($gamesPager, 'group/list'); ?></div>
		
		<?php $games = $gamesPager->getResults(); ?>
		<?php sfPropelActAsTaggableBehavior::preloadTags($games); ?>
		
		<ul class="compound">
			<?php foreach ($games as $game): ?>
				<li class="">
					<?php echo linkToGameWithThumbnail($game, 100, array('class' => 'firstRow xLarge')); ?>
					<div class="lastRow">
						
						<?php if($game->hasBeenRated()) : ?>
						<p class="xSmall noSpace"><?php echo __('Rating') ?>: <strong><?php echo $game->getRating(); ?></strong></p>
						<?php endif; ?>
						
						<?php $linkedTagsString = $game->getLinkedTagsString(); ?>
						<?php if($linkedTagsString != "") : ?>
						<p class="xSmall noSpace"><?php echo __('Tags') ?>: <strong><?php echo $linkedTagsString; ?></strong></p>
						<?php endif; ?>
						
						<p class="xSmall noSpace">
							<?php echo sprintf(__('played %1$s times, %2$s comments'), '<strong>'.$game->getCounter().'</strong>', '<strong>'.$game->getNbComments().'</strong>'); ?>,
						</p>
						
					</div>
					<div class="clearFloat"></div>
				</li>
			<?php endforeach; ?>
		</ul>
	
		<div class="center"><?php echo pager_navigation($gamesPager, 'profile/list'); ?></div>