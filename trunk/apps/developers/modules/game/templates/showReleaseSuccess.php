<?php use_helper('Date'); ?>

<div id="pageContent">
	
	<div class="contentColumn wide alignLeft">
		<div class="contentBox">
			<h3 class="header large noSpace"><?php echo linkToGameRelease($gameRelease, array(), $gameRelease . " release"); ?> for <?php echo linkToGame($game); ?></h3>
			<div class="clearFloat"></div>
			<?php echo sfMarkdown::doConvert($gameRelease->getDescription()); ?>
			<h4 class="header"><?php echo __('Preview') ?>:</h4>
			<?php echo include_partial('release', array('gameRelease' => $gameRelease)); ?>
		</div>	
	</div>
	
	<div class="contentColumn quarter alignLeft">
		<?php if($sf_user->isAuthenticated() && $sf_user->getId() == $gameRelease->getCreatedBy()) : ?>
		<div class="contentBox">
			<h4 class="header"><?php echo __('Owner options'); ?></h4>
			<?php echo linkToEditGameRelease($gameRelease, array('class' => 'bigBox')); ?>
		</div>
		<?php endif; ?>
		
		<div class="contentBox light">
			<h4 class="header"><?php echo __('Release details'); ?></h4>
			<p class="noSpace small"><?php echo sprintf(__('Submitted by %1$s at %2$s'), '<strong>'.linkToProfile($gameRelease->getsfGuardUser()->getProfile()).'</strong>', '<strong>'.format_date($gameRelease->getCreatedAt()).'</strong>'); ?></p>
			<p class="noSpace small"><?php echo __('Status') ?>: <strong><?php echo $gameRelease->getGameReleaseStatus(); ?></strong></p>
			<p class="small"><?php echo sprintf(__('This release is %s'), '<strong>' . ($gameRelease->getIsPublic() ? __('public') : __('private')) . '</strong>' ); ?></p>
			<h5 class="header"><?php echo __("Game Instructions") ?></h5>
			<div class="small"><?php echo sfMarkdown::doConvert($game->getInstructions()); ?></div>
			<h5 class="header"><?php echo __("File details") ?></h5>
			<p class="noSpace small"><?php echo __("Dimensions:") ?> <strong><?php echo sprintf('%sx%s', $gameRelease->getWidth(), $gameRelease->getHeight()); ?></strong></p>
		</div>
		<div class="contentBox">
			<h4 class="header"><?php echo __('All releases for this game') ?></h4>
			<?php $gameReleases = $game->getGameReleases(); ?>
			<?php foreach($gameReleases as $gameRelease) : ?>
				<ul class="tags">
					<li><?php echo linkToGameRelease($gameRelease); ?></li>
				</ul>
			<?php endforeach; ?>
		</div>
	</div>
	
</div>