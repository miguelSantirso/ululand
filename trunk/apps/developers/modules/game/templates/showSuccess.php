<?php use_helper('Date', 'sfRating'); ?>

<div id="pageContent">
	
	<div class="contentColumn quarter alignLeft">
	
		<?php if($sf_user->isAuthenticated() && $sf_user->getId() == $game->getCreatedBy()) : ?>
		<div class="contentBox">
			<h4 class="header"><?php echo __('Owner options'); ?></h4>
			<?php echo linkToEditGame($game, array('class' => 'bigBox')); ?>
			<?php echo link_to('Submit release', 'game/createRelease?game_stripped_name='.$game->getStrippedName(), array('class' => 'bigBox')); ?>
		</div>
		<?php endif; ?>
		
		<div class="contentBox light">
			<h4 class="header"><?php echo __('Game details'); ?></h4>
			<p class="noSpace small"><?php echo sprintf(__('Submitted by %1$s %2$s ago (%3$s)'), '<strong>'.linkToProfile($game->getsfGuardUser()->getProfile()).'</strong>', '<strong>'.time_ago_in_words($game->getCreatedAt('U')).'</strong>', format_date($game->getCreatedAt())); ?></p>
			<h5 class="header"><?php echo __('Tags') ?></h5>
			<p class="noSpace small"><?php echo $game->getLinkedTagsString(); ?></p>
			<h5 class="header"><?php echo __('Stats') ?></h5>
			<p class="noSpace small"><?php echo sprintf(__('Played %s times'), '<strong>'.$game->getCounter().'</strong>'); ?></p>
			<p class="noSpace small"><?php echo sprintf(__('Commented %s times'), '<strong>'.$game->getNbComments().'</strong>'); ?></p>
			<p class="noSpace small"><?php echo sprintf(__('Rated %s times'), '<strong>'.$game->getNbRatings().'</strong>'); ?></p>
			<h5 class="header"><?php echo __('Rating details') ?></h5>
			<p class="noSpace small"><?php echo sprintf(__('Average rating: %s'), '<strong>'.$game->getRating().'</strong>'); ?></p>
			<?php include_component('sfRating', 'ratingDetails', array('object' => $game)); ?>
		</div>
		
	</div>

	<div class="contentColumn half alignLeft">
		<div class="contentBox">
			<h3 class="header xLarge noSpace"><?php echo linkToGameWithThumbnail($game, 40); ?></h3>
			<div class="clearFloat"></div>
			<?php echo sfMarkdown::doConvert($game->getDescription()); ?>
		</div>
		<div class="contentBox">
			<h4 class="header large"><?php echo __('Game releases') ?></h4>
			<?php $gameReleases = $game->getGameReleases(); ?>
			<ul class="full">
			<?php foreach($gameReleases as $gameRelease) : ?>
				<li><?php echo linkToGameRelease($gameRelease); ?> - <?php echo $gameRelease->getGameReleaseStatus() ?>
				(<?php echo format_date($gameRelease->getCreatedAt()); ?>)
				</li>
			<?php endforeach; ?>
			</ul>
			<?php if($sf_user->isAuthenticated() && $sf_user->getId() == $game->getCreatedBy()) : ?>
				<p class="right"><?php echo link_to(__('Submit new release').' &raquo;', 'game/createRelease?game_stripped_name='.$game->getStrippedName()); ?></p>
			<?php endif; ?>
		</div>
		
	</div>
	
	<div class="contentColumn quarter alignLeft">
		<?php include_partial('searchForm'); ?>
		<?php include_partial('relatedByTags', array('limit' => 5, 'tagsString' => $game->getTagsString())); ?>
	</div>
</div>

