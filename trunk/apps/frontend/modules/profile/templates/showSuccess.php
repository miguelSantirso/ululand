<div id="pageContent">

	<?php $friendshipMessage = sprintf(__("%s or %s to become his friend!"), link_to(__('Log in'), '@sf_guard_signin'), link_to(__('register'), '@register')); ?><a></a>
	<?php 
	if($sf_user->isAuthenticated())
	{
		if($sf_guard_user_profile->getId() != $sf_user->getProfile()->getId())
		{
			if($friendship == FriendshipPeer::NO_FRIENDS)
				$friendshipMessage = link_to(__('Add as friend'), 'profile/addFriend?id='.$playerProfile->getId());
			else if($friendship == FriendshipPeer::FRIENDS)
				$friendshipMessage = __('We are friends!');
			else if($friendship == FriendshipPeer::PENDING_A)
			{
				$friendshipMessage = sprintf('%1$s says he is your friend.', $sf_guard_user_profile->getUsername()) . ' ';
				$friendshipMessage .= '<strong>'.link_to(__('Accept as a friend'), 'profile/acceptFriend?id='.$playerProfile->getId()).'</strong>';
				$friendshipMessage .= ' or ';
				$friendshipMessage .= link_to(__('Reject'), 'profile/rejectFriend?id='.$playerProfile->getId());
			}
			else if($friendship == FriendshipPeer::PENDING_B)
				$friendshipMessage = sprintf(__('%s must confirm your friendship'), $sf_guard_user_profile->getUsername());
		}
		else
			$friendshipMessage = linkToEditProfile();
	}
	?>
	
	<!-- Friendship petitions -->
	<?php if(isset($unconfirmedFriends) && count($unconfirmedFriends) > 0) : ?>
		<div class="contentBox bordered light">
			<h4><?php echo __("You have unconfirmed friends. Are these people your friends?"); ?></h4>
			<ul class="">
				<?php foreach($unconfirmedFriends as $unconfirmedFriend) : ?>
					<li><?php echo linkToProfile($unconfirmedFriend->getsfGuardUserProfile(), array('class' => 'large')); ?>:
						<strong><?php echo link_to(__('Yes, we are friends!'), 'profile/acceptFriend?id='.$unconfirmedFriend->getId()); ?></strong>
						|
						<?php echo link_to(__('No, we are not friends'), 'profile/rejectFriend?id='.$unconfirmedFriend->getId()); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<!-- Player Name, Total Credits & empty block -->
	<div id="playerProfileTitle">
		<!-- Player Name and Gravatar -->
		<div id="playerProfileTitleName" class="playerProfileTitleBlock">
			<?php echo linkToProfileWithGravatar($sf_guard_user_profile, 60); ?>
			<p class="playerProfileTitleDetails"><?php echo $friendshipMessage; ?></p>
		</div>
		<!-- Total Credits -->
		<div id="playerProfileTitleCredits" class="playerProfileTitleBlock">
			<p><?php echo $playerProfile->getTotalCredits(); ?> <span><?php echo __("uluPoints"); ?></span></p>
		</div>
		<div class="playerProfileTitleBlock">
		</div>
	</div>
	
	<!-- Friends -->
	<div class="contentRow">
		<div class="contentColumn">
			<div class="contentBox light center">
				<?php $flashVars = "userUuids={$sf_guard_user_profile->getUuid()},"; ?>
				<?php
				foreach($friends as $friend)
				{
					$flashVars .= $friend->getsfGuardUserProfile()->getUuid().",";
				}
				?>
				<h4 class="header"><?php echo __('Me & my friends:'); ?></h4>
				<?php includeWidget('avatarRepresentator', $flashVars, array('width' => 800)); ?>
			</div>
		</div>
	</div>

	<!-- Comments & Latest Activity -->
	<div class="contentRow">
		<div class="contentColumn twoThirds alignLeft">
			<div class="contentBox">
				<h4 class="header small"><?php echo __('Comments:') ?></h4>
				<?php
				 include_component('sfComment', 'commentForm', array('object' => $playerProfile, 'order' => 'desc'));
				 include_component('sfComment', 'commentList', array('object' => $playerProfile, 'order' => 'desc'));
				?>
			</div>
		</div>
		<div class="contentColumn alignLeft third">
			<div class="contentBox">
				<h4 class="header small"><?php echo __('Friends:') ?></h4>
				<?php include_component('profile', 'listFriends', array('playerProfile' => $playerProfile, 'onlyFriends' => true)); ?>
			</div>
		</div>
	</div>
	
</div>
