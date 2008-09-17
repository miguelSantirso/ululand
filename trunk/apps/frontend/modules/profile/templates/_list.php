		<?php use_helper('Date', 'PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>
		
		<?php $profiles = $profilesPager->getResults(); ?>
		<?php sfPropelActAsTaggableBehavior::preloadTags($profiles); ?>
		
		<ul class="compound">
			<?php foreach ($profiles as $profile): ?>
				<?php $userProfile = $profile->getsfGuardUserProfile(); ?>
				<?php if($userProfile->isFilledIn()) { ?>
					<li class="">
						<?php echo linkToProfileWithGravatar($userProfile, 80, array('class' => 'firstRow large')); ?>
						<div class="lastRow">
							<?php if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo linkToEditProfile($sf_user->getProfile(), array('class' => 'alignRight xSmall')); } ?>
							<p class="noSpace xSmall"><?php echo __('Available credits'); ?>: <strong><?php echo $profile->getAvailableCredits(); ?></strong></p>
							<p class="noSpace xSmall"><?php echo __('Total earned credits'); ?>: <strong><?php echo $profile->getTotalCredits(); ?></strong></p>
						</div>
						<div class="clearFloat"></div>
					</li>
				<?php } ?>
			<?php endforeach; ?>
		</ul>
	
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>