<?php use_helper('Date'); ?>
<?php $isOwner = $sf_user->isAuthenticated() && $sf_user->getId() == $gameRelease->getCreatedBy(); ?>

<div id="pageContent">
	
	<div class="contentColumn wide alignLeft">
		<div class="contentBox">
			<h3 class="header large noSpace"><?php echo sprintf(__('%s version for'), linkToGameRelease($gameRelease)); ?> <?php echo linkToGame($game); ?></h3>
			<div class="clearFloat"></div>
			<?php echo sfMarkdown::doConvert($gameRelease->getDescription()); ?>
			<h4 class="header"><?php echo __('Preview') ?>:</h4>
			<?php echo include_partial('release', array('gameRelease' => $gameRelease)); ?>
			<div class="contentBox light">
				<h5 class="header"><?php echo __("Game Instructions") ?></h5>
				<div class="small"><?php echo sfMarkdown::doConvert($game->getInstructions()); ?></div>
				<h5 class="header"><?php echo __("Game Description") ?></h5>
				<div class="small"><?php echo sfMarkdown::doConvert($game->getDescription()); ?></div>
			</div>
		</div>	
	</div>
	
	<div class="contentColumn quarter alignLeft">
		<?php if($isOwner) : ?>
		<div class="contentBox">
			<h4 class="header"><?php echo __('Owner options'); ?></h4>
			<?php echo linkToEditGameRelease($gameRelease, array('class' => 'bigBox')); ?>
			<?php echo link_to(__('delete'), 'gameRelease/delete?id='.$gameRelease->getId(), array('class' => 'bigBox delete', 'onClick' => 'javascript:return confirm("'.__('Are you sure you want to delete this?\n(Can\'t be undone. Seriously!)').'");')); ?>
		</div>
		<?php endif; ?>
		
		<div class="contentBox light">
			<h4 class="header"><?php echo __('Release details'); ?></h4>
			<p class="noSpace small"><?php echo sprintf(__('Submitted by %1$s at %2$s'), '<strong>'.linkToProfile($gameRelease->getsfGuardUser()->getProfile()).'</strong>', '<strong>'.format_date($gameRelease->getCreatedAt()).'</strong>'); ?></p>
			<p class="noSpace small"><?php echo __('Status') ?>: <strong><?php echo $gameRelease->getGameReleaseStatus(); ?></strong></p>
			<p class="small"><?php echo sprintf(__('This version is %s'), '<strong>' . ($gameRelease->getIsPublic() ? __('public') : __('private')) . '</strong>' ); ?></p>
			<h5 class="header"><?php echo __("File details") ?></h5>
			<p class="noSpace small"><?php echo __("Dimensions:") ?> <strong><?php echo sprintf('%sx%s', $gameRelease->getWidth(), $gameRelease->getHeight()); ?></strong></p>
		</div>
		<div class="contentBox">
			<h4 class="header"><?php echo __('All version for this game') ?></h4>
			<?php $gameReleases = $game->getGameReleases(); ?>
			<ul class="tags">
			<?php foreach($gameReleases as $gameRelease) : ?>
				<li><?php echo linkToGameRelease($gameRelease); ?></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
	
</div>