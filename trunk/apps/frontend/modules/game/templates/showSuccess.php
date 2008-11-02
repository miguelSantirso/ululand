<?php use_helper('sfRating', 'Date'); ?>

<div id="pageContent">

	<!-- juego, info y barra lateral -->
	<div class="contentRow">
		<div class="contentColumn wide alignLeft">
			
			<!-- juego -->
			<div id="ululandGame-<?php echo $game->getStrippedName(); ?>" class="gameBox alignCenter" style="width: <?php echo $game->getWidth() ?>px">
				<h3 class="gameBoxTitle"><?php echo linkToGameWithThumbnail($game, 40); ?></h3>
				<?php include_component('game', 'release', array('gameId' => $game->getId())) ?>
				<div class="gameBoxDetails">
					<?php if($game->getInstructions() && $game->getInstructions() != "") : ?>
					<h4><?php echo __('Instructions') ?>:</h4>
					<?php echo sfMarkdown::doConvert($game->getInstructions()); ?>
					<?php endif; ?>
					<?php if($game->getDescription() && $game->getDescription() != "") : ?>
					<h4><?php echo __('Description') ?>:</h4>
					<?php echo sfMarkdown::doConvert($game->getDescription()); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="clearFloat"></div>
			<!-- 
			<div class="contentBox">
				
				<h3 class="large header"><?php echo linkToGame($game); ?></h3>
				<div class="xSmall alignLeft">
					<p class="noSpace">
						<a href="#description"><?php echo __('Instructions & Details'); ?></a>
						| <a href="#commentsAndRankings"><?php echo __('Comments & Rankings'); ?></a>
					</p>
				</div>
				<div class="xSmall right">
						<p class="noSpace"><?php echo sprintf(__('Submitted by %1$s %2$s ago (%3$s)'),
									$game->getsfGuardUser()->getProfile(),
									time_ago_in_words($game->getCreatedAt('U')), 
									format_date($game->getCreatedAt()) ); ?></p>
				</div>
				<div class="clearFloat"></div>
				<br/>
				<div class="alignRight">
					<?php include_component('game', 'release', array('gameId' => $game->getId())) ?>
				</div>
			</div>
			<div class="clearFloat"></div>
			
			<div id="description" class="contentBox light">
				<h4 class="header"><?php echo __('Instructions') ?>:</h4>
				<div class="small"><?php echo sfMarkdown::doConvert($game->getInstructions()); ?></div>
			</div>
			 -->
			 
			<div id="gameDetails" class="contentBox bordered">
				<div class="contentColumn alignLeft half">
					<h4 class="header"><?php echo __('Game Details'); ?>:</h4>
					<?php if($game->hasDeveloper()) : ?>
					<p class="noSpace small"><?php echo sprintf(__('Submitted by %1$s %2$s ago (%3$s)'),
									$game->getsfGuardUser()->getProfile(),
									time_ago_in_words($game->getCreatedAt('U')), 
									format_date($game->getCreatedAt()) ); ?></p>
					<?php endif; ?>
					<p class="noSpace small"><?php echo __('Tags') ?>: <strong><?php echo $game->getLinkedTagsString(); ?></strong></p>
					<?php if($game->hasBeenRated()) : ?>
					<p class="noSpace small"><?php echo __('Rating'); ?>: <strong><?php echo sprintf(__('%s out of %s'), $game->getRating(), $game->getMaxRating()); ?></strong></p>
					<?php endif; ?>
					<p class="noSpace small"><?php echo sprintf(__('%s gameplays'), '<strong>'.$game->getCounter().'</strong>'); ?></p>
					<h4 class="header"><?php echo __('Rate this game'); ?>:</h4>
					<?php echo sf_rater($game) ?>
				</div>
				<div class="contentColumn alignLeft">
					<h4 class="header"><?php echo __('Detailed ratings'); ?></h4>
					<?php include_component('sfRating', 'ratingDetails', array('object' => $game)); ?>
				</div>
				<div class="clearFloat"></div>
			</div>
		</div>
		
		<!-- acciones, barra búsqueda y relacionados -->
		<div class="contentColumn quarter alignLeft">
			<?php if($sf_user->isAuthenticated()) : ?>
				<?php if(count($game->getGameStats()) > 0) : ?>
					<?php echo link_to(__('Create Competition'), 'competition/edit?game='.$game->getId(), array('class' => 'bigBox')); ?>
				<?php endif; ?>
			<?php endif; ?>
			<?php include_partial('searchForm'); ?>
			<?php include_partial('relatedByTags', array('limit' => 5, 'tagsString' => $game->getTagsString())); ?>
		</div>
	</div>
	
	<!-- comentarios y rankings -->
	<div class="contentRow" id="commentsAndRankings">
	
		<div class="contentColumn twoThirds alignLeft">
			<div id="comments" class="contentBox">
				<h4 class="header small"><?php echo __('Comments:') ?></h4>
				<?php
				include_component('sfComment', 'commentForm', array('object' => $game, 'order' => 'desc'));
				include_component('sfComment', 'commentList', array('object' => $game, 'order' => 'desc'));
				?>
			</div>
		</div>
		
		<div class="contentColumn third alignRight">
			<div id="rankings" class="contentBox">
				<h4 class="header small"><?php echo __('Rankings:') ?></h4>
				<?php $gamestats = $game->getGameStats(); ?>
				<?php if(count($gamestats) == 0) : ?>
					<p class="small">Este juego no tiene gamestats activos. <a href="#">&iexcl;P&iacute;dele a su autor que los configure!</a>.</p>
				<?php else : ?>
					<?php foreach($gamestats as $gamestat) : ?>
					<h5 class="header medium"><?php echo $gamestat; ?></h5>
					<ol class="normalList normal">
						<?php foreach($gamestat->getOrderedValues(10) as $value) : ?>
						<li><?php echo linkToProfile($value->getPlayerProfile()->getsfGuardUserProfile()); ?>: <?php echo $value->getValue(); ?></li>
						<?php endforeach; ?>
					</ol>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		
	</div>

</div>

