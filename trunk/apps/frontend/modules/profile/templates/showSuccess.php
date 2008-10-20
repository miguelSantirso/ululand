<div id="pageContent">

	<div class="contentColumn quarter alignLeft">
		<div class="contentBox">
			<?php if($sf_guard_user_profile->getId() != $sf_user->getProfile()->getId() && $friendship == "NO_FRIENDS") { ?>
				<?php echo link_to(__('Add as friend'), 'profile/addFriend?id='.$playerProfile->getId()); ?> 
			<?php } ?>
			<?php if($sf_guard_user_profile->getId() != $sf_user->getProfile()->getId() && $friendship == "FRIENDS") { ?>
				<?php echo __('We are friends'); ?> 
			<?php } ?>
			<?php if($sf_guard_user_profile->getId() != $sf_user->getProfile()->getId() && $friendship == "PENDINGA") { ?>
				<?php echo link_to(__('Accept as friend'), 'profile/acceptFriend?id='.$playerProfile->getId()); ?> 
				<?php echo link_to(__('Reject as friend'), 'profile/rejectFriend?id='.$playerProfile->getId()); ?> 
			<?php } ?>
			<?php if($sf_guard_user_profile->getId() != $sf_user->getProfile()->getId() && $friendship == "PENDINGB") { ?>
				<?php echo __('I must confirm your friendship'); ?> 
			<?php } ?>
		</div>
		<div class="contentBox">
			<?php if($sf_user->isAuthenticated() && $sf_guard_user_profile->getId() == $sf_user->getProfile()->getId()) : ?>
			<?php echo linkToEditProfile(null, array('class' => 'bigBox'), __("Options")); ?>
			<?php echo link_to(__('Edit your avatar'), '@options_edit_avatar', array('class' => 'bigBox')); ?>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="contentColumn half alignLeft">
		<div class="contentBox">
			<h3 class="header">
				<?php echo linkToProfileWithGravatar($sf_guard_user_profile, 70); ?>
				<?php if($sf_user->isAuthenticated() && $sf_guard_user_profile->getId() == $sf_user->getProfile()->getId()) { ?> 
				<span class="">(<?php echo linkToEditProfile(); ?>)</span>
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
			<p class="noSpace small"><strong><?php echo __('Visits:'); ?></strong> <?php echo $playerProfile->getCounter(); ?></p>
			
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

	<div class="contentColumn quarter alignRight">
		
		<div class="contentBox">
				<h4 class="header small"><?php echo __('Friends') ?>:</h4>
				<?php
				 include_component('profile', 'listFriends', array('playerProfile' => $playerProfile, 'onlyFriends' => true));
				?>
		</div>
		
		<div class="contentBox">
				<h4 class="header small"><?php echo __('Pending') ?>:</h4>
				<?php
				 include_component('profile', 'listFriends', array('playerProfile' => $playerProfile, 'pending' => true));
				?>
		</div>
		
	</div>
	
	<div class="clearFloat"></div>
	
	<div class="contentColumn quarter contentBox alignCenter">
		<?php echo link_to(sprintf('&laquo; %s', __('List')), 'profile/list', array('class' => 'button')) ?>
	</div>

</div>