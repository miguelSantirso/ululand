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
							<?php if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo linkToEditProfile(null, array('class' => 'alignRight xSmall')); } ?>
							<p class="noSpace xSmall"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $profile->getLinkedTagsString(); ?></p>
							<?php if($profile->getIsFree()) : ?>
							<p class="xSmall"><strong><?php echo __('Looking for a project to work on!'); ?></strong></p>
							<?php endif; ?>
						</div>
						<div class="clearFloat"></div>
					</li>
				<?php } ?>
			<?php endforeach; ?>
		</ul>
	
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>