		<?php use_helper('Date', 'PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>
		
		<?php $profiles = $profilesPager->getResults(); ?>
		<?php sfPropelActAsTaggableBehavior::preloadTags($profiles); ?>
		
		<ul class="compound">
			<?php foreach ($profiles as $profile): ?>
				<?php $userProfile = $profile->getsfGuardUserProfile(); ?>
				<?php if($userProfile->isFilledIn()) { ?>
					<li class="">
						<?php echo linkToProfileWithGravatar($userProfile, 30, array('class' => 'firstRow large')); ?>
						<div class="lastRow">
							<?php if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo link_to(__('edit'), 'profile/edit?id='.$userProfile->getId(), array('class' => 'alignRight xSmall')); } ?>
							<p class="noSpace xSmall"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $profile->getLinkedTagsString(); ?></p>
						</div>
					</li>
				<?php } ?>
			<?php endforeach; ?>
		</ul>
	
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>