		<?php use_helper('Date', 'PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>
		
		<?php $profiles = $profilesPager->getResults(); ?>
		<?php sfPropelActAsTaggableBehavior::preloadTags($profiles); ?>
		
		<?php if(count($profiles) != 0){ ?>
		<ul class="compound">
			<?php foreach ($profiles as $profile): ?>
				<?php $userProfile = $profile->getsfGuardUserProfile(); ?>
				<?php if($userProfile->isFilledIn()) { ?>
					<li class="">
						<?php echo linkToProfileWithGravatar($userProfile, 80, array('class' => 'firstRow large')); ?>
						<div class="lastRow">
							<?php if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo linkToEditProfile(null, array('class' => 'alignRight xSmall')); } ?>
							<p class="noSpace xSmall"><?php echo __('Friends'); ?>: <strong><?php echo $profile->getNbFriends(); ?></strong></p>
							<p class="noSpace xSmall"><?php echo __('uluPoints'); ?>: <strong><?php echo $profile->getTotalCredits(); ?></strong></p>
						</div>
						<div class="clearFloat"></div>
					</li>
				<?php } ?>
			<?php endforeach; ?>
		</ul>
		<?php } else echo __("There are no players still"); ?>
	
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>