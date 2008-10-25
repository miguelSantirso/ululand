<h2 id="pageTitle"><?php echo link_to(image_tag("iconOptions.png").__('Competition'), '/game/list'); ?></h2>

<div id = "pageContent" >
	
	<div class = "contentColumn quarter alignLeft">
		<div class = "contentBox">
			<?php echo linkToCompetitionWithThumbnail($competition, 200, array('class' => 'firstRow xLarge')); ?>
		</div>
		
		<div class = "contentBox">
			<?php if($sf_user->isAuthenticated()) : ?>
			<?php $status = $competition->getStatus($sf_user->getPlayerProfile()); ?>
				<?php if($status == CompetitionPeer::OWNER) : ?>
					<p><?php echo link_to(__("Admin"), 'competition/edit?id='.$competition->getId().'&game='.null); ?></p>
				<?php endif; ?>
				
				<?php if($status == CompetitionPeer::MEMBER || $status == CompetitionPeer::OWNER) : ?>
					<?php echo button_to(__("Leave competition"), 'competition/reject?competition='.$competition->getId().'&player='.$sf_user->getPlayerProfile()->getId()); ?>	
				<?php elseif($status == CompetitionPeer::PENDING) : ?>
					<?php echo __("You must be approved by one of the owners"); ?>
				<?php elseif($status == CompetitionPeer::NOT_MEMBER) : ?>
					<?php echo button_to(__("Join us!"), 'competition/union?competition='.$competition->getId()); ?>	
				<?php endif; ?>
			<?php endif; ?>
		</div>
		
		<div class = "contentBox bordered">
			<p class="noSpace small"><strong><?php echo __('Visits:'); ?></strong> <?php echo $competition->getCounter(); ?></p>
		</div>
	</div>
	
	<div class = "contentColumn half alignLeft">
		<div class = "contentBox ">
			<h3 class = "header"><?php echo linkToCompetition($competition); ?></h3>
			<?php if($competition->getDescription() != ''){ ?> 
				<?php echo sfMarkdown::doConvert( $competition->getDescription() ); ?>
			<?php } else { ?>
				<p><?php echo __('There is no description for this competition'); ?></p>
			<?php } ?>
		</div>
		
		<div class="contentBox" id="postComment">
			<h4 class="header small"><?php echo __('Comments:') ?></h4>
			<?php
				if ($sf_user->isAuthenticated() && ($status == GroupPeer::OWNER || $status == GroupPeer::MEMBER))
				{
					include_component('sfComment', 'commentForm', array('object' => $competition, 'order' => 'desc'));
				}
				include_component('sfComment', 'commentList', array('object' => $competition, 'order' => 'desc'));
			?>
		</div>
		
	</div>
	
	<div class = "contentColumn quarter alignLeft">
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Ranking:') ?></h4>
				<?php $gamestat_players = $competition->getOrderedValues(); ?>
				<?php if(count($gamestat_players) != 0){ ?>
				<ul class="tags">
					<?php $linkText = ""; ?>
					<?php foreach($gamestat_players as $gamestat_player) : ?>
					<?php $linkText = $gamestat_player->getPlayerProfile()->getsfGuardUserProfile() . " (" . sprintf(__('%s points'), $gamestat_player->getValue()) . ") "; ?>
					<li><?php echo linkToProfileWithGravatar($gamestat_player->getPlayerProfile()->getsfGuardUserProfile(), 35, array(), $linkText); ?>	</li>
					<?php endforeach; ?>
				</ul>
				<?php } else echo __("You don't have them"); ?>
		</div>
		
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Members:') ?></h4>
			<?php
				 include_component('competition', 'listMembers', array('competition' => $competition, 'orderDescendingBy' => Competition_PlayerProfilePeer::CREATED_AT));
			?>
		</div>
	</div>
	
	
</div>