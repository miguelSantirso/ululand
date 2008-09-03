		<?php use_helper('PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($groupsPager, 'group/list'); ?></div>
		
		<?php $groups = $groupsPager->getResults(); ?>
		<?php //sfPropelActAsTaggableBehavior::preloadTags($profiles); ?>
		
		<ul class="compound">
			<?php foreach ($groups as $group): ?>
				<li class="">
					<?php echo linkToGroup($group, array('class' => 'firstRow')); ?>
					<div class="lastRow">
						<?php //if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo linkToEditProfile($sf_user->getProfile(), array('class' => 'alignRight xSmall')); } ?>
					</div>
					<div class="clearFloat"></div>
				</li>
			<?php endforeach; ?>
		</ul>
	
		<div class="center"><?php echo pager_navigation($groupsPager, 'profile/list'); ?></div>