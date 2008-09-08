<div id="pageContent">

	<div class="contentColumn wide alignLeft">
		<div class="contentBox">
			<h3 class="header">
				<?php echo linkToProfileWithGravatar($sf_guard_user_profile, 70); ?>
				<?php if($sf_user->isAuthenticated() && $sf_guard_user_profile->getId() == $sf_user->getProfile()->getId()) { ?> 
				<span class="">(<?php echo linkToEditProfile($sf_guard_user_profile); ?>)</span>
				<?php } ?>
			</h3>
			<small class="noSpace subtitle"><?php echo sprintf(__("Profile for %s"), linkToProfile($sf_guard_user_profile)); ?></small>
			<div style="clear: both"></div>
			
			<div class="">
			<?php if($playerProfile->getDescription() != ''){ ?> 
				<?php echo sfMarkdown::doConvert( $playerProfile->getDescription() ); ?>
			<?php } else { ?>
				<p><?php echo __('There is no description for this user'); ?></p>
			<?php } ?>
			</div>
			
			<div class="contentBox light bordered">
			<h4 class="header small"><?php echo __('Profile Details:') ?></h4>
			<p class="noSpace small"><?php echo __('Available credits'); ?>: <strong><?php echo $playerProfile->getAvailableCredits(); ?></strong></p>
			<p class="noSpace small"><?php echo __('Total earned credits'); ?>: <strong><?php echo $playerProfile->getTotalCredits(); ?></strong></p>
			<p class="noSpace small"><strong><?php echo __('Visits'); ?>:</strong> <?php echo $playerProfile->getCounter(); ?></p>
			
			<?php if($sf_user->isAuthenticated() && $sf_guard_user_profile->getId() == $sf_user->getProfile()->getId()) { ?> 
				<p class="small"><?php echo linkToEditProfile($sf_guard_user_profile); ?></p>
			<?php } ?>
			</div>
			
			<div class="contentBox" id="rankings">
				<h4 class="header small"><?php echo __('Friends:') ?></h4>
				<?php $friends = $playerProfile->getFriends(); 
				if (count($friends)!=0) { ?>
				<ul class="tags xLarge">
					<?php foreach($friends as $friend) : ?>
					<li><?php echo linkToProfileWithGravatar($friend->getsfGuardUserProfile(), 25); ?></li>
					<?php endforeach; ?>
				</ul>
				<?php } ?>
			</div>
			
			<div class="contentBox" id="postComment">
			<h4 class="header small"><?php echo __('Comments:') ?></h4>
			<?php
				 include_component('sfComment', 'commentForm', array('object' => $playerProfile, 'order' => 'desc'));
				 include_component('sfComment', 'commentList', array('object' => $playerProfile, 'order' => 'desc'));
			?>
			</div>
		</div>
	</div>

	<div class="contentColumn quarter alignLeft">
		<?php include_partial('searchForm'); ?>
		
	</div>
	
	<div class="clearFloat"></div>
	
	<div class="contentColumn quarter contentBox alignCenter">
		<?php echo link_to(sprintf('&laquo; %s', __('List')), 'profile/list', array('class' => 'button')) ?>
	</div>

</div>