<?php use_helper('Date', 'sfRating', 'Javascript', 'Object'); ?>
<?php $isOwner = $sf_user->isAuthenticated() && $sf_user->getId() == $game->getCreatedBy(); ?>
<?php $noReleases = count($game->getGameReleases()) == 0 ? true : false; ?>

<div id="pageContent">
	
	<div class="contentColumn quarter alignLeft">
	
		<?php if($isOwner) : ?>
		<div class="contentBox">
			<h4 class="header"><?php echo __('Owner options'); ?></h4>
			<?php echo linkToEditGame($game, array('class' => 'bigBox')); ?>
			<?php echo linkToCreateGameRelease($game, array('class' => 'bigBox')); ?>
			<?php echo link_to(__('delete'), 'game/delete?id='.$game->getId(), array('class' => 'delete bigBox', 'onClick' => 'javascript:return confirm("'.__('Are you sure you want to delete this?\n(Can\'t be undone. Seriously!)').'");')) ?>
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
			<h5 class="header"><?php echo __('Rating details') ?></h5>
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
			<!-- Active release -->
			<h4 class="header large"><?php echo __('Active version') ?></h4>
				<?php $activeRelease = $game->getActiveRelease(); ?>
				<?php if(!is_null($activeRelease)) : ?>
					<?php include_partial('gameRelease/detailedList', array('gameReleases' => array($activeRelease) )) ?>
				<?php else : ?>
					<?php echo __('There is no an active version for this game') ?>
				<?php endif; ?>
				
				<?php if($isOwner) : ?>
					<h5 class="header"><?php echo __('Choose the active version for the game') ?></h5>
					<div class="contentBox light bordered">
					<?php if($noReleases) : ?>
						<p class="large center"><strong><?php echo __("You have not uploaded any version of this game yet!"); ?></strong></p>
						<p class="center"><?php echo sprintf(__("The game won't be playable until you %s for this game."), linkToCreateGameRelease($game, array(), __('upload a new version'))); ?></p>
					<?php else : ?>
						<?php echo form_tag('game/updateActiveRelease'); ?>
							<?php echo object_input_hidden_tag($game, 'getId') ?>					
							<?php echo select_tag('activeReleaseId', objects_for_select($game->getGameReleases(), 'getId', 'getName', $activeRelease ? $activeRelease->getId() : null, array('include_blank' => true) )); ?>
							<?php echo submit_tag(__('Save')); ?>
							<p class="noSpace"><small><?php echo sprintf(__('The active version will be playable from the players area'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></small></p>
						</form>
					<?php endif; ?>
					</div>
				<?php endif; ?>
			
			<!-- All releases -->
			<? if(! $noReleases) : ?>
				<h4 class="header large"><?php echo __('All versions') ?></h4>
				<?php $gameReleases = $game->getGameReleases(); ?>
				<?php include_partial('gameRelease/detailedList', array('gameReleases' => $gameReleases)) ?>
				<?php if($isOwner) : ?>
					<p class="right"><?php echo linkToCreateGameRelease($game, array(), __('Upload new release') . ' &raquo;'); ?></p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
			
	</div>
	
	<div class="contentColumn quarter alignLeft">
		<?php include_partial('searchForm'); ?>
		<?php include_partial('relatedByTags', array('limit' => 5, 'tagsString' => $game->getTagsString())); ?>
	</div>
</div>

